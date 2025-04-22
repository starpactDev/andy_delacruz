<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Secretary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SecretaryController extends Controller
{
    public function index()
    {
        $data = Secretary::all();
        return view('user.pages.secretary.index', compact('data'));
    }

    public function store(Request $request)
    {

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                Rule::unique('senders', 'email'), // ✅ Check uniqueness in senders table
            ],
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048', // Optional image
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Handle profile image upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/profile'), $imageName); // Save to 'public/images' directory
        } else {
            $imageName = null; // If no image uploaded
        }
        // Create User as Manager
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $imageName,
            'type' => 3, // Set as Secretary (3)
        ]);

        // Create Manager Details
        Secretary::create([
            'user_id' => $user->id,
            'street_address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        return response()->json(['success' => true, 'message' => 'Manager created successfully!']);
    }

    public function update(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->user_id, 'id'), // Ignore current user's email
                Rule::unique('senders', 'email'), // Ignore current sender's email
            ],
            'phone' => 'required|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'profileImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional image upload
        ]);

        // Find the manager by user_id
        $manager = Secretary::where('user_id', $request->user_id)->first();
        $user = $manager->user;
        if (!$manager) {
            return response()->json(['message' => 'Manager not found.'], 404);
        }



        // Handle image upload if a new image is provided

        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('admin/upload/images/profile/' . $user->image))) {
                unlink(public_path('admin/upload/images/profile/' . $user->image));
            }

            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/profile'), $imageName);
        } else {
            $imageName = $user->image; // Keep the old image if no new image is uploaded
        }

        // Update the manager's information
        $manager->user->name = $request->name;
        $manager->user->email = $request->email;
        $manager->user->phone = $request->phone;
        $manager->user->image = $imageName;
        $manager->street_address = $request->street;
        $manager->city = $request->city;
        $manager->state = $request->state;
        $manager->zip = $request->zip;
        // Save changes
        $manager->user->save();
        $manager->save();

        return response()->json(['message' => 'Secretary updated successfully.']);
    }

    public function destroy($id)
    {
        // Find the driver by user ID
        $manager = Secretary::where('user_id', $id)->first();

        if ($manager) {
            // Get the user ID
            $userId = $manager->user_id;

            // Delete the driver info
            $manager->delete();

            // Delete the corresponding user from the users table
            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }

            return response()->json(['message' => 'Secretary  deleted successfully']);
        }

        return response()->json(['message' => 'Secretary not found'], 404);
    }
}
