@extends('admin.layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 10px 0;
        }

        /* Checkbox Styling */
        .styled-checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #007BFF;
            /* Change to your primary color */
            border-radius: 4px;
        }

        /* Label Styling */
        .checkbox-label {
            cursor: pointer;
            color: #260d47;
            /* Text color */
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .checkbox-label:hover {
            color: #007BFF;
            /* Hover color */
        }

        /* Optional: Add a hover effect to the container */
        .checkbox-container:hover {
            background-color: #f9f9f9;
            padding: 5px;
            border-radius: 5px;
        }
    </style>
    <style>
        .form-group {
            margin-top: 5px;
        }

        label {
            color: rgb(83, 83, 161);
        }
    </style>
    <style>
        .custom-size {

            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            text-align: center;
        }

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
    <div class="modal fade" id="editPotentialModal" tabindex="-1" role="dialog" aria-labelledby="editPotentialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-xl">
                <div class="modal-header">
                    <h3 class="modal-title" id="marketingModalLabel" style="color:rgb(46, 22, 70)">Edit Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPotentialCustomerForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="edituser_id">

                        <!-- Full Name -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-success" placeholder="Full Name"
                                id="editFullName" name="full_name">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user feather-sm text-success fill-white me-2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="border-start border-success ps-3">Full Name</span>
                            </label>
                        </div>


                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control border border-success" placeholder="Email"
                                id="editEmail" name="email">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-mail feather-sm text-success fill-white me-2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span class="border-start border-success ps-3">Email address</span>
                            </label>
                        </div>

                        <!-- Phone -->
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control border border-success" placeholder="Phone Number"
                                id="editPhone" name="phone_number">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-phone feather-sm text-success fill-white me-2">
                                    <path
                                        d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                    </path>
                                </svg>
                                <span class="border-start border-success ps-3">Phone Number</span>
                            </label>
                        </div>

                        <!-- Street -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-success" placeholder="Street Address"
                                id="editAddress" name="address">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-map-pin feather-sm text-success fill-white me-2">
                                    <path d="M21 10c0 7.34-9 13-9 13S3 17.34 3 10a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="border-start border-success ps-3">Address</span>
                            </label>
                        </div>

                        <!-- City -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-success" placeholder="City"
                                id="editCity" name="city">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-home feather-sm text-success fill-white me-2">
                                    <path d="M3 9.5l9-7 9 7"></path>
                                    <path d="M9 22V12H5v10"></path>
                                    <path d="M16 22v-6h-4v6"></path>
                                </svg>
                                <span class="border-start border-success ps-3">City</span>
                            </label>
                        </div>

                        <!-- State -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-success" placeholder="State"
                                id="editState" name="state">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
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

                        <!-- ZIP Code -->
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border border-success" placeholder="Zip Code"
                                id="editZip" name="zip">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-hash feather-sm text-success fill-white me-2">
                                    <line x1="4" y1="9" x2="20" y2="9"></line>
                                    <line x1="4" y1="15" x2="20" y2="15"></line>
                                    <line x1="10" y1="3" x2="8" y2="21"></line>
                                    <line x1="16" y1="3" x2="14" y2="21"></line>
                                </svg>
                                <span class="border-start border-success ps-3">Zip Code</span>
                            </label>
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
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Potential Customers List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Potential Customers List</li>
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
                            <h4 class="card-title">Customers</h4>
                            <div class="ms-auto">
                                <div class="btn-group">



                                    <button type="button"
                                        class="btn btn-light-primary text-primary font-weight-medium rounded-pill px-4"
                                        onclick="window.location.href='{{ route('user.add_potential_customer.index') }}'">
                                        Add Potential Customers
                                    </button>
                                </div>
                            </div>




                        </div>

                        <div class="alert alert-info" role="alert" style="margin-bottom: 1rem;">
                            Please select the checkboxes you wish to send marketing information to.
                        </div>
                        <div class="checkbox-container">
                            <input type="checkbox" id="select-all" class="styled-checkbox">
                            <label for="select-all" class="checkbox-label">Select All Contacts</label>
                            <button id="send-marketing-btn"
                                class="d-none btn btn-light-info text-info font-weight-medium rounded-pill px-4"
                                data-bs-toggle="modal" data-bs-target="#marketingModal">
                                Send Marketing Info
                            </button>
                        </div>

                        <!-- Filter Section -->
                        <!-- Filter Box with Heading -->
                        <div class="mb-4 p-3 border rounded bg-light">
                            <h5 class="mb-3 text-center" style="color:rgb(69, 21, 114);font-weight:600;">Sort the Table by
                                State and City</h5>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="filter-section">
                                    <label for="stateFilter" class="form-label">State</label>
                                    <select id="stateFilter" class="form-select bg-white" style="max-width: 200px;">
                                        <option value="">Select State</option>
                                        <!-- Dynamically populate state options from the sender table -->
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="filter-section">
                                    <label for="cityFilter" class="form-label">City</label>
                                    <select id="cityFilter" class="form-select bg-white" style="max-width: 200px;">
                                        <option value="">Select City</option>
                                        <!-- Dynamically populate city options from the sender table -->
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->city }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="select-all" />
                                            </th>
                                            <th>Customer Id</th>
                                            <th>Full Name</th>
                                            <th>E-mail</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zip</th>
                                            <th>Move to</th>
                                            <th>Marketing Info</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr id="row-{{ $customer->id }}" data-customer-id="{{ $customer->id }}">
                                                <td>
                                                    <input type="checkbox" class="select-email"
                                                        data-email="{{ $customer->email }}" />
                                                </td>
                                                <td>{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $customer->full_name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone_number }}</td>
                                                <td>{{ $customer->address }}

                                                </td>
                                                <td>{{ $customer->city }}</td>
                                                <td>{{ $customer->state }}</td>
                                                <td>{{ $customer->zip }}</td>

                                                <td class="text-center align-middle">
                                                    <button class="convert-to-sender-button btn btn-primary mx-2" data-customer-id="{{ $customer->id }}">
                                                        Customer
                                                    </button>
                                                </td>

                                                <td>
                                                    <a href="#"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-info custom-size send-marketing-info"
                                                        data-customer-id="{{ $customer->id }}"
                                                        data-customer-email="{{ $customer->email }} "
                                                        data-bs-toggle="tooltip"
                                                        data-original-title="Send Marketing Info">
                                                        <span class="fa-stack fa-2x" style="color:#b1d0ec">
                                                            <i class="fas fa-users fa-stack-1x"
                                                                style="font-size:17px;"></i>
                                                            <i class="fas fa-share-alt fa-stack-1x"
                                                                style="font-size:12px;position: absolute; top: -13px; left: 10px;"></i>
                                                        </span>
                                                        <div style="text-align:center;">
                                                            <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                            data-bs-toggle="modal" data-bs-target="#editPotentialModal"
                                                            data-id="{{ $customer->id }}" data-original-title="Edit">
                                                            <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                            data-bs-toggle="tooltip" data-original-title="Delete"
                                                            data-id="{{ $customer->id }}">
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


                <!-- Modal Structure -->
                <div class="modal fade" id="marketingModal" tabindex="-1" role="dialog"
                    aria-labelledby="marketingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="marketingModalLabel" style="color:rgb(46, 22, 70)">Send
                                    Marketing
                                    Information</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="marketingForm" method="POST"
                                    action="{{ route('user.send.marketing.email') }}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Hidden input for customer_id -->
                                    <input type="hidden" name="customer_id" id="customer_id" value="">

                                    <!-- Add other form fields here -->

                                    <!-- Add more fields as needed -->


                                    <div class="card card-body">

                                        <div class="mb-3">
                                            <label for="example-email" class="form-label">To :</label>
                                            <textarea id="example-email" name="example-email" class="form-control" placeholder="To" rows="5"></textarea>

                                        </div>
                                        <div class="mb-3">
                                            <label for="example-subject" class="form-label">Subject :</label>
                                            <input type="text" id="example-subject" name="example-subject"
                                                class="form-control" placeholder="Subject" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="example-subject" class="form-label">Body :</label>
                                            <textarea id="body" name="body" class="form-control summernote">Default Body</textarea>
                                        </div>
                                        <h5>Attachment :</h5>

                                        <div class="mb-3">

                                            <input type="file" class="form-control" id="files" name="files[]"
                                                multiple />
                                            <div id="attachmentsContainer" class="mt-3"></div>

                                            <div id="loadingSpeed" class="mt-2 d-none">Loading...</div>

                                        </div>
                                        <div class="button-group text-end">
                                            <button type="submit" class="btn btn-success mt-3">
                                                <i data-feather="send" class="feather-sm fill-white"></i>
                                                Send
                                            </button>
                                            <button type="button" class="btn btn-dark mt-3" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                Discard
                                            </button>
                                        </div>
                                </form>
                                <script>
                                    document.getElementById('marketingForm').addEventListener('submit', function(e) {
                                        e.preventDefault(); // Prevent default form submission

                                        // Show the Swal loader
                                        Swal.fire({
                                            title: 'Sending Email...',
                                            text: 'Please wait while we send your email.',
                                            icon: 'info',
                                            allowOutsideClick: false,
                                            showConfirmButton: false,
                                            didOpen: () => {
                                                Swal.showLoading();
                                            }
                                        });

                                        // Create a FormData object for the form
                                        const formData = new FormData(this);

                                        // Submit the form via AJAX
                                        fetch(this.action, {
                                                method: 'POST',
                                                body: formData,
                                            })
                                            .then(async response => {
                                                Swal.close(); // Close the loader

                                                if (response.ok) {
                                                    const data = await response.json();

                                                    if (data.success) {
                                                        const marketingModal = document.getElementById('marketingModal');
                                                        if (marketingModal) {
                                                            const bootstrapModal = bootstrap.Modal.getInstance(marketingModal);
                                                            bootstrapModal.hide();
                                                        }

                                                        Swal.fire({
                                                            title: 'Email Sent!',
                                                            text: 'Your email was sent successfully.',
                                                            icon: 'success',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            title: 'Error!',
                                                            text: data.message || 'An error occurred while sending the email.',
                                                            icon: 'error',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    }
                                                } else if (response.status === 422) {
                                                    const errorData = await response.json();
                                                    const validationErrors = Object.values(errorData.errors)
                                                        .flat()
                                                        .map(error => `<li>${error}</li>`)
                                                        .join('');

                                                    Swal.fire({
                                                        title: 'Validation Errors',
                                                        html: `<ul>${validationErrors}</ul>`,
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                } else {
                                                    Swal.fire({
                                                        title: 'Error!',
                                                        text: 'An unexpected error occurred.',
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                }
                                            })
                                            .catch(error => {
                                                Swal.close();
                                                console.error('Error occurred:', error);

                                                Swal.fire({
                                                    title: 'Error!',
                                                    text: 'An error occurred while sending the email. Please try again.',
                                                    icon: 'error',
                                                    confirmButtonText: 'OK'
                                                });
                                            });
                                    });
                                </script>
                                <!-- Action part -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End Page Content -->
            <!-- -------------------------------------------------------------- -->
        </div>
    @endsection

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get all "Send Marketing Info" buttons
                const marketingButtons = document.querySelectorAll('.send-marketing-info');

                marketingButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Get the customer_id from the button's data attribute
                        const customerId = this.getAttribute('data-customer-id');
                        const email = this.getAttribute('data-customer-email');

                        // Set the customer_id in the hidden input of the modal form
                        document.getElementById('customer_id').value = customerId;
                        document.getElementById('example-email').value = email;

                        // Show the modal
                        const marketingModal = new bootstrap.Modal(document.getElementById(
                            'marketingModal'));
                        marketingModal.show();
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('files'); // Get the file input
                const attachmentsContainer = document.getElementById('attachmentsContainer');
                let uploadedFiles = []; // Array to track uploaded files

                fileInput.addEventListener('change', function() {
                    const newFiles = Array.from(this.files); // Get the selected files
                    uploadedFiles = [...uploadedFiles, ...newFiles]; // Add new files to the array

                    // Clear the attachments container before displaying files
                    attachmentsContainer.innerHTML = '';

                    // Display each file
                    uploadedFiles.forEach((file) => {
                        // Create a display element for each file
                        var attachmentDisplay = document.createElement('div');
                        attachmentDisplay.className =
                            'd-flex align-items-center justify-content-between border p-2 mt-2';

                        var fileName = document.createElement('span');
                        fileName.textContent = file.name;

                        var removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.className = 'btn btn-danger btn-sm ms-2';
                        removeButton.textContent = 'x';

                        attachmentDisplay.appendChild(fileName);
                        attachmentDisplay.appendChild(removeButton);
                        attachmentsContainer.appendChild(attachmentDisplay);

                        // Create a loading bar for this file
                        var loadingBar = document.createElement('div');
                        loadingBar.className = 'progress mt-2';
                        var progressBar = document.createElement('div');
                        progressBar.className =
                            'progress-bar progress-bar-striped progress-bar-animated';
                        progressBar.role = 'progressbar';
                        progressBar.style.width = '0%';
                        progressBar.ariaValueNow = '0';
                        progressBar.ariaValueMin = '0';
                        progressBar.ariaValueMax = '100';
                        loadingBar.appendChild(progressBar);
                        attachmentsContainer.appendChild(loadingBar);

                        // Show loading bar for this file
                        let progress = 0;
                        var interval = setInterval(function() {
                            if (progress < 100) {
                                progress += 10; // Increment progress
                                progressBar.style.width = progress + '%';
                                progressBar.ariaValueNow = progress;
                            } else {
                                clearInterval(interval); // Stop when complete
                                progressBar.classList.remove('progress-bar-striped',
                                    'progress-bar-animated'); // Remove animation
                                progressBar.classList.add(
                                    'bg-success'); // Change color to green
                            }
                        }, 300); // Adjust time as necessary

                        // Remove the file when the "x" button is clicked
                        removeButton.onclick = function() {
                            // Remove the display
                            attachmentDisplay.remove(); // Remove this file display
                            loadingBar.remove(); // Remove loading bar

                            // Update the uploadedFiles array to remove the clicked file
                            uploadedFiles = uploadedFiles.filter(f => f.name !== file.name);

                            // Update the input's files
                            const dataTransfer =
                                new DataTransfer(); // Use DataTransfer to manipulate the input files
                            uploadedFiles.forEach(f => dataTransfer.items.add(
                                f)); // Add remaining files
                            fileInput.files = dataTransfer.files; // Set the input's files
                        };
                    });
                });
            });
        </script>
        {{-- For delete --}}
        <script>
            $(document).on('click', '.delete-row-btn', function() {
                // Get the potential customer ID from the button's data-id attribute
                let potentialCustomerId = $(this).data('id');

                // Show confirmation prompt using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this potential customer?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform AJAX request to delete the record
                        $.ajax({
                            url: '{{ route('user.potentialCustomer.destroy', ':id') }}'.replace(':id',
                                potentialCustomerId), // Use route name
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Show success message
                                Swal.fire(
                                    'Deleted!',
                                    'The potential customer has been deleted.',
                                    'success'
                                );

                                // Optionally, remove the deleted row from the DOM
                                $(`#row-${potentialCustomerId}`)
                                    .remove(); // Assuming row id matches potentialCustomerId
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the potential customer.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        </script>
        {{-- for edit --}}
        <script>
            $(document).on('click', '.edit-row-btn', function() {
                var userId = $(this).data('id');
                $('editPotentialCustomerForm').find('input[name="user_id"]').val(userId);
                var url = '{{ route('user.potentialCustomer.edit', ':id') }}';
                url = url.replace(':id', userId);
                // AJAX request to get driver details
                $.ajax({
                    url: url, // Use the dynamically generated route
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        // Populate the modal fields with the data
                        $('#edituser_id').val(data.id);
                        $('#editFullName').val(data.full_name);
                        $('#editEmail').val(data.email);
                        $('#editPhone').val(data.phone_number);
                        $('#editAddress').val(data.address);
                        $('#editCity').val(data.city);
                        $('#editState').val(data.state);
                        $('#editZip').val(data.zip);

                    }
                });
            });
        </script>
        <script>
            $('#editPotentialCustomerForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                console.log(Array.from(formData.entries())); // Log form data
                var userId = $('#edituser_id').val();

                // Use named route for the update URL
                var updateUrl = '{{ route('user.potentialCustomer.update', ':id') }}';
                updateUrl = updateUrl.replace(':id', userId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#editPotentialModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error updating Customer Details. Please try again.',
                        });
                    }
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                var table = $('#zero_config').DataTable();

                // Filter for City
                $('#cityFilter').on('change', function() {
                    var city = $(this).val();
                    table.column(6).search(city).draw(); // 10 is the index of the City column
                });

                // Filter for State
                $('#stateFilter').on('change', function() {
                    var state = $(this).val();
                    table.column(7).search(state).draw(); // 11 is the index of the State column
                });

                // Optional: Reset filters when 'Filter' button is clicked
                $('#filterButton').on('click', function() {
                    var city = $('#cityFilter').val();
                    var state = $('#stateFilter').val();
                    table.column(6).search(city).draw(); // Filter by City
                    table.column(7).search(state).draw(); // Filter by State
                });

                // Select All checkbox logic for filtered rows
                $('#select-all').on('change', function() {
                    var isChecked = this.checked;

                    // Select checkboxes for filtered rows only
                    table.rows({
                        filter: 'applied'
                    }).nodes().to$().find('.select-email').prop('checked', isChecked);

                    // Toggle the "Send Marketing Info" button visibility
                    toggleSendButton();
                });

                // Individual row checkbox event to handle "Select All" checkbox state
                $('#zero_config tbody').on('change', 'input[type="checkbox"]', function() {
                    updateSelectAllCheckbox();
                    toggleSendButton();
                });

                // Toggle the "Send Marketing Info" button visibility
                function toggleSendButton() {
                    const selectedEmails = Array.from($('.select-email:checked'))
                        .map((checkbox) => $(checkbox).data('email'));

                    if (selectedEmails.length > 0) {
                        $('#send-marketing-btn').removeClass('d-none');
                    } else {
                        $('#send-marketing-btn').addClass('d-none');
                    }
                }

                // Update "Select All" checkbox based on individual checkboxes
                function updateSelectAllCheckbox() {
                    const allChecked = table.rows({
                            filter: 'applied'
                        }).nodes().to$().find('.select-email').length ===
                        table.rows({
                            filter: 'applied'
                        }).nodes().to$().find('.select-email:checked').length;
                    $('#select-all').prop('checked', allChecked); // Check "Select All" if all individual are checked
                }

                // Pass selected emails to the modal when the "Send Marketing" button is clicked
                $('#send-marketing-btn').on('click', function() {
                    const selectedEmails = Array.from($('.select-email:checked'))
                        .map((checkbox) => $(checkbox).data('email'))
                        .join(", ");

                    $('#example-email').val(selectedEmails); // Set the emails in the modal input
                });
            });
        </script>

        <script>
          document.querySelectorAll('.convert-to-sender-button').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const customerId = this.dataset.customerId;

        // SweetAlert Confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to move this potential customer to CUSTOMER. This will delete the potential customer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, proceed with the conversion
                fetch(`{{ route('user.convert.to.sender', ':id') }}`.replace(':id', customerId), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Converted!',
                            'The potential customer has been successfully converted to a sender.',
                            'success'
                        );
                        // Optionally remove the row from the table
                        document.querySelector(`tr[data-customer-id="${customerId}"]`).remove();
                    } else {
                        Swal.fire('Error', data.error || 'An unexpected error occurred.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An unexpected error occurred.', 'error');
                });
            }
        });
    });
});
        </script>
    @endpush
