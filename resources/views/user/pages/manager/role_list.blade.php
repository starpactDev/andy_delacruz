@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Default green color when toggle is on */
        .form-check-input:checked {
            background-color: #198754;
            /* Bootstrap's green */
            border-color: #198754;
        }

        /* Red color for toggle switch when it’s off */
        .form-check-input.off-state {
            border-color: #dc3545;
        }
    </style>
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
            <h3 class="text-themecolor mb-0">Manage Permissions for Manager</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Manage Permissions for Manager</li>
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
                            <h4 class="card-title">Manage Permissions for Manager</h4>

                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Entity</th>

                                        <th>Manage Access</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Driver Management</td>

                                        <td>
                                            <!-- Add Button -->
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-success add-row-btn"
                                                onclick="openActionModal('Add', 'driver')">
                                                <i class="mdi mdi-plus" aria-hidden="true"></i> Add
                                            </button>

                                            <!-- Edit Button -->
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                onclick="openActionModal('Edit', 'driver')">
                                                <i class="mdi mdi-pencil" aria-hidden="true"></i> Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                onclick="openActionModal('Delete', 'driver')">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i> Delete
                                            </button>
                                        </td>


                                        <!-- Modal Structure -->
                                        <div class="modal fade" id="actionModal" tabindex="-1"
                                            aria-labelledby="actionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Dynamic Title -->
                                                        <h5 class="modal-title" id="actionModalLabel"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Toggle Switch -->
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="managerToggle">
                                                            <label class="form-check-label" for="managerToggle">Allow
                                                                Manager Action</label>
                                                        </div>
                                                        <!-- Conditional Message -->
                                                        <p id="managerMessage" class="mt-3 text-success"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>
                                    <tr>
                                        <td>All Clients List</td>

                                        <td>
                                            <!-- Add Button -->
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="clientListSwitch" checked>
                                                <label class="form-check-label" id="clientListLabel" for="clientListSwitch">
                                                    Manager can see the client list
                                                </label>
                                            </div>



                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sender Docs & Receiver ID's</td>

                                        <td>
                                            <!-- Add Button -->
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="docsSwitch" checked>
                                                <label class="form-check-label" id="docsSwitchLabel" for="docsSwitch">
                                                    Manager can see those info
                                                </label>
                                            </div>



                                        </td>


                                        <!-- Modal Structure -->
                                        <div class="modal fade" id="actionModal" tabindex="-1"
                                            aria-labelledby="actionModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- Dynamic Title -->
                                                        <h5 class="modal-title" id="actionModalLabel"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Toggle Switch -->
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="managerToggle">
                                                            <label class="form-check-label" for="managerToggle">Allow
                                                                Manager Action</label>
                                                        </div>
                                                        <!-- Conditional Message -->
                                                        <p id="managerMessage" class="mt-3 text-success"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Create Modal -->



            <!-- Edit Supplier Modal -->

            <!-- Column -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection

