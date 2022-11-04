<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // todo: sort events by tags
        $sorts = ["asc", "desc"];
        $sort = ($request->get('sort') ?? 1) % count($sorts);

        $archiveds = [">", "<"];
        $archived = ($request->get('archived') ?? 0) % count($archiveds);

        return view('event.index', [
            'events' => Event::whereDate('date', $archiveds[$archived], now())->orderBy('created_at' ,$sorts[$sort])->get(),
            'sort' => $sort,
            'archived' => $archived,
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
            'date' => 'date|required',
            'organizer' => 'string|max:255|nullable',
            'location_name' => 'string|max:255',
            'location_address' => 'string|max:255|nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:8192'
        ]);

        $imgname = uniqid('', true) . '.jpg';
        Image::make($request->image)->fit(512,288)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
        Image::make($request->image)->save(public_path('images/event/'.$imgname), 90, 'jpg');

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
        return $this->index(new Request());
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
