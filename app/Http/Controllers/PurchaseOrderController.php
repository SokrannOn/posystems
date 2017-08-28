<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchaseorder;
use App\Customer;
use App\Channel;
use App\Product;
use App\Category;
use App\Province;
use App\District;
use App\Commune;
use App\Village;
use App\SetValue;
use App\TpmPurchaseOrder;
use App\TpmEditPurchaseOrder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $pocuss = PurchaseOrder::where('customer_id','!=',null)->where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrder.index',compact('pocuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $customers = Customer::pluck('name','id')->all();
        $channels = Channel::pluck('name','id')->all();
        $product_name = Product::pluck('name','id')->all();
        $product_code = Product::pluck('product_code','id')->all();
        $provinces = Province::pluck('name','id')->all();
        $districts = District::pluck('name','id')->all();
        $communes = Commune::pluck('name','id')->all();
        $villages = Village::pluck('name','id')->all();
        $tmpPurchaseOrders = TpmPurchaseOrder::all();
        //-----------setvalue--------------------------
        $codcus = SetValue::where('id','=',6)->where('status','=',1)->value('value');
        $discus1 = SetValue::where('id','=',7)->where('status','=',1)->value('value');
        $discus2 = SetValue::where('id','=',8)->where('status','=',1)->value('value');
        $setdiscus1 = SetValue::where('id','=',9)->where('status','=',1)->value('value');
        $setdiscus2 = SetValue::where('id','=',10)->where('status','=',1)->value('value');
        $vat = Setvalue::where('id','=',11)->where('status','=',1)->value('value');
        return view('admin.purchaseOrder.create',compact('customers','channels','product_name','provinces','districts','communes','villages','tmpPurchaseOrders','codcus','discus1','discus2','setdiscus1','setdiscus2','vat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
            if(Input::get('btn_save')){
            $po = new Purchaseorder;
            $po->poDate = Carbon::now();
            $po->dueDate = Input::get('dueDate');
            $po->customer_id = Input::get('customer_id');
            $po->totalAmount = Input::get('total');
            $po->cradit = Input::get('grandTotal');
            if(Input::get('discount')!=null){
                $po->discount = Input::get('discount');
            }else{
                $po->discount = 0;
            }            
            $po->user_id = Auth::user()->id;
            $po->vat =0;
            $po->diposit =0;
            $po->printedBy =0;
            $po->isGenerate =0;
            $po->isPayment =0;
            $po->isDelivery =0;
            $po->paid = 0;
            $cod =0;
            $cod = Input::get('cod');
            if($cod==1){
                $po->cod = Input::get('codcus');
            }else{
                $po->cod = 0;
            }
            $po->save();
            $tmps = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
                foreach ($tmps as $tmp) {
                $po->products()->attach($tmp->product_id,
                    ['unitPrice'=>$tmp->unitPrice,
                    'qty'=>$tmp->qty,
                    'amount'=>$tmp->amount,
                    'user_id'=>$tmp->user_id]);
                }
            $tmps = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
            $pocuss = PurchaseOrder::where('customer_id','!=',null)->get();
            return view('admin.purchaseOrder.index',compact('pocuss'));
        }
        //------------------btn_back---------------
        if(Input::get('btn_back')){
            $tmps = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
            return redirect()->back();
        }
        //------------------btn_cancel--------------------------
        if(Input::get('btn_cancel')){
            $tmps = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Purchaseorder::findOrFail($id);
         return view('admin.purchaseOrder.showPoDetails',compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
        $pos=Purchaseorder::findOrFail($id);
        $product = Purchaseorder::findOrFail($id)->products()->get();
         foreach ($product as $po) {
            TpmEditPurchaseOrder::create([
                'purchaseorder_id'=>$pos->id,
                'product_id'=>$po->pivot->product_id,
                'qty'=>$po->pivot->qty,
                'unitPrice'=>$po->pivot->unitPrice,
                'amount'=>$po->pivot->amount,
                'recordStatus'=>'n',
                'user_id'=>Auth::user()->id
            ]);
         }
        $products = Product::pluck('name','id')->all();
        $potmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$id)->get();
         return view('admin.purchaseOrder.edit',compact('pos','potmps','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Input::get('btn_add')){
            $tmpedit = new TpmEditPurchaseOrder;
            $poid = Input::get('poid');
            $proid = Input::get('product_id');
            $qty = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)->where('product_id','=',$proid)->where('recordStatus','!=','r')->value('qty');
            if($qty!=null){
                DB::statement("DELETE FROM tmpeditpurchaseorders WHERE purchaseorder_id={$poid} AND product_id={$proid}");
                $newQtys = Input::get('qty');
                $newQty = (int)$newQtys;
                $qtylast = $qty + $newQty;
                $price = Input::get('unitPrice');
                $amount = $qtylast * $price;
                $tmpedit->qty = $qtylast;
                $tmpedit->amount = $amount;
            }else{
                $tmpedit->qty = Input::get('qty');
                $tmpedit->amount = Input::get('amount');
            }
            $tmpedit->purchaseorder_id = Input::get('poid');
            $tmpedit->product_id = Input::get('product_id');
            $tmpedit->unitPrice = Input::get('unitPrice');
            $tmpedit->recordStatus = 'a';
            $tmpedit->user_id = Auth::user()->id;
            $tmpedit->save();
            $pos=Purchaseorder::findOrFail($poid);
            $products = Product::pluck('name','id')->all();
            $potmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)->where('recordStatus','!=','r')->get();
         return view('admin.purchaseOrder.edit',compact('pos','potmps','products'));
        }
        if(Input::get('btn_back')){
            $tmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
            return redirect()->route('purchaseOrders.index');
        }
        if(Input::get('btn_done')){
            return redirect()->route('purchaseOrders.index');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($proid,$poid)
    {
        
    }
    public function popupCus()
    {
        $customers = Customer::pluck('name','id')->all();
        $channels = Channel::pluck('name','id')->all();
        $product_name = Product::pluck('name','id')->all();
        $product_code = Product::pluck('product_code','id')->all();
        $provinces = Province::pluck('name','id')->all();
        $districts = District::pluck('name','id')->all();
        $communes = Commune::pluck('name','id')->all();
        $villages = Village::pluck('name','id')->all();
        return view('include.cusPopUp',compact('customers','channels','product_name','provinces','districts','communes','villages'));
    }
    public function addOrderCus($proid, $qty, $price, $amount)
    {
        $oldQty = TpmPurchaseOrder::where('product_id','=',$proid)->where('user_id','=',Auth::user()->id)->value('qty');
        $user_id =Auth::user()->id;
        if($oldQty!=null){
            DB::statement("DELETE FROM tmppurchaseoders WHERE product_id={$proid} AND user_id={$user_id}");
                $newQty = (int)$qty;
                $qtylast = $oldQty + $newQty;
                $amount = $qtylast * $price;
            TpmPurchaseOrder::create(['product_id'=>$proid,'qty'=>$qtylast,'unitPrice'=>$price,'amount'=>$amount,'user_id'=>Auth::user()->id]);
        }else{
            TpmPurchaseOrder::create(['product_id'=>$proid,'qty'=>$qty,'unitPrice'=>$price,'amount'=>$amount,'user_id'=>Auth::user()->id]);
        }
        $tmpPurchaseOrders = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return response()->json($tmpPurchaseOrders);
    }
    public function showProductCus(){
        $tmpdata = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrder.showProduct',compact('tmpdata'));
    }
    public function getPopupEditProduct($poid,$proid)
    {
        $qty = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)
                                      ->where('product_id','=',$proid)
                                      ->value('qty');
        return view('admin.purchaseOrder.editPopup',compact('qty','proid','poid'));
    }
    public function updatePro(Request $request)
    {
        $poid = Input::get('poid');
        $proid = Input::get('proid');
        $qty = Input::get('qty');
        $unitPrice = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)
                                      ->where('product_id','=',$proid)
                                      ->value('unitPrice');
        $amount = $qty * $unitPrice;
        DB::statement("UPDATE tmpeditpurchaseorders SET qty={$qty}, amount={$amount}, recordStatus='e' WHERE purchaseorder_id={$poid} AND product_id={$proid}");
        return redirect(url('admin/showEdit',$poid));
    }
    public function showEdit($poid)
    {
        $pos=Purchaseorder::findOrFail($poid);
        $products = Product::pluck('name','id')->all();
        $potmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)->where('recordStatus','!=','r')->get();
         return view('admin.purchaseOrder.edit',compact('pos','potmps','products'));
    }
    public function deletePro(Request $request)
    {
        $poid = Input::get('poid');
        $proid = Input::get('proid');
        DB::statement("UPDATE tmpeditpurchaseorders SET recordStatus='r' WHERE purchaseorder_id={$poid} AND product_id={$proid}");
        return redirect(url('admin/showEdit',$poid));
    }
}