@push('script')
    <script>
       function openActionModal(action, key) {
    // Set the modal title and message container
    const modalTitle = document.getElementById('actionModalLabel');
    const managerMessage = document.getElementById('managerMessage');
    const toggleSwitch = document.getElementById('managerToggle');

    modalTitle.textContent = `${action} Action`;

    // Reset the message and the switch state before checking the database
    managerMessage.style.display = 'block';
    toggleSwitch.checked = false;  // Set to off by default
    managerMessage.textContent = `The manager's ${action.toLowerCase()} action is disabled.`;
    managerMessage.classList.remove('text-success');
    managerMessage.classList.add('text-danger');

    // Open the modal
    const actionModal = new bootstrap.Modal(document.getElementById('actionModal'));
    actionModal.show();

    // AJAX to check if the permission exists in the database
    $.ajax({
        url: '{{ route('user.manage.permission.check') }}',  // Route to check the permission
        type: 'GET',
        data: {
            key: key,  // Dynamic key passed from the button click
            value: action.toLowerCase(),
            _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token for security
        },
        success: function(response) {
            if (response.exists) {
                // If the permission exists, toggle switch to ON (checked)
                managerMessage.textContent = `The manager's ${action.toLowerCase()} action is disabled.`;
            managerMessage.classList.remove('text-success');
            managerMessage.classList.add('text-danger');
            managerMessage.classList.add('fw-bold');
            toggleSwitch.classList.add('off-state');
            } else {
                // If the permission doesn't exist, set toggle to ON automatically
                toggleSwitch.checked = true;
                managerMessage.textContent = `Now, the manager can perform the ${action.toLowerCase()} action.`;
                managerMessage.classList.remove('text-danger');
                managerMessage.classList.add('text-success');
            }
        },
        error: function(xhr, status, error) {
            console.log('Error checking permission:', error);
        }
    });

    // Update message and color based on toggle switch change
    toggleSwitch.onchange = function() {
        managerMessage.style.display = 'block';
        if (toggleSwitch.checked) {
            // Toggle on: green message and switch
            managerMessage.textContent = `Now, the manager can perform the ${action.toLowerCase()} action.`;
            managerMessage.classList.remove('text-danger');
            managerMessage.classList.add('text-success');
            managerMessage.classList.add('fw-bold');
            toggleSwitch.classList.remove('off-state');

            // Delete record from the database
            $.ajax({
                url: '{{ route('user.manage.permission.delete') }}',  // Use the route name for deletion
                type: 'DELETE',
                data: {
                    key: key,  // Pass dynamic key here
                    value: action.toLowerCase(),
                    _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token for security
                },
                success: function(response) {
                    console.log('Record deleted successfully');
                },
                error: function(xhr, status, error) {
                    console.log('Error deleting record:', error);
                }
            });
        } else {
            // Toggle off: red message and switch
            managerMessage.textContent = `The manager's ${action.toLowerCase()} action is disabled.`;
            managerMessage.classList.remove('text-success');
            managerMessage.classList.add('text-danger');
            managerMessage.classList.add('fw-bold');
            toggleSwitch.classList.add('off-state');

            // Store value in the database
            $.ajax({
                url: '{{ route('user.manage.permission.store') }}',  // Use the route name for storing
                type: 'POST',
                data: {
                    key: key,  // Pass dynamic key here
                    value: action.toLowerCase(),
                    _token: $('meta[name="csrf-token"]').attr('content')  // CSRF Token for security
                },
                success: function(response) {
                    console.log('Record stored successfully');
                },
                error: function(xhr, status, error) {
                    console.log('Error storing record:', error);
                }
            });
        }
    };
}
    </script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const switchElement = document.getElementById('clientListSwitch');
    const label = document.getElementById('clientListLabel');

    // Fetch the current value from the database (AJAX request)
    fetch('{{ route('user.get-client-list-status') }}')
        .then(response => response.json())
        .then(data => {
            if (data.key === 'client_list' && data.value === 'off') {
                switchElement.checked = false;
                label.textContent = "Manager can't see the client list";
            } else {
                switchElement.checked = true;
                label.textContent = "Manager can see the client list";
            }
        })
        .catch(() => {
            console.error('Failed to fetch the client list status.');
        });

    // Add event listener for switch changes
    switchElement.addEventListener('change', function () {
        if (!this.checked) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to hide the client list from the manager dashboard?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update the database to set the value to 'off'
                    fetch('{{ route('user.update-client-list-permission') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ key: 'client_list', value: 'off' }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                label.textContent = "Manager can't see the client list";
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated',
                                    text: 'Manager can’t see the client list anymore.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to update the permission.',
                                });
                                this.checked = true; // Revert switch
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                            this.checked = true; // Revert switch
                        });
                } else {
                    this.checked = true; // Revert switch
                }
            });
        } else {
            // Delete the database row when toggled back on
            fetch('{{ route('user.delete-client-list-permission') }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ key: 'client_list' }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        label.textContent = "Manager can see the client list";
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Manager can now see the client list.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update the permission.',
                        });
                        this.checked = false; // Revert switch
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                    this.checked = false; // Revert switch
                });
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const switchElement = document.getElementById('docsSwitch');
    const label = document.getElementById('docsSwitchLabel');

    // Fetch the current value from the database (AJAX request)
    fetch('{{ route('user.get-docs-status') }}')
        .then(response => response.json())
        .then(data => {
            if (data.key === 'docs_list' && data.value === 'off') {
                switchElement.checked = false;
                label.textContent = "Manager can't see those info";
            } else {
                switchElement.checked = true;
                label.textContent = "Manager can see those info";
            }
        })
        .catch(() => {
            console.error('Failed to fetch the docs status.');
        });

    // Add event listener for switch changes
    switchElement.addEventListener('change', function () {
        if (!this.checked) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to hide the docs info from the manager dashboard?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update the database to set the value to 'off'
                    fetch('{{ route('user.update-docs-list-permission') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ key: 'docs_list', value: 'off' }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                label.textContent = "Manager can't see the docs info";
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated',
                                    text: 'Manager can’t see the docs info anymore.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to update the permission.',
                                });
                                this.checked = true; // Revert switch
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!',
                            });
                            this.checked = true; // Revert switch
                        });
                } else {
                    this.checked = true; // Revert switch
                }
            });
        } else {
            // Delete the database row when toggled back on
            fetch('{{ route('user.delete-docs-list-permission') }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ key: 'docs_list' }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        label.textContent = "Manager can see those info";
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Manager can now see those info.',
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update the permission.',
                        });
                        this.checked = false; // Revert switch
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                    });
                    this.checked = false; // Revert switch
                });
        }
    });
});
</script>
@endpush
