@extends('CustomerDashboard.layout.master')
@section('content')

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-info text-center">
            <?php
            $order_number = \App\Models\OrderPickUp::where('id', $survey->order_pickup_id)->first();
            $sender = \App\Models\Sender::where('id', $order_number->sender_id)->first();
            ?>
            <h3 style="color:white!important">Survey Feedback for Order #{{ $order_number->order_number }}</h3>
        </div>
        <div class="card-body">
            <!-- Sender Information -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-light border shadow-sm">
                        <h5 class="text-primary"><i class="fas fa-user"></i> Customer Information</h5>
                        <hr>
                        <p><strong>Order #</strong> {{ $order_number->order_number }}</p>
                        <p><strong>Name:</strong> {{ $sender->first_name }} {{ $sender->last_name }}</p>
                        <p><strong>Email:</strong> {{ $sender->email }}</p>
                        <p><strong>Phone:</strong> {{ $sender->cell ?? $sender->telephone }}</p>
                        <p><strong>Address:</strong> {{ $sender->street_address }},
                            @if($sender->apt) Apt {{ $sender->apt }}, @endif
                            {{ $sender->city }}, {{ $sender->state }} - {{ $sender->zip }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Survey Table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="color:rgb(151, 46, 14)">Questions</th>
                                <td style="color:rgb(10, 119, 68)">Answers</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Overall Satisfaction</th>
                                <td>{{ $survey->satisfaction }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Booking Process</th>
                                <td>{{ $survey->booking }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Package Arrival Time</th>
                                <td>{{ $survey->arrival_time }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Package Condition</th>
                                <td>{{ $survey->package_condition }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Tracking Accuracy</th>
                                <td>{{ $survey->tracking }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Customer Support Contacted</th>
                                <td>{{ $survey->customer_support }}</td>
                            </tr>
                            @if($survey->customer_support == 'Yes')
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Support Satisfaction</th>
                                <td>{{ $survey->support_satisfaction }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Professionalism of Team</th>
                                <td>{{ $survey->professionalism }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Recommended Improvements</th>
                                <td>
                                    @if(!empty($survey->improvements))
                                        <ul>
                                            @foreach($survey->improvements as $improvement)
                                                <li>{{ $improvement }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if(!empty($survey->other_improvements))
                                        <p><strong>Other:</strong> {{ $survey->other_improvements }}</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Would Recommend Service?</th>
                                <td>{{ $survey->recommend }}</td>
                            </tr>
                            <tr>
                                <th style="color:rgb(14, 68, 75)">Additional Comments</th>
                                <td>{{ $survey->comments ?? 'No additional comments.' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    th {
        background-color: #f8f9fa;
        width: 40%;
    }
    td {
        font-weight: 500;
    }
</style>
@endsection
