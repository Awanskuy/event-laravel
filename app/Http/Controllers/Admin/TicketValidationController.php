<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketValidationController extends Controller
{
    public function index()
    {
        return view('admin.tickets.index');
    }

    public function validateTicket(Request $request)
    {
        $request->validate(['qr_code' => 'required|string']);

        $ticket = Ticket::where('qr_code', $request->qr_code)->first();

        if (!$ticket) {
            return back()->with('error', 'Invalid ticket QR Code.');
        }

        if ($ticket->status === 'used') {
            return back()->with('error', 'Ticket has already been used.');
        }

        if ($ticket->status === 'pending') {
            return back()->with('error', 'Ticket payment is pending.');
        }

        $ticket->update(['status' => 'used']);

        return back()->with('success', 'Ticket validated successfully for event: ' . $ticket->event->title);
    }
}
