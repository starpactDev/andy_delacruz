<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>

                    <th class="border-0 text-muted fw-normal">Old Container ID</th>
                    <th class="border-0 text-muted fw-normal">New Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">View Orders</th>


                    <th class="border-0 text-muted fw-normal">Due Amount</th>

                </tr>
            </thead>
            <tbody>
                @forelse($leftoverPackages  as $order)
                <tr>
                    <td>
                        <h6 class="font-weight-medium mb-0">{{ $order->order_id }}</h6>
                    </td>

                    <td>
                        <h6 class="font-weight-medium mb-0"  style="font-size:22px;text-decoration: line-through; text-decoration-color: red;">
                            {{ $order->old_container_id }}
                        </h6>
                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0" style="font-size:22px;border: 2px solid green; padding: 5px;text-align:center">
                            {{ $order->new_container_id }}
                        </h6>
                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0"> {{ $order->orderPickup->sender->first_name ?? '' }} {{ $order->orderPickup->sender->last_name ?? '' }}</h6>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                                data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                data-order-pickup-id="{{ $order->orderPickup->id }}">
                            <i data-feather="dollar-sign" class="feather-sm"></i> View
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                                onclick="window.location.href='{{ route('user.order_overview', $order->orderPickup->id) }}'">
                            <i data-feather="package" class="feather-sm"></i> View
                        </button>

                    </td>

                    <td>

                        <span class="paid-badge badge
                        {{ $order->grand_total_amount - $order->amount_paid == 0 ? 'bg-primary' : 'bg-danger' }}
                        px-2 py-2">
                        {{ $order->grand_total_amount - $order->amount_paid == 0 ? 'PAID' : '$' . number_format($order->grand_total_amount - $order->amount_paid, 2) }}
                    </span>
                    </td>


                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No Leftover Packages Added</td>
                </tr>
                @endforelse
            </tbody>


            {{-- <tbody>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2401</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0001</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">John Doe</h6></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td><span class="paid-badge badge bg-danger px-2 py-2">$250</span></td>
                    <td>
                        <span class="shipment-badge badge bg-success" style="background-color: rgb(19, 190, 202)!important">
                            <span class="fa-stack" style="margin-right:5px;">
                              <i class="fas fa-hand-holding fa-stack-1x"></i>
                              <i class="fas fa-box fa-stack-1x" style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                            </span>
                            PACK
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2402</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0002</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Acme Corp</h6></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>

                    <td><span class="paid-badge badge bg-danger px-2 py-2">$500</span></td>
                    <td>
                        <span class="shipment-badge badge bg-info px-2 py-2" style="background-color: rgb(27, 188, 157)!important">
                            <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i> SHIP
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2403</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0003</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Global Industries</h6></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td><span class="paid-badge badge bg-danger px-2 py-2">$160</span></td>
                    <td>
                        <span class="shipment-badge badge bg-success px-2 py-1" style="background-color: rgb(34, 109, 175)!important">
                            <span class="fa-stack">
                              <i class="fas fa-file fa-stack-1x"></i>
                              <i class="fas fa-check fa-stack-1x"></i>
                            </span>
                            CUSTOMS
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2404</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0004</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Global Industries</h6></td>


                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td><span class="paid-badge badge bg-danger px-2 py-2">$500</span></td>
                    <td>
                        <span class="shipment-badge badge bg-info px-2 py-2">
                            <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS REVIEW
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2405</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0005</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Global Industries</h6></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td><span class="paid-badge badge bg-danger px-2 py-2">$369</span></td>
                    <td>
                        <span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(4, 131, 164)!important">
                            <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i> DISTRIBUTION
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><h6 class="font-weight-medium mb-0">EPG - 2406</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20-0006</h6></td>
                    <td><h6 class="font-weight-medium mb-0">EPG 20</h6></td>
                    <td><h6 class="font-weight-medium mb-0">BlueWave Ltd</h6></td>

                    <td>
                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                        data-bs-toggle="modal" data-bs-target="#paymentStatusModal">
                        <i data-feather="dollar-sign" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                        onclick="window.location.href='{{ route('user.order_overview') }}'">
                        <i data-feather="package" class="feather-sm"></i> View
                    </button>
                    </td>
                    <td><span class="paid-badge badge bg-danger px-2 py-2">$600</span></td>
                    <td>
                        <span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(18, 182, 72)!important">
                            <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                        </span>
                    </td>
                </tr>
            </tbody> --}}
        </table>
    </div>
</div>


<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNoteForm">
                    <input type="hidden" id="orderPickupId" name="order_pickup_id">
                    <input type="hidden" id="orderNumber" name="order_number">
                    <div class="form-group">
                        <label for="note">Note</label>
                        <textarea class="form-control" id="note" name="add_note" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Add Note</button>
                </form>
            </div>
        </div>
    </div>
</div>

