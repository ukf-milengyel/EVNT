<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // todo: replace stub values

        return view('statistics', [
            'users' => User::count(),
            'groups' => Group::count(),
            'events' => Event::count(),
            'attendants' => DB::table("user_attends_event")->selectRaw("count(*)")->value(0),
            'photos' => 320,
            'attachments' => 60,
        ]);
    }
}
