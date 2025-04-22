@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Employee List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Employee List</li>
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
                            <h4 class="card-title">Employee List</h4>
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button"
                                        class="
                          btn btn-light-primary
                          text-primary
                          font-weight-medium
                          rounded-pill
                          px-4
                        "
                                        data-bs-toggle="modal" data-bs-target="#createmodel">
                                        Create New Account
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee Id</th>
                                        <th>Full Name</th>
                                        <th>E-mail</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Job Position</th> <!-- New Job Position Column -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <!-- Assuming 'id' is the primary key -->
                                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>
                                                @php
                                                    // Get the phone number
                                                    $phone = $employee->phone_number;

                                                    // Check if the phone number is exactly 10 digits
                                                    if (preg_match('/^\d{10}$/', $phone)) {
                                                        // Format the plain 10-digit phone number
                                                        $formattedPhone =
                                                            '(' .
                                                            substr($phone, 0, 3) .
                                                            ') ' .
                                                            substr($phone, 3, 3) .
                                                            '-' .
                                                            substr($phone, 6);
                                                    } else {
                                                        // Display the phone number as is, or mark as invalid if needed
                                                        $formattedPhone = $phone; // You can add 'Invalid Number' if desired
                                                    }
                                                @endphp
                                                {{ $formattedPhone }}
                                            </td>
                                            <td>{{ $employee->street_address }}, {{ $employee->city }},
                                                {{ $employee->state }}</td>
                                            <td>{{ $employee->job_position }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                    data-bs-toggle="tooltip" data-original-title="Edit"
                                                    onclick="editEmployee({{ $employee->id }})">
                                                    <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                </button>
                                                <button type="button"
                                                    class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                    data-bs-toggle="tooltip" data-original-title="Delete"
                                                    onclick="deleteEmployee({{ $employee->id }})">
                                                    <i class="mdi mdi-delete" aria-hidden="true"></i>
                                                </button>
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
            <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="createEmployeeForm">
                            @csrf
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="createModalLabel">
                                    <i class="ti-marker-alt me-2"></i> Create New Employee Account
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Enter First Name Here" aria-label="first_name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="last_name"
                                        placeholder="Enter Last Name Here" aria-label="last_name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="mail" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter E-mail Address Here" aria-label="email" />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="phone" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="phone_number"
                                        placeholder="Enter Phone Number Here" aria-label="phone_number" />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="briefcase" class="feather-sm fil-white"></i>
                                    </button>
                                    <select class="form-control" name="job_position" aria-label="job_position">
                                        <option value="" disabled selected>Select Job Position</option>
                                        <optgroup label="US Positions">
                                            <option value="US Manager">US Manager</option>
                                            <option value="US Sub-Manager">US Sub-Manager</option>
                                            <option value="US Supervisor">US Supervisor</option>
                                            <option value="US Driver">US Driver</option>
                                            <option value="US Package Receiver">US Package Receiver</option>
                                        </optgroup>
                                        <optgroup label="RD Positions">
                                            <option value="RD Manager">RD Manager</option>
                                            <option value="RD Sub-Manager">RD Sub-Manager</option>
                                            <option value="RD Supervisor">RD Supervisor</option>
                                            <option value="RD Driver">RD Driver</option>
                                            <option value="RD Package Distributor">RD Package Distributor</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map-pin" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="street_address"
                                        placeholder="Enter Street Address Here" aria-label="street_address" />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="home" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="city"
                                        placeholder="Enter City Here" aria-label="city" />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="state"
                                        placeholder="Enter State Here" aria-label="state" />
                                </div>

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="hash" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" name="zip_code"
                                        placeholder="Enter ZIP Code Here" aria-label="zip_code" />
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-light-danger text-danger font-weight-medium rounded-pill px-4"
                                    data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Edit Modal -->
            <div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="editEmployeeForm">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" id="editEmployeeId">
                            <!-- For PUT method -->
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="editModalLabel">
                                    <i class="ti-marker-alt me-2"></i> Edit Employee Account
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="editFirstName" class="form-label">First Name</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="user" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="first_name" id="editFirstName"
                                            placeholder="Enter First Name Here" aria-label="first_name" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editLastName" class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="user" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="last_name" id="editLastName"
                                            placeholder="Enter Last Name Here" aria-label="last_name" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">E-mail Address</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="mail" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="email" class="form-control" name="email" id="editEmail"
                                            placeholder="Enter E-mail Address Here" aria-label="email" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="phone" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="phone_number"
                                            id="editPhoneNumber" placeholder="Enter Phone Number Here"
                                            aria-label="phone_number" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editJobPosition" class="form-label">Job Position</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="briefcase" class="feather-sm fil-white"></i>
                                        </button>
                                        <select class="form-control" name="job_position" id="editJobPosition"
                                            aria-label="job_position">
                                            <option value="" disabled selected>Select Job Position</option>
                                            <optgroup label="US Positions">
                                                <option value="US Manager">US Manager</option>
                                                <option value="US Sub-Manager">US Sub-Manager</option>
                                                <option value="US Supervisor">US Supervisor</option>
                                                <option value="US Driver">US Driver</option>
                                                <option value="US Package Receiver">US Package Receiver</option>
                                            </optgroup>
                                            <optgroup label="RD Positions">
                                                <option value="RD Manager">RD Manager</option>
                                                <option value="RD Sub-Manager">RD Sub-Manager</option>
                                                <option value="RD Supervisor">RD Supervisor</option>
                                                <option value="RD Driver">RD Driver</option>
                                                <option value="RD Package Distributor">RD Package Distributor</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editStreetAddress" class="form-label">Street Address</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="map-pin" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="street_address"
                                            id="editStreetAddress" placeholder="Enter Street Address Here"
                                            aria-label="street_address" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editCity" class="form-label">City</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="home" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="city" id="editCity"
                                            placeholder="Enter City Here" aria-label="city" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editState" class="form-label">State</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="map" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="state" id="editState"
                                            placeholder="Enter State Here" aria-label="state" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="editZipCode" class="form-label">ZIP Code</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-info">
                                            <i data-feather="hash" class="feather-sm fil-white"></i>
                                        </button>
                                        <input type="text" class="form-control" name="zip_code" id="editZipCode"
                                            placeholder="Enter ZIP Code Here" aria-label="zip_code" />
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-light-danger text-danger font-weight-medium rounded-pill px-4"
                                    data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    Save Changes
                                </button>
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
        $(document).ready(function () {
            $('#editEmployeeForm').on('submit', function (e) {
                e.preventDefault(); // Prevent form submission

                let employeeId = $('#editEmployeeId').val(); // Get employee ID
                let formData = $(this).serialize(); // Serialize form data

                // Ajax request
                $.ajax({
                    url: "{{ route('user.employee.update', '') }}/" + employeeId, // Laravel route for updating the employee
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
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
                    error: function (response) {
                        // Handle error - Display validation messages or generic error
                        let errors = response.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#' + key).after('<div class="text-danger">' + value[0] + '</div>');
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
                        url: "{{ route('user.employee.destroy', '') }}/" + employeeId, // Laravel route for deleting the employee
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
