<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Village;
use App\Commune;
use Illuminate\Support\Facades\Input;
use Auth;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $village = Village::all();
         $communes = Commune::pluck('name','id')->all();
        return view('admin.village.index',compact('village','communes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::pluck('name','id')->all();
        return view('admin.village.create',compact(('communes')));
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
            // 'id' => 'required|string|max:255',
            'name' => 'required|string',
            'commune_id' => 'required|string',
        ]);
            //dd(Input::get("name"));
            $village = new Village;
            $village->user_id = Auth::user()->id;
            $village->name = Input::get("name");     
            $village->commune_id = Input::get("commune_id");
            $village->save();
            return redirect()->route('villages.index')->with('message','This new village has been created successfully!');
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
        $village = Village::findOrFail($id);
        //dd($villages);
        //$roles = Role::pluck('name','id')->all();
        $communes = Commune::pluck('name','id')->all();
        return view('admin.village.edit',compact('village','communes'));
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
            'commune_id' => 'required|string',
        ]);
            $village = Village::findOrFail($id);
            $village->name = Input::get("name");     
            $village->commune_id = Input::get("commune_id");
            $village->save();
            return redirect()->route('villages.index')->with('message','This village has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $village = Village::findOrFail($id);
        $village->delete();
        return redirect()->route('villages.index')->with('message','This village has been deleted successfully!');
    }
}
