<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Channel;
use Illuminate\Support\Facades\Input;
use Auth;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $channels = Channel::all();
        return view('admin.channel.index',compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.channel.create');
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
            $channel = new Channel;
            $channel->name = Input::get("name");     
            $channel->description = Input::get("description");
            $channel->user_id = Auth::user()->id;
            $channel->save();
            return redirect()->route('channels.index')->with('message','This new channel has been created successfully!');
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
        $channel = Channel::findOrFail($id);
        return view('admin.channel.edit',compact('channel'));
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
            $channel = Channel::findOrFail($id);
            $channel->name = Input::get("name");     
            $channel->description = Input::get("description");
            $channel->user_id = Auth::user()->id;
            $channel->save();
            return redirect()->route('channels.index')->with('message','This channel has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();
        return redirect()->route('channels.index')->with('message','This channel has been deleted successfully!');
    }
}
