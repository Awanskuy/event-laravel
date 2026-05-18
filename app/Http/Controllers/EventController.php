<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * PUBLIC LANDING PAGE
     * Menampilkan semua event (Homepage)
     */
    public function index()
    {
        $events = Event::latest()->paginate(9);

        return view('events.index', compact('events'));
    }

    /**
     * ORGANIZER DASHBOARD
     * Event milik organizer saja
     */
    public function manage()
    {
        $events = Auth::user()->events()->paginate(10);

        return view('events.manage', compact('events'));
    }

    /**
     * FORM CREATE EVENT
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * STORE EVENT
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload Image
        if ($request->hasFile('image')) {
            $validated['image'] =
                $request->file('image')->store('events', 'public');
        }

        Auth::user()->events()->create($validated);

        return redirect()
            ->route('events.manage')
            ->with('success', 'Event created successfully.');
    }

    /**
     * SHOW DETAIL EVENT (PUBLIC)
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * EDIT EVENT
     */
    public function edit(Event $event)
    {
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('events.edit', compact('event'));
    }

    /**
     * UPDATE EVENT
     */
    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update Image
        if ($request->hasFile('image')) {

            // delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $validated['image'] =
                $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('events.manage')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * DELETE EVENT
     */
    public function destroy(Event $event)
    {
        if ($event->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('events.manage')
            ->with('success', 'Event deleted successfully.');
    }
}