<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TpmEditPurchaseOrder;
use App\Purchaseorder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;

class TmpEditPurchaseorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pos = TpmEditPurchaseOrder::select('purchaseorder_id')->distinct()->get();
        return view('admin.purchaseorder.verify',compact('pos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poid = $request->purchaseorder_id;
        $tmp = TpmEditPurchaseOrder::all();
        $totalAmount= $tmp->where('purchaseorder_id','=',$poid)->sum('amount');
        $discount = Purchaseorder::where('id','=',$poid)->value('discount');
        $cod = Purchaseorder::where('id','=',$poid)->value('cod');
        $vat = Purchaseorder::where('id','=',$poid)->value('vat');
        $diposit = Purchaseorder::where('id','=',$poid)->value('diposit');
        $Vtotal = $totalAmount  - $totalAmount * $discount /100;
        $Vcod =$Vtotal * $cod /100;
        $Vvat = $totalAmount * $vat/100;
        $grandTotal = $Vtotal - $Vcod + $Vvat;
        $VgrandTotal = $grandTotal - $diposit;
        $po = Purchaseorder::findOrFail($poid);
        $po->totalAmount = $totalAmount;
        $po->cradit = $VgrandTotal;
        DB::table('purchaseorder_product')->where('purchaseorder_id','=',$poid)->delete();
        $tmps = TpmEditPurchaseOrder::where('purchaseorder_id','=',$poid)->where('recordStatus','!=','r')->get();
                foreach ($tmps as $tmp) {
                 DB::statement("INSERT INTO purchaseorder_product (purchaseorder_id, product_id, unitPrice, qty, amount, user_id) 
                    VALUES({$tmp->purchaseorder_id},{$tmp->product_id},{$tmp->unitPrice},{$tmp->qty},{$tmp->amount},{$tmp->user_id})");
                }
        DB::table('tmpeditpurchaseorders')->where('purchaseorder_id','=',$poid)->delete();
        $pos = TpmEditPurchaseOrder::select('purchaseorder_id')->distinct()->get();
        return view('admin.purchaseorder.verify',compact('pos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function getPopupTmpPo($id)
    {
         $pos = TpmEditPurchaseOrder::where('purchaseorder_id','=',$id)->get();
         return view('admin.purchaseOrder.showVerifyPopup',compact('pos'));
    }
}
