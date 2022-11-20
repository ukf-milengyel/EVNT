<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message = null)
    {
        // create query

        return view('tag.index', [
            'tags' => Tag::all(),
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
        $tag->save();

        // todo: redirect to event page
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

        return $this->index('Tag '.$validated['name'].' bol upravený.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        // odstránime tag
        $this->authorize('delete', $tag);

        $name = $tag->name;
        $tag->delete();

        return $this->index('Tag '.$name.' bol odstránený.');
        return redirect(route('tag.index'));
    }
}
