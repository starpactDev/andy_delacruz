@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .paid-badge {
            display: inline-block;
            /* Ensures the span respects width */
            width: 80px;
            /* Set a consistent width */
            text-align: center;
            /* Center-align the text */
        }

        .process-flow {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            position: relative;
        }

        .step {
            flex: 1;
            position: relative;
            padding: 20px 10px;
            margin: 0 5px;
            color: white;
            clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%);
            font-size: 12px;
        }

        .step:first-child {
            margin-left: 0;
            border-radius: 10px 0 0 10px;
        }

        .step:last-child {
            margin-right: 0;
            border-radius: 0 10px 10px 0;
        }

        .packing.active {
            background-color: #8cc63f;
        }

        .shipped.active {
            background-color: #3ba741;
        }

        .customs.active {
            background-color: #00adef;
        }

        .review.active {
            background-color: #8e44ad;
        }

        .distribution.active {
            background-color: #f39c12;
        }

        .ready.active {
            background-color: #e74c3c;
        }

        .delivered.active {
            background-color: #3498db;
        }

        .default {
            background-color: rgba(255, 255, 255, 0.5);
            /* hazy white background */
            color: rgba(0, 0, 0, 0.5);
            /* hazy black text */
        }
    </style>
    <style>
        .no-block {
            min-height: 75px !important;
        }

        .tablesaw-cell-label {
            display: none;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            min-width: 600px;
            /* Ensure a minimum width to force scrolling */

        }

        .table th,
        .table td {
            padding: 8px 12px;

        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style>
        .shipment-badge {


            width: 150px;
            /* Adjust width to your needs */

        }

        .fa-stack {
            display: inline-block;
            position: relative;
            width: 2em;
            height: 2em;
            line-height: 2em;
        }

        .fa-stack-1x {
            position: absolute;
            left: 0;
            top: 0;
        }

        .fa-file {
            font-size: 1.2em;
        }

        .fa-check {
            font-size: 0.8em;
            /* Smaller size for checkmark */
            position: absolute;
            top: 0.5em;
            /* Adjust position as needed */
            right: 0.5em;
            /* Adjust position as needed */
            color: skyblue;
            /* Color set to sky blue */
        }
    </style>
    <style>
        /* Change the dropdown box appearance */
        .ui-autocomplete {
            background-color: #f9f9f9;
            /* Light background */
            border: 1px solid #ddd;
            /* Border color */
            border-radius: 5px;
            /* Rounded corners */
            max-height: 200px;
            /* Limit the height of the dropdown */
            overflow-y: auto;
            /* Add a scrollbar for long lists */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            z-index: 1050;
            /* Ensure it appears above other elements */
        }

        /* Style the items in the dropdown */
        .ui-menu-item {
            padding: 10px;
            /* Add some padding */
            cursor: pointer;
            /* Pointer cursor for hover */
        }

        /* Highlighted item (when hovered or selected) */
    </style>
   <style>
    .container-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%; /* Ensures same width */
        height: 80px; /* Fixed height for consistency */
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        margin: 20px 10px;
    }

    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%; /* Same width as header */
        height: 80px; /* Same height as header */
        background-color: #a6cffc;
        border-radius: 10px;
        gap: 20px;
        padding: 10px;
        margin-left: 10px; /* Moves the whole container slightly to the right */

    }

    .container-title {
        margin: 0;
        font-size: 1.2rem;
        color: rgb(17, 16, 16);
        font-weight: 600;
    }

    .container-info {
        font-size: 1.2rem;
        font-weight: bold;
        color: rgb(17, 16, 16);
    }

    .container-number {
        font-size: 1.5rem;
        color: rgb(198, 255, 198);
    }

    .total-orders {
        padding: 10px 20px;
        font-weight: 600;
        font-size: 1.4rem;
        color: rgb(26, 11, 54);
    }

    .order-count {
        color: rgb(56, 56, 112);
    }

    .input-group {
        max-width: 300px;
    }

    .input-group-text {
        background-color: rgb(35, 44, 92);
        color: white;
    }
</style>
<!-- Header Container -->
<div class="container-box">
    <h4 class="container-title">TOTAL ORDERS PER CONTAINER</h4>
    <span class="container-info">
        CONTAINER NUMBER :
        <span class="container-number">{{ $currentContainerNumber }}</span>
    </span>
</div>

<!-- Search & Total Orders Section -->
<div class="search-container">
    <div>
        <h class="total-orders">
            TOTAL ORDERS: <b class="order-count">{{ $count_orders }}</b>
        </h>
    </div>

    <div class="input-group">
        <input type="text" id="orderSearch" class="form-control" placeholder="ORDERS FINDER"
            aria-label="ORDERS FINDER" onkeyup="filterOrders()">
        <span class="input-group-text">
            <i class="fa fa-search"></i>
        </span>
    </div>
