<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\SetValue;
use App\Purchaseorder;
use Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\TpmPurchaseOrder;

class PurchaseOrderSDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posds = PurchaseOrder::where('customer_id','=',null)->where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrderSD.index',compact('posds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codsd = SetValue::where('id','=',1)->where('status','=',1)->value('value');
        $dissd1 = SetValue::where('id','=',2)->where('status','=',1)->value('value');
        $dissd2 = SetValue::where('id','=',3)->where('status','=',1)->value('value');
        $setdissd1 = SetValue::where('id','=',4)->where('status','=',1)->value('value');
        $setdissd2 = SetValue::where('id','=',5)->where('status','=',1)->value('value');
        $vat = SetValue::where('id','=',11)->where('status','=',1)->value('value');
        $product_name = Product::pluck('name','id')->all();
        $product_code = Product::pluck('product_code','id')->all();
        return view('admin.purchaseOrderSD.create',compact('product_name','product_code','codsd','dissd1','dissd2','setdissd1','setdissd2','vat'));
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
            $po->dueDate = Carbon::now()->addMonths(1);
            $po->customer_id = Input::get('customer_id');
            $po->totalAmount = Input::get('total');
            if(Input::get('discount')!=null){
               $po->discount = Input::get('discount'); 
           }else{
                $po->discount = 0;
           }
            $po->user_id = Auth::user()->id;
            $po->isGenerate =0;
            $po->printedBy =0;
            $po->isPayment =0;
            $po->isDelivery =0;
            if(Input::get('codsd')!=null){
                $po->cod = Input::get('codsd');
            }else{
                $po->cod =0;
            }   
            if(Input::get('vat')!=null){
                $po->vat = Input::get('vat');
            }else{
                $po->vat =0;
            }         
            $po->save();
            $pos = Purchaseorder::all();
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
            return redirect()->route('purchaseOrdersSD.index');
            
        }
        if(Input::get('btn_back')){
            $tmps = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
            foreach ($tmps as $tmp) {
                $tmp->delete();
            }
            return redirect()->back();
        }
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
         return view('admin.purchaseOrderSD.showPoDetails',compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function addOrderSD($proid, $qty, $price, $amount)
    {
        TpmPurchaseOrder::create(['product_id'=>$proid,'qty'=>$qty,'unitPrice'=>$price,'amount'=>$amount,'user_id'=>Auth::user()->id]);
        $tmpPurchaseOrders = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return response()->json($tmpPurchaseOrders);
    }
    public function showProductSD(){
        $tmpdata = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrderSD.showProductsd',compact('tmpdata'));
    }
}
