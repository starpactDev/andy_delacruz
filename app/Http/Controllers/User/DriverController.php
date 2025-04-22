<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\ManagePermissionForManager;

class DriverController extends Controller
{
    public function index()
    {
        $provinces = [
            ['name' => 'AZUA'],
            ['name' => 'BAHORUCO'],
            ['name' => 'BARAHONA'],
            ['name' => 'DAJABON'],
            ['name' => 'DISTRITO NACIONAL'],
            ['name' => 'DUARTE'],
            ['name' => 'EL SEYBO'],
            ['name' => 'ELIAS PIÑA'],
            ['name' => 'ESPAILLAT'],
            ['name' => 'HATO MAYOR'],
            ['name' => 'HERMANAS MIRABAL'],
            ['name' => 'INDEPENDENCIA'],
            ['name' => 'LA ALTAGRACIA'],
            ['name' => 'LA ROMANA'],
            ['name' => 'LA VEGA'],
            ['name' => 'MARIA TRINIDAD SANCHEZ'],
            ['name' => 'MONSEÑOR NOUEL'],
            ['name' => 'MONTE PLATA'],
            ['name' => 'MONTECRISTI'],
            ['name' => 'PEDERNALES'],
            ['name' => 'PERAVIA'],
            ['name' => 'PUERTO PLATA'],
            ['name' => 'SAMANA'],
            ['name' => 'SAN CRISTOBAL'],
            ['name' => 'SAN JOSE DE OCOA'],
            ['name' => 'SAN JUAN'],
            ['name' => 'SAN PEDRO DE MACORIS'],
            ['name' => 'SANCHEZ RAMIREZ'],
            ['name' => 'SANTIAGO'],
            ['name' => 'SANTIAGO RODRIGUEZ'],
            ['name' => 'SANTO DOMINGO'],
            ['name' => 'VALVERDE'],
        ];
        $usaTeamDrivers = UserDriverInfo::where('team', 'USA Team')->get();
        $dominicanTeamDrivers = UserDriverInfo::where('team', 'Dominican Team')->get();


        $addPermissionExists = ManagePermissionForManager::where('key', 'driver')
            ->where('value', 'add')
            ->exists();
        $editPermissionExists = ManagePermissionForManager::where('key', 'driver')
            ->where('value', 'edit')
            ->exists();
        $deletePermissionExists = ManagePermissionForManager::where('key', 'driver')
            ->where('value', 'delete')
            ->exists();


        return view('user.pages.driver.index', compact('editPermissionExists', 'usaTeamDrivers', 'dominicanTeamDrivers', 'provinces', 'addPermissionExists', 'deletePermissionExists'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                Rule::unique('senders', 'email'), // ✅ Check uniqueness in senders table
            ],
            'phone' => 'required|string|max:15',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'team' => 'required|string',
            'password' => 'required|string|min:6',
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional for image upload
            'province' => 'required_if:team,Dominican Team|string|max:255', // Required only if team is Dominican
        ]);

        // Handle profile image upload
        if ($request->hasFile('profileImage')) {
            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/driver'), $imageName); // Save to 'public/images' directory
        } else {
            $imageName = null; // If no image uploaded
        }

