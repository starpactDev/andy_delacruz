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
        }

        .action-buttons button {
            margin-bottom: 5px;
            /* Optional: Add space between buttons */
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Merchandise Suppiers List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Merchandise Suppiers List</li>
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
                            <h4 class="card-title">Merchandise Suppiers</h4>
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
                                        <th>Suppier Id</th>
                                        <th>Full Name</th>
                                        <th>E-mail</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>Sell Products</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
        <tr>
            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $supplier->first_name }} {{ $supplier->last_name }}</td>
            <td>{{ $supplier->email }}</td>
            <td>
                @php
                // Get the phone number
                $phone = $supplier->phone;

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
            <td>{{ $supplier->address }}, {{ $supplier->city }}, {{ $supplier->state }} {{ $supplier->zip }}</td>
            <td>
                <span class="badge bg-primary px-2 py-1 m-1">{{ $supplier->products }}</span>
            </td>
            <td>
                <div class="action-buttons">
                    <button type="button"
    class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
    data-bs-toggle="tooltip" data-original-title="Edit"
    data-id="{{ $supplier->id }}">
    <i class="mdi mdi-pencil" aria-hidden="true"></i>
</button>
                    <button type="button"
                                                    class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                    data-bs-toggle="tooltip" data-original-title="Delete"
                                                    onclick="deleteSupplier({{ $supplier->id }})">
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
                        <form id="createSupplierForm">
                            @csrf
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="createModalLabel">
                                    <i class="ti-marker-alt me-2"></i> Create New Supplier Account
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter First Name Here" aria-label="first_name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name Here" aria-label="last_name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="mail" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-mail Address Here" aria-label="email" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="phone" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number Here" aria-label="phone" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map-pin" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Street Address Here" aria-label="address" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="home" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="city" class="form-control" placeholder="Enter City Here" aria-label="city" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="map" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="state" class="form-control" placeholder="Enter State Here" aria-label="state" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="hash" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="zip" class="form-control" placeholder="Enter ZIP Code Here" aria-label="zip" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="tag" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" name="products" class="form-control" placeholder="Enter their Sell Products Name" aria-label="products" />
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger text-danger font-weight-medium rounded-pill px-4" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill px-4">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSupplierForm">
                    @csrf
                    <input type="hidden" id="supplierId" name="supplierId">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>
                    <div class="mb-3">
                        <label for="zip" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip" name="zip" required>
                    </div>
                    <div class="mb-3">
                        <label for="products" class="form-label">Sell Products</label>
                        <input type="text" class="form-control" id="products" name="products" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Supplier</button>
                </form>
            </div>
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
            $("form").on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Clear previous validation messages
                $(".text-danger").remove();

                // Get form data
                var formData = {
                    first_name: $("input[placeholder='Enter First Name Here']").val(),
                    last_name: $("input[placeholder='Enter Last Name Here']").val(),
                    email: $("input[placeholder='Enter E-mail Address Here']").val(),
                    phone: $("input[placeholder='Enter Phone Number Here']").val(),
                    address: $("input[placeholder='Enter Street Address Here']").val(),
                    city: $("input[placeholder='Enter City Here']").val(),
                    state: $("input[placeholder='Enter State Here']").val(),
                    zip: $("input[placeholder='Enter ZIP Code Here']").val(),
                    products: $("input[placeholder='Enter their Sell Products Name']").val(),

                    _token: "{{ csrf_token() }}"
                };

                // AJAX request
                $.ajax({
                    url: "{{ route('user.supplier.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: response.success,
    }).then(() => {
        // Close the modal
        $('#createmodel').modal('hide'); // Replace with your modal's ID

        // Optionally, you can reset the form
        $("#createSupplierForm")[0].reset();

        // Reload the page or redirect
        location.reload(); // Reloads the current page
        // OR
        // window.location.href = '/your-desired-location'; // Redirects to a specific URL
    });
},
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        // Clear previous error messages
                        $('.error-message').remove();

                        // Loop through the errors and display them in the desired div
                        $.each(errors, function(fieldName, errorMessages) {
                            var field = $('[name="' + fieldName +
                            '"]'); // Find the input field by name attribute
                            // Append validation message to the specified div (adjust div selector accordingly)
                            field.closest('.input-group').after(
                                '<div class="mb-3"><span class="text-danger error-message">' +
                                errorMessages[0] + '</span></div>'
                            );
                        });
                    }
                });
            });
        });
    </script>


<script>
    function deleteSupplier(employeeId) {
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
                    url: "{{ route('user.supplier.destroy', '') }}/" + employeeId, // Laravel route for deleting the employee
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}" // CSRF token for Laravel
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire(
                            'Deleted!',
                            'Supplier Record deleted successfully',
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
        // Store the route for fetching supplier data
        const fetchSupplierUrl = "{{ route('user.supplier.show', ':id') }}"; // Use ':id' as a placeholder

        $('.edit-row-btn').on('click', function() {
            const supplierId = $(this).data('id');

            // Replace ':id' with the actual supplier ID in the URL
            const url = fetchSupplierUrl.replace(':id', supplierId);

            // Fetch supplier data using AJAX
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Populate the modal fields
                    $('#supplierId').val(response.id);
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    $('#address').val(response.address);
                    $('#city').val(response.city);
                    $('#state').val(response.state);
                    $('#zip').val(response.zip);
                    $('#products').val(response.products);

                    // Show the modal
                    $('#editSupplierModal').modal('show');
                }
            });
        });

        // Handle the form submission for updating supplier data
        $('#editSupplierForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url:  "{{ route('user.supplier.update') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                    }).then(() => {
                        // Reload the page to see updated supplier data
                        location.reload();
                    });
                },
                error: function(xhr) {
                    // Handle errors here (optional)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                    });
                }
            });
        });
    });
</script>
@endpush
