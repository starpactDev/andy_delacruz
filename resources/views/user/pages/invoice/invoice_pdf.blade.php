<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 15px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
        }

        .pull-right {
            float: right;
        }

        .clearfix {
            clear: both;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        h3, h4, h5, p {
            margin: 5px 0;
            line-height: 1.2;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }

        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .table.invoice-summary-table td {
            border: none;
            padding: 5px 10px;
        }

        .sub-total-row {
            border-top: 1px solid #ddd;
        }

        .fw-bold {
            font-weight: bold;
        }

        .logo img {
            max-width: 200px;
            height: auto;
        }

        .invoice-number, .invoice-summary-table {
            margin-bottom: 10px;
        }

        .address-row {
            display: flex;
            justify-content: space-between;
        }

        .address-row > div {
            flex: 1;
            margin-right: 10px;
        }

        .address-row > div:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="card card-body printableArea" id="invoice_content">
            <h3><b>ORDER NUMBER</b> <span class="pull-right"># {{ $orderDetails->order_number }}</span></h3>
            <hr />

            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <div class="logo">
                            <img src="{{ $imageSrc }}" alt="logo" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row address-row">
                <div>
                    <h4>Address 1</h4>
                    <p>3115 WASHINGTON STREET<br>ROXBURY, MA. 02130<br>617-477-9072<br>781-439-2046</p>
                </div>
                <div>
                    <h4>Address 2</h4>
                    <p>57 CHASE STREET<br>METHUEN, MA 01844<br>978-258-0238<br>978-258-0154</p>
                </div>
                <div>
                    <h4>Address 3</h4>
                    <p>BANI, DOMINICAN REPUBLIC<br>ANA PRAVIA STREET # 99 PERAVIA<br>809-522-3648</p>
                </div>
                <div>
                    <h4>Invoice:</h4>
                    <p><b>Order Number:</b> {{ $orderDetails->order_number }}<br>
                       <b>Issue Date:</b> {{ \Carbon\Carbon::parse($orderDetails->issue_date)->format('d M Y') }}<br>
                       <b>Container ID:</b> {{ $orderDetails->container_number }}<br>
                       <b>Driver Name:</b> {{ $orderDetails->driver_pickup_name }}</p>
                </div>
            </div>

            <hr />

            <div class="row">
                <div class="col-md-6">
                    <h4>Sender:</h4>
                    <p><b>{{ $orderDetails->sender->first_name }} {{ $orderDetails->sender->last_name }}</b><br>
                       <b>Email:</b> {{ $orderDetails->sender->email }}<br>
                       <b>Tel:</b> {{ $orderDetails->sender->telephone }}<br>
                       <b>Address:</b> {{ $orderDetails->sender->street_address }} {{ $orderDetails->sender->apt }}<br>
                       <b>City:</b> {{ $orderDetails->sender->city }}, {{ $orderDetails->sender->state }} {{ $orderDetails->sender->zip }}</p>
                </div>
                <div class="col-md-6">
                    <h4>Receiver:</h4>
                    <p><b>{{ $orderDetails->receiver->first_name }} {{ $orderDetails->receiver->last_name }}</b><br>
                       <b>Email:</b> {{ $orderDetails->receiver->email }}<br>
                       <b>Tel:</b> {{ $orderDetails->receiver->telephone }}<br>
                       <b>Address:</b> {{ $orderDetails->receiver->address }}<br>
                       <b>City:</b> {{ $orderDetails->receiver->city }}, {{ $orderDetails->receiver->province }}</p>
                </div>
            </div>

            <hr />

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Items</th>
                        <th class="text-end">QTY</th>
                        <th class="text-end">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails->itemDescriptions as $index => $itemDescription)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $itemDescription->item_des }}</td>
                            <td class="text-end">{{ $itemDescription->quantity }}</td>
                            <td class="text-end">${{ number_format($itemDescription->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="table invoice-summary-table">
                <tr>
                    <td><b>Sub-Total:</b></td>
                    <td>${{ $orderDetails->total }}</td>
                </tr>
                @foreach ($deposits as $key => $deposit)

                <tr>
                    <td><b>Deposit {{ $key + 1 }}:</b></td>
                    <td>${{ $deposit['amount'] }} 

                        @if ($deposit['method'] == 'cash')
                        <p style="color: rgb(35, 9, 77); font-weight:600">Cash (US)</p>
                        @else
                        <p style="color: rgb(35, 9, 77); font-weight:600">

                            {{ ucfirst($deposit['method']) }}</p>
                    @endif

                    </td>
                </tr>
            @endforeach

                <tr>
                    <td><b>Grand Total:</b></td>
                    <td>${{ $orderDetails->grand_total_amount }}</td>
                </tr>
                @php
                $total = $orderDetails->grand_total_amount;
                $paid = $orderDetails->amount_paid;
                $balance = $total - $paid;
            @endphp
                <tr>
                    <td><b>Total Value Paid:</b></td>
                    <td>${{ $orderDetails->amount_paid }}</td>
                </tr>
                <tr>
                    <td><b>Balance Due:</b></td>
                    <td>${{ $balance }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