        // Create the user
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imageName,
            'password' => bcrypt($request->password),
            'type' => 1, //  the user type is '1 for driver'
        ]);

        // Create the driver information
        UserDriverInfo::create([
            'user_id' => $user->id,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'team' => $request->team,
            'second_last_name' => $request->second_last_name ?? null, // Check if present, else null
            'nickname' => $request->nickname ?? null,
            'neighborhood' => $request->neighborhood ?? null,
            'province' => $request->province ?? null,
            'reference' => $request->reference ?? null,
            'cell' => $request->cell ?? null,
            'whatsapp' => $request->whatsapp ?? null,
        ]);

        return response()->json(['message' => 'Driver account created successfully!'], 200);
    }
    public function edit($id)
    {
        // Fetch driver info with user details
        $driver = UserDriverInfo::with('user')->where('user_id', $id)->first();

        // Extract first and last name from the full name
        $name = explode(' ', $driver->user->name, 2);
        $first_name = $name[0] ?? '';
        $last_name = $name[1] ?? '';

        return response()->json([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $driver->user->email,
            'phone' => $driver->user->phone,
            'street' => $driver->street,
            'city' => $driver->city,
            'state' => $driver->state,
            'zip' => $driver->zip,
            'team' => $driver->team,
            'profileImage' => $driver->user->image,
            'second_last_name' => $driver->second_last_name,  // Add second_last_name
            'nickname' => $driver->nickname,  // Add nickname
            'neighborhood' => $driver->neighborhood,  // Add neighborhood
            'province' => $driver->province,  // Add province
            'reference' => $driver->reference,  // Add reference
            'cell' => $driver->cell,  // Add cell
            'whatsapp' => $driver->whatsapp,  // Add whatsapp
        ]);
    }
    public function update(Request $request, $id)
    {

        // Fetch the user associated with the driver
        $driver = UserDriverInfo::with('user')->where('user_id', $id)->firstOrFail();

        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($driver->user_id, 'id'), // Ignore current user's email
                Rule::unique('senders', 'email'), // Ignore current sender's email
            ],
            'phone' => 'required|string|max:15',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'team' => 'required|string',
            'profileImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
            'province' => 'required_if:team,Dominican Team|string|max:255', // Required only if team is Dominican

        ]);

        // Fetch the user and driver info
        $driver = UserDriverInfo::where('user_id', $id)->firstOrFail();
        $user = $driver->user;

        // Handle profile image upload if a new image is provided
        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('admin/upload/images/driver/' . $user->image))) {
                unlink(public_path('admin/upload/images/driver/' . $user->image));
            }

            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/driver'), $imageName);
        } else {
            $imageName = $user->image; // Keep the old image if no new image is uploaded
        }

        // Update the user model
        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $imageName,
        ]);

        // Update the driver information
        $driver->update([
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'team' => $request->team,
            'second_last_name' => $request->second_last_name ?? null, // Check if present, else null
            'nickname' => $request->nickname ?? null,
            'neighborhood' => $request->neighborhood ?? null,
            'province' => $request->province ?? null,
            'reference' => $request->reference ?? null,
            'cell' => $request->cell ?? null,
            'whatsapp' => $request->whatsapp ?? null,
        ]);

        // Return a success response
        return response()->json(['message' => 'Driver updated successfully!'], 200);
    }

    public function destroy($id)
    {
        // Find the driver by user ID
        $driver = UserDriverInfo::where('user_id', $id)->first();

        if ($driver) {
            // Get the user ID
            $userId = $driver->user_id;

            // Delete the driver info
            $driver->delete();

            // Delete the corresponding user from the users table
            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }

            return response()->json(['message' => 'Driver  deleted successfully']);
        }

        return response()->json(['message' => 'Driver not found'], 404);
    }
    public function show($id)
    {
        // Fetch driver info with user details
        $driver = UserDriverInfo::with('user')->where('user_id', $id)->first();

        // Extract first and last name from the full name
        $name = explode(' ', $driver->user->name, 2);
        $first_name = $name[0] ?? '';
        $last_name = $name[1] ?? '';

        return response()->json([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $driver->user->email,
            'phone' => $driver->user->phone,
            'street' => $driver->street,
            'city' => $driver->city,
            'state' => $driver->state,
            'zip' => $driver->zip,
            'team' => $driver->team,
            'profileImage' => $driver->user->image,
            'second_last_name' => $driver->second_last_name,  // Add second_last_name
            'nickname' => $driver->nickname,  // Add nickname
            'neighborhood' => $driver->neighborhood,  // Add neighborhood
            'province' => $driver->province,  // Add province
            'reference' => $driver->reference,  // Add reference
            'cell' => $driver->cell,  // Add cell
            'whatsapp' => $driver->whatsapp,  // Add whatsapp
        ]);
    }
}
