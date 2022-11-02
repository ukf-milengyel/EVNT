<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // todo: authorize, policies

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'date' => 'required',
            'organizer' => 'string|max:255',
            'location_name' => 'string|max:255',
            'location_address' => 'string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:8192'
        ]);

        // todo: create compressed version of image with thumbnail before saving
        $imgname = uniqid('', true) . '.jpg';
        $request->image->move(public_path('images/event'), $imgname);

        $event = new Event();
        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->user_id = $request->user()->id;
        $event->date = $validated['date'];
        $event->organizer = $validated['organizer'];
        $event->location_name = $validated['location_name'];
        $event->location_address = $validated['location_address'];
        $event->image = $imgname;
        $event->save();

        // todo: redirect to event page
        return view('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('event.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('event.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
