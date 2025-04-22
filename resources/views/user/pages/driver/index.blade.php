@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .blue-bar {
            width: 100%;
            /* Make the bar stretch the full width */
            height: 20px;
            /* Adjust the height of the bar */
            background-color: blue;
            /* Set the color to blue */
            margin-bottom: 20px;
            /* Add some space above and below the bar */
        }
        .action-buttons {
    width: 100%; /* Allow the buttons to take up the full width of the cell */
    height: auto; /* Adapt height dynamically */
    display: flex;
    flex-direction: column;
    align-items: center; /* Center buttons horizontally */
    justify-content: space-evenly; /* Add even space between buttons */
    padding: 10px; /* Add padding for extra spacing */
    box-sizing: border-box; /* Include padding in width/height calculations */
}

.action-buttons button {
    margin: 5px 0; /* Add more space between buttons */
}

td {
    padding: 15px; /* Make the <td> spacious */
    vertical-align: middle; /* Vertically align content */
    overflow: hidden; /* Ensure content stays within boundaries */
    word-wrap: break-word; /* Prevent overflow due to text */
}
    </style>
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Drivers List</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Drivers List</li>
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
                            <h4 class="card-title"><img src="{{ url('/') }}/admin/assets/images/users/usa.jpg"
                                    alt="user" class="rounded-circle" width="40" /> USA DRIVERS</h4>

                                    @if(!$addPermissionExists)
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
                                        data-bs-toggle="modal" data-bs-target="#createmodel" data-team="usa">
                                        Create New Account
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="d-none d-sm-table-cell">Driver Id</th>
                                        <th class="d-none d-sm-table-cell">Name</th>
                                        <th class="d-none d-sm-table-cell">Email</th>
                                        <th class="d-none d-sm-table-cell">Phone</th>
                                        <th class="d-none d-sm-table-cell">Address</th>
                                        <th class="d-none d-sm-table-cell">Team</th>


                                        <th class="d-none d-sm-table-cell">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usaTeamDrivers as $driver)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>


                                                <img src="{{ url('/') }}/admin/upload/images/driver/{{ $driver->user->image ?? 'profile.png' }}"
                                                    alt="{{ $driver->user->name }}" class="rounded-circle" width="30" />
                                                <span class="fw-normal">{{ $driver->user->name }}</span>
                                            </td>
                                            <td>{{ $driver->user->email }}</td> <!-- Fetch email from the related user -->
                                            <td>{{ $driver->user->phone }}</td> <!-- Fetch phone from the related user -->
                                            <td>{{ $driver->street }}, {{ $driver->city }}, {{ $driver->state }}
                                                {{ $driver->zip }}</td> <!-- Driver address -->
                                            <td>{{ $driver->team }}</td>
                                            <!-- Display the team, which should be 'USA Team' -->


                                            <td>
                                                <div class="action-buttons">
                                                    @if(!$editPermissionExists)
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $driver->user_id }}">
                                                        <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    @endif

                                                    @if(!$deletePermissionExists)
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                        data-bs-toggle="tooltip" data-original-title="Delete"
                                                        data-id="{{ $driver->user_id }}">
                                                        <i class="mdi mdi-delete" aria-hidden="true"></i>
                                                    </button>
                                                    @endif
                                                </div>
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
            <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="driverForm" enctype="multipart/form-data">
                            <div class="modal-body">
                                <!-- Profile Picture -->
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info">
                                        <i data-feather="download" class="feather-sm fil-white"></i>
                                    </button>
                                    <div class="custom-file">
                                        <label for="profileImage" class="form-control">Upload Profile Picture</label>
                                        <input type="file" class="form-control" id="profileImage" name="profileImage" />
                                    </div>
                                </div>

                                <!-- First Name -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter First Name Here"
                                        name="first_name" />
                                </div>

                                <!-- Last Name -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Last Name Here"
                                        name="last_name" />
                                </div>
                                <div id="dominicanFields" style="display: none;">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Second Last Name Here"
                                            name="second_last_name" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Nickname Here"
                                            name="nickname" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Neighborhood Here"
                                            name="neighborhood" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="province">Province :</label>
                                        <select class="form-select" id="province" name="province">
                                            <option selected disabled>-- Select Province --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country">Country :</label>
                                        <input type="text" class="form-control fw-bold text-uppercase" id="country" value="DOMINICAN REPUBLIC" readonly />                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Reference Here"
                                            name="reference" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Enter Cell Number Here"
                                            name="cell" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                            placeholder="Enter WhatsApp Number Here" name="whatsapp" />
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Enter Email Address Here"
                                        name="email" />
                                </div>

                                <!-- Phone -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Telephone Number Here"
                                        name="phone" />
                                </div>

                                <!-- Street -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Street Address Here"
                                        name="street" />
                                </div>

                                <!-- City -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter City Here"
                                        name="city" />
                                </div>

                                <!-- State -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter State Here"
                                        name="state" />
                                </div>

                                <!-- ZIP -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter ZIP Code Here"
                                        name="zip" />
                                </div>

                                <div class="note-box mb-3"
                                    style="border: 1px solid #c7760d; padding: 10px; font-size: 12px; color: #a30b0b;">
                                    <strong>Note:</strong> Password should be a minimum of <b>6 characters</b>, including at
                                    least <b>one special character and one uppercase letter</b>.
                                </div>

                                <!-- Password -->
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Enter Password Here"
                                        name="password" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm Password Here"
                                        name="confirm_password" />
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success" name="team"
                                        placeholder="Team" readonly>
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-users feather-sm text-success fill-white me-2">
                                            <path d="M17 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M7 21v-2a4 4 0 0 1 3-3.87"></path>
                                            <path d="M12 3a4 4 0 0 1 0 8"></path>
                                            <path d="M5.4 12a4 4 0 0 1 0-8"></path>
                                            <path d="M18.6 12a4 4 0 0 0 0-8"></path>
                                        </svg>
                                        <span class="border-start border-success ps-3">Team</span>
                                    </label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger text-danger"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <div class="blue-bar"></div>

        <div class="row">
            <!-- Column -->
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-4">
                            <h4 class="card-title"><img src="{{ url('/') }}/admin/assets/images/users/dom.jpg"
                                    alt="user" class="rounded-circle" width="40" /> DOMINICAN REPUBLIC DRIVERS
                            </h4>
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
                                        data-bs-toggle="modal" data-bs-target="#createmodel" data-team="dominican">
                                        Create New Account
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="default_order" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Driver Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Team</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dominicanTeamDrivers as $driver)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>


                                                <img src="{{ url('/') }}/admin/upload/images/driver/{{ $driver->user->image ?? 'profile.png' }}"
                                                    alt="{{ $driver->user->name }}" class="rounded-circle"
                                                    width="30" />
                                                <span class="fw-normal">{{ $driver->user->name }}</span>
                                            </td>
                                            <td>{{ $driver->user->email }}</td> <!-- Fetch email from the related user -->
                                            <td>{{ $driver->user->phone }}</td> <!-- Fetch phone from the related user -->
                                            <td>{{ $driver->street }}, {{ $driver->city }}, {{ $driver->state }}
                                                {{ $driver->zip }}</td> <!-- Driver address -->
                                            <td>{{ $driver->team }}</td>
                                            <!-- Display the team, which should be 'USA Team' -->
                                            <td>
                                                <div class="action-buttons">
                                                    <!-- View Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-info view-row-btn"
                                                        data-bs-toggle="modal" data-bs-target="#viewModal"
                                                        data-id="{{ $driver->user_id }}">
                                                        <i class="mdi mdi-eye" aria-hidden="true"></i>
                                                    </button>

                                                    @if(!$editPermissionExists)
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-warning edit-row-btn"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        data-id="{{ $driver->user_id }}">
                                                        <i class="mdi mdi-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    @endif

                                                    @if(!$deletePermissionExists)
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-pure btn-outline btn-danger delete-row-btn"
                                                        data-bs-toggle="tooltip" data-original-title="Delete"
                                                        data-id="{{ $driver->user_id }}">
                                                        <i class="mdi mdi-delete" aria-hidden="true"></i>
                                                    </button>
                                                    @endif
                                                </div>
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

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-xl">
                    <form id="editDriverForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id">

                            <!-- Profile Picture Preview -->
                            <div class="text-center mb-3">
                                <img id="profilePreview" src="" class="rounded-circle" width="50"
                                    height="40" alt="Profile Image">
                            </div>

                            <!-- Profile Image Input -->
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="editProfileImage" name="profileImage"
                                    accept="image/*">
                            </div>

                            <!-- First Name -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success" placeholder="First Name"
                                    id="editFirstName" name="first_name">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-user feather-sm text-success fill-white me-2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="border-start border-success ps-3">First Name</span>
                                </label>
                            </div>

                            <!-- Last Name -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success" placeholder="Last Name"
                                    id="editLastName" name="last_name">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-user feather-sm text-success fill-white me-2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="border-start border-success ps-3">Last Name</span>
                                </label>
                            </div>
                            <div id="dominicanTeamFields" style="display: none;">
                                <!-- Second Last Name -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Second Last Name" id="editSecondLastName" name="second_last_name">
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-user feather-sm text-success fill-white me-2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="border-start border-success ps-3">Second Last Name</span>
                                    </label>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Nickname" id="editNickname" name="nickname">
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-user feather-sm text-success fill-white me-2">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="border-start border-success ps-3">Nickname</span>
                                    </label>

                                </div>


                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control border border-success"
                                        placeholder="Neighborhood" id="editNeighborhood" name="neighborhood">
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-home feather-sm text-success fill-white me-2">
                                            <path d="M3 9.5l9-7 9 7"></path>
                                            <path d="M9 22V12H5v10"></path>
                                            <path d="M16 22v-6h-4v6"></path>
                                        </svg>
                                        <span class="border-start border-success ps-3">Neighborhood</span>
                                    </label>
                                </div>


                                <!-- Province -->
                                <div class="mb-3">
                                    <label for="editProvince" class="form-label d-flex align-items-center">
                                        <span class="border-start border-success ps-3">Province</span>
                                    </label>
                                    <div class="input-group">

                                        <select class="form-select" id="editProvince" name="province">
                                            <option selected disabled>-- Select Province --</option>
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                </option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>

                                <!-- Reference -->
                                <div class="mb-3">
                                    <label for="editReference" class="form-label d-flex align-items-center">
                                        <span class="border-start border-success ps-3">Reference</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control border border-success"
                                            placeholder="Reference" id="editReference" name="reference">
                                    </div>
                                </div>
                                <!-- Cell -->
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control border border-success" placeholder="Cell"
                                        id="editCell" name="cell">
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-phone feather-sm text-success fill-white me-2">
                                            <path
                                                d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                            </path>
                                        </svg>
                                        <span class="border-start border-success ps-3">Cell</span>
                                    </label>
                                </div>




                                <!-- WhatsApp -->
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control border border-success"
                                        placeholder="WhatsApp" id="editWhatsApp" name="whatsapp">
                                    <label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            class="feather feather-phone feather-sm text-success fill-white me-2">
                                            <path
                                                d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                            </path>
                                        </svg>
                                        <span class="border-start border-success ps-3">WhatsApp</span>
                                    </label>
                                </div>

                            </div>
                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border border-success" placeholder="Email"
                                    id="editEmail" name="email">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-mail feather-sm text-success fill-white me-2">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <span class="border-start border-success ps-3">Email address</span>
                                </label>
                            </div>

                            <!-- Phone -->
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control border border-success"
                                    placeholder="Phone Number" id="editPhone" name="phone">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-phone feather-sm text-success fill-white me-2">
                                        <path
                                            d="M22 16.92V23a2 2 0 0 1-2.18 2A19.86 19.86 0 0 1 3 4.18 2 2 0 0 1 5 2h6.09a2 2 0 0 1 2 1.72 16 16 0 0 0 .21 2.27c.09.64-.26 1.28-.89 1.64l-2.13 1.27a1 1 0 0 0-.29 1.41c1.28 2 3.12 3.84 5.12 5.12a1 1 0 0 0 1.41-.29l1.27-2.13c.36-.63 1-.98 1.64-.89a16 16 0 0 0 2.27.21 2 2 0 0 1 1.72 2V23z">
                                        </path>
                                    </svg>
                                    <span class="border-start border-success ps-3">Phone Number</span>
                                </label>
                            </div>

                            <!-- Street -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success"
                                    placeholder="Street Address" id="editStreet" name="street">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-map-pin feather-sm text-success fill-white me-2">
                                        <path d="M21 10c0 7.34-9 13-9 13S3 17.34 3 10a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span class="border-start border-success ps-3">Street</span>
                                </label>
                            </div>

                            <!-- City -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success" placeholder="City"
                                    id="editCity" name="city">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-home feather-sm text-success fill-white me-2">
                                        <path d="M3 9.5l9-7 9 7"></path>
                                        <path d="M9 22V12H5v10"></path>
                                        <path d="M16 22v-6h-4v6"></path>
                                    </svg>
                                    <span class="border-start border-success ps-3">City</span>
                                </label>
                            </div>

                            <!-- State -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success" placeholder="State"
                                    id="editState" name="state">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-globe feather-sm text-success fill-white me-2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10A15.3 15.3 0 0 1 8 12 15.3 15.3 0 0 1 12 2z">
                                        </path>
                                    </svg>
                                    <span class="border-start border-success ps-3">State</span>
                                </label>
                            </div>

                            <!-- ZIP Code -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border border-success" placeholder="Zip Code"
                                    id="editZip" name="zip">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-hash feather-sm text-success fill-white me-2">
                                        <line x1="4" y1="9" x2="20" y2="9"></line>
                                        <line x1="4" y1="15" x2="20" y2="15"></line>
                                        <line x1="10" y1="3" x2="8" y2="21"></line>
                                        <line x1="16" y1="3" x2="14" y2="21"></line>
                                    </svg>
                                    <span class="border-start border-success ps-3">Zip Code</span>
                                </label>
                            </div>

                            <!-- Team -->


                            <div class="mb-3">
                                <label for="editTeam" class="form-label d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-users feather-sm text-success fill-white me-2">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    <span class="border-start border-success ps-3">Team</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="editTeam" name="team"
                                        value="" readonly>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger text-danger"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- View Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">View Driver Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <!-- Profile Picture Preview -->
                            <div class="text-center mb-3">
                                <img id="profileViewPreview" src="" class="rounded-circle" width="50"
                                    height="40" alt="Profile Image">
                            </div>
                            <tbody>
                                <tr>
                                    <th>First Name</th>
                                    <td id="viewFirstName"></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td id="viewLastName"></td>
                                </tr>
                                <tr>
                                    <th>Second Last Name</th>
                                    <td id="viewSecondLastName"></td>
                                </tr>
                                <tr>
                                    <th>Nickname</th>
                                    <td id="viewNickname"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="viewEmail"></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td id="viewPhone"></td>
                                </tr>
                                <tr>
                                    <th>Street</th>
                                    <td id="viewStreet"></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td id="viewCity"></td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td id="viewState"></td>
                                </tr>
                                <tr>
                                    <th>Zip</th>
                                    <td id="viewZip"></td>
                                </tr>
                                <tr>
                                    <th>Team</th>
                                    <td id="viewTeam"></td>
                                </tr>

                                <tr>
                                    <th>Neighborhood</th>
                                    <td id="viewNeighborhood"></td>
                                </tr>
                                <tr>
                                    <th>Province</th>
                                    <td id="viewProvince"></td>
                                </tr>
                                <tr>
                                    <th>Reference</th>
                                    <td id="viewReference"></td>
                                </tr>
                                <tr>
                                    <th>Cell</th>
                                    <td id="viewCell"></td>
                                </tr>
                                <tr>
                                    <th>WhatsApp</th>
                                    <td id="viewWhatsApp"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#createmodel').on('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                var button = $(event.relatedTarget);
                // Extract the team data attribute
                var team = button.data('team');
                // Show or hide additional fields based on team selection
                if (team === 'dominican') {
                    $('#dominicanFields').show(); // Show Dominican-specific fields
                } else {
                    $('#dominicanFields').hide(); // Hide Dominican-specific fields
                }
                // Update the input field with the team value
                var teamInput = $(this).find('input[name="team"]');
                teamInput.val(team === 'usa' ? 'USA Team' :
                    'Dominican Team'); // Set the input value based on team
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#driverForm').on('submit', function(e) {
                e.preventDefault();
                // Get the password, confirm password, and team values
                var password = $('[name="password"]').val();
                var confirmPassword = $('[name="confirm_password"]').val();
                var team = $('[name="team"]').val();
                // Regular expression for password validation
                var passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{6,}$/;

                // Check if passwords do not match
                if (password !== confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Password and Confirm Password do not match!'
                    });
                    return; // Stop form submission
                }
                // Check if password meets the criteria
                if (!passwordPattern.test(password)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password',
                        text: 'Password should be a minimum of 6 characters, include at least one special character and one uppercase letter.'
                    });
                    return; // Stop form submission
                }
                // Check if "Select Team" is still selected
                if (team === "Select Team") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please select a valid team!'
                    });
                    return; // Stop form submission
                }

                // Collect form data
                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Ajax request to save data
                $.ajax({
                    url: '{{ route('user.driver.store') }}', // This will use the named route
                    type: 'POST',
                    data: formData,
                    processData: false, // Important for file upload
                    contentType: false, // Important for file upload
                    success: function(response) {
                        // Handle success
                        Swal.fire({
                            icon: 'success',
                            title: 'Driver Created Successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#createmodel').modal('hide');
                        // Clear any previous error messages after a successful submission
                        $('.text-danger').remove();
                        $('input').removeClass('is-invalid');
                        location.reload();
                    },
                    error: function(xhr) {
                        // Clear any previous error messages
                        $('.text-danger').remove();
                        $('input').removeClass('is-invalid');

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            // Iterate over the validation errors
                            $.each(errors, function(fieldName, errorMessages) {
                            var field = $('[name="' + fieldName +
                                '"]'); // Find the input field
                            // Find the parent input-group and append the validation message in a new div after it
                            field.closest('.input-group').after(
                                '<div class="mb-3"><span class="text-danger error-message">' +
                                errorMessages[0] + '</span></div>');
                        });
                        } else {
                            // Handle other errors (if any)
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON.message
                            });
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '.edit-row-btn', function() {
            var userId = $(this).data('id');
            $('#editDriverForm').find('input[name="user_id"]').val(userId);
            var url = '{{ route('user.driver.edit', ':id') }}';
            url = url.replace(':id', userId);
            // AJAX request to get driver details
            $.ajax({
                url: url, // Use the dynamically generated route
                type: 'GET',
                success: function(data) {
                    // Populate the modal fields with the data
                    $('#editFirstName').val(data.first_name);
                    $('#editLastName').val(data.last_name);
                    $('#editEmail').val(data.email);
                    $('#editPhone').val(data.phone);
                    $('#editStreet').val(data.street);
                    $('#editCity').val(data.city);
                    $('#editState').val(data.state);
                    $('#editZip').val(data.zip);
                    $('#editTeam').val(data.team);
                    $('#editSecondLastName').val(data.second_last_name); // Second Last Name
                    $('#editNickname').val(data.nickname); // Nickname
                    $('#editNeighborhood').val(data.neighborhood); // Neighborhood
                    $('#editProvince').val(data.province); // Province
                    $('#editReference').val(data.reference); // Reference
                    $('#editCell').val(data.cell); // Cell
                    $('#editWhatsApp').val(data.whatsapp); // WhatsApp
                    var team = $('#editTeam').val();

                    if (team === 'Dominican Team') {

                        $('#dominicanTeamFields').show(); // Show Dominican-specific fields
                    } else {
                        $('#dominicanTeamFields').hide(); // Hide Dominican-specific fields
                    }
                    var baseUrl = "{{ url('/') }}"; // Pass the base URL to JavaScript

                    // Set profile image preview
                    if (data.profileImage) {
                        $('#profilePreview').attr('src', baseUrl + '/admin/upload/images/driver/' + data
                            .profileImage);
                    } else {
                        $('#profilePreview').attr('src', baseUrl +
                            '/admin/upload/images/driver/profile.png'); // Fallback image
                    }
                }
            });
        });
    </script>
    <script>
        $('#editDriverForm').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var userId = $('#user_id').val();


            // Add CSRF token to the FormData
            formData.append('_token', '{{ csrf_token() }}');

            // Use named route for the update URL
            var updateUrl = '{{ route('user.driver.update', ':id') }}';
            updateUrl = updateUrl.replace(':id', userId);

            $.ajax({
                url: updateUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show success message with SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        $('#editModal').modal('hide');
                        location.reload(); // Reload the page to reflect changes
                    });
                },
                error: function(xhr) {
                    // Show error message with SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error updating driver. Please try again.',
                    });
                }
            });
        });
    </script>
    {{-- For Driver Delete --}}
    <script>
        $('.delete-row-btn').on('click', function() {
            var userId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('user.driver.destroy', '') }}/' + userId, // Use route name
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // Include CSRF token
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Your driver has been deleted.',
                                'success'
                            );
                            location.reload(); // Reload the page to show updated data
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the driver.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.view-row-btn', function() {
            var userId = $(this).data('id');
            var url = '{{ route('user.driver.show', ':id') }}'; // Adjust route as necessary
            url = url.replace(':id', userId);

            // AJAX request to get driver details
            $.ajax({
                url: url, // Use the dynamically generated route
                type: 'GET',
                success: function(data) {
                    // Populate the view modal fields with the data
                    $('#viewFirstName').text(data.first_name);
                    $('#viewLastName').text(data.last_name);
                    $('#viewEmail').text(data.email);
                    $('#viewPhone').text(data.phone);
                    $('#viewStreet').text(data.street);
                    $('#viewCity').text(data.city);
                    $('#viewState').text(data.state);
                    $('#viewZip').text(data.zip);
                    $('#viewTeam').text(data.team);
                    $('#viewSecondLastName').text(data.second_last_name);
                    $('#viewNickname').text(data.nickname);
                    $('#viewNeighborhood').text(data.neighborhood);
                    $('#viewProvince').text(data.province);
                    $('#viewReference').text(data.reference);
                    $('#viewCell').text(data.cell);
                    $('#viewWhatsApp').text(data.whatsapp);

                    var baseUrl = "{{ url('/') }}"; // Pass the base URL to JavaScript
                    if (data.profileImage) {

                        $('#profileViewPreview').attr('src', baseUrl + '/admin/upload/images/driver/' +
                            data
                            .profileImage);
                    } else {

                        $('#profileViewPreview').attr('src', baseUrl +
                            '/admin/upload/images/driver/profile.png'); // Fallback image
                    }
                },
                error: function(xhr) {
                    // Handle error
                    console.error('Error fetching driver details:', xhr);
                }
            });
        });
    </script>
@endpush
