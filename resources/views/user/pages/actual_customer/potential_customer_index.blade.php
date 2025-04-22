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
    <style>
        .custom-size {
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 80px;
            height: 70px;
            text-align: center;
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">My Client List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">My Client List</li>
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
                            <h4 class="card-title">My Client List</h4>
                            <div class="ms-auto">
                                <div class="btn-group">


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
                            @foreach ($senders as $sender)
                                <div class="modal fade" id="viewOrdersModal-{{ $sender->id }}" tabindex="-1"
                                    aria-labelledby="viewOrdersModalLabel-{{ $sender->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewOrdersModalLabel-{{ $sender->id }}">Order
                                                    Details for Sender #{{ $sender->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Order Number</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="orderTableBody-{{ $sender->id }}">
                                                        <!-- Orders will be dynamically loaded here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="viewPaymentStatusModal-{{ $sender->id }}" tabindex="-1"
                                    aria-labelledby="paymentStatusLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentStatusLabel">Payment Status for Sender:
                                                    {{ $sender->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Order Number</th>
                                                            <th>Total Amount</th>
                                                            <th>Deposits</th>
                                                            <th>Payment Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="paymentTableBody-{{ $sender->id }}">
                                                        <tr>
                                                            <td colspan="5" class="text-center">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="select-all" />
                                            </th>
                                            <th>Customer Id</th>
                                            <th>Full Name</th>
                                            <th>City</th> <!-- Add a column for City -->
                                            <th>State</th> <!-- Add a column for State -->
                                            {{-- <th>Password</th> --}}
                                            <!-- Add a column for State -->
                                            <th>Orders Sent </th>

                                            <th>Receiver Info</th>


                                            <th class="text-center"> Overview</th>
                                            <th class="text-center"> Marketing Info</th>
                                            <th class="text-center">View Customer Dashboard</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($senders as $sender)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="select-email"
                                                        data-email="{{ $sender->email }}" />
                                                </td>
                                                <td>{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    <h6 class="font-weight-medium mb-0">
                                                        {{ $sender->first_name }} {{ $sender->last_name }}
                                                    </h6>
                                                    <small class="text-muted">
                                                        <i class="fa fa-envelope me-1" aria-hidden="true"></i>
                                                        {{ $sender->email ?? '' }}
                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fa fa-phone me-1" aria-hidden="true"></i>
                                                        <!-- Font Awesome phone icon -->
                                                        {{ $sender->telephone }}
                                                    </small>
                                                </td>
                                                <td>{{ $sender->city }}</td>
                                                <td>{{ $sender->state }}</td>
                                                {{-- <td>
                                                    <a href="#"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-danger custom-size"
                                                        data-bs-toggle="modal" data-bs-target="#managePassword"
                                                        data-sender-id="{{ $sender->id }}"
                                                        data-sender-name="{{ $sender->first_name }} {{ $sender->last_name }}">
                                                        <i class="fa fa-key"></i> MANAGE PW
                                                    </a>
                                                </td> --}}

                                                <td>{{ $sender->order_pick_ups_count }}</td>

                                                <td>
                                                    <a href="#"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-info custom-size"
                                                        data-bs-toggle="modal" data-bs-target="#receiverInfoModal"
                                                        data-sender-id="{{ $sender->id }}">
                                                        <i class="fa fa-users"></i> View
                                                    </a>
                                                </td>

                                                <td>
                                                    <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                        <button type="button"
                                                            class="btn btn-sm btn-light-success text-success custom-size"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewOrdersModal-{{ $sender->id }}">
                                                            <i data-feather="package" class="feather-sm"></i> View Orders
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-light-warning text-primary custom-size"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#viewPaymentStatusModal-{{ $sender->id }}">
                                                            <i data-feather="dollar-sign" class="feather-sm"></i> Payment
                                                            Status
                                                        </button>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a href="#"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-info custom-size send-marketing-info"
                                                        data-customer-id="{{ $sender->id }}"
                                                        data-customer-email="{{ $sender->email }} "
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
                                                    <a href="{{ route('user.customer.visit_dashboard',['sender'=>$sender->id]) }}"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-danger custom-size "

                                                       >
                                                        <span class="fa-stack fa-2x" style="color:#b1d0ec">
                                                            <i class="fas fa-users fa-stack-1x"
                                                                style="font-size:17px;"></i>
                                                                <i class="fas fa-tachometer-alt fa-stack-1x"
                                                                style="font-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;"></i>
                                                        </span>
                                                        <div style="text-align:center;padding:0 10px">
                                                           Dashboard
                                                        </div>
                                                    </a>

                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                            data-bs-toggle="tooltip" data-original-title="Edit"
                                                            data-id="{{ $sender->id }}">
                                                            <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                            data-bs-toggle="tooltip" data-original-title="Delete"
                                                            data-id="{{ $sender->id }}">
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
                <div class="modal fade" id="managePassword" tabindex="-1" aria-labelledby="managePasswordLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="managePasswordLabel">Manage Password for <span
                                        id="senderName"></span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Note:</strong> The default password is <code>12345678</code>. You can change it
                                    below, but please note that we cannot show the previous password for security reasons.
                                </p>
                                <form id="passwordForm" data-route="{{ route('user.update.password', ':id') }}">
                                    <input type="hidden" id="senderId">
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="newPassword"
                                            placeholder="Enter new password">
                                    </div>
                                    <button type="submit" id="updatePasswordBtn" class="btn btn-primary">Update
                                        Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Create Modal -->
                <div class="modal fade" id="receiverInfoModal" tabindex="-1" aria-labelledby="receiverInfoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="receiverInfoModalLabel">Receiver Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="receiverName" class="text-center mb-4"></div>
                                <table class="table table-bordered table-striped">
                                    <tbody id="receiverDetails">
                                        <!-- Receiver details will be dynamically populated here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Payment Status Modal -->
                <div class="modal fade" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentStatusModalLabel">Payment Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-info text-center">Label</th>
                                                <th class="text-info text-center">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-primary text-center">Total Amount</td>
                                                <td class="text-center">

                                                    <span class="bg-primary text-white px-2 py-1 rounded">$500.00</span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center">Deposit 1</td>
                                                <td class="text-center">

                                                    <span class="bg-success text-white px-2 py-1 rounded">$100.00</span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center">Deposit 2</td>
                                                <td class="text-center">

                                                    <span class="bg-success text-white px-2 py-1 rounded">$100.00</span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center">Amount Due</td>
                                                <td class="text-center">

                                                    <span class="bg-danger text-white px-2 py-1 rounded">$300.00</span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center">Payment Method</td>
                                                <td class="text-info text-center">Credit Card</td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center">Payment Status</td>
                                                <td class="text-center">
                                                    <span class="bg-danger text-white px-2 py-1 rounded">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-primary text-center align-middle fw-bold">Collect Due
                                                    Payment
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn rounded-pill px-4"
                                                        style="background-color: red; color: white; font-weight: bold; font-size: 1.25rem; padding: 10px 20px;">
                                                        Click Here
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Client Account Details</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editSenderForm">
                                <div class="modal-body">
                                    <input type="hidden" id="sender_id" name="sender_id">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="street_address">Street Address</label>
                                        <input type="text" class="form-control" id="street_address"
                                            name="street_address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apt">Apt</label>
                                        <input type="text" class="form-control" id="apt" name="apt">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="zip">Zip Code</label>
                                        <input type="text" class="form-control" id="zip" name="zip"
                                            required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
            // Edit functionality
            $(document).on('click', '.edit-row-btn', function() {
                var senderId = $(this).data('id');

                var url = '{{ route('user.sender.edit', ':senderId') }}';
                url = url.replace(':senderId', senderId);
                // Make an AJAX call to get sender details
                $.ajax({
                    url: url, // Use the dynamically generated route
                    method: 'GET',
                    success: function(data) {
                        // Populate the modal with sender data
                        $('#editModal #first_name').val(data.first_name);
                        $('#editModal #last_name').val(data.last_name);
                        $('#editModal #email').val(data.email);
                        $('#editModal #telephone').val(data.telephone);
                        $('#editModal #street_address').val(data.street_address);
                        $('#editModal #apt').val(data.apt);
                        $('#editModal #city').val(data.city);
                        $('#editModal #state').val(data.state);
                        $('#editModal #zip').val(data.zip);
                        $('#editModal #sender_id').val(senderId); // Store the sender ID in a hidden field

                        // Show the modal
                        $('#editModal').modal('show');
                    }
                });
            });



            $('#editSenderForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission



                // Create a new FormData object from the form
                var formData = new FormData(this);

                // Add CSRF token to the FormData
                formData.append('_token', '{{ csrf_token() }}');

                // Get sender ID
                var senderId = $('#sender_id').val();
                console.log("Sender ID: ", senderId); // Log the sender ID

                // Use named route for the update URL
                var updateUrl = '{{ route('user.sender.update', ':id') }}';
                updateUrl = updateUrl.replace(':id', senderId);
                console.log("Update URL: ", updateUrl); // Log the update URL

                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from overriding content type
                    success: function(response) {
                        console.log("Success response: ", response); // Log the success response
                        // Display success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response.message,
                        });

                        // Optionally, refresh the page or update the table row with the new data
                        $('#editModal').modal('hide');
                        location
                            .reload(); // Reload to see the updated data (or you can manually update the table)
                    },
                    error: function(xhr) {
                        console.error("Error response: ", xhr); // Log the error response

                        // Show validation messages
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            // Find the corresponding input and display error message below it
                            var field = $('#' + key);
                            field.addClass('is-invalid'); // Add invalid class for Bootstrap styling
                            field.after('<div class="invalid-feedback">' + value[0] + '</div>');
                        });
                    }
                });
            });


            // Delete functionality
            $(document).on('click', '.delete-row-btn', function() {
                var senderId = $(this).data('id');

                // Confirm deletion
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make an AJAX call to delete sender
                        $.ajax({
                            url: '{{ route('user.sender.destroy', '') }}/' +
                                senderId, // Use route name
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}', // Include CSRF token
                            },
                            success: function(response) {
                                // Display success message
                                Swal.fire('Deleted!', response.message, 'success');
                                // Remove the row from the table
                                $('tr').find('[data-id="' + senderId + '"]').closest('tr').remove();
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong!', 'error');
                            }
                        });
                    }
                });
            });
        </script>
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

        <script>
            window.routes = {
                collectPaymentUrl: '{{ route('user.collect_payment', ['order_pickup_id' => '__order_pickup_id__']) }}',
                orderOverviewUrl: '{{ route('user.order_overview', ['order_pickup_id' => '__order_pickup_id__']) }}',
            };
        </script>
        <script>
            $(document).ready(function() {
                // Event listener for opening a modal
                $('[data-bs-toggle="modal"][data-bs-target^="#viewOrdersModal"]').on('click', function() {
                    const senderId = $(this).data('bs-target').split('-')[
                        1]; // Extract sender_id from the modal ID
                    const modalTableBody = $(`#orderTableBody-${senderId}`);

                    $.ajax({
                        url: '{{ route('user.orders.fetch') }}', // Route for fetching orders
                        type: 'GET',
                        data: {
                            sender_id: senderId
                        },
                        success: function(response) {
                            modalTableBody.empty(); // Clear previous data
                            console.log(window.routes.orderOverviewUrl);
                            if (response.orders.length > 0) {
                                response.orders.forEach(order => {
                                    // Check if `order.id` and `window.routes.orderOverviewUrl` are valid
                                    if (order.id && window.routes.orderOverviewUrl) {
                                        const orderInvoiceUrl = window.routes
                                            .orderOverviewUrl.replace('__order_pickup_id__',
                                                order.id);
                                        console.log(window.routes.orderOverviewUrl);
                                        modalTableBody.append(`
                    <tr>
                        <td>${order.order_number}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary"
                                onclick="window.location.href='${orderInvoiceUrl}'">
                                View Invoice
                            </button>
                        </td>
                    </tr>
                `);
                                    } else {
                                        console.error('Order or URL data is missing:',
                                            order);
                                        // Optionally, you can append a placeholder row in case of missing data
                                        modalTableBody.append(`
                    <tr>
                        <td colspan="2" class="text-center">Invalid order data</td>
                    </tr>
                `);
                                    }
                                });
                            } else {
                                modalTableBody.append(
                                    '<tr><td colspan="2" class="text-center">No orders found</td></tr>'
                                );
                            }
                        },
                        error: function() {
                            modalTableBody.append(
                                '<tr><td colspan="2" class="text-center text-danger">Failed to fetch orders</td></tr>'
                            );
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('[data-bs-toggle="modal"][data-bs-target^="#viewPaymentStatusModal"]').on('click', function() {
                    const senderId = $(this).data('bs-target').split('-')[1]; // Extract sender_id
                    const modalTableBody = $(`#paymentTableBody-${senderId}`);

                    // Fetch payment data
                    $.ajax({
                        url: '{{ route('user.payments.fetch') }}', // Adjust route accordingly
                        type: 'GET',
                        data: {
                            sender_id: senderId
                        },
                        success: function(response) {
                            modalTableBody.empty(); // Clear previous data

                            if (response.orders.length > 0) {
                                response.orders.forEach(order => {
                                    console.log(order);
                                    let depositsHtml = '';
                                    order.deposits.forEach((deposit, index) => {
                                        depositsHtml +=
                                            `<div>Deposit ${index + 1}: <span class="bg-success text-white px-2 py-1 rounded" style="background-color: green!important;">${deposit.deposit}</span> (${deposit.payment_method})</div>`;
                                    });

                                    modalTableBody.append(`
                            <tr>
                                <td>${order.order_number}</td>
                                <td>${order.total_amount}</td>
                                <td>${depositsHtml}</td>
                                <td>
                                    <span class="bg-${order.is_paid ? 'success' : 'danger'} text-white px-2 py-1 rounded">
                                        ${order.payment_status}
                                    </span>
                                </td>
                              <td class="text-center">
    ${!order.is_paid ? `
                                                                            <button type="button" class="btn rounded-pill px-4"
                                                                                style="background-color: red; color: white; font-weight: bold; font-size: 1rem; padding: 8px 8px;"
                                                                                onclick="window.location.href='${window.routes.collectPaymentUrl.replace('__order_pickup_id__', order.id)}'">
                                                                                Collect Due Payment
                                                                            </button>
                                                                        ` : ''}
</td>
                            </tr>
                        `);
                                });
                            } else {
                                modalTableBody.append(
                                    '<tr><td colspan="5" class="text-center">No orders found</td></tr>'
                                );
                            }
                        },
                        error: function() {
                            modalTableBody.empty().append(
                                '<tr><td colspan="5" class="text-center text-danger">Failed to fetch payment data</td></tr>'
                            );
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // When the modal is triggered
                $('#receiverInfoModal').on('show.bs.modal', function(e) {
                    var senderId = $(e.relatedTarget).data('sender-id'); // Get sender_id from the button

                    // AJAX request to fetch the order pickup and receiver data based on sender_id
                    $.ajax({
                        url: '{{ route('user.fetch.receiver.info') }}', // Use the named route here
                        type: 'GET',
                        data: {
                            sender_id: senderId
                        },
                        success: function(response) {
                            if (response.success && response.receiver) {
                                var receiver = response.receiver;

                                // Set the receiver name dynamically in the modal
                                $('#receiverName').html(
                                    `<h4>${receiver.first_name} ${receiver.last_name}</h4>`);

                                // Populate the table with receiver details
                                var receiverDetails = `
                        <tr><th scope="row">Receiver</th><td>${receiver.first_name} ${receiver.last_name}</td></tr>
                        <tr><th scope="row">Email</th><td>${receiver.email}</td></tr>
                        <tr><th scope="row">Tel</th><td>${receiver.telephone}</td></tr>
                        <tr><th scope="row">Cell</th><td>${receiver.cell}</td></tr>
                        <tr><th scope="row">WhatsApp</th><td>${receiver.whatsapp}</td></tr>
                        <tr><th scope="row">Address</th><td>${receiver.address}</td></tr>
                        <tr><th scope="row">Neighbourhood</th><td>${receiver.neighborhood}</td></tr>
                        <tr><th scope="row">City</th><td>${receiver.city}</td></tr>
                        <tr><th scope="row">Province</th><td>${receiver.province}</td></tr>
                    `;
                                $('#receiverDetails').html(
                                    receiverDetails); // Update the modal table
                            } else {
                                // Handle case if no receiver is found
                                $('#receiverName').html(
                                    '<h4>No Receiver Information Available</h4>');
                                $('#receiverDetails').html(
                                    '<tr><td colspan="2">No details found</td></tr>');
                            }
                        },
                        error: function() {
                            $('#receiverName').html('<h4>Error fetching receiver data</h4>');
                            $('#receiverDetails').html(
                                '<tr><td colspan="2">Failed to load receiver details</td></tr>');
                        }
                    });
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                var table = $('#zero_config').DataTable();

                // Filter for City
                $('#cityFilter').on('change', function() {
                    var city = $(this).val();
                    table.column(3).search(city).draw(); // 10 is the index of the City column
                });

                // Filter for State
                $('#stateFilter').on('change', function() {
                    var state = $(this).val();
                    table.column(4).search(state).draw(); // 11 is the index of the State column
                });

                // Optional: Reset filters when 'Filter' button is clicked
                $('#filterButton').on('click', function() {
                    var city = $('#cityFilter').val();
                    var state = $('#stateFilter').val();
                    table.column(10).search(city).draw(); // Filter by City
                    table.column(11).search(state).draw(); // Filter by State
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
            document.addEventListener("DOMContentLoaded", function() {
                // When the modal is triggered
                document.querySelectorAll('[data-bs-target="#managePassword"]').forEach(button => {
                    button.addEventListener("click", function() {
                        let senderId = this.getAttribute("data-sender-id");
                        let senderName = this.getAttribute("data-sender-name");

                        document.getElementById("senderId").value = senderId;
                        document.getElementById("senderName").innerText = senderName;
                    });
                });

                // Handle Password Update
                document.getElementById("passwordForm").addEventListener("submit", function(e) {
                    e.preventDefault();

                    let senderId = document.getElementById("senderId").value;
                    let newPassword = document.getElementById("newPassword").value;
                    let updateButton = document.getElementById("updatePasswordBtn");
                    let csrfToken = document.querySelector(
                    'meta[name="csrf-token"]'); // ✅ Now inside the function

                    if (!csrfToken) {
                        console.error(
                            "CSRF token not found! Make sure you have added <meta name='csrf-token' content='{{ csrf_token() }}'> in your Blade template."
                            );
                        return;
                    }

                    if (!newPassword.trim()) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Please enter a new password!"
                        });
                        return;
                    }

                    // Show loader on the button
                    updateButton.innerHTML = `<i class="fa fa-spinner fa-spin"></i> Updating...`;
                    updateButton.disabled = true;

                    // Get the route dynamically
                    let updatePasswordRoute = this.dataset.route.replace(':id', senderId);

                    // Send AJAX request to update password
                    fetch(updatePasswordRoute, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": csrfToken.getAttribute("content")
                            },
                            body: JSON.stringify({
                                password: newPassword
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                icon: "success",
                                title: "Password Updated!",
                                text: data.message,
                                confirmButtonColor: "#3085d6",
                            });

                            document.getElementById("managePassword").querySelector(".btn-close").click();
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Something went wrong. Please try again."
                            });
                        })
                        .finally(() => {
                            // Reset button state
                            updateButton.innerHTML = "Update Password";
                            updateButton.disabled = false;
                        });
                });
            });
        </script>
    @endpush
