<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Customer;
use App\Usage;
use App\SetValue;
use Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *///isGenerateInv','=', $generateInv
    public function index()
    {
        $invoices = Invoice::all();
        $isgenerate = Usage::where('isGenerateInv','=',1)->get();
        $notgenerate = Usage::where('isGenerateInv','=',0)->get();
        $usages = Usage::all();
        return view('admin.invoice.index',compact('invoices','isgenerate','notgenerate','usages'));
    }
    public function inv()
    {
        $invoices = Invoice::all();
        $isprinted = Invoice::where('printed','=',1)->get();
        $notprinted = Invoice::where('printed','=',0)->get();
        return view('admin.invoice.inv',compact('invoices','isprinted','notprinted'));
    }
    public function invoice()
    {
        $unitPrice = SetValue::where('id','=',1)->where('status','=',1)->first();
        //dd($unitPrice);
        $discount = SetValue::where('id','=',2)->where('status','=',1)->first();
        //dd($discount);
        $tax = SetValue::where('id','=',3)->where('status','=',1)->first();
        
        $maintenance = SetValue::where('id','=',4)->where('status','=',1)->first();
        $sewerage = SetValue::where('id','=',5)->where('status','=',1)->first();
        $rounding = SetValue::where('id','=',6)->where('status','=',1)->first();
        $notprinted = Invoice::where('printed','=',0)->get();
        // echo('test');
        return view('admin.invoice.invoice',compact('unitPrice','discount','tax','maintenance','sewerage','rounding','notprinted'));
        
        // $pdf = new Dompdf();
        // // $htmls='<html><body>';
        // // foreach ($notprinted as $printe) {
        // //    $htmls.=$printe->id.'<br>';
        // // }
        // // $htmls.='</body></html>';
        // // dd($htmls);
        // $file='D:\invoice.html';

        // $html=file_get_contents($file);
        // //dd($html);
        // $pdf->load_html($html);
        // $pdf->set_option('enable_remote', TRUE);
        // $pdf->setPaper('A4', 'portrait');
        // $pdf->set_option('isHtml5ParserEnabled', true);
        // $pdf->render();
        // //dd($pdf);
        // return $pdf->stream();
         
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('name','id')->all();
        return view('admin.invoice.create',compact('customers'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoices = new Invoice;
        $notgenerate = Usage::where('isGenerateInv','=',0)->get();
        $now = Carbon::now();       
        $unitPrice = SetValue::where('id','=',1)->where('status','=',1)->value('value');
        $discount = SetValue::where('id','=',2)->where('status','=',1)->value('value');
        $tax = SetValue::where('id','=',3)->where('status','=',1)->value('value');
        $meterMaintenance = SetValue::where('id','=',4)->where('status','=',1)->value('value');
        $sewerageCharge = SetValue::where('id','=',5)->where('status','=',1)->value('value');
        if($notgenerate->isEmpty())
        {
             return redirect()->back()->with('warning','Nothing invoices to be generate!');
        }else{
            foreach ($notgenerate as $no) {
                $amount = null;
                $Vdis = null;
                $Vtax = null;
                $VMaintenance = null;
                $VsewerageCharge = null;
                $total = null;
                $round = null;
                $totalAmount = null;
                $amount = ($no->endNo-$no->startNo)*$unitPrice;
                $Vdis = $discount*$amount/100;
                $Vtax = $tax*$amount/100;              
                $VMaintenance = $meterMaintenance*2;
                $VsewerageCharge = $sewerageCharge*$amount/100;
                $total = $amount+$Vdis+$Vtax+$VMaintenance+$VsewerageCharge;
                if(substr($total, -2,2)>0){
                    $round = 100-substr($total, -2,2);
                    $totalAmount = $total+$round;
                }else
                {
                    $totalAmount = $total;
                }
                $data = array('usage_id' =>$no->id ,
                                'customer_id' =>$no->customer_id ,
                                'numUsed' =>$no->endNo-$no->startNo ,
                                'invDate' =>$now , 
                                'startDate' =>$no->startDate ,
                                'endDate' =>$no->endDate ,
                                'invExpireDate' =>$now ,
                                'unitPrice' =>$unitPrice,
                                'discount' =>$discount,
                                'tax' => $tax,
                                'meterMaintenance'=>$meterMaintenance,
                                'sewerageCharge'=>$sewerageCharge,
                                'amount'=>$amount,
                                'totalAmount' =>$totalAmount,
                                'rounding'=>$round,
                                'invStatuts' =>0,
                                'printed' =>0,
                                'user_id' =>Auth::user()->id);
                Usage::where('id', '=', $no->id)->update(array('isGenerateInv' => 1));
                Invoice::create($data);

            }  
            return redirect('admin/inv')->with('message','This invoices has been generated successfully!');
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
}
