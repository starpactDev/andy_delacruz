@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <!-- Row -->
        @php
            // Get the phone number
            $phone = Auth::user()->phone;

            // Check if the phone number is exactly 10 digits
            if (preg_match('/^\d{10}$/', $phone)) {
                // Format the plain 10-digit phone number
                $formattedPhone = '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
            } else {
                // Display the phone number as is, or mark as invalid if needed
                $formattedPhone = $phone; // You can add 'Invalid Number' if desired
            }
        @endphp
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="mt-4">
                            @if (Auth::user()->image)
                                <img src="{{ asset('admin/upload/images/profile/' . Auth::user()->image) }}" class="rounded-circle" width="150" />
                            @else
                                <img src="{{ url('/') }}/admin/assets/images/users/profile.png" class="rounded-circle" width="150" />
                            @endif
                        </center>
                    </div>
                    <div>
                        <hr />
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Email address </small>
                        <h6>{{ Auth::user()->email }}</h6>
                        <small class="text-muted pt-4 db">Phone</small>
                        <h6> {{ $formattedPhone }}</h6>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-bs-toggle="pill" href="#current-month"
                                role="tab" aria-controls="pills-timeline" aria-selected="true">Profile Setting</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-bs-toggle="pill" href="#previous-month"
                                role="tab" aria-controls="pills-setting" aria-selected="false">Password Setting</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <form id="profile-form" class="form-horizontal form-material" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-md-12">Profile Image</label>
                                        <div class="col-md-12">
                                            <input type="file" accept="image/*" class="form-control form-control-line"
                                                name="profile_image" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{ Auth::user()->name }}"
                                                class="form-control form-control-line" name="name" required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" value="{{ Auth::user()->email }}"
                                                class="form-control form-control-line" name="email" id="example-email"
                                                required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{ $formattedPhone }}"
                                                class="form-control form-control-line" name="phone" required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">
                                                Update Profile
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form id="password-form" class="form-horizontal form-material">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-md-12">Old Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="old_password" class="form-control form-control-line" required />
                                        </div>
                                    </div>
                                    <div class="note-box mb-3" style="border: 1px solid #c7760d; padding: 10px; font-size: 12px; color: #a30b0b;">
                                        <strong>Note:</strong> Password should be a minimum of <b>6 characters</b>, including at
                                        least <b>one special character and one uppercase letter</b>.
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="new_password" class="form-control form-control-line" required />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="confirm_password" class="form-control form-control-line" required />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">
                                                Update Password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('#profile-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: '{{ route('driver.profile.update') }}', // Use the route name for URL
                    method: 'POST',
                    data: new FormData(this), // Send form data
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        location.reload();
                    },
                    error: function(xhr) {
                        // Clear any previous error messages
                        $('.error-message').remove();

                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        if (errors) {
                            $.each(errors, function(fieldName, errorMessages) {
                                var field = $('[name="' + fieldName +
                                '"]'); // Find the input field
                                // Append the validation message after the input field
                                field.after('<div class="text-danger error-message"> * ' +
                                    errorMessages[0] + '</div>');
                            });
                        } else {
                            errorMessage = 'An unexpected error occurred.';
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        });



        $('#password-form').on('submit', function(e) {
            e.preventDefault();
            $('.error-message').remove(); // Clear previous errors
            // Get the new and confirm passwords
            var newPassword = $('[name="new_password"]').val();
            var confirmPassword = $('[name="confirm_password"]').val();

            // Regular expression to check password requirements
            var passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
            // Check if the new password and confirm password match
            if (newPassword !== confirmPassword) {
                Swal.fire({
                    title: 'Error!',
                    text: 'New Password and Confirm Password do not match.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Stop the form submission
            }

            // Check if new password meets the required criteria
        if (!passwordRegex.test(newPassword)) {
                Swal.fire({
                    title: 'Error!',
                    html: 'Password should be a minimum of <b>6 characters</b>, including at least <b>one special character</b> and <b>one uppercase letter</b>.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; // Stop the form submission
            }
            $.ajax({
                url: '{{ route("driver.update.password") }}', // Adjust to your route
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(fieldName, errorMessages) {
                            var field = $('[name="' + fieldName + '"]');
                            field.after('<div class="text-danger error-message">' + errorMessages[0] + '</div>');
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    </script>
@endpush
