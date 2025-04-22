@extends('admin.layouts.master')
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
                            <div class="row">
                                <div class="col-sm-3 text-end ms-auto" style="margin-right:20px; margin-top:20px;">
                                    <address>
                                        <h4 class="fw-bold" style="color:rgb(12, 12, 56)">Invoice Details:</h4>
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
                            <div class="card-body">
                                <h4 class="card-title mb-0" style="color:rgb(12, 12, 56)">Sender Info</h4>
                            </div>
                            <div class="card-body border-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">First
                                                Name:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->sender->first_name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">Last
                                                Name:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->sender->last_name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Email:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->email ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">Street
                                                Address:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->sender->street_address ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">Apt
                                                #:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->apt ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">City:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->city ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">State:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->state ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">ZIP:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->zip ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Tel:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->sender->telephone ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Cell:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->sender->cell ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>

                            <div class="card-body">
                                <h3 class="card-title mb-0 "style="color:rgb(12, 12, 56)">Recipient Details</h3>


                            </div>
                            <div class="card-body border-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">First
                                                Name:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->first_name }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">Last
                                                Name:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->last_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label class="control-label text-end col-md-4 font-weight-medium title">Second
                                                Last
                                                Name:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->receiver->second_last_name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Nickname:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->receiver->nickname ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Email:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->email }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Address:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->address }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Neighborhood:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->neighborhood }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">City:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->city }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Province:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">{{ $orderDetails->receiver->province }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Reference:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">
                                                    {{ $orderDetails->receiver->reference ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Tel:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">(123) 456-7890</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">Cell:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">(987) 654-3210</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-4">
                                        <div class="form-group row py-3">
                                            <label
                                                class="control-label text-end col-md-4 font-weight-medium title">WhatsApp:</label>
                                            <div class="col-md-8">
                                                <p class="form-control-static">(555) 123-4567</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            </div>
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
