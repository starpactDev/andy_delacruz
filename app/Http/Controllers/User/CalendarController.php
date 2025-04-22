<?php

namespace App\Http\Controllers\User;

use App\Models\Employee;
use App\Models\CreateEvent;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use App\Models\PotentialCustomer;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        $employees= PotentialCustomer::all();
        $usaTeamDrivers = UserDriverInfo::where('team', 'USA Team')->get();
        return view('user.pages.calendar.index', compact('employees','usaTeamDrivers'));
    }
    public function report()
    {
        $events= CreateEvent::all();

        return view('user.pages.calendar.report', compact('events'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'comments' => 'nullable|string',
            'color' => 'required|string',
            'assigned_driver' => 'nullable|string',
            'assigned_employee' => 'nullable|string',
        ], [
            'assigned_employee.required' => 'The Potential Customer field is mandatory.',
        ]);

        // Save the event to the database
        CreateEvent::create($validatedData);

        // Return a success response
        return response()->json(['success' => 'Event created successfully!'], 201);
    }
    public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'comments' => 'nullable|string',
            'color' => 'required|string',
            'assigned_driver' => 'nullable|string',
            'assigned_employee' => 'nullable|string',
        ], [
            'assigned_employee.required' => 'The Potential Customer field is mandatory.',
        ]);

        // Find the event by its ID
        $event = CreateEvent::findOrFail($request->id);

        // Update the event with the validated data
        $event->update($validatedData);

        // Return a success response
        return response()->json(['success' => 'Event updated successfully!'], 200);
    }

    public function getEvents(Request $request)
    {
        // Retrieve events from the database
        $events = CreateEvent::all();

        // Format events as needed for the calendar
        $formattedEvents = $events->map(function($event) {
            return [
                'id' => $event->id, // Assuming there's an id field in your events table
                'title' => $event->title,
                'start' => $event->event_date . 'T' . $event->start_time, // Combine date and time for start
                'end' => $event->event_date . 'T' . $event->end_time, // Combine date and time for end
                'extendedProps' => [
                    'calendar' => $event->color,
                    'comments' => $event->comments,

                    'assigned_driver' => $event->assigned_driver,
                    'assigned_employee' => $event->assigned_employee,
                ],
            ];
        });

        return response()->json($formattedEvents); // Return formatted events as JSON
    }
}
