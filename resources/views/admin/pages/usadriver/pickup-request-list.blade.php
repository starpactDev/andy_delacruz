@extends('admin.layouts.master')
@section('content')
    <style>
        .top-right-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .top-right-buttons button {
            margin-left: 10px;
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


        <div class="col-lg-12 mb-4 ">
            <div class="d-flex justify-content-center">
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(175, 33, 33)">
                        Pickup Requests :</span>

                    <span style="color:rgb(223, 15, 15)"> List</span>
                </h4>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="top-right-buttons">
                        <button class="btn btn-info" id="print-button">
                            <i class="fas fa-print"></i> Print List
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @php
                // Helper function for status colors
                function getStatusColor($status)
                {
                    switch ($status) {
                        case 'order_created':
                            return 'rgb(38, 175, 33)'; // ACTIVE ORDER color
                        case 'not_at_home':
                            return '#a78c00'; // Orange for Not at Home
                        case 'come_back_later':
                            return '#055854'; // Blue for Come Back Later
                        case 'cancel_request':
                            return 'rgb(220, 53, 69)'; // Red for Cancel Request
                        default:
                            return 'rgb(128, 128, 128)'; // Default color
                    }
                }
            @endphp

                <div class="month-table ">
                    <div class="table-responsive mt-3">
                        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                            <thead>
                                <tr>

                                    <th class="border-0 text-muted fw-normal">Issue Date</th>
                                    <th class="border-0 text-muted fw-normal">Pickup Date</th>
                                    <th class="border-0 text-muted fw-normal">Pickup Time</th>
                                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                                    <th class="border-0 text-muted fw-normal">Customer Address</th>
                                    <th class="border-0 text-muted fw-normal">Action</th>
                                    <th class="border-0 text-muted fw-normal">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events->groupBy(['assignedEmployee.city', 'assignedEmployee.state']) as $state => $cities)
                                    @foreach ($cities as $city => $groupedEvents)
                                        <tr>

                                            @foreach ($groupedEvents as $event)
                                                <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d M, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-primary px-2 py-1">
                                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning px-2 py-1">
                                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <h6 class="font-weight-medium mb-0">
                                                        {{ $event->assignedEmployee->full_name ?? 'N/A' }}
                                                    </h6>
                                                    <small class="text-muted">
                                                        <i class="fa fa-envelope me-1"></i>
                                                        {{ $event->assignedEmployee->email ?? 'N/A' }}
                                                    </small><br>
                                                    <small class="text-muted">
                                                        <i class="fa fa-phone me-1"></i>
                                                        {{ $event->assignedEmployee->phone_number ?? 'N/A' }}
                                                    </small>
                                                </td>
                                                <td>
                                                    {{ $event->assignedEmployee->address ?? 'N/A' }},
                                                    {{ $event->assignedEmployee->city ?? 'N/A' }},<br/>
                                                    {{ $event->assignedEmployee->state ?? 'N/A' }},
                                                    {{ $event->assignedEmployee->zip ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    <select class="form-select mt-2" aria-label="Order Status" data-event-id="{{ $event->id }}">
                                                        <option value="">Change Status</option>
                                                        <option value="order_created" {{ $event->status == 'order_created' ? 'selected' : '' }}>Order Created</option>
                                                        <option value="not_at_home" {{ $event->status == 'not_at_home' ? 'selected' : '' }}>Not at Home</option>
                                                        <option value="come_back_later" {{ $event->status == 'come_back_later' ? 'selected' : '' }}>Come Back Later</option>
                                                        <option value="cancel_request" {{ $event->status == 'cancel_request' ? 'selected' : '' }}>Cancel Request</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <span id="status-{{ $event->id }}" class="badge px-3 py-2" style="background-color: {{ getStatusColor($event->status ?? 'order_created') }};">
                                                        {{ ucwords(str_replace('_', ' ', $event->status ?? 'order_active')) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
    @endsection
    @push('script')
        <script>
            // When the status dropdown changes
            document.querySelectorAll('select[aria-label="Order Status"]').forEach(select => {
                select.addEventListener('change', function() {
                    let eventId = this.getAttribute('data-event-id');
                    let selectedStatus = this.value;

                    if (selectedStatus === "") return; // If "Change Status" is selected, do nothing

                    // If the selected status is "order_created", ask for confirmation
                    if (selectedStatus === 'order_created') {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Once you mark this order as completed, you can't change the status. Make sure you've created the invoice.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, mark as completed',
                            cancelButtonText: 'No, cancel',
                            reverseButtons: true
                        }).then(result => {
                            if (result.isConfirmed) {
                                // Generate the URL using the named route
                                let url = '{{ route('driver.update-status', ':eventId') }}';
                                url = url.replace(':eventId',
                                    eventId); // Replace the placeholder with the actual eventId

                                // Send the AJAX request to update the status
                                fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: JSON.stringify({
                                            status: selectedStatus
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        // Update the status badge with formatted text
                                        let formattedStatus = selectedStatus.replace(/_/g, ' ')
                                            .toUpperCase();

                                        // Update the status badge with formatted text
                                        let statusBadge = document.getElementById('status-' +
                                            eventId);
                                        statusBadge.innerHTML = formattedStatus;

                                        // Change the background color of the status badge based on the selected status
                                        statusBadge.style.backgroundColor =
                                            'rgb(38, 175, 33)'; // ACTIVE ORDER color

                                        // Hide the dropdown and replace it with "Completed"
                                        let statusDropdown = this;
                                        statusDropdown.style.display = 'none';
                                        let completedText = document.createElement('span');
                                        completedText.className = 'badge bg-success px-3 py-2';
                                        completedText.innerHTML = 'Completed';
                                        statusDropdown.parentNode.appendChild(completedText);

                                        // Show SweetAlert message
                                        Swal.fire({
                                            title: 'Success!',
                                            text: data.message,
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        });
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'There was an error updating the status.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                            } else {
                                // Revert the dropdown selection if canceled
                                this.value = ''; // Reset the dropdown
                            }
                        });
                    } else {
                        // Handle other status changes
                        // Generate the URL using the named route
                        let url = '{{ route('driver.update-status', ':eventId') }}';
                        url = url.replace(':eventId',
                            eventId); // Replace the placeholder with the actual eventId

                        // Send the AJAX request to update the status
                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                body: JSON.stringify({
                                    status: selectedStatus
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Update the status badge
                                let formattedStatus = selectedStatus.replace(/_/g, ' ').toUpperCase();

                                // Update the status badge with formatted text
                                let statusBadge = document.getElementById('status-' + eventId);
                                statusBadge.innerHTML = formattedStatus;

                                // Change the background color of the status badge based on the selected status
                                if (selectedStatus === 'order_created') {
                                    statusBadge.style.backgroundColor =
                                        'rgb(38, 175, 33)'; // ACTIVE ORDER color
                                } else if (selectedStatus === 'not_at_home') {
                                    statusBadge.style.backgroundColor = '#a78c00'; // Orange for Not at Home
                                } else if (selectedStatus === 'come_back_later') {
                                    statusBadge.style.backgroundColor =
                                        '#055854'; // Blue for Come Back Later
                                } else if (selectedStatus === 'cancel_request') {
                                    statusBadge.style.backgroundColor =
                                        'rgb(220, 53, 69)'; // Red for Cancel Request
                                }

                                // Show SweetAlert message
                                Swal.fire({
                                    title: 'Success!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'There was an error updating the status.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    }
                });
            });
        </script>

<script>
    document.getElementById('print-button').addEventListener('click', function () {
        // Select the table content
        const printTable = document.querySelector('.tablesaw').outerHTML;

        // Open a new print window
        const printWindow = window.open('', '', 'width=800,height=600');

        // Add HTML content to the new window
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Pickup Requests</title>
                    <style>
                        .table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .table th, .table td {
                            border: 1px solid #ccc;
                            padding: 8px;
                            text-align: left;
                        }
                        .table th {
                            background-color: #f4f4f4;
                        }
                        /* Hide the Action column when printing */
                        th:nth-child(7),
                        td:nth-child(7) {
                            display: none;
                        }
                        /* Hide the Action column when printing */
                        th:nth-child(6),
                        td:nth-child(6) {
                            display: none;
                        }
                    </style>
                </head>
                <body>
                    <table>${printTable}</table>
                </body>
            </html>
        `);

        // Trigger the print functionality
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    });
</script>


    @endpush
