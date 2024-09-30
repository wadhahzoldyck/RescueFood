<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>RescueFood</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('space/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('space/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('space/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('space/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('space/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('space/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('space/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('space/images/favicon.png') }}" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('Associationspace.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      @include('Associationspace.sidebar')
      @yield('content')
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('space/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('space/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('space/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('space/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('space/js/dataTables.select.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('space/js/off-canvas.js') }}"></script>
  <script src="{{ asset('space/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('space/js/template.js') }}"></script>
  <script src="{{ asset('space/js/settings.js') }}"></script>
  <script src="{{ asset('space/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('space/js/dashboard.js') }}"></script>
  <script src="{{ asset('space/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->
</body>

</html>
