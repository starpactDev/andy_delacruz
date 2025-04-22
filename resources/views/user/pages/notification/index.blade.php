@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page wrapper  -->
    <!-- -------------------------------------------------------------- -->

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-12 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Notes & Reminders</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Reminders</li>
            </ol>
        </div>

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
                <div class="row">
                    <div class="col-md-4 col-xl-2">
                        <form>
                            <input type="text" class="form-control product-search" id="input-search"
                                placeholder="Search Particular Notification..." />
                        </form>
                    </div>
                    <div
                        class="
                    col-md-8 col-xl-10
                    text-end
                    d-flex
                    justify-content-md-end justify-content-center
                    mt-3 mt-md-0
                  ">
                        <div class="action-btn show-btn" style="display: none">
                            <a href="javascript:void(0)"
                                class="
                        delete-multiple
                        btn-light-danger btn
                        me-2
                        text-danger
                        d-flex
                        align-items-center
                        font-weight-medium
                      ">
                                <i data-feather="trash-2" class="feather-sm fill-white me-1"></i>
                                Delete All Row</a>
                        </div>
                        {{-- <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info">
                                <i data-feather="users" class="feather-sm fill-white me-1">
                                </i>
                                Add Contact</a> --}}
                    </div>
                </div>
            </div>
            <!-- Modal -->
            {{-- <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog"
                    aria-labelledby="addContactModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title">Contact</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="add-contact-box">
                                    <div class="add-contact-content">
                                        <form id="addContactModalTitle">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 contact-name">
                                                        <input type="text" id="c-name" class="form-control"
                                                            placeholder="Name" />
                                                        <span class="validation-text text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3 contact-email">
                                                        <input type="text" id="c-email" class="form-control"
                                                            placeholder="Email" />
                                                        <span class="validation-text text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 contact-occupation">
                                                        <input type="text" id="c-occupation" class="form-control"
                                                            placeholder="Occupation" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3 contact-phone">
                                                        <input type="text" id="c-phone" class="form-control"
                                                            placeholder="Phone" />
                                                        <span class="validation-text text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3 contact-location">
                                                        <input type="text" id="c-location" class="form-control"
                                                            placeholder="Location" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btn-add" class="btn btn-success rounded-pill px-4">
                                    Add
                                </button>
                                <button id="btn-edit" class="btn btn-success rounded-pill px-4">
                                    Save
                                </button>
                                <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">
                                    Discard
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table  ">
                        <thead class="header-item">


                            <th>Reminders</th>
                            <th>Order Number</th>
                            <th> Invoice </th>
                            <th> Driver Name </th>
                            <th>Added At</th>
                        </thead>
                        <tbody>
                            @foreach ($notes as $note)
                                <tr class="search-items">

                                    <td>{{ $note->add_note }}</td>
                                    <td><span class="paid-badge badge bg-primary px-2 py-1">{{ $note->order_number }}</span>
                                    </td>

                                    <td> <a href="{{ route('user.invoice.pdf_index', ['order_number' => $note->order_number]) }}"
                                            target="_blank">View PDF</a>
                                    </td>
                                    @php
                                        $user = App\Models\User::where('id', $note->driver_id)->first();

                                    @endphp
                                    <td><span class="paid-badge badge bg-success px-2 py-1">{{ $user->name }}</span></td>
                                    <td><span
                                            class="paid-badge badge bg-info px-2 py-1">{{ \Carbon\Carbon::parse($note->created_at)->format('d M Y') }}</span>
                                    </td>

                                </tr>
                            @endforeach
                            <!-- row -->

                            <!-- /.row -->

                            <!-- /.row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- Share Modal -->

    <!-- -------------------------------------------------------------- -->
    <!-- End Container fluid  -->
    <!-- -------------------------------------------------------------- -->
    <!-- -------------------------------------------------------------- -->
    <!-- footer -->
    <!-- -------------------------------------------------------------- -->

    <!-- -------------------------------------------------------------- -->
    <!-- End footer -->
    <!-- -------------------------------------------------------------- -->

    <!-- -------------------------------------------------------------- -->
    <!-- End Page wrapper  -->
@endsection

@push('script')
    <script>
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', function() {
                const noteId = this.getAttribute('data-id');
                const deleteUrl = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to undo this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the delete action
                        fetch(deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', data.message, 'success');
                                    // Optionally remove the row from the table
                                    this.closest('tr').remove();
                                } else {
                                    Swal.fire('Error!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'Something went wrong!', 'error');
                            });
                    }
                });
            });
        });
    </script>
@endpush
