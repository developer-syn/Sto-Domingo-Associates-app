<?php

namespace App\Http\Controllers;

use App\Models\FbEmbed;
use Illuminate\Http\Request;

class EmbedController extends Controller
{
    // List all news
    public function index()
    {
        // Retrieve all 'news' category embeds
        $news = FbEmbed::where('category', 'news')->get();
        return view('news.index', compact('news'));
    }

    // Show the form to create a new news item
    public function create()
    {
        return view('news.create');
    }

    // Store a new news item
    public function store(Request $request)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        FbEmbed::create([
            'category' => 'news',
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('news.index')->with('success', 'News item created successfully.');
    }

    // Show the form to edit an existing news item
    public function edit($id)
    {
        // Find news by ID
        $news = FbEmbed::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    // Update an existing news item
    public function update(Request $request, $id)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        // Find news by ID and update
        $news = FbEmbed::findOrFail($id);
        $news->update([
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('news.index')->with('success', 'News item updated successfully.');
    }

    // Delete a news item
    public function destroy($id)
    {
        // Find and delete news item
        $news = FbEmbed::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News item deleted successfully.');
    }

    // Display list of event embeds
    public function indexEvents()
    {
        // Retrieve all 'events' category embeds
        $events = FbEmbed::where('category', 'events')->get();
        return view('events.index', compact('events'));
    }

    // Show the form to create a new event
    public function createEvent()
    {
        return view('events.create');
    }

    // Store a new event in the database
    public function storeEvent(Request $request)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        FbEmbed::create([
            'category' => 'events',
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    // Show form to edit an event
    public function editEvent($id)
    {
        // Find event by ID
        $event = FbEmbed::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    // Update an existing event in the database
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        // Find and update event by ID
        $event = FbEmbed::findOrFail($id);
        $event->update([
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    // Delete an event
    public function destroyEvent($id)
    {
        // Find and delete event by ID
        $event = FbEmbed::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    // Display list of triumph embeds
    public function indexTriumphs()
    {
        // Retrieve all 'triumphs' category embeds
        $triumphs = FbEmbed::where('category', 'triumphs')->get();
        return view('triumphs.index', compact('triumphs'));
    }

    // Show the form to create a new triumph
    public function createTriumph()
    {
        return view('triumphs.create');
    }

    // Store a new triumph in the database
    public function storeTriumph(Request $request)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        FbEmbed::create([
            'category' => 'triumphs',
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('triumphs.index')->with('success', 'Triumph created successfully.');
    }

    // Show form to edit a triumph
    public function editTriumph($id)
    {
        // Find triumph by ID
        $triumph = FbEmbed::findOrFail($id);
        return view('triumphs.edit', compact('triumph'));
    }

    // Update an existing triumph in the database
    public function updateTriumph(Request $request, $id)
    {
        $request->validate([
            'iframe' => 'required|string',
        ]);

        // Find and update triumph by ID
        $triumph = FbEmbed::findOrFail($id);
        $triumph->update([
            'embed_code' => $request->iframe,
        ]);

        return redirect()->route('triumphs.index')->with('success', 'Triumph updated successfully.');
    }

    // Delete a triumph
    public function destroyTriumph($id)
    {
        // Find and delete triumph by ID
        $triumph = FbEmbed::findOrFail($id);
        $triumph->delete();

        return redirect()->route('triumphs.index')->with('success', 'Triumph deleted successfully.');
    }

    // Combined display for news, events, and triumphs with default category 'news'
    public function showNews(Request $request)
    {
        $category = $request->input('category', 'news');

        // Fetch data based on the selected category
        $news = FbEmbed::where('category', 'news')->get();
        $events = FbEmbed::where('category', 'events')->get();
        $triumphs = FbEmbed::where('category', 'triumphs')->get();
    
        return view('display-news', compact('news', 'events', 'triumphs', 'category'));
    }
}
