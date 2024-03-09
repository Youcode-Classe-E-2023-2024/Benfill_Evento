<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $events = Event::where('status', 'published')->paginate(10);
        $categories = Category::all();
        $gallery = Event::where('status', 'published')->orderBy('reservationCount', 'desc')
            ->take(5)
            ->get();
        $gallery = count($gallery) != 0 ? $gallery : Event::where('status', 'published')->take(5)->get();
        return view('pages.front_office.home',
            [
                'events' => $events,
                'categories' => $categories,
                'gallery' => $gallery
            ]);
    }
}
