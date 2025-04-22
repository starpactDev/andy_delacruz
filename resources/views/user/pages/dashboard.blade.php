@extends('admin.layouts.master')
@section('content')
<style>
    #alertContainer {
        cursor: pointer; /* Changes cursor to pointer when hovering over the alert */
    }
</style>
    <style>
        .blue-bar {
            width: 100%;
            /* Make the bar stretch the full width */
            height: 20px;
            /* Adjust the height of the bar */
            background-color: #24a0ed;
            /* Set the color to blue */
            margin-bottom: 20px;
            /* Add some space above and below the bar */
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
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">
                @if (Auth::user()->type == 0)
                    Admin
                @elseif (Auth::user()->type == 2)
                    Manager
                    @else
                    Secretary
                @endif Dashboard
            </h3>
            <ol class="breadcrumb mb-0 p-0 bg-transparent">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    @if (Auth::user()->type == 0)
                    Admin
                @elseif (Auth::user()->type == 2)
                    Manager
                    @else
                    Secretary
                    @endif Dashboard

                </li>
            </ol>
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
            @if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
            @if (Auth::user()->type == 2)
                @php
                    // Retrieve all containers from the Container model
                    $containers = App\Models\Container::all();
                @endphp

                @foreach ($containers as $container)
                    @php
                        // Retrieve all orders for this container number
                        $orders = App\Models\OrderPickup::where('container_number', $container->name)->get();

                        // Check if these orders are assigned
                        $assignedOrders = App\Models\AssignedOrderToDriver::whereIn(
                            'order_pickup_id',
                            $orders->pluck('id'),
                        )->get();
                    @endphp

                    @if ($orders->count() > 0 && $assignedOrders->isEmpty())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertContainer">
                            <strong>Warning!</strong> You have not assigned the orders under the container:
                            <strong>{{ $container->name }}</strong>.
                            <button id="alertClose" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endforeach
            @endif

            <!-- Column -->
            <div class="col-sm-12 col-md-6 col-xl-3">
                <a href="{{ route('user.potential_customer.index') }}">
                    <div class="card bg-primary">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row align-items-center">
                                <div
                                    class="
                          round
                          rounded-circle
                          text-white
                          d-inline-block
                          text-center
                          bg-light-primary
                          text-primary
                        ">
                                    <i data-feather="users" class="fill-white text-primary"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-0 text-white">Total Customers</h4>
                                    <span class="text-white-50">View Your Total Customers at a Glance</span>
                                </div>
                                <div class="ms-auto">
                                    <h2 class="font-weight-medium mb-0 text-white">

                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            @if (Auth::user()->type == 3)
            <div class="col-sm-12 col-md-6 col-xl-3">
                <a href="{{ route('user.secretary.expense_report') }}">
                    <div class="card bg-info">
                        <div class="card-body text-white">
                            <div class="d-flex flex-row align-items-center">
                                <div
                                    class="
                          round
                          rounded-circle
                          text-white
                          d-inline-block
                          text-center
                          bg-light-primary
                          text-primary
                        ">
                        <i data-feather="bar-chart-2" class="fill-white text-primary"></i>
                                </div>
                                <div class="ms-3">
                                    <h4 class="mb-0 text-white">REPORT & MAINTAINANCE</h4>
                                    <span class="text-white-50">Of Vehicles in Dom Rep</span>
                                </div>
                                <div class="ms-auto">
                                    <h2 class="font-weight-medium mb-0 text-white">

                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
            @endif
            <!-- Column -->
            @if (Auth::user()->type == 0)
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('user.total_earnings') }}">
                        <div class="card bg-success">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div
                                        class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-light-success
                              text-success
                            ">
                                        <i data-feather="credit-card" class="fill-white text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Total Earnings</h4>
                                        <span class="text-white-50">Check Your Total Earnings Instantly</span>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="font-weight-medium mb-0 text-white">
                                            ${{ number_format($totalAmountPaid, 2) }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @if (Auth::user()->type == 2)
                <!-- Column -->
                <div class="col-sm-12 col-md-6 col-xl-3">
                    <a href="{{ route('user.distribution_of_packagers') }}">
                        <div class="card bg-success">
                            <div class="card-body text-white">
                                <div class="d-flex flex-row align-items-center">
                                    <div
                                        class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-light-success
                              text-success
                            ">
                                        <i data-feather="map-pin" class="fill-white text-success"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h4 class="mb-0 text-white">Create Route</h4>
                                        <span class="text-white-50">Delivering Excellence, Every Single Time.</span>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="font-weight-medium mb-0 text-white">

                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            <!-- Column -->

            <!--2nd  Column -->
            @if (Auth::user()->type !== 3)
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('user.container.view') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div
                                    class="
                  round round-lg
                  text-white
                  d-flex
                  align-items-center
                  justify-content-center
                  rounded-circle
                  bg-info
                ">
                                    <img src="{{ asset('admin/assets/images/truck1.png') }}" alt="Truck Icon"
                                        class="img-fluid" style="width: 40px; height: 40px;">
                                </div>
                                <div class="ms-2 align-self-center">
                                    <h3 class="mb-0">TOTAL ORDERS PER CONTAINER</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('user.pending_order') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div
                                    class="
                  round round-lg
                  text-white
                  d-flex
                  align-items-center
                  justify-content-center
                  rounded-circle
                  bg-danger
                ">
                                    <i data-feather="package" class="fill-white feather-lg"></i>
                                </div>
                                <div class="ms-2 align-self-center">
                                    <h3 class="mb-0">TOTAL PENDING ORDERS TO BE DELIVERED IN DOM REP</h3>
                                    <h6 class="text-muted mb-0">{{ $countDueOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('user.delivered_order') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="
                  round round-lg
                  text-white
                  d-flex
                  align-items-center
                  justify-content-center
                  rounded-circle
                  bg-success
                "
                                    style="background-color: #29b100!important;">
                                    <i data-feather="box" class="fill-white feather-lg"></i>
                                </div>
                                <div class="ms-2 align-self-center">
                                    <h3 class="mb-0">TOTAL ORDERS DELIVERED IN DOM REP</h3>
                                    <h6 class="text-muted mb-0">{{ $countDeliveredOrders }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            <!-- Column -->
            <div class="col-lg-6 col-md-6">
                <a href="{{ route('user.calendar.index') }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div
                                    class="
                  round round-lg
                  text-white
                  d-flex
                  align-items-center
                  justify-content-center
                  rounded-circle
                  bg-primary
                ">
                                    <i data-feather="calendar" class="fill-white feather-lg"></i>
                                </div>
                                <div class="ms-2 align-self-center">
                                    <h3 class="mb-0">ORDER PICKUP REQUEST</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Column -->
            <!-- Column -->

            <!-- Column -->
        </div>


        <!-- 7. Stats card -->

        <div
            class="
           d-flex
           border-bottom
           title-part-padding
           px-0
           mb-3
           align-items-center
         ">
            <div>
                <h4 class="mb-0">Quick Links</h4>
            </div>
        </div>

        <div class="row">
            {{-- <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
                <a href="javascript:void(0)" class="card bg-warning text-white w-100 card-hover"
                    style="background-color: rgb(46, 84, 211)!important">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="mdi mdi-account-plus display-6 fw-bold"></span>
                            <div class="ms-auto">
                                <i data-feather="arrow-right" class="fill-white"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4 class="card-title mb-1 text-white">Add Driver</h4>
                            <h6 class="card-text fw-normal text-white-50">
                                Add driver details for delivery.
                            </h6>
                        </div>
                    </div>
                </a>
            </div> --}}
            @if (Auth::user()->type !== 3)
            <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
                <a href="{{ route('user.container.add') }}" class="card bg-danger text-white w-100 card-hover"
                    style="background-color: rgb(24, 125, 165)!important">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="mdi mdi-map-marker display-6 fw-bold"></span>
                            <div class="ms-auto">
                                <i data-feather="arrow-right" class="fill-white"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4 class="card-title mb-1 text-white">
                                Shipment Tracking
                            </h4>
                            <h6 class="card-text fw-normal text-white-50">
                                Shipment tracking ensures package delivery.
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
            @endif
            @if (Auth::user()->type == 0)
                {{-- <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
                    <a href="javascript:void(0)" class="card bg-primary text-white w-100 card-hover"
                        style="background-color: #fdac08!important">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="mdi mdi-cart display-6 fw-bold"></span>
                                <div class="ms-auto">
                                    <i data-feather="arrow-right" class="fill-white"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h4 class="card-title mb-1 text-white">
                                    Create Order
                                </h4>
                                <h6 class="card-text fw-normal text-white-50">
                                    Estimate shipment details, enter product price.
                                </h6>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <div class="col-md-6 col-xl-3 d-flex align-items-stretch">
                    <a href="{{ route('user.due_amount') }}" class="card bg-primary text-white w-100 card-hover"
                        style="background-color: rgb(214, 45, 45)!important">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <span class="mdi mdi-credit-card display-6 fw-bold"></span>
                                <div class="ms-auto">
                                    <i data-feather="arrow-right" class="fill-white"></i>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h4 class="card-title mb-1 text-white">
                                    Due Amount
                                </h4>
                                <h6 class="card-text fw-normal text-white-50">
                                    Reviewing Customer due amounts precisely
                                </h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
        @if (Auth::user()->type == 2)
            <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center" id="containerInfo">
                <div>
                    <h4 class="mb-0">Package Distributors In Dom Rep.</h4>
                </div>
            </div>
            <div class="row">
                <div class="d-flex justify-content-center mb-4">
                    <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(50, 175, 33)">
                            CONTAINER NUMBER :</span>

                        <span style="color:rgb(40, 99, 32)"> # {{ config('global.currentContainerNumber') }}</span>
                    </h4>


                </div>
                <div class="col-lg-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-4 ">
                                    <h4 class="card-title"><span style="color:rgb(48, 37, 153);font-weight:600"> Search
                                            Province</span></h4>
                                    <h6 class="card-subtitle lh-base">
                                        Select the provinces whose details you want to show
                                    </h6>
                                    <select id="provinceSelect" class="select2 form-control custom-select"
                                        style="width: 100%; height: 36px">
                                        <option>Select</option>
                                        <optgroup label="Provinces">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province['name'] }}"
                                                    @if ($province['name'] == $provinceWithHighestPickups->province) selected @endif>

                                                    {{ $province['name'] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-4 ">
                                    <div class="d-flex justify-content-center">
                                        <h4 class="card-title " style="font-weight:600">Province:<span
                                                id="province_name_span"style="color:rgb(238, 19, 19)">
                                                {{ $provinceWithHighestPickups->province ?? 'Samana' }}</span></h4>

                                    </div>
                                    @include('admin.pages.table1')
                                </div>

                                <div class="col-lg-12 mb-4">
                                    <h4 class="card-title"><span style="color:rgb(250, 179, 74);font-weight:600">Assign
                                            To:</span></h4>
                                    <h6 class="card-subtitle lh-base">
                                        Choose Your Driver, Assign Seamlessly.
                                    </h6>
                                    <select id="driverSelect" class="select2 form-control custom-select"
                                        style="width: 100%; height: 36px">
                                        <option value="">Select</option> <!-- Ensure empty value for default -->
                                        <optgroup label="Drivers">
                                            @foreach ($dominicanTeamDrivers as $driver)
                                                <option value="{{ $driver->user->name }}"
                                                    data-driver-id="{{ $driver->user->id }}">{{ $driver->user->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>

                                    <div class="d-flex justify-content-center mt-3">
                                        <button id="assignDriverBtn" type="button"
                                            class="btn btn-info font-weight-medium rounded-pill px-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-send feather-sm fill-white me-2">
                                                    <line x1="22" y1="2" x2="11" y2="13">
                                                    </line>
                                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                                </svg>
                                                Assign Driver
                                            </div>
                                        </button>
                                    </div>

                                </div>
                                <div class="blue-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
        @if (Auth::user()->type == 0)
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
                                                    Container Number
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
                            <h4 class="text-white card-title">Recent Orders Overview</h4>
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
                                                <img src="{{ url('/') }}/admin/assets/images/users/1.avif"
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
                                                    <h5 class="my-1 text-dark font-weight-medium"
                                                        style="color:#12527a!important">
                                                        {{ $order->order_number ?? '' }}
                                                    </h5>
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
                                                        onclick="window.location.href='{{ route('user.order_overview', ['order_pickup_id' => $order->id]) }}'">
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


                    <!-- Payment Status Modal -->
                    <div class="modal fade" id="paymentStatusModal" tabindex="-1"
                        aria-labelledby="paymentStatusModalLabel" aria-hidden="true">
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- End of Modal -->
        @endif


    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection


@push('script')
    <script>
        const paymentDetailsRoute = "{{ route('get.payment.details', ':id') }}";
    </script>
    <script>
        $(document).ready(function() {
            $('#assignDriverBtn').on('click', function() {
                var selectedDriver = $('#driverSelect').val(); // Get selected driver value
                var selectedDriverId = $('#driverSelect option:selected').data(
                    'driver-id'); // Get the actual driver ID
                console.log(selectedDriver, selectedDriverId);

                // Check if a driver is selected
                if (selectedDriver && selectedDriverId) {
                    // Array to store selected order IDs
                    var selectedOrders = [];

                    // Loop through all checked checkboxes and get their corresponding order IDs
                    $('input[type="checkbox"]:checked').each(function() {
                        var orderId = $(this).closest('tr').data(
                            'order-id'); // Get order ID from the row
                        if (orderId) {
                            selectedOrders.push(orderId); // Add the order ID to the array
                        } else {
                            console.log("No order ID found for this row");
                        }
                    });

                    console.log(selectedOrders);

                    // Check if there are any selected orders
                    if (selectedOrders.length > 0) {
                        // Perform the AJAX request to store the data in the AssignedOrderToDriver model
                        $.ajax({
                            url: "{{ route('user.assign.driver') }}", // Using the route name for assignment
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}", // Add CSRF token for security
                                manager_id: {{ auth()->id() }}, // Get the authenticated manager's ID
                                driver_id: selectedDriverId, // Pass the selected driver ID
                                order_pickup_ids: selectedOrders // Pass the selected order IDs
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Driver ' + selectedDriver +
                                        ' has been assigned successfully to the selected orders.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location
                                            .reload(); // Reload the page when OK is clicked
                                    }
                                });
                            },
                            error: function(error) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was an error assigning the driver.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    } else {
                        // If no orders are selected, show a warning
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please select at least one order to assign the driver.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    }
                } else {
                    // If no driver is selected, show a warning
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please select a driver first.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#provinceSelect').on('change', function() {
                const selectedProvince = $(this).val();
                console.log('Selected province:', selectedProvince);

                if (selectedProvince) {
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Fetching order pickups...',
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading(); // Show the loading spinner
                        }
                    });
                    $.ajax({
                        url: "{{ route('user.order.pickups.by.province') }}", // Directly use the route name
                        method: 'GET',
                        data: {
                            province: selectedProvince
                        },
                        success: function(response) {
                            Swal.close(); // Close the loading spinner
                            // Update province name in the card title
                            $('#province_name_span').text(' ' + selectedProvince);


                            // Populate the table with the response data
                            const tableBody = $('table tbody');
                            tableBody.empty(); // Clear existing rows

                            if (response && response.length > 0) {
                                response.forEach(order => {
                                    const senderName = order.sender ? order.sender
                                        .first_name + ' ' + order.sender.last_name :
                                        'N/A';
                                    // Check if the order is complete and set the payment status
                                    const paymentStatus = order.is_completed === 0 ?
                                        'Due' : 'Paid';
                                    console.log(paymentStatus);
                                    const paymentBadgeClass = order.is_completed === 0 ?
                                        'bg-danger' :
                                        'bg-success'; // Choose the badge color
                                    tableBody.append(`
                                <tr data-order-id="${order.id}">
                                    <td>
                                         <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                                    </td>
                                    <td>${order.order_number}</td>
                                    <td>${senderName}</td>
                                                                       <td><span class="badge ${paymentBadgeClass} px-2 py-1">${paymentStatus}</span></td> <!-- Show Badge -->

                                     <td> <span class="shipment-badge badge bg-success " style="background-color: rgb(19, 190, 202)!important">
                        <span class="fa-stack" style="margin-right:5px;">
                          <i class="fas fa-hand-holding fa-stack-1x"></i>
                          <i class="fas fa-box fa-stack-1x" style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                        </span>
                        PICK
                      </span>
                    </td>
                                </tr>
                            `);
                                });
                            } else {
                                tableBody.append(`
                            <tr>
                                <td colspan="5" class="text-center">No orders found for ${selectedProvince}.</td>
                            </tr>
                        `);
                            }
                        },
                        error: function(error) {
                            Swal.close();
                            console.error('Error:', error);
                        }
                    });
                }
            });
            // Trigger the change event on page load to simulate a default province selection
            const defaultProvince = $('#provinceSelect').val(); // Get the current value of the select element
            if (defaultProvince) {
                $('#provinceSelect').trigger('change'); // Trigger the change event
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle 'Select All' checkbox
            $('#selectAllCheckbox').on('change', function() {
                var isChecked = $(this).prop('checked');
                // Set the state of all checkboxes in the body to the same as the 'Select All' checkbox
                $('#orderPickupsTableBody input[type="checkbox"]').prop('checked', isChecked);
            });

            // Handle individual checkboxes in the table
            $('#orderPickupsTableBody').on('change', 'input[type="checkbox"]', function() {
                // Check if all checkboxes are selected
                var allChecked = $('#orderPickupsTableBody input[type="checkbox"]:not(:checked)').length ===
                    0;

                // If all are checked, check the 'Select All' checkbox, else uncheck it
                $('#selectAllCheckbox').prop('checked', allChecked);
            });
        });
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
    <script>
        $(document).ready(function() {
            // Close the alert when the close button is clicked
            $('#alertClose').on('click', function() {

                $(this).closest('.alert').fadeOut();
            });

            $('#alertContainer').on('click', function() {
            // Scroll instantly to the containerInfo
            $('html, body').scrollTop($('#containerInfo').offset().top);
        });
        });
    </script>
@endpush
