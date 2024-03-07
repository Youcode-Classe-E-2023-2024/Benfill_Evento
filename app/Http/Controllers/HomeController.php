<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        $events = Event::where('status', 'published')->get();
        return view('pages.front_office.home',
        [
            'events' => $events,

        ]);
    }
}