</div>
    <style>
        .month-table table th,
        .month-table table td {
            width: 200px;
            /* Adjust as needed */
            text-align: center;
        }
    </style>
    @foreach ($groupedOrders as $province => $orders)
        <div
            style="display: flex; justify-content: space-between; align-items: center; background-color: #d3e3f5; /* Blue background */
            color: rgb(23, 3, 39); padding: 10px 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif; margin-bottom: 20px; margin-top: 20px; margin-left: 10px; margin-right: 10px;">
            <h4 style="margin: 0; font-size: 1.2rem;color:rgb(23, 3, 39);font-weight:600">PROVINCE : {{ $province }}
            </h4>
            <span style="font-size: 1rem; font-weight: 600;">TOTAL ORDERS : {{ count($orders) }}</span>
        </div>

        <div class="month-table">
            <div class="table-responsive mt-3">
                <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                    <thead>
                        <tr>
                            <th class="border-0 text-muted fw-normal">Order Id</th>
                            <th class="border-0 text-muted fw-normal">Container ID</th>
                            <th class="border-0 text-muted fw-normal">Customer Name</th>
                            <th class="border-0 text-muted fw-normal">Payment Status</th>
                            <th class="border-0 text-muted fw-normal">View Orders</th>
                            <th class="border-0 text-muted fw-normal">Due Amount</th>
                            <th class="border-0 text-muted fw-normal">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="order-row" data-order-number="{{ $order->order_number }}">
                                <td>
                                    <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                                </td>
                                <td>
                                    <h6 class="font-weight-medium mb-0">{{ $order->container_number }}</h6>
                                </td>
                                <td>
                                    <h6 class="font-weight-medium mb-0">{{ $order->sender->first_name ?? '' }}
                                        {{ $order->sender->last_name ?? '' }}</h6>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-light-success text-primary custom-size py-3 w-100"
                                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                        data-order-pickup-id="{{ $order->id }}">
                                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="shipment-badge badge bg-success py-3 w-100"
                                        onclick="window.location.href='{{ route('user.order_overview', $order->id) }}'"
                                        style="background-color: rgb(0, 204, 102)!important; text-decoration: none; border: none;">
                                        <span class="fa-stack" style="margin-right: 5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-package feather-sm">
                                                <path
                                                    d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z">
                                                </path>
                                                <polyline points="2.32 6.16 12 11 21.68 6.16"></polyline>
                                                <line x1="12" y1="22.76" x2="12" y2="11"></line>
                                                <line x1="7" y1="3.5" x2="17" y2="8.5"></line>
                                            </svg>
                                        </span> View
                                    </button>
                                </td>
                                <td>
                                    <?php
                                    $due_amount = $order->grand_total_amount - $order->amount_paid;
                                    ?>
                                    @if ($due_amount === 0)
                                        <span class="badge bg-primary px-2 py-4 w-100">Paid</span>
                                    @else
                                        <span class="badge bg-danger px-2 py-4 w-100">${{ number_format($due_amount, 2) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->package_status == 'PACK')
                                        <span class="shipment-badge badge square-badge bg-success py-4 w-100"
                                            style="background-color: rgb(19, 190, 202)!important">
                                            <i class="fas fa-hand-holding"></i> PACK
                                        </span>
                                    @elseif ($order->package_status == 'SHIP')
                                        <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100"
                                            style="background-color: rgb(27, 188, 157)!important;">
                                            <i class="fas fa-paper-plane"></i> SHIP
                                        </span>
                                    @elseif ($order->package_status == 'CUSTOMS')
                                        <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100">
                                            <i class="fas fa-box"></i> CUSTOMS
                                        </span>
                                    @elseif ($order->package_status == 'CUSTOMS REVIEW')
                                        <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100">
                                            <i class="fa fa-star"></i> CUSTOMS REVIEW
                                        </span>
                                    @elseif ($order->package_status == 'IN DISTRIBUTION')
                                        <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                            style="background-color: rgb(4, 131, 164)!important;">
                                            <i class="fas fa-map-marker-alt"></i> DISTRIBUTION
                                        </span>
                                    @elseif ($order->package_status == 'DELIVERED')
                                        <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                            style="background-color: rgb(18, 182, 72)!important;">
                                            <i class="fas fa-dolly"></i> DELIVERED
                                        </span>
                                    @elseif ($order->package_status == 'order_created')
                                        <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                            style="background-color: rgb(150, 206, 18)!important;">
                                            <i class="fas fa-plus-circle"></i> ORDER CREATED
                                        </span>
                                    @else
                                        <span class="shipment-badge badge square-badge bg-secondary px-2 py-4 w-100">
                                            <i class="fas fa-question-circle"></i> UNKNOWN STATUS
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center align-items-center m-2 p-3"
        style="background-color: rgb(235, 7, 7); border-radius: 10px; gap: 20px;">
        <!-- Total Orders Section -->
        <div>
            <h
                style="padding: 10px 20px; font-weight: 700; font-size: 1.4rem; color: rgb(240, 232, 232); text-decoration: none;">
                ORDERS UNDER INVESTIGATION BY CUSTOMS:
            </h>
        </div>


    </div>
    <div class="month-table">
        <div class="table-responsive mt-3">
            <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                <thead>
                    <tr>
                        <th class="border-0 text-muted fw-normal">Order Id</th>
                        <th class="border-0 text-muted fw-normal">Container ID</th>
                        <th class="border-0 text-muted fw-normal">Customer Name</th>
                        <th class="border-0 text-muted fw-normal">Payment Status</th>
                        <th class="border-0 text-muted fw-normal">View Orders</th>
                        <th class="border-0 text-muted fw-normal">Due Amount</th>
                        <th class="border-0 text-muted fw-normal">Order Status</th>
                        <th class="border-0 text-muted fw-normal text-center">Manage Order</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($investigation_orders->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="alert alert-danger fw-bold py-2" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i> No orders under this container for
                                    investigation.
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($investigation_orders as $order)
                            <tr class="order-row" data-order-number="{{ $order->order_number }}">
                                <td>
                                    <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                                </td>
                                <td>
                                    <h6 class="font-weight-medium mb-0">{{ $order->container_number }}</h6>
                                </td>
                                <td>
                                    <h6 class="font-weight-medium mb-0">
                                        {{ $order->sender->first_name ?? '' }}
                                        {{ $order->sender->last_name ?? '' }}</h6>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-light-success text-primary custom-size py-3 w-100"
                                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                        data-order-pickup-id="{{ $order->id }}">
                                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="shipment-badge badge bg-success py-3 w-100"
                                        onclick="window.location.href='{{ route('user.order_overview', $order->id) }}'"
                                        style="background-color: rgb(0, 204, 102)!important; text-decoration: none; border: none;">
                                        <span class="fa-stack" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-package feather-sm">
                                                <path
                                                    d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z">
                                                </path>
                                                <polyline points="2.32 6.16 12 11 21.68 6.16"></polyline>
                                                <line x1="12" y1="22.76" x2="12" y2="11">
                                                </line>
                                                <line x1="7" y1="3.5" x2="17" y2="8.5">
                                                </line>
                                            </svg>
                                        </span> View
                                    </button>
                                </td>
                                <td>
                                    <?php
                                    $due_amount = $order->grand_total_amount - $order->amount_paid;
                                    ?>
                                    @if ($due_amount === 0)
                                        <span class="badge bg-primary px-2 py-4 w-100">Paid</span>
                                    @else
                                        <span
                                            class="badge bg-danger px-2 py-4 w-100">${{ number_format($due_amount, 2) }}</span>
                                    @endif
                                </td>
                                <style>
                                    .custom-badge {
                                        font-size: 14px;
                                        font-weight: bold;
                                        border-radius: 5px;
                                    }

                                    .badge-success {
                                        background-color: #28a745 !important;
                                        border: none;
                                    }

                                    .badge-danger {
                                        background-color: #dc3545 !important;
                                    }
                                </style>
                                <td>
                                    <span class="shipment-badge badge bg-success px-2 py-4 w-100"
                                        style="background-color: rgb(164, 4, 19)!important;"><i
                                            class="fas fa-pause-circle" style="margin-right:6px;margin-left:5px"></i> HELD
                                        BY CUSTOMS</span>
                                    {{-- <button type="button" class="badge badge-success px-3 py-2 update-status custom-badge"
                                        data-order-id="{{ $order->order_number }}">
                                        UPDATE
                                    </button> --}}
                                </td>
                                <td style="display: flex; justify-content: center; align-items: center; height: 100px;">
                                    <button type="button"
                                        class="updateDistributionButton shipment-badge badge bg-primary"
                                        style="background-color: #007bff!important; /* Blue color */
                                                                       text-decoration: none;
                                                                       border: none;
                                                                       padding: 10px 20px;
                                                                       font-size: 14px;
                                                                       border-radius: 5px;
                  display: flex;
                                                        align-items: center;
                                                     justify-content: center;
                                                       height: 75px;
                               width: 250px;
                                                                       white-space: normal;
                                                                       word-wrap: break-word;"
                                        data-order-id="{{ $order->order_number }}">
                                        UPDATE THE ORDER STATUS AS DISTRIBUTION
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentStatusModalLabel">Payment Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@endsection

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".update-status").forEach(function(button) {
                button.addEventListener("click", function() {
                    let orderId = this.getAttribute("data-order-id");

                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you want to remove it from HELD BY CUSTOMS to CUSTOMS?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, update it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Update the order status using the AJAX request
                            fetch("{{ route('user.order.updateCustomsStatus', ':orderId') }}"
                                    .replace(':orderId', orderId), {
                                        method: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                "content"),
                                            "Content-Type": "application/json"
                                        },
                                        body: JSON.stringify({
                                            status: "CUSTOMS"
                                        })
                                    }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire("Updated!",
                                                "The package status has been updated.",
                                                "success")
                                            .then(() => location
                                        .reload()); // Reload page after update
                                    } else {
                                        Swal.fire("Error!", "Something went wrong.",
                                            "error");
                                    }
                                });
                        }
                    });
                });
            });
        });
    </script>
    <script>
        function filterOrders() {
            const searchValue = document.getElementById("orderSearch").value.toLowerCase();
            const rows = document.querySelectorAll(".order-row");

            rows.forEach(row => {
                const orderNumber = row.getAttribute("data-order-number").toLowerCase();
                if (orderNumber.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
    <script>
        const moveOrderRouteToDistribution = @json(route('user.move.order_status_to_distribution'));
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll(".updateDistributionButton").forEach(function(button) {
                button.addEventListener("click", function() {
                    const orderNumber = this.getAttribute('data-order-id');
                    console.log("Button clicked, Order Number: ", orderNumber);

                    // Show SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'Are you sure you want to move this order status as distribution?',
                        text: `Order Number: ${orderNumber}. Once done, this action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, move it!',
                        cancelButtonText: 'No, cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Fetch the Laravel route dynamically


                            // Proceed with moving the order
                            Swal.fire('Moving Order...',
                                'Please wait while we process your request.', 'info');

                            fetch(moveOrderRouteToDistribution, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify({
                                        order_number: orderNumber
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Success',
                                            text: data.message,
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then(() => {
                                            // Reload the page
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Error', data.message ||
                                            'An error occurred',
                                            'error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error',
                                        'An error occurred while processing your request.',
                                        'error');
                                });
                        } else {
                            Swal.fire('Cancelled',
                                'The order was not moved to distribution.',
                                'info');
                        }
                    });
                });

            });
        });
    </script>


    <script>
        const paymentDetailsRoute = "{{ route('get.payment.details', ':id') }}";
    </script>
    <script>
        // Pass the URL to JavaScript
        var collectPaymentUrl = "{{ route('user.collect_payment', ['order_pickup_id' => '__order_pickup_id__']) }}";
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const paymentModal = document.getElementById('paymentStatusModal');

            paymentModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const orderPickupId = button.getAttribute(
                    'data-order-pickup-id'); // Extract order_pickup_id

                // Replace :id in the route URL with the actual order_pickup_id
                const url = paymentDetailsRoute.replace(':id', orderPickupId);

                // Fetch data and update modal
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('#paymentStatusModal .modal-body').innerHTML = `
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
                           <span class="bg-primary text-white px-2 py-1 rounded">${data.total_amount.toFixed(2)}</span>
                        </td>
                    </tr>
                    ${data.deposits.map((deposit, index) => `
                                                <tr>
                                                    <td class="text-primary text-center">Deposit ${index + 1}</td>
                                                    <td class="text-center">
                                                        <span class="bg-success text-white px-2 py-1  mt-4 rounded">Amount: ${deposit.amount}</span><br><br>
                                                        <span class="bg-warning text-white px-2 py-1 mt-4 rounded">Method: ${deposit.method}</span>
                                                    </td>
                                                </tr>
                                            `).join('')}
                    <tr>
                        <td class="text-primary text-center">Amount Due</td>
                        <td class="text-center">
                            <span class="bg-danger text-white px-2 py-1 rounded">${data.amount_due.toFixed(2)}</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-primary text-center">Payment Status</td>
                        <td class="text-center">
                            <span class="bg-${data.is_paid ? 'success' : 'danger'} text-white px-2 py-1 rounded">${data.payment_status}</span>
                        </td>
                    </tr>
                    ${data.amount_due > 0 ? `
                                                <tr>
                                                    <td class="text-primary text-center align-middle fw-bold">Collect Due Payment</td>
                                                    <td class="text-center align-middle">
                                                        <button type="button" class="btn rounded-pill px-4"
                                                            style="background-color: red; color: white; font-weight: bold; font-size: 1.25rem; padding: 10px 20px;"
                                                            onclick="window.location.href='${collectPaymentUrl.replace('__order_pickup_id__', data.order_pickup_id)}'">
                                                            Click Here
                                                        </button>
                                                    </td>
                                                </tr>
                                            ` : ''}
                </tbody>
            </table>
        </div>
    `;
                    })
                    .catch(error => console.error('Error fetching payment details:', error));
            });
        });
    </script>
@endpush
