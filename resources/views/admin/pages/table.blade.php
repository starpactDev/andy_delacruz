<style>
    /* General Styles for Square Elements */
.square-badge, .square-button {
    width: 100px; /* Adjust size */
    height: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    border-radius: 10%; /* Optional: For slight rounding */
}

/* Icon Styles */
.square-badge i, .square-button i {
    font-size: 20px; /* Adjust icon size */
    margin-bottom: 5px; /* Spacing between icon and text */
}

/* Text Styles */
.square-badge span, .square-button span {
    font-size: 14px;
    font-weight: bold;
    display: block;
    text-align: center;
    line-height: 1.2;
}

/* Colors */
.bg-success {
    background-color: rgb(18, 182, 72)!important;
    color: white;
}

.bg-info {
    background-color: rgb(27, 188, 157)!important;
    color: white;
}

.bg-secondary {
    background-color: gray!important;
    color: white;
}



</style>

<div class="month-table">
    <div class="table-responsive mt-3">
        <div class="d-flex justify-content-end mb-3">
            {{-- <div class="onoffswitch ">
                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                    id="myonoffswitch" tabindex="0">
                <label class="onoffswitch-label" for="myonoffswitch">
                    <span class="onoffswitch-inner"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </div> --}}
            <button class="btn btn-primary mx-2" style="background-color:#1e7b59" id="route-direction-button"
                data-province="{{ $province }}" data-orders="{{ $orders }}"><i class="fa fa-map-marker-alt"></i>
                Click here to get <b>ROUTE DIRECTIONS</b></button>
        </div>
        <!-- Instruction Note -->
        <div class="alert alert-info" role="alert" style="margin-bottom: 1rem;">
            Please select the checkboxes next to the invoices you want to print.
        </div>
        <!-- Select All Button -->
        <button type="button" class="btn btn-secondary" id="selectAllBtn" onclick="selectAllCheckboxes()">Select
            All</button>

        <!-- Deselect All Button -->
        <button type="button" class="btn btn-secondary" id="deselectAllBtn" onclick="deselectAllCheckboxes()">Deselect
            All</button>
        <!-- Print Invoices button -->
        <button type="button" class="btn btn-primary" id="printInvoicesBtn_{{ $provinceId }}"
            style="display: none;">Print Invoices</button>

        {{-- <table id="table_{{ $provinceId }}" class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <!-- Select All Checkbox -->
                    <th class="border-0 text-muted fw-normal">
                        <input type="checkbox" class="selectAllCheckbox" id="selectAll_{{ $provinceId }}" data-province="{{ $provinceId }}" />                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Order Id
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Customer Name
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Payment Status
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Order Status
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Note
                    </th>
                    <th class="border-0 text-muted fw-normal">
                        Proof of Delivery
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- Row Checkbox -->
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}" />
                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">ORD123456</h6>
                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">John Doe</h6>
                    </td>
                    <td>
                        <span class="badge bg-primary px-2 py-1">Paid</span>
                    </td>
                    <td>
                        <span class="shipment-badge badge bg-success" style="background-color: rgb(19, 190, 202)!important">
                            <span class="fa-stack" style="margin-right:5px;">
                              <i class="fas fa-hand-holding fa-stack-1x"></i>
                              <i class="fas fa-box fa-stack-1x" style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                            </span>
                            PICK
                        </span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary add-note-btn" style="border-radius: 12px; background-color: rgb(21, 4, 83)!important" data-bs-toggle="modal" data-bs-target="#noteModal" data-shipment-id="ORD123456">Add</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary add-identity-btn" style="border-radius: 12px; background-color: rgb(4, 67, 83)!important" data-bs-toggle="modal" data-bs-target="#identityModal" data-shipment-id="ORD123456">
                            <div style="position: relative; display: inline-block;">
                                <i class="bi bi-geo-alt" style="font-size: 15px;"></i>
                                <i class="fa fa-check" style="position: absolute; top: 3px; left: 8px; font-size: 8px; color: white;"></i>
                            </div> Upload
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}" />
                    </td>
                    <td><h6 class="font-weight-medium mb-0">ORD123457</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Jane Smith</h6></td>
                    <td><span class="badge bg-danger px-2 py-1">Unpaid</span></td>
                    <td><span class="shipment-badge badge bg-info px-2 py-2"><i class='fas fa-box-open' style="margin-right:7px;margin-left:5px"></i> PACK</span></td>
                    <td><button type="button" class="btn btn-primary add-note-btn" style="border-radius: 12px; background-color: rgb(21, 4, 83)!important" data-bs-toggle="modal" data-bs-target="#noteModal" data-shipment-id="ORD123457">Add</button></td>
                    <td><button type="button" class="btn btn-primary add-identity-btn" style="border-radius: 12px; background-color: rgb(4, 67, 83)!important" data-bs-toggle="modal" data-bs-target="#identityModal" data-shipment-id="ORD123457"><div style="position: relative; display: inline-block;"><i class="bi bi-geo-alt" style="font-size: 15px;"></i><i class="fa fa-check" style="position: absolute; top: 3px; left: 8px; font-size: 8px; color: white;"></i></div> Upload</button></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}" />
                    </td>
                    <td><h6 class="font-weight-medium mb-0">ORD123458</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Acme Corp</h6></td>
                    <td><span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td><span class="shipment-badge badge bg-info px-2 py-2" style="background-color: rgb(27, 188, 157)!important"><i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i> SHIP</span></td>
                    <td><button type="button" class="btn btn-primary add-note-btn" style="border-radius: 12px; background-color: rgb(21, 4, 83)!important" data-bs-toggle="modal" data-bs-target="#noteModal" data-shipment-id="ORD123458">Add</button></td>
                    <td><button type="button" class="btn btn-primary add-identity-btn" style="border-radius: 12px; background-color: rgb(4, 67, 83)!important" data-bs-toggle="modal" data-bs-target="#identityModal" data-shipment-id="ORD123458"><div style="position: relative; display: inline-block;"><i class="bi bi-geo-alt" style="font-size: 15px;"></i><i class="fa fa-check" style="position: absolute; top: 3px; left: 8px; font-size: 8px; color: white;"></i></div> Upload</button></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}" />
                    </td>
                    <td><h6 class="font-weight-medium mb-0">ORD123459</h6></td>
                    <td><h6 class="font-weight-medium mb-0">Global Industries</h6></td>
                    <td><span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td><span class="shipment-badge badge bg-success px-2 py-1" style="background-color: rgb(34, 109, 175)!important"><span class="fa-stack"><i class="fas fa-file fa-stack-1x"></i><i class="fas fa-check fa-stack-1x"></i></span> CUSTOM</span></td>
                    <td><button type="button" class="btn btn-primary add-note-btn" style="border-radius: 12px; background-color: rgb(21, 4, 83)!important" data-bs-toggle="modal" data-bs-target="#noteModal" data-shipment-id="ORD123459">Add</button></td>
                    <td><button type="button" class="btn btn-primary add-identity-btn" style="border-radius: 12px; background-color: rgb(4, 67, 83)!important" data-bs-toggle="modal" data-bs-target="#identityModal" data-shipment-id="ORD123459"><div style="position: relative; display: inline-block;"><i class="bi bi-geo-alt" style="font-size: 15px;"></i><i class="fa fa-check" style="position: absolute; top: 3px; left: 8px; font-size: 8px; color: white;"></i></div> Upload</button></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}" />
                    </td>
                    <td><h6 class="font-weight-medium mb-0">ORD123460</h6></td>
                    <td><h6 class="font-weight-medium mb-0">BlueWave Ltd</h6></td>
                    <td><span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td><span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(18, 182, 72)!important"><i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED</span></td>
                    <td><button type="button" class="btn btn-primary add-note-btn" style="border-radius: 12px; background-color: rgb(21, 4, 83)!important" data-bs-toggle="modal" data-bs-target="#noteModal" data-shipment-id="ORD123460">Add</button></td>
                    <td><button type="button" class="btn btn-primary add-identity-btn" style="border-radius: 12px; background-color: rgb(4, 67, 83)!important" data-bs-toggle="modal" data-bs-target="#identityModal" data-shipment-id="ORD123460"><div style="position: relative; display: inline-block;"><i class="bi bi-geo-alt" style="font-size: 15px;"></i><i class="fa fa-check" style="position: absolute; top: 3px; left: 8px; font-size: 8px; color: white;"></i></div> Upload</button></td>
                </tr>
            </tbody>
        </table> --}}
        <table id="table_{{ $provinceId }}" class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th></th>
                    <th class="border-0 text-muted fw-normal">Order Id</th>
                    <th class="border-0 text-muted fw-normal">Container Number</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                    <th class="border-0 text-muted fw-normal">Recipient Details</th>


                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">View Orders</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                    <th class="border-0 text-muted fw-normal">Note</th>
                    <th class="border-0 text-muted fw-normal">Proof of Delivery</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <input type="checkbox" class="rowCheckbox" data-province="{{ $provinceId }}"
                                data-order-number="{{ $order->order_number }}" />
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                        </td>


                        <td>
                            <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->container_number }}</h6>
                        </td>
                        <td>
                            <h6 class="font-weight-medium mb-0"> {{ $order->orderPickup->sender->first_name ?? 'N/A' }}
                                {{ $order->orderPickup->sender->last_name ?? 'N/A' }}</h6>
                        </td>

                        <td>
                            <h6 class="font-weight-medium mb-0" >
                                {{ $order->orderPickup->receiver->first_name ?? 'N/A' }}
                                {{ $order->orderPickup->receiver->last_name ?? 'N/A' }}
                            </h6>
                            <br/>
                            <small class="text-muted">
                                <i class=" text-dark me-1" aria-hidden="true">PROVINCE :</i>
                                {{ $order->orderPickup->receiver->province ?? '' }}
                            </small>
                            <br />
                            <small class="text-muted">
                                <i class=" text-dark me-1" aria-hidden="true">CITY :</i>
                                {{ $order->orderPickup->receiver->city ?? '' }}
                            </small>
                            <br />
                            <small class="text-muted">
                                <i class=" text-dark me-1" aria-hidden="true">ADDRESS :</i>
                                {{ $order->orderPickup->receiver->address ?? '' }}
                            </small>
                            <br />
                            <small class="text-muted">
                                <i class=" text-dark me-1" aria-hidden="true">TEL :</i>
                                {{ $order->orderPickup->receiver->telephone ?? '' }}
                            </small>
                            <br />
                            <small class="text-muted">
                                <i class=" text-dark me-1" aria-hidden="true">WHATSAPP :</i>
                                {{ $order->orderPickup->receiver->whatsapp ?? '' }}
                            </small>
                        </td>

                        {{-- <td>
                            <h6 class="font-weight-medium mb-0">
                                {{ $order->orderPickup->sender->first_name ?? 'N/A' }}
                                {{ $order->orderPickup->sender->last_name ?? 'N/A' }}
                            </h6>
                        </td> --}}
                        <td>
                            <button type="button" class="btn btn-sm btn-light-success square-button text-primary custom-size"
                                data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                data-order-pickup-id="{{ $order->orderPickup->id }}">
                                <i data-feather="dollar-sign" class="feather-sm"></i> <span>View</span>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-light-warning square-button text-dark custom-size"
                                onclick="window.location.href='{{ route('driver.driver_order_overview', $order->orderPickup->id) }}'">
                                <i data-feather="package" class="feather-sm"></i> <span>View</span>
                            </button>
                        </td>

                        <td>
                            @if ($order->orderPickup->package_status == 'PACK')
                                <span class="shipment-badge badge square-badge bg-success"
                                    style="background-color: rgb(19, 190, 202)!important">
                                    <span class="fa-stack" style="margin-right:5px;">
                                        <i class="fas fa-hand-holding fa-stack-1x"></i>
                                        <i class="fas fa-box fa-stack-1x"
                                            style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                                    </span>
                                    PACK
                                </span>
                            @elseif($order->orderPickup->package_status == 'SHIP')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2"
                                    style="background-color: rgb(27, 188, 157)!important;">
                                    <i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP
                                </span>
                            @elseif($order->orderPickup->package_status == 'CUSTOMS')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                    <i class='fas fa-box' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                </span>
                            @elseif($order->orderPickup->package_status == 'CUSTOMS REVIEW')
                                <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                    <i class='fa fa-star' style="margin-right:7px;margin-left:5px"></i> CUSTOMS
                                    REVIEW
                                </span>

                            @elseif($order->orderPickup->package_status == 'HELD BY CUSTOMS')
                            <span class="shipment-badge badge bg-success px-2 py-2"
                                style="background-color: rgb(164, 4, 19)!important;">
                                <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                            </span>
                            @elseif($order->orderPickup->package_status == 'IN DISTRIBUTION')
                                <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                    style="background-color: rgb(4, 131, 164)!important;">
                                    <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                                    DISTRIBUTION
                                </span>
                            @elseif($order->orderPickup->package_status == 'DELIVERED')
                                <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                    style="background-color: rgb(18, 182, 72)!important;">
                                    <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                                </span>
                            @elseif($order->orderPickup->package_status == 'order_created')
                            <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                            style="background-color: rgb(150, 206, 18)!important;">
                            <i class="fas fa-plus-circle" style="margin-right:5px;margin-left:5px;"></i> ORDER CREATED
                        </span>


                            @else
                                <span class="shipment-badge badge square-badge bg-secondary px-2 py-2">
                                    <i class="fas fa-question-circle" style="margin-right:5px;margin-left:5px;"></i>
                                    UNKNOWN STATUS
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary square-button add-note-btn" data-bs-toggle="modal"
                            data-bs-target="#noteModal" data-order-number="{{ $order->order_number }}"
                            data-order-pickup-id="{{ $order->order_pickup_id }}"
                            data-driver-id="{{ auth()->id() }}">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add</span>
                        </button>
                            {{-- <a href="{{ route('driver.invoice.pdf_index',['order_number' => $order->order_number]) }}" target="_blank">View PDF</a> --}}
                        </td>
                        <td>
                            @php
                                $orderPickupId = $order->order_number; // Assuming this is the `order_pickup_id`
                                $existsInReceiverIdentityCard = \App\Models\ReceiverIdentityCard::where(
                                    'order_pickup_id',
                                    $orderPickupId,
                                )->exists();
                                $existsInReceiverPackagesImage = \App\Models\ReceiverPackagesImage::where(
                                    'order_pickup_id',
                                    $orderPickupId,
                                )->exists();
                                $existsInReceiverSignature = \App\Models\ReceiverSignature::where(
                                    'order_pickup_id',
                                    $orderPickupId,
                                )->exists();
                                $existsInAll =
                                    \App\Models\ReceiverIdentityCard::where(
                                        'order_pickup_id',
                                        $orderPickupId,
                                    )->exists() &&
                                    \App\Models\ReceiverPackagesImage::where(
                                        'order_pickup_id',
                                        $orderPickupId,
                                    )->exists() &&
                                    \App\Models\ReceiverSignature::where('order_pickup_id', $orderPickupId)->exists();
                            @endphp
                            @if (!$existsInAll)
                                @if ($existsInReceiverIdentityCard)
                                    @php
                                        \App\Models\ReceiverIdentityCard::where(
                                            'order_pickup_id',
                                            $orderPickupId,
                                        )->delete();
                                    @endphp
                                @endif
                                @if ($existsInReceiverPackagesImage)
                                    @php
                                        \App\Models\ReceiverPackagesImage::where(
                                            'order_pickup_id',
                                            $orderPickupId,
                                        )->delete();
                                    @endphp
                                @endif
                                @if ($existsInReceiverSignature)
                                    @php
                                        \App\Models\ReceiverSignature::where(
                                            'order_pickup_id',
                                            $orderPickupId,
                                        )->delete();
                                    @endphp
                                @endif
                                <!-- Display the button if not present in all three models -->
                                <button type="button"
                                class="btn btn-primary add-identity-btn d-flex flex-column justify-content-center align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#identityModal"
                                data-receiver-id="{{ $order->orderPickup->receiver_id }}"
                                data-order-id="{{ $order->orderPickup->id }}"
                                data-order-number="{{ $order->order_number }}"
                                style="width: 100px; height: 100px; background-color: rgb(33, 150, 243);">
                                <i class="fas fa-upload" style="font-size: 24px;"></i>
                                <span style="font-size: 14px; margin-top: 5px;">Upload</span>
                            </button>
                            @else
                                <!-- Optionally, display a message or leave it blank -->
                                <div class="d-flex align-items-center gap-4">
                                    <button type="button" class="btn btn-primary view-identity-btn d-flex flex-column justify-content-center align-items-center"
                                        style="background-color: green; width: 100px; height: 100px;"
                                        data-bs-toggle="modal" data-bs-target="#viewidentityModal"
                                        data-receiver-id="{{ $order->orderPickup->receiver_id }}"
                                        data-order-id="{{ $order->orderPickup->id }}"
                                        data-order-number="{{ $order->order_number }}">
                                        <i class="fas fa-folder-open" style="font-size: 24px;"></i>
                                        <span style="font-size: 14px; margin-top: 5px;">View Docs</span>
                                    </button>
                                    <a href="{{ route('driver.invoice.share_index', ['order_number' => $order->order_number]) }}"
                                        class="btn btn-primary btn-sm d-flex flex-column justify-content-center align-items-center"
                                        style="background-color: rgb(21, 31, 124); width: 100px; height: 100px;">
                                        <i class="fas fa-share-alt" style="font-size: 24px;"></i>
                                        <span style="font-size: 14px; margin-top: 5px;">Share Invoice</span>
                                    </a>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>
    function selectAllCheckboxes() {
        // Show SweetAlert confirmation
        Swal.fire({
            title: 'Confirm Action',
            text: 'Do you want to select all checkboxes and print all invoices?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, select and print!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            // If the user confirms
            if (result.isConfirmed) {
                // Get all row checkboxes and print buttons
                const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
                const printButtons = document.querySelectorAll(
                    '[id^="printInvoicesBtn_"]'); // Select all Print Invoice buttons

                // Check all row checkboxes
                rowCheckboxes.forEach(checkbox => checkbox.checked = true);

                // Show all Print Invoice buttons
                printButtons.forEach(button => button.style.display = 'inline-block');

                // Optionally show a success message
                Swal.fire({
                    title: 'Selected!',
                    text: 'All checkboxes are selected and ready for printing.',
                    icon: 'success'
                });
            }
        });
    }


    function deselectAllCheckboxes() {
        // Get all row checkboxes
        const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
        const printButtons = document.querySelectorAll('[id^="printInvoicesBtn_"]'); // Select all Print Invoice buttons

        // Uncheck all row checkboxes
        rowCheckboxes.forEach(checkbox => checkbox.checked = false);

        // Hide all Print Invoice buttons
        printButtons.forEach(button => button.style.display = 'none');
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectedOrderNumbers = new Set();

        // Update the togglePrintButton function to account for dynamic button IDs
        function togglePrintButton() {
            document.querySelectorAll("[id^='printInvoicesBtn_']").forEach(function(button) {
                const provinceId = button.id.split('_')[1]; // Extract provinceId from the ID
                const isVisible = selectedOrderNumbers.size > 0;
                button.style.display = isVisible ? "inline-block" : "none";
            });
        }

        // Select/Deselect all checkboxes
        document.getElementById("selectAllBtn").addEventListener("click", () => {
            document.querySelectorAll(".rowCheckbox").forEach((checkbox) => {
                checkbox.checked = true;
                selectedOrderNumbers.add(checkbox.dataset.orderNumber);
            });
            togglePrintButton();
        });

        document.getElementById("deselectAllBtn").addEventListener("click", () => {
            document.querySelectorAll(".rowCheckbox").forEach((checkbox) => {
                checkbox.checked = false;
            });
            selectedOrderNumbers.clear();
            togglePrintButton();
        });

        // Individual checkbox handling
        document.querySelectorAll(".rowCheckbox").forEach((checkbox) => {
            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    selectedOrderNumbers.add(this.dataset.orderNumber);
                } else {
                    selectedOrderNumbers.delete(this.dataset.orderNumber);
                }
                togglePrintButton();
            });
        });

        // Handle the Print Invoice button click
        document.querySelectorAll("[id^='printInvoicesBtn_']").forEach(function(button) {
            button.addEventListener("click", () => {
                const provinceId = button.id.split('_')[1]; // Extract provinceId from the ID
                console.log(`Print invoices for provinceId: ${provinceId}`);
                if (selectedOrderNumbers.size > 0) {
                    fetchInvoices(Array.from(selectedOrderNumbers), provinceId);
                } else {
                    console.log("No orders selected.");
                }
            });
        });

        // Fetch and display invoices
        async function fetchInvoices(orderNumbers, provinceId) {
            console.log("Fetching invoices for order numbers:", orderNumbers, "and provinceId:",
                provinceId);
            try {
                const response = await fetch("{{ route('fetch.invoices') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({
                        orderNumbers,
                        provinceId, // Pass provinceId to the server if needed
                    }),
                });
                const data = await response.json(); // Parse the JSON response
                if (data.success) {
                    console.log(data.invoiceHtml);
                    // Redirect to the page displaying invoices
                    window.location.href = data.redirectUrl;
                } else {
                    console.error("Failed to fetch invoices:", data);
                }
            } catch (error) {
                console.error("Error fetching invoices:", error);
            }
        }
    });
</script>
<script>
    document.getElementById('route-direction-button').addEventListener('click', function() {
        const switchState = document.getElementById('myonoffswitch').checked; // Check the state of the switch
        const province = this.getAttribute('data-province');
        const orders = this.getAttribute('data-orders');

        // Assuming orders is serialized as JSON in the data attribute
        const ordersJson = JSON.parse(orders);

        // If switch is off, show SweetAlert
        if (!switchState) {
            Swal.fire({
                title: 'Please turn on the switch first!',
                text: 'You must enable the switch to get route directions.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        } else {
            // If switch is on, redirect as planned
            const url = new URL('{{ route('driver.rd_route.list') }}', window.location.origin);
            url.searchParams.append('province', province);
            url.searchParams.append('orders', JSON.stringify(ordersJson)); // Optional: Send orders as JSON

            // Redirect to the constructed URL
            window.location.href = url;
        }
    });
</script>
