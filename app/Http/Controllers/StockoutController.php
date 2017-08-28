<?php

namespace App\Http\Controllers;

use App\Import;
use App\Product;
use App\Purchaseorder;
use App\Stockout;
use App\Subimport;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockoutController extends Controller
{

    public function index()
    {
        return view('admin.stock_out.index');
    }


    public function create()
    {

       $invoice = Purchaseorder::all()->where('isDelivery','=',0)->where('isGenerate','=', 1);
//       dd($invoice);
       return view('admin.stock_out.create',compact('invoice'));
    }

    public function store(Request $re)
    {
        $m = ""; $j=0; $qt=0; $a=0;
        $this->validate($re,[
            'invoiceN'=>'required',
            'date'=>'required'
        ]);
        $stockoutDate = $re->date;
        $user_id = Auth::user()->id;
        $invoiceN = $re->input('invoiceN');//Get Invoice number from combobox in Form
        if($invoiceN!=null){
            $purchase = Purchaseorder::findOrFail($invoiceN);//Find purchase by In that got from comboBox from form
            $product = $purchase->products()->get();// Get all product by Invoice/Purchase Order

            //Insert record to table substock
//            $substock = new Subimport();
//            $substock->subimportDate=$stockoutDate;
//            $substock->purchaseorder_id=$invoiceN;
//            $substock->brand_id="";
//            $substock->supplier_id=1;
//            $substock->imported_by=$user_id;
//            $substock->save();
//            $subimport_id = $substock->id;

            foreach ($product as $p) {
                $qtyIn = $p->pivot->qty;
                $product_id = $p->id;
                $qt=$qtyIn;
                echo "<br> Product ID ".$product_id."=\tQuantities ".$qtyIn."<br>";
                $result = DB::select("SELECT id, qty, importId FROM `import_product` WHERE productId = {$product_id} AND qty > 0 "); // Select all product in import
                foreach ($result as $r){
                    echo " Import ID :".$r->importId." Product ID : ".$product_id." Quantities : ". $r->qty."<br>";
                    $res = DB::select("SELECT id, qty, importId, mfd, expd FROM `import_product` WHERE importId = {$r->importId} AND productId={$product_id} AND qty > 0");//select one by one from import
                    foreach ($res as $s){
                            $qt=$qt;
                            if( $a>=$qtyIn | $s->qty >= $qtyIn){
                                if($j!=$product_id){
                                    echo "$s->qty >= $qtyIn"."<br>";
                                    $m = $s->qty - $qt;
                                    if($m >=0){
                                        echo "ID".$s->id."<br>";
                                        echo $m."<br>"; //here we update record to database
                                        echo "Update to database..in block a"."<br><br>";
                                        DB::table('import_product')->where('id', $s->id)->update(array('qty'=>$m));

                                        $prod = Product::findOrFail($product_id);//Update qty to main table product
                                        $bqty = $prod->qty;
                                        $uqty = ($bqty-$qtyIn);
                                        $prod->qty = $uqty;
                                        $prod->save();

                                        $Up = Purchaseorder::findOrFail($invoiceN);//Update table purchaseorder in field isDelivery to 1
                                        $Up->isDelivery=1;
                                        $Up->save();

                                        $stockout = new Stockout();//Insert to table stockout
                                        $stockout->stockoutDate =$stockoutDate;
                                        $stockout->purchaseorder_id =$invoiceN;
                                        $stockout->user_id = $user_id;
                                        $stockout->save();

//                                        DB::table('subimport_product')->insert(['subimport_id'=>$subimport_id, 'product_id'=>$product_id, 'qty'=>$qt, 'mfd'=>$s->mfd, 'expd'=>$s->expd]);
//                                        DB::table('brand_product')->insert(['brand_id'=>'','product_id'=>$product_id,'qty'=>$qtyIn]);

                                        echo "Base Quantities = ".$bqty."<br>";
                                        echo "Order Quantities = ".$qtyIn."<br>";
                                        echo "Update Quantities = ".$uqty=($bqty-$qtyIn)."<br>";

                                        $j = $product_id;
                                        $a=0;
                                    }
                                }
                            }elseif($s->qty < $qtyIn || $a < $qtyIn){

                                if($j!=$product_id) {
                                    $a = $a + $s->qty;
                                    echo "a = ".$a."and s->qty :".$s->qty."<br>";
                                    if ($a >= $qtyIn) {
                                       $m = $s->qty - $qt;
                                        echo "ID".$s->id."<br>";
                                        echo $m."<br>"; //Update to product  sfsdf
                                        DB::table('import_product')->where('id', $s->id)->update(array('qty'=>$m));
                                        $prod = Product::findOrFail($product_id);
                                        $bqty = $prod->qty;
                                        $uqty = ($bqty-$qtyIn);
                                        $prod ->qty = $uqty;
                                        $prod->save();

                                        $Up = Purchaseorder::findOrFail($invoiceN);
                                        $Up->isDelivery=1;
                                        $Up->save();

                                        //insert record to table subimport / into substock detail
//                                        DB::table('subimport_product')->insert(['subimport_id'=>$subimport_id, 'product_id'=>$product_id, 'qty'=>$qt, 'mfd'=>$s->mfd, 'expd'=>$s->expd]);
//                                        DB::table('brand_product')->insert(['brand_id'=>'','product_id'=>$product_id,'qty'=>$qtyIn]);

                                        $stockout = new Stockout();//Insert to table stockout
                                        $stockout->stockoutDate =$stockoutDate;
                                        $stockout->purchaseorder_id =$invoiceN;
                                        $stockout->user_id = $user_id;
                                        $stockout->save();

                                        echo "Base Quantities = ".$bqty."<br>";
                                        echo "Order Quantities = ".$qtyIn."<br>";
                                        echo "Update Quantities = ".$uqty=($bqty-$qtyIn)."<br>";
                                        echo "Update to database...."."<br><br>";
                                        $j = $product_id;
                                        $a = 0;
                                    } elseif ($a < $qtyIn) {
                                        $m = $qt - $s->qty;
                                        $qt = $m;
                                        echo "ID".$s->id."<br>";
                                        echo $m."<br>";//Update always 0
                                        echo "Values = 0<br><br>";
                                        DB::table('import_product')->where('id', $s->id)->update(array('qty'=>0));
//                                      DB::table('subimport_product')->insert(['subimport_id'=>$subimport_id, 'product_id'=>$product_id, 'qty'=>$s->qty, 'mfd'=>$s->mfd, 'expd'=>$s->expd]);
                                    }
                                }
                            }
                    }
                }
            }
            $expDate = $re->input('date');
        }



    }//end function store


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    //this function get from ajax to change customer name and invoice date
    public  function InvNChange($id){

        $Purchase = Purchaseorder::findOrFail($id);

        $user_name =$Purchase->customer->name;
        $date=$Purchase->invoiceDate;
        return response()->json(['userName'=>$user_name,'invoiceDate'=>$date]);
    }
}
