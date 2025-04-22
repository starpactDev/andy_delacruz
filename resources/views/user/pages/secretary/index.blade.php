@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .action-buttons {
            width: 70px;
            height: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* This centers the buttons */
            justify-content: space-between;
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Secretary List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Secretary List</li>
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
                            <h4 class="card-title">All Secretary</h4>
                            <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button" class=" btn btn-light-primary text-primary font-weight-medium rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createmodel"> Create New Secretary</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>Secretary Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>

                                        <th>Joining date</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $manager)
                                        <!-- Loop through managers array -->
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <img src="{{ url('/') }}/admin/upload/images/profile/{{ $manager->user->image ?? 'profile.png' }}"
                                                    alt="user" class="rounded-circle" width="30" />
                                                <span class="fw-normal">{{ $manager->user->name }}</span>
                                            </td>
                                            <td>{{ $manager->user->email }}</td>
                                            <td>{{ $manager->user->phone }}</td>
                                            <td>{{ $manager->street_address }}, {{ $manager->city }}, {{ $manager->state }},
                                                {{ $manager->zip }}</td>
                                            <td>{{ \Carbon\Carbon::parse($manager->created_at)->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <!-- Edit Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $manager->user_id }}"
                                                        data-name="{{ $manager->user->name }}"
                                                        data-email="{{ $manager->user->email }}"
                                                        data-phone="{{ $manager->user->phone }}"
                                                        data-street="{{ $manager->street_address }}"
                                                        data-city="{{ $manager->city }}"
                                                        data-state="{{ $manager->state }}" data-zip="{{ $manager->zip }}"
                                                        data-image="{{ $manager->user->image ?? 'profile.png' }}">
                                                        <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                    </button>


                                                    <!-- Delete Button -->
                                                    <button type="button"
                                                    class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                    data-bs-toggle="tooltip" data-original-title="Delete"
                                                    data-id="{{ $manager->user_id }}">
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
            <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="createSecretaryForm">
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="createModalLabel">
                                    <i class="ti-marker-alt me-2"></i> Create New Secretary
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="download" class="feather-sm fil-white"></i>
                                    </button>
                                    <div class="custom-file">
                                        <label for="inputGroupFile01" class="form-control">Upload Profile Picture</label>
                                        <input type="file" class="form-control" id="inputGroupFile01"
                                            name="profile_picture" />
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter Full Name Here"
                                        aria-label="name" name="name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="mail" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="email" class="form-control" placeholder="Enter Email Address Here"
                                        aria-label="email" name="email" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="phone" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number Here"
                                        aria-label="phone" name="phone" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map-pin" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter Street Address Here"
                                        aria-label="address" name="address" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="home" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter City Here"
                                        aria-label="city" name="city" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter State Here"
                                        aria-label="state" name="state" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="hash" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter ZIP Code Here"
                                        aria-label="zip" name="zip" />
                                </div>
                                <div class="note-box mb-3"
                                    style="border: 1px solid #c7760d; padding: 10px; font-size: 12px; color: #a30b0b;">
                                    <strong>Note:</strong> Password should be a minimum of <b>6 characters</b>, including at
                                    least <b>one special character and one uppercase letter</b>.
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="lock" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="password" class="form-control" placeholder="Enter Password Here"
                                        aria-label="password" name="password" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="lock" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="password" class="form-control" placeholder="Confirm Password Here"
                                        aria-label="confirm-password" name="confirm_password" />
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
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-xl">
                        <form id="editDriverForm" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="user_id" id="user_id">

                                <div class="text-center mb-3">
                                    <img id="profilePreview" src="" class="rounded-circle" width="50"
                                        height="40" alt="Profile Image">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="editProfileImage" name="profileImage"
                                        accept="image/*">
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Full Name" id="editFullName" name="name">
                                    <label>Full Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control border border-success" placeholder="Email"
                                        id="editEmail" name="email">
                                    <label>Email address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control border border-success"
                                        placeholder="Phone Number" id="editPhone" name="phone">
                                    <label>Phone Number</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Street Address" id="editStreet" name="street">
                                    <label>Street Address</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success" placeholder="City"
                                        id="editCity" name="city">
                                    <label>City</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success" placeholder="State"
                                        id="editState" name="state">
                                    <label>State</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Zip Code" id="editZip" name="zip">
                                    <label>Zip Code</label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger text-danger"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
            $('#createmodel form').on('submit', function(e) {
                e.preventDefault();
                var password = $('[name="password"]').val();
                var confirmPassword = $('[name="confirm_password"]').val();
                var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{6,}$/;


                // Check if passwords do not match
                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Password and Confirm Password do not match!'
                    });
                    return; // Stop form submission
                }
                // Check if password meets the criteria
                if (!passwordPattern.test(password)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password',
                        text: 'Password should be a minimum of 6 characters, include at least one special character and one uppercase letter.'
                    });
                    return; // Stop form submission
                }
                // Clear previous validation errors
                $('.text-danger').remove();
                $('.is-invalid').removeClass('is-invalid');

                let formData = new FormData(this); // Use FormData to handle file uploads
                $.ajax({
                    url: "{{ route('user.secretary.store') }}", // Your route name for storing manager data
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        // Handle successful response
                        Swal.fire('Success', 'Secretary created successfully!', 'success');
                        $('#createmodel').modal('hide');
                        location.reload(); // Reload the page to show updated data
                        // Optionally reload the page or table
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            // Loop through validation errors and display them under the relevant field
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(fieldName, errorMessages) {
                                var field = $('[name="' + fieldName +
                                    '"]'); // Find the input field
                                // Find the parent input-group and append the validation message in a new div after it
                                field.closest('.input-group').after(
                                    '<div class="mb-3"><span class="text-danger error-message">' +
                                    errorMessages[0] + '</span></div>');
                            });
                        } else {
                            Swal.fire('Error', 'Something went wrong. Please try again.',
                                'error');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        // Use jQuery to handle the modal open event
        $(document).ready(function() {
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal

                // Get data attributes from the button
                var userId = button.data('id');
                var name = button.data('name');
                var email = button.data('email');
                var phone = button.data('phone');
                var street = button.data('street');
                var city = button.data('city');
                var state = button.data('state');
                var zip = button.data('zip');
                var image = button.data('image');

                // Populate the modal fields
                var modal = $(this);
                modal.find('#user_id').val(userId);
                modal.find('#editFullName').val(name);
                modal.find('#editEmail').val(email);
                modal.find('#editPhone').val(phone);
                modal.find('#editStreet').val(street);
                modal.find('#editCity').val(city);
                modal.find('#editState').val(state);
                modal.find('#editZip').val(zip);

                // Set the profile image preview
                modal.find('#profilePreview').attr('src',
                    "{{ url('/') }}/admin/upload/images/profile/" + image);
            });

            $('#editDriverForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this); // Create FormData object
                // Add CSRF token to the FormData
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.secretary.update') }}",
                    data: formData,
                    contentType: false, // Set to false to allow FormData to handle content type
                    processData: false, // Prevent jQuery from automatically transforming the data into a query string
                    success: function(response) {
                        // Handle success response
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#editModal').modal('hide'); // Hide the modal
                        // Optionally, refresh the manager table or update the row in the table
                        location.reload(); // Reload the page to see the updates
                    },
                    error: function(xhr) {
    // Clear previous error messages
    $('.error-message').remove();

    // General error handling with SweetAlert
    if (xhr.status === 422) {
        // Display a general error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: xhr.responseJSON.message || 'Validation errors occurred.',
        });

        // Loop through validation errors and display them under the relevant field
        let errors = xhr.responseJSON.errors;
        $.each(errors, function(fieldName, errorMessages) {
            var field = $('[name="' + fieldName + '"]'); // Find the input field

            // Append the validation message directly after the input field
            field.after(
                '<div class="mb-3"><span class="text-danger error-message">' +
                errorMessages[0] + '</span></div>'
            );
        });
    } else {
        // Handle other types of errors (e.g., server errors)
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong! Please try again.',
        });
    }
}
                });
            });
        });
    </script>

<script>
    $('.delete-row-btn').on('click', function() {
        var userId = $(this).data('id');

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
                $.ajax({
                    url: '{{ route('user.secretary.destroy', '') }}/' + userId, // Use route name
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Secretary Account has been deleted.',
                            'success'
                        );
                        location.reload(); // Reload the page to show updated data
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the Secretary.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
@endpush
