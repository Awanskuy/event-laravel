<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (Auth::user()->tickets()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'You have already booked a ticket for this event.');
        }

        $isFree = $event->price == 0;

        try {
            // Wrap quota check + ticket/transaction creation in one atomic
            // transaction so two concurrent bookings can't oversell the event
            // and we never leave an orphan ticket without a transaction.
            $ticket = DB::transaction(function () use ($event, $isFree) {
                if ($event->tickets()->lockForUpdate()->count() >= $event->quota) {
                    throw new \RuntimeException('SOLD_OUT');
                }

                $ticket = Ticket::create([
                    'user_id' => Auth::id(),
                    'event_id' => $event->id,
                    'qr_code' => Str::uuid()->toString(),
                    'status' => $isFree ? 'active' : 'pending',
                ]);

                $ticket->transaction()->create([
                    'payment_status' => $isFree ? 'paid' : 'pending',
                    'payment_date' => $isFree ? now() : null,
                ]);

                return $ticket;
            });
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'SOLD_OUT') {
                return back()->with('error', 'Event is sold out!');
            }
            throw $e;
        }

        if ($isFree) {
            return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket booked successfully.');
        }

        return redirect()->route('checkout', $ticket->transaction)->with('success', 'Please complete your payment.');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return view('tickets.show', compact('ticket'));
    }
}
