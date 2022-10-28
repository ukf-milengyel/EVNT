<?php

namespace App\Http\Controllers;

class StatisticsController extends Controller
{
    public function index()
    {
        // stub!

        return view('statistics', [
            'users' => 10,
            'groups' => 3,
            'events' => 40,
            'attendants' => 200,
            'photos' => 320,
            'attachments' => 60,
        ]);
    }
}
