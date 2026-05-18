<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->paginate(10);
        return view('home.index', compact('events'));
    }
}
