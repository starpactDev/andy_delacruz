<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile position-relative"
            style="background: url('{{ asset('admin/assets/images/background/user_bg1.jpeg') }}') no-repeat; background-size: cover;">
            <!-- User profile image -->
            <div class="profile-img">
                <img src="{{ url('/') }}/admin/assets/images/users/profile.png" alt="user" class="w-100" />
            </div>
            <!-- User profile text-->
            <div class="profile-text pt-1 dropdown">
                <a href="#"
                    class="
              dropdown-toggle
              u-dropdown
              w-100
              text-white
              d-block
              position-relative
            "
                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i data-feather="user"
                            class="feather-sm text-info me-1 ms-1"></i>
                        My Profile</a>


                    <div class="dropdown-divider"></div>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('user.user_logout') }}" onclick="confirmLogout(event)">
                        <i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                        Logout
                    </a>
                    <div class="dropdown-divider"></div>

                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">HOME</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.dashboard') }}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu" style="font-size:12.8px">
                            @if (Auth::user()->type == 2)
                                Manager
                            @elseif (Auth::user()->type == 0)
                                Admin
                                @else
                                Secretary
                            @endif Dashboard
                        </span></a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.profile') }}" aria-expanded="false"><i class="mdi mdi-pencil"></i>
                        <span class="hide-menu" style="font-size:12.5px!important">Profile Settings </span></a>
                </li> --}}
                @if (Auth::user()->type == 0)
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Team Manage</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                            <i class="mdi mdi-folder"></i>
                            <span class="hide-menu">My Team</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('user.customer.index') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-box" style="display:block"></i>
                                    <span class="hide-menu">MANAGERS</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('user.secretary.index') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-tie" style="display:block"></i>
                                    <span class="hide-menu">SECRETARY</span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('user.driver.index') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-circle" style="display:block"></i>
                                    <span class="hide-menu">DRIVERS </span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('user.employee.index') }}" aria-expanded="false"><i
                                        class="mdi mdi-account-outline" style="display:block"></i>
                                    <span class="hide-menu">EMPLOYEES </span></a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="{{ route('user.employee.credentials') }}" aria-expanded="false">
                                    <span class="hide-menu"style="font-size:14px !important">TEAM CREDENTIALS
                                    </span></a>
                            </li>

                        </ul>
                    </li>
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.customer.index') }}" aria-expanded="false"><i class="mdi mdi-account-box"></i>
                            <span class="hide-menu">MANAGERS</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.driver.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-circle"></i>
                            <span class="hide-menu">DRIVERS </span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.employee.index') }}" aria-expanded="false"><i class="mdi mdi-account-outline"></i>
                            <span class="hide-menu">EMPLOYEES </span></a>
                    </li> --}}
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">CUSTOMERS</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.client_follow_up.index') }}" aria-expanded="false">
                            <span class="hide-menu">Client for follow-up </span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.potential_customer.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-multiple-outline"></i>
                            <span class="hide-menu" style="font-size:14px!important">My Client List </span></a>
                    </li>

                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Potential Customers</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.add_potential_customer.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-plus"></i>
                            <span class="hide-menu">Add</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.potential_customer.view') }}" aria-expanded="false"><i
                                class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">View List</span></a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Manage Role For</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.manage_role.manager') }}" aria-expanded="false"><i
                                class="mdi mdi-account-box"></i>
                            <span class="hide-menu">MANAGERS</span></a>
                    </li>
                @endif
                {{-- for manager --}}
                @if (Auth::user()->type == 2 || Auth::user()->type == 3)
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.driver.packages') }}" aria-expanded="false"><i
                                class="mdi mdi-package-variant"></i>
                            <span class="hide-menu">Driver Packages</span></a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">DRIVERS TEAM</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.driver.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-circle"></i>
                            <span class="hide-menu">Team Drivers</span></a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">CUSTOMERS</span>
                    </li>
                    @php
                        $isClientListOff = \Illuminate\Support\Facades\DB::table('manage_permission_for_managers')
                            ->where('key', 'client_list')
                            ->where('value', 'off')
                            ->exists();
                    @endphp

                    @if (!$isClientListOff)
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('user.potential_customer.index') }}" aria-expanded="false">
                                <i class="mdi mdi-account-multiple-outline"></i>
                                <span class="hide-menu" style="font-size:14px!important">My Client List</span>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="sidebar-item">
                  <a
                    class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{ route('user.potential_customer.index') }}"
                    aria-expanded="false"
                    ><i class="mdi mdi-account"></i>
                    <span class="hide-menu">Customers List</span></a
                  >
                </li> --}}
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Potential Customers</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.add_potential_customer.index') }}" aria-expanded="false"><i
                                class="mdi mdi-account-plus"></i>
                            <span class="hide-menu">Add</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('user.potential_customer.view') }}" aria-expanded="false"><i
                                class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">View List</span></a>
                    </li>
                @endif

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Calendar</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.calendar.index') }}" aria-expanded="false"><i class="mdi mdi-eye"></i>
                        <span class="hide-menu" style="font-size:12.5px!important">Order Pickup Request </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.calendar.report') }}" aria-expanded="false"><i
                            class="mdi mdi-file-document"></i>
                        <span class="hide-menu" style="font-size:12.5px!important"> Pickup Report </span></a>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Containers</span>
                </li>
                @if (Auth::user()->type !== 3)
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.container.add') }}" aria-expanded="false"><i
                            class="mdi mdi-package-variant-closed"></i>
                        <span class="hide-menu" style="font-size:13.5px!important">Container Control </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link {{ request()->routeIs('user.container.history', 'user.container.details') ? 'active' : '' }}"
                        href="{{ route('user.container.history') }}" aria-expanded="false"><i
                            class="mdi mdi-history"></i><span class="hide-menu">Container History</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link "
                        href="{{ route('user.container.distribution') }}" aria-expanded="false">
                        <span class="hide-menu" style="font-size:15px">Container Distribution</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link "
                        href="{{ route('user.packages.distribution') }}" aria-expanded="false">
                        <span class="hide-menu" style="font-size:15px">Packages Distribution</span></a>
                </li>
@endif
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Invoices</span>
                </li>

                {{-- <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="{{ route('user.invoice.add') }}"
              aria-expanded="false"
              ><i class="mdi mdi-credit-card"></i></i
              ><span class="hide-menu">Create Invoice</span></a
            >
          </li> --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('driver.dashboard') }}" aria-expanded="false"><i
                            class="mdi mdi-history"></i><span class="hide-menu">Invoice History</span></a>
                </li> --}}
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.due_amount') }}" aria-expanded="false"><i
                            class="mdi mdi-currency-usd"></i></i><span class="hide-menu">Due Amount</span></a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Merchandise Suppliers</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.supplier.index') }}" aria-expanded="false"><i
                            class="mdi mdi-package-variant"></i></i><span class="hide-menu">DISTRIBUTORS </span></a>
                </li>
                @if (Auth::user()->type !== 3)
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Business Expense Report</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('user.business.expense') }}" aria-expanded="false"> <i
                            class="mdi mdi-file-document"></i><span class="hide-menu">BUSINESS EXPENSE </span></a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer" style=" background: #ffdedea3!important;">
        <!-- item-->

        <!-- item-->
        <a href="{{ route('user.profile') }}" class="link" data-bs-toggle="tooltip" data-bs-placement="top"
            title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="{{ route('user.user_logout') }}" onclick="confirmLogout(event)" class="link" title="Logout"><i
                class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>
