@extends('admin.layouts.master')
@section('content')
    <style>
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

        .paid-badge {


            width: 100px;
            padding: 20px;
            text-align: center;
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
    <div class="container-fluid">


        <div class="col-lg-12 mb-4 ">
            <div class="d-flex justify-content-center">
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(27, 43, 71)">
                        DOMINICAN REPUBLIC PAYMENT :</span>

                    <span style="color:rgb(18, 96, 116)"> MONEY EXCHANGE</span>
                </h4>

            </div>
            <div class="row mt-3">


                @include('admin.pages.money_exchange_peso_table')
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
            </div>

        </div>
    @endsection
    @push('script')
    <script>
        const paymentDetailsRoute = "{{ route('get.payment.details', ':id') }}";
    </script>
    <script>
        // Pass the URL to JavaScript
        var collectPaymentUrl = "{{ route('driver.collect_payment', ['order_pickup_id' => '__order_pickup_id__']) }}";
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
