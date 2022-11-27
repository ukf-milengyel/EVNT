<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Event;
use App\Models\User;
use App\Models\Image as ImageModel;
use App\Models\Attachment as FileModel;
use App\Models\Tag;
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

        // only show my events?
        $uid = $request->user()->id;
        $my = $request->get('my') ?? 0;
        switch ($my){
            case 1:
                // attended
                $events->whereHas('user_a', function($query) use($uid){
                    $query->where('user_id', $uid);
                });
                break;
            case 2:
                // created
                $events->where('user_id', $uid);
                break;
        }

        // filter out tags?
        $tags = $request->tags ?? [];
        if ($tags){
            $events->whereHas('tag', function($query) use($tags){
                $query->whereIn('event_has_tag.tag_id', $tags);
            });
        }

        $events->orderBy($orders[$order] ,$sorts[$sort]);

        if ($events->count() == 0)
            $message = 'Zvoleným filtrom nezodpovedajú žiadne podujatia.';

        return view('event.index', [
            'events' => $events->get(),
            'tags' => Tag::all()->sortBy('name'),
            'message' => $message,
            'order' => $order,
            'sort' => $sort,
            'archived' => $archived,
            'my' => $my,
            'selectedTags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Event::class);

        $tags = Tag::where('user_id', $request->user()->id)->orderBy('name')->get()->merge(
            Tag::where('user_id', '!=', $request->user()->id)->orderBy('name')->get()
        );

        return view('event.add', [
            'tags' => $tags,
        ]);
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

        // save tags
        $limit = 10;
        foreach ($request->tags ?? [] as $tag){
            if ($limit-- == 0) break;
            $event->tag()->attach($tag);
        }

        return $this->index($request, 'Vytvorili ste podujatie '.$validated['name'].', naplánované na '.$validated['date']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id, $message = null)
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
            'message' => $message,
            'images' => ImageModel::where('event_id', $event->id)->get(),
            'files' => FileModel::where('event_id', $event->id)->get(),
            'share_message' => $share_message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, Event $event)
    {
        $this->authorize('create', Event::class);

        $tags = Tag::where('user_id', $request->user()->id)->orderBy('name')->get()->merge(
            Tag::where('user_id', '!=', $request->user()->id)->orderBy('name')->get()
        );

        $selected = collect($event->tag()->get())->map( function ($tag, $key){
            return $tag->id;
        })->toArray();

        return view('event.edit', [
            'event' => $event,
            'tags' => $tags,
            'selectedTags' => $selected,
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
            'image' => 'image|mimes:jpg,jpeg,png|max:8192'
        ]);

        if (isset($request->image)){
            $imgname = uniqid('', true) . ".jpg";

            Image::make($request->image)->fit(400,300)->save(public_path('images/event_thumb/'.$imgname), 75, 'jpg');
            Image::make($request->image)->save(public_path('images/event/'.$imgname), 90, 'jpg');

            // delete old image
            if ($event->image != "0.jpg")
                File::delete(['images/event_thumb/'.$event->image, 'images/event/'.$event->image]);

            $event->image = $imgname;
        }

        $event->name = $validated['name'];
        $event->description = $validated['description'];
        $event->date = $validated['date'];
        $event->organizer = $validated['organizer'];
        $event->location_name = $validated['location_name'];
        $event->location_address = $validated['location_address'];
        $event->save();

        // save tags
        $event->tag()->detach();
        $limit = 10;
        foreach ($request->tags ?? [] as $tag){
            if ($limit-- == 0) break;
            $event->tag()->attach($tag);
        }

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

    public function storeImage(Request $request){
        $this->authorize('create', ImageModel::class);

        $eid = $request["event_id"];
        //$this->authorize('create', Image::class);

        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:8192',
        ]);

        foreach ($request->file("images") as $image){
            // store in public folder
            $imgname = uniqid('', true) . '.jpg';
            Image::make($image)->fit(200,150)->save(public_path('images/image_thumb/'.$imgname), 75, 'jpg');
            Image::make($image)->save(public_path('images/image/'.$imgname), 90, 'jpg');

            // add db entry
            ImageModel::create([
                'event_id' => $eid,
                'filename' => $imgname,
            ]);
        }
        return $this->show($request, $eid, "Fotografie boli pridané.");
    }

    public function deleteImage(Request $request){
        $model = ImageModel::findOrFail( $request->json()->get("id") );

        //return "uid" . $model->event->user->id;
        $this->authorize('delete', $model);

        $imgname = $model->filename;

        $model->delete();
        File::delete(['images/image_thumb/'.$imgname, 'images/image/'.$imgname]);

        return "1";
    }

    public function storeFile(Request $request){
        $this->authorize('create', Attachment::class);

        $eid = $request["event_id"];

        $this->validate($request, [
            'files' => 'required',
            'files.*' => 'file|max:2048',
        ]);

        foreach ($request->file("files") as $file){
            // store in public folder
            $name = uniqid() ."_". $file->getClientOriginalName();
            $file->move(public_path('files'), $name);

            // add db entry
            FileModel::create([
                'event_id' => $eid,
                'filename' => $name,
            ]);
        }

        return $this->show($request, $eid, "Súbory boli pridané.");
    }

    public function deleteFile(Request $request){
        $model = FileModel::findOrFail( $request->json()->get("id") );

        $this->authorize('delete', $model);

        $filename = $model->filename;

        $model->delete();
        File::delete(['files/'.$filename, 'images/image/'.$filename]);

        return "1";
    }

}
