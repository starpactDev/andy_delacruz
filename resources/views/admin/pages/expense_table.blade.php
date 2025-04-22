<div class="container p-4"
    style="background-color: #fffffff1; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-primary mb-3" style="background-color:rgb(24, 17, 117)" onclick="showAddExpenseModal()">
            <i class="fa fa-plus"></i>
            Add Expense</button>

    </div>
    <div class="d-flex justify-content-between align-items-center">
        <!-- Dropdown Section -->
        <div>
            <label for="containerDropdown" class="form-label" style="font-weight: bold; color: #343a40;">Select
                Month:</label>
            <select id="containerDropdown" class="form-select" style="min-width: 200px;">
                <!-- Options will be dynamically populated -->
            </select>
        </div>

        <!-- Total Amount Section -->
        <div class="text-end" style="font-size: 1.1rem; font-weight: bold; color: #343a40;">
            <span>GRAND TOTAL: </span>
            <span style="color: #28a745;" id="totalAmountPaid">${{ number_format($totalAmountPaid, 2) }}</span>
        </div>
    </div>
</div>

<div class="month-table">
    <div class="table-responsive mt-3">
        <table id="dataTable" class="tablesaw no-wrap v-middle table-hover table" data-tablesaw>
            <thead>
                <tr>
                    <th class="border-0 text-muted fw-normal">Date of Payment</th>

                    <th class="border-0 text-muted fw-normal">Payment Method</th>
                    <th class="border-0 text-muted fw-normal">Paid To</th>

                    <th class="border-0 text-muted fw-normal">Description</th>
                    <th class="border-0 text-muted fw-normal">Attachments</th>
                    <th class="border-0 text-muted fw-normal">Paid Amount</th>

                    <th class="border-0 text-muted fw-normal">Running Total</th>
                    <th class="border-0 text-muted fw-normal">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->date_of_payment }}</td>
                        <td>


                            <span class="badge px-2 py-1"
                            style="background-color:
                                {{ $expense->payment_method === 'Cash' ? '#28a745' :
                                ($expense->payment_method === 'Credit Card' ? '#007bff' :
                                ($expense->payment_method === 'Bank Transfer' ? '#6c757d' :
                                ($expense->payment_method === 'Zelle' ? '#ff5733' :
                                ($expense->payment_method === 'Others' ? '#697f7b' :
                                ($expense->payment_method === 'PayPal' ? '#003087' : '#ffc107'))))) }};
                            color: white; display: inline-block; width: 100px;">
                            {{ $expense->payment_method }}
                        </span>
                        </td>
                        <td>

                            {{ $expense->paid_to }}
                            </span>
                        </td>
                        <td>{{ $expense->description }}</td>
                        <td>
                            @if ($expense->attachment)
                                @if (in_array(pathinfo($expense->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                    <!-- Display Image -->
                                    <a href="{{ asset('attachments/' . $expense->attachment) }}" target="_blank">
                                        <img src="{{ asset('attachments/' . $expense->attachment) }}" alt="Attachment"
                                             style="width: 50px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                    </a>
                                @elseif (pathinfo($expense->attachment, PATHINFO_EXTENSION) === 'pdf')
                                    <!-- Display PDF Link -->
                                    <a href="{{ asset('attachments/' . $expense->attachment) }}" target="_blank" class="btn btn-sm btn-link">
                                        View PDF
                                    </a>
                                @endif
                            @else
                                <!-- No Attachment -->
                                <span style="color: rgb(179, 95, 95); font-size: 12px;font-weight:600; font-style: italic;">No attachment</span>
                            @endif
                        </td>
                        <td>${{ number_format($expense->paid_amount, 2) }}</td>
                        <td>${{ number_format($expense->running_total, 2) }}</td>
                        <td>
                            <!-- Actions like Edit/Delete -->
                            <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $expense->id }}"
                                data-date="{{ $expense->date_of_payment }}"
                                data-method="{{ $expense->payment_method }}"
                                data-paid_to="{{ $expense->paid_to }}"
                                data-description="{{ $expense->description }}"
                                data-paid_amount="{{ $expense->paid_amount }}">
                                Edit
                            </button>
                            <form action="{{ route('user.expenses.destroy', $expense->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $expense->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $expense->id }})">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editExpenseForm">
            <style>
                .form-group
                {
                    margin-top:20px;
                }
            </style>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="expenseId">
                    <div class="mb-3">
                        <label for="date_of_payment" class="form-label">Date of Payment</label>
                        <input type="date" id="date_of_payment" name="date_of_payment" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-select" required>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Zelle">Zelle</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Cash">Cash</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paid_to" class="form-label">Paid To</label>
                        <input type="text" id="paid_to" name="paid_to" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>
                     <div class="form-group">
                        <label for="attachment"> <i class="fa fa-paperclip"></i> Attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="mb-3">
                        <label for="paid_amount" class="form-label">Paid Amount</label>
                        <input type="number" id="paid_amount" name="paid_amount" class="form-control" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addExpenseForm" enctype="multipart/form-data">
                    @csrf
                    <style>
                        .form-group
                        {
                            margin-top:20px;
                        }
                    </style>
                    <div class="form-group">
                        <label for="date_of_payment">Date of Payment</label>
                        <input type="date" class="form-control" id="date_of_payment" name="date_of_payment" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="form-control" required>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Zelle">Zelle</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paid_to">Paid To</label>
                        <input type="text" class="form-control" id="paid_to" name="paid_to" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="attachment"> <i class="fa fa-paperclip"></i> Attachment</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="form-group">
                        <label for="paid_amount">Paid Amount</label>
                        <input type="number" class="form-control" id="paid_amount" name="paid_amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="running_total">Running Total</label>
                        <input type="number" class="form-control" id="running_total" name="running_total" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Expense</button>
                </form>
            </div>
        </div>
    </div>
</div>
