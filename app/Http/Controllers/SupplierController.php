<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Auth;
use Illuminate\Support\Facades\Input;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'companyname' => 'required|string',
            'address' => 'required|string',
            'personname' => 'required|string',
        ]);
            $supplier = new Supplier;
            $supplier->companyname = Input::get("companyname");     
            $supplier->address = Input::get("address");
            $supplier->personname = Input::get("personname");     
            $supplier->contactperson = Input::get("contactperson");
            $supplier->email = Input::get("email");    
            $supplier->user_id = Auth::user()->id;
            $supplier->save();
            return redirect()->route('suppliers.index')->with('message','This new supplier has been created successfully!');
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
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit',compact('supplier'));
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
        $this->validate($request, [
             'companyname' => 'required|string',
            'address' => 'required|string',
            'personname' => 'required|string',
        ]);
            $supplier = Supplier::findOrFail($id);
            $supplier->companyname = Input::get("companyname");     
            $supplier->address = Input::get("address");
            $supplier->personname = Input::get("personname");     
            $supplier->contactperson = Input::get("contactperson");
            $supplier->email = Input::get("email");    
            $supplier->user_id = Auth::user()->id;
            $supplier->save();
            return redirect()->route('suppliers.index')->with('message','This supplier has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('message','This supplier has been deleted successfully!');
    }
}
