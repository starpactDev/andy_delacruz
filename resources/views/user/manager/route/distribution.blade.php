@extends('admin.layouts.master')
@section('content')
    <style>
        .card-title {}
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
                    <h4 class="card-title" style="font-weight:500; font-size:25px;">
                        <span style="color:rgb(28, 115, 141)">
                            DISTRIBUTION OF PACKAGERS BY CONTAINER AND PROVINCES
                        </span>
                    </h4>
                </div>
            </div>

            <!-- Notes in the top-right corner -->


            <div class="row">
                <div class="container mt-4">
                    <div class="row">

                        <!-- Box 1 -->
                        <div class="col-md-6 col-lg-2 mb-4">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">CONTAINER # :</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">
                                        {{ config('global.currentContainerNumber') }}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            $total_orders = App\Models\OrderPickUp::where(
                                'container_number',
                                config('global.currentContainerNumber'),
                            )->count();

                            $assigned_orders = App\Models\AssignedOrderToDriver::whereHas('orderPickup', function ($query) {
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
                        <div class="col-md-6 col-lg-2 mb-4">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">TOTAL ORDERS:</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">{{ $total_orders }}</p>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">TOTAL ORDERS
                                        ASSIGNED:</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">{{ $assigned_orders }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(8, 8, 73)">TOTAL UNASSIGNED
                                        ORDERS:</h5>
                                    <p class="card-text" style="font-weight:600;color:brown">{{ $unassigned_orders }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-2 mb-4">
                            <div class="card w-100">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight:500;color:rgb(13, 112, 51)">TOTAL DELIVERED:
                                    </h5>
                                    <p class="card-text" style="font-weight:600;color:rgb(14, 13, 13)">
                                        {{ $delivered_orders }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Add more boxes as needed -->
                    </div>
                    <div class="row">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="position-relative mb-4">
                                        <div class="d-flex justify-content-between w-100">
                                            <div></div> <!-- This div helps center the content if needed -->
                                            <div class="d-flex align-items-center" style="position: absolute; top: 0; right: 0;">
                                                <img src="{{ asset('admin/assets/images/notes.jpg') }}" alt="Notes" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 8px;">
                                                <span style="font-size: 18px; font-weight: 500; color:black;">NOTES: <span style="color:red">{{ $notesCount }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinceFilter" style="font-weight:600">Select Province</label>
                                        <select id="provinceFilter" class="select2 form-control" multiple="multiple" style="height: 36px; width: 100%">

                                            <optgroup label="Provinces">
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="driverSelect" style="font-weight:600">Assign To :  <i class="fas fa-truck"></i> </label>
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
                                        <label for="assignedProvince" style="font-weight:600">Assigned Province</label>
                                        <br/>
                                        @foreach ($groupedOrders as $province => $orders)
                                            <button type="button" class="btn btn-outline-primary province-btn mb-2" data-target="#province-{{ Str::slug($province) }}">
                                                {{ $province }}
                                            </button>
                                        @endforeach
                                    </div>

                                </div>



                            </div>
                        </div>

                        <div id="provinceOrdersContainer" class="row">

                            @foreach ($groupedOrders as $province => $orders)
                            @php
                                $provinceId = uniqid();
                            @endphp
                            <div class="col-lg-12 d-flex align-items-stretch province-card"
                                data-province="{{ $province }}">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <h4 class="card-title" style="font-weight:600">Province:
                                                <span style="color:rgb(238, 19, 19)">{{ $province }}</span>
                                            </h4>
                                        </div>
                                        @if ($orders->isEmpty())
                                            <p class="text-center text-muted">No packages assigned under this province.</p>
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
                    <button type="button" class="close" id="closeNoteModal" data-dismiss="modal" aria-label="Close">
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
                    scrollTop: targetElement.offset().top - 20 // Adjust for any fixed header, if necessary
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
                        <div class="card w-100">
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
