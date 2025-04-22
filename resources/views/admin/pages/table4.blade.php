<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Order Id</th>
                    <th class="border-0 text-muted fw-normal">Invoice #</th>
                    {{-- <th class="border-0 text-muted fw-normal">Container ID</th> --}}
                    <th class="border-0 text-muted fw-normal">Transaction ID</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>

                    <th class="border-0 text-muted fw-normal"> Amount Paid</th>
                    <th class="border-0 text-muted fw-normal"> Payment Method</th>
                    <th class="border-0 text-muted fw-normal">Payment Date</th>

                    <th class="border-0 text-muted fw-normal">Order Status</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 5; $i++)
                    <tr>
                        <td><h6 class="font-weight-medium mb-0">EPG - 240{{ $i }}</h6></td>
                        <td><h6 class="font-weight-medium mb-0">EPG 20-000{{ $i }}</h6></td>
                        {{-- <td><h6 class="font-weight-medium mb-0">EPG {{ 20 + $i }}</h6></td> --}}
                        <td><h6 class="font-weight-medium mb-0">TXN7891{{ 23 + $i }}</h6></td>
                        <td><h6 class="font-weight-medium mb-0">Customer {{ $i }}</h6></td>
                        <td><span class="paid-badge badge bg-success px-2 py-1">$250</span></td>
                        <td><span class="paid-badge badge bg-primary px-2 py-1">Credit Card</span></td>
                        <td><span class="paid-badge badge bg-info px-2 py-1">2024-08-0{{ $i }}</span></td>
                        <td>
                            <span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(18, 182, 72)!important">
                                <i class="fas fa-dolly" style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                            </span>
                        </td>
                    </tr>
                @endfor
         
            </tbody>
        </table>
    </div>
</div>
