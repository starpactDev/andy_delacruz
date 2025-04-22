<style>
    /* General Styles for Square Elements */
    .square-badge,
    .square-button {
        width: 100px;
        /* Adjust size */
        height: 100px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        border-radius: 10%;
        /* Optional: For slight rounding */
    }

    /* Icon Styles */
    .square-badge i,
    .square-button i {
        font-size: 20px;
        /* Adjust icon size */
        margin-bottom: 5px;
        /* Spacing between icon and text */
    }

    /* Text Styles */
    .square-badge span,
    .square-button span {
        font-size: 14px;
        font-weight: bold;
        display: block;
        text-align: center;
        line-height: 1.2;
    }

    /* Colors */
    .bg-success {
        background-color: rgb(18, 182, 72) !important;
        color: white;
    }

    .bg-info {
        background-color: rgb(27, 188, 157) !important;
        color: white;
    }

    .bg-secondary {
        background-color: gray !important;
        color: white;
    }
</style>

<div class="month-table">
    <div class="table-responsive mt-3">
        <div class="d-flex justify-content-end mb-3">
            <div class="mt-2 ">
                <button class="select-all-button btn btn-info" data-province="{{ $province }}">Select All UnAssigned Orders  under <b>{{ $province }}</b> to assign a RD Driver</button>
            </div>


        </div>
        <!-- Instruction Note -->



        <table id="table_{{ $provinceId }}" class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <style>
                td b.tablesaw-cell-label {
                    display: none;
                }
            </style>

            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal"> </th>
                    <th class="border-0 text-muted fw-normal">Order Id</th>
                    <th class="border-0 text-muted fw-normal">Container Number</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                    <th class="border-0 text-muted fw-normal">Recipient Details</th>
                    <th class="border-0 text-muted fw-normal">Assigned To</th>


                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">View Orders</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                    <th class="border-0 text-muted fw-normal">Note</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr data-driver="{{ $order->assignedOrderToDriver->driver->name ?? '' }}">
                        <td>
                            <input type="checkbox" name="order_ids[]" value="{{ $order->order_number }}"
                                class="order-checkbox"
                                data-driver="{{ $order->assignedOrderToDriver->driver->name ?? '' }}">
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                        </td>


                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->container_number }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0"> {{ $order->sender->first_name ?? 'N/A' }}
                                {{ $order->sender->last_name ?? 'N/A' }}</h6>
                        </td>

                        <td>
                            <h6 class="font-weight-medium mb-0">
                                {{ $order->receiver->first_name ?? 'N/A' }}
                                {{ $order->receiver->last_name ?? 'N/A' }}
                            </h6>

                            <div class="text-muted">
                                <i class="text-dark me-1" aria-hidden="true">PROVINCE :</i>
                                {{ $order->receiver->province ?? '' }}
                            </div>

                            <div class="text-muted">
                                <i class="text-dark me-1" aria-hidden="true">CITY :</i>
                                {{ $order->receiver->city ?? '' }}
                            </div>

                            <div class="text-muted">
                                <i class="text-dark me-1" aria-hidden="true">ADDRESS :</i>
                                {{ $order->receiver->address ?? '' }}
                            </div>

                            <div class="text-muted">
                                <i class="text-dark me-1" aria-hidden="true">TEL :</i>
                                {{ $order->receiver->telephone ?? '' }}
                            </div>

                            <div class="text-muted">
                                <i class="text-dark me-1" aria-hidden="true">WHATSAPP :</i>
                                {{ $order->receiver->whatsapp ?? '' }}
                            </div>
                        </td>
                        <style>
                            .not-assigned-box {
                                display: inline-block;
                                background-color: #ff4d4f;
                                /* Red background */
                                color: #fff;
                                /* White text */
                                padding: 5px 10px;
                                /* Adjust padding for box size */
                                font-size: 0.9rem;
                                /* Adjust text size */
                                text-align: center;
                                /* Center text */
                                border-radius: 4px;
                                /* Optional: Rounded corners */
                                width: 150px;
                                /* Set consistent width */
                                height: 30px;
                                /* Set consistent height */
                                line-height: 20px;
                                /* Center text vertically */
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                /* Optional: Add shadow */
                            }
                        </style>
                        <td>
                            <h6 class="font-weight-medium mb-0">
                                @if (!empty($order->assignedOrderToDriver->driver->name))
                                    {{ $order->assignedOrderToDriver->driver->name }}
                                @else
                                    <span class="not-assigned-box">Not Assigned</span>
                                @endif
                            </h6>
                        </td>
                        <td>
                            <button type="button"
                                class="btn btn-sm btn-light-success square-button text-primary custom-size"
                                data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                data-order-pickup-id="{{ $order->id }}">
                                <i data-feather="dollar-sign" class="feather-sm"></i> <span>View</span>
                            </button>
                        </td>
                        <td>
                            <button type="button"
                                class="btn btn-sm btn-light-warning square-button text-dark custom-size"
                                onclick="window.location.href='{{ route('user.order_overview', ['order_pickup_id' => $order->id]) }}'">
                                <i data-feather="package" class="feather-sm"></i> <span>View</span>
                            </button>
                        </td>

                        <td>
                            @if ($order->package_status == 'PACK')
                                <span class="shipment-badge badge square-badge bg-success"
                                    style="background-color: rgb(19, 190, 202)!important">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i class="fas fa-hand-holding fa-stack-1x"></i>
                                        <i class="fas fa-box fa-stack-1x"
                                            style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                                    </span>
                                    PACK
                                </span>
                            @elseif($order->package_status == 'SHIP')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2"
                                    style="background-color: rgb(27, 188, 157)!important;">
                                    <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP
                                </span>
                            @elseif($order->package_status == 'CUSTOMS')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                    <i class='fas fa-box' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                </span>
                            @elseif($order->package_status == 'CUSTOMS REVIEW')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                    <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                    REVIEW
                                </span>
                            @elseif($order->package_status == 'IN DISTRIBUTION')
                                <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                    style="background-color: rgb(4, 131, 164)!important;">
                                    <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                                    DISTRIBUTION
                                </span>

                            @elseif($order->package_status == 'HELD BY CUSTOMS')
                            <span class="shipment-badge badge bg-success px-2 py-2"
                                style="background-color: rgb(164, 4, 19)!important;">
                                <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                            </span>
                            @elseif($order->package_status == 'DELIVERED')
                                <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                    style="background-color: rgb(18, 182, 72)!important;">
                                    <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                                </span>
                            @elseif($order->package_status == 'order_created')
                                <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                    style="background-color: rgb(150, 206, 18)!important;">
                                    <i class="fas fa-plus-circle" style="margin-right:5px;margin-left:5px;"></i> ORDER
                                    CREATED
                                </span>
                            @else
                                <span class="shipment-badge badge square-badge bg-secondary px-2 py-2">
                                    <i class="fas fa-question-circle" style="margin-right:5px;margin-left:5px;"></i>
                                    UNKNOWN STATUS
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary square-button open-modal-btn"
                                data-url="{{ route('fetch.notes', ['orderNumber' => $order->order_number]) }}"
                                data-order-number="{{ $order->order_number }}">
                                <i class="fas fa-arrow-right"></i>

                                <span>View</span>
                            </button>
                            {{-- <a href="{{ route('driver.invoice.pdf_index',['order_number' => $order->order_number]) }}" target="_blank">View PDF</a> --}}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

