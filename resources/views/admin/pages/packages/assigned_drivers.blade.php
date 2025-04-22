@extends('admin.layouts.master')
@section('content')
<style>
    .select2-container .select2-search--dropdown .select2-search__field::placeholder {
        display: flex;
        align-items: center;
        color: #6c757d; /* Placeholder color */
    }
    .select2-container .select2-selection--multiple {
        height: 36px;
    }
</style>
    <style>
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

        .paid-badge {


            width: 100px;
            padding: 20px;
            text-align: center;
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
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-search"></i>  Search Province</h4>
                <h6 class="card-subtitle lh-base">
                    Select the provinces whose details you want to <b style="color:blue; font-size:18px!important">show and print</b>
                </h6>
                <h5 style="color:red">Testing purpose search with name: LA ALTAGRACIO</h5>
                <select id="provinceFilter" class="select2 form-control" multiple="multiple" style="height: 36px; width: 100%">
                    <optgroup label="Provinces">
                        @foreach ($provinces as $province)
                            <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-lg-12 mb-4 ">
            <div class="d-flex justify-content-center">
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(175, 33, 33)">
                        DR PACKAGERS DISTRIBUTION</span>


                </h4>

            </div>
            <div class="row mt-3">


                @include('admin.pages.table8')
                <!-- Payment Status Modal -->

            </div>
        </div>
    </div>
@endsection
@push('script')

<script>
    $(document).ready(function() {
        $('#provinceFilter').on('change', function() {
            const selectedProvinces = $(this).val(); // Get selected provinces
            const allOrders = @json($assignedOrders); // Pass assigned orders from Blade to JavaScript

            const container = $('#filteredTablesContainer');

            container.empty(); // Clear existing tables and headings

            if (selectedProvinces && selectedProvinces.length > 0) {
                selectedProvinces.forEach(province => {
                    // Add a heading for the province
                    const heading = `<h4 class="mt-4">${province} Province</h4>`;

                    // Add the print button
                    const printButton = `<button class="btn btn-primary mt-3" onclick="printTable('${province}')">Print Table</button>`;

                    container.append(heading);
                    container.append(printButton);

                    // Filter orders by province
                    const filteredOrders = allOrders.filter(order => {
                        return order.order_pickup?.receiver?.province === province;
                    });

                    if (filteredOrders.length > 0) {
                        let tableContent = `
                            <div class="table-responsive mt-3" id="table-${province}">
                                <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-muted fw-normal">Order Id</th>
                                            <th class="border-0 text-muted fw-normal">Container ID</th>
                                            <th class="border-0 text-muted fw-normal">Customer Name</th>
                                            <th class="border-0 text-muted fw-normal">Receiver Info</th>
                                            <th class="border-0 text-muted fw-normal">Payment Status</th>
                                            <th class="border-0 text-muted fw-normal">Assigned To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        `;

                        // Append rows for the filtered orders
                        filteredOrders.forEach(order => {
                            tableContent += `
                                <tr>
                                    <td>${order.order_number}</td>
                                    <td>${order.order_pickup?.container_number ?? 'N/A'}</td>
                                    <td>${order.order_pickup?.sender?.first_name ?? 'N/A'} ${order.order_pickup?.sender?.last_name ?? 'N/A'}</td>
                                    <td>
                                        ${order.order_pickup?.receiver?.first_name ?? 'N/A'} ${order.order_pickup?.receiver?.last_name ?? 'N/A'}<br/>
                                        <small class="text-muted">PROVINCE: ${order.order_pickup?.receiver?.province ?? ''}</small><br/>
                                        <small class="text-muted">CITY: ${order.order_pickup?.receiver?.city ?? ''}</small>
                                    </td>
                                    <td>
                                        <span class="badge ${order.order_pickup?.is_completed === 0 ? 'bg-danger' : 'bg-success'}">
                                            ${order.order_pickup?.is_completed === 0 ? 'Due' : 'Paid'}
                                        </span>
                                    </td>
                                    <td>
                                        ${order.driver?.name ?? 'Unassigned'}<br/>

                                    </td>
                                </tr>
                            `;
                        });

                        tableContent += `
                                </tbody>
                            </table>
                        </div>
                    `;

                        container.append(tableContent);
                    } else {
                        container.append(`<p>No orders available for ${province}.</p>`);
                    }
                });
            } else {
                container.append('<p>No provinces selected.</p>');
            }
        });
    });

    // Function to print the table data
    function printTable(province) {
        const table = document.getElementById(`table-${province}`).outerHTML;  // Get table HTML by province
        const printWindow = window.open('', '', 'height=600,width=800');

        printWindow.document.write('<html><head><title>Print Table</title>');
        printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(table);  // Write the table content
        printWindow.document.write('</body></html>');

        printWindow.document.close(); // Close the document to finish writing
        printWindow.print();  // Trigger the print dialog
    }
</script>
@endpush
