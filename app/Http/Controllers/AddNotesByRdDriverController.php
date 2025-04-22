<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AddNotesByRdDriver;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;

class AddNotesByRdDriverController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string',
            'order_pickup_id' => 'required|integer',
            'driver_id' => 'required|integer',
            'add_note' => 'required|string|max:255',
        ]);

        AddNotesByRdDriver::create($validated);

        User::query()->increment('notification_count');

        return response()->json(['success' => true]);
    }

    public function getNotes($orderPickupId)
    {
        try {
            // Fetch notes associated with the given order_pickup_id
            $notes = AddNotesByRdDriver::where('order_pickup_id', $orderPickupId)
                ->orderBy('created_at', 'desc') // Order notes by most recent
                ->get();

            if ($notes->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No notes found for the given order pickup ID.',
                    'notes' => [],
                ], 404);
            }

            return response()->json([
                'success' => true,
                'notes' => $notes,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching notes.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        $note = AddNotesByRdDriver::find($id);

        if ($note) {
            $note->delete();
            return response()->json(['success' => true, 'message' => 'Note deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Note not found!']);
        }
    }


    public function rd_pending_list()
    {
        // Fetch orders assigned to the logged-in driver
        $driverId = Auth::id(); // Assuming the driver is logged in
        $orders = AssignedOrderToDriver::with(['orderPickup.receiver'])
        ->where('driver_id', $driverId)
        ->whereHas('orderPickup', function ($query) {
            $query->where('package_status', '!=', 'DELIVERED');
        })
        ->get();


       return view('driver.pages.rddriver.pending_list', compact('orders'));
    }
    public function rd_completed_list()
    {
        // Fetch orders assigned to the logged-in driver
        $driverId = Auth::id(); // Assuming the driver is logged in
        $orders = AssignedOrderToDriver::with(['orderPickup.receiver'])
        ->where('driver_id', $driverId)
        ->whereHas('orderPickup', function ($query) {
            $query->where('package_status', '=', 'DELIVERED');
        })
        ->get();


       return view('driver.pages.rddriver.completed_list', compact('orders'));
    }
}
