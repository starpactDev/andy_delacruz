<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="robots" content="noindex,nofollow" />
    <title>EMBARQUE PATON GOMEZ - Driver Dashboard</title>
    <link rel="canonical" href="" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/admin/assets/images/fav.png" />
    <!-- Select2  CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/libs/select2/dist/css/select2.min.css">
    <!-- Vector CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/libs/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet"
        href="{{ url('/') }}/admin/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/libs/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/libs/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/libs/summernote/dist/summernote-lite.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">

    <!-- Custom CSS -->
    <link href="{{ url('/') }}/admin/dist/css/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('/') }}/admin/dist/css/custom.css">
<style>
 body {
            top: 0px !important; /* Adjust body to prevent layout shift */
        }
</style>

    <style>
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on iOS */
        }

        .fa-stack {
            display: inline-block;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    /* Ensures that the dropdown content is scrollable */
    /* Prevents the body from scrolling when dropdown is open */
    body.modal-open {
        overflow: hidden;
    }
</style>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                stroke="#1e88e5" stroke-width="2"></path>
            <path
                d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                stroke="#1e88e5" stroke-width="2"></path>
            <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd"
                d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z">
            </path>
            <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" stroke="#1e88e5"></path>
            <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark"style="background: #d92b2b;!important">
                <div class="navbar-header" style="background: #d92b2b;!important">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            {{-- <img src="{{url('/')}}/admin/assets/images/rn_logo.png" alt="homepage" class="light-logo" /> --}}
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{ url('/') }}/admin/assets/images/embarq_text1.jpg" class="light-logo"
                                width="200px" height="50px" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbar toggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" style="background: #d92b2b;!important"
                    id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item">
                            <a class="nav-link sidebar toggler d-none d-md-block waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a>
                        </li>

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Mega Menu -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Mega Menu -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <div class="translator-holder">
                        <div id="google_translate_element"></div>
                    </div>

                    <script type="text/javascript">
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({
                                pageLanguage: 'en',
                                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                includedLanguages: 'en,es,fr,de,zh-CN'
                            }, 'google_translate_element');

                            // Call to hide Google Translate elements after initialization
                            hideGoogleTranslateElements();
                        }

                        function loadGoogleTranslate() {
                            var script = document.createElement('script');
                            script.type = 'text/javascript';
                            script.src = "//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";
                            document.head.appendChild(script);
                        }

                        function hideGoogleTranslateElements() {
                            // Hide the toolbar frame
                            var bannerFrame = document.querySelector('.goog-te-banner-frame');
                            if (bannerFrame) {
                                bannerFrame.style.display = 'none';
                            }

                            // Hide the iframe used by Google Translate
                            var skipTranslateIframe = document.querySelector('iframe.skiptranslate');
                            if (skipTranslateIframe) {
                                skipTranslateIframe.style.display = 'none';
                            }
                        }

                        // Ensure everything is fully loaded before initializing
                        document.addEventListener("DOMContentLoaded", function() {
                            loadGoogleTranslate(); // Load the script and initialize Google Translate

                            // Optionally, check periodically to hide Google Translate elements
                            setInterval(hideGoogleTranslateElements, 5000);
                        });
                    </script>
                    <ul class="navbar-nav">
                        @php
    // Detect which guard is authenticated
    $authGuard = Auth::guard('sender')->check() ? 'sender' : 'web';

    // Get user only if not using sender guard
    $user = $authGuard === 'web' ? Auth::user() : null;
