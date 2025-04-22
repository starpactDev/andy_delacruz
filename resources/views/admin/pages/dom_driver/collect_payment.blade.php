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
                                    <input type="text" class="form-control" value="{{ number_format($balance, 2) }}" aria-label="Username" aria-describedby="basic-addon1" readonly>
                                </div>
                            @endforeach

                            <p><span style="font-weight:600;color:red">BALANCE DUE/PENDING :</span></p>
                            <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1">$</span>
                                <input type="text" class="form-control" id="balanceDue" value="{{ number_format($balance, 2) }}" aria-label="Username" aria-describedby="basic-addon1" readonly>
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
                    <h6>Payment Info</h6>
                    <h5 style="color:rgb(16, 16, 82)">Payment Methods:</h5>
                    {{-- <div class="mb-3 row">
                        <label class="col-sm-3 text-end control-label col-form-label"></label>
                        <div class="col-sm-9">
                            <!-- Cash Payment Method -->
                            <div class="form-check">
                                <input type="radio" id="cash" name="paymentMethod" value="cash"
                                    class="form-check-input">
                                <label class="form-check-label" for="cash">Cash (US)</label>
                            </div>

                            <!-- PayPal Payment Method -->
                            <div class="form-check">
                                <input type="radio" id="paypal" name="paymentMethod" value="paypal"
                                    class="form-check-input">
                                <label for="paypal" class="form-check-label">Paypal</label>
                            </div>

                            <!-- Peso Payment Method -->
                            <div class="form-check">
                                <input type="radio" id="peso" name="paymentMethod" value="peso"
                                    class="form-check-input">
                                <label for="peso" class="form-check-label">Payment in Dominican Republic Peso</label>
                            </div>



                            <!-- Amount Input Section for All Payment Methods -->
                            <div id="amountInputSection" class="mt-2" >
                                <form>
                                    <div class="input-group">
                                        <input type="number" id="amountConfirmationNumber"
                                            name="amountConfirmationNumber" placeholder="Enter Amount"
                                            class="form-control">
                                        <button class="btn btn-light-info text-info font-weight-medium"
                                            type="button">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <style>
                        .payment-box {
                            border: 2px solid #101052;
                            /* Dark Blue Border */
                            padding: 10px;
                            border-radius: 8px;
                            background: #fefeff;
                            /* Light Blue Background */
                        }

                        .form-check-label {
                            font-weight: bold;
                            color: #0b0b72;
                        }
                    </style>
                    <div class="mb-3 row">
                        <label class="col-sm-3 text-end control-label col-form-label"></label>
                        <div class="col-sm-9">
                            <!-- Main Payment Options -->
                            <div class="form-check">
                                <input type="radio" id="paymentDollar" name="mainPaymentMethod" value="dollar"
                                    class="form-check-input" onclick="togglePaymentMethods()">
                                <label class="form-check-label" for="paymentDollar">Payment in Dollar</label>
                            </div>
                            @if(!(Auth::user()->driverInfo->team == 'USA Team'))
                            <div class="form-check mt-2">
                                <input type="radio" id="paymentPeso" name="mainPaymentMethod" value="peso"
                                    class="form-check-input" onclick="togglePaymentMethods()">
                                <label class="form-check-label" for="paymentPeso">Payment in Dominican Republic
                                    Peso</label>
                            </div>
                            @endif
                            <!-- Dollar Payment Methods (Hidden by Default) -->
                            <div id="dollarMethods" class="payment-box mt-3" style="display: none;">
                                <div class="form-check">
                                    <input type="radio" id="cash" name="paymentMethod" value="cash"
                                        class="form-check-input">
                                    <label class="form-check-label" for="cash"><img src="{{ asset('cash.png') }}"
                                            alt="BanReservas Icon" width="40" height="40" class="me-2"> US Dollar in Cash</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="radio" id="paypal" name="paymentMethod" value="paypal"
                                        class="form-check-input">
                                    <label for="paypal" class="form-check-label"><img src="{{ asset('paypal.jpg') }}"
                                            alt="BanReservas Icon" width="40" height="40" class="me-2">
                                        PayPal</label>
                                </div>
                            </div>

                            <!-- Peso Payment Method (Hidden by Default) -->
                            <div id="pesoMethod" class="payment-box mt-3" style="display: none;">
                                <div class="form-check">
                                    <input type="radio" id="peso" name="paymentMethod" value="peso"
                                        class="form-check-input">
                                    <label for="peso" class="form-check-label">
                                        <img src="{{ asset('peso.jpeg') }}" alt="Peso Icon" width="40"
                                            height="40" class="me-2">
                                        Payment in Cash
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="radio" id="bank" name="paymentMethod" value="bank"
                                        class="form-check-input">
                                    <label for="bank" class="form-check-label">
                                        <img src="{{ asset('bank.jpg') }}" alt="BanReservas Icon" width="40"
                                            height="40" class="me-2">
                                        Deposit to BanReservas
                                    </label>
                                </div>
                            </div>


                            <!-- Amount Input Section for All Payment Methods -->
                            <div id="amountInputSection" class="mt-3">
                                <form>
                                    <div class="input-group">
                                        <input type="number" id="amountConfirmationNumber" name="amountConfirmationNumber" placeholder="Enter Amount" class="form-control">
                                        
                                    </div>
                                </form>
                            </div>
                            <div id="confirmationNumberSection" class="mt-3" style="display: none;">
                                <label for="confirmationNumber" class="form-label fw-bold" style="color:#14143a">
                                    Enter Bank Confirmation Number:</label>
                                <input type="text" id="confirmationNumber" name="confirmationNumber" class="form-control" placeholder="Enter confirmation number">
                            </div>
                            <div class="col-md-12 mt-5 d-flex justify-content-center" id="paymentButtonSection">
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="currencyConverterSection" class="mt-4 p-4 border rounded " style="display: block;background-color:rgb(247, 255, 252)">
                                <h3 class="text-center text-info"style="font-weight:600;font-size:25px">CURRENCY CONVERTER</h3>

                                <!-- Date & Exchange Confirmation Row -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div
                                        style="display: flex; align-items: center; font-weight: 600; font-size: 17px; color: rgb(32, 32, 70);">
                                        <span>Current Date:</span>
                                        <span id="currentDate" style="margin-left: 10px; color: blue;"></span>

                                        <span style="margin-left: 50px;">Current Time:</span>
                                        <span id="currentTime" style="margin-left: 10px; color: blue;"></span>
                                    </div>
                                    <div>
                                        <span style="color:green;font-weight:600">EXCHANGE CONFIRMATION:</span>
                                        <span id="exchangeConfirmationNumber" class="text-danger fs-5 fw-bold"></span>
                                    </div>
                                </div>

                                <!-- Currency Converter Table -->
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered text-center align-middle">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>MONEY TYPE</th>
                                                <th>BADGE</th>
                                                <th>TOTAL TO PAY ($)</th>
                                                <th>EXCHANGE RATE</th>
                                                <th>TOTAL TO PAY IN PESO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <!-- Money Type Dropdown -->
                                                <td>
                                                    <select id="moneyType" class="form-select">
                                                        <option value="USD" selected>USA DOLLAR</option>
                                                        {{-- <option value="GBP">UK POUND</option>
                                                        <option value="EUR">EURO</option>
                                                        <option value="CAD">CANADIAN</option> --}}
                                                    </select>
                                                </td>

                                                <!-- Selected Money Type Badge -->
                                                <td>
                                                    <span id="moneyTypeBadge" class="badge bg-primary p-2">USD</span>
                                                </td>

                                                <!-- Amount Input -->
                                                <td>
                                                    <input type="number" id="amount" class="form-control text-center"
                                                        placeholder="Enter Amount" value="{{ number_format($balance, 2) }}">
                                                </td>

                                                <!-- Exchange Rate Display -->
                                                <td>
                                                    <input type="text" id="exchangeRate" class="form-control text-center" readonly>
                                                </td>

                                                <!-- Exchange Amount Display -->
                                                <td>
                                                    <input type="text" id="exchangeAmount" class="form-control text-center"
                                                        style="color:red;font-weight:600" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <label for="pesoToPay" class="form-label fw-bold" style="color:#581111;font-size:21px;">Enter Peso
                                        Amount to Pay Now:</label>
                                    <input type="number" id="pesoToPay" class="form-control text-center"
                                        placeholder="Enter Peso Amount">
                                </div>
                                <div class="text-center mt-4">
                                    <button id="applyExchange" class="btn btn-warning btn-lg px-5 py-3"
                                        style="font-size: 20px; font-weight: 600;">
                                        APPLY CURRENCY EXCHANGE
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5 d-flex justify-content-center">
                            <a href="#">
                                <button type="button" class="btn btn-primary font-weight-medium rounded-pill px-4" id="generateInvoiceBtn">
                                    <div class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-send feather-sm fill-white me-2">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        Submit
                                    </div>
                                </button>
                            </a>
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
                                    <input class="form-control" type="file" id="sender_signature" name="sender_signature">
                                </div>
                                <p><span style="font-weight:500;color:red">Signture of Sender</span> </p>
                            </div>
                        </div> --}}
                </div>
            </div>
            
        </div>
    </div>

    <div class="card">
        
    </div>

