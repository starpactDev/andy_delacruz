@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .id-upload-label {
            margin-right: 40px;
            font-weight: 600;
            font-size: 18px;
            display: block;
            /* Ensure each label takes full width */
            margin-bottom: 20px;
            /* Add space between labels */
        }

        .input-img {
            margin-left: 10px;
            /* Optional: add space between text and image */
        }

        .onoffswitch {
            position: relative;
            width: 90px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .onoffswitch-checkbox {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .onoffswitch-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #999999;
            border-radius: 20px;
        }

        .onoffswitch-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }

        .onoffswitch-inner:before,
        .onoffswitch-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 14px;
            color: white;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: bold;
            box-sizing: border-box;
        }

        .onoffswitch-inner:before {
            content: "ON";
            padding-left: 10px;
            background-color: #40b113;
            color: #FFFFFF;
        }

        .onoffswitch-inner:after {
            content: "OFF";
            padding-right: 10px;
            background-color: #e91818;
            color: #f7ecec;
            text-align: right;
        }

        .onoffswitch-switch {
            display: block;
            width: 18px;
            height: 20px;
            margin: 6px;
            background: #FFFFFF;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 56px;
            border: 2px solid #999999;
            border-radius: 20px;
            transition: all 0.3s ease-in 0s;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-switch {
            right: 14px;
        }

        /* Styling for the image previews */
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .id-image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .id-image-preview img {
            width: 400px;
            height: 200px;
            object-fit: cover;
            /* Ensures the image fits the dimensions without stretching */
            border: 2px solid #ddd;
            border-radius: 10px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        .id-image-preview .delete-image-btn {
            background-color: #ff6b6b;
            /* Light red button */
            border: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            width: 30px;
            height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .image-preview .delete-image-btn {
            background-color: #ff6b6b;
            /* Light red button */
            border: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            width: 30px;
            height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .delete-image-btn:hover {
            background-color: #ff4b4b;
            /* Darker red on hover */
            transform: scale(1.1);
            /* Slight zoom effect on hover */
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        .blue-bar {
            width: 100%;
            /* Make the bar stretch the full width */
            height: 10px;
            /* Adjust the height of the bar */
            background-color: blue;
            /* Set the color to blue */
            margin-bottom: 40px;
            /* Add some space above and below the bar */
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

        .add-note-btn {
            font-size: 12px;
        }

        .add-identity-btn {
            font-size: 12px;
        }

        .view-identity-btn {
            font-size: 12px;
        }

        .upload-img-btn {
            font-size: 12px;
            border-radius: 12px;
            background-color: rgb(155, 22, 167) !important
        }
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">
                @if ($team == 'Dominican Team')
                    <img src="{{ url('/') }}/admin/assets/images/users/dom.jpg" alt="user" class="rounded-circle"
                        width="40" /> RD Driver
                @else
                    <img src="{{ url('/') }}/admin/assets/images/users/usa.jpg" alt="user" class="rounded-circle"
                        width="40" /> USA Driver
                @endif Dashboard
            </h3>

        </div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            {{-- <div class="d-flex mt-2 justify-content-end">
            <div class="d-flex me-3 ms-2">
                <div class="chart-text me-2">
                    <h6 class="mb-0"><small>THIS MONTH</small></h6>
                    <h4 class="mt-0 text-info">$58,356</h4>
                </div>
                <div class="spark-chart">
                    <div id="monthchart"></div>
                </div>
            </div>
            <div class="d-flex ms-2">
                <div class="chart-text me-2">
                    <h6 class="mb-0"><small>LAST MONTH</small></h6>
                    <h4 class="mt-0 text-primary">$48,356</h4>
                </div>
                <div class="spark-chart">
                    <div id="lastmonthchart"></div>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            @php

                $user = Auth::user();
            @endphp
            @if ($user->driverInfo && $user->driverInfo->team === 'USA Team')
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('driver.pickup.list') }}" class="text-decoration-none">
                        <div class="card bg-danger">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div
                                        class="rounded-circle text-white d-inline-block text-center bg-light-danger text-danger">
                                        <i data-feather="clock" class="fill-white text-danger"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Pending PickUp Request</h4>
                                        <span class="text-white-50">Manage Your Pending PickUp Request Efficiently</span>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="font-weight-medium mb-0 text-white">
                                            {{ $pendingOrdersCount }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <div class="card bg-success" style="background-color: #17ad30 !important;">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row align-items-center">
                                <div class=" round rounded-circle text-white d-inline-block text-center " style="background-color: #8cf19d !important; ">
                                    <i data-feather="box" class="fill-white " style="color:#17ad30!important"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-0 text-white">Pickup Request Completed</h4>
                                    <span class="text-white-50">Pickup request has been successfully processed </span>
                                </div>
                                <div class="ms-auto">
                                    <h2 class="font-weight-medium mb-0 text-white"> 0 </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('driver.rd_pending.list') }}" class="text-decoration-none">
                        <div class="card bg-danger">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div class=" round rounded-circle text-white d-inline-block text-center bg-light-danger text-danger ">
                                        <i data-feather="clock" class="fill-white text-danger"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Pending Delivery</h4>
                                        <span class="text-white-50">Manage Your Pending Deliveries Efficiently</span>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="font-weight-medium mb-0 text-white">
                                            {{ $isCompletedZeroCount }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('driver.reminders.index') }}">
                        <div class="card bg-info" style="background-color: #1ba8a8 !important;">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div class=" round rounded-circle text-white d-inline-block text-center


                            "
                                        style="background-color: #8cf1ec !important; ">
                                        <i data-feather="calendar" class="fill-white " style="color:#173fad!important"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Notes & Reminder</h4>
                                        {{-- <span class="text-white-50">Total Orders Successfully Delivered</span> --}}
                                    </div>
                                    <div class="ms-auto">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('driver.money_exchange_peso.index') }}">
                        <div class="card bg-info" style="background-color: #dbbd12 !important;">
                            <div class="card-body ">
                                <div class="d-flex flex-row align-items-center">
                                    <div class=" round rounded-circle text-white d-inline-block text-center" style="background-color: #e7f18c !important; ">
                                        <i data-feather="dollar-sign" class="fill-white " style="color:#ad7117!important"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Money Exchange</h4>
                                        <span style="font-weight:600">Dominican Republic Payment</span>
                                    </div>
                                    <div class="ms-auto">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('driver.rd_completed.list') }}" class="text-decoration-none">
                        <div class="card bg-success" style="background-color: #17ad30 !important;">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div class=" round rounded-circle text-white d-inline-block text-center" style="background-color: #8cf19d !important; ">
                                        <i data-feather="box" class="fill-white " style="color:#17ad30!important"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Total Orders delivered</h4>
                                        <span class="text-white-50">Total Orders Successfully Delivered</span>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="font-weight-medium mb-0 text-white">
                                            {{ $isCompletedOneCount }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>



        @if ($team == 'Dominican Team')
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search Province</h4>
                        <h6 class="card-subtitle lh-base">
                            Select the provinces whose details you want to show
                        </h6>
                        <select id="provinceFilter" class="select2 form-control" multiple="multiple"
                            style="height: 36px; width: 100%">
                            <optgroup label="Provinces">
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div id="provinceOrdersContainer" class="row">
                    <div class="my-5 d-flex align-items-center">
                        <!-- Switch -->
                        <div class="onoffswitch mr-3">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch"
                                tabindex="0">
                            <label class="onoffswitch-label" for="myonoffswitch">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>

                        <!-- Route Label -->
                        <span class="route-text mx-2" style="font-size: 16px; font-weight: 600; color: #333;">
                            Route Switch
                        </span>
                    </div>
                     <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body">
                                <!-- Centered Main Heading -->
                                <div class="text-center mb-3">
                                    <h4 class="mb-0" style="color: blueviolet; font-weight: 600; font-size: 25px;">
                                        List of Packages By Province
                                    </h4>
                                </div>

                                <!-- Top Right: Assigned Provinces -->
                                <div class="d-flex justify-content-between align-items-start">
                                    <div></div> <!-- Empty div to balance flex alignment -->
                                    <div class="text-right">
                                        <h5 class="mb-2" style="font-weight: 600;">Assigned Province</h5>
                                        <div class="d-flex flex-wrap justify-content-end">
                                            @foreach ($groupedOrders as $province => $orders)
                                                <button class="btn btn-primary m-1 province-button">
                                                    {{ $province }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @foreach ($groupedOrders as $province => $orders)
                        @php
                            $provinceId = uniqid();
                        @endphp
                        <div class="col-lg-12 d-flex align-items-stretch province-card"
                            data-province="{{ $province }}">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <h4 class="card-title" style="font-weight:600">Province:
                                            <span style="color:rgb(238, 19, 19)">{{ $province }}</span>
                                        </h4>
                                    </div>
                                    @if ($orders->isEmpty())
                                        <p class="text-center text-muted">No packages assigned under this province.</p>
                                    @else
                                        @include('admin.pages.table', [
                                            'orders' => $orders,
                                            'provinceId' => $provinceId,
                                            'provinceName' => $province,
                                        ])
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-md-flex no-block">
                                <h4 class="card-title">Recent Order Pickups</h4>

                            </div>
                            <div class="month-table">
                                <div class="table-responsive mt-3">
                                    <table class="table stylish-table v-middle mb-0 no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-0 text-muted fw-normal">
                                                    Order Id
                                                </th>
                                                <th class="border-0 text-muted fw-normal">
                                                    Customer Name
                                                </th>


                                                <th class="border-0 text-muted fw-normal">
                                                    Container ID
                                                </th>
                                                <th class="border-0 text-muted fw-normal">
                                                    Issue Date
                                                </th>
                                                <th class="border-0 text-muted fw-normal">
                                                    Payment Status
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderPickups as $order)
                                                <tr>

                                                    <td>
                                                        <h6 class="font-weight-medium mb-0">
                                                            {{ $order->order_number }}
                                                        </h6>

                                                    </td>
                                                    <td>
                                                        <h6 class="font-weight-medium mb-0">

                                                            {{ $order->sender->first_name ?? 'N/A' }}
                                                            {{ $order->sender->last_name ?? 'N/A' }}
                                                        </h6>

                                                    </td>
                                                    <td> <span class="badge bg-warning px-2 py-1">
                                                            {{ $order->container_number }}</span></td>
                                                    <td> <span
                                                            class="badge bg-primary px-2 py-1">{{ \Carbon\Carbon::parse($order->issue_date)->format('d M Y') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($order->is_completed === 0)
                                                            <span class="badge bg-danger px-2 py-1">Due</span>
                                                        @else
                                                            <span class="badge bg-success px-2 py-1">Paid</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach




                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body bg-info rounded-top">
                            <h4 class="text-white card-title">Orders Overview</h4>
                            <h6 class="card-subtitle text-white mb-0 op-5">

                            </h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="message-box contact-box position-relative mt-2">
                                <div class="message-widget contact-widget scrollable" style="height: 305px">
                                    <!-- contact -->

                                    @foreach ($orderPickups as $order)
                                        <a class="p-3 d-flex align-items-start rounded-3">
                                            <div class="user-img position-relative d-inline-block me-2">
                                                <img src="{{ url('/') }}/admin/assets/images/users/1.jpg"
                                                    alt="user" class="rounded-circle w-100" />
                                                <span
                                                    class="
                                                          profile-status
                                                          pull-right
                                                          d-inline-block
                                                          position-absolute
                                                          bg-success
                                                          rounded-circle
                                                        "></span>
                                            </div>
                                            <div
                                                class="
                                                        ps-2
                                                        v-middle
                                                        d-md-flex
                                                        align-items-center
                                                        w-100
                                                      ">
                                                <div>
                                                    <h5 class="my-1 text-dark font-weight-medium">
                                                        {{ $order->sender->first_name ?? '' }}
                                                        {{ $order->sender->last_name ?? '' }}
                                                    </h5>
                                                    <span class="text-muted fs-2">{{ $order->sender->email ?? '' }}
                                                    </span>


                                                </div>
                                                <div class="ms-auto d-flex button-group mt-3 mt-md-0">
                                                    <button type="button"
                                                        class="btn btn-sm btn-light-success text-success"
                                                        onclick="window.location.href='{{ route('driver.driver_order_overview', ['order_pickup_id' => $order->id]) }}'">
                                                        <i data-feather="package" class="feather-sm"></i> View Orders
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-light-primary text-primary"
                                                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                                        data-order-pickup-id="{{ $order->id }}">
                                                        <i data-feather="dollar-sign" class="feather-sm"></i> Payment
                                                        Status
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <!-- contact -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif


    </div>

    <!-- Payment Status Modal -->
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
    <!--Add Note Modal Structure -->
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">Add Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="noteForm">

                        <div class="mb-3">
                            <label for="noteInput" class="form-label">Note</label>
                            <input type="text" class="form-control" id="noteInput" required>
                        </div>
                        <input type="hidden" id="shipmentIdInput">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save </button>

                        </div>
                    </form>
                    <div class="mt-4">
                        <h6>Previous Notes</h6>
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Note</th>
                                        <th>Added At</th>
                                    </tr>
                                </thead>
                                <tbody id="notesTableBody">
                                    <tr>
                                        <td colspan="3" class="text-center">No notes added yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Upload Packager Image  Modal Structure -->

    <!--Upload Photo Identity Image  Modal Structure -->
    <div class="modal fade" id="identityModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel"> Please Upload
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info" role="alert" style="margin-bottom: 1rem;">
                        When you upload the ID, packages, and signature, the status will automatically update to
                        "Delivered."
                    </div>
                    <input type="hidden" id="receiver_id">
                    <input type="hidden" id="order_number">
                    <input type="hidden" id="order_id">
                    <style>
                        /* Optional styling for the container */
                        .mb-4 {
                            margin-bottom: 16px;
                        }

                        #file-label {
                            display: inline-flex;
                            /* Display the label as an inline-flex container */
                            align-items: center;
                            /* Align the text and image vertically in the center */
                            cursor: pointer;
                            /* Make the label look clickable */
                            margin-top: 10px;
                            /* Add some space between input and label */
                        }


                        .input-img {
                            margin-left: 10px;
                            /* Add space between "Sender ID Card" text and image */
                            width: 32px;
                            /* Control the size of the image */
                            height: 32px;
                            /* Keep the image size consistent */
                        }
                    </style>
                    <div id="id-upload-div" class="mb-4">
                        <h4>VALID FORMS OF IDENTIFICATION:</h4>

                        <div class="onoffswitch" id="idSwitch">
                            <input type="checkbox" name="onoffswitch-val" class="onoffswitch-checkbox"
                                id="myonoffswitch-val" tabindex="0">
                            <label class="onoffswitch-label" for="myonoffswitch-val">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>

                        <!-- Hidden file input for front ID image upload -->
                        <input type="file" id="front-file-input" accept="image/*" style="display: none;">
                        <!-- Label to upload front ID image -->
                        <label for="front-file-input" id="front-file-label" class="id-upload-label">
                            DOM REP DRIVER LICENSE OR ELECTORAL ID (FRONT):
                            <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png" alt="Click to upload"
                                title="Click to upload" class="input-img" id="front-id-image">
                        </label>

                        <!-- Hidden file input for back ID image upload -->
                        <input type="file" id="back-file-input" accept="image/*" style="display: none;">
                        <!-- Label to upload back ID image -->
                        <label for="back-file-input" id="back-file-label" class="id-upload-label">
                            DOM REP DRIVER LICENSE OR ELECTORAL ID (BACK):
                            <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png" alt="Click to upload"
                                title="Click to upload" class="input-img" id="back-id-image">
                        </label>

                        <!-- Single preview container for both images -->
                        <div id="image-preview" class="id-image-preview" style="display: flex; gap: 10px;"></div>
                        <div id="id-upload-section" class="text-center mb-4" onclick="idhandleUpload()">
                            <!-- Placeholder for the image -->
                            <img src="{{ url('/') }}/admin/assets/images/upload_btn.png" alt="Upload Package"
                                class="img-fluid" style="width: 50px; height: 50px;" id="upload-id-image" />

                            <!-- Centered heading -->
                            <h2 style="font-weight: 600; margin-top: 10px; color:#410e5f" id="upload-id-title">
                                PHOTOS
                                UPLOAD</h2>
                        </div>
                    </div>


                    <div id="package-upload-div" class="mb-4">
                        <div class="blue-bar"></div>
                        <!-- Hidden file input for package image uploads -->
                        <input type="file" id="file-input-two" accept="image/*" multiple style="display: none;">

                        <div class="onoffswitch" id="packageSwitch">
                            <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                id="myonoffswitch-two" tabindex="0">
                            <label class="onoffswitch-label" for="myonoffswitch-two">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>

                        <!-- Label to upload package photos -->
                        <label for="file-input-two" id="file-label" style="font-weight: 600; font-size: 20px;">
                            PHOTOS OF DELIVERED PACKAGES :
                            <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png" alt="Click to upload"
                                title="Click to upload" class="input-img" id="package-image">
                        </label>

                        <!-- Preview of selected images -->
                        <div id="package-image-preview" class="image-preview"></div>


                        <div id="upload-section" class="text-center mb-4" onclick="handleUpload()">
                            <!-- Placeholder for the image -->
                            <img src="{{ url('/') }}/admin/assets/images/upload_btn.png" alt="Upload Package"
                                class="img-fluid" style="width: 50px; height: 50px;" id="upload-image" />

                            <!-- Centered heading -->
                            <h2 style="font-weight: 600; margin-top: 10px; color:#410e5f" id="upload-title">PHOTOS
                                UPLOAD</h2>
                        </div>
                        <div class="blue-bar "></div>
                    </div>





                    <div id="signature-div" class="col-md-12 mt-5">
                        <h4 style="color:rgb(27, 27, 94);font-weight:800">Signature of Receiver :</h4>
                        <div lass="input-group mb-3" style="border: 1px solid #ccc; width: 900px; height: 200px;">


                            <canvas id="signature-pad" width="900" height="200"></canvas>
                            <img id="signature-image" style="display: none; width: 100%; height: 100%;"
                                alt="Signature Image">

                        </div>
                        <button id="clear-signature" class="mt-2">Clear</button>
                        <button id="save-signature" class="mt-2">Save</button>





                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close
                        </button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewidentityModal" tabindex="-1" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel"> View Uploaded Documents
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="receiver_id">
                    <input type="hidden" id="order_number">
                    <input type="hidden" id="order_id">
                    <style>
                        /* Optional styling for the container */
                        .mb-4 {
                            margin-bottom: 16px;
                        }

                        #file-label {
                            display: inline-flex;
                            /* Display the label as an inline-flex container */
                            align-items: center;
                            /* Align the text and image vertically in the center */
                            cursor: pointer;
                            /* Make the label look clickable */
                            margin-top: 10px;
                            /* Add some space between input and label */
                        }


                        .input-img {
                            margin-left: 10px;
                            /* Add space between "Sender ID Card" text and image */
                            width: 32px;
                            /* Control the size of the image */
                            height: 32px;
                            /* Keep the image size consistent */
                        }
                    </style>
                    <div id="id-upload-div" class="mb-4">
                        <h4>VALID FORMS OF IDENTIFICATION:</h4>





                        <!-- Single preview container for both images -->
                        <div id="view-image-preview" class="id-image-preview" style="display: flex; gap: 10px;"></div>

                    </div>


                    <div id="package-upload-div" class="mb-4">
                        <div class="blue-bar"></div>
                        <!-- Hidden file input for package image uploads -->
                        <h4>RECEIVED PACKAGES:</h4>

                        <!-- Preview of selected images -->
                        <div id="view-package-image-preview" class="image-preview"></div>



                        <div class="blue-bar "></div>
                    </div>





                    <div id="signature-div" class="col-md-12 mt-5">
                        <h4 style="color:rgb(27, 27, 94);font-weight:800">Signature of Receiver :</h4>
                        <div lass="input-group mb-3" style="border: 1px solid #ccc; width: 900px; height: 200px;">



                            <img id="view-signature-image" style="display: none; width: 100%; height: 100%;"
                                alt="Signature Image">

                        </div>






                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Close
                        </button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection


@push('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const provinceButtons = document.querySelectorAll('.province-button');
        provinceButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetProvince = button.textContent.trim();
                const targetCard = document.querySelector(`.province-card[data-province="${targetProvince}"]`);
                if (targetCard) {
                    targetCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    });
</script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        // Event listener to reload the page after the modal is closed
        $('#identityModal').on('hidden.bs.modal', function() {
            location.reload(); // This reloads the page after closing the modal
        });
    </script>
    <script>
        // Event listener to reload the page after the modal is closed
        $('#viewidentityModal').on('hidden.bs.modal', function() {
            location.reload(); // This reloads the page after closing the modal
        });
    </script>
    <script>
        document.getElementById('package-image').addEventListener('click', function(event) {

            const switchStateTwo = document.getElementById('myonoffswitch-two').checked;
            if (!switchStateTwo) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the package photos.',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Function to handle image upload and masking for the front ID
        function handleFrontImageUpload(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('image-preview');
            const switchState = document.getElementById('myonoffswitch-val').checked;

            if (!switchState) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Array.from(fileInput.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        // Set canvas size to match the image dimensions
                        canvas.width = 1920;
                        canvas.height = 1212;

                        // Draw the image onto the canvas
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        // Define the areas to mask (e.g., ID number, address)
                        const maskAreas = [{
                            x: 641,
                            y: 2,
                            width: 1217,
                            height: 1205
                        }];

                        // Apply black rectangles to mask sensitive areas
                        maskAreas.forEach(area => {
                            ctx.fillStyle = '#69c3de'; // Black color for masking
                            ctx.fillRect(area.x, area.y, area.width, area.height);
                        });

                        // Create a div to hold the canvas (preview)
                        const div = document.createElement('div');
                        div.classList.add('image-container');

                        // Convert canvas to data URL and use it as the image preview
                        div.innerHTML = `
                <img src="${canvas.toDataURL('image/png')}" alt="Masked Front ID Image" style="max-width: 100%; height: auto;">
                <button class="delete-image-btn" data-index="${index}">&times;</button>
            `;

                        // Append to preview container
                        previewContainer.appendChild(div);
                        div.querySelector('.delete-image-btn').addEventListener('click', function() {
                            // Remove the image container from the preview
                            previewContainer.removeChild(div);
                            // Reset the file input value
                            fileInput.value = '';
                        });
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        // Function to handle image upload for the back ID
        function handleBackImageUpload(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('image-preview');
            const switchState = document.getElementById('myonoffswitch-val').checked;

            if (!switchState) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Array.from(fileInput.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const div = document.createElement('div');
                        div.classList.add('image-container');

                        // Convert image to data URL and use it as the image preview
                        div.innerHTML = `
                <img src="${img.src}" alt="Back ID Image" style="max-width: 100%; height: auto;">
                <button class="delete-image-btn" data-index="${index}">&times;</button>
            `;

                        // Append to preview container
                        previewContainer.appendChild(div);
                        div.querySelector('.delete-image-btn').addEventListener('click', function() {
                            // Remove the image container from the preview
                            previewContainer.removeChild(div);
                            // Reset the file input value
                            fileInput.value = '';
                        });
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        // Event listeners for both file inputs and image labels
        document.getElementById('front-id-image').addEventListener('click', function(event) {

            const switchState = document.getElementById('myonoffswitch-val').checked;
            if (!switchState) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
            }
        });

        document.getElementById('back-id-image').addEventListener('click', function(event) {
            const switchState = document.getElementById('myonoffswitch-val').checked;
            if (!switchState) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Add change event listeners to the file inputs
        document.getElementById('front-file-input').addEventListener('change', handleFrontImageUpload);
        document.getElementById('back-file-input').addEventListener('change', handleBackImageUpload);


        // Array to hold selected files
        let selectedFiles = [];

        // Handle file selection
        document.getElementById('file-input-two').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('package-image-preview');
            const switchStateTwo = document.getElementById('myonoffswitch-two').checked;

            if (!switchStateTwo) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the package photos.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Add new files to the selectedFiles array
            Array.from(fileInput.files).forEach(file => {
                selectedFiles.push(file);
            });

            // Update the file input with the updated selectedFiles array
            updateFileInput();

            // Clear previous previews and display all selected files
            previewContainer.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('image-container');
                    div.innerHTML = `
            <img src="${e.target.result}" alt="Package Image">
            <button class="delete-image-btn" data-index="${index}">&times;</button>
        `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            console.log("File count:", selectedFiles.length); // Log correct file count
        });

        // Handle image deletion
        document.getElementById('package-image-preview').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-image-btn')) {
                const index = event.target.dataset.index;

                // Remove the file from selectedFiles array
                selectedFiles.splice(index, 1);

                // Update the file input with the updated selectedFiles array
                updateFileInput();

                // Remove the preview element
                event.target.parentElement.remove();

                // Re-index the delete buttons after removal
                document.querySelectorAll('.delete-image-btn').forEach((btn, idx) => {
                    btn.dataset.index = idx;
                });

                console.log("File count after removal:", selectedFiles.length); // Log correct file count
            }
        });

        // Helper function to update file input's FileList from selectedFiles array
        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            document.getElementById('file-input-two').files = dt.files;
        }

        function handleUpload() {
            const fileInput = document.getElementById('file-input-two');
            const receiverId = $('#receiver_id').val();

            const orderNumber = $('#order_number').val();
            updateFileInput();
            // Check if there are images selected
            console.log("Current file count:", fileInput.files.length);
            if (fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please select images to upload.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Ask for confirmation before proceeding with the upload
            Swal.fire({
                title: 'Are you sure?',
                text: "Once uploaded, you won't be able to upload more images for this package.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading alert
                    const loadingAlert = Swal.fire({
                        title: 'Uploading...',
                        text: 'Please wait while the images are being uploaded.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Show the loading spinner
                        }
                    });

                    const formData = new FormData();
                    Array.from(fileInput.files).forEach((file, index) => {
                        formData.append(`images[${index}]`, file); // Use 'images' as the key
                    });


                    formData.append('receiver_id', receiverId); // Replace with actual sender ID
                    formData.append('order_pickup_id', orderNumber); // Replace with actual sender ID

                    // Perform AJAX upload
                    $.ajax({
                        url: "{{ route('driver.upload.receiver.package.images') }}", // Use the named route
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            // Handle success
                            Swal.fire({
                                title: 'Success!',
                                text: 'Photos uploaded successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Change the image and title after confirmation
                                    document.getElementById('upload-image').src =
                                        "{{ url('/') }}/admin/assets/images/tick.png"; // Change to your success image
                                    document.getElementById('upload-title').innerText =
                                        'Uploaded'; // Change the title text

                                    // Disable delete buttons
                                    document.querySelectorAll('.delete-image-btn').forEach(
                                        btn => btn.style
                                        .display = 'none');

                                    // Hide the image source button after upload success
                                    document.getElementById('package-image').style.display =
                                        'none';
                                }
                            });
                        },
                        error: function(xhr) {
                            // Check if the response has validation errors
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                let errorMessages = '';
                                // Concatenate all error messages
                                for (const messages of Object.values(xhr.responseJSON.errors)) {
                                    errorMessages += messages.join(', ') +
                                        '\n'; // Join messages for each field
                                }

                                // Show all validation messages in SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: errorMessages ||
                                        'An error occurred while uploading images. Please try again.',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                // Handle generic errors
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: 'An error occurred while uploading images. Please try again.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });
        }
        document.getElementById('package-image-preview').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-image-btn')) {
                const index = parseInt(event.target.dataset.index); // Ensure index is an integer
                const fileInput = document.getElementById('file-input-two');
                const dt = new DataTransfer();

                // Rebuild FileList, excluding the file at the specified index
                Array.from(fileInput.files).forEach((file, i) => {
                    if (i !== index) dt.items.add(file);
                });

                // Update file input's FileList to reflect only remaining files
                fileInput.files = dt.files;

                // Remove the image preview from the DOM
                event.target.parentElement.remove();

                console.log(fileInput.files.length); // Log the updated file count

                // Clear file input if no files remain
                if (fileInput.files.length === 0) {
                    fileInput.value = ''; // Clear the file input
                }

                // Reassign data-index attributes to maintain correct order
                const deleteButtons = document.querySelectorAll('.delete-image-btn');
                deleteButtons.forEach((button, i) => {
                    button.dataset.index = i; // Reassign correct index
                });
            }
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function idhandleUpload() {


            const orderNumber = $('#order_number').val();
            console.log("Order Number:", orderNumber);
            // Get the file inputs and other elements
            const frontFileInput = document.getElementById('front-file-input');
            const backFileInput = document.getElementById('back-file-input');
            const uploadButtonImage = document.getElementById('upload-id-image');
            const uploadTitle = document.getElementById('upload-id-title');
            const receiverId = $('#receiver_id').val();
            // Check if files are uploaded
            const frontFileUploaded = frontFileInput.files.length > 0;
            const backFileUploaded = backFileInput.files.length > 0;

            // Create SweetAlert messages based on the upload status
            if (!frontFileUploaded && !backFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Upload Required',
                    text: 'Please upload both the front and back images of your ID.',
                    confirmButtonText: 'OK'
                });
            } else if (!frontFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Front Image Missing',
                    text: 'Please upload the front image of your ID first.',
                    confirmButtonText: 'OK'
                });
            } else if (!backFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Back Image Missing',
                    text: 'Please upload the back image of your ID first.',
                    confirmButtonText: 'OK'
                });
            } else {
                // Both images are uploaded
                Swal.fire({
                    icon: 'info',
                    title: 'Confirm Upload',
                    text: 'Once you upload, you will not be able to change the images. Do you want to proceed?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, upload',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Show loading alert
                        const loadingAlert = Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while the images are being uploaded.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading(); // Show the loading spinner
                            }
                        });

                        // Prepare FormData for AJAX request
                        const formData = new FormData();
                        formData.append('id_front', frontFileInput.files[0]);
                        formData.append('id_back', backFileInput.files[0]);
                        formData.append('receiver_id', receiverId);
                        formData.append('order_pickup_id', orderNumber);


                        // Make the AJAX request to upload the files
                        $.ajax({
                            url: '{{ route('driver.upload.reciver.id.images') }}', // Use your route name
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                SenderIdUpload = true;
                                loadingAlert
                                    .close(); // Close the loading alert once the upload is successful
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Upload Successful',
                                    text: 'Both images have been uploaded successfully!',
                                    confirmButtonText: 'OK'
                                }).then((confirmResult) => {
                                    if (confirmResult.isConfirmed) {
                                        // Change upload button image and title
                                        uploadButtonImage.src =
                                            "{{ url('/') }}/admin/assets/images/tick.png"; // Change image to tick
                                        uploadTitle.textContent =
                                            'Uploaded'; // Change title text

                                        // Hide the image source buttons
                                        document.getElementById('front-file-label').style
                                            .display = 'none';
                                        document.getElementById('back-file-label').style
                                            .display = 'none';

                                        // Optionally, remove delete buttons
                                        const deleteButtons = document.querySelectorAll(
                                            '.delete-image-btn');
                                        deleteButtons.forEach(button => button.remove());
                                    }
                                });
                            },
                            error: function(xhr) {
                                loadingAlert.close(); // Close the loading alert on error
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    let errorMsg = '';
                                    $.each(errors, function(key, value) {
                                        errorMsg += value[0] + '\n';
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: errorMsg,
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: 'An error occurred. Please try again.',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }
                        });
                    }
                });
            }
        }
    </script>
    <script>
        const pdfRouteTemplate = @json(route('driver.invoice.pdf_index', ['order_number' => ':orderNumber']));
    </script>
    <script>
        const getReceiverSignatureUrl = "{{ route('get.receiver.signature', ['receiverId' => ':receiverId']) }}";
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const getNotesUrl = `{{ route('driver.get.notes', ['orderPickupId' => ':orderPickupId']) }}`;

            const addNoteButtons = document.querySelectorAll('.add-note-btn');

            addNoteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderPickupId = this.getAttribute('data-order-pickup-id');
                    const driverId = this.getAttribute('data-driver-id');
                    const orderNumber = this.getAttribute('data-order-number');

                    document.getElementById('shipmentIdInput').value = JSON.stringify({
                        order_number: orderNumber,
                        order_pickup_id: orderPickupId,
                        driver_id: driverId
                    });

                    // Replace placeholder in the URL
                    const url = getNotesUrl.replace(':orderPickupId', orderPickupId);

                    // Fetch notes using the generated URL
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            const notesTableBody = document.getElementById('notesTableBody');
                            notesTableBody.innerHTML = ''; // Clear existing notes

                            if (data.notes.length > 0) {
                                data.notes.forEach((note, index) => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${note.add_note}</td>
                            <td>${new Date(note.created_at).toLocaleString()}</td>
                        `;
                                    notesTableBody.appendChild(row);
                                });

                                // Append the "View PDF" link at the end
                                const pdfRow = document.createElement('tr');
                                pdfRow.innerHTML = `
                        <td colspan="3" class="text-center">
                            <a href="${generatePdfRoute(orderNumber)}" target="_blank">View PDF</a>
                        </td>
                    `;
                                notesTableBody.appendChild(pdfRow);
                            } else {
                                notesTableBody.innerHTML =
                                    '<tr><td colspan="3" class="text-center">No notes added yet.</td></tr>';
                            }
                        })
                        .catch(error => console.error('Error fetching notes:', error));
                });
            });

            // Function to generate the PDF route dynamically
            function generatePdfRoute(orderNumber) {
                return pdfRouteTemplate.replace(':orderNumber', orderNumber);
            }


            const noteForm = document.getElementById('noteForm');
            noteForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const note = document.getElementById('noteInput').value;
                const shipmentData = JSON.parse(document.getElementById('shipmentIdInput').value);

                fetch('{{ route('driver.add.note') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            ...shipmentData,
                            add_note: note
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Note added successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                const modal = bootstrap.Modal.getInstance(document
                                    .getElementById('noteModal'));
                                modal.hide();
                                const notesTableBody = document.getElementById(
                                    'notesTableBody');
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${notesTableBody.children.length + 1}</td>
                            <td>${note}</td>
                            <td>${new Date().toLocaleString()}</td>
                        `;
                                notesTableBody.appendChild(row);
                                document.getElementById('noteInput').value = '';
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to add note!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            let isFetchingImages = false; // Flag to track if an image fetch is already in progress
            $('.add-identity-btn').on('click', function() {


                var shipmentId = $(this).data('shipment-id');


                let receiver_id = $(this).data('receiver-id');

                let order_id = $(this).data('order-id');
                let order_pickup_id = $(this).data('order-number');


                $('#shipmentIdInput').val(shipmentId);

                $('#receiver_id').val(receiver_id);
                $('#order_id').val(order_id);
                $('#order_number').val(order_pickup_id);


                // loadSignature(order_pickup_id);
                // fetchReceiverIdImages(order_pickup_id);
                // checkUploadedImages(order_pickup_id);

                // modal.find('#image-preview').empty();
                // modal.find('#package-image-preview').empty();

                $.ajax({
                    url: "{{ route('driver.check.missing.data') }}",
                    type: 'GET',
                    data: {
                        order_pickup_id: order_pickup_id
                    },
                    success: function(response) {
                        // Response contains missing data info
                        if (response.missing_id) {

                            $('#id-upload-div').show();

                            $('#image-preview').empty();


                            document.getElementById('front-file-label').style
                                .display = 'block';
                            document.getElementById('back-file-label').style
                                .display = 'block';



                        } else {
                            $('#id-upload-div').hide();
                        }

                        if (response.missing_packages) {
                            $('#package-upload-div').show();
                            document.getElementById('myonoffswitch-two').unchecked
                            $('#package-image-preview').empty();
                            document.getElementById('package-image').style.display =
                                'block';

                        } else {
                            $('#package-upload-div').hide();
                        }

                        if (response.missing_signature) {
                            $('#signature-div').show();
                        } else {
                            $('#signature-div').hide();
                        }
                    },
                    error: function(error) {
                        console.error('Error checking missing data:', error);
                    }
                });




            });
            $('.view-identity-btn').on('click', function() {


                var shipmentId = $(this).data('shipment-id');


                let receiver_id = $(this).data('receiver-id');

                let order_id = $(this).data('order-id');
                let order_pickup_id = $(this).data('order-number');


                $('#shipmentIdInput').val(shipmentId);

                $('#receiver_id').val(receiver_id);
                $('#order_id').val(order_id);
                $('#order_number').val(order_pickup_id);


                loadSignature(order_pickup_id);
                fetchReceiverIdImages(order_pickup_id);
                checkUploadedImages(order_pickup_id);

                // modal.find('#image-preview').empty();
                // modal.find('#package-image-preview').empty();






            });


            let uploadStep = "id-front"; // Tracks the current upload step

            function fetchReceiverIdImages(orderPickupId) {
                console.log('1 ' + isFetchingImages);

                // Prevent multiple fetch requests if one is already in progress
                if (isFetchingImages) {
                    console.log(isFetchingImages);
                    return; // Stop the function if the fetch is already in progress
                }


                console.log('2 ' + isFetchingImages);

                const url = routeUrl.replace('__ID__', orderPickupId); // Ensure routeUrl is set correctly

                // Hide all upload elements initially (if needed)
                const imagePreview = document.getElementById('view-image-preview');


                // Fetch images from the server
                fetch(url)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch images');
                        }
                        return response.json();
                    })
                    .then(async (data) => {
                        console.log("Fetched Data:", data);

                        // Check if images exist
                        if (!data.id_front && !data.id_back) {
                            console.log("No images found for this ID.");
                            return; // No images to display
                        }

                        // Show the preview container
                        imagePreview.style.display = 'flex';

                        // Reset the preview container's content
                        imagePreview.innerHTML = '';

                        // Add Front ID Image first (if it exists)
                        if (data.id_front) {
                            await processAndMaskImage(data.id_front, (maskedSrc) => {
                                const frontImageHtml =
                                    `<img src="${maskedSrc}" alt="Masked Front ID Image" style="max-width: 200px; height: auto;">`;
                                imagePreview.innerHTML += frontImageHtml;
                            });
                        }

                        // Add Back ID Image second (if it exists)
                        if (data.id_back) {
                            const backImageHtml =
                                `<img src="${data.id_back}" alt="Back ID Image" style="max-width: 200px; height: auto;">`;
                            imagePreview.innerHTML += backImageHtml;
                        }

                        console.log("Updated Images HTML:", imagePreview.innerHTML);
                    })
                    .catch((error) => {
                        console.error("Error fetching images:", error);
                        alert(error.message); // Optional: Show error to the user
                    })
                    .finally(() => {
                        isFetchingImages = false; // Reset flag once fetch is complete
                    });

            }

            function processAndMaskImage(imageUrl, callback) {
                return new Promise((resolve) => {
                    const reader = new FileReader();
                    const xhr = new XMLHttpRequest();

                    xhr.open("GET", imageUrl, true);
                    xhr.responseType = "blob";
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const file = xhr.response;
                            reader.readAsDataURL(file);
                        } else {
                            console.error("Failed to load image for masking:", xhr.statusText);
                            resolve(); // Resolve the promise even on error
                        }
                    };

                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;

                        img.onload = function() {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');

                            // Set canvas size to match the image dimensions
                            canvas.width = 1920; // Adjust as needed
                            canvas.height = 1212; // Adjust as needed

                            // Draw the image onto the canvas
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                            // Define the areas to mask (e.g., ID number, address)
                            const maskAreas = [{
                                x: 641,
                                y: 2,
                                width: 1217,
                                height: 1205
                            }];

                            // Apply rectangles to mask sensitive areas
                            maskAreas.forEach(area => {
                                ctx.fillStyle = '#69c3de'; // Masking color
                                ctx.fillRect(area.x, area.y, area.width, area.height);
                            });

                            // Get the masked image as a data URL and pass it to the callback
                            const maskedSrc = canvas.toDataURL();
                            callback(maskedSrc);
                            resolve(); // Resolve the promise after masking
                        };
                    };

                    xhr.send();
                });
            }
            // Fetch the signature for the receiver
            function loadSignature(orderId) {
                const url = getReceiverSignatureUrl.replace(':receiverId', orderId);

                fetch(url)
                    .then((response) => response.json())
                    .then((data) => {
                        const signatureImage = document.getElementById("view-signature-image");


                        if (data.signature_image) {
                            // Display the existing signature
                            const baseUrl = window.location
                                .origin; // Get the base URL (e.g., https://yourdomain.com)
                            signatureImage.src = `${data.signature_image}`;
                            signatureImage.style.display = "block";

                        }
                    })
                    .catch((error) => console.error("Error fetching signature:", error));
            }

            async function checkUploadedImages(orderId) {
                try {
                    // Fetch the uploaded images based on the order number using query parameters
                    const response = await fetch(
                        "{{ route('driver.fetch.uploaded.package.images') }}?order_pickup_id=" + orderId, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            }
                        });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        const images = data.images; // Assuming the response contains an array of image paths


                        const uploadedImagesContainer = document.getElementById('view-package-image-preview');
                        uploadedImagesContainer.innerHTML = ''; // Clear any previous content

                        // Add images side by side
                        images.forEach(imagePath => {
                            const imgElement = document.createElement('img');
                            imgElement.src = "{{ asset('') }}" + imagePath;

                            imgElement.classList.add('img-fluid', 'm-2');
                            imgElement.style.width = '100px'; // Set a fixed width for the images
                            uploadedImagesContainer.appendChild(imgElement);
                        });


                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'No Images Found',
                            text: 'There are no uploaded images for this order.',
                            confirmButtonText: 'OK'
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Fetching Images',
                        text: 'An error occurred while fetching the images. Please try again.',
                        confirmButtonText: 'OK'
                    });
                    console.error(error);
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("signature-pad");
            const signatureImage = document.getElementById('signature-image');
            const saveButton = document.getElementById('save-signature');
            const clearButton = document.getElementById('clear-signature');
            const signaturePad = new SignaturePad(canvas);
            const receiverId = $('#receiver_id').val();




            // Example: Load the signature for receiver with ID 1





            // Clear signature button
            clearButton.addEventListener("click", function() {
                signaturePad.clear();
            });

            // Save signature button with confirmation
            saveButton.addEventListener('click', () => {
                event.preventDefault(); // Prevent the default form submission
                const receiverId = $('#receiver_id').val(); // Get the sender_id
                const orderNumber = $('#order_number').val(); // Get the sender_id
                const orderId = $('#order_id').val(); // Get the sender_id

                // Check if sender_id has a value
                if (!receiverId) {
                    // If sender_id is empty, show a SweetAlert warning
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please choose receiver details first.'
                    });
                    return; // Exit the function to prevent AJAX call
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to change this after saving!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading alert
                        Swal.fire({
                            title: 'Saving...',
                            text: 'Please wait while your signature is being saved.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Convert canvas to data URL
                        const signatureDataURL = canvas.toDataURL('image/png');

                        // Send the signature data, sender_id, and order_number to the server
                        fetch('{{ route('receiver-save-signature') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    signature: signatureDataURL,
                                    receiver_id: receiverId,
                                    order_id: orderId,
                                    order_number: orderNumber
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                signature_image = true;
                                Swal.fire('Saved!', 'Your signature has been saved.',
                                    'success');

                                // Display the signature image and hide the canvas
                                signatureImage.src = signatureDataURL;
                                signatureImage.style.display = 'block';
                                canvas.style.display = 'none';

                                // Hide buttons after saving
                                saveButton.style.display = 'none';
                                clearButton.style.display = 'none';
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'There was an error saving your signature.',
                                    'error');
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all selectAll checkboxes
            const selectAllCheckboxes = document.querySelectorAll(".selectAllCheckbox");

            // Loop through each selectAll checkbox
            selectAllCheckboxes.forEach(selectAllCheckbox => {
                const provinceId = selectAllCheckbox.dataset
                    .province; // Get the province ID from the checkbox
                const rowCheckboxes = document.querySelectorAll(
                    `.rowCheckbox[data-province="${provinceId}"]`);
                const printInvoicesBtn = document.getElementById(`printInvoicesBtn_${provinceId}`);

                // Function to toggle the "Print Invoices" button for the current province
                function togglePrintButton() {
                    // Check if any row checkbox for this province is checked
                    const anySelected = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);
                    // Show or hide the button based on the selection
                    printInvoicesBtn.style.display = anySelected ? "inline-block" : "none";
                }

                // Function to check/uncheck the selectAll checkbox based on row checkbox states
                function updateSelectAllCheckbox() {
                    const allChecked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
                    selectAllCheckbox.checked = allChecked; // Update the selectAll checkbox state
                }

                // Event listener for the "Select All" checkbox in the current province
                selectAllCheckbox.addEventListener("change", (e) => {
                    const isChecked = e.target.checked;

                    // SweetAlert confirmation for "Select All"
                    if (isChecked) {
                        Swal.fire({
                            title: 'Confirm Action',
                            text: 'Do you want to print all invoices?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, print!',
                            cancelButtonText: 'No, cancel!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // If confirmed, check all row checkboxes
                                rowCheckboxes.forEach(checkbox => checkbox.checked = true);
                                togglePrintButton(); // Update button visibility
                            } else {
                                // If cancelled, uncheck the selectAll checkbox
                                selectAllCheckbox.checked = false;
                            }
                        });
                    } else {
                        // If "Select All" is unchecked without confirmation
                        rowCheckboxes.forEach(checkbox => checkbox.checked = false);
                        togglePrintButton(); // Update button visibility
                    }
                });

                // Add event listeners to each row checkbox to update the button visibility and selectAll checkbox state
                rowCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener("change", (e) => {
                        togglePrintButton(); // Update button visibility
                        updateSelectAllCheckbox(); // Update selectAll checkbox state
                    });
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#provinceFilter').select2(); // Initialize Select2

            // Handle change event
            $('#provinceFilter').on('change', function() {
                const selectedProvinces = $(this).val(); // Get selected provinces

                if (selectedProvinces && selectedProvinces.length > 0) {
                    // Show only selected provinces
                    $('.province-card').each(function() {
                        const province = $(this).data('province');
                        if (selectedProvinces.includes(province)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    // Check if any selected province has no orders
                    selectedProvinces.forEach(function(province) {
                        const provinceCard = $(`.province-card[data-province="${province}"]`);
                        if (provinceCard.length === 0) {
                            // Add a temporary card for provinces with no orders
                            const noOrdersCard = `
                        <div class="col-lg-12 d-flex align-items-stretch province-card temp-no-order" data-province="${province}">
                            <div class="card w-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <h4 class="card-title" style="font-weight:600">Province:
                                            <span style="color:rgb(238, 19, 19)">${province}</span>
                                        </h4>
                                    </div>
                                    <p class="text-center text-muted">No packages assigned under this province.</p>
                                </div>
                            </div>
                        </div>
                    `;
                            $('#provinceOrdersContainer').prepend(noOrdersCard);
                        }
                    });
                } else {
                    // If no province is selected, show all cards
                    $('.province-card').show();

                    // Remove temporary cards
                    $('.temp-no-order').remove();
                }
            });
        });
    </script>


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



    <script>
        const routeUrl = @json(route('api.get-receiver-id-images', ['order_pickup_id' => '__ID__']));
    </script>
@endpush
