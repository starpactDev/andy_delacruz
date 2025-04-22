<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="robots" content="noindex,nofollow" />
    <title>EMBARQUE PATON GOMEZ - Login</title>
    <link rel="canonical" href="" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/admin/assets/images/favicon.png" />
    <!-- Custom CSS -->
    <link href="{{ url('/') }}/admin/dist/css/style.min.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .responsive-logo {
    height: 135px; /* Default height for larger screens */
}

@media (max-width: 768px) { /* Adjust this breakpoint as needed */
    .responsive-logo {
        height: 100px;
    }
}


</style>
<body>
    <div class="main-wrapper">
        <!-- -------------------------------------------------------------- -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- -------------------------------------------------------------- -->
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
                <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" stroke="#1e88e5"></path>
                <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
        <div class="
          auth-wrapper
          d-flex
          no-block
          justify-content-center
          align-items-center
        "
            style="
  background: url('admin/assets/images/background/login_bg_5.jpg') no-repeat center center;
  background-size: cover;
">

            <div class="auth-box p-4 bg-white rounded">
                <div id="loginform">
                    <div class="logo text-center">
                        <span class="db"><img src="{{ url('/') }}/admin/assets/images/andy.png"
                                class="responsive-logo" alt="logo" /></span>
                        <h5 class="font-weight-medium mb-3 mt-3">Sign Up to Dashboard</h5>
                        @if (Session::has('success'))

                            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <i class="mdi mdi-account-check"></i>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                                role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" id="loginform" method="post"
                                action="{{ route('user_login_check') }}" autocomplete="off">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="">
                                        <input class="form-control" type="text" name="email" id="email"
                                            placeholder="UserEmail" />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="">
                                        <input class="form-control" type="password" name="password"
                                            placeholder="Password" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex">
                                        <div class="checkbox checkbox-info pt-0">
                                            <input id="checkbox-signup" type="checkbox"
                                                class="material-inputs chk-col-indigo" />

                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" id="to-recover"
                                                class="link font-weight-medium"><i class="fa fa-lock me-1"></i> Forgot
                                                pwd?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center mt-4 mb-3">
                                    <div class="col-xs-12">
                                        <button
                                            class="
                          btn btn-info
                          d-block
                          w-100
                          waves-effect waves-light
                        "
                                            type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
                <div id="recoverform">
                    <div id="loader" style="display: none; text-align: center;">
                        <img src="https://i.gifer.com/ZZ5H.gif" alt="Loading..." />
                    </div>
                    <div class="logo">
                        <h3 class="font-weight-medium mb-3" style="color:rgb(81, 23, 134)">Recover Password</h3>
                        <span class="text-muted">Enter your Email and instructions will be sent to you!</span>
                    </div>
                    <div class="row mt-3 form-material">
                        <!-- Form -->
                        <form class="col-12" id="reset-password-form">
                            <!-- email -->
                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="email" id="userEmail" required=""
                                        placeholder="UserEmail" />
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button id="resetButton" class="btn d-block w-100 btn-primary text-uppercase" type="submit"
                                    name="action">
                                    Reset Password Link
                                </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- Login box.scss -->
        <!-- -------------------------------------------------------------- -->
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- All Required js -->
    <!-- -------------------------------------------------------------- -->
    <script src="{{ url('/') }}/admin/dist/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('/') }}/admin/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- -------------------------------------------------------------- -->
    <!-- This page plugin js -->
    <!-- -------------------------------------------------------------- -->

    <script>
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $("#to-recover").on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>

    <script>
        function toggle_div_fun(id) {
            var divelement = document.getElementById(id);
            if (divelement.style.display == 'none')
                divelement.style.display = 'block';
            else
                divelement.style.display = 'none';
        }
    </script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

      <script>
          $(document).ready(function() {
              $('#reset-password-form').on('submit', function(e) {

                  e.preventDefault(); // Prevent the form from refreshing the page

                  const email = $('#userEmail').val();
                  const submitButton = $('#resetButton'); // Reference to the submit button

                  // Disable the button and change its text
                  submitButton.prop('disabled', true).text('Processing...');

                  // Show the loader
                  $('#loader').show();

                  if (!email) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Please enter an email!',
                      });
                      $('#loader').hide(); // Hide loader after error

                      // Re-enable the button after showing the error
                      submitButton.prop('disabled', false).text('Reset Password Link');
                      return;
                  }

                  $.ajax({
                      url: "{{ route('check.email') }}",
                      type: 'POST',
                      data: {
                          _token: "{{ csrf_token() }}",
                          email: email
                      },
                      success: function(response) {
                          // Hide the loader after success
                          $('#loader').hide();

                          if (response.success) {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Success',
                                  text: response.message,
                              }).then(() => {
                                  // Change the button text to "Sent" after Swal is closed
                                  submitButton.text('Sent');
                              });
                          } else {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Error',
                                  text: response.message || 'Something went wrong!',
                              });

                              // Re-enable the button in case of an error
                              submitButton.prop('disabled', false).text('Reset Password Link');
                          }
                      },
                      error: function(xhr) {
                          // Hide the loader after error
                          $('#loader').hide();

                          Swal.fire({
                              icon: 'error',
                              title: 'Error',
                              text: xhr.responseJSON.message || 'Something went wrong!',
                          });

                          // Re-enable the button in case of an error
                          submitButton.prop('disabled', false).text('Reset Password Link');
                      }
                  });
              });
          });
      </script>
</body>

</html>
