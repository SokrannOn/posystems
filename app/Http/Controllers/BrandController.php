<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Support\Facades\Input;
use Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'brandCode' => 'required|string',
            'brandName' => 'required|string',
        ]);
            $brand = new Brand;
            $brand->brandCode = Input::get("brandCode");    
            $brand->brandName = Input::get("brandName");   
            $brand->description = Input::get("description");
            $brand->user_id = Auth::user()->id;
            $brand->save();
            return redirect()->route('brands.index')->with('message','This new brand has been created successfully!');
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
        $brands = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('brands'));
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
            'brandCode' => 'required|string',
            'brandName' => 'required|string',
        ]);
            $brand = Brand::findOrFail($id);
            $brand->brandCode = Input::get("brandCode");    
            $brand->brandName = Input::get("brandName");   
            $brand->description = Input::get("description");
            $brand->user_id = Auth::user()->id;
            $brand->save();
            return redirect()->route('brands.index')->with('message','This brand has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->route('brands.index')->with('message','This brand has been deleted successfully!');
    }
}
