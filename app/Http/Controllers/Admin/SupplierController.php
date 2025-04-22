<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        // Fetch all suppliers from the database
        $suppliers = Supplier::all();
        return view('user.pages.supplier.index', compact('suppliers'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'products' => 'required|string',

        ]);

        // Save supplier to database
        Supplier::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'products' => $request->products,

        ]);

        return response()->json(['success' => 'Supplier account created successfully!']);
    }
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }
    public function update(Request $request)
    {

        // Validate incoming request data
        $request->validate([
            'supplierId' => 'required|integer|exists:suppliers,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:10',
            'products' => 'required|string|max:255',
        ]);

        // Find the supplier by ID and update the data
        $supplier = Supplier::find($request->supplierId);
        $supplier->first_name = $request->first_name;
        $supplier->last_name = $request->last_name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->city = $request->city;
        $supplier->state = $request->state;
        $supplier->zip = $request->zip;
        $supplier->products = $request->products;

        // Save the updated supplier
        $supplier->save();

        // Return a success response
        return response()->json(['success' => 'Supplier updated successfully!']);
    }
    public function destroy($id)
    {
        // Find the employee by ID
        $employee = Supplier::findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Return a JSON response
        return response()->json(['message' => 'Supplier Record deleted successfully']);
    }
}
