<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>

                    <th class="border-0 text-muted fw-normal">Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">View Orders</th>

                    <th class="border-0 text-muted fw-normal">Due Amount</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dueOrders as $order)
                    <tr>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                        </td>

                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->container_number }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0"> {{ $order->sender->first_name ?? '' }}
                                {{ $order->sender->last_name ?? '' }}</h6>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                                data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                data-order-pickup-id="{{ $order->id }}">
                                <i data-feather="dollar-sign" class="feather-sm"></i> View
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                                onclick="window.location.href='{{ route('driver.driver_order_overview', $order->id) }}'">
                                <i data-feather="package" class="feather-sm"></i> View
                            </button>
                        </td>
                        <td>
                            <span class="paid-badge badge bg-danger px-2 py-2">
                                ${{ number_format($order->grand_total_amount - $order->amount_paid, 2) }}
                            </span>
                        </td>

                        <td>
                            @if ($order->package_status == 'PACK')
                                <span class="shipment-badge badge bg-success"
                                    style="background-color: rgb(19, 190, 202)!important">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i class="fas fa-hand-holding fa-stack-1x"></i>
                                        <i class="fas fa-box fa-stack-1x"
                                            style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                                    </span>
                                    PACK
                                </span>
                            @elseif($order->package_status == 'SHIP')
                                <span class="shipment-badge badge bg-info px-2 py-2"
                                    style="background-color: rgb(27, 188, 157)!important;">
                                    <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP
                                </span>
                            @elseif($order->package_status == 'CUSTOMS')
                                <span class="shipment-badge badge bg-info px-2 py-2">
                                    <i class='fas fa-box' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                </span>
                            @elseif($order->package_status == 'CUSTOMS REVIEW')
                                <span class="shipment-badge badge bg-info px-2 py-2">
                                    <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS REVIEW
                                </span>
                            @elseif($order->package_status == 'IN DISTRIBUTION')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(4, 131, 164)!important;">
                                    <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                                    DISTRIBUTION
                                </span>
                            @elseif($order->package_status == 'HELD BY CUSTOMS')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(164, 4, 19)!important;">
                                    <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY
                                    CUSTOMS
                                </span>
                            @elseif($order->package_status == 'DELIVERED')
                                <span class="shipment-badge badge bg-success px-2 py-2"
                                    style="background-color: rgb(18, 182, 72)!important;">
                                    <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                                </span>
                            @else
                                <span class="shipment-badge badge bg-secondary px-2 py-2"
                                    style="background-color: rgb(104, 21, 104)!important;">
                                    ORDER CREATED
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No due orders found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
