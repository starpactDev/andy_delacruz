<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle  table-hover table" data-tablesaw>
            <thead>
                <tr>

                    <th class="border-0 text-muted fw-normal">
                        Order Number
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Customer Name
                    </th>


                    <th class="border-0 text-muted fw-normal">
                        Payment Status
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Order Overview
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        ID & Packages Docs
                    </th>

                    <th class="border-0 text-muted fw-normal">
                        Order Status
                    </th>



                </tr>
            </thead>
            <tbody>
                @if (count($order_history) > 0)
                    @foreach ($order_history as $history)
                        <tr>

                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    {{ $history->order_number }}
                                </h6>

                            </td>
                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    {{ $history->sender->first_name ?? '' }} {{ $history->sender->last_name ?? '' }}
                                </h6>
                                <small class="text-muted">
                                    <i class="fa fa-envelope me-1" aria-hidden="true"></i>
                                    {{ $history->sender->email ?? '' }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    <i class="fa fa-phone me-1" aria-hidden="true"></i> <!-- Font Awesome phone icon -->
                                    {{ $history->sender ? $history->sender->telephone : 'N/A' }}
                                </small>
                            </td>


                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    <span class="badge {{ $history->is_completed === 0 ? 'bg-danger' : 'bg-success' }}">
                                        {{ $history->is_completed === 0 ? 'Due' : 'Paid' }}
                                    </span>
                                </h6>
                            </td>

                            <td>
                                <a href="{{ route('user.order_overview', $history->id) }}"
                                    class="shipment-badge badge bg-success"
                                    style="background-color: rgb(0, 204, 102)!important; text-decoration: none;">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i data-feather="package" class="feather-sm"></i>
                                    </span>
                                    VIEW
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('user.packages_info', $history->id) }}"
                                    class="shipment-badge badge bg-success"
                                    style="background-color: rgb(19, 95, 64)!important; text-decoration: none;">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i data-feather="image" class="feather-sm"></i>
                                    </span>
                                    VIEW IMAGES
                                </a>
                            </td>

                            <td>
                                @if ($history->package_status == 'PACK')
                                    <span class="shipment-badge badge bg-success"
                                        style="background-color: rgb(19, 190, 202)!important">
                                        <span class="fa-stack" style="margin-right:5px;">
                                            <i class="fas fa-hand-holding fa-stack-1x"></i>
                                            <i class="fas fa-box fa-stack-1x"
                                                style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                                        </span>
                                        PACK
                                    </span>
                                @elseif($history->package_status == 'SHIP')
                                    <span class="shipment-badge badge bg-info px-2 py-2"
                                        style="background-color: rgb(27, 188, 157)!important;">
                                        <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP
                                    </span>
                                @elseif($history->package_status == 'CUSTOMS')
                                    <span class="shipment-badge badge bg-info px-2 py-2">
                                        <i class='fas fa-box' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                    </span>
                                @elseif($history->package_status == 'CUSTOMS REVIEW')
                                    <span class="shipment-badge badge bg-info px-2 py-2">
                                        <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                        REVIEW
                                    </span>

                            @elseif($history->package_status == 'HELD BY CUSTOMS')
                            <span class="shipment-badge badge bg-success px-2 py-2"
                                style="background-color: rgb(164, 4, 19)!important;">
                                <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                            </span>
                                @elseif($history->package_status == 'IN DISTRIBUTION')
                                    <span class="shipment-badge badge bg-success px-2 py-2"
                                        style="background-color: rgb(4, 131, 164)!important;">
                                        <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                                        DISTRIBUTION
                                    </span>
                                @elseif($history->package_status == 'DELIVERED')
                                    <span class="shipment-badge badge bg-success px-2 py-2"
                                        style="background-color: rgb(18, 182, 72)!important;">
                                        <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
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
                @else
                    <tr>

                        <td colspan="6">
                            <h6 class="font-weight-medium m-5 text-center
        "
                                style="color:red;font-size:20px!important;">
                                No Orders In This Container
                            </h6>

                        </td>
                @endif




            </tbody>
        </table>
    </div>
</div>
