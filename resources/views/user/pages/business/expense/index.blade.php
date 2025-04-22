@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <h4 class="card-title " style="font-weight:600;font-size:30px"><span style="color:rgb(24, 116, 139)">
                        BUSINESS EXPENSE :</span>

                    <span style="color:rgb(11, 5, 87)"> REPORT</span>
                </h4>

            </div>
            <div class="row mt-3">


                @include('admin.pages.expense_table')

            </div>

        </div>
    @endsection
    @push('script')
        <script>
            function showAddExpenseModal() {
                $('#addExpenseModal').modal('show');
            }
            // JavaScript to populate the dropdown with all months
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            const dropdown = document.getElementById('containerDropdown');

            // Add default "All" option
            const allOption = document.createElement('option');
            allOption.value = 'all';
            allOption.textContent = 'All';
            dropdown.appendChild(allOption);

            // Add each month as an option
            monthNames.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = month; // Month numbers (1-12)
                option.textContent = month;
                dropdown.appendChild(option);
            });
        </script>
        <script>
            $(document).ready(function() {
                // Open Edit Modal and populate fields
                $('#dataTable').on('click', '.edit-btn', function() {
                    $('#expenseId').val($(this).data('id'));
                    $('#date_of_payment').val($(this).data('date'));
                    $('#payment_method').val($(this).data('method'));
                    $('#paid_to').val($(this).data('paid_to'));
                    $('#description').val($(this).data('description'));
                    $('#paid_amount').val($(this).data('paid_amount'));
                    $('#editModal').modal('show');
                });

                // AJAX Submit Form
                $('#editExpenseForm').on('submit', function(e) {
                    e.preventDefault();

                    // Prepare FormData (important for file uploads)
                    var formData = new FormData(this);
                    const url = "{{ route('user.expenses.update') }}";

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting the content type
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });
                            $('#editModal').modal('hide');
                            location.reload(); // Reload the page to reflect changes
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON.message
                            });
                        }
                    });
                });
            });
        </script>

        <script>
            function confirmDelete(expenseId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this expense?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the form using AJAX
                        var form = document.getElementById('delete-form-' + expenseId);
                        var actionUrl = form.action;

                        // Send AJAX request
                        $.ajax({
                            url: actionUrl,
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'The expense has been deleted.',
                                    'success'
                                );
                                // Optionally, remove the row from the table without reloading
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the expense.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            }
        </script>
        <script>
            // Handle the form submission via AJAX
            $('#addExpenseForm').on('submit', function(e) {
                e.preventDefault();

                // Remove previous error messages
                $('.form-group .error-message').remove();

                // Create a FormData object
                var formData = new FormData(this);

                // AJAX call to store the data
                $.ajax({
                    url: '{{ route('user.expenses.store') }}', // Use the route for storing expenses
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting content type
                    success: function(response) {
                        Swal.fire('Success', 'Expense added successfully', 'success');
                        $('#addExpenseModal').modal('hide'); // Hide the modal
                        $('#addExpenseForm')[0].reset(); // Reset the form
                        location.reload(); // Reload the page
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // Iterate through each error and display it below the respective field
                            Object.keys(errors).forEach(function(field) {
                                let fieldElement = $(`#addExpenseForm [name="${field}"]`);
                                let errorMessage =
                                    `<small class="text-danger error-message">${errors[field][0]}</small>`;
                                fieldElement.closest('.form-group').append(errorMessage);
                            });
                        } else {
                            Swal.fire('Error', 'There was an issue adding the expense', 'error');
                        }
                    }
                });
            });
            $('#containerDropdown').change(function() {
                var selectedMonth = $(this).val();

                // Make an AJAX call to fetch data based on the selected month
                $.ajax({
                    url: "{{ route('user.expenses.filterByMonth') }}", // Ensure you have this route in your web.php
                    method: "GET",
                    data: {
                        month: selectedMonth
                    },
                    success: function(response) {
                        // Update the table with the returned data
                        var tableBody = $('#dataTable tbody');
                        tableBody.empty(); // Clear current table content

                        var totalAmount = 0;
                        response.expenses.forEach(function(expense) {
                            var attachmentHTML = '';
                            if (expense.attachment) {
                                var fileExtension = expense.attachment.split('.').pop()
                                    .toLowerCase();
                                if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                                    // Display Image
                                    attachmentHTML = `<a href="{{ asset('attachments/') }}/${expense.attachment}" target="_blank">
                                              <img src="{{ asset('attachments/') }}/${expense.attachment}" alt="Attachment" style="width: 50px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 5px;">
                                            </a>`;
                                } else if (fileExtension === 'pdf') {
                                    // Display PDF Link
                                    attachmentHTML = `<a href="{{ asset('attachments/') }}/${expense.attachment}" target="_blank" class="btn btn-sm btn-link">
                                              View PDF
                                            </a>`;
                                }
                            } else {
                                // No attachment
                                attachmentHTML =
                                    `<span style="color: rgb(179, 95, 95); font-size: 12px; font-weight:600; font-style: italic;">No attachment</span>`;
                            }

                            var row = `<tr>
                    <td>${expense.date_of_payment}</td>
                    <td><span class="badge px-2 py-1" style="background-color: ${getPaymentMethodColor(expense.payment_method)}; color: white; display: inline-block; width: 100px;">${expense.payment_method}</span></td>
                    <td>${expense.paid_to}</td>
                    <td>${expense.description}</td>
                    <td>${attachmentHTML}</td>
                    <td>$${(parseFloat(expense.paid_amount) && !isNaN(expense.paid_amount) ? parseFloat(expense.paid_amount) : 0).toFixed(2)}</td>
                    <td>$${(parseFloat(expense.running_total) && !isNaN(expense.running_total) ? parseFloat(expense.running_total) : 0).toFixed(2)}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-primary edit-btn" data-id="${expense.id}" data-date="${expense.date_of_payment}" data-method="${expense.payment_method}" data-paid_to="${expense.paid_to}" data-description="${expense.description}" data-paid_amount="${expense.paid_amount}">Edit</button>

                        <!-- Delete Button Form -->
                        <form action="{{ route('user.expenses.destroy', '') }}/${expense.id}" method="POST" style="display:inline;" id="delete-form-${expense.id}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(${expense.id})">Delete</button>
                        </form>
                    </td>
                </tr>`;

                            tableBody.append(row);
                            totalAmount += parseFloat(expense.paid_amount) ||
                                0; // Adds expense.paid_amount, defaults to 0 if it's NaN

                            console.log(totalAmount);
                        });

                        // Update the total earnings amount
                        $('#totalAmountPaid').text('$' + totalAmount.toFixed(
                            2)); // Format to two decimal places
                    }
                });
            });

            function getPaymentMethodColor(method) {
                switch (method) {
                    case 'Cash':
                        return '#28a745';
                    case 'Credit Card':
                        return '#007bff';
                    case 'Bank Transfer':
                        return '#6c757d';
                    case 'Others':
                        return '#697f7b';
                    case 'Zelle':
                        return '#ff5733';
                    case 'PayPal':
                        return '#003087';
                    default:
                        return '#ffc107';
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                // Close modal when the close button is clicked
                $('#closeModal').click(function() {
                    $('#addExpenseModal').modal('hide');
                });
            });
        </script>
    @endpush
