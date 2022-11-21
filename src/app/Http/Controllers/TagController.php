<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, String $message = null)
    {
        // create query
        // todo: only show tags created by the current user
        $this->authorize('create', Tag::class);

        $tags =
            auth()->user()->can('viewAny', User::class)
            ? Tag::all()
            : Tag::where('user_id', $request->user()->id)->get();

        return view('tag.index', [
            'tags' => $tags,
            'message' => $message,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // zobrazíme formulár na vytvorenie tagu
        $this->authorize('create', Tag::class);
        return view("tag.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // uložíme nový tag
        $this->authorize('create', Tag::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = new Tag();
        $tag->name = $validated['name'];
        $tag->user_id = $request->user()->id;
        $tag->save();

        return $this->index($request, 'Vytvorili ste tag '.$validated['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // nepotrebná metóda, všetky tagy zobrazujeme na indexe
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $this->authorize('create', Tag::class);

        return view('tag.edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // aktualizujeme daný tag
        $this->authorize('update', $tag);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->name = $validated['name'];

        $tag->save();

        return $this->index($request, 'Tag '.$validated['name'].' bol upravený.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tag $tag)
    {
        // odstránime tag
        $this->authorize('delete', $tag);

        $name = $tag->name;
        $tag->delete();

        return $this->index($request, 'Tag '.$name.' bol odstránený.');
    }
}
