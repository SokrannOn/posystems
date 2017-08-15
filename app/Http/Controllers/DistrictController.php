<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Province;
use Auth;
use Illuminate\Support\Facades\Input;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $district = District::all();
         $provinces = Province::pluck('name','id')->all();
        return view('admin.district.index',compact('district','provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::pluck('name','id')->all();
        return view('admin.district.create',compact(('provinces')));
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
            'name' => 'required|string',
            'province_id' => 'required|string',
        ]);
            //dd(Input::get("name"));
            $district = new District;
            $district->user_id = Auth::user()->id;
            $district->name = Input::get("name");     
            $district->province_id = Input::get("province_id");
            $district->save();
            return redirect()->route('districts.index')->with('message','This new district has been created successfully!');
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
        $district = District::findOrFail($id);
        $provinces = Province::pluck('name','id')->all();
        return view('admin.district.edit',compact('district','provinces'));
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
            'name' => 'required|string',
            'province_id' => 'required|string',
        ]);
            $district = District::findOrFail($id);
            $district->name = Input::get("name");     
            $district->province_id = Input::get("province_id");
            $district->save();
            return redirect()->route('districts.index')->with('message','This district has been updated successfully!');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();
        return redirect()->route('districts.index')->with('message','This district has been deleted successfully!');
    }
}
