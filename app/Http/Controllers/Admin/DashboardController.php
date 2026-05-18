<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        
        // Purchased/active tickets sold
        $totalTickets = Ticket::where('status', '!=', 'pending')->count();
        
        // Sum paid transactions total revenue joining tickets and events
        $totalRevenue = Transaction::where('payment_status', 'paid')
            ->join('tickets', 'transactions.ticket_id', '=', 'tickets.id')
            ->join('events', 'tickets.event_id', '=', 'events.id')
            ->sum('events.price');
            
        // Recent 5 Transactions with relationships loaded
        $recentTransactions = Transaction::with(['ticket.user', 'ticket.event'])
            ->latest()
            ->take(5)
            ->get();
            
        // Recent 5 Events with ticket sales count loaded
        $recentEvents = Event::withCount(['tickets' => function($q) {
                $q->where('status', '!=', 'pending');
            }])
            ->latest()
            ->take(5)
            ->get();
            
        // Analytics breakdowns
        $pendingTransactions = Transaction::where('payment_status', 'pending')->count();
        $paidTransactions = Transaction::where('payment_status', 'paid')->count();
        
        $activeTickets = Ticket::where('status', 'active')->count();
        $usedTickets = Ticket::where('status', 'used')->count();
        
        $organizerCount = User::where('role', 'organizer')->count();
        $adminCount = User::where('role', 'admin')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEvents',
            'totalTickets',
            'totalRevenue',
            'recentTransactions',
            'recentEvents',
            'pendingTransactions',
            'paidTransactions',
            'activeTickets',
            'usedTickets',
            'organizerCount',
            'adminCount'
        ));
    }
}
