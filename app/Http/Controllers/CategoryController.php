<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\categoryStore;
use App\Models\Event;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $categories = Category::all();
        return view('pages.back_office.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create(['category' => $request['category']]);
        return redirect()->back()->withSuccess('Category Created successfully .');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    function filterByCategoryAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $events = Event::where('category_id', $request->category_id)
            ->where('status', 'published')
            ->with('category', 'user', 'location')
            ->get();
        foreach ($events as $event) {
            $event->date = convertTimeFormat($event->date, "d");
        }
        return response()->json(['events' => $events]);
    }
}
