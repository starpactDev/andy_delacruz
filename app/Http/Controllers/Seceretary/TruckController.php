<?php

namespace App\Http\Controllers\Seceretary;

use App\Models\Truck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::all();
        return view('user.pages.secretary.expense_report_domrep.index', compact('trucks'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'renew_tag' => 'nullable|string',
            'insurance_renewal' => 'nullable|string',
            'next_oil_change' => 'nullable|string',
            'truck_name' => 'required|string',
            'truck_brand' => 'nullable|string',
            'truck_model' => 'nullable|string',
            'color' => 'nullable|string',
            'license_plate' => 'nullable|string',
            'last_mechanic_visit' => 'nullable|string',
            'repairs_done' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        // Handle file upload if any
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/attachments', $filename);
            $data['attachment'] = $filename;
        }

        Truck::create($data);

        return redirect()->back()->with('success', 'Truck information submitted successfully.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:trucks,id',
            'renew_tag' => 'nullable|string',
            'insurance_renewal' => 'nullable|string',
            'next_oil_change' => 'nullable|string',
            'truck_brand' => 'nullable|string',
            'truck_model' => 'nullable|string',
            'color' => 'nullable|string',
            'license_plate_number' => 'nullable|string',
            'last_visit_to_mechanic' => 'nullable|string',
            'that_was_repaired' => 'nullable|string',
        ]);

        $truck = Truck::findOrFail($validated['id']);

        $truck->update([
            'renew_tag' => $validated['renew_tag'],
            'insurance_renewal' => $validated['insurance_renewal'],
            'next_oil_change' => $validated['next_oil_change'],
            'truck_brand' => $validated['truck_brand'],
            'truck_model' => $validated['truck_model'],
            'color' => $validated['color'],
            'license_plate' => $validated['license_plate_number'],
            'last_mechanic_visit' => $validated['last_visit_to_mechanic'],
            'repairs_done' => $validated['that_was_repaired'],
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:trucks,id',
        ]);

        $truck = Truck::findOrFail($request->id);
        $truck->delete();

        return response()->json(['success' => true]);
    }


}