@endsection

@push('script')
    <script>
        const paymentButtonSection = document.getElementById('paymentButtonSection');
    </script>
    <script>
        $(document).ready(function() {
            // Function to update current date and time
            function updateDateTime() {
                const now = new Date();
                $('#currentDate').text(now.toLocaleDateString());
                $('#currentTime').text(now.toLocaleTimeString());
            }

            // Function to generate exchange confirmation number
            function generateExchangeNumber() {
                let randomNumber = Math.floor(100000 + Math.random() * 900000);
                return "RD" + randomNumber;
            }

            // Fetch exchange rates from CurrencyFreaks API
            let exchangeRates = {};

            function fetchExchangeRates() {
                let apiKey = "cace516d4b0546abb4c47f6970557145"; // Your API key
                let apiUrl = `https://api.currencyfreaks.com/v2.0/rates/latest?apikey=${apiKey}`;

                $.getJSON(apiUrl, function(data) {
                    if (data && data.rates) {
                        let dopRate = parseFloat(data.rates.DOP); // Get DOP exchange rate

                        if (!isNaN(dopRate)) {
                            let adjustedRate = (dopRate - 1.00).toFixed(2); // Reduce by 1.00 cents

                            exchangeRates = { USD: adjustedRate };

                            console.log("Original DOP Rate:", dopRate);
                            console.log("Adjusted DOP Rate:", adjustedRate);

                            updateExchangeRate(); // Update UI with the new exchange rate
                        } else {
                            console.error("Invalid DOP exchange rate received.");
                        }
                    } else {
                        console.error("Failed to fetch exchange rates.");
                    }
                }).fail(function() {
                    console.error("Error connecting to CurrencyFreaks API.");
                });
            }

            fetchExchangeRates(); // Fetch exchange rates on page load
            // Show/hide sections based on payment method
            $('input[name="paymentMethod"]').on('change', function() {
                paymentButtonSection.innerHTML = ''; // Clear previous buttons
                var selectedPaymentMethod = $(this).val();
                if (selectedPaymentMethod === 'peso') {
                    $('#amountInputSection').hide();
                    $('#confirmationNumberSection').hide();
                    $('#currencyConverterSection').show();
                    updateDateTime();
                    $('#exchangeConfirmationNumber').text(generateExchangeNumber());

                    updateExchangeRate(); // Update exchange rate when Peso is selected
                } else if (selectedPaymentMethod === 'bank') {
                    $('#amountInputSection').hide();
                    $('#currencyConverterSection').hide();
                    $('#confirmationNumberSection').show();
                } else {
                    $('#amountInputSection').show();
                    $('#currencyConverterSection').hide();
                    $('#confirmationNumberSection').hide();
                }
            });

            // Update Money Type Badge & Exchange Rate on Selection
            $('#moneyType').on('change', function() {
                $('#moneyTypeBadge').text($(this).val());
                updateExchangeRate();
            });

            // Function to update exchange rate and calculate exchanged amount
            function updateExchangeRate() {
                let selectedMoneyType = $('#moneyType').val();
                let rate = exchangeRates[selectedMoneyType];

                if (rate) {
                    $('#exchangeRate').val(rate);

                    // Calculate exchanged amount if amount is entered
                    let amount = $('#amount').val();
                    if (amount) {
                        let exchangedAmount = (amount * rate).toFixed(2);
                        $('#exchangeAmount').val(exchangedAmount);
                    } else {
                        $('#exchangeAmount').val('');
                    }
                } else {
                    $('#exchangeRate').val('N/A');
                    $('#exchangeAmount').val('');
                    console.warn(`Exchange rate for ${selectedMoneyType} not found.`);
                }
            }

            // Update exchanged amount on entering amount
            $('#amount').on('input', function() {
                updateExchangeRate();
            });

            // Hide sections initially
            $('#amountInputSection').hide();
            $('#currencyConverterSection').hide();
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
                var exchangeConfirmationNumber = document.getElementById("exchangeConfirmationNumber").innerText.trim();
                var bankConfirmationNumber = $('#confirmationNumber').val(); // Fetch the confirmation number

                // If the user selects "Deposit to BanReservas" but doesn't enter a confirmation number
                if (paymentMethod === 'bank' && (bankConfirmationNumber === '' || bankConfirmationNumber.length < 6)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Confirmation Required',
                        text: 'Please enter a valid bank confirmation number before proceeding.',
                    });
                    return;
                }

                // If "Deposit to BanReservas" is selected and a confirmation number is given
                if (paymentMethod === 'bank') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Confirmation Noted',
                        text: 'Your confirmation number is noted. Our administrator will verify it, and once confirmed, it will appear on your invoice.',
                    }).then(() => {
                        location.reload(); // Refresh the page after closing the alert
                    });

                    return; // Stop further execution (No AJAX call needed since admin approval is required)
                }

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
                    url: '{{ route('driver.store_payment_new') }}',
                    type: 'GET',
                    data: {
                        amount: amount,
                        order_pickup_id: '{{ $orderDetails->id }}',
                        payment_method: paymentMethod,
                        exchangeConfirmationNumber: exchangeConfirmationNumber,
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
                                    '{{ route('driver.driver_order_overview', ':id') }}'
                                    .replace(
                                        ':id', '{{ $orderDetails->id }}'
                                    );
                            });
                        } else if (paymentMethod === 'peso') {
                            Swal.fire(
                                'Success!',
                                response.message,
                                'success'
                            ).then(function() {
                                window.location.href =
                                    '{{ route('driver.driver_order_overview', ':id') }}'
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

    <script>
        document.getElementById("applyExchange").addEventListener("click", async function () {
            let pesoToPay = parseFloat(document.getElementById("pesoToPay").value);
            let exchangeAmount = parseFloat(document.getElementById("exchangeAmount").value);
            let exchangeConfirmationNumber = document.getElementById("exchangeConfirmationNumber").innerText.trim();

            if (isNaN(pesoToPay) || isNaN(exchangeAmount)) {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Input",
                    text: "Please enter valid amounts before applying the exchange."
                });
                return;
            }

            if (pesoToPay > exchangeAmount) {
                Swal.fire({
                    icon: "error",
                    title: "Overpayment Detected!",
                    text: "The amount you are paying exceeds the required exchange amount.",
                    confirmButtonText: "OK"
                });
                return;
            }

            // Fetch the latest exchange rate for DOP to USD
            let exchangeRate = await getExchangeRate();

            if (!exchangeRate) {
                Swal.fire({
                    icon: "error",
                    title: "Exchange Rate Error",
                    text: "Failed to fetch exchange rate. Please try again later.",
                });
                return;
            }

            console.log("Exchange Rate Retrieved:", exchangeRate); // Debugging

            // Adjust pesoToPay by subtracting 1.0
            let adjustedPesoToPay = pesoToPay - 1.0;

            // Convert adjustedPesoToPay to USD
            let convertedAmount = adjustedPesoToPay * exchangeRate;

            // Round properly to avoid mismatch
            let displayAmount = Math.round(convertedAmount * 100) / 100; // Round to 2 decimal places
            let finalDisplayAmount = Math.ceil(displayAmount); // Ensure rounding up to the nearest dollar

            console.log(`Adjusted Peso: ${adjustedPesoToPay}, Converted to USD: ${displayAmount}, Final Display Amount: ${finalDisplayAmount}`);

            // Ensure no overpayment error by checking against the expected USD amount
            if (finalDisplayAmount > Math.ceil(exchangeAmount * exchangeRate)) {
                Swal.fire({
                    icon: "error",
                    title: "Overpayment Error!",
                    text: "The converted amount in USD cannot exceed the required exchange amount.",
                    confirmButtonText: "OK"
                });
                return;
            }

            // Set the adjusted converted USD value
            document.getElementById("amountConfirmationNumber").value = finalDisplayAmount;

            // Show success message
            Swal.fire({
                icon: "success",
                title: "Exchange Applied Successfully!",
                html: `<p>Your exchange confirmation number is: <strong class="text-danger">${exchangeConfirmationNumber}</strong></p>
                    <p>Converted Amount in USD: <strong class="text-primary">$${finalDisplayAmount}</strong></p>
                    <p>Now, click on the <strong>Submit </strong> button to continue the payment, in above.</p>`,
                confirmButtonText: "OK",
            });
        });

        async function getExchangeRate() {
            try {
                let response = await fetch("https://api.currencyfreaks.com/v2.0/rates/latest?apikey=cace516d4b0546abb4c47f6970557145");
                let data = await response.json();

                console.log("Full API Response:", data); // Debugging

                let dopRate = data.rates["DOP"]; // Get DOP exchange rate
                if (!dopRate) {
                    throw new Error("DOP rate not found in API response.");
                }

                let exchangeRate = (1 / dopRate).toFixed(6); // Convert to USD per DOP
                console.log("Adjusted DOP to USD Rate:", exchangeRate);

                return parseFloat(exchangeRate);
            } catch (error) {
                console.error("Error fetching exchange rate:", error);
                return null;
            }
        }
    </script>
    <script>
        function togglePaymentMethods() {
            var dollarMethods = document.getElementById("dollarMethods");
            var pesoMethod = document.getElementById("pesoMethod");

            paymentButtonSection.innerHTML = ''; // Clear previous buttons
            if (document.getElementById("paymentDollar").checked) {
                dollarMethods.style.display = "block";
                pesoMethod.style.display = "none";
            } else if (document.getElementById("paymentPeso").checked) {
                dollarMethods.style.display = "none";
                pesoMethod.style.display = "block";
            }
        }
    </script>
@endpush
