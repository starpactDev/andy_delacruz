@extends('admin.layouts.master')
@section('content')
    <style>
       

        .route-heading {
            font-weight: 700;
            font-size: 35px;
            color: white;
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

                <h4 class="card-title" style="font-weight:600">Province:
                    <span style="color:rgb(238, 19, 19)">{{ $province }}</span>
                </h4>
            </div>
            <div class="row mt-3">


                @if (count($orders) > 0)
                    <div class="bg-info py-3">
                        <div class="container d-flex justify-content-between align-items-center">
                            <!-- Image on the left (circle) -->
                            <div>
                                <img src="{{ url('/') }}/admin/assets/images/users/dom.jpg" alt="user"
                                    class="rounded-circle" width="40" />
                            </div>
                            <div>
                                <img src="{{ url('/') }}/admin/assets/images/users/direction.png" alt="user"
                                    class="rounded-circle" width="40" />
                            </div>
                            <!-- Text in the center -->
                            <div class=" ms-1 route-heading">

                                <p class="m-0">DOMINICAN REPUBLIC ROUTE</p>

                            </div>


                            <!-- Button on the right -->
                            <div>
                                <button id="startRouteBtn" class="btn btn-success"
                                    style="background-color: rgb(32, 172, 32);font-weight:600"> <i
                                        class="fa fa-power-off"></i> START ROUTE</button>
                            </div>
                        </div>
                    </div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Receiver Address</th>
                                <th>Contact</th>

                                <!-- Add other table columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <span class="order-number" hidden>{{ $order['order_number'] }}</span>
                                @php
                                    // Assuming you have a Sender model to fetch sender details by ID
                                    $sender = \App\Models\Sender::find($order['order_pickup']['sender_id']);
                                    $receiver = \App\Models\Receiver::find($order['order_pickup']['receiver_id']);
                                @endphp
                                <tr>
                                    <td>{{ $order['order_number'] }}</td>
                                    <td> {{ $sender ? $sender->first_name : 'N/A' }}
                                        {{ $sender ? $sender->last_name : 'N/A' }}</td>
                                    <td> {{ $receiver ? $receiver->address : 'N/A' }}
                                        ,{{ $receiver ? $receiver->neighborhood : 'N/A' }}
                                        <br />
                                        {{ $receiver ? $receiver->city : 'N/A' }}
                                        ,{{ $receiver ? $receiver->province : 'N/A' }}

                                    </td>
                                    <td> <b style="color:rgb(83, 15, 55)">Tell
                                            :</b>{{ $receiver ? $receiver->telephone : 'N/A' }}
                                        <br /><b style="color:rgb(10, 10, 95)">Cell :</b>
                                        {{ $receiver ? $receiver->cell : 'N/A' }} <br /><b
                                            style="color:rgb(31, 112, 7)">Whatsapp
                                            :</b>{{ $receiver ? $receiver->whatsapp : 'N/A' }}

                                    </td>
                                    <!-- Add other order data columns as needed -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No orders available for this province.</p>
                @endif

            </div>

        </div>
    @endsection
    @push('script')
        <script>
            document.getElementById('startRouteBtn').addEventListener('click', function() {
                // Collect all order numbers
                const orderNumbers = Array.from(document.querySelectorAll('.order-number')).map(el => el.textContent
                    .trim());
                console.log(orderNumbers);
                // Send the order numbers to the server
                // Send the order numbers to the server
                fetch('{{ route('driver.start.route') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            orderNumbers
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            swal.fire({
                                title: 'Success!',
                                text: 'Route started successfully!',
                                icon: 'success',
                                timer: 2000, // Auto close in 2 seconds
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = data.redirectUrl;
                            });
                        } else {
                            swal.fire({
                                title: 'Error!',
                                text: 'Failed to start route.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal.fire({
                            title: 'Error!',
                            text: 'An error occured while starting the route.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    });

            });
        </script>
    @endpush
