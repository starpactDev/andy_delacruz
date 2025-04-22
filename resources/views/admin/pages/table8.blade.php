<div id="filteredTablesContainer" class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>

                    <th class="border-0 text-muted fw-normal">Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                    <th class="border-0 text-muted fw-normal">Receiver Info</th>

                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">Assigned To</th>
                    <th class="border-0 text-muted fw-normal">View Invoices</th>
                </tr>
            </thead>
            <tbody>
                @if ($assignedOrders->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">
                            <h6 class="font-weight-medium mb-0 text-muted">No packages have been assigned yet.</h6>
                        </td>
                    </tr>
                @else
                    @foreach ($assignedOrders as $order)
                        <tr>
                            <td>
                                <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                            </td>
                            <td>
                                <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->container_number ?? 'N/A' }}</h6>
                            </td>
                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    {{ $order->orderPickup->sender->first_name ?? 'N/A' }}
                                    {{ $order->orderPickup->sender->last_name ?? 'N/A' }}
                                </h6>
                            </td>
                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    {{ $order->orderPickup->receiver->first_name ?? 'N/A' }}
                                    {{ $order->orderPickup->receiver->last_name ?? 'N/A' }}
                                </h6>
                                <small class="text-muted">
                                    <i class=" text-dark me-1" aria-hidden="true">PROVINCE :</i>
                                    {{ $order->orderPickup->receiver->province ?? '' }}
                                </small>
                                <br/>
                                <small class="text-muted">
                                    <i class=" text-dark me-1" aria-hidden="true">CITY :</i>
                                    {{ $order->orderPickup->receiver->city ?? '' }}
                                </small>
                            </td>
                            <td>
                                <h6 class="font-weight-medium mb-0">
                                    <span class="badge {{ $order->orderPickup->is_completed === 0 ? 'bg-danger' : 'bg-success' }}">
                                        {{ $order->orderPickup->is_completed === 0 ? 'Due' : 'Paid' }}
                                    </span>
                                </h6>
                            </td>

                            <td>
                                <h6 class="font-weight-medium mb-0">{{ $order->driver->name ?? 'Unassigned' }}</h6>

                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-light-warning text-dark custom-size"
                                        onclick="window.location.href='{{ route('user.order_overview', $order->id) }}'">
                                    <i data-feather="package" class="feather-sm"></i> View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</div>
