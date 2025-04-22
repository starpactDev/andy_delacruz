<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function edit($id)
    {
        // Fetch the employee data based on the ID
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        // Initialize the manager and driver variables as null
        $manager = null;
        $driver = null;

        // Check if the user is a manager or driver based on the type
        if ($user->type == 2) {  // Assuming type 2 is for managers
            $manager = Manager::with('user')->where('user_id', $id)->first();
        } else {  // Assuming any other type is for drivers
            $driver = UserDriverInfo::with('user')->where('user_id', $id)->first();
        }

        // Check if employee is a manager and return the appropriate data
        if ($manager) {
            return response()->json([
                'data' => [
                    'id' => $manager->user_id,
                    'full_name' => $manager->user->name,
                    'email' => $manager->user->email,
                    'phone_number' => $manager->user->phone,
                    'address' => "{$manager->street_address}, {$manager->city}, {$manager->state}, {$manager->zip}",
                    'job_position' => 'Manager',
                ]
            ]);
        } elseif ($driver) {
            return response()->json([
                'data' => [
                    'id' => $driver->user_id,
                    'full_name' => $driver->user->name,
                    'email' => $driver->user->email,
                    'phone_number' => $driver->user->phone,
                    'address' => "{$driver->street}, {$driver->city}, {$driver->state}, {$driver->zip}",
                    'job_position' => $driver->team ? $driver->team . ' Driver' : 'N/A',
                ]
            ]);
        }

        return response()->json(['error' => 'Employee not found'], 404);
    }

    public function update(Request $request, $id)
    {
          // Clean the phone number to retain only numeric characters
    $request->merge([
        'phone_number' => preg_replace('/\D/', '', $request->phone_number),
    ]);
        // Validation for the form data including password
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id), // Make email unique, ignoring the current user's ID
            ],
            'phone_number' => [
                'required',
                'numeric',
                Rule::unique('users', 'phone')->ignore($id), // Make phone number unique, ignoring the current user's ID
            ],
            'address' => 'required',
            'job_position' => 'required|string',
            'password' => 'nullable|min:6|regex:/[A-Z]/|regex:/[^a-zA-Z0-9]/', // Password validation
        ]);

        // Find the employee by ID
        $employee = User::find($id);
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $employee->name = $request->full_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone_number;


        if ($request->filled('password')) {
            $employee->password = bcrypt($request->password); // Update password if provided
        }




        $employee->save();

        return response()->json(['success' => 'Employee updated successfully.']);
    }
    public function destroy($id)
    {
        $employee = Manager::with('user')->findOrFail($id) ?? UserDriverInfo::with('user')->findOrFail($id);

        $user = $employee->user;
        $user->delete();

        return response()->json(['success' => 'Employee deleted successfully.']);
    }
}
