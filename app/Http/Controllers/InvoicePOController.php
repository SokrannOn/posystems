<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchaseorder;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;
use App\SetValue;
use App\User;
use App\Position;

class InvoicePOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 2;
        $pos = PurchaseOrder::where('isGenerate','=',0)->get();
        $paids = PurchaseOrder::where('isPayment','=',1)->get();
        $cradits = PurchaseOrder::where('isPayment','=',0)->get();
        return view('admin.invoicePO.index',compact('pos','paids','cradits','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        
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
        $totalAmount = Purchaseorder::where('id','=',$id)->value('totalAmount');
        $discount = Purchaseorder::where('id','=',$id)->value('discount');
        $cod = Purchaseorder::where('id','=',$id)->value('cod');
        $vat = Purchaseorder::where('id','=',$id)->value('vat');
        $diposit = Purchaseorder::where('id','=',$id)->value('diposit');
        $Vtotal = $totalAmount  - $totalAmount * $discount /100;
        $Vcod =$Vtotal * $cod /100;
        $Vvat = $totalAmount * $vat/100;
        $grandTotal = $Vtotal - $Vcod + $Vvat;
        $VgrandTotal = $grandTotal - $diposit;
         return view('admin.invoicePO.showPoDetails',compact('details','totalAmount','discount','cod','vat','diposit','VgrandTotal'));
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
            $po = Purchaseorder::findOrFail($id);
            if(Input::get("vat")==1){
                $vat = SetValue::where('id','=',11)->where('status','=',1)->value('value');
                $po->vat = $vat;
            }else{
                $po->vat =0;
            }
            if(Input::get("diposit")!=''){
                $po->diposit = Input::get("diposit");
            }else{
                $po->diposit =0;
            }
            if(Input::get("rate")!=''){
                $po->rate= Input::get("rate");
            }else{
                $po->rate=0;
            }
            $po->printedBy = Auth::user()->id; 
            $po->save();
           return redirect()->route('invoicePO.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po = Purchaseorder::findOrFail($id);
        $positionid = Position::where('name','=','Account')->value('id');
        $userName = User::where('position_id','=',$positionid)->value('id');
        $po->printedBy = Auth::user()->id; 
        $po->save(); 
        $totalAmount = Purchaseorder::where('id','=',$id)->value('totalAmount');
        $discount = Purchaseorder::where('id','=',$id)->value('discount');
        $cod = Purchaseorder::where('id','=',$id)->value('cod');
        $vat = Purchaseorder::where('id','=',$id)->value('vat');
        $diposit = Purchaseorder::where('id','=',$id)->value('diposit');
        $rate = Purchaseorder::where('id','=',$id)->value('rate');
        $Vtotal = $totalAmount  - $totalAmount * $discount /100;
        $Vcod =$Vtotal * $cod /100;
        $Vvat = $totalAmount * $vat/100;
        $grandTotal = $Vtotal - $Vcod + $Vvat;
        $VgrandTotal = $grandTotal - $diposit;
        $VgrandTotalk = $VgrandTotal * $rate;
        $VgrandTotalkh= (round($VgrandTotalk,0,PHP_ROUND_HALF_UP));
        
        if(substr($VgrandTotalkh, -2,2)>0){
                    $round = 100-substr($VgrandTotalkh, -2,2);
                    $totalAmountkh = $VgrandTotalkh+$round;
                }else
                {
                    $totalAmountkh = $VgrandTotalkh;
                }
        $printedBy = Purchaseorder::where('id','=',$id)->value('printedBy');
        $createdInv = User::where('id','=',$printedBy)->value('nameDisplay');
        $sex = User::where('id','=',$printedBy)->value('sex');
        return view('admin.invoicePO.invoice',compact('po','totalAmount','discount','cod','vat','diposit','Vcod','Vvat','VgrandTotal','createdInv','sex','rate','totalAmountkh'));
    }
    public function getPopupEditPO($id)
    {
        $po = Purchaseorder::findOrFail($id);
        return view('include.editPO',compact('po'));
    }
    public function getPopupEditCradit($id)
    {
        $cradit = Purchaseorder::findOrFail($id);
        return view('include.editPopupCradit',compact('cradit'));
    }
    public function updateGenerate($id){
        $update = Purchaseorder::where('id','=', $id)->first();
        $update->isGenerate = 1;
        $update->invoiceDate = Carbon::now()->toDateString();
        $update->save();
    }
    public function showInvoicePaid($id){
        $id =$id;
        $pos = PurchaseOrder::where('isGenerate','=',0)->get();
        $paids = PurchaseOrder::where('isPayment','=',1)->get();
        $cradits = PurchaseOrder::where('isPayment','=',0)->get();
        return view('admin.invoicePO.index',compact('pos','paids','cradits','id'));
    }
}
