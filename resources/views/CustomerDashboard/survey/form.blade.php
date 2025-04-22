@extends('CustomerDashboard.layout.master')
@section('content')
    <style>
        .title {
            color: rgb(18, 49, 133);
            font-size: 24px;
            font-weight: bold;
            margin-bottom:40px;
        }
        .form-container {
          
            margin: auto;
            padding: 20px;
            background: #fffdfd!important;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-check {
            margin-bottom: 10px;
        }
        .form-check-label {
            font-weight: 500;
        }
        .form-check-input {
            transform: scale(1.3);
            margin-right: 10px;
        }
        .form-label {
            font-weight: bold;
            color: rgb(10, 78, 99);
        }
    </style>
    <div class="container mt-4">
        <div class="form-container">
            <h2 class="title text-center">Service Experience Feedback</h2>
            <div class="text-center mb-3">
                <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
            <form method="POST" action="{{ route('feedback.store') }}">
                @csrf
                <input type="hidden" name="order_pickup_id" value="{{ $orderDetails->id }}">

                <!-- Satisfaction -->
                <div class="mb-3">
                    <label class="form-label">How satisfied are you with the overall shipping process?</label>
                    @foreach(['Very Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very Dissatisfied'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="satisfaction" value="{{ $option }}" {{ old('satisfaction') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('satisfaction')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Booking Process -->
                <div class="mb-3">
                    <label class="form-label">How easy was it to book your shipment?</label>
                    @foreach(['Very Easy', 'Easy', 'Neutral', 'Difficult', 'Very Difficult'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="booking" value="{{ $option }}" {{ old('booking') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('booking')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Package Arrival Time -->
                <div class="mb-3">
                    <label class="form-label">Did your package arrive on time?</label>
                    @foreach(['Yes, earlier than expected', 'Yes, on time', 'No, slightly delayed', 'No, significantly delayed'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="arrival_time" value="{{ $option }}" {{ old('arrival_time') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('arrival_time')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Package Condition -->
                <div class="mb-3">
                    <label class="form-label">How would you rate the condition of your package upon arrival?</label>
                    @foreach(['Excellent – No damage', 'Good – Minor wear', 'Fair – Some damage', 'Poor – Significant damage'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="package_condition" value="{{ $option }}" {{ old('package_condition') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('package_condition')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tracking Accuracy -->
                <div class="mb-3">
                    <label class="form-label">Was the tracking information accurate and updated regularly?</label>
                    @foreach(['Yes', 'Somewhat', 'No'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tracking" value="{{ $option }}" {{ old('tracking') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('tracking')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Customer Support -->
                <div class="mb-3">
                    <label class="form-label">Did you contact customer support during your shipping process?</label>
                    @foreach(['Yes', 'No'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_support" value="{{ $option }}" {{ old('customer_support') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('customer_support')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">If Yes, How satisfied were you with the assistance received?</label>
                    @foreach(['Very Satisfied', 'Satisfied', 'Neutral', 'Dissatisfied', 'Very Dissatisfied'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="support_satisfaction" value="{{ $option }}">
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('support_satisfaction')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">How would you rate the professionalism of our team?</label>
                    @foreach(['Excellent', 'Good', 'Neutral', 'Poor'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="professionalism" value="{{ $option }}">
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('professionalism')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                <!-- Recommendations for Improvement -->
                <div class="mb-3">
                    <label class="form-label">What areas do you think we could improve? (Check all that apply)</label>
                    @foreach(['Faster delivery', 'Better package handling', 'Improved tracking system', 'Lower shipping costs', 'Better customer service'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="improvements[]" value="{{ $option }}" {{ is_array(old('improvements')) && in_array($option, old('improvements')) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    <div class="mt-2">
                        <input type="text" class="form-control" name="other_improvements" value="{{ old('other_improvements') }}" placeholder="Other (please specify)">
                    </div>
                    @error('improvements')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Recommendation -->
                <div class="mb-3">
                    <label class="form-label">Would you recommend our shipping service to others?</label>
                    @foreach(['Yes, definitely', 'Maybe', 'No'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="recommend" value="{{ $option }}" {{ old('recommend') == $option ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                    @error('recommend')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Comments -->
                <div class="mb-3">
                    <label class="form-label">Any additional comments or suggestions?</label>
                    <textarea class="form-control" name="comments" rows="3" placeholder="Your feedback...">{{ old('comments') }}</textarea>
                    @error('comments')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>



@endsection
@push('script')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if ($errors->any())
<script>
    let errorMessages = '<div style="text-align: left;">';

    @foreach ($errors->messages() as $field => $messages)
        var question = ''; // Use var instead of let

        switch (@json($field)) {
            case 'satisfaction': question = '🌟 <b>How satisfied are you with the overall shipping process?</b>'; break;
            case 'booking': question = '📦 <b>How easy was it to book your shipment?</b>'; break;
            case 'arrival_time': question = '⏳ <b>Did your package arrive on time?</b>'; break;
            case 'package_condition': question = '📦 <b>How would you rate the condition of your package upon arrival?</b>'; break;
            case 'tracking': question = '📍 <b>Was the tracking information accurate and updated regularly?</b>'; break;
            case 'customer_support': question = '📞 <b>Did you contact customer support during your shipping process?</b>'; break;
            case 'support_satisfaction': question = '🤝 <b>If Yes, how satisfied were you with the assistance received?</b>'; break;
            case 'professionalism': question = '👨‍💼 <b>How would you rate the professionalism of our team?</b>'; break;
            case 'improvements': question = '🚀 <b>What areas do you think we could improve?</b>'; break;
            case 'recommend': question = '👍 <b>Would you recommend our shipping service to others?</b>'; break;
            case 'comments': question = '📝 <b>Any additional comments or suggestions?</b>'; break;
            default: question = '❓ <b>Unknown Question</b>'; break;
        }

        @foreach ($messages as $message)
            errorMessages += `<p style="margin-bottom: 8px; padding: 10px; background: #fff3f3; border-left: 5px solid #e74c3c; border-radius: 5px; color: #c0392b;">
                ${question} <br> 🔴 <i>@json($message)</i>
            </p>`;
        @endforeach
    @endforeach

    errorMessages += '</div>';

    Swal.fire({
        icon: 'error',
        title: '⚠️ Validation Errors',
        html: errorMessages,
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK',
        width: '600px',
        customClass: {
            popup: 'swal-wide'
        }
    });
</script>
@endif


@endpush
