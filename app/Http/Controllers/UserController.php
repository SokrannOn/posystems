<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Position;
use App\Brand;
use Auth;
use App\Zone;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('userStatus','!=',1)->get();
        $positions = Position::pluck('name','id')->all();
        $brands = Brand::pluck('brandName','id')->all();
        $zones = Zone::pluck('name','id')->all();
        return view('admin.user.index',compact('users','positions','zones','brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::pluck('name','id')->all();
        $brands = Brand::pluck('brandName','id')->all();
        $zones = Zone::pluck('name','id')->all();
        return view('admin.user.create',compact('positions','zones','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//dd($request->all());
        $this->validate($request,[
            'nameDisplay'=>'required',
            'name'=>'required',
            'sex'=>'required',
            'password' => 'required|string|min:6|confirmed',
                    ]);
        User::create([
            'nameDisplay' => $request->nameDisplay,
            'sex' => $request->sex,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contactNum' => $request->contactNum,
            'brand_id' => $request->brand_id,
            'position_id' => $request->position_id,
            'zone_id' => $request->zone_id,
            'userStatus' => 0,
        ]);
        return redirect()->route('users.index')->with('message','This new user has been created successfully!');
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
        $users = User::findOrFail($id);
        $positions = Position::pluck('name','id')->all();
        $brands = Brand::pluck('brandName','id')->all();
        $zones = Zone::pluck('name','id')->all();
        return view('admin.user.edit',compact('users','positions','zones','brands'));
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
            'nameDisplay'=>'required',
            'sex'=>'required',
        ]);
        $user = User::findOrFail($id);
        $user->nameDisplay = $request->nameDisplay;
        $user->sex = $request->sex;
        $user->contactNum = $request->contactNum;
        $user->brand_id = $request->brand_id;
        $user->position_id =$request->position_id;
        $user->zone_id =$request->zone_id;
        $user->save();
        return redirect()->route('users.index')->with('message','This user has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        if (Auth::user()->id != $id) {
            $user->userStatus=1;
            $user->save();
            return redirect()->route('users.index')->with('message','This Item Deleted Already');
        }else{
            return redirect()->route('users.index')->with('message','You can not delete yourself!');
        }  
    }
    public function reset($id){
         $users = User::findOrFail($id);
        return view('admin.user.reset',compact('users'));
    }
    public function updatepw(Request $request, $id){
        $this->validate($request,[
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->password =  bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index')->with('message','This user has been updated successfully!');
    }
     public function updateLog1($id)
    {
        $user = User::findOrFail($id);
        $user->is_log = 1;
        $user->save();
        return redirect()->route('users.index')->with('message','This user has been updated successfully!');
    }
    public function updateLog0($id)
    {
        $user = User::findOrFail($id);
        $user->is_log = 0;
        $user->save();
        return redirect()->route('users.index')->with('message','This user has been updated successfully!');
    }
}
