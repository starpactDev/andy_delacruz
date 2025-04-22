<?php

namespace App\Http\Controllers\CustomerDashboard;

use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Models\SurveyFeedback;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    public function survey_form($order_pickup_id)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions','payments'])
        ->where('id', $order_pickup_id)
        ->first();
        return view('CustomerDashboard.survey.form',compact('orderDetails'));
    }
    public function showSurveybyAdmin($orderId)
    {
        $survey = SurveyFeedback::where('order_pickup_id', $orderId)->first();

        if (!$survey) {
            return redirect()->back()->with('error', 'Survey not found!');
        }

        return view('admin.pages.customer.survey.view_survey', compact('survey'));
    } 
    public function showSurvey($orderId)
    {
        $survey = SurveyFeedback::where('order_pickup_id', $orderId)->first();

        if (!$survey) {
            return redirect()->back()->with('error', 'Survey not found!');
        }

        return view('CustomerDashboard.survey.view_survey', compact('survey'));
    }    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_pickup_id' => 'required|exists:order_pickups,id',
            'satisfaction' => 'required',
            'booking' => 'required',
            'arrival_time' => 'required',
            'package_condition' => 'required',
            'tracking' => 'required',
            'customer_support' => 'required',
            'support_satisfaction' => 'required_if:customer_support,Yes',
            'professionalism' => 'required',
            'improvements' => 'nullable|array',
            'recommend' => 'required',
            'comments' => 'nullable|string',
        ]);

        $order = OrderPickUp::find($request->order_pickup_id);

        SurveyFeedback::create([
            'order_pickup_id' => $order->id,
            'sender_id' => $order->sender_id,
            'satisfaction' => $validatedData['satisfaction'],
            'booking' => $validatedData['booking'],
            'arrival_time' => $validatedData['arrival_time'],
            'package_condition' => $validatedData['package_condition'],
            'tracking' => $validatedData['tracking'],
            'customer_support' => $validatedData['customer_support'],
            'support_satisfaction' => $validatedData['customer_support'] == 'Yes' ? $validatedData['support_satisfaction'] : null,
            'professionalism' => $validatedData['professionalism'],
            'improvements' => $validatedData['improvements'] ?? [],
            'recommend' => $validatedData['recommend'],
            'comments' => $validatedData['comments'] ?? null,
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Thank you for your feedback!');
    }
}
