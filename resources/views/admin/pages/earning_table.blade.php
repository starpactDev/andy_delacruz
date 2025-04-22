<div class="container p-4" style="background-color: #fffffff1; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Dropdown Section -->
        <div>
            <label for="containerDropdown" class="form-label" style="font-weight: bold; color: #343a40;">Select Container:</label>
            <select id="containerDropdown" class="form-select" style="min-width: 200px;">
                <option value="all">All</option>
                <!-- Options will be dynamically populated -->
            </select>
        </div>

        <!-- Total Amount Section -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <tbody>
                    <tr>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #343a40;">Total Earning Amount</td>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #28a745;">
                            <span id="totalAmountPaid">$0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #66696b;">Due Amount</td>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #c41f1f;">
                            <span id="dueAmount">$0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #66696b;">Amount Paid</td>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #28a745;">
                            <span id="amountPaid">$0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #66696b;">Earning from Cash</td>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #28a745;">
                            <span id="cashAmountPaid">$0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #66696b;">Earning from Paypal</td>
                        <td class="text-end" style="font-size: 1.0rem; font-weight: bold; color: #28a745;">
                            <span id="onlineAmountPaid">$0.00</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="month-table">
    <div class="table-responsive mt-3">
        <table id="dataTable" class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>

                    <th class="border-0 text-muted fw-normal">Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                    <th class="border-0 text-muted fw-normal">Total Amount</th>
                    <th class="border-0 text-muted fw-normal">Paid Amount</th>

                    <th class="border-0 text-muted fw-normal">Due Amount</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                </tr>
            </thead>
            <tbody>

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
