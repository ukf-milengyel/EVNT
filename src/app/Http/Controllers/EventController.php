<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // temporary fix, todo: allow ordering of events by date, tags, etc...
        $sort = $request->get('sort') ?? 1;
        $sorts = ["asc", "desc"];

        return view('event.index', [
            'events' => Event::orderBy('date' ,$sorts[$sort])->get(),
            'sort' => $sorts[$sort],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Event::class);
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
        $this->authorize('create', Event::class);

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
        return view('event.view', [
            'event' => Event::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Event::class);
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
        $this->authorize('update', Event::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Event::class);
    }
}
