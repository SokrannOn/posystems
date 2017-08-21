<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pricelist;
use App\Product;
use Auth;
use Illuminate\Support\Facades\Input;
class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricelists = Pricelist::all();
        $products = Product::pluck('name','id')->all();
        return view('admin.pricelist.index',compact('pricelists','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('name','id')->all();
        return view('admin.pricelist.create',compact('products'));
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
            'product_id' => 'required',
            'fobprice' => 'required|numeric',
            'margin' => 'required|numeric',
            'landingprice' => 'required|numeric',
            'sellingprice' => 'required|numeric',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);
            $pricelist = new Pricelist;
            $pricelist->product_id = Input::get("product_id");     
            $pricelist->fobprice = Input::get("fobprice");
            $pricelist->margin = Input::get("margin");     
            $pricelist->landingprice = Input::get("landingprice");
            $pricelist->sellingprice = Input::get("sellingprice");   
            $pricelist->startdate = Input::get("startdate");
            $pricelist->enddate = Input::get("enddate");   
            $pricelist->user_id = Auth::user()->id;
            $pricelist->save();
            return redirect()->route('pricelists.index')->with('message','This new Price has been created successfully!');
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
        $pricelist = Pricelist::findOrFail($id);
        $products = Product::pluck('name','id')->all();
        return view('admin.pricelist.edit',compact('pricelist','products'));
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
            'product_id' => 'required',
            'fobprice' => 'required|numeric',
            'margin' => 'required|numeric',
            'landingprice' => 'required|numeric',
            'sellingprice' => 'required|numeric',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);
            $pricelist = Pricelist::findOrFail($id);
            $pricelist->product_id = Input::get("product_id");     
            $pricelist->fobprice = Input::get("fobprice");
            $pricelist->margin = Input::get("margin");     
            $pricelist->landingprice = Input::get("landingprice");
            $pricelist->sellingprice = Input::get("sellingprice");   
            $pricelist->startdate = Input::get("startdate");
            $pricelist->enddate = Input::get("enddate");   
            $pricelist->user_id = Auth::user()->id;
            $pricelist->save();
            return redirect()->route('pricelists.index')->with('message','This price list has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pricelist = Pricelist::findOrFail($id);
        $pricelist->delete();
        return redirect()->route('pricelists.index')->with('message','This price list has been deleted successfully!');
    }
}