@endphp
@if ($user && ($user->type == 0 || $user->type == 2 || $user->type == 3))
                        @php
                        $user = App\Models\User::where('id',Auth::user()->id)->first();
                        $notifications = App\Models\AddNotesByRdDriver::latest()->get();
                    @endphp
                            <li class="nav-item dropdown">
                                <a id="notificationDropdown" class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-bell" style="font-size:38px;"></i>
                                    <div class="notify">
                                        <span class="heartbit"></span>
                                        <span class="point">{{ $user->notification_count }}</span> <!-- Number displayed here -->
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end mail box dropdown-menu-animate-up">
                                    <ul class="list-style-none">
                                        <li>
                                            <div class="border-bottom rounded-top py-3 px-4">
                                                <div class="mb-0 font-weight-medium fs-4">
                                                    Notifications

                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="message-center notifications position-relative"
                                                style="height: 230px">
                                                <!-- Message -->

                                                <!-- Message -->
                                                @foreach ($notifications as $notification )
                                                <a href="{{ route('user.notification.index') }}"
                                                class=" message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class=" btn btn-light-success text-success btn-circle">
                                                    <i data-feather="calendar" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Reminder
                                                    </h5>
                                                    <span
                                                        class=" fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">
                                                       {{ $notification->add_note }}</span>
                                                       <span class="fs-2 text-nowrap d-block subtext text-muted">
                                                        {{ $notification->created_at->format('d M Y, h:i A') }}
                                                    </span>
                                                </div>
                                            </a>
                                                @endforeach

                                                <!-- Message -->

                                                <!-- Message -->

                                            </div>
                                        </li>
                                        <li>
                                            <a class="nav-link border-top text-center text-dark pt-3"
                                                href="{{ route('user.notification.index') }}">
                                                <strong>Check all notifications</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->image)
                                    <img src="{{ asset('admin/upload/images/profile/' . Auth::user()->image) }}"
                                        alt="user" width="50" class="profile-pic rounded-circle" />
                                @else
                                    <img src="{{ url('/') }}/admin/assets/images/users/1.jpg" alt="user"
                                        width="30" class="profile-pic rounded-circle" />
                                @endif
                            </a>
                            <div class=" dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                <div class=" d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                                    <div class="">
                                        @if (Auth::user()->image)
                                            <img src="{{ asset('admin/upload/images/profile/' . Auth::user()->image) }}"
                                                alt="user" class="rounded-circle" width="60" />
                                        @else
                                            <img src="{{ url('/') }}/admin/assets/images/users/1.jpg"
                                                alt="user" class="rounded-circle" width="60" />
                                        @endif

                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-white">{{ Auth::user()->name }}</h4>
                                        <p class="mb-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                @if (Auth::user()->type == 1)
                                    <a class="dropdown-item" href="{{ route('driver.profile') }}"><i
                                            data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
                                        Profile</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('user.profile') }}"><i
                                            data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
                                        Profile</a>
                                @endif

                                <div class="dropdown-divider"></div>

                                <div class="dropdown-divider"></div>
                                @if (Auth::user()->type == 1)
                                    <a class="dropdown-item" data-bs-toggle="tooltip"
                                        href="{{ route('driver.driver_logout') }}" onclick="confirmLogout(event)"
                                        data-bs-placement="top"><i data-feather="log-out"
                                            class="feather-sm text-danger me-1 ms-1"></i>
                                        Logout</a>
                                @else
                                    <a class="dropdown-item" data-bs-toggle="tooltip"
                                        href="{{ route('user.user_logout') }}" onclick="confirmLogout(event)"
                                        data-bs-placement="top"><i data-feather="log-out"
                                            class="feather-sm text-danger me-1 ms-1"></i>
                                        Logout</a>
                                @endif
                                <div class="dropdown-divider"></div>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->

                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @if (Auth::user()->type == 1)
            @include('admin.layouts.sidebar')
        @else
            @include('user.layouts.sidebar')
        @endif
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style=" background: #f0f4f7!important;">
            @yield('content')
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                All Rights Reserved by <a href="http://promarketingcenter.com/">Promarketingcenter.com</a> .
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ url('/') }}/admin/dist/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('/') }}/admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="{{ url('/') }}/admin/dist/js/app.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/app.init.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ url('/') }}/admin/dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="{{ url('/') }}/admin/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ url('/') }}/admin/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('/') }}/admin/dist/js/feather.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/custom.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/tablesaw/dist/tablesaw.jquery.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/tablesaw/dist/tablesaw-init.js"></script>

    <script src="{{ url('/') }}/admin/dist/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/pages/forms/sweetalert2/sweet-alert.init.js"></script>

    <!-- Vector map JavaScript -->
    <script src="{{ url('/') }}/admin/dist/libs/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/extra-libs/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- Chart JS -->
    <script src="{{ url('/') }}/admin/dist/js/pages/dashboards/dashboard2.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/pages/datatable/datatable-basic.init.js"></script>


    <script src="{{ url('/') }}/admin/dist/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/libs/select2/dist/js/select2.min.js"></script>
    <script src="{{ url('/') }}/admin/dist/js/pages/forms/select2/select2.init.js"></script>

    <script src="{{ url('/') }}/admin/dist/js/pages/email/email.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Prevent the default anchor behavior


            let target = event.target;

            // Check if the target is not an <a> tag
            if (target.tagName.toLowerCase() !== 'a') {
                // Find the closest parent <a> tag
                target = target.closest('a');
            }

            // Log the target to see what it is
            console.log("Event target:", event.target);
            console.log("Resolved target:", target);

            // Log the href attribute to check its value
            const hrefValue = target.getAttribute('href');
            console.log("Logout href:", hrefValue);
            if (!hrefValue) {
                console.error("Href attribute is missing or empty");
                return;
            }
            Swal.fire({
                title: 'Logout',
                html: `
              <div class="modal-body">
                <p>Are you sure you want to logout?</p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" id="cancel-button">Close</button>
                <a href="${hrefValue}" class="btn btn-success" id="confirm-button">Logout</a>
              </div>
            `,
                showConfirmButton: false,
                showCancelButton: false,
                didOpen: () => {
                    const cancelButton = Swal.getPopup().querySelector('#cancel-button');
                    const confirmButton = Swal.getPopup().querySelector('#confirm-button');

                    cancelButton.addEventListener('click', () => Swal.close());
                    confirmButton.addEventListener('click', () => {

                        Swal.fire({
                            title: 'Logging out...',
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        window.location.href = confirmButton.getAttribute('href');
                    });
                }
            });
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

    <script src="{{ url('/') }}/admin/dist/libs/summernote/dist/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote
        });
    </script>
    <script>
        document.getElementById('notificationDropdown').addEventListener('click', function () {
            // Send an AJAX request to decrement the notification count
            fetch("{{ route('notifications.decrement') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the notification count on the frontend
                    document.querySelector('.notify .point').textContent = '0';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    @stack('script')
</body>

</html>
