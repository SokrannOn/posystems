<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usage;
use App\Customer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Auth;

class UsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usage = Usage::all();
        $customers = Customer::pluck('name','id')->all();
        return view('admin.usage.index',compact('usage','customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $cusemail = Customer::select('email')->where('id','=',$request->customer_id)->get();

        // dd($cusemail);
        $customers = Customer::pluck('name','id')->all();
        return view('admin.usage.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'customer_id'=>'required',
            'startNo'=>'required|numeric',
            'endNo'=>'required|numeric',
            'startDate'=>'required',
            'endDate'=>'required',
            'isGenerateInv'=>'required',
        ]);
            $usage = new Usage;
            $usage->customer_id = Input::get("customer_id");     
            $usage->startNo = Input::get("startNo");
            $usage->endNo = Input::get("endNo");
            $usage->startDate = Input::get("startDate");
            $usage->endDate = Input::get("endDate");
            $usage->isGenerateInv = Input::get("isGenerateInv");
            $usage->user_id = Auth::user()->id;
            $usage->save();
            return redirect()->route('usages.index')->with('message','This new usage has been created successfully!');
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
        $usage = Usage::findOrFail($id);
        $customers = Customer::pluck('name','id')->all();
         return view('admin.usage.edit',compact('usage','customers'));
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
        $this->validate($request,[
            'customer_id'=>'required',
            'startNo'=>'required|numeric',
            'endNo'=>'required|numeric',
            'startDate'=>'required',
            'endDate'=>'required',
            'isGenerateInv'=>'required',
        ]);
            $usage = Usage::findOrFail($id);
            $usage->customer_id = Input::get("customer_id");     
            $usage->startNo = Input::get("startNo");
            $usage->endNo = Input::get("endNo");
            $usage->startDate = Input::get("startDate");
            $usage->endDate = Input::get("endDate");
            $usage->isGenerateInv = Input::get("isGenerateInv");
            $usage->user_id = Auth::user()->id;
            $usage->save();
         return redirect()->route('usages.index')->with('message','This usage has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usage = Usage::findOrFail($id);
         $usage->delete();
         return redirect()->route('usages.index')->with('message','This usage has been deleted successfully!');    }
}
