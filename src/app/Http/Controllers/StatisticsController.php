<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
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
