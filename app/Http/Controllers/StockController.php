<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchaseorder;
use Illuminate\Support\Facades\Input;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = PurchaseOrder::where('isGenerate','=',1)->latest()->get();
        //dd($po);
        return view('admin.isDelivery.index',compact('po'));
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
    public function store(Request $request)
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
        $po = Purchaseorder::findOrFail($id);
        $po->isDelivery = 1;
        $po->save();
        return redirect()->route('stocks.index')->with('message','This invoice has been updated successfully!');
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
        $po->isDelivery = Input::get('isDelivery');
        $po->save();
        return redirect()->route('stocks.index')->with('message','This invoice has been updated successfully!');
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
    public function getPopupEditInvoice($id){
        $isDelivery = Purchaseorder::findOrFail($id);
        return view('include.getPopupEditInvoice',compact('isDelivery'));
    }
}
