<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Location;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
    function index()
    {
        $categories = Category::all();
        $locations = Location::all();
        $events = Event::with('category', 'user', 'location')->paginate(5);
        $eventsRequest = Event::where('status', 'unconfirmed')->paginate(5);
        return view('pages.back_office.events', compact('categories', 'locations', 'events', 'eventsRequest'));
    }

    function create()
    {

    }

    function store(Request $request)
    {
        $imagePath = $request->file('picture')->store('/events/profiles/', 'public');
        Event::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'picture' => $imagePath,
            'validation' => $request['validation'],
            'location_id' => $request['location'],
            'category_id' => $request['category'],
            'places' => $request['places'],
            'price' => $request['price'],
            'user_id' => Auth::id(),
            'date' => $request['date'],
            'slug' => Str::slug($request['title'], '-')
        ]);
        return back()->with('status', "success");
    }

    function show($slug)
    {
        $event = Event::where('slug', $slug)
            ->get()->first();
        $events = Event::where('status', 'published')->paginate(0);
        return view('pages.front_office.eventContent', [
            'event' => $event,
            'events' => $events
        ]);
    }

    function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'validation' => $request['Validation'],
            'picture' => $request['picture'],
            'event_location' => $request['location'],
            'category_id' => $request['category'],
            'places' => $request['places'],
            'price' => $request['price'],
            'organizer' => $request['organizer'],
            'date' => $request['date'],
        ]);
    }

    function changeStatus(Request $request, $id)
    {
        $event = Event::find($id);
        if (isset($request->accept)) {
            to_route('events.destroy', $event->id);
        } else {
            $event->update(['status' => "published"]);
        }
        return back();
    }

    function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return back();
    }

    function search($input)
    {
        $events = Event::where('title', 'LIKE', "%{$input}%")->where('status', 'published')
            ->with('category', 'user', 'location')
            ->get();
        foreach ($events as $event) {
            $event->date = convertTimeFormat($event->date, "d");
        }
        return response()->json(['events' => $events]);
    }
}
