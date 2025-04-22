@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card-title {}
    </style>
    <div class="container-fluid">

        <div class="row">
            <div class="d-flex justify-content-center align-items-center m-1 p-3"
            style="background-color: #a6cffc; border-radius: 10px; gap: 20px;">
            <!-- Total Orders Section -->
            <div>
                <h style="padding: 10px 20px; font-weight: 600; font-size: 1.4rem; color: rgb(26, 11, 54); text-decoration: none;">
                  DISTRIBUTION OF PACKAGES IN THE DOMINICAN REPUBLIC REPORT
                </h>
            </div>

            <!-- Search Section -->

        </div>
            <div class="d-flex justify-content-center align-items-center m-1 p-3"
            style="background-color: #d9e5f1; border-radius: 10px; gap: 20px;">
            <!-- Total Orders Section -->
            <div>
                <h style="padding: 10px 20px; font-weight: 600; font-size: 1.4rem; color: rgb(67, 63, 75); text-decoration: none;">
                    TOTAL ASSIGNED ORDERS FOR CONTAINER : <span style="color: rgb(67, 95, 24)">{{ $currentContainerNumber }}</span>
                   </h>
            </div>

            <!-- Search Section -->

        </div>


            <!-- Notes in the top-right corner -->


            <div class="row">
                <div class="container mt-4">

                    <div class="row">


                        <div id="provinceOrdersContainer">

                            @foreach ($assignedOrders as $driverId => $orders)
                            @php
                            $driverName = $orders->first()->driver->name ?? 'Unknown Driver';
                        @endphp

                                <div class="align-items-stretch province-card"
                                   >
                                    <div class="card">
                                        <div class="card-body">
                                            <div
                                            style="display: flex; justify-content: space-between; align-items: center; background-color: #d3e3f5;
                                                   color: rgb(23, 3, 39); padding: 10px 20px; border-radius: 8px;
                                                   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;
                                                   margin-bottom: 20px; margin-top: 20px; margin-left: 10px; margin-right: 10px;">

                                            <!-- Provinces on the left -->
                                            <div style="flex: 1; text-align: left; font-size: 1rem; color: rgb(23, 3, 39); font-weight: 500;">
                                                <span style="font-weight: bold;">Provinces:</span>
                                                @foreach ($orders->pluck('orderPickup.receiver.province')->filter()->unique() as $province)
                                                @php
                                                $provinceOrdersCount = $orders->where('orderPickup.receiver.province', $province)->count();
                                            @endphp
                                                    <button
                                                        style="background-color: #007bff; color: white; border: none; border-radius: 5px;
                                                               padding: 5px 10px; margin: 5px; cursor: pointer; font-size: 0.9rem;">
                                                        {{ $province }}  ({{ $provinceOrdersCount }})
                                                    </button>
                                                @endforeach
                                            </div>

                                            <!-- Driver name in the center -->
                                            <h4 style="margin: 0; font-size: 1.2rem; color:rgb(23, 3, 39); font-weight:600; flex: 1; text-align: center;">
                                                DRIVER - {{ $driverName }}
                                            </h4>

                                            <!-- Total orders on the right -->
                                            <div style="flex: 1; text-align: right; font-size: 1rem; color: green; font-weight: bold;">
                                                Total Orders: {{ $orders->count() }}
                                            </div>
                                        </div>

                                            @if ($orders->isEmpty())
                                                <p class="text-center text-muted">No orders assigned to this driver.
                                                </p>
                                            @else
                                            <div class="month-table">
                                                <div class="table-responsive mt-3">
                                                    <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                                                        <style>
                                                            td b.tablesaw-cell-label {
                                                                display: none;
                                                            }
                                                        </style>
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
                                                            @foreach ($orders as $order)
                                                                <tr class="order-row" data-order-number="{{ $order->orderPickup->order_number }}">
                                                                    <td>
                                                                        <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->order_number }}</h6>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->container_number }}</h6>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class="font-weight-medium mb-0">{{ $order->orderPickup->sender->first_name ?? '' }}
                                                                            {{ $order->orderPickup->sender->last_name ?? '' }}</h6>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size"
                                                                            data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                                                            data-order-pickup-id="{{ $order->orderPickup->id }}">
                                                                            <i data-feather="dollar-sign" class="feather-sm"></i> View
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="shipment-badge badge bg-success"
                                                                            onclick="window.location.href='{{ route('user.order_overview', $order->orderPickup->id) }}'"
                                                                            style="background-color: rgb(0, 204, 102)!important; text-decoration: none; border: none;">
                                                                            <span class="fa-stack" style="margin-right: 5px;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                                    class="feather feather-package feather-sm">
                                                                                    <path
                                                                                        d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z">
                                                                                    </path>
                                                                                    <polyline points="2.32 6.16 12 11 21.68 6.16"></polyline>
                                                                                    <line x1="12" y1="22.76" x2="12" y2="11"></line>
                                                                                    <line x1="7" y1="3.5" x2="17" y2="8.5"></line>
                                                                                </svg>
                                                                            </span> View
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        $due_amount = $order->orderPickup->grand_total_amount - $order->orderPickup->amount_paid;
                                                                        ?>
                                                                        @if ($due_amount === 0)
                                                                            <span class="badge bg-primary px-2 py-1">Paid</span>
                                                                        @else
                                                                            <span class="badge bg-danger px-2 py-1">${{ number_format($due_amount, 2) }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->orderPickup->package_status == 'PACK')
                                                                            <span class="shipment-badge badge square-badge bg-success"
                                                                                style="background-color: rgb(19, 190, 202)!important">
                                                                                <i class="fas fa-hand-holding"></i> PACK
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'SHIP')
                                                                            <span class="shipment-badge badge square-badge bg-info px-2 py-2"
                                                                                style="background-color: rgb(27, 188, 157)!important;">
                                                                                <i class="fas fa-paper-plane"></i> SHIP
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'CUSTOMS')
                                                                            <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                                                                <i class="fas fa-box"></i> CUSTOMS
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'CUSTOMS REVIEW')
                                                                            <span class="shipment-badge badge square-badge bg-info px-2 py-2">
                                                                                <i class="fa fa-star"></i> CUSTOMS REVIEW
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'IN DISTRIBUTION')
                                                                            <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                                                                style="background-color: rgb(4, 131, 164)!important;">
                                                                                <i class="fas fa-map-marker-alt"></i> DISTRIBUTION
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'DELIVERED')
                                                                            <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                                                                style="background-color: rgb(18, 182, 72)!important;">
                                                                                <i class="fas fa-dolly"></i> DELIVERED
                                                                            </span>
                                                                        @elseif ($order->orderPickup->package_status == 'order_created')
                                                                            <span class="shipment-badge badge square-badge bg-success px-2 py-2"
                                                                                style="background-color: rgb(150, 206, 18)!important;">
                                                                                <i class="fas fa-plus-circle"></i> ORDER CREATED
                                                                            </span>
                                                                        @elseif($order->orderPickup->package_status == 'HELD BY CUSTOMS')
                                                                            <span class="shipment-badge badge bg-success px-2 py-2"
                                                                                style="background-color: rgb(164, 4, 19)!important;">
                                                                                <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                                                                            </span>
                                                                        @else
                                                                            <span class="shipment-badge badge square-badge bg-secondary px-2 py-2">
                                                                                <i class="fas fa-question-circle"></i> UNKNOWN STATUS
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="notesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notesModalLabel">Order Notes</h5>
                        <button type="button" class="close" id="closeNoteModal" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Notes content will be injected here -->
                        <div id="modalNotesContent">
                            <p>Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentStatusModalLabel">Payment Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info text-center">Label</th>
                                        <th class="text-info text-center">Details</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Select All checkbox (thead)
                // const selectAllCheckbox = document.querySelector('.select-all-checkbox');

                // Get all order checkboxes
                const checkboxes = document.querySelectorAll('.order-checkbox');

                // Event listener for Select All checkbox

                // Event listener for Select All button
                const selectAllButtons = document.querySelectorAll('.select-all-button');

