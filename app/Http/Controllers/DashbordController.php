<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Purchaseorder;
use Carbon\Carbon;
class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->position->name == 'Superuser'){
            $today = Carbon::now()->toDateString();
            $countpocus = PurchaseOrder::where('poDate','=',$today)->where('customer_id','!=',null)->where('isGenerate','=',0)->get()->count();
            $countposd = PurchaseOrder::where('poDate','=',$today)->where('customer_id','=',null)->where('isGenerate','=',0)->get()->count();
            $countinvoices = PurchaseOrder::where('isGenerate','=',1)->where('isDelivery','=',0)->get()->count(); 
            $countexported = PurchaseOrder::where('isDelivery','=',1)->get()->count();
            $countpaid = PurchaseOrder::where('isPayment','=',1)->get()->count();
            $countunpaid = PurchaseOrder::where('isPayment','=',0)->where('isGenerate','=',1)->get()->count();
            return view('admin.dashbord.index',compact('countpocus','countposd','countinvoices','countexported','countpaid','countunpaid'));
        }elseif (Auth::user()->position->name == 'Administrator') {
            $today = Carbon::now()->toDateString();
            $countpocus = PurchaseOrder::where('poDate','=',$today)->where('customer_id','!=',null)->where('isGenerate','=',0)->get()->count();
            $countposd = PurchaseOrder::where('poDate','=',$today)->where('customer_id','=',null)->where('isGenerate','=',0)->get()->count();
            $countinvoices = PurchaseOrder::where('isGenerate','=',1)->where('isDelivery','=',0)->get()->count(); 
            $countexported = PurchaseOrder::where('isDelivery','=',1)->get()->count();
            $countpaid = PurchaseOrder::where('isPayment','=',1)->get()->count();
            $countunpaid = PurchaseOrder::where('isPayment','=',0)->where('isGenerate','=',1)->get()->count();
            return view('admin.dashbord.index',compact('countpocus','countposd','countinvoices','countexported','countpaid','countunpaid'));
        }elseif (Auth::user()->position->name == 'Accountant') {
            $today = Carbon::now()->toDateString();
            $countpocus = PurchaseOrder::where('poDate','=',$today)->where('customer_id','!=',null)->where('isGenerate','=',0)->get()->count();
            $countposd = PurchaseOrder::where('poDate','=',$today)->where('customer_id','=',null)->where('isGenerate','=',0)->get()->count();
            $countinvoices = PurchaseOrder::where('isGenerate','=',1)->where('isDelivery','=',0)->get()->count(); 
            $countexported = PurchaseOrder::where('isDelivery','=',1)->get()->count();
            $countpaid = PurchaseOrder::where('isPayment','=',1)->get()->count();
            $countunpaid = PurchaseOrder::where('isPayment','=',0)->where('isGenerate','=',1)->get()->count();
            return view('admin.dashbord.index',compact('countpocus','countposd','countinvoices','countexported','countpaid','countunpaid'));
        }elseif (Auth::user()->position->name == 'Stock') {
            $today = Carbon::now()->toDateString();
            $countpocus = PurchaseOrder::where('poDate','=',$today)->where('customer_id','!=',null)->where('isGenerate','=',0)->get()->count();
            $countposd = PurchaseOrder::where('poDate','=',$today)->where('customer_id','=',null)->where('isGenerate','=',0)->get()->count();
            $countinvoices = PurchaseOrder::where('isGenerate','=',1)->where('isDelivery','=',0)->get()->count(); 
            $countexported = PurchaseOrder::where('isDelivery','=',1)->get()->count();
            $countpaid = PurchaseOrder::where('isPayment','=',1)->get()->count();
            $countunpaid = PurchaseOrder::where('isPayment','=',0)->where('isGenerate','=',1)->get()->count();
            return view('admin.dashbord.index',compact('countpocus','countposd','countinvoices','countexported','countpaid','countunpaid'));
        }elseif (Auth::user()->position->name == 'Sale') {
         $pocuss = PurchaseOrder::where('customer_id','!=',null)->where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrder.index',compact('pocuss'));
        }elseif (Auth::user()->position->name == 'SD') {
         $posds = PurchaseOrder::where('customer_id','=',null)->where('user_id','=',Auth::user()->id)->get();
        return view('admin.purchaseOrderSD.index',compact('posds'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
