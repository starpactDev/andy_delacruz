@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Package Pickup Report</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Package Pickup Report</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <!-- Column -->
            @php
                // Helper function for status colors
                function getStatusColor($status)
                {
                    switch ($status) {
                        case 'order_created':
                            return 'rgb(38, 175, 33)'; // ACTIVE ORDER color
                        case 'not_at_home':
                            return '#a78c00'; // Orange for Not at Home
                        case 'come_back_later':
                            return '#055854'; // Blue for Come Back Later
                        case 'cancel_request':
                            return 'rgb(220, 53, 69)'; // Red for Cancel Request
                        default:
                            return 'rgb(128, 128, 128)'; // Default color
                    }
                }
            @endphp
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <h2 style="text-align: center;font-size:30px;color:red;font-weight:600">Today:</h2>
                            @if ($events->where('event_date', \Carbon\Carbon::today()->toDateString())->isEmpty())
                                <p style="text-align: center;font-size:20px;color:rgb(107, 55, 55);font-weight:600"
                                    class="no-events-message">No request for today.</p>
                            @else
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event Title</th>
                                            <th>Issue Date</th>
                                            <th>Pickup Date</th>
                                            <th>Pickup Time</th>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th>Assigned To</th> <!-- New Job Position Column -->
                                            <th>Comment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            @if (\Carbon\Carbon::parse($event->event_date)->isToday())
                                                <tr>
                                                    <td>{{ $event->title }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-warning px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                                            {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <h6 class="font-weight-medium mb-0">
                                                            {{ $event->assignedEmployee->full_name ?? 'N/A' }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            <i class="fa fa-envelope me-1"></i>
                                                            {{ $event->assignedEmployee->email ?? 'N/A' }}
                                                        </small><br>
                                                        <small class="text-muted">
                                                            <i class="fa fa-phone me-1"></i>
                                                            {{ $event->assignedEmployee->phone_number ?? 'N/A' }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        {{ $event->assignedEmployee->address ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->city ?? 'N/A' }},<br />
                                                        {{ $event->assignedEmployee->state ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->zip ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $event->driver ? $event->driver->name : 'N/A' }}</td>
                                                    <td>{{ $event->comments ?? 'N/A' }}</td>
                                                    <td>
                                                        <span id="status-{{ $event->id }}" class="badge px-3 py-2"
                                                            style="background-color: {{ getStatusColor($event->status ?? 'order_created') }};">
                                                            {{ ucwords(str_replace('_', ' ', $event->status ?? 'order_active')) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <h2 style="text-align: center; font-size: 30px; color: blue; font-weight: 600;">Upcoming Pickup
                                Request:</h2>
                            @if ($events->where('event_date', '>', \Carbon\Carbon::today()->toDateString())->isEmpty())
                                <p style="text-align: center; font-size: 20px; color: rgb(107, 55, 55); font-weight: 600;"
                                    class="no-events-message">No upcoming requests.</p>
                            @else
                                <table id="upcoming_events" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event Title</th>
                                            <th>Issue Date</th>
                                            <th>Pickup Date</th>
                                            <th>Pickup Time</th>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th>Assigned To</th> <!-- New Job Position Column -->
                                            <th>Comment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            @if (\Carbon\Carbon::parse($event->event_date)->isFuture())
                                                <tr>
                                                    <td>{{ $event->title }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-warning px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <h6 class="font-weight-medium mb-0">
                                                            {{ $event->assignedEmployee->full_name ?? 'N/A' }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            <i class="fa fa-envelope me-1"></i>
                                                            {{ $event->assignedEmployee->email ?? 'N/A' }}
                                                        </small><br>
                                                        <small class="text-muted">
                                                            <i class="fa fa-phone me-1"></i>
                                                            {{ $event->assignedEmployee->phone_number ?? 'N/A' }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        {{ $event->assignedEmployee->address ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->city ?? 'N/A' }},<br />
                                                        {{ $event->assignedEmployee->state ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->zip ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $event->driver ? $event->driver->name : 'N/A' }}</td>
                                                    <td>{{ $event->comments ?? 'N/A' }}</td>
                                                    <td>
                                                        <span id="status-{{ $event->id }}" class="badge px-3 py-2"
                                                            style="background-color: {{ getStatusColor($event->status ?? 'order_created') }};">
                                                            {{ ucwords(str_replace('_', ' ', $event->status ?? 'order_active')) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2 style="text-align: center; font-size: 30px; color: gray; font-weight: 600;">Past Pickup
                                Requests:</h2>
                            @if ($events->where('event_date', '<', \Carbon\Carbon::today()->toDateString())->isEmpty())
                                <p style="text-align: center; font-size: 20px; color: rgb(107, 55, 55); font-weight: 600;"
                                    class="no-events-message">No past requests.</p>
                            @else
                                <table id="past_events" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Event Title</th>
                                            <th>Issue Date</th>
                                            <th>Pickup Date</th>
                                            <th>Pickup Time</th>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th>Assigned To</th> <!-- New Job Position Column -->
                                            <th>Comment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            @if (\Carbon\Carbon::parse($event->event_date)->isPast())
                                                <tr>
                                                    <td>{{ $event->title }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-warning px-2 py-1">
                                                            {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <h6 class="font-weight-medium mb-0">
                                                            {{ $event->assignedEmployee->full_name ?? 'N/A' }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            <i class="fa fa-envelope me-1"></i>
                                                            {{ $event->assignedEmployee->email ?? 'N/A' }}
                                                        </small><br>
                                                        <small class="text-muted">
                                                            <i class="fa fa-phone me-1"></i>
                                                            {{ $event->assignedEmployee->phone_number ?? 'N/A' }}
                                                        </small>
                                                    </td>
                                                    <td>
                                                        {{ $event->assignedEmployee->address ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->city ?? 'N/A' }},<br />
                                                        {{ $event->assignedEmployee->state ?? 'N/A' }},
                                                        {{ $event->assignedEmployee->zip ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $event->driver ? $event->driver->name : 'N/A' }}</td>
                                                    <td>{{ $event->comments ?? 'N/A' }}</td>
                                                    <td>
                                                        <span id="status-{{ $event->id }}" class="badge px-3 py-2"
                                                            style="background-color: {{ getStatusColor($event->status ?? 'order_created') }};">
                                                            {{ ucwords(str_replace('_', ' ', $event->status ?? 'order_active')) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <!-- Create Modal -->

    <!-- End Edit Modal -->

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
            $('#createEmployeeForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear previous validation messages
                $('.error-message').remove();

                // Gather form data
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.employee.store') }}", // Replace with your route name
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // If success, show SweetAlert message
                        Swal.fire({
                            icon: 'success',
                            title: 'Employee Created Successfully!',
                            text: 'New employee account has been added.',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        // Reset the form
                        $('#createEmployeeForm')[0].reset();

                        // Close the modal
                        $('#createmodel').modal('hide');
                        location.reload();
                    },
                    error: function(response) {
                        // Show validation errors
                        var errors = response.responseJSON.errors;

                        // Loop through each field and append the validation message
                        $.each(errors, function(fieldName, errorMessages) {
                            var field = $('[name="' + fieldName +
                                '"]'); // Find the input field
                            // Find the parent input-group and append the validation message in a new div after it
                            field.closest('.input-group').after(
                                '<div class="mb-3"><span class="text-danger error-message">' +
                                errorMessages[0] + '</span></div>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function editEmployee(employeeId) {
            // Assuming you have an endpoint to get employee data by ID
            fetch(`{{ route('user.employee.show', '') }}/${employeeId}`)
                .then(response => response.json())
                .then(data => {
                    // Populate the modal fields with the fetched data
                    document.getElementById('editEmployeeId').value = data.id;
                    document.getElementById('editFirstName').value = data.first_name;
                    document.getElementById('editLastName').value = data.last_name;
                    document.getElementById('editEmail').value = data.email;
                    document.getElementById('editPhoneNumber').value = data.phone_number;
                    document.getElementById('editJobPosition').value = data.job_position;
                    document.getElementById('editStreetAddress').value = data.street_address;
                    document.getElementById('editCity').value = data.city;
                    document.getElementById('editState').value = data.state;
                    document.getElementById('editZipCode').value = data.zip_code;

                    // Show the modal
                    var editModal = new bootstrap.Modal(document.getElementById('editmodel'));
                    editModal.show();
                })
                .catch(error => {
                    console.error('Error fetching employee data:', error);
                });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#editEmployeeForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                let employeeId = $('#editEmployeeId').val(); // Get employee ID
                let formData = $(this).serialize(); // Serialize form data

                // Ajax request
                $.ajax({
                    url: "{{ route('user.employee.update', '') }}/" +
                        employeeId, // Laravel route for updating the employee
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        // Handle success - Show SweetAlert success
                        Swal.fire({
                            title: 'Success!',
                            text: 'Employee details updated successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        // Close the modal
                        $('#editmodel').modal('hide');
                        location.reload();
                    },
                    error: function(response) {
                        // Handle error - Display validation messages or generic error
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).after('<div class="text-danger">' + value[0] +
                                '</div>');
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function deleteEmployee(employeeId) {
            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send the DELETE request using AJAX
                    $.ajax({
                        url: "{{ route('user.employee.destroy', '') }}/" +
                            employeeId, // Laravel route for deleting the employee
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}" // CSRF token for Laravel
                        },
                        success: function(response) {
                            // Show success message
                            Swal.fire(
                                'Deleted!',
                                'Employee has been deleted.',
                                'success'
                            );
                            // Optionally, remove the deleted row from the table or reload the page
                            // $('#employeeRow_' + employeeId).remove(); // Example to remove row by ID
                            location.reload(); // Reload the page to reflect changes
                        },
                        error: function(response) {
                            // Show error message
                            Swal.fire(
                                'Error!',
                                'There was an issue deleting the employee.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
