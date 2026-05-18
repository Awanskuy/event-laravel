<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'total_users' => User::count(),
            'tickets_sold' => Ticket::where('status', '!=', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
