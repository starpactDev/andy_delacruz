@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Add Potential Customers </h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active"> Add</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-4">
                            {{-- <h4 class="card-title"><img src="{{ url('/') }}/admin/assets/images/users/usa.jpg"
                                    alt="user" class="rounded-circle" width="40" /> USA DRIVERS</h4> --}}
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-light-primary text-primary font-weight-medium rounded-pill px-4"
                                        onclick="window.location.href='{{ route('user.potential_customer.view') }}'">
                                        View Potential Customers List
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h3 class="card-title " style="color:blueviolet;font-weight:600"> Complete the Customer details</h3>
                        <h5 class="card-subtitle mb-3 pb-3 mt-3 border-bottom">
                            to ensure they receive the best possible service and stay informed
                            about our latest offerings.
                        </h5>
                        <form id="potentialCustomerForm">
                            <div class="form-floating mb-3">
                                <input type="text" name="full_name" class="form-control border border-success"
                                    placeholder="Username">
                                <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-user feather-sm text-success fill-white me-2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg><span class="border-start border-success ps-3">Full Name</span></label>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control border border-success"
                                    placeholder="Email">
                                <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-mail feather-sm text-success fill-white me-2">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg><span class="border-start border-success ps-3">Email address</span></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" name="phone_number" class="form-control border border-success"
                                    placeholder="Phone Number">
                                <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-phone feather-sm text-success fill-white me-2">
                                        <path
                                            d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                        </path>
                                    </svg><span class="border-start border-success ps-3">Phone Number</span></label>
                            </div>
                            <!-- Address Field -->
                            <div class="form-floating mb-3">
                                <input type="text" name="address" class="form-control border border-success"
                                    placeholder="Address">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-map-pin feather-sm text-success fill-white me-2">
                                        <path d="M21 10c0 7.34-9 13-9 13S3 17.34 3 10a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span class="border-start border-success ps-3">Address</span>
                                </label>
                            </div>
                            <!-- City Field -->
                            <div class="form-floating mb-3">
                                <input type="text" name="city" class="form-control border border-success"
                                    placeholder="City">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-home feather-sm text-success fill-white me-2">
                                        <path d="M3 9.5l9-7 9 7"></path>
                                        <path d="M9 22V12H5v10"></path>
                                        <path d="M16 22v-6h-4v6"></path>
                                    </svg>
                                    <span class="border-start border-success ps-3">City</span>
                                </label>
                            </div>
                            <!-- State Field -->
                            <div class="form-floating mb-3">
                                <input type="text"name="state" class="form-control border border-success"
                                    placeholder="State">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-globe feather-sm text-success fill-white me-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10A15.3 15.3 0 0 1 8 12 15.3 15.3 0 0 1 12 2z">
                                        </path>
                                    </svg>
                                    <span class="border-start border-success ps-3">State</span>
                                </label>
                            </div>

                            <!-- Zip Code Field -->
                            <div class="form-floating mb-3">
                                <input type="text" name="zip" class="form-control border border-success"
                                    placeholder="Zip Code">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-hash feather-sm text-success fill-white me-2">
                                        <line x1="4" y1="9" x2="20" y2="9"></line>
                                        <line x1="4" y1="15" x2="20" y2="15"></line>
                                        <line x1="10" y1="3" x2="8" y2="21"></line>
                                        <line x1="16" y1="3" x2="14" y2="21"></line>
                                    </svg>
                                    <span class="border-start border-success ps-3">Zip Code</span>
                                </label>
                            </div>

                            <div class="d-md-flex align-items-center">

                                <div class="mt-3 mt-md-0 ms-auto">
                                    <button type="submit"
                                        class="
                                btn btn-success
                                font-weight-medium
                                rounded-pill
                                px-4
                              ">
                                        <div class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-send feather-sm fill-white me-2">
                                                <line x1="22" y1="2" x2="11" y2="13">
                                                </line>
                                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                            </svg>
                                            Submit
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Create Modal -->
            <!-- Payment Status Modal -->

            <!-- Column -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#potentialCustomerForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the page from refreshing


                // Clear previous error messages
                $('.text-danger').remove(); // Remove any previous error spans

                $.ajax({
                    url: '{{ route('user.potentialCustomer.store') }}', // Your route here
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        full_name: $('input[name="full_name"]').val(),
                        email: $('input[name="email"]').val(),
                        phone_number: $('input[name="phone_number"]').val(),
                        address: $('input[name="address"]').val(),
                        city: $('input[name="city"]').val(),
                        state: $('input[name="state"]').val(),
                        zip: $('input[name="zip"]').val()
                    },
                    success: function(response) {
                        // Display SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your request has been sent successfully.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to a new route after clicking "OK"
                                window.location.href =
                                    '{{ route('user.potential_customer.view') }}';
                            }
                        });

                        // Reset the form
                        $('#potentialCustomerForm')[0].reset();
                    },
                    error: function(response) {
                        // Handle validation errors
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            // Append error message span dynamically under the input field
                            $('input[name="' + field + '"]').after(
                                '<span class="text-danger error-' + field + '">' +
                                messages[0] + '</span>');
                        });
                    }
                });
            });

        });
    </script>
@endpush
