<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // Get all events from the database
        $events = Event::all();

        // Pass events to the view
        return view('events.index', compact('events'));
    }
}
