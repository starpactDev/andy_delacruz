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
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"  href="{{ route('customer.dashboard') }}"
                        aria-expanded="false">
                        <span class="hide-menu">Customer Dashboard</span></a>
                </li>



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
       



            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->

    <!-- End Bottom points-->
</aside>

