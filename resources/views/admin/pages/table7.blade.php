<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>

                    <th class="border-0 text-muted fw-normal">Order Id #</th>
                    <th class="border-0 text-muted fw-normal">Issue Date</th>
                    <th class="border-0 text-muted fw-normal">Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                    <th class="border-0 text-muted fw-normal">View Invoices</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>

                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $invoice->order_number }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ \Carbon\Carbon::parse($invoice->issue_date)->format('d M Y') }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $invoice->container_number }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $invoice->sender->first_name }} {{ $invoice->sender->last_name }}</h6>
                        </td>
                        <td>

                                <a href="{{ route('driver.invoice.index', ['order_number' => $invoice->order_number]) }}" class="btn btn-primary">View</a>

                        </td>

                        <td>
                            @if ($invoice->package_status == 'PACK')
                                <span class="shipment-badge badge bg-success"
                                    style="background-color: rgb(19, 190, 202)!important">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i class="fas fa-hand-holding fa-stack-1x"></i>
                                        <i class="fas fa-box fa-stack-1x"
                                            style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                                    </span>
                                    PACK
                                </span>
                            @elseif($invoice->package_status == 'SHIP')
                                <span class="shipment-badge badge bg-info px-2 py-2"
                                    style="background-color: rgb(27, 188, 157)!important;">
                                    <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP
                                </span>
                            @elseif($invoice->package_status == 'CUSTOMS')
                                <span class="shipment-badge badge bg-info px-2 py-2">
                                    <i class='fas fa-box' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                </span>
                            @elseif($invoice->package_status == 'CUSTOMS REVIEW')
                                <span class="shipment-badge badge bg-info px-2 py-2">
                                    <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                    REVIEW
                                </span>
                            @elseif($invoice->package_status == 'IN DISTRIBUTION')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(4, 131, 164)!important;">
                                    <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                                    DISTRIBUTION
                                </span>
                            @elseif($invoice->package_status == 'DELIVERED')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(18, 182, 72)!important;">
                                    <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                                </span>

                            @elseif($invoice->package_status == 'order_created')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(150, 206, 18)!important;">
                                    <i class="fas fa-plus-circle" style="margin-right:5px;margin-left:5px;"></i> ORDER CREATED
                                </span>

                            @elseif($invoice->package_status == 'HELD BY CUSTOMS')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(164, 4, 19)!important;">
                                    <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                                </span>
                            @else
                                <span class="shipment-badge badge bg-secondary px-2 py-2">
                                    <i class="fas fa-question-circle" style="margin-right:5px;margin-left:5px;"></i>
                                    UNKNOWN STATUS
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
