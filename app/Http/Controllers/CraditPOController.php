<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchaseorder;
use Illuminate\Support\Facades\Input;
use Auth;
use App\SetValue;
use App\User;
use Carbon\Carbon;
use App\Customer;
use App\Summaryinvoice;
class CraditPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smis = Summaryinvoice::all();
        return view('admin.summaryinv.index',compact('smis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $po = Purchaseorder::where('isPayment','=',0)->where('customer_id','!=',null)
                            ->select('customer_id')
                            ->distinct()
                            ->get();
        //dd($po);
        return view('admin.summaryinv.create',compact('po'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $summaryinv = new Summaryinvoice;
        $summaryinv->rate = $request->rate;
        $summaryinv->customer_id = $request->customer_id;
        $summaryinv->smiDate = Carbon::now()->toDateString();
        $summaryinv->user_id = Auth::user()->id;
        $summaryinv->save();
        foreach ($request->purchaseorder_id as $po) {
            $summaryinv->purchaseorders()->attach($po);
        }
         return redirect()->route('summaryInv.index')->with('message','This new summaryInv has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $smi = Summaryinvoice::findOrFail($id);
        return view('admin.summaryinv.summaryDetails',compact('smi'));
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
        $grandTotal = Purchaseorder::where('id','=',$id)->value('cradit');
        $paid = Purchaseorder::where('id','=',$id)->value('paid');
        $paidnew = Input::get("paids");
        $cradit = $grandTotal - $paidnew;
        $paids = $paid + $paidnew;
        $po->paid = $paids;
        $po->cradit = $cradit;
        if($cradit==0){
                $po->isPayment = 1;
                $po->paidDate = Carbon::now()->toDateString();
            }else{
                $po->isPayment = 0;
                $po->paidDate = Carbon::now()->toDateString();
            }
            $po->printedBy = Auth::user()->id;   
            $po->save();
           return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $smi = Summaryinvoice::findOrFail($id);
        $smi->user_id = Auth::user()->id;
        $smi->save();
        $userid = Summaryinvoice::where('id','=',$id)->value('user_id');
        $sex = User::where('id','=',$userid)->value('sex');
        return view('admin.summaryinv.invoice',compact('smi','sex'));
    }


    public function detail($id){
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
         return view('admin.invoicePO.showPoCradit',compact('details','totalAmount','discount','cod','vat','diposit','VgrandTotal'));
    }
}
