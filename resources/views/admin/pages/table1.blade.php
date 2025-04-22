<div class="month-table">
    <div class="table-responsive mt-3">
        <table class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal" scope="col" class="border">
                        <label>
                            <input type="checkbox" id="selectAllCheckbox" style="margin-right: 4px" />
                            <span class="sr-only">Check All</span>
                        </label>
                        Select All
                    </th>
                    <th class="border-0 text-muted fw-normal">Order Id</th>
                    <th class="border-0 text-muted fw-normal">Customer Name</th>
                    <th class="border-0 text-muted fw-normal">Payment Status</th>
                    <th class="border-0 text-muted fw-normal">Order Status</th>
                </tr>
            </thead>
            <tbody id="orderPickupsTableBody">
                <!-- Rows will be dynamically added here -->
            </tbody>
        </table>
        {{-- <table class="tablesaw no-wrap v-middle  table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal" scope="col" class="border">
                        <label
                          ><input
                            type="checkbox"
                            data-tablesaw-checkall style="margin-right:4px"
                          /><span class="sr-only"> Check All</span></label
                        >Select All
                      </th>
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



                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123456
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            John Doe
                        </h6>

                    </td>


                    <td> <span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td> <span class="shipment-badge badge bg-success " style="background-color: rgb(19, 190, 202)!important">
                        <span class="fa-stack" style="margin-right:5px;">
                          <i class="fas fa-hand-holding fa-stack-1x"></i>
                          <i class="fas fa-box fa-stack-1x" style="font-size: 0.6em; top: -0.6em; left: 0.6em;"></i>
                        </span>
                        PICK
                      </span>
                    </td>


                </tr>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123457
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            Jane Smith
                        </h6>

                    </td>


                    <td> <span class="badge bg-danger px-2 py-1">Unpaid</span></td>
                    <td>
                        <span class=" shipment-badge badge bg-info px-2 py-2"
                           ><i class='fas fa-box-open' style="margin-right:7px;margin-left:5px"></i>PACK</span>
                    </td>



                </tr>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123458
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            Acme Corp
                        </h6>

                    </td>


                    <td> <span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td>
                        <span class=" shipment-badge badge bg-info px-2 py-2"   style="background-color: rgb(27, 188, 157)!important"
                           ><i class='fas fa-paper-plane' style="margin-right:8px;margin-left:5px"></i>SHIP</span>
                    </td>





                </tr>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123459
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            Global Industries
                        </h6>

                    </td>


                    <td> <span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td>  <span class=" shipment-badge badge bg-success px-2 py-1" style="background-color: rgb(34, 109, 175)!important">
                        <span class="fa-stack">
                          <i class="fas fa-file fa-stack-1x"></i>
                          <i class="fas fa-check fa-stack-1x"></i>
                        </span>
                        CUSTOM
                      </span>
                    </td>


                </tr>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123459
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            Global Industries
                        </h6>

                    </td>


                    <td> <span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td>  <span class="shipment-badge badge bg-success px-2 py-2" style="background-color: rgb(4, 131, 164)!important">
                        <i class='fas fa-map-marker-alt' style="margin-right:6px;margin-left:5px"></i>
                        DISTRIBUTION
                      </span>
                    </td>


                </tr>
                <tr>
                    <td>
                        <label
                          ><input type="checkbox" /><span class="sr-only">
                            Select Row</span
                          ></label
                        >
                      </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            ORD123460
                        </h6>

                    </td>
                    <td>
                        <h6 class="font-weight-medium mb-0">
                            BlueWave Ltd
                        </h6>

                    </td>


                    <td> <span class="badge bg-primary px-2 py-1">Paid</span></td>
                    <td>
                        <span class="shipment-badge badge bg-success px-2 py-2 " style="background-color: rgb(18, 182, 72)!important">
                            <i class="fas fa-dolly " style="margin-right:5px;margin-left:5px;"></i> DELIVERED
                        </span>
                    </td>

                </tr>


            </tbody>
        </table> --}}
    </div>
</div>
