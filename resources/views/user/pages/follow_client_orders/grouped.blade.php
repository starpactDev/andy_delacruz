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

    <!-- Search Field -->
    <div class="d-flex justify-content-center align-items-center m-4 p-3"
        style="background-color: #a6cffc; border-radius: 10px; gap: 20px;">
        <!-- Total Orders Section -->
        <div>
            <h
                style="padding: 10px 20px; font-weight: 600; font-size: 1.4rem; color: rgb(26, 11, 54); text-decoration: none;">
                REPORT OF PACKAGES DELIVERED MORE THAN THREE MONTHS AGO
            </h>
        </div>

        <!-- Search Section -->

    </div>
    <style>
        .month-table table th,
        .month-table table td {
            width: 200px;
            /* Adjust as needed */
            text-align: center;
        }
    </style>
    @foreach (['Last 3 Months', 'Last 6 Months', 'Last 12 Months'] as $group)
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: #d3e3f5; /* Blue background */
            color: rgb(23, 3, 39); padding: 10px 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif; margin-bottom: 20px; margin-top: 20px; margin-left: 10px; margin-right: 10px;">
            <h4 style="margin: 0; font-size: 1.2rem;color:rgb(23, 3, 39);font-weight:600">CUSTOMERS WHO SENT PACKAGES -
                {{ $group }}
            </h4>

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
                            <th class="border-0 text-muted fw-normal">Customer Tel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($orders[$group]) && $orders[$group]->isNotEmpty())
                            @foreach ($orders[$group] as $order)
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
                                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                                            data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                            data-order-pickup-id="{{ $order->id }}">
                                            <i data-feather="dollar-sign" class="feather-sm"></i> View
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="shipment-badge badge bg-success"
                                            onclick="window.location.href='{{ route('user.order_overview', $order->id) }}'"
                                            style="background-color: rgb(0, 204, 102)!important; text-decoration: none; border: none;">
                                            <span class="fa-stack" style="margin-right: 5px;">
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
                                        @if ($due_amount === 0 || $due_amount == 0.0)
                                            <span class="badge bg-primary px-2 py-1"
                                                style="background-color:rgb(27, 27, 83)!important">Paid</span>
                                        @else
                                            <span
                                                class="badge bg-danger px-2 py-1">${{ number_format($due_amount, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <h6 class="font-weight-medium mb-0">{{ $order->sender->telephone ?? '' }}
                                        </h6>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center" style="color:red;font-weight:600">No orders found in
                                    this group.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

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
