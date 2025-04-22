@extends('CustomerDashboard.layout.master')
@section('content')

   <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles d-flex justify-content-center align-items-center" style="height: 100px;">
            <h1 class="fw-bold display-4 text-center" style="color:rgb(15, 15, 58)">CUSTOMER DASHBOARD</h1>
        </div>
          <!-- ============================================================== -->
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
          <!-- -------------------------------------------------------------- -->
          <!-- Container fluid  -->
          <!-- -------------------------------------------------------------- -->
          <div class="container-fluid">
            <!-- -------------------------------------------------------------- -->
            <!-- Start Page Content -->
            <!-- -------------------------------------------------------------- -->
            <div class="widget-content searchable-container list">
              <div class="card card-body">
                <div class="row justify-content-center align-items-center g-3">
                    <!-- Search Input Field -->
                    <div class="col-md-6 col-xl-4">
                        <form class="position-relative">
                            <input
                                type="text"
                                class="form-control  px-4 py-3 shadow-sm"
                                id="input-search"
                                placeholder="TRACK MY PACKAGE BY ORDER ID"
                                style="font-size: 18px; border: 2px solid #007bff; height: 56px;"
                            />
                            <button
                                type="submit"
                                class="btn position-absolute top-50 end-0 translate-middle-y me-3"
                                style="border: none; background: transparent;"
                            >
                                <i class="fas fa-search text-primary" style="font-size: 22px;"></i>
                        </form>
                    </div>

                    <!-- Request Pickup Button -->
                    <div class="col-md-6 col-xl-4">
                        <button
                            class="btn btn-primary fw-bold text-uppercase px-4 py-3 shadow-lg w-100"
                            style="font-size: 18px; letter-spacing: 1px; height: 56px;"
                            onclick="window.location.href='{{ route('new_package_request_form') }}';"
                        >
                            REQUEST A NEW PACKAGE PICKUP
                        </button>
                    </div>

                </div>
              </div>
              <!-- Modal -->
              <style>
                .month-table table th,
                .month-table table td {
                    width: 200px;
                    /* Adjust as needed */
                    text-align: center;
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
              <div class="card card-body">
                <h4 class="text-center mb-4 fw-bold" style="font-size:30px; color:red">My Packages History</h4>
                <div class="table-responsive">
                    <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
                        <thead>
                            <tr>
                                <th class="border-0 text-muted fw-normal">Order Id</th>
                                <th class="border-0 text-muted fw-normal">Container ID</th>
                                <th class="border-0 text-muted fw-normal">Customer Name</th>
                                <th class="border-0 text-muted fw-normal">Payment History</th>
                                <th class="border-0 text-muted fw-normal">View Orders</th>
                                <th class="border-0 text-muted fw-normal">Due Amount</th>
                                <th class="border-0 text-muted fw-normal">Order Status</th>
                                <th class="border-0 text-muted fw-normal">Customer Feedback</th>
                            </tr>
                        </thead>
                        <tbody id="order-table-body">
                            @foreach ($orders as $order)
                                <tr class="order-row" data-order-number="{{ $order->order_number }}">
                                    <td>
                                        <h6 class="font-weight-medium mb-0">{{ $order->order_number }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-medium mb-0">{{ $order->container_number }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="font-weight-medium mb-0">{{ $order->sender->first_name ?? '' }}
                                            {{ $order->sender->last_name ?? '' }}</h6>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light-success text-primary custom-size py-3 w-100"
                                            data-bs-toggle="modal" data-bs-target="#paymentStatusModal"
                                            data-order-pickup-id="{{ $order->id }}">
                                            <i data-feather="dollar-sign" class="feather-sm"></i> View
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="shipment-badge badge bg-success py-3 w-100"
                                            onclick="window.location.href='{{ route('order_overview_from_customer', $order->id) }}'"
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
                                        $due_amount = $order->grand_total_amount - $order->amount_paid;
                                        ?>
                                        @if ($due_amount == 0)
                                            <span class="badge bg-primary px-2 py-4 w-100">Paid</span>
                                        @else
                                            <span class="badge bg-danger px-2 py-4 w-100">${{ number_format($due_amount, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($order->package_status == 'PACK')
                                            <span class="shipment-badge badge square-badge bg-success py-4 w-100"
                                                style="background-color: rgb(19, 190, 202)!important">
                                                <i class="fas fa-hand-holding"></i> PACK
                                            </span>
                                        @elseif ($order->package_status == 'SHIP')
                                            <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100"
                                                style="background-color: rgb(27, 188, 157)!important;">
                                                <i class="fas fa-paper-plane"></i> SHIP
                                            </span>
                                        @elseif ($order->package_status == 'CUSTOMS')
                                            <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100">
                                                <i class="fas fa-box"></i> CUSTOMS
                                            </span>
                                        @elseif ($order->package_status == 'CUSTOMS REVIEW')
                                            <span class="shipment-badge badge square-badge bg-info px-2 py-4 w-100">
                                                <i class="fa fa-star"></i> CUSTOMS REVIEW
                                            </span>
                                        @elseif ($order->package_status == 'IN DISTRIBUTION')
                                            <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                                style="background-color: rgb(4, 131, 164)!important;">
                                                <i class="fas fa-map-marker-alt"></i> DISTRIBUTION
                                            </span>
                                        @elseif ($order->package_status == 'DELIVERED')
                                            <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                                style="background-color: rgb(18, 182, 72)!important;">
                                                <i class="fas fa-dolly"></i> DELIVERED
                                            </span>
                                            @elseif($order->package_status == 'HELD BY CUSTOMS')
                                            <span class="shipment-badge badge bg-success px-2 py-4 w-100"
                                                style="background-color: rgb(164, 4, 19)!important;">
                                                <i class="fas fa-pause-circle" style="margin-right:5px;margin-left:5px;"></i> HELD BY CUSTOMS
                                            </span>
                                        @elseif ($order->package_status == 'order_created')
                                            <span class="shipment-badge badge square-badge bg-success px-2 py-4 w-100"
                                                style="background-color: rgb(150, 206, 18)!important;">
                                                <i class="fas fa-plus-circle"></i> ORDER CREATED
                                            </span>
                                        @else
                                            <span class="shipment-badge badge square-badge bg-secondary px-2 py-4 w-100">
                                                <i class="fas fa-question-circle"></i> UNKNOWN STATUS
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                        $surveyExists = \App\Models\SurveyFeedback::where('order_pickup_id', $order->id)->exists();
                                    @endphp
                                        @if(!$surveyExists)
                                        <!-- Show "HOW WAS MY EXPERIENCE" Button if the survey is NOT submitted -->
                                        <button type="button" class="shipment-badge badge bg-success py-3 w-100"
                                            onclick="window.location.href='{{ route('survey_from_customer', $order->id) }}'"
                                            style="background-color: rgb(15, 83, 49)!important; text-decoration: none; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <text x="5" y="20" font-size="18" font-weight="medium" fill="currentColor">?</text>
                                            </svg>
                                            HOW WAS MY EXPERIENCE
                                        </button>
                                    @else
                                        <!-- Show "VIEW SURVEY" Button if the survey is submitted -->
                                        <button type="button" class="shipment-badge badge bg-primary py-3 w-100"
                                            onclick="window.location.href='{{ route('survey.view', $order->id) }}'"
                                            style="background-color: rgb(0, 82, 204)!important; text-decoration: none; border: none;">

                                            VIEW SURVEY REPORT
                                        </button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            </div>
            <!-- -------------------------------------------------------------- -->
            <!-- End PAge Content -->
            <!-- -------------------------------------------------------------- -->
          </div>
          <!-- Share Modal -->

@endsection


@push('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let searchInput = document.getElementById("input-search");

        searchInput.addEventListener("keyup", function () {
            let filterValue = searchInput.value.toLowerCase();
            let orderRows = document.querySelectorAll(".order-row");

            orderRows.forEach(function (row) {
                let orderNumber = row.getAttribute("data-order-number").toLowerCase();

                if (orderNumber.includes(filterValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>
<script>
    const paymentDetailsRoute = "{{ route('get.payment.details', ':id') }}";
</script>
<script>
    // Pass the URL to JavaScript
    var collectPaymentUrl = "{{ route('collect_payment', ['order_pickup_id' => '__order_pickup_id__']) }}";
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
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif
@endpush
