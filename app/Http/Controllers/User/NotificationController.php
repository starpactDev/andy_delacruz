<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AddNotesByRdDriver;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notes = AddNotesByRdDriver::
        orderBy('created_at', 'desc') // Order notes by most recent
        ->get();
        return view('user.pages.notification.index',compact('notes'));
    }
    public function reminders()
    {
        $driverId = Auth::user()->id;
        $notes = AddNotesByRdDriver::where('driver_id', $driverId)
        ->orderBy('created_at', 'desc') // Order notes by most recent
        ->get();
        return view('user.pages.notification.reminder_index',compact('notes'));
    }

    public function decrementNotificationCount(Request $request)
    {
        // Get the authenticated user
        $user = User::find(auth()->id());

        if ($user) {
            // Set the notification count to 0
            $user->notification_count = 0;
            $user->save();

            return response()->json(['success' => true]);
        }

        // Return an error response if no user is found
        return response()->json(['success' => false, 'message' => 'User not found'], 404);
    }
}
