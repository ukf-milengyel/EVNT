<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message = null)
    {
        $this->authorize('viewAny', Group::class);

        return view('group.index', [
            'groups' => Group::all(),
            'message' => $message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Group::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
        ]);

        $permissions = $this->translatePerms($request);

        $group = new Group();
        $group->name = $validated['name'];
        $group->permissions = $permissions;
        $group->color = $validated['color'];
        $group->save();

        return $this->index('Skupina '.$validated['name'].' bola vytvorená.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $this->authorize('create', Group::class);

        return view('group.edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
        ]);

        $permissions = $this->translatePerms($request);

        $group->name = $validated['name'];
        $group->permissions = $permissions;
        $group->color = $validated['color'];

        $group->save();

        return $this->index('Skupina '.$validated['name'].' bola upravená.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $name = $group->name;
        $group->delete();

        return $this->index('Skupina '.$name.' bola odstránená.');
        return redirect(route('group.index'));
    }

    private function translatePerms(Request $request) : int{
        $result = 0;
        for($i=0; $i<5; ++$i){
            $current = pow(2, $i);
            $result += isset($request['check-'.$current]) ? $current : 0;
        }
        return $result;
    }
}
