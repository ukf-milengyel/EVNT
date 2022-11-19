<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $message = null)
    {
        $orders = ['created_at', 'date', 'name'];
        $order = ($request->get('order') ?? 0) % count($orders);

        $sorts = ['asc', 'desc'];
        $sort = ($request->get('sort') ?? 1) % count($sorts);

        $archiveds = ['>', '<'];
        $archived = ($request->get('archived') ?? 0) % count($archiveds);

        // create query
        $events = Event::whereDate('date', $archiveds[$archived], now());

        // only show attended events?
        $uid = $request->user()->id;
        $my = $request->get('my') ?? 0;
        if ($my)
            $events->whereHas('user_a', function($query) use($uid){
                $query->where('user_id', $uid);
            });

        $events->orderBy($orders[$order] ,$sorts[$sort]);

        if ($events->count() == 0)
            $message = 'Zvoleným filtrom nezodpovedajú žiadne podujatia.';

        return view('event.index', [
            'events' => $events->get(),
            'message' => $message,
            'order' => $order,
            'sort' => $sort,
            'archived' => $archived,
            'my' => $my,
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
        Image::make($request->image)->fit(400,300)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
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
        return $this->index($request, 'Vytvorili ste podujatie '.$validated['name'].', naplánované na '.$validated['date']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $event = Event::findOrFail($id);
        $share_message =
            sprintf(
                "%s sa bude na %s konať %s! Teším sa na stretnutie s vami!",
                \Carbon\Carbon::parse($event->date)->format('d.m.Y o h:i'),
                $event->location_name,
                $event->name
            );

        return view('event.view', [
            'event' => $event,
            'attends' => User::find($request->user()->id)->event_a->where('id', $id)->count(),
            'attend_count' => $event->user_a->count(),
            'share_message' => $share_message
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Event $event)
    {
        $this->authorize('create', Event::class);

        return view('event.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'date' => 'date|required',
            'organizer' => 'string|max:255|nullable',
            'location_name' => 'string|max:255',
            'location_address' => 'string|max:255|nullable',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:8192'
        ]);

        // todo: figure out why image upload is broken
        $imgname = uniqid('', true) . ".jpg";

        Image::make($request->image)->fit(400,300)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
        Image::make($request->image)->save(public_path('images/event/'.$imgname), 90, 'jpg');

        $oldname = $event->image;

        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->user_id = $request->user()->id;
        $event->date = $validated['date'];
        $event->organizer = $validated['organizer'];
        $event->location_name = $validated['location_name'];
        $event->location_address = $validated['location_address'];
        $event->image = $imgname;
        $event->save();

        // delete old image
        if ($oldname != "0.jpg")
            File::delete(['images/event_thumb/'.$oldname, 'images/event/'.$oldname]);

        return $this->show($request, $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        // todo: delete all associated images and files
        $imgname = $event->image;

        $event->delete();
        if ($imgname != "0.jpg")
            File::delete(['images/event_thumb/'.$imgname, 'images/event/'.$imgname]);

        return view('reload_parent');
    }

    public function attendEvent(Request $request)
    {
        $uid = $request->user()->id;
        $eid = $request->event_id;

        $user = User::find($uid);
        $model = $user->event_a()->find($eid);

        if ($model != null)
            $user->event_a()->detach($eid);
        else
            $user->event_a()->attach($eid);

        return redirect()->back();
    }

}
