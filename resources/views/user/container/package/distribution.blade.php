@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
       .square-badge, .square-button {
    width: 61px !important;
    height: 61px !important;
       }
    </style>
    <div class="container-fluid">
        <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center" id="containerInfo">
            <div>
                {{-- <h4 class="mb-0">Package Distributors In Dom Rep.</h4> --}}
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mb-4">
                <div>
                    <h4 class="card-title" style="font-weight:500; font-size:25px; text-align:center">
                        <span style="color:rgb(20, 67, 82)">
                            DOMINICAN REPUBLIC PACKAGERS DISTRIBUTION CENTER BY CONTAINER AND PROVINCES
                        </span>
                    </h4>
                </div>
            </div>

            <!-- Notes in the top-right corner -->


            <div class="row">
                <div class="container mt-4">
                    <div class="row">

                        <!-- Box 1 -->
                        {{-- <div class="col-md-6 col-lg-2 mb-4">
                            <div class="card" style="min-height:200px">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">CONTAINER # :</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">
                                        {{ config('global.currentContainerNumber') }}</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-4 col-md-6 h-100">
                            <div class="card border-bottom border-danger">
                              <div class="card-body">
                                <div class="d-flex  align-items-center">
                                  <div>
                                    <h2 class="fs-7">{{ config('global.currentContainerNumber') }}</h2>
                                    <p class="  mb-0" style="font-weight:600;color:rgb(73, 7, 7)">CONTAINER #</p>
                                  </div>
                                  <div class="ms-auto">
                                    <span class="text-danger display-6">
                                        <i class="ti ti-package"></i>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @php
                            $total_orders = App\Models\OrderPickUp::where(
                                'container_number',
                                config('global.currentContainerNumber'),
                            )->count();

                            $assigned_orders = App\Models\AssignedOrderToDriver::whereHas('orderPickup', function (
                                $query
                            ) {
                                $query->where('container_number', config('global.currentContainerNumber'));
                            })->count();

                            $unassigned_orders = $total_orders - $assigned_orders;

                            $delivered_orders = App\Models\OrderPickUp::where(
                                'container_number',
                                config('global.currentContainerNumber'),
                            )
                                ->where('package_status', 'delivered')
                                ->count();
                        @endphp
                        <!-- Box 2 -->
                        {{-- <div class="col-md-6 col-lg-2 mb-4 h-100" >
                            <div class="card d-flex flex-column h-100" style="min-height:200px">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">TOTAL ORDERS:</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">{{ $total_orders }}</p>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-4 col-md-6 h-100">
                            <div class="card border-bottom border-primary">
                              <div class="card-body">
                                <div class="d-flex  align-items-center">
                                  <div>
                                    <h2 class="fs-7">{{ $total_orders }}</h2>
                                    <p class="fw-medium  mb-0" style="font-weight:700;color:rgb(8, 7, 73)">TOTAL ORDERS</p>
                                  </div>
                                  <div class="ms-auto">
                                    <span class="text-primary display-6">
                                        <i class="ti ti-truck"></i>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-6 h-100">
                            <div class="card border-bottom border-primary"  style="border-color: green!important">
                              <div class="card-body">
                                <div class="d-flex  align-items-center">
                                  <div>
                                    <h2 class="fs-7">{{ $delivered_orders }}</h2>
                                    <p class=" mb-0"  style="font-weight:600;color:rgb(8, 105, 8)">TOTAL DELIVERED</p>
                                  </div>
                                  <div class="ms-auto">
                                    <span class="display-6"  style="font-weight:600;color:rgb(8, 105, 8)">
                                        <i class="ti ti-check"></i>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <div class="col-lg-6 col-md-6 h-100">
                            <div class="card border-bottom border-warning" style="border-color: rgb(59, 235, 59)!important">
                              <div class="card-body">
                                <div class="d-flex  align-items-center">
                                  <div>
                                    <h2 class="fs-7">{{ $assigned_orders }}</h2>
                                    <p class="fw-medium text-primary mb-0" style="color: rgb(6, 150, 6)!important">TOTAL ORDERS ASSIGNED</p>
                                  </div>
                                  <div class="ms-auto">
                                    <span class="text-primary display-6">
                                        <a href="{{ route('user.orders.assigned') }}" class="btn btn-primary square-button "
                                        style="background-color:rgb(44, 167, 44); font-weight: 600;">
                                         <i class="fa fa-box-open"></i> View
                                     </a>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        {{-- <div class="col-md-6 col-lg-3 mb-4 h-100">
                            <div class="card d-flex flex-column h-100" style="min-height:200px">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">TOTAL UNASSIGNED ORDERS:</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">{{ $unassigned_orders }}</p>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-6 col-md-6 h-100">
                            <div class="card border-bottom border-primary"  style="border-color: rgb(250, 90, 90)!important">
                              <div class="card-body">
                                <div class="d-flex  align-items-center">
                                  <div>
                                    <h2 class="fs-7">{{ $unassigned_orders }}</h2>
                                    <p class="fw-medium  mb-0"  style="color: rgb(238, 28, 28)!important">TOTAL UNASSIGNED ORDERS</p>
                                  </div>
                                  <div class="ms-auto">
                                    <span class="text-danger display-6" >
                                        <i class="ti ti-clipboard-x"></i>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        <!-- Add more boxes as needed -->
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="position-relative mb-5">
                                        <div class="d-flex justify-content-between w-100">
                                            <div></div> <!-- This div helps center the content if needed -->
                                            <div class="d-flex align-items-center"
                                                style="position: absolute; top: 0; right: 0;">
                                                <img src="{{ asset('admin/assets/images/notes.jpg') }}" alt="Notes"
                                                    style="width: 30px; height: 30px; border-radius: 50%; margin-right: 8px;">
                                                <span style="font-size: 18px; font-weight: 500; color:black;">NOTES: <span
                                                        style="color:red">{{ $notesCount }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinceFilter" style="font-weight:600">Select Province</label>
                                        <select id="provinceFilter" class="select2 form-control" multiple="multiple"
                                            style="height: 36px; width: 100%">

                                            <optgroup label="Provinces">
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="driverSelect" style="font-weight:600">Assign To : <i
                                                class="fas fa-truck"></i> </label>
                                        <select id="driverSelect" class="select2 form-control custom-select"
                                            style="width: 100%; height: 36px">
                                            <option value="">Select</option> <!-- Ensure empty value for default -->
                                            <optgroup label="Drivers">
                                                @foreach ($dominicanTeamDrivers as $driver)
                                                    <option value="{{ $driver->user->name }}"
                                                        data-driver-id="{{ $driver->user->id }}">{{ $driver->user->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="assignedProvince" style="font-weight:600">Assigned Province - ORDER
                                            QUANTITY</label>
                                        <br />
                                        @foreach ($groupedOrders as $province => $orders)
                                            <button type="button" class="btn btn-outline-primary province-btn mb-2"
                                                data-target="#province-{{ Str::slug($province) }}">
                                                {{ $province }} - {{ count($orders) }}
                                            </button>
                                        @endforeach
                                    </div>

                                    <div class="assign-driver-container mt-5 mb-2" style="display:none;">
                                        <hr />
                                        <select id="rdDriverDropdown" class="form-control">
                                            <option value="">Select RD Driver</option>
                                            @foreach ($dominicanTeamDrivers as $driver)
                                                <option value="{{ $driver->user->name }}"
                                                    data-driver-id="{{ $driver->user->id }}">
                                                    {{ $driver->user->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="button" class="btn btn-primary mt-2 assign-driver-button"
                                            data-province="{{ $province }}">
                                            Assign New Order to RD Driver
                                        </button>
                                        <hr />

                                    </div>


                                </div>



                            </div>
                        </div>

                        <div id="provinceOrdersContainer">

                            @foreach ($groupedOrders as $province => $orders)
                                @php
                                    $provinceId = uniqid();
                                @endphp
                                <div class="province-card"
                                    data-province="{{ $province }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <h4 class="card-title" style="font-weight:600">Province:
                                                    <span style="color:rgb(238, 19, 19)">{{ $province }}</span>
                                                </h4>
                                            </div>

                                            @if ($orders->isEmpty())
                                                <p class="text-center text-muted">No packages assigned under this province.
                                                </p>
                                            @else
                                                @include('admin.pages.distribution_table', [
                                                    'orders' => $orders,
                                                    'provinceId' => $provinceId,
                                                    'provinceName' => $province,
                                                ])
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
                    button.addEventListener('click', function() {
                        let ordersWithAssignedDriver = [];
                        const province = this.dataset
                        .province; // Get the province from the clicked button
                        console.log("Selected Province: ", province); // Debugging line

                        // Select only the checkboxes where the order's province matches the selected province
                        const checkboxes = document.querySelectorAll('.order-checkbox');
                        checkboxes.forEach(checkbox => {
                            // Get the province text from the order's row
                            const provinceElement = checkbox.closest('tr').querySelector(
                                'small.text-muted i');
                            if (provinceElement) {
                                const orderProvince =
                                    provinceElement.nextSibling?.nodeType === Node.TEXT_NODE ?
                                    provinceElement.nextSibling.textContent.trim() :
                                    null;

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
                                block: 'start', // Align to the top of the viewport
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
                                block: 'start', // Align to the top of the viewport
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
                    let driverID = $("#rdDriverDropdown option:selected").data(
                    'driver-id'); // Get the selected RD driver ID

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
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Orders have been successfully assigned.',
                                                icon: 'success'
                                            }).then(() => {
                                                // Reload the page after the user closes the alert
                                                window.location.reload();
                                            });
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
