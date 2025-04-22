@extends('CustomerDashboard.layout.master')
@section('content')
    <style>
        .title {
            color: rgb(10, 78, 99);
        }
    </style>
    <!-- -------------------------------------------------------------- -->
    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Order overview</h4>
                    </div>
                    <form class="form-horizontal">
                        <div class="form-body">
                            <h3 class="mt-4 mx-2"><b>ORDER NUMBER</b> <span class="pull-right"> #
                                    {{ $orderDetails->order_number }}</span></h3>
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
                            <hr />
                            <div class="row mx-1">
                                <div class="col-sm-3 ">
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
                            <div class="row  d-flex justify-content-between  mx-1">
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
                            <hr />
                            <div class="card-body">
                                <h3 class="card-title mb-0 "style="color:rgb(12, 12, 56)">Items Description</h3>


                            </div>
                            <div class="card-body border-top">
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
                                                    <td>${{ number_format($orderDetails->total, 2) }}</td>
                                                </tr>
                                                {{-- <tr class="sub-total-row">
                                                    <td><b>Tax (6.5%):</b></td>
                                                    <td>$700</td>
                                                </tr> --}}

                                                <tr class="sub-total-row">
                                                    <td><b>Discount:</b></td>
                                                    <td> ${{ number_format($orderDetails->discount, 2) ?? '0.00' }}</td>
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
                                                        <h3> $ {{ number_format($orderDetails->grand_total_amount, 2) }}
                                                        </h3>
                                                    </td>
                                                </tr>
                                                @foreach ($orderDetails->payments as $index => $payment)
                                                    <tr>
                                                        <td><b>Deposit {{ $index + 1 }}:</b></td>
                                                        <td>
                                                            <h3 style="color: green">$
                                                                {{ number_format($payment->deposit, 2) }}</h3>
                                                            @if ($payment->payment_method == 'cash')
                                                                <p style="color: rgb(35, 9, 77); font-weight:600">Cash (US)
                                                                </p>
                                                            @else
                                                                <p style="color: rgb(35, 9, 77); font-weight:600">

                                                                    {{ ucfirst($payment->payment_method) }}</p>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @php
                                                    $total = $orderDetails->grand_total_amount;
                                                    $paid = $orderDetails->amount_paid;
                                                    $balance = $total - $paid;
                                                @endphp
                                                <tr class="sub-total-row">
                                                    <td><b>Balance Due :</b></td>
                                                    <td>
                                                        <h3 style="color: red">${{ number_format($balance, 2) }}</h3>
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
                        </div>


                        <hr />
                        <div class="form-actions">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                {{-- <button type="button" class="btn btn-danger" id="backButton">
                                                    <i class="fa fa-arrow-left"></i> Back
                                                </button> --}}
                                                {{-- <button type="button" class="btn btn-dark">
                                                    Cancel
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- -------------------------------------------------------------- -->
    <!-- End PAge Content -->
    <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- End Container fluid  -->
@endsection
@push('script')

    <script>
        document.getElementById('backButton').addEventListener('click', function() {

            window.history.back();
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif

@endpush
