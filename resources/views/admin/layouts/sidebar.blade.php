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
                    <a class="dropdown-item" href="{{ route('driver.profile') }}"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i>My Profile</a>


                    <div class="dropdown-divider"></div>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('driver.driver_logout') }}" onclick="confirmLogout(event)">
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





                {{-- <li class="nav-small-cap">
            <i class="mdi mdi-dots-horizontal"></i>
            <span class="hide-menu">Shipping</span>
          </li>

          <li class="sidebar-item">
            <a
              class="sidebar-link waves-effect waves-dark sidebar-link"
              href="{{ route('driver.shipping.index') }}"
              aria-expanded="false"
              ><i class="mdi mdi-truck"></i></i
              ><span class="hide-menu">Shipment details</span></a
            >
          </li> --}}
          @php

            $user = Auth::user();
          @endphp
                @if ($user->type == 1)
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">HOME</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"  href="{{ route('driver.dashboard') }}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span></a>
                </li>
                    @if ($user->driverInfo && $user->driverInfo->team === 'USA Team')
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Orders</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('driver.shipping.add') }}" aria-expanded="false"><i
                                class="mdi mdi-truck"></i></i><span class="hide-menu">New Order Pick Up</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('driver.us_invoice.list') }}" aria-expanded="false"><i
                                class="mdi mdi-credit-card"></i></i><span class="hide-menu">All Invoices</span></a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="mdi mdi-dots-horizontal"></i>
                        <span class="hide-menu">Customers</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ route('driver.customers.due_amount') }}" aria-expanded="false"><i
                                class="mdi mdi-currency-usd"></i></i><span class="hide-menu">Due Amount</span></a>
                    </li>
                    @else
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Customers</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('driver.rd_invoice.list') }}" aria-expanded="false"><i
                                    class="mdi mdi-credit-card"></i></i><span class="hide-menu">All Invoices</span></a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('driver.customers.transaction') }}" aria-expanded="false"><i
                                    class="mdi mdi-credit-card"></i></i><span class="hide-menu"
                                    style="font-size:14px!important">Transaction History</span></a>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('driver.customers.rd_due_amount') }}" aria-expanded="false"><i
                                    class="mdi mdi-currency-usd"></i></i><span class="hide-menu">Due Amount</span></a>
                        </li>
                    @endif
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
        <a href="{{ route('driver.profile') }}" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings" ><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="{{ route('driver.driver_logout') }}" onclick="confirmLogout(event)" class="link" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>
