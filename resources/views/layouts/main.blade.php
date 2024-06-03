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
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/quill/quill.core.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Include Bootstrap DateTimePicker CDN -->
	<link href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="{{ asset('DashboardTemplate/NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

  <!-- Links-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  {{-- css --}}
  <link rel="stylesheet" href="{{ asset('DashboardTemplate/NiceAdmin/assets/css/style.css') }}">
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('layouts.navbar')
    @include('layouts.sidebar')

  <main id="main" class="main">

    {{-- content pages --}}
    @yield('content')
    {{-- end content pages --}}

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

  {{-- timepicker asset cdn --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <!-- Include Moment.js CDN -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('DashboardTemplate/NiceAdmin/assets/js/main.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

  {{-- initialize timepicker - Movie --}}
  <script>
    $('#datetime_start').datetimepicker({
        format: 'hh:mm:ss a'
    });
    $('#datetime_end').datetimepicker({
        format: 'hh:mm:ss a'
    });
    $('#datetime').datetimepicker({
        format: 'hh:mm:ss a'
    });
  </script>

  {{-- Initialize text editor - Movie --}}
  <script>
    const quill = new Quill('#editor', {
      theme: 'snow'
    });
  </script>

  <script src="js/main.js"></script>

</body>

</html>
