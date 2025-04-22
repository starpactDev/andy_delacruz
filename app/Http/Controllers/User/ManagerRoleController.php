<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ManagePermissionForManager;

class ManagerRoleController extends Controller
{
    public function role_list()
    {
        return view('user.pages.manager.role_list');
    }

    public function store(Request $request)
    {
        // Store new permission record
        ManagePermissionForManager::create([
            'key' => $request->key,
            'value' => $request->value
        ]);

        return response()->json(['message' => 'Permission stored successfully']);
    }

    public function destroy(Request $request)
    {
        // Delete the permission record
        ManagePermissionForManager::where('key', $request->key)
            ->where('value', $request->value)
            ->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }

    public function checkPermission(Request $request)
    {

        // Check if the permission record exists
        $exists = ManagePermissionForManager::where('key', $request->key)
                    ->where('value', $request->value)
                    ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function getClientListStatus()
{
    $permission = ManagePermissionForManager::where('key', 'client_list')->first();

    if ($permission) {
        return response()->json($permission);
    }

    return response()->json(['key' => 'client_list', 'value' => 'on']);
}
    public function getDocsStatus()
{
    $permission = ManagePermissionForManager::where('key', 'docs_list')->first();

    if ($permission) {
        return response()->json($permission);
    }

    return response()->json(['key' => 'docs_list', 'value' => 'on']);
}

public function updateClientListPermission(Request $request)
{
    $request->validate([
        'key' => 'required|string',
        'value' => 'required|string',
    ]);

    try {
        ManagePermissionForManager::updateOrCreate(
            ['key' => $request->key],
            ['value' => $request->value]
        );

        return response()->json(['success' => true, 'message' => 'Permission updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to update permission.']);
    }
}
public function updateDocsPermission(Request $request)
{
    $request->validate([
        'key' => 'required|string',
        'value' => 'required|string',
    ]);

    try {
        ManagePermissionForManager::updateOrCreate(
            ['key' => $request->key],
            ['value' => $request->value]
        );

        return response()->json(['success' => true, 'message' => 'Permission updated successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to update permission.']);
    }
}

public function deleteClientListPermission(Request $request)
{
    $request->validate([
        'key' => 'required|string',
    ]);

    try {
        ManagePermissionForManager::where('key', $request->key)->delete();

        return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to delete permission.']);
    }
}
public function deleteDocsListPermission(Request $request)
{
    $request->validate([
        'key' => 'required|string',
    ]);

    try {
        ManagePermissionForManager::where('key', $request->key)->delete();

        return response()->json(['success' => true, 'message' => 'Permission deleted successfully.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to delete permission.']);
    }
}
}