selectAllButtons.forEach(button => {
    button.addEventListener('click', function () {
        let ordersWithAssignedDriver = [];
        const province = this.dataset.province; // Get the province from the clicked button
        console.log("Selected Province: ", province); // Debugging line

        // Select only the checkboxes where the order's province matches the selected province
        const checkboxes = document.querySelectorAll('.order-checkbox');
        checkboxes.forEach(checkbox => {
            // Get the province text from the order's row
            const provinceElement = checkbox.closest('tr').querySelector('small.text-muted i');
            if (provinceElement) {
                const orderProvince =
                    provinceElement.nextSibling?.nodeType === Node.TEXT_NODE
                        ? provinceElement.nextSibling.textContent.trim()
                        : null;

                console.log("Order Province:", orderProvince || 'N/A');
                console.log("Province <i> Element:", provinceElement.outerHTML);
                console.log("Province Sibling:", provinceElement.nextSibling);

                // Match the province text with the selected province
                if (orderProvince === province) {
                    checkbox.checked = true; // Check the checkbox

                    // Check if the checkbox has an assigned driver
                    const driverName = checkbox.dataset.driver;

                    if (driverName) {
                        // Uncheck the checkbox if it has an assigned driver
                        checkbox.checked = false;

                        // Get the order number from the checkbox value
                        const orderNumber = checkbox.value;

                        // Add this order number to the list
                        ordersWithAssignedDriver.push(orderNumber);
                    }
                }
            }
        });

        // If there are orders with assigned drivers, show a single message
        if (ordersWithAssignedDriver.length > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Orders Not Selected',
                text: `The following orders are already assigned to a driver and cannot be selected: ${ordersWithAssignedDriver.join(', ')}`,
                confirmButtonText: 'OK',
            });
        }
    });
});


                // Individual checkbox change event listener
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        // Get the driver name from the data-driver attribute
                        const driverName = this.dataset.driver;

                        if (driverName) {
                            // Show SweetAlert warning
                            Swal.fire({
                                icon: 'warning',
                                title: 'Order Already Assigned',
                                text: `Order number ${this.value} is already assigned to driver: ${driverName}. You cannot select it.`,
                                confirmButtonText: 'OK',
                            });

                            // Uncheck the checkbox
                            this.checked = false;
                        }
                    });
                });
            });
        </script>
        <script>
            var assignOrdersRoute = "{{ route('user.assigned_orders') }}"; // Laravel route name
        </script>
        <script>
            $(document).ready(function() {
                // Initially hide the dropdown and the assign button
                $(".assign-driver-container").hide();

                // Track if any checkbox is selected
                $(".order-checkbox").change(function() {
                    let selectedOrders = $(".order-checkbox:checked").length;

                    if (selectedOrders > 0) {
                        $(".assign-driver-container").show();
                        const driverContainer = document.querySelector('.assign-driver-container');
                        if (driverContainer) {
                driverContainer.style.display = 'block'; // Ensure the container is visible
                driverContainer.scrollIntoView({
                    behavior: 'smooth', // Smooth scrolling
                    block: 'start',     // Align to the top of the viewport
                });

                // Scroll up a bit more for better alignment
                const scrollOffset = -800; // Adjust this value as needed
                window.scrollBy({
                    top: scrollOffset,
                    behavior: 'smooth',
                });
            }
                    } else {
                        $(".assign-driver-container").hide();
                    }
                });
                $(".select-all-button").click(function() {
                    let selectedOrders = $(".order-checkbox:checked").length;

                    if (selectedOrders > 0) {
                        $(".assign-driver-container").show();
                        const driverContainer = document.querySelector('.assign-driver-container');
                        if (driverContainer) {
                driverContainer.style.display = 'block'; // Ensure the container is visible
                driverContainer.scrollIntoView({
                    behavior: 'smooth', // Smooth scrolling
                    block: 'start',     // Align to the top of the viewport
                });

                // Scroll up a bit more for better alignment
                const scrollOffset = -800; // Adjust this value as needed
                window.scrollBy({
                    top: scrollOffset,
                    behavior: 'smooth',
                });
            }
                    } else {
                        $(".assign-driver-container").hide();
                    }
                });

                // Handle driver selection and show SweetAlert for confirmation
                $(".assign-driver-button").click(function() {
                    let selectedOrders = [];
                    $(".order-checkbox:checked").each(function() {
                        selectedOrders.push($(this).val()); // Get the order number
                    });

                    let provinceName = $(this).data('province'); // Get the province name
                    let driverName = $("#rdDriverDropdown").val(); // Get the selected RD driver
                    let driverID = $("#rdDriverDropdown option:selected").data('driver-id'); // Get the selected RD driver ID

                    if (selectedOrders.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Orders Selected',
                            text: 'You have not selected any orders. Please select orders first.',
                        });
                        return;
                    }

                    if (!driverName) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Driver Selected',
                            text: 'Please select a driver from the dropdown before assigning.',
                        });
                        return;
                    }

                    // Show SweetAlert for confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are going to assign the following orders: ${selectedOrders.join(", ")} to ${driverName} in province: ${provinceName}.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, assign it!',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Confirmation',
                                text: "Once you confirm, you can't change it.",
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, confirm!',
                                cancelButtonText: 'No, cancel',
                            }).then((finalResult) => {
                                if (finalResult.isConfirmed) {
                                    // Send an AJAX request to assign orders to the RD driver
                                    $.ajax({
                                        url: assignOrdersRoute,
                                        method: 'POST',
                                        data: {
                                            driverName: driverName,
                                            driverID: driverID,
                                            orders: selectedOrders,
                                            province: provinceName,
                                            _token: $('meta[name="csrf-token"]').attr(
                                                'content')
                                        },
                                        success: function(response) {
                                            Swal.fire(
                                                'Success!',
                                                'Orders have been successfully assigned.',
                                                'success'
                                            );
                                        },
                                        error: function(error) {
                                            Swal.fire(
                                                'Error!',
                                                'Something went wrong. Please try again.',
                                                'error'
                                            );
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.province-btn').on('click', function() {
                    // Get the province name from the button's text
                    var selectedProvince = $(this).text().trim();

                    // Find the province section based on the text (province name)
                    var targetElement = $('.province-card').filter(function() {
                        return $(this).data('province') === selectedProvince;
                    });

                    // Check if the target element exists and scroll to it
                    if (targetElement.length) {
                        $('html, body').animate({
                            scrollTop: targetElement.offset().top -
                                20 // Adjust for any fixed header, if necessary
                        }, 1000); // Duration of the scroll
                    } else {
                        console.log('Target province section not found:', selectedProvince);
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                // Initialize Select2
                $('#driverSelect').select2();

                // Event listener for driver selection
                $('#driverSelect').on('change', function() {
                    var selectedDriver = $(this).val(); // Get selected driver name

                    if (selectedDriver) {
                        // Loop through each table row and check the driver
                        $('tr').each(function() {
                            var rowDriver = $(this).data('driver'); // Get driver from data attribute

                            // If the driver in the row matches the selected driver, show the row
                            // Otherwise, hide it
                            if (rowDriver === selectedDriver) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    } else {
                        // If no driver is selected, show all rows
                        $('tr').show();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#provinceFilter').select2(); // Initialize Select2

                // Handle change event
                $('#provinceFilter').on('change', function() {
                    const selectedProvinces = $(this).val(); // Get selected provinces

                    // Show only selected provinces
                    if (selectedProvinces && selectedProvinces.length > 0) {
                        $('.province-card').each(function() {
                            const province = $(this).data('province');
                            if (selectedProvinces.includes(province)) {
                                $(this).show(); // Show the province card
                                // Move the selected province card to the top
                                $('#provinceOrdersContainer').prepend($(this));
                            } else {
                                $(this).hide(); // Hide the province card
                            }
                        });

                        // Check if any selected province has no orders
                        selectedProvinces.forEach(function(province) {
                            const provinceCard = $(`.province-card[data-province="${province}"]`);
                            if (provinceCard.length === 0) {
                                // Add a temporary card for provinces with no orders
                                const noOrdersCard = `
                    <div class="col-lg-12 d-flex align-items-stretch province-card temp-no-order" data-province="${province}">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h4 class="card-title" style="font-weight:600">Province:
                                        <span style="color:rgb(238, 19, 19)">${province}</span>
                                    </h4>
                                </div>
                                <p class="text-center text-muted">No packages assigned under this province.</p>
                            </div>
                        </div>
                    </div>
                    `;
                                $('#provinceOrdersContainer').prepend(noOrdersCard);
                            }
                        });
                    } else {
                        // If no province is selected, show all cards
                        $('.province-card').show();
                        // Remove temporary cards
                        $('.temp-no-order').remove();
                    }
                });
            });
        </script>
        <script>
            const paymentDetailsRoute = "{{ route('get.payment.details', ':id') }}";
        </script>
        <script>
            // Pass the URL to JavaScript
            var collectPaymentUrl = "{{ route('user.collect_payment', ['order_pickup_id' => '__order_pickup_id__']) }}";
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const paymentModal = document.getElementById('paymentStatusModal');

                paymentModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const orderPickupId = button.getAttribute(
                        'data-order-pickup-id'); // Extract order_pickup_id

                    // Replace :id in the route URL with the actual order_pickup_id
                    const url = paymentDetailsRoute.replace(':id', orderPickupId);

                    // Fetch data and update modal
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            document.querySelector('#paymentStatusModal .modal-body').innerHTML = `
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th class="text-info text-center">Label</th>
                        <th class="text-info text-center">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-primary text-center">Total Amount</td>
                        <td class="text-center">
                           <span class="bg-primary text-white px-2 py-1 rounded">${data.total_amount.toFixed(2)}</span>
                        </td>
                    </tr>
                    ${data.deposits.map((deposit, index) => `
                                                            <tr>
                                                                <td class="text-primary text-center">Deposit ${index + 1}</td>
                                                                <td class="text-center">
                                                                    <span class="bg-success text-white px-2 py-1  mt-4 rounded">Amount: ${deposit.amount}</span><br><br>
                                                                    <span class="bg-warning text-white px-2 py-1 mt-4 rounded">Method: ${deposit.method}</span>
                                                                </td>
                                                            </tr>
                                                        `).join('')}
                    <tr>
                        <td class="text-primary text-center">Amount Due</td>
                        <td class="text-center">
                            <span class="bg-danger text-white px-2 py-1 rounded">${data.amount_due.toFixed(2)}</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-primary text-center">Payment Status</td>
                        <td class="text-center">
                            <span class="bg-${data.is_paid ? 'success' : 'danger'} text-white px-2 py-1 rounded">${data.payment_status}</span>
                        </td>
                    </tr>
                    ${data.amount_due > 0 ? `
                                                            <tr>
                                                                <td class="text-primary text-center align-middle fw-bold">Collect Due Payment</td>
                                                                <td class="text-center align-middle">
                                                                    <button type="button" class="btn rounded-pill px-4"
                                                                        style="background-color: red; color: white; font-weight: bold; font-size: 1.25rem; padding: 10px 20px;"
                                                                        onclick="window.location.href='${collectPaymentUrl.replace('__order_pickup_id__', data.order_pickup_id)}'">
                                                                        Click Here
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        ` : ''}
                </tbody>
            </table>
        </div>
    `;
                        })
                        .catch(error => console.error('Error fetching payment details:', error));
                });
            });
        </script>
        <script>
            $(document).on('click', '#closeNoteModal', function() {
                $('#notesModal').modal('hide'); // Close the modal
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $(document).on('click', '.open-modal-btn', function() {


                    var orderNumber = $(this).data('order-number'); // Extract order number
                    var url = $(this).data('url'); // Extract the URL from the button
                    // Fetch notes using AJAX
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            var content = '';

                            if (data.length > 0) {
                                content += '<table class="table">';
                                content +=
                                    '<thead><tr><th>Note</th><th>Added By </th></tr></thead><tbody>';

                                data.forEach(function(note) {
                                    content += '<tr>';
                                    content += '<td>' + note.add_note + '</td>';

                                    if (note.driver) {
                                        let driverType = '';
                                        switch (note.driver.type) {
                                            case 1:
                                                driverType = 'RD Driver - ';
                                                break;
                                            case 2:
                                                driverType = 'Manager - ';
                                                break;
                                            case 0:
                                                driverType = 'Admin - ';
                                                break;
                                            default:
                                                driverType = '';
                                        }
                                        content += '<td>' + driverType + note.driver.name +
                                            '</td>';
                                    } else {
                                        content += '<td>N/A</td>';
                                    }

                                    content += '</tr>';
                                });

                                content += '</tbody></table>';
                            } else {
                                content = '<p>No notes found for this order.</p>';
                            }

                            $('#modalNotesContent').html(content);
                        },
                        error: function() {
                            $('#modalNotesContent').html(
                                '<p>An error occurred while fetching notes.</p>');
                        }
                    });
                    // Open the modal
                    $('#notesModal').modal('show');
                });
            });
        </script>
    @endpush
