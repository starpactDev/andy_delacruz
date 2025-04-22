<h4 class="card-title text-center"><span style="color:rgb(24, 19, 68);font-weight:600"> TOTAL CONTROL OF ORDERS PER
        CONTAINER:
    </span><span style="color:rgb(15, 117, 15);font-weight:600"> IN PROGRESS</span>
</h4>
<!-- Search Field -->
<div class="d-flex align-items-center justify-content-between mt-2">
    <!-- Left Links -->
    <div>
        <a id="leftover-packages-link" href="#" class="btn btn-primary"
            style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none;">
            LEFTOVER PACKAGES
        </a>
        <a id="held-by-customs-link" href="#" class="btn btn-warning"
            style="padding: 10px 20px; background-color: #ff0000; color: white; text-decoration: none;">
            HELD BY CUSTOMS
        </a>
    </div>

    <!-- Right Search Box -->
    <div class="input-group ms-auto" style="max-width: 300px;">
        <input type="text" id="orderSearch" class="form-control" placeholder="Search Order ID"
            aria-label="Search Order ID">
        <span class="input-group-text" style="background-color: yellow;">
            <i class="fa fa-search"></i>
        </span>
    </div>
</div>
<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle  table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>
                    <th class="border-0 text-muted fw-normal">Container ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">View Orders</th>
                    <th class="border-0 text-muted fw-normal">Due Amount</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                    @if (!isset($containerStatus))
                        <th class="border-0 text-muted fw-normal">Manage Order</th>
                    @endif
                </tr>
            </thead>
            <tbody id="orderTableBody">
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>
</div>
