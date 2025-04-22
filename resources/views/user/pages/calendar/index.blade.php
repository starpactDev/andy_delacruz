@extends('admin.layouts.master')
@section('content')
    <style>
        .flatpickr-day {

            font-weight: 600;
        }

    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Calendar</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Calendar</li>
            </ol>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- -------------------------------------------------------------- -->
    <!-- Container fluid  -->
    <!-- -------------------------------------------------------------- -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div>
                        <div class="row gx-0">
                            <div class="col-lg-12">
                                <div class="p-4 calender-sidebar app-calendar">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN MODAL -->
                <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">
                                    Add / Edit Event
                                </h5>
                                <button type="button" class="btn-close closeModalBtn" data-bs-dismiss="modal"
                                    id="" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="">
                                            <label class="form-label">Event Title</label>
                                            <input id="event-title" type="text" class="form-control" />
                                        </div>
                                    </div>
                                    <!-- Date Picker -->
                                    <div class="col-md-12 mt-4">
                                        <div>
                                            <label class="form-label">Event Date</label>
                                            <input id="event-date" type="date" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="mb-3">
                                            <label class="form-label mb-2" for="employee">Assign Customer</label>
                                            <select class="form-select" id="assigned_employee" name="assigned_employee">
                                                <option value="" style="color:blue;">Select Customer from Potential
                                                    Customer List</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->full_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="note-box"
                                        style="width:95%;border: 1px solid #86b7f7; padding: 10px; font-size: 14px; color: #0f0947;">
                                        <strong>Note:</strong> If the customer you want is not in the list, you can <b>add a new customer</b> using the button below.
                                    </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-primary mt-4 mb-4"
                                                style="background-color:green" onclick="showAddCustomerModal()">Add New
                                                Potential Customer</button>
                                        </div>
                                    </div>
                                    {{-- <div class="note-box mx-auto"
                                        style="width:95%;border: 1px solid #c7760d; padding: 10px; font-size: 14px; color: #a30b0b;">
                                        <strong>Note:</strong> Order PickUp Times range from <b>One to Four hours</b>,
                                        depending on your location,
                                        but <b>we will call you before arriving at your home.</b>.
                                    </div> --}}
                                    <div class="col-md-12 mt-4">
                                        <div>
                                            <label class="form-label">Start Time</label>
                                            <input id="event-start-time" type="time" class="form-control"
                                                step="900" />
                                        </div>
                                    </div>

                                    <!-- End Time Picker -->
                                    <div class="col-md-12 mt-4">
                                        <div>
                                            <label class="form-label">End Time</label>
                                            <input id="event-end-time" type="time" class="form-control" step="900" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div>
                                            <label class="form-label">Comments</label>
                                            <textarea id="event-comments" class="form-control" rows="4" placeholder="Enter your comments here..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div id="event-color-wrapper"><label class="form-label">Event Color</label></div>
                                        <div class="d-flex">
                                            <div class="n-chk">
                                                <div class="form-check form-check-primary form-check-inline">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        value="Danger" id="modalDanger" />
                                                    <label class="form-check-label" for="modalDanger">Today
                                                        <span
                                                            style="display: inline-block; width: 20px; height: 20px; background-color: #FF2400; border: 1px solid #e45d5d; margin-right: 5px;"></span>


                                                    </label>
                                                </div>
                                            </div>
                                            <div class="n-chk">
                                                <div class="form-check form-check-danger form-check-inline">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        value="Warning" id="modalWarning" />
                                                    <label class="form-check-label" for="modalWarning">Tomorrow

                                                        <span
                                                            style="display: inline-block; width: 20px; height: 20px; background-color: #FFEF00; border: 1px solid #dee78c; margin-right: 5px;"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="n-chk">
                                                <div class="form-check form-check-warning form-check-inline">
                                                    <input class="form-check-input" type="radio" name="color"
                                                        value="Success" id="modalSuccess" />

                                                    <label class="form-check-label" for="modalSuccess">
                                                        During the Week <span
                                                            style="display: inline-block; width: 20px; height: 20px; background-color: #0AFFFF; border: 1px solid #b8f8f0; margin-right: 5px;"></span></label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <input type="hidden" id="event-id" name="event-id">
                                    <div class="col-md-12 mt-4">
                                        <div class="mb-3">
                                            <label class="form-label mb-2" for="province">Assign USA Driver</label>
                                            <select class="form-select" id="driver" name="assigned_driver">
                                                <option value="" style="color:blue;">Select a U.S. driver for order pickup</option>
                                                @foreach ($usaTeamDrivers as $usaTeamDriver)
                                                    <option value="{{ $usaTeamDriver->user->id }}">
                                                        {{ $usaTeamDriver->user->name }} ({{ $usaTeamDriver->user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-danger" style="background-color:#ff0877"
                                            id="confirmAssignBtn">Confirm Assign</button>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn closeModalBtn" data-bs-dismiss="modal" id="">
                                    Close
                                </button>
                                <button type="button" class="btn btn-success btn-update-event"
                                    data-fc-event-public-id="">
                                    Update changes
                                </button>
                                <button type="button" class="btn btn-primary btn-add-event">
                                    Add Event
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->
                <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="potentialCustomerForm">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="full_name" class="form-control border border-success"
                                            placeholder="Username">
                                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-user feather-sm text-success fill-white me-2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg><span class="border-start border-success ps-3">Full Name</span></label>
                                    </div>


                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control border border-success"
                                            placeholder="Email">
                                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-mail feather-sm text-success fill-white me-2">
                                                <path
                                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg><span class="border-start border-success ps-3">Email
                                                address</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="tel" name="phone_number"
                                            class="form-control border border-success" placeholder="Phone Number">
                                        <label><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-phone feather-sm text-success fill-white me-2">
                                                <path
                                                    d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                                </path>
                                            </svg><span class="border-start border-success ps-3">Phone
                                                Number</span></label>
                                    </div>
                                    <!-- Address Field -->
                                    <div class="form-floating mb-3">
                                        <input type="text" name="address" class="form-control border border-success"
                                            placeholder="Address">
                                        <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-globe feather-sm text-success fill-white me-2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12">
                                                </line>
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
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-hash feather-sm text-success fill-white me-2">
                                                <line x1="4" y1="9" x2="20" y2="9">
                                                </line>
                                                <line x1="4" y1="15" x2="20" y2="15">
                                                </line>
                                                <line x1="10" y1="3" x2="8" y2="21">
                                                </line>
                                                <line x1="16" y1="3" x2="14" y2="21">
                                                </line>
                                            </svg>
                                            <span class="border-start border-success ps-3">Zip Code</span>
                                        </label>
                                    </div>


                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="saveCustomer()">Save
                                    Customer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Container fluid  -->
@endsection
@push('script')
    <script>
        var calendarEventsRoute = "{{ route('user.calendar.events.get') }}";
    </script>
    <script src="{{ url('/') }}/admin/dist/libs/fullcalendar/index.global.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/pages/calendar/cal-init.js"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Flatpickr on the input
            flatpickr("#event-date", {
                dateFormat: "Y-m-d", // Change format as needed

                // Additional options can go here
            });

            // Your existing modal and other JS code here...
        });
    </script>
    <script>
        document.getElementById('event-start-time').addEventListener('click', function() {
            this.showPicker(); // Open the time picker
        });

        document.getElementById('event-end-time').addEventListener('click', function() {
            this.showPicker(); // Open the time picker
        });
    </script>

    <script>
        $(document).ready(function() {
            // When the end time changes
            $('#event-end-time').on('change', function() {
                // Get the start and end time values
                var startTime = $('#event-start-time').val();
                var endTime = $(this).val();

                // Check if both start and end times are selected
                if (startTime && endTime) {
                    // Convert time strings to Date objects for comparison
                    var startTimeDate = new Date("01/01/2000 " + startTime);
                    var endTimeDate = new Date("01/01/2000 " + endTime);

                    // If end time is less than or equal to start time, show the SweetAlert
                    if (endTimeDate <= startTimeDate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Time Selection',
                            text: 'End time must be later than the start time!',
                        });

                        // Optionally, you can clear the invalid end time
                        $('#event-end-time').val('');
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var isConfirmed = true; // Start with true since no driver selection change has happened
            var initialDriverValue = $('#driver').val(); // Store the initial driver value
            // When the driver dropdown value changes, reset isConfirmed to false
            $('#driver').on('change', function() {
                var currentDriverValue = $(this).val();

                // If the value changes from the initial value, reset isConfirmed to false
                if (currentDriverValue !== initialDriverValue) {
                    isConfirmed = false;
                }
            });
            // Handle driver selection confirmation
            $('#confirmAssignBtn').on('click', function() {
                var selectedDriver = $('#driver').val(); // Get selected driver value
console.log(selectedDriver);
                if (selectedDriver) {
                    // Set confirmation flag to true when driver is selected
                    isConfirmed = true;
                    // Show success SweetAlert for confirmation
                    Swal.fire({
        title: 'Success!',
        text: 'Driver has been assigned successfully.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            // Hide the "Confirm Assign" button after confirmation
            document.getElementById('confirmAssignBtn').style.display = 'none';
        }
    });
                } else {
                    // Show warning SweetAlert when no driver is selected
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please select a U.S. driver first.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Handle form submission when the "Add Event" button is clicked
            $('.btn-add-event').click(function(e) {
                // Prevent form submission if driver selection is required but not confirmed
                var selectedDriver = $('#driver').val();

                if (selectedDriver && !isConfirmed) {
                    e.preventDefault(); // Prevent form submission

                    // Show error SweetAlert if driver is selected but not confirmed
                    Swal.fire({
                        title: 'Confirmation Required',
                        text: 'Please confirm the driver assignment before submitting the form.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    return; // Stop further execution
                }

                // Proceed with form submission if no driver is selected or driver is confirmed
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').text('');

                // Gather form data
                var eventTitle = $('#event-title').val();
                var eventDate = $('#event-date').val();
                var assigned_employee = $('#assigned_employee').val();
                var startTime = $('#event-start-time').val();
                var endTime = $('#event-end-time').val();
                var comments = $('#event-comments').val();
                var eventLevel = $("input[name='color']:checked").val();
                var driver = $('#driver').val();

                // Perform AJAX request
                $.ajax({
                    url: '{{ route('user.calendar.events.store') }}', // Replace with your correct route URL
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: eventTitle,
                        event_date: eventDate,
                        start_time: startTime,
                        end_time: endTime,
                        comments: comments,
                        color: eventLevel,
                        assigned_driver: driver,
                        assigned_employee: assigned_employee,
                    },
                    success: function(response) {
                        // Show success SweetAlert on successful submission
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        // Reset form fields after submission
                        $('#event-title').val('');
                        $('#event-date').val('');
                        $('#event-start-time').val('');
                        $('#event-end-time').val('');
                        $('#event-comments').val('');
                        $('#assigned_employee').val('');
                        $("input[name='color']").prop('checked',
                            false); // Uncheck all radio buttons
                        $('#driver').val(''); // Reset driver selection
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            // Display validation errors
                            if (errors.title) {
                                $('#event-title').after('<span class="text-danger">' + errors
                                    .title[0] + '</span>');
                            }
                            if (errors.event_date) {
                                $('#event-date').after('<span class="text-danger">' + errors
                                    .event_date[0] + '</span>');
                            }
                            if (errors.assigned_employee) {
                                $('#assigned_employee').after('<span class="text-danger">' +
                                    errors
                                    .assigned_employee[0] + '</span>');
                            }
                            if (errors.start_time) {
                                $('#event-start-time').after('<span class="text-danger">' +
                                    errors.start_time[0] + '</span>');
                            }
                            if (errors.end_time) {
                                $('#event-end-time').after('<span class="text-danger">' + errors
                                    .end_time[0] + '</span>');
                            }
                            if (errors.color) {
                                $("#event-color-wrapper").append(
                                    '<span class="text-danger d-block">' + errors.color[0] +
                                    '</span>');
                            }
                            if (errors.driver) {
                                $('#driver').after('<span class="text-danger">' + errors.driver[
                                    0] + '</span>');
                            }
                        }
                    }
                });
            });

            $('.btn-update-event').click(function(e) {

                // Prevent form submission if driver selection is required but not confirmed
                var selectedDriver = $('#driver').val();

                if (selectedDriver && !isConfirmed) {
                    e.preventDefault(); // Prevent form submission

                    // Show error SweetAlert if driver is selected but not confirmed
                    Swal.fire({
                        title: 'Confirmation Required',
                        text: 'Please confirm the driver assignment before submitting the form.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    return; // Stop further execution
                }

                // Proceed with form submission if no driver is selected or driver is confirmed
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').text('');

                // Gather form data
                var eventId = $('#event-id').val();
                var eventTitle = $('#event-title').val();
                var eventDate = $('#event-date').val();
                var assigned_employee = $('#assigned_employee').val();
                var startTime = $('#event-start-time').val();
                var endTime = $('#event-end-time').val();
                var comments = $('#event-comments').val();
                var eventLevel = $("input[name='color']:checked").val();
                var driver = $('#driver').val();

                // Perform AJAX request
                $.ajax({
                    url: '{{ route('user.calendar.events.update') }}', // Replace with your correct route URL
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: eventId,
                        title: eventTitle,

                        event_date: eventDate,
                        start_time: startTime,
                        end_time: endTime,
                        comments: comments,
                        color: eventLevel,
                        assigned_driver: driver,
                        assigned_employee: assigned_employee,
                    },
                    success: function(response) {
                        // Show success SweetAlert on successful submission
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        // Reset form fields after submission
                        $('#event-title').val('');
                        $('#event-date').val('');
                        $('#assigned_employee').val('');
                        $('#event-start-time').val('');
                        $('#event-end-time').val('');
                        $('#event-comments').val('');
                        $("input[name='color']").prop('checked',
                            false); // Uncheck all radio buttons
                        $('#driver').val(''); // Reset driver selection
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            // Display validation errors
                            if (errors.title) {
                                $('#event-title').after('<span class="text-danger">' + errors
                                    .title[0] + '</span>');
                            }
                            if (errors.event_date) {
                                $('#event-date').after('<span class="text-danger">' + errors
                                    .event_date[0] + '</span>');
                            }
                            if (errors.assigned_employee) {
                                $('#assigned_employee').after('<span class="text-danger">' +
                                    errors
                                    .assigned_employee[0] + '</span>');
                            }
                            if (errors.start_time) {
                                $('#event-start-time').after('<span class="text-danger">' +
                                    errors.start_time[0] + '</span>');
                            }
                            if (errors.end_time) {
                                $('#event-end-time').after('<span class="text-danger">' + errors
                                    .end_time[0] + '</span>');
                            }
                            if (errors.color) {
                                $("#event-color-wrapper").append(
                                    '<span class="text-danger d-block">' + errors.color[0] +
                                    '</span>');
                            }
                            if (errors.driver) {
                                $('#driver').after('<span class="text-danger">' + errors.driver[
                                    0] + '</span>');
                            }
                        }
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("eventModal")); // Modal initialization

            // Function to open the modal
            function openModal() {
                myModal.show(); // Show modal
            }

            // Event listener for the modal close button
            document.querySelectorAll('.closeModalBtn').forEach(btn => {
                btn.addEventListener('click', function() {




                    location.reload();

                });
            });

            // Example button to open modal
            document.getElementById('addEventButton').addEventListener('click', openModal);
        });
    </script>
    <script>
        function showAddCustomerModal() {
            var addCustomerModal = new bootstrap.Modal(document.getElementById('addCustomerModal'));
            addCustomerModal.show();
        }

        function saveCustomer() {
    alert("hello");
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
                text: 'Customer has been added successfully.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Close the modal
                    $('#addCustomerModal').modal('hide');

                    // Append the new customer to the dropdown list
                    $('#assigned_employee').append(
                        `<option value="${response.id}">${response.full_name}</option>`
                    );

                    // Select the newly added customer in the dropdown
                    $('#assigned_employee').val(response.id);
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
}
    </script>
@endpush
