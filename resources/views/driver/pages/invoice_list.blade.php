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
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(175, 33, 33)">
                        Invoices :</span>

                    <span style="color:rgb(223, 15, 15)"> List</span>
                </h4>

            </div>
            <div class="row mt-3">


                <div class="month-table">
                    <div class="table-responsive mt-3">
                        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                            <thead>
                                <tr>

                                    <th class="border-0 text-muted fw-normal">Order Id #</th>
                                    <th class="border-0 text-muted fw-normal">Issue Date</th>
                                    <th class="border-0 text-muted fw-normal">Container ID</th>
                                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                                    <th class="border-0 text-muted fw-normal">View Invoices</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>

                                        <td>
                                            <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0">{{ \Carbon\Carbon::parse($order->orderPickup->issue_date)->format('d M Y') }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->container_number }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0">
                                                {{ $order->orderPickup->sender->first_name ?? 'N/A' }}
                                                {{ $order->orderPickup->sender->last_name ?? 'N/A' }}
                                            </h6>
                                        </td>
                                        <td>

                                                <a href="{{ route('driver.invoice.index', ['order_number' => $order->order_number]) }}" class="btn btn-primary">View</a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    @endsection
    @push('script')
    @endpush
