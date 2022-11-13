<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User_attends_event;
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
        // todo: sort events by tags, user count
        $categories = ['created_at', 'date', 'name'];
        $category = ($request->get('category') ?? 0) % count($categories);

        $sorts = ['asc', 'desc'];
        $sort = ($request->get('sort') ?? 1) % count($sorts);

        $archiveds = ['>', '<'];
        $archived = ($request->get('archived') ?? 0) % count($archiveds);

        $events = Event::whereDate('date', $archiveds[$archived], now())
            ->orderBy($categories[$category] ,$sorts[$sort])
            ->get();

        if ($events->count() == 0)
            $message = 'Zvoleným filtrom nezodpovedajú žiadne podujatia.';

        return view('event.index', [
            'events' => $events,
            'message' => $message,
            'category' => $category,
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
        Image::make($request->image)->fit(400)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
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
        return $this->index(new Request(), 'Vytvorili ste podujatie '.$validated['name'].', naplánované na '.$validated['date']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        return view('event.view', [
            'event' => Event::findOrFail($id),
            'attends' => User_attends_event::where('user_id', $request->user()->id)->where('event_id', $id)->count(),
            'attend_count' => User_attends_event::where('event_id', $id)->count()
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

        $permissions = $this->translatePerms($request);

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
        Image::make($request->image)->fit(400)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
        Image::make($request->image)->save(public_path('images/event/'.$imgname), 90, 'jpg');

        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->user_id = $request->user()->id;
        $event->date = $validated['date'];
        $event->organizer = $validated['organizer'];
        $event->location_name = $validated['location_name'];
        $event->location_address = $validated['location_address'];
        $event->image = $imgname;
        $event->save();

        return $this->index('Event '.$validated['name'].' bol upravený.');
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

        $name = $event->name;
        $event->delete();

        return $this->index('Event '.$name.' bol odstránený.');
        return redirect(route('event.index'));
    }

    public function attendEvent(Request $request)
    {
        $uid = $request->user()->id;
        $eid = $request->event_id;

        $model = User_attends_event::where('user_id', $uid)->where('event_id', $eid);
        if ($model->count() == 0){
            $attend = new User_attends_event;
            $attend->user_id = $uid;
            $attend->event_id = $eid;
            $attend->save();
        }else{
            $model->delete();
        }

        return redirect()->back();
    }

}
