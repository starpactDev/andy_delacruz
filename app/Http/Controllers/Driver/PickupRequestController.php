<?php

namespace App\Http\Controllers\Driver;

use App\Models\CreateEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PickupRequestController extends Controller
{
    public function pickup_list()
    {
        $driverId = Auth::id();
        $events = CreateEvent::with('assignedEmployee')->where('assigned_driver', $driverId)->where('is_completed', 0)->orderBy('created_at', 'desc')->get();
        return view('admin.pages.usadriver.pickup-request-list', compact('events'));
    }


    public function update_status(Request $request, $eventId)
    {
        $event = CreateEvent::findOrFail($eventId);

        // Update status and is_completed if necessary
        $event->status = $request->status;

        if ($request->status === 'order_created') {
            $event->is_completed = 1;
        }else
        {
            $event->is_completed = 0;
        }

        $event->save();

        // Return a response indicating success
        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully for ' . $event->assignedEmployee->full_name,
            'new_status' => $event->status,
        ]);
    }
}
