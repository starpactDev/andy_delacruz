@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .action-buttons {
            width: 100%;
            /* Allow the buttons to take up the full width of the cell */
            height: auto;
            /* Adapt height dynamically */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Center buttons horizontally */
            justify-content: space-evenly;
            /* Add even space between buttons */
            padding: 10px;
            /* Add padding for extra spacing */
            box-sizing: border-box;
            /* Include padding in width/height calculations */
        }

        .action-buttons button {
            margin: 5px 0;
            /* Add more space between buttons */
        }

        td {
            padding: 15px;
            /* Make the <td> spacious */
            vertical-align: middle;
            /* Vertically align content */
            overflow: hidden;
            /* Ensure content stays within boundaries */
            word-wrap: break-word;
            /* Prevent overflow due to text */
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Work Team Credentials</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Work Team Credentials</li>
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
                            <h4 class="card-title">Work Team Credentials</h4>

                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee Id</th>
                                        <th>Full Name</th>
                                        <th>Phone Number</th>
                                        <th>Useremail</th>
                                        <th>Password</th>
                                        <th>Address</th>
                                        <th>Job Position</th> <!-- New Job Position Column -->
                                        <th>Action</th> <!-- New Job Position Column -->

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mergedData as $data)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $data['full_name'] }}

                                            </td>
                                            <td>


                                                @php
                                                    // Format the phone number
                                                    $phone = $data['phone_number'];
                                                    $formattedPhone = preg_match('/^\d{10}$/', $phone)
                                                        ? '(' .
                                                            substr($phone, 0, 3) .
                                                            ') ' .
                                                            substr($phone, 3, 3) .
                                                            '-' .
                                                            substr($phone, 6)
                                                        : $phone;
                                                @endphp
                                                {{ $formattedPhone }}

                                            </td>
                                            <td>{{ $data['email'] }}</td>
                                            <td>{{ $data['password'] }}</td>
                                            <td>{{ $data['address'] }}</td>

                                            <td>{{ $data['job_position'] }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                        data-id="{{ $data['id'] }}">
                                                        <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                        data-id="{{ $data['id'] }}">
                                                        <i class="mdi mdi-delete" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Create Modal -->



            <!-- Edit Modal -->
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" id="ccloseButton" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="editEmployeeForm">
                            <div class="modal-body">
                                <style>
                                    .form-group {
                                        margin-top: 20px;
                                    }
                                </style>
                                <style>
                                    .imp-note {
                                        display: block;
                                        padding: 10px;
                                        margin-top: 5px;
                                        background-color: #eaf5ff;
                                        /* Light background */
                                        border: 1px solid #ccc;
                                        /* Border around the note */
                                        border-radius: 5px;
                                        /* Rounded corners */
                                        font-size: 0.9em;
                                        color: #1b0f5f;
                                        /* Text color */
                                    }
                                </style>
                                <small class="imp-note">You can't edit the <b>Address</b> or <b>Job Position</b> from
                                    here.</small>

                                <!-- Form fields -->
                                <input type="hidden" name="id" id="employee_id">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required>
                                </div>
                                <style>
                                    .password-note {
                                        display: block;
                                        padding: 10px;
                                        margin-top: 5px;
                                        background-color: #f8f9fa;
                                        /* Light background */
                                        border: 1px solid #ccc;
                                        /* Border around the note */
                                        border-radius: 5px;
                                        /* Rounded corners */
                                        font-size: 0.9em;
                                        color: #e41c1c;
                                        /* Text color */
                                    }
                                </style>
                                <div class="form-group">
                                    <label for="password">Update Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <small class="password-note">Password should be a minimum of <b>6 characters</b>,
                                        including at least <b>one special character and one uppercase letter</b></small>
                                </div>
                                <style>
                                    #address[readonly] {
                                        background-color: #fff;
                                        /* White background for contrast */
                                        border: 1px solid #ccc;
                                        /* Border color */
                                        cursor: pointer;
                                        /* Show a pointer cursor to imply it's clickable */
                                    }

                                    #address[readonly]:hover {
                                        background-color: #e9ecef;
                                        /* Lighter background on hover */
                                        border-color: #007bff;
                                        /* Change border to blue on hover */
                                    }
                                </style>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" readonly name="address" required rows="4"></textarea>
                                </div>

                                <style>
                                    #job_position[readonly] {
                                        background-color: #fff;
                                        /* White background for contrast */
                                        border: 1px solid #ccc;
                                        /* Border color */
                                        cursor: pointer;
                                        /* Show a pointer cursor to imply it's clickable */
                                    }

                                    #job_position[readonly]:hover {
                                        background-color: #e9ecef;
                                        /* Lighter background on hover */
                                        border-color: #007bff;
                                        /* Change border to blue on hover */
                                    }
                                </style>
                                <div class="form-group">
                                    <label for="job_position">Job Position</label>
                                    <input type="text" class="form-control" id="job_position" readonly
                                        name="job_position" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="closeButton"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    <script>
        $(document).ready(function() {
            // Open edit modal and populate data
            $('.edit-row-btn').on('click', function() {
                var id = $(this).data('id'); // Get employee ID
                $.ajax({
                    url: '{{ route('user.team.edit', ':id') }}'.replace(':id', id),
                    method: 'GET',
                    success: function(response) {
                        // Populate modal fields
                        $('#employee_id').val(response.data.id);
                        $('#full_name').val(response.data.full_name);
                        $('#email').val(response.data.email);
                        $('#phone_number').val(response.data.phone_number);
                        $('#address').val(response.data.address);
                        $('#job_position').val(response.data.job_position);
                        $('#editEmployeeModal').modal('show');
                    }
                });
            });

            // Handle form submission
            $('#editEmployeeForm').on('submit', function(e) {
                e.preventDefault();

                var id = $('#employee_id').val();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('user.team.update', ':id') }}'.replace(':id', id),
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF token for security
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            confirmButtonText: 'OK'
                        });
                        $('#editEmployeeModal').modal('hide');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(xhr) {
                        // Clear existing errors
                        $('.form-group .error-message').remove();

                        if (xhr.status === 422) { // Validation errors
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    // Append error under the relevant field
                                    $('#' + key).closest('.form-group').append(
                                        '<small class="error-message text-danger">' +
                                        errors[key][0] + '</small>'
                                    );
                                }
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });

            // Delete employee
            $('.delete-row-btn').on('click', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this employee?')) {
                    $.ajax({
                        url: '{{ route('user.team.delete', ':id') }}'.replace(':id', id),

                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content') // CSRF token for security
                        },
                        success: function(response) {
                            alert(response.success);
                            location.reload();
                        },
                        error: function(xhr) {
                            alert('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $('#closeButton').click(function() {
            $('#editEmployeeModal').modal('hide');
        });
        $('#ccloseButton').click(function() {
            $('#editEmployeeModal').modal('hide');
        });
    </script>
@endpush
