<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body,
        p,
        ul,
        li {
            font-size: 14px;
            /* Increased font size for readability */
        }

        .invoice-summary-table td,
        .invoice-summary-table th {
            font-size: 16px;
            /* Larger font size for table text */
        }

        .important-notes-list-1 li,
        .font-weight-bold {
            font-size: 14px;
            /* Increased font size for policy text */
        }
    </style>
    <style>
        .circle-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background-color: #1b9ba0;
            /* You can change the background color */
            color: #f3ebeb;
            /* You can change the icon color */
        }

        .fa-phone {
            margin-left: 3px;
            transform: scaleX(-1);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .form-check-label {
            margin-right: 20px;
        }

        .signature-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature-container {
            width: 45%;
            /* Adjust the width as needed */
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 100%;
            height: 50px;
            /* Adjust the height as needed */
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signature-image {
            max-height: 100%;
            /* Ensure the image fits within the line */
            max-width: 100%;
        }

        .signature-name {
            text-align: center;
            margin-top: 5px;
            font-size: 16px;
        }

        .container-fluid {
            padding: 30px;
        }

        .text-end {
            text-align: right;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .fw-bold {
            font-weight: bold;
        }

        .btn {
            margin-right: 5px;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table td,
        .table th {
            padding: .75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .top-right-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .top-right-buttons button {
            margin-left: 10px;
        }

        .invoice-summary-table td {
            padding: 5px;
        }

        .invoice-summary-table tr.sub-total-row td {
            border-top: none;
        }

        .inv-title-1 {
            color: #4d545a;
        }

        .important-notes-list-1 li {
            margin-bottom: 10px;
            font-size: 12.5px;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        @media print {
            .new-page {
                page-break-before: always;
            }

            .row {
                display: flex;
                justify-content: space-between;
            }

            .col-md-6 {
                flex: 0 0 48%;
                /* Adjust this value if needed */
                max-width: 48%;
            }

            address {
                page-break-inside: avoid;
            }

            .top-right-buttons {
                display: none;
            }


            .col-md-4 {
                flex: 1;
                padding: 10px;

            }



            .text-end {
                text-align: right;
            }

            .table.invoice-summary-table {
                width: 100%;
                border-collapse: collapse;
            }

            .table.invoice-summary-table td,
            .table.invoice-summary-table th {
                padding: 5px;
                vertical-align: top;
                font-size: 14px;
                /* Adjust font size if needed */
            }

            .invoice-summary-table {
                page-break-inside: avoid;
            }

            .sub-total-row,
            .payment-method-row {
                page-break-inside: avoid;
            }

            .invoice-summary-table .sub-total-row td,
            .payment-method-row td {
                padding-top: 2px;
                padding-bottom: 2px;
            }

            .pull-right {
                margin: 0 !important;
                padding: 0 !important;
            }

            .m-t-30 {
                margin-top: 0 !important;
            }

            /* Adjust page size */
            body,
            p,
            ul,
            li {
                font-size: 12px;
                margin: 0;
                padding: 0;
            }
        }


        @media (max-width: 580px) {
            .container-fluid {
                padding: 15px;
            }

            .top-right-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-right-buttons .btn {
                margin: 5px 0;
                width: 100%;
                text-align: center;
            }

            h3,
            h4,
            h5,
            h6,
            .fw-bold {
                font-size: 16px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table thead th,
            .table td,
            .table th {
                font-size: 12px;
                padding: .5rem;
            }

            .text-end {
                text-align: left !important;
            }

            .signature-row {
                flex-direction: column;
                align-items: center;
            }

            .signature-container {
                width: 100%;
                margin-bottom: 10px;
            }

            .signature-line {
                height: 40px;
            }

            .signature-name {
                font-size: 14px;
            }

            .invoice-number.mb-30,
            address {
                margin-bottom: 10px;
            }

            .invoice-logo img {
                height: 50px;
                text-align: center;
            }

            .important-notes-list-1 li {
                font-size: 10px;
            }

            .invoice-summary-table td {
                font-size: 12px;
                padding: 2px;
            }

            .invoice-summary-table h3 {
                font-size: 16px;
            }

            .table-responsive .table {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Top Buttons -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <div class="col-md-12">
                <div class="top-right-buttons">

                    <button class="btn btn-info" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>


                    <button class="btn btn-warning" id="backButton">
                        <i class="fa fa-arrow-left"></i> Back
                    </button>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <div class="col-md-12">
                @foreach ($orders as $index => $orderDetails)
                    <div class="card card-body printableArea @if ($index > 0) new-page @endif">
                        <h3><b>ORDER NUMBER</b> <span class="pull-right"> # {{ $orderDetails->order_number }}</span>
                        </h3>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right ">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <img src="{{ url('/') }}/admin/assets/images/andy.png"
                                                alt="logo" />
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
                                    <h6 class="name"><i class="fa fa-map-marker" style="margin-right: 5px;"></i>57
                                        CHASE
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
                                        </b>{{ \Carbon\Carbon::parse($orderDetails->issue_date)->format('d M Y') }}
                                        <br />

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
                                    <h5>{{ $orderDetails->sender->first_name }} {{ $orderDetails->sender->last_name }}
                                    </h5>
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
                                    <h5>{{ $orderDetails->receiver->first_name }}
                                        {{ $orderDetails->receiver->last_name }}
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Items</th>
                                                <th class="text-end">QTY</th>
                                                <th class="text-end">Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orderDetails->itemDescriptions as $index => $itemDescription)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>{{ $itemDescription->item_des }}</td>
                                                    <td class="text-end">{{ $itemDescription->quantity }}</td>
                                                    <td class="text-end">
                                                        ${{ number_format($itemDescription->price, 2) }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right m-t-30 text-end">
                                    <table class="table invoice-summary-table">
                                        <tr class="sub-total-row">
                                            <td><b>Sub - Total:</b></td>
                                            <td>${{ $orderDetails->total }}</td>
                                        </tr>


                                        <tr class="sub-total-row">
                                            <td><b>Discount:</b></td>
                                            <td>${{ $orderDetails->discount ?? '0.00' }} </td>
                                        </tr>
                                        <tr class="sub-total-row">
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3><b>Grand Total:</b></h3>
                                            </td>
                                            <td>
                                                <h3>${{ $orderDetails->grand_total_amount }}</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Deposit/Value Paid:</b></td>
                                            <td>
                                                <h3 style="color: green">${{ $orderDetails->amount_paid }}</h3>
                                            </td>
                                        </tr>
                                        @php
                                            $total = $orderDetails->grand_total_amount;
                                            $paid = $orderDetails->amount_paid;
                                            $balance = $total - $paid;
                                        @endphp
                                        <tr class="sub-total-row">
                                            <td><b>Balance Due :</b></td>
                                            <td>
                                                <h3 style="color: red">${{ $balance }}</h3>
                                            </td>
                                        </tr>
                                        <tr class="payment-method-row">
                                            <td><b>Payment Methods:</b></td>
                                            <td>Cash
                                                (US)

                                            </td>
                                        </tr>
                                        <tr class="sub-total-row">
                                            <td><b>Payment Location :</b></td>
                                            <td><b>{{ $orderDetails->payment_location }}</b></td>
                                        </tr>

                                        <tr class="sub-total-row">
                                            <td><b>Total packages to be delivered :</b></td>
                                            <td><b>{{ $orderDetails->total_no_packages }}</b></td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                        </div>
                      
                    </div>
                @endforeach
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page Content -->
        <!-- -------------------------------------------------------------- -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ url('/') }}/invoice/assets/js/app.js"></script>
    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>

</html>
