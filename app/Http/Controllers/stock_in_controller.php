<?php

namespace App\Http\Controllers;
use App\Http\Requests\stock_in_request;
use App\Import;
use App\Pricelist;
use App\Product;
use App\Supplier;
use App\Tmpstock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class stock_in_controller extends Controller
{

    public function index()
    {
        $dateImport = Import::pluck('impDate','id');
        $import = Import::all();
        return view('admin.stock_in.index', compact('dateImport','import'));
    }


    public function create()
    {
        $date = Carbon::now();
        $product = Product::pluck('name','id')->all();
        $supplier = Supplier::pluck('companyname','id')->all();
        return view('admin.stock_in.create', compact('date','product','supplier'));
    }


    public function store(Request $re)
    {
        //dd($re->all());
        //dd($re->input('discount'));
        $this->validate( $re,
            [
                'imp_date'=>'required',
                'inv_date'=>'required',
                'inv_number'=>'required',
            ]);
            $amount = Tmpstock::all()->sum('amount');
            $userId = Auth::user()->id;
            $import = new Import();
            $import->impDate = $re->input('imp_date');
            $import->invoiceDate = $re->input('inv_date');
            $import->invoiceNumber = $re->input('inv_number');
            $import->totalAmount = $amount;
            if($re->input('discount')==""){
                $import->discount = 0;
            }else{
                $import->discount = $re->input('discount');
            }
            $import->discount = $re->input('discount');
            $import->supplierId = $re->input('companyname');
            $import->userId =$userId;
            $import->save();
//          end insert to main table

            $tmpInsert = Tmpstock::all();
            $importId = $import->id;
            foreach ($tmpInsert as $row){
                $proId = $row->product_id;
                $qty = $row->qty;
                    $landing = DB::select("SELECT landingprice FROM `pricelists` WHERE product_id = {$proId} and startdate<=now() and enddate>=now()");
                    foreach($landing as $rows){
                        $lPrice=$rows->landingprice;
                    }
               $mfd = $row->mfd;
               $expd = $row->expd;
               $import->products()->attach($proId,['qty'=>$qty,'landingPrice'=>$lPrice,'mfd'=>$mfd, 'expd'=>$expd]);
            }
            $tmps = Tmpstock::all();
            foreach($tmps as $tmp){
                $id = $tmp->product_id;
                $Qty = Tmpstock::where('product_id','=',$id)->value('qty');
                $product = Product::findOrFail($id);
                $baseQty = $product->qty;
                $SumQty= $Qty + $baseQty;
                $product->qty = $SumQty;
                $product->save();
            }
            $tmpDelete = Tmpstock::truncate();

            return redirect(route('stock.index'));

    }


    public function show($id)
    {
        $importId = Import::findOrFail($id);
        return view('admin.stock_in.view', compact('importId'));
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

    public function tmpInsert($id,$qty,$mfd,$expd){
        $error="";
        if($id==""){
            $error.="has errors";
        }
        if($qty==""){
            $error.="has errors";
        }
        if($mfd==""){
            $error.="has errors";
        }
        if($expd==""){
            $error.="has errors";
        }
        if($error==""){
            $lPrice = null;
            $landing = DB::select("SELECT landingprice FROM `pricelists` WHERE product_id = {$id} and startdate<=now() and enddate>=now()");
            foreach($landing as $row){
                $lPrice=$row->landingprice;
            }
            $amount = ($lPrice * $qty);
            $tmpInsert = new  Tmpstock();
            $tmpInsert->product_id = $id;
            $tmpInsert->qty=$qty;
            $tmpInsert->amount= $amount;
            $tmpInsert->mfd = $mfd;
            $tmpInsert->expd = $expd;
            $tmpInsert->save();
            $tmpSelect = Tmpstock::all();
            return view('admin.stock_in.show',compact('tmpSelect'));
        }
    }
    public function viewRecord(){
        $tmpSelect = Tmpstock::all();
        return view('admin.stock_in.show',compact('tmpSelect'));
    }

    //Remove Record one by one
    public function delete($id){
        $proId = $id;
        $tmpInsert = Tmpstock::where('product_id','=',$proId);
        $tmpInsert->delete();
        $tmpSelect = Tmpstock::all();
        return view('admin.stock_in.show',compact('tmpSelect'));
    }
    public  function discard(){

        Tmpstock::truncate();
    }
}
