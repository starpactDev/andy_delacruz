<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BusinessExpense;

class BusinessExpenseCntroller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date_of_payment' => 'required|date',
            'payment_method' => 'required|string',
            'paid_to' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'paid_amount' => 'required|numeric',
            'running_total' => 'required|numeric',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf', // Optional, adjust as needed

        ]);
        // Initialize attachment path variable
        $attachmentName = null;

        // Check if the file is uploaded
        if ($request->hasFile('attachment')) {
            // Get the uploaded file
            $file = $request->file('attachment');

            // Generate a unique file name (you could also use timestamp, etc.)
            $attachmentName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the file to the 'attachments' directory within the 'public' disk
            $file->move(public_path('attachments'), $attachmentName);
        }
        // Create the new expense
        $expense = BusinessExpense::create([
            'date_of_payment' => $request->date_of_payment,
            'payment_method' => $request->payment_method,
            'paid_to' => $request->paid_to,
            'description' => $request->description,
            'paid_amount' => $request->paid_amount,
            'running_total' => $request->running_total,
            'attachment' => $attachmentName, // Store only the file name
        ]);

        return response()->json($expense); // Return the created expense as a JSON response
    }
    public function index(Request $request)
    {
        $expenses = BusinessExpense::all(); // Fetch all expenses
        $totalAmountPaid = $expenses->sum('paid_amount');
        return view('user.pages.business.expense.index', compact('expenses', 'totalAmountPaid'));

    }
    public function updateExpense(Request $request)
    {
        
        $validated = $request->validate([
            'id' => 'required|exists:business_expenses,id',
            'date_of_payment' => 'required|date',
            'payment_method' => 'required|in:Credit Card,Bank Transfer,Zelle,PayPal,Cash',
            'paid_to' => 'required|string|max:255',
            'description' => 'required|string',
            'paid_amount' => 'required|numeric|min:0',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Optional, adjust size if needed
        ]);

        $expense = BusinessExpense::find($validated['id']);

        // Check if a new file is uploaded
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // Generate a unique file name for the new attachment
            $newAttachmentName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Move the new file to the 'attachments' directory
            $file->move(public_path('attachments'), $newAttachmentName);

            // Delete the old attachment if it exists
            if ($expense->attachment && file_exists(public_path('attachments/' . $expense->attachment))) {
                unlink(public_path('attachments/' . $expense->attachment));
            }

            // Update the attachment name in the validated data
            $validated['attachment'] = $newAttachmentName;
        } else {
            // Preserve the old attachment if no new file is uploaded
            $validated['attachment'] = $expense->attachment;
        }

        // Update the expense with validated data
        $expense->update($validated);

        return response()->json(['message' => 'Expense updated successfully!']);
    }

    public function destroy($id)
    {
        try {
            $expense = BusinessExpense::findOrFail($id);
            $expense->delete();

            return response()->json(['message' => 'Expense deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete expense'], 500);
        }
    }

    public function filterExpensesByMonth(Request $request)
    {

        $month = $request->input('month');

        if ($month == 'all') {
            $expenses = BusinessExpense::all(); // Get all expenses if 'all' is selected
        } else {
            $expenses = BusinessExpense::whereMonth('date_of_payment', Carbon::parse($month)->month)->get();
        }

        $totalAmount = $expenses->sum('paid_amount'); // Calculate the total earnings

        return response()->json([
            'expenses' => $expenses,
            'total_amount' => $totalAmount
        ]);
    }
}
