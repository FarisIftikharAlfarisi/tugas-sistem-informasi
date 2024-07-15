<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  {{-- <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/img/favicon.png') }}" rel="icon"> --}}
  {{-- <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/boxicons/css/boxicons.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

  <!-- Links-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <main>
    <div class="container">
      
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                  
                  <div class="d-flex justify-content-center py-4">
                    @if (session()->has('loginError'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ session('loginError') }}<button type="button" class="btn-close" data-bs-dismis="alert" aria-label="close"></button></div>
          
                @endif
                @if (session()->has('succes'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismis="alert" aria-label="close"></button></div>
                @endif
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                      <img src="assets/img/logo.png" alt="">
                      <span class="d-none d-lg-block fs-2">Cinematixx</span>
                    </a>
                  </div><!-- End Logo -->

                  <div class="card mb-3">

                    <div class="card-body">
                      
                      

                      <div class="card-body">
                        
                        
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        <p class="text-center small">Enter your username & password to login</p>
                      </div>

                      <form action="{{ route('login-process') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="col-12">
                          <label for="email" class="form-label">Email</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                            </svg></span>

                            <input type="text" name="email" class="form-control" id="email" required>
                            @if (empty($email))
                                <div class="invalid-feedback">Please enter your username.</div>
                            @endif
                          </div>
                        </div>

                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="yourPassword" required>
                          @if (empty($password))
                            <div class="invalid-feedback">Please enter your password!</div>
                          @endif
                        </div>

                        {{-- <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                          </div>
                        </div> --}}
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                        {{-- <div class="col-12">
                          <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                        </div> --}}
                      </form>

                    </div>
                  </div>

                  {{-- <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                  </div> --}}

                </div>
              </div>
            </div>
        </section>
    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/js/main.js') }}"></script>

</body>

</html>
