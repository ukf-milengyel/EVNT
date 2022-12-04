<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // vrátime zoznam všetkých oznámení, alternatívne len oznámenia ktoré sa vzťahujú na používateľa
        return view("announcement.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // formulár existuje v zobrazení podujatia, táto metóda je nepotrebná
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // uložíme nové oznámenia na základe dát z requestu
        $this->authorize('create', Announcement::class);

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
            'image' => 'image|mimes:jpg,jpeg,png|max:8192'
        ]);

        $announcement = new Announcement();
        $announcement->body = $validated['body'];
        $announcement->event_id = $request["event_id"];

        if ($image = $request->image){
            // store in public folder
            $imgname = uniqid('', true) . '.jpg';
            Image::make($image)->fit(200,150)->save(public_path('images/announcement_thumb/'.$imgname), 75, 'jpg');
            Image::make($image)->save(public_path('images/announcement/'.$imgname), 90, 'jpg');

            $announcement->image = $imgname;
        }

        $announcement->save();

        $controller = new EventController();
        return $controller->show($request, $request["event_id"], "Oznámenie bolo vytvorené.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // zoznam oznámení treba dať do controllera k zobrazeniu podujatia, táto metóda je nepotrebná
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // zobrazíme formulár na úpravu oznámenia
        return view("announcement.edit");
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
        // upravíme dané oznámenie na základe dát z requestu
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // odstránenie daného oznámenia
    }
}
