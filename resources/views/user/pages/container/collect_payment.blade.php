@extends('admin.layouts.master')
@section('content')
    <style>
        .hidden {
            display: none;
        }

        .scrollable-container {
            max-height: 370px;
            /* Adjust height as needed */
            overflow-y: auto;
            /* Enable vertical scrollbar if content overflows */
            border: 1px solid #e40e0e;
            /* Optional: Adds a border for better visibility */
            padding: 10px;
            /* Optional: Adds some padding inside the container */
        }


        .center-aligned {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
    </style>


    <div class="container-fluid">



        <div class="card">
            <div class="card-body">
                <h3><b>ORDER NUMBER</b> <span class="pull-right"> # {{ $orderDetails->order_number }}</span></h3>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right ">
                            <div class="invoice-logo">
                                <!-- logo started -->
                                <div class="logo">
                                    <img src="{{ url('/') }}/admin/assets/images/andy.png" alt="logo" />
                                </div>
                                <!-- logo ended -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="invoice-number mb-30">
                            <h4 class="inv-title-1">Address 1</h4>
                            <h6 class="name"><i class="fa fa-map-marker" style="margin-right: 5px;"></i>3115
                                WASHINGTON STREET</h6>
                            <p class="invo-addr-1 mt-10">
                                ROXBURY, MA. 02130 <br />
                                617-477-9072 <br />
                                781-439-2046<br />
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="invoice-number mb-30">
                            <h4 class="inv-title-1">Address 2</h4>
                            <h6 class="name"><i class="fa fa-map-marker" style="margin-right: 5px;"></i>57 CHASE
                                STREET</h6>
                            <p class="invo-addr-1 mt-10">
                                METHUEN, MA 01844 <br />
                                978-258-0238 <br />
                                978-258-0154<br />
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="invoice-number mb-30">
                            <h4 class="inv-title-1">Address 3</h4>
                            <h6 class="name"><i class="fa fa-map-marker" style="margin-right: 5px;"></i>BANI,
                                DOMINICAN REPUBLIC</h6>
                            <p class="invo-addr-1 mt-10">
                                ANA PRAVIA STREET # 99 PERAVIA <br />
                                809-522-3648 <br />
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <address>
                            <h4 class="fw-bold" style="color:#4d545a">Invoice:</h4>
                            <p>
                                <b>Order Number #: <br></b>{{ $orderDetails->order_number }}<br />
                                <b>Issue Date:
                                </b>{{ \Carbon\Carbon::parse($orderDetails->issue_date)->format('d M Y') }} <br />

                                <b>Container ID: </b>{{ $orderDetails->container_number }} <br />
                                <b>Driver Name: </b>{{ $orderDetails->driver_pickup_name }}
                            </p>
                        </address>
                    </div>
                </div>
                <hr />
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-6" style=" padding-right: 10px;">
                        <address>
                            <h4 class="fw-bold">Sender:</h4>
                            <h5>{{ $orderDetails->sender->first_name }} {{ $orderDetails->sender->last_name }}</h5>
                            <p class="text-muted">
                                <b>Email:&nbsp;</b>{{ $orderDetails->sender->email }} <br />
                                <b>Tel:&nbsp;</b>{{ $orderDetails->sender->telephone }} <br />
                                <b>Cell:&nbsp;</b>{{ $orderDetails->sender->cell }} <br />
                                <b>Address:&nbsp;</b>{{ $orderDetails->sender->street_address }}
                                {{ $orderDetails->sender->apt }} <br />
                                <b>City:&nbsp;</b>{{ $orderDetails->sender->city }} <br />
                                <b>State:&nbsp;</b>{{ $orderDetails->sender->state }} <br />
                                <b>Zip:&nbsp;</b>{{ $orderDetails->sender->zip }} <br />
                            </p>
                        </address>
                    </div>
                    <div class="col-md-6 " style=" padding-right: 10px;">
                        <address>
                            <h4 class="fw-bold">Receiver:</h4>
                            <h5>{{ $orderDetails->receiver->first_name }} {{ $orderDetails->receiver->last_name }}
                            </h5>
                            <p class="text-muted">
                                <b>Email:&nbsp;</b>{{ $orderDetails->receiver->email }} <br />
                                <b>Tel:&nbsp;</b>{{ $orderDetails->receiver->telephone }} <br />
                                <b>Cell:&nbsp;</b>{{ $orderDetails->receiver->cell }} <br />
                                <b>WhatsApp:&nbsp;</b>{{ $orderDetails->receiver->whatsapp }} <br />
                                <b>Address:&nbsp;</b>{{ $orderDetails->receiver->address }} <br />
                                <b>Neighbourhood:&nbsp;</b>{{ $orderDetails->receiver->neighborhood }} <br />
                                <b>City:&nbsp;</b>{{ $orderDetails->receiver->city }} <br />
                                <b>Province:&nbsp;</b>{{ $orderDetails->receiver->province }} <br />
                            </p>
                        </address>
                    </div>
                    {{-- <div class="col-md-4 text-end" style="padding-left: 20px;">
                        <address>
                            <h4 class="fw-bold">Payment Method:</h4>
                            <p class="text-muted">
                                BANK DEPOSIT <br />
                                SANTANDER BANK <br />
                                #8151041390<br />
                                <hr />
                                <b>Payment Location :</b> Dom Rep<br />
                                <b>Total packages to be delivered :</b> 4<br />
                            </p>
                        </address>
                    </div> --}}
                </div>
                <div class="row mt-5">

                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both">
                            <table class="table   table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center"># Quantity</th>
                                        <th class="text-center">Item Description</th>
                                        <th class="text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderDetails->itemDescriptions as $index => $itemDescription)
                                        <tr>
                                            <td class="text-center">{{ $itemDescription->quantity }}</td>
                                            <td class="text-center">{{ $itemDescription->item_des }}</td>
                                            <td class="text-center">${{ number_format($itemDescription->price, 2) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php
                        $total = $orderDetails->grand_total_amount;
                        $paid = $orderDetails->amount_paid;
                        $balance = $total - $paid;
                    @endphp
                    <div class="col-md-6" style="padding: 44px;">
                        <div class="pull-right m-t-30 text-start">
                            @foreach ($orderDetails->payments as $index => $payment)
                                <p><span style="font-weight:600;color:rgb(10, 161, 5)">DEPOSIT {{ $index + 1 }} :</span>
                                </p>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input type="text" class="form-control" value="{{ number_format($balance, 2) }}"
                                        aria-label="Username" aria-describedby="basic-addon1" readonly>
                                </div>
                            @endforeach

                            <p><span style="font-weight:600;color:red">BALANCE DUE/PENDING :</span></p>
                            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="text" class="form-control" id ="balanceDue"
                                    value="{{ number_format($balance, 2) }}" aria-label="Username"
                                    aria-describedby="basic-addon1" readonly>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-6 " style="padding: 44px;">
                        <div class="center-aligned pull-right m-t-30 text-end">
                            <p><span style="font-weight:600;color:rgb(52, 29, 182)">Sub - Total :</span> <b>$
                                    {{ number_format($orderDetails->total, 2) }} </b></p>
                            <p><span style="font-weight:600;color:red">Discount :</span><b>
                                    ${{ number_format($orderDetails->discount, 2) ?? '0.00' }}</b></p>

                            <hr />
                            <h3><span style="font-weight:600;color:rgb(12, 7, 75)"><b>Total :</span></b>
                                $ {{ number_format($orderDetails->grand_total_amount, 2) }}</h3>
                            @foreach ($orderDetails->payments as $index => $payment)
                                <p><span style="font-weight:600;color:rgb(13, 161, 13)">Deposit {{ $index + 1 }}
                                        :</span><b> $
                                        {{ number_format($payment->deposit, 2) }}
                                    </b></p>
                            @endforeach

                            <p><span style="font-weight:600;color:red">Balance Due :</span><b>
                                    ${{ number_format($balance, 2) }}</b></p>
                        </div>
                    </div>
                    <h6>Payment Info </h6>

                    <h5 style="color:rgb(16, 16, 82)">Payment Methods:</h5>
                    <div class="mb-3 row">
                        <label class="col-sm-3 text-end control-label col-form-label"></label>
                        <div class="col-sm-9">
                            <!-- Cash Payment Method -->
                            <div class="form-check">
                                <input type="radio" id="cash" name="paymentMethod" value="cash" class="form-check-input">
                                <label class="form-check-label" for="cash">Cash (US)</label>
                            </div>

                            <!-- PayPal Payment Method -->
                            <div class="form-check">
                                <input type="radio" id="paypal" name="paymentMethod" value="paypal" class="form-check-input">
                                <label for="paypal" class="form-check-label">Paypal</label>
                            </div>

                          

                            <!-- Amount Input Section for All Payment Methods -->
                            <div id="amountInputSection" class="mt-2" style="display: none;">
                                <form>
                                    <div class="input-group">
                                        <input type="number" id="amountConfirmationNumber" name="amountConfirmationNumber" placeholder="Enter Amount" class="form-control">
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-12 mt-5 d-flex justify-content-center border" id="paymentButtonSection">
                        </div>
                    </div>
                    {{-- <h5 style="color:rgb(16, 16, 82)">Payment Location:</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="paymentLocation">Note: Will the packages be paid for in:</label>
                                <select id="paymentLocation" name="paymentLocation" class="form-control">
                                    <option value="USA">USA</option>
                                    <option value="DomRep">Dom Rep</option>
                                </select>
                            </div>
                        </div> --}}
                    {{-- <div class="col-md-12 mt-5">
                                    <div class="pull-right m-t-30 text-start">
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="file" id="sender_signature"
                                                name="sender_signature">
                                        </div>
                                        <p><span style="font-weight:500;color:red">Signture of Sender</span> </p>




                                    </div>
                                </div> --}}
                </div>
            </div>



        </div>






        <div class="card">
            <div class="card-body">
                <div class="row mt-5">



                    <div class="col-md-12 ">

                    </div>
                    <div class="col-md-12 mt-5 d-flex justify-content-center mb-5">
                        <a href="#">
                            <button type="button" class="btn btn-primary font-weight-medium rounded-pill px-4"
                                id="generateInvoiceBtn">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-send feather-sm fill-white me-2">
                                        <line x1="22" y1="2" x2="11" y2="13"></line>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                    </svg>
                                    Update Invoice
                                </div>
                            </button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            
            // Handle showing the amount input section when a payment method is selected
            $('input[name="paymentMethod"]').on('change', function() {
                paymentButtonSection.innerHTML = ''; // Clear previous buttons
                var selectedPaymentMethod = $(this).val(); // Get selected payment method

                // Show the amount input field for all payment methods
                $('#amountInputSection').show(); // Show the amount input field

                // You can also add custom logic if you want to handle special cases for some payment methods
                // For example, if you don't want to show the amount input for "Pay Later" method:
                // if (selectedPaymentMethod === 'payLater') {
                //     $('#amountInputSection').hide(); // Hide the amount input field for "Pay Later"
                // }
            });

            // Optionally, you can hide the amount input field when the page loads (in case no payment method is selected yet)
            $('#amountInputSection').hide();
        });
    </script>



    <script>
        $(document).ready(function() {
            // When the "Generate Invoice" button is clicked
            $('#generateInvoiceBtn').click(function(e) {
                e.preventDefault();
                const balanceDue = parseFloat($('#balanceDue').val().replace(/,/g, ''));

                var paymentMethod = $('input[name="paymentMethod"]:checked').val();
                var amount = $('#amountConfirmationNumber').val();

                if (amount === '' || amount <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please enter a valid amount greater than 0.',
                    });
                    return;
                }
                if (amount > balanceDue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Excess Payment',
                        text: 'You need to pay only the amount due. Please enter a valid amount.',
                    });
                    return;
                }
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we process the payment.',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route('user.store_payment_new') }}',
                    type: 'GET',
                    data: {
                        amount: amount,
                        order_pickup_id: '{{ $orderDetails->id }}',
                        payment_method: paymentMethod,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (paymentMethod === 'cash') {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(function() {
                                window.location.href =
                                    '{{ route('user.order_overview', ':id') }}'
                                    .replace(
                                        ':id', '{{ $orderDetails->id }}'
                                    );
                            });
                        } else if (response.approval_url) {
                            Swal.fire({
                                title: 'Payment Approval',
                                text: 'How would you like to proceed?',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonText: 'Proceed to PayPal',
                                cancelButtonText: 'Share Paypal Payment Link',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = response.approval_url; // Redirect to PayPal
                                } else {
                                    showOptionToShare(response.approval_url); // Execute sharing function
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'There was an issue with processing the payment.',
                            'error'
                        );
                    }
                });
            });
        });

        function showOptionToShare(payPalUrl){
            

            // Define the email and link
            const subject = 'Embarque Paton Gomez - Payment Link';
            const body = `Dear Customer,\n\nYou have received a PayPal payment link. Please sign in to your account.\n\nThanks for doing business with us!\n${payPalUrl}`;
            const gmailUrl = `https://mail.google.com/mail/?view=cm&fs=1&tf=1&su=${subject}&body=${encodeURIComponent(body)}`;

            // Define the whatsapp message and link
            const message = `Dear Customer,\n\nYou have received a PayPal payment link. Please sign in to your account.\n\nThanks for doing business with us!\n${payPalUrl}`;
            const encodedMessage = encodeURIComponent(message);

            // Create SMS URL (for mobile devices, the SMS app will open)
            const smsUrl = `sms:?body=${encodedMessage}`;

            paymentButtonSection.innerHTML = `
                <div class="d-flex justify-content-center my-4">
                    <a href="${gmailUrl}" target="_blank" class="btn btn-success font-weight-medium rounded-pill px-4 me-3">Share PayPal Link via Email</a>
                    <a href="https://wa.me/?text=${encodedMessage}" target="_blank" class="btn btn-success font-weight-medium rounded-pill px-4 me-3">Share PayPal Link via WhatsApp</a>
                    <a href="${smsUrl}" target="_blank" class="btn btn-success font-weight-medium rounded-pill px-4 me-3">Share PayPal Link via SMS</a>
                </div>
            `;
        }
    </script>
@endpush
