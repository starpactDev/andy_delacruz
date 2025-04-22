@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .paid-badge {
            display: inline-block;
            /* Ensures the span respects width */
            width: 80px;
            /* Set a consistent width */
            text-align: center;
            /* Center-align the text */
        }

        .process-flow {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            position: relative;
        }

        .step {
            flex: 1;
            position: relative;
            padding: 20px 10px;
            margin: 0 5px;
            color: white;
            clip-path: polygon(0% 0%, 95% 0%, 100% 50%, 95% 100%, 0% 100%, 5% 50%);
            font-size: 12px;
        }

        .step:first-child {
            margin-left: 0;
            border-radius: 10px 0 0 10px;
        }

        .step:last-child {
            margin-right: 0;
            border-radius: 0 10px 10px 0;
        }

        .packing.active {
            background-color: #8cc63f;
        }

        .shipped.active {
            background-color: #3ba741;
        }

        .customs.active {
            background-color: #00adef;
        }

        .review.active {
            background-color: #8e44ad;
        }

        .distribution.active {
            background-color: #f39c12;
        }

        .ready.active {
            background-color: #e74c3c;
        }

        .delivered.active {
            background-color: #3498db;
        }

        .default {
            background-color: rgba(255, 255, 255, 0.5);
            /* hazy white background */
            color: rgba(0, 0, 0, 0.5);
            /* hazy black text */
        }
    </style>
    <style>
        .no-block {
            min-height: 75px !important;
        }

        .tablesaw-cell-label {
            display: none;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            min-width: 600px;
            /* Ensure a minimum width to force scrolling */

        }

        .table th,
        .table td {
            padding: 8px 12px;

        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <style>
        .shipment-badge {


            width: 150px;
            /* Adjust width to your needs */

        }

        .fa-stack {
            display: inline-block;
            position: relative;
            width: 2em;
            height: 2em;
            line-height: 2em;
        }

        .fa-stack-1x {
            position: absolute;
            left: 0;
            top: 0;
        }

        .fa-file {
            font-size: 1.2em;
        }

        .fa-check {
            font-size: 0.8em;
            /* Smaller size for checkmark */
            position: absolute;
            top: 0.5em;
            /* Adjust position as needed */
            right: 0.5em;
            /* Adjust position as needed */
            color: skyblue;
            /* Color set to sky blue */
        }
    </style>
    <style>
        /* Change the dropdown box appearance */
        .ui-autocomplete {
            background-color: #f9f9f9;
            /* Light background */
            border: 1px solid #ddd;
            /* Border color */
            border-radius: 5px;
            /* Rounded corners */
            max-height: 200px;
            /* Limit the height of the dropdown */
            overflow-y: auto;
            /* Add a scrollbar for long lists */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            z-index: 1050;
            /* Ensure it appears above other elements */
        }

        /* Style the items in the dropdown */
        .ui-menu-item {
            padding: 10px;
            /* Add some padding */
            cursor: pointer;
            /* Pointer cursor for hover */
        }

        /* Highlighted item (when hovered or selected) */
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="card text-white" style="background-color: rgb(24, 177, 24)">
                    <div class="card-body">
                        <a href="JavaScript: void(0);">
                            <div class="d-flex no-block align-items-center">
                                <i class="mdi mdi-truck display-6 text-white" title="LTC"></i>
                                <div class="ms-3 mt-2">
                                    <h4 class="font-weight-medium mb-0 text-white">ACTING CONTAINER</h4>
                                    <h5 class="text-white" id="epg-value">{{ config('global.currentContainerNumber') }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>

            <div class="col-lg-5 col-md-6">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <a href="JavaScript: void(0);" id="increment-btn">
                            <div class="d-flex no-block align-items-center">
                                <i class="mdi mdi-lock display-6 text-white" title="ETH"></i>
                                <div class="ms-3 mt-2">
                                    <h4 class="font-weight-medium mb-0 text-white">CLOSE CONTAINER</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 mb-5">
            <div class="input-group" style="height: 50px;">
                <span class="input-group-text">
                    <i data-feather="search" class="feather-sm fill-white"></i>
                </span>
                <input type="text" class="form-control" id="container-search" placeholder="Search by Container Number"
                    aria-label="ContainerSearch" aria-describedby="basic-addon1">
                <button id="search-button" class="btn btn-primary" type="button" style="margin-left: 5px;">
                    Search
                </button>
            </div>
        </div>
        <div class="col-lg-12 mb-4 ">
            <div class="d-flex justify-content-center">
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(50, 175, 33)">
                        CONTAINER ORDERS :</span>

                    <span id="selected-container-number" style="color:rgb(40, 99, 32)">
                        {{ config('global.currentContainerNumber') }}
                    </span>
                </h4>

            </div>
            <div class="row mt-3">
                <div class="col-lg-12 mb-4 ">
                    <div class="process-flow">
                        <div class="step packing default">PACK</div>
                        <div class="step shipped default">SHIP</div>
                        <div class="step customs default">CUSTOMS</div>
                        <div class="step review default">CUSTOMS REVIEW</div>
                        <div class="step distribution default">IN DISTRIBUTION</div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 mb-4 ">
                            <h4 class="card-title"><span style="color:rgb(48, 37, 153);font-weight:600"> Update
                                    Shipping Status</span>
                            </h4>
                            <h6 class="card-subtitle lh-base">
                                Seamless Shipping Updates, Every Step of the Way
                            </h6>
                            <select id="step-select" class="select2 form-control custom-select"
                                style="width: 100%; height: 36px">
                                <option value="">Select Step</option>
                                <optgroup label="Steps">
                                    <option value="PACK">PACK</option>
                                    <option value="SHIP">SHIP</option>
                                    <option value="CUSTOMS">CUSTOMS</option>
                                    <option value="CUSTOMS REVIEW">CUSTOMS REVIEW</option>
                                    <option value="IN DISTRIBUTION">IN DISTRIBUTION</option>
                                </optgroup>
                            </select>

                            <!-- Button to show selected value -->
                            <div class="text-center mt-3">
                                <button id="showSelectedStep" class="btn btn-primary">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.pages.table6')
                <div class="modal fade" id="paymentStatusModal" tabindex="-1" aria-labelledby="paymentStatusModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentStatusModalLabel">Payment Status</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            </div>

        </div>
    @endsection
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const orderSearchInput = document.getElementById('orderSearch');
                const tableBody = document.querySelector('tbody');

                // Listen for input in the search field
                orderSearchInput.addEventListener('input', function() {
                    const searchTerm = orderSearchInput.value.toLowerCase().trim();
                    console.log(searchTerm);
                    // Get all rows from the table
                    const rows = tableBody.querySelectorAll('tr');
                    rows.forEach(row => {
                        const orderId = row.querySelector('td:first-child').textContent.trim()
                            .toLowerCase();

                        // If the order id matches the search term, display the row; otherwise, hide it
                        if (orderId.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });
        </script>
        <script>
            document.getElementById('increment-btn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to close the container?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, close it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let epgValue = document.getElementById('epg-value');
                        console.log(epgValue);

                        let textContent = epgValue.textContent.trim(); // Remove any extra whitespace
                        console.log(textContent);

                        // Extract numeric part using a regular expression
                        let numericPart = textContent.match(/\d+/); // Matches digits in the text
                        let currentValue = numericPart ? parseInt(numericPart[0]) :
                            NaN; // Parse the first match or set to NaN if no match
                        console.log(currentValue);
                        // Dynamically generate the route URL
                        fetch('{{ route('user.container.update') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    currentNumber: currentValue + 1
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Closed!',
                                        'The container has been closed.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to update the container number.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire(
                                    'Error!',
                                    'An unexpected error occurred.',
                                    'error'
                                );
                            });
                    }
                });
            });
        </script>
        <script>
            const getStatusUrl = "{{ route('user.get.container.status') }}";
        </script>
        <script>
            $(document).ready(function() {
                // Initialize select2
                $('.select2').select2();

                // Define the mapping between database values and CSS classes
                const stepMapping = {
                    "PACK": "packing",
                    "SHIP": "shipped",
                    "CUSTOMS": "customs",
                    "CUSTOMS REVIEW": "review",
                    "IN DISTRIBUTION": "distribution",
                };

                // Function to update the progress bar
                function updateProgressBar(status) {
                    const steps = ["packing", "shipped", "customs", "review", "distribution"];
                    const mappedClass = stepMapping[status];

                    // Reset all steps to default state
                    $('.step').removeClass('active').addClass('default');
                    console.log(status);
                    // If status is null or doesn't map, do not activate any steps
                    if (status === null || !mappedClass) {

                        console.log("Status is null or unrecognized. No steps will be activated.");
                        return;
                    }

                    // Activate all steps up to the current one
                    for (let i = 0; i <= steps.indexOf(mappedClass); i++) {
                        $('.' + steps[i]).removeClass('default').addClass('active');
                    }
                }

                // Fetch and update progress bar when container number changes
                function fetchAndSetStatus(containerNumber) {
                    if (!containerNumber) {
                        console.error("Container number is missing!");
                        return;
                    }
                    $.ajax({
                        url: getStatusUrl, // Use the route name-generated URL
                        type: "GET",
                        data: {
                            container_number: containerNumber
                        },
                        success: function(response) {
                            if (response.status) {
                                updateProgressBar(response.status);
                            } else {
                                console.error("Invalid status received:", response);
                                updateProgressBar(null);
                            }
                        },
                        error: function() {
                            alert("Failed to fetch container status.");
                        },
                    });
                }

                // Monitor changes in the container number and trigger fetch
                const containerNumberSpan = document.querySelector('h4 span:nth-child(2)');
                let currentContainerNumber = containerNumberSpan ? containerNumberSpan.textContent.trim() : null;

                // Initial fetch on page load
                if (currentContainerNumber) {
                    fetchAndSetStatus(currentContainerNumber);
                }

                // Observe changes to the container number span
                const observer = new MutationObserver(() => {
                    const newContainerNumber = containerNumberSpan.textContent.trim();
                    if (newContainerNumber !== currentContainerNumber) {
                        currentContainerNumber = newContainerNumber;
                        fetchAndSetStatus(currentContainerNumber); // Fetch status on change
                    }
                });

                // Start observing the container number span for text changes
                if (containerNumberSpan) {
                    observer.observe(containerNumberSpan, {
                        characterData: true,
                        subtree: true
                    });
                }

                // Update progress bar when dropdown value changes
                $('#step-select').change(function() {
                    const selectedValue = $(this).find(":selected").text()
                        .trim(); // Get the selected option's text
                    updateProgressBar(selectedValue);
                });
            });
        </script>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 CDN -->
        <script>
            var hideMoveOrderButton = @json($hideMoveOrderButton);
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const containerNumberSpan = document.querySelector(
                    'h4 span:nth-child(2)'); // Select the container number span

                // Function to fetch and populate order details
                function fetchOrderDetails(containerNumber) {
                    // Show loading SweetAlert
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Fetching order details, please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Display the loading spinner
                        }
                    });

                    // Fetch order details for the specified container number
                    fetch(`{{ route('user.get.orders') }}?container_number=${containerNumber}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Ensure CSRF protection
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close(); // Close the SweetAlert
                            if (data.success) {
                                populateTable(data.orderDetails);
                            } else {
                                Swal.fire('Error', data.message || 'Failed to fetch order details.', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire('Error', 'An unexpected error occurred while fetching order details.',
                                'error');
                            console.error('Unexpected error:', error);
                        });
                }

                // Listen for changes to the container number span
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(mutation => {
                        if (mutation.type === 'characterData' || mutation.type === 'childList') {
                            const newContainerNumber = containerNumberSpan.textContent.trim();
                            fetchOrderDetails(
                                newContainerNumber); // Fetch orders for the updated container number
                        }
                    });
                });

                // Observe changes to the container number span
                observer.observe(containerNumberSpan, {
                    childList: true,
                    characterData: true
                });

                // Fetch order details initially for the existing container number
                const initialContainerNumber = containerNumberSpan.textContent.trim();
                fetchOrderDetails(initialContainerNumber);
            });
            let heldByCustomsOrders = [];
            // Function to populate the table with fetched data (no change)
            function populateTable(orderDetails) {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = ''; // Clear the table body
                heldByCustomsOrders = [];
                if (orderDetails.length === 0) {
                    tbody.innerHTML = `<tr>
            <td colspan="8" class="text-center fw-bold" style="color:red">No orders found in this container</td>
        </tr>`;
                    return;
                }

                orderDetails.forEach(order => {

                    if (order.package_status === "HELD BY CUSTOMS") {
                        heldByCustomsOrders.push(order.order_number);
                    }
                    const routeUrl = `{{ route('user.order_overview', ':id') }}`.replace(':id', order.id);
                    const row = document.createElement('tr');
                    const dueAmount = order.grand_total_amount - order.amount_paid;
                    row.innerHTML = `
            <td><h6 class="font-weight-medium mb-0">${order.order_number}</h6></td>
            <td><h6 class="font-weight-medium mb-0">${order.container_number}</h6></td>
            <td><h6 class="font-weight-medium mb-0">${order.sender?.first_name ?? ''} ${order.sender?.last_name ?? ''}</h6></td>
            <td>
                <button type="button" class="btn btn-sm btn-light-success text-primary custom-size" data-bs-toggle="modal" data-bs-target="#paymentStatusModal" data-order-pickup-id="${order.id}">
                    <i data-feather="dollar-sign" class="feather-sm"></i> View
                </button>
            </td>
            <td>
                <button type="button"
                    class="shipment-badge badge bg-success" style="background-color: rgb(0, 204, 102)!important; text-decoration: none;border:none;" onclick="window.location.href='${routeUrl}'">
                    <span class="fa-stack" style="margin-right:5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package feather-sm"><path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path><polyline points="2.32 6.16 12 11 21.68 6.16"></polyline><line x1="12" y1="22.76" x2="12" y2="11"></line><line x1="7" y1="3.5" x2="17" y2="8.5"></line></svg>
                    </span> View
                </button>
            </td>
            <td>
                ${
                    dueAmount === 0
                        ? `<span class="paid-badge badge bg-success px-2 py-2" style="background-color: rgb(26, 35, 120)!important;">PAID</span>`
                        : `<span class="paid-badge badge bg-danger px-2 py-2">$${dueAmount.toFixed(2)}</span>`
                }
            </td>
            <td>${getOrderStatusBadge(order.package_status)}</td>
          ${
    hideMoveOrderButton
        ? ''
        : `<td style="display: flex; gap: 35px; align-items: center;">
                                        ${
                                            order.package_status === "DELIVERED"
                                                ? `<span class="text-danger fw-bold">Already Delivered - Nothing Can Change</span>`
                                                : `
                            <button type="button"
                                class="moveOrderButton shipment-badge badge bg-success"
                                style="background-color: rgb(255, 165, 0)!important;
                                       text-decoration: none;
                                       border: none;
                                       padding: 10px 20px;
                                       font-size: 14px;
                                       border-radius: 5px;
                                       white-space: normal;
                                        display: flex;
                                        align-items: center;
                                     justify-content: center;
                                       height: 75px;
               width: 250px;
                                       word-wrap: break-word;"
                                data-order-id="${order.order_number}">
                                MOVE ORDER TO THE NEXT CONTAINER
                            </button>
                            ${
                                order.package_status === "HELD BY CUSTOMS"
                                    ? `<button type="button"
                                                                class="updateDistributionButton shipment-badge badge bg-primary"
                                                                style="background-color: #007bff!important; /* Blue color */
                                                                       text-decoration: none;
                                                                       border: none;
                                                                       padding: 10px 20px;
                                                                       font-size: 14px;
                                                                       border-radius: 5px;
                  display: flex;
                                                        align-items: center;
                                                     justify-content: center;
                                                       height: 75px;
                               width: 250px;
                                                                       white-space: normal;
                                                                       word-wrap: break-word;"
                                                                data-order-id="${order.order_number}">
                                                                UPDATE THE ORDER STATUS AS DISTRIBUTION
                                                            </button>`
                                    : `<button type="button"
                                                                class="heldCustomButton shipment-badge badge bg-success"
                                                                style="background-color: #df0c0c!important;
                                                                       text-decoration: none;
                                                                       border: none;
                                                                       padding: 10px 20px;
                  display: flex;
                                                        align-items: center;
                                                     justify-content: center;
                                                      height: 75px;
                               width: 250px;
                                                                       font-size: 14px;
                                                                       border-radius: 5px;
                                                                       white-space: normal;
                                                                       word-wrap: break-word;"
                                                                data-order-id="${order.order_number}">
                                                                MOVE ORDER TO HELD BY CUSTOMS
                                                            </button>`
                            }
                        `
                                        }
                                    </td>`
            }
        `;
                    tbody.appendChild(row);
                });
            }

            // Helper function to get the badge for the order status (no change)
            function getOrderStatusBadge(status) {
                console.log(status);
                const statuses = {
                    'PACK': '<span class="shipment-badge badge bg-success" style="background-color: rgb(19, 190, 202)!important"><span class="fa-stack" style="margin-right:5px;"><i class="fas fa-hand-holding fa-stack-1x"></i><i class="fas fa-box fa-stack-1x" style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i></span> PACK</span>',
                    'SHIP': '<span class="shipment-badge badge bg-info px-2 py-2" style="background-color: rgb(27, 188, 157)!important;"><i class="fas fa-paper-plane" style="margin-right:8px;margin-left:5px"></i>SHIP</span>',
                    'CUSTOMS': '<span class="shipment-badge badge bg-info px-2 py-2"><i class="fas fa-box" style="margin-right:7px;margin-left:5px"></i> CUSTOMS</span>',
                    'CUSTOMS REVIEW': '<span class="shipment-badge badge bg-info px-2 py-2"><i class="fa fa-star" style="margin-right:7px;margin-left:5px"></i> CUSTOMS REVIEW</span>',
                    'IN DISTRIBUTION': '<span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(4, 131, 164)!important;"><i class="fas fa-map-marker-alt" style="margin-right:6px;margin-left:5px"></i> DISTRIBUTION</span>',
                    'HELD BY CUSTOMS': '<span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(164, 4, 19)!important;"><i class="fas fa-pause-circle" style="margin-right:6px;margin-left:5px"></i> HELD BY CUSTOMS</span>',
                    'DELIVERED': '<span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(18, 182, 72)!important;"><i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED</span>'
                };
                return statuses[status] ||
                    '<span class="shipment-badge badge bg-secondary px-2 py-2" style="background-color: rgb(104, 21, 104)!important;"> ORDER CREATED</span>';
            }
        </script>
        <script>
            const moveOrderRoute = @json(route('user.move.order'));
            const moveOrderRouteToHeldByCustom = @json(route('user.move.order_status_to_held_by_custom'));
            const moveOrderRouteToDistribution = @json(route('user.move.order_status_to_distribution'));
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('tbody').addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('moveOrderButton')) {
                        const orderNumber = e.target.getAttribute('data-order-id');
                        console.log("Button clicked, Order Number: ", orderNumber);

                        // Show SweetAlert confirmation dialog
                        Swal.fire({
                            title: 'Are you sure you want to move this order?',
                            text: `Order Number: ${orderNumber}. Once done, this action cannot be undone.`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, move it!',
                            cancelButtonText: 'No, cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Fetch the Laravel route dynamically


                                // Proceed with moving the order
                                Swal.fire('Moving Order...',
                                    'Please wait while we process your request.', 'info');

                                fetch(moveOrderRoute, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            order_number: orderNumber
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: 'Success',
                                                text: data.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                // Reload the page
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire('Error', data.message || 'An error occurred',
                                                'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error',
                                            'An error occurred while processing your request.',
                                            'error');
                                    });
                            } else {
                                Swal.fire('Cancelled', 'The order was not moved.', 'info');
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('tbody').addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('heldCustomButton')) {
                        const orderNumber = e.target.getAttribute('data-order-id');
                        console.log("Button clicked, Order Number: ", orderNumber);

                        // Show SweetAlert confirmation dialog
                        Swal.fire({
                            title: 'Are you sure you want to move this order status as held by custom?',
                            text: `Order Number: ${orderNumber}. Once done, this action cannot be undone.`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, move it!',
                            cancelButtonText: 'No, cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Fetch the Laravel route dynamically


                                // Proceed with moving the order
                                Swal.fire('Moving Order...',
                                    'Please wait while we process your request.', 'info');

                                fetch(moveOrderRouteToHeldByCustom, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            order_number: orderNumber
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: 'Success',
                                                text: data.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                // Reload the page
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire('Error', data.message || 'An error occurred',
                                                'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error',
                                            'An error occurred while processing your request.',
                                            'error');
                                    });
                            } else {
                                Swal.fire('Cancelled', 'The order was not moved to held by custom.',
                                    'info');
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('tbody').addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('updateDistributionButton')) {
                        const orderNumber = e.target.getAttribute('data-order-id');
                        console.log("Button clicked, Order Number: ", orderNumber);

                        // Show SweetAlert confirmation dialog
                        Swal.fire({
                            title: 'Are you sure you want to move this order status as distribution?',
                            text: `Order Number: ${orderNumber}. Once done, this action cannot be undone.`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, move it!',
                            cancelButtonText: 'No, cancel',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Fetch the Laravel route dynamically


                                // Proceed with moving the order
                                Swal.fire('Moving Order...',
                                    'Please wait while we process your request.', 'info');

                                fetch(moveOrderRouteToDistribution, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        },
                                        body: JSON.stringify({
                                            order_number: orderNumber
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                title: 'Success',
                                                text: data.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                // Reload the page
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire('Error', data.message || 'An error occurred',
                                                'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error',
                                            'An error occurred while processing your request.',
                                            'error');
                                    });
                            } else {
                                Swal.fire('Cancelled', 'The order was not moved to distribution.',
                                    'info');
                            }
                        });
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
            $(document).ready(function() {
                // Initialize Select2
                $('.select2').select2();

                $('#showSelectedStep').click(function() {
                    // Get the selected option's text
                    const containerNumberSpan = document.querySelector(
                        'h4 span:nth-child(2)'); // Select the container number span
                    const containerNumber = containerNumberSpan.textContent
                        .trim(); // Extract the container number

                    // Get the selected option's text
                    var selectedText = $('#step-select option:selected').text();
                    console.log(selectedText);
                    if (selectedText && selectedText !== 'Select Step') {
                        if (selectedText === 'IN DISTRIBUTION' && heldByCustomsOrders.length > 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cannot Proceed',
                                html: `
                The following orders are currently <b>HELD BY CUSTOMS</b>:<br>
                <ul style="text-align: left;">
                    ${heldByCustomsOrders.map(order => `<li>${order}</li>`).join('')}
                </ul>
                Please update them to "IN DISTRIBUTION" first before proceeding.`,
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        // If hideOrderButton is false, ask for confirmation
                        if (selectedText === 'IN DISTRIBUTION' && !hideMoveOrderButton) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Are you sure?',
                                text: 'Are you sure you want to start the container shipping process? You will not be able to move any orders to the next container.',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, start shipping',
                                cancelButtonText: 'No, cancel'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Continue with the existing operation
                                    continueWithExistingOperation(containerNumber, selectedText);
                                }
                            });
                        } else {
                            // If hideOrderButton is true, just continue with the existing operation
                            continueWithExistingOperation(containerNumber, selectedText);
                        }
                    } else {
                        // Show SweetAlert if no option is selected
                        Swal.fire({
                            icon: 'warning',
                            title: 'No Step Selected',
                            text: 'Please select a step first.',
                            confirmButtonText: 'OK'
                        });
                    }
                });

                function continueWithExistingOperation(containerNumber, selectedText) {
                    // Use SweetAlert to display the selected step
                    Swal.fire({
                        icon: 'success',
                        title: 'Selected Step',
                        text: selectedText, // Display the selected step in the message
                        confirmButtonText: 'OK'
                    });

                    // Now send this information to the backend to update the package status
                    $.ajax({
                        url: '{{ route('user.update.package.status') }}', // Use the named route for the URL
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Include CSRF token for security
                            container_number: containerNumber,
                            selected_step: selectedText
                        },
                        success: function(response) {
                            // Show success SweetAlert after status update
                            Swal.fire({
                                icon: 'success',
                                title: 'Package Status Updated',
                                text: 'The status has been successfully updated.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                // Check if the user clicked "OK" on the SweetAlert
                                if (result.isConfirmed) {
                                    // Reload the page
                                    location.reload();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            // Show error SweetAlert if something goes wrong
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while updating the status.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

            });
        </script>
        <script>
            // Initialize select2
            $('.select2').select2();

            // Define the mapping between database values and CSS classes
            const stepMapping = {
                "PACK": "packing",
                "SHIP": "shipped",
                "CUSTOMS": "customs",
                "CUSTOMS REVIEW": "review",
                "IN DISTRIBUTION": "distribution",
            };

            // Function to update the progress bar
            function updateProgressBar(status) {
                const steps = ["packing", "shipped", "customs", "review", "distribution"];
                const mappedClass = stepMapping[status];

                // Reset all steps to default state
                $('.step').removeClass('active').addClass('default');
                console.log(status);
                // If status is null or doesn't map, do not activate any steps
                if (status === null || !mappedClass) {

                    console.log("Status is null or unrecognized. No steps will be activated.");
                    return;
                }

                // Activate all steps up to the current one
                for (let i = 0; i <= steps.indexOf(mappedClass); i++) {
                    $('.' + steps[i]).removeClass('default').addClass('active');
                }
            }

            function fetchAndSetStatus(containerNumber) {
                if (!containerNumber) {
                    console.error("Container number is missing!");
                    return;
                }
                $.ajax({
                    url: getStatusUrl, // Use the route name-generated URL
                    type: "GET",
                    data: {
                        container_number: containerNumber
                    },
                    success: function(response) {
                        if (response.status) {
                            updateProgressBar(response.status);
                        } else {
                            console.error("Invalid status received:", response);
                            updateProgressBar(null);
                        }
                    },
                    error: function() {
                        alert("Failed to fetch container status.");
                    },
                });
            }
            updateLeftoverPackagesLink();
            updateHeldByCustomsLink();

            function updateLeftoverPackagesLink() {
                const selectedContainerNumber = document.getElementById('selected-container-number').textContent.trim();

                const linkElement = document.getElementById('leftover-packages-link');

                if (selectedContainerNumber && selectedContainerNumber !== 'Not Found') {
                    const routeUrl = `{{ route('user.leftover.packages', ['container_number' => ':containerNumber']) }}`;
                    // Replace placeholder with the actual container number
                    linkElement.href = routeUrl.replace(':containerNumber', encodeURIComponent(selectedContainerNumber));
                } else {
                    // If no valid container number, reset or disable the link
                    linkElement.href = '#';
                }
            }
            function updateHeldByCustomsLink() {
                const selectedContainerNumber = document.getElementById('selected-container-number').textContent.trim();

                const linkElement = document.getElementById('held-by-customs-link');

                if (selectedContainerNumber && selectedContainerNumber !== 'Not Found') {
                    const routeUrl = `{{ route('user.held.custom.packages', ['container_number' => ':containerNumber']) }}`;
                    // Replace placeholder with the actual container number
                    linkElement.href = routeUrl.replace(':containerNumber', encodeURIComponent(selectedContainerNumber));
                } else {
                    // If no valid container number, reset or disable the link
                    linkElement.href = '#';
                }
            }
            document.getElementById('search-button').addEventListener('click', function() {

                const searchTerm = document.getElementById('container-search').value;
                if (searchTerm.trim() === '') {
                    // Clear the container number if search is empty
                    document.getElementById('selected-container-number').textContent = '';
                    return;
                }

                const routeUrl = "{{ route('user.container.search') }}";

                fetch(`${routeUrl}?term=${encodeURIComponent(searchTerm)}`)
                    .then(response => response.json())
                    .then(data => {
                        const containerSpan = document.getElementById('selected-container-number');
                        if (data.length > 0) {
                            // Show the first matching container name
                            containerSpan.textContent = data[0];
                            updateLeftoverPackagesLink();
                        } else {
                            // Show "Not Found" if no matching container is found
                            containerSpan.textContent = 'Not Found';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching container:', error);
                    });
            });
        </script>
    @endpush
