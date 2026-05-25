<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
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
    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

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
        $event->load('user');

        $relatedEvents = Event::where('id', '!=', $event->id)
            ->latest()
            ->take(3)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }

    /**
     * EDIT EVENT
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', compact('event'));
    }

    /**
     * UPDATE EVENT
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validated();

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
        $this->authorize('delete', $event);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('events.manage')
            ->with('success', 'Event deleted successfully.');
    }
}