<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('pages.front_office.event', compact('categories', 'locations'));
    }

    function create()
    {

    }

    function store(Request $request)
    {
        Event::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'picture' => $request['picture'],
            'event_location' => $request['location'],
            'category_id' => $request['category'],
            'places' => $request['places'],
            'price' => $request['price'],
            'organizer' => $request['organizer'],
            'status' => $request['satus'],
            'date' => $request['date'],
            'slug' => Str::slug($request['title'], '-')
        ]);
    }

    function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->get();
        return view('pages.front_office.eventContent', compact('event'));
    }

    function update(Request $request, $id) {
        $event = Event::find($id);
        $event->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'picture' => $request['picture'],
            'event_location' => $request['location'],
            'category_id' => $request['category'],
            'places' => $request['places'],
            'price' => $request['price'],
            'organizer' => $request['organizer'],
            'status' => $request['satus'],
            'date' => $request['date'],
        ]);
    }
}
