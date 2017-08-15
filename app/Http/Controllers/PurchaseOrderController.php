<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchaseorder;
use App\Customer;
use App\Channel;
use App\Product;
use App\Province;
use App\District;
use App\Commune;
use App\Village;
use App\SetValue;
use App\TpmPurchaseOrder;
use Illuminate\Support\Facades\Input;
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
        TpmPurchaseOrder::create(['product_id'=>$proid,'qty'=>$qty,'unitPrice'=>$price,'amount'=>$amount,'user_id'=>Auth::user()->id]);
        $tmpPurchaseOrders = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return response()->json($tmpPurchaseOrders);
    }
    public function showProductCus(){
        $tmpdata = TpmPurchaseOrder::where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrder.showProduct',compact('tmpdata'));
    }
}
