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
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(50, 175, 33)">
                        CONTAINER ORDERS :</span>

                    <span style="color:rgb(40, 99, 32)"> {{ $container_number }}</span>
                </h4>

            </div>
            <div class="row mt-3">

                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 mb-2 text-center"> <!-- Added 'text-center' class -->
                            <h4 class="card-title">

                                <form method="GET" action="{{ route('user.container.details', ['id' => $id]) }}">
                                    <div class="input-group" style="height: 50px;">
                                        <span class="input-group-text"><i data-feather="search"
                                                class="feather-sm fill-white"></i></span>
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search by Order Number or Customer Name/Email/Phone"
                                            value="{{ request('search') }}">
                                        <button class="btn btn-light-info text-info font-weight-medium"
                                            type="submit">Search</button>
                                    </div>
                                    <!-- Refresh button -->

                                </form>
                            </h4>
                        </div>
                        @if (request('search'))
                            <a href="{{ route('user.container.details', ['id' => $id]) }}"
                                class="btn btn-light-danger text-danger font-weight-medium" type="button">
                                Refresh
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mb-2 text-center"> <!-- Added 'text-center' class -->
                            <h4 class="card-title">
                                <span style="color: rgb(48, 37, 153); font-weight: 600">
                                    Total Orders in this Container
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                @include('admin.pages.table2')
            </div>

        </div>
    @endsection
    @push('script')
    @endpush
