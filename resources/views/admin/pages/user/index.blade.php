@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Users List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">User List</li>
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
                            <h4 class="card-title">All Users</h4>
                            <div class="ms-auto">
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
                                        Create New User
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>

                                        <th>Joining date</th>

                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/1.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Genelia Deshmukh</span>
                                        </td>
                                        <td>genelia@gmail.com</td>
                                        <td>+123 456 789</td>

                                        <td>12-10-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/2.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Arijit Singh</span>
                                        </td>
                                        <td>arijit@gmail.com</td>
                                        <td>+234 456 789</td>

                                        <td>10-09-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/3.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Govinda jalan</span>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>

                                        <td>1-10-2013</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/4.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Hritik Roshan</span>
                                        </td>
                                        <td>hritik@gmail.com</td>
                                        <td>+456 456 789</td>

                                        <td>2-10-2023</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/5.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">John Abraham</span>
                                        </td>
                                        <td>john@gmail.com</td>
                                        <td>+567 456 789</td>

                                        <td>10-9-2015</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/6.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Pawandeep kumar</span>
                                        </td>
                                        <td>pawandeep@gmail.com</td>
                                        <td>+678 456 789</td>

                                        <td>10-5-2013</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/7.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Ritesh Deshmukh</span>
                                        </td>
                                        <td>ritesh@gmail.com</td>
                                        <td>+123 456 789</td>

                                        <td>05-10-2012</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/8.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Salman Khan</span>
                                        </td>
                                        <td>salman@gmail.com</td>
                                        <td>+234 456 789</td>

                                        <td>11-10-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/1.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">John Smith</span>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>

                                        <td>12-5-2023</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/2.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Denny Smith</span>
                                        </td>
                                        <td>sonu@gmail.com</td>
                                        <td>+456 456 789</td>

                                        <td>18-5-2009</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/3.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Denny Deo</span>
                                        </td>
                                        <td>varun@gmail.com</td>
                                        <td>+567 456 789</td>


                                        <td>12-10-2010</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/4.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Johny Deo</span>
                                        </td>
                                        <td>genelia@gmail.com</td>
                                        <td>+123 456 789</td>

                                        <td>12-10-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/5.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Rozy Smith</span>
                                        </td>
                                        <td>arijit@gmail.com</td>
                                        <td>+234 456 789</td>

                                        <td>10-09-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/1.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            Genelia Deshmukh
                                        </td>
                                        <td>genelia@gmail.com</td>
                                        <td>+123 456 789</td>

                                        <td>12-10-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/2.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Rozy Smith</span>
                                        </td>
                                        <td>arijit@gmail.com</td>
                                        <td>+234 456 789</td>

                                        <td>10-09-2014</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/3.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Govinda jalan</span>
                                        </td>
                                        <td>govinda@gmail.com</td>
                                        <td>+345 456 789</td>

                                        <td>1-10-2013</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <img src="{{ url('/') }}/admin/assets/images/users/4.jpg" alt="user"
                                                class="rounded-circle" width="30" />
                                            <span class="fw-normal">Hritik Roshan</span>
                                        </td>
                                        <td>hritik@gmail.com</td>
                                        <td>+456 456 789</td>

                                        <td>2-10-2023</td>

                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                data-bs-toggle="tooltip" data-original-title="Delete">
                                                <i class="mdi mdi-delete" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <!-- Create Modal -->
            <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="createModalLabel">
                                    <i class="ti-marker-alt me-2"></i> Create New User
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="user" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter Full Name Here"
                                        aria-label="name" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="mail" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="email" class="form-control" placeholder="Enter Email Address Here"
                                        aria-label="email" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="phone" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number Here"
                                        aria-label="no" />
                                </div>
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="download" class="feather-sm fil-white"></i>
                                    </button>
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="inputGroupFile01" />
                                    </div>
                                </div>
                                <!-- Password Input Field -->
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="lock" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="password" class="form-control" placeholder="Enter Password Here"
                                        aria-label="password" />
                                </div>

                                <!-- Confirm Password Input Field -->
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="lock" class="feather-sm fil-white"></i>
                                    </button>
                                    <input type="password" class="form-control" placeholder="Confirm Password Here"
                                        aria-label="confirm-password" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="
                      btn btn-light-danger
                      text-danger
                      font-weight-medium
                      rounded-pill
                      px-4
                    "
                                    data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success rounded-pill px-4">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End PAge Content -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection

@push('script')
@endpush
