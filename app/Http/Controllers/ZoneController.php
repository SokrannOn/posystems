<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zone;
use Illuminate\Support\Facades\Input;
use Auth;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $zones = Zone::all();
        return view('admin.zone.index',compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zone.create');
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
        ]);
            $zone = new Zone;
            $zone->name = Input::get("name");     
            $zone->description = Input::get("description");
            $zone->user_id = Auth::user()->id;
            $zone->save();
            return redirect()->route('zones.index')->with('message','This new zone has been created successfully!');
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
         $zone = zone::findOrFail($id);
        return view('admin.zone.edit',compact('zone'));
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
        ]);
            $zone = Zone::findOrFail($id);
            $zone->name = Input::get("name");     
            $zone->description = Input::get("description");
            $zone->user_id = Auth::user()->id;
            $zone->save();
            return redirect()->route('zones.index')->with('message','This zone has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);
        $zone->delete();
        return redirect()->route('zones.index')->with('message','This zone has been deleted successfully!');
    }
}
