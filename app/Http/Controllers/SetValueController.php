<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\SetValue;
use Auth;

class SetValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setvalues = SetValue::all();
        return view('admin.setvalue.index',compact('setvalues'));
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
        $setvalues = SetValue::findOrFail($id);
        return view('admin.setvalue.edit',compact('setvalues'));
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
            'value' => 'required|numeric',
        ]);
            $setvalues = SetValue::findOrFail($id);
            $setvalues->name = Input::get("name");   
            $setvalues->value = Input::get("value");  
            $setvalues->description = Input::get("description");
            $setvalues->user_id = Auth::user()->id;
            $setvalues->save();
            return redirect()->route('setValues.index')->with('message','This value has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setvalues = SetValue::findOrFail($id);
        if($setvalues->status==1){
            $setvalues->status=0;
            $setvalues->save();
        }else{
            $setvalues->status=1;
            $setvalues->save();
        }
        return redirect()->route('setValues.index')->with('message','This status has been changed successfully!');
    }
}
