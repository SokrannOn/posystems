<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\District;
use Auth;
use Illuminate\Support\Facades\Input;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commune = Commune::all();
        $districts = District::pluck('name','id')->all();
        return view('admin.commune.index',compact('commune','districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::pluck('name','id')->all();
        return view('admin.commune.create',compact(('districts')));
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
            'district_id' => 'required|string',
        ]);
            $commune = new Commune;
            $commune->user_id = Auth::user()->id;
            $commune->name = Input::get("name");     
            $commune->district_id = Input::get("district_id");
            $commune->save();
            return redirect()->route('communes.index')->with('message','This commune has been created successfully!');
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
        $commune = Commune::findOrFail($id);
        $districts = District::pluck('name','id')->all();
        return view('admin.commune.edit',compact('commune','districts'));
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
            'district_id' => 'required|string',
        ]);
            $commune = Commune::findOrFail($id);
            $commune->name = Input::get("name");     
            $commune->district_id = Input::get("district_id");
            $commune->save();
            return redirect()->route('communes.index')->with('message','This commune has been updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commune = Commune::findOrFail($id);
        $commune->delete();
        return redirect()->route('communes.index')->with('message','This commune has been deleted successfully!');
    }
}
