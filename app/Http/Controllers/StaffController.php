<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\Input;
use Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('admin.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
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
            'sex' => 'required',
            'address' => 'required|string',
            'contactNo' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:staffs',
            'ssid' => 'required|string|min:8',
            'position' => 'required|string',
            'salary' => 'required|numeric',
        ]);

            $staff = new Staff;
            $staff->user_id = Auth::user()->id;
            $staff->name = Input::get("name");     
            $staff->sex = Input::get("sex");
            $staff->address = Input::get("address");
            $staff->contactNo = Input::get("contactNo");
            $staff->email = Input::get("email");
            $staff->ssid = Input::get("ssid");
            $staff->position = Input::get("position");
            $staff->salary = Input::get("salary");
            $staff->save();
            return redirect()->route('staffs.index')->with('message','This new staff has been created successfully!');
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
         $staff = Staff::findOrFail($id);
        //dd($staffs);
        //$roles = Role::pluck('name','id')->all();
        return view('admin.staff.edit',compact('staff'));
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
            'sex' => 'required',
            'address' => 'required|string',
            'contactNo' => 'required|string|min:8',
            'ssid' => 'required|string|min:8',
            'position' => 'required|string',
            'salary' => 'required|numeric',
        ]);
            $staff = Staff::findOrFail($id);
            $staff->name = Input::get("name");     
            $staff->sex = Input::get("sex");
            $staff->address = Input::get("address");
            $staff->contactNo = Input::get("contactNo");
            $staff->email = Input::get("email");
            $staff->ssid = Input::get("ssid");
            $staff->position = Input::get("position");
            $staff->salary = Input::get("salary");
            $staff->save();
            return redirect()->route('staffs.index')->with('message','This staff has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();
        return redirect()->route('staffs.index')->with('message','This staff has been deleted successfully!');

    }
}