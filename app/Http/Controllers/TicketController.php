<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()->tickets()->with('event')->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request, Event $event)
    {
        if ($event->tickets()->count() >= $event->quota) {
            return back()->with('error', 'Event is sold out!');
        }

        if (Auth::user()->tickets()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'You have already booked a ticket for this event.');
        }

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'qr_code' => Str::uuid()->toString(),
            'status' => 'pending',
        ]);

        $ticket->transaction()->create([
            'payment_status' => $event->price > 0 ? 'pending' : 'paid',
            'payment_date' => $event->price > 0 ? null : now(),
        ]);

        if ($event->price == 0) {
            $ticket->update(['status' => 'active']);
        }

        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket booked successfully.');
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }
}
