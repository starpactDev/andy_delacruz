@extends('admin.layouts.master')
@section('content')
<style>
    .custom-size {
       display: inline-flex;
       flex-direction: column;
       justify-content: center;
       align-items: center;
       width: 70px;
       height: 70px;
       text-align: center;
   }
</style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Customers List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Customers List</li>
            </ol>
        </div>

    </div>

    <div class="container-fluid">
        <!-- -------------------------------------------------------------- -->
        <!-- Start Page Content -->
        <!-- -------------------------------------------------------------- -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-4">
                            <h4 class="card-title">Customers</h4>
                            {{-- <div class="ms-auto">
                                <div class="btn-group">
                                    <button type="button"
                                        class="
                          btn btn-light-primary
                          text-primary
                          font-weight-medium
                          rounded-pill
                          px-4
                        "
                                        data-bs-toggle="modal" data-bs-target="#createmodel">
                                        Create New Account
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Customer Id</th>
                                        <th>Full Name</th>
                                        <th>E-mail</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                        <th>APT#</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Marketing Info</th> <!-- New Header -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($senders as $sender)
                                    <tr>
                                        <td>{{ str_pad($loop->iteration, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $sender->first_name }} {{ $sender->last_name }}</td>
                                        <td>{{ $sender->email }}</td>
                                        <td>{{ $sender->telephone }}</td>
                                        <td>{{ $sender->street_address }}</td>
                                        <td>{{ $sender->apt }}</td>
                                        <td>{{ $sender->city }}</td>
                                        <td>{{ $sender->state }}</td>
                                        <td>{{ $sender->zip }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-icon btn-pure btn-outline btn-info  custom-size" data-bs-toggle="tooltip" data-original-title="Send Marketing Info">
                                                <span class="fa-stack fa-2x" style="color:#b1d0ec">
                                                    <i class="fas fa-users fa-stack-1x" style="font-size:17px;"></i>
                                                    <i class="fas fa-share-alt fa-stack-1x" style="font-size:12px;position: absolute; top: -13px; left: 10px;"></i>
                                                </span>
                                                <div style="text-align:center;">
                                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn" data-bs-toggle="tooltip" data-original-title="Edit">
                                                <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn mt-2" data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Create Modal -->

            <!-- Column -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection

@push('script')
@endpush
