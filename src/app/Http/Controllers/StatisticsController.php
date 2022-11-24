<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use App\Models\Image;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function statistics()
    {
        return view('statistics', $this->getStatistics());
    }

    public function index()
    {
        return view('welcome', $this->getStatistics());
    }

    // todo: replace stub values
    private function getStatistics() : array
    {
        return array(
            'users' => User::count(),
            'groups' => Group::count(),
            'events' => Event::count(),
            'attendants' => DB::table("user_attends_event")->selectRaw("count(*)")->value(0),
            'photos' => Image::count(),
            'attachments' => Attachment::count(),
        );
    }
}
