<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AIMS Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset("plugins/jqvmap/jqvmap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("admin/css/adminlte.min.css")}}">

    <link rel="stylesheet" href="{{asset("plugins/toastr/toastr.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
{{--    <link href="{{asset("plugins/datatables-select/css/select.bootstrap4.min.css")}}">--}}
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    {{--<script src="{{asset("plugins/jquery-ui/jquery-ui.min.js")}}"></script>--}}
    {{--<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->--}}
    {{--<script>--}}
    {{--    $.widget.bridge('uibutton', $.ui.button)--}}
    {{--</script>--}}

    <!-- Bootstrap 4 -->
    <script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- DataTables -->
    <script src="{{asset("plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
{{--    <!-- Select datatable -->--}}
{{--    <script src="{{asset("plugins/datatables-select/js/dataTables.select.min.js")}}"></script>--}}
{{--    <script src="{{asset("plugins/datatables-select/js/select.bootstrap4.min.js")}}"></script>--}}
    <!-- overlayScrollbars -->
    <script src="{{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("admin/js/adminlte.js")}}"></script>

    <script src="{{asset("plugins/sweetalert2/sweetalert2.min.js")}}"></script>

    <script src="{{asset("plugins/toastr/toastr.min.js")}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    @include('admin::layouts.navbar')
    <!-- End Navbar-->

    <!-- Main Sidebar Container -->
    @include('admin::layouts.sidebar')
    <!-- End Main Sidebar Container -->

    @yield('content')
    <!-- /.content-wrapper -->
    @include('admin::layouts.footer')
</div>
{{--@stack('scripts')--}}
</body>
</html>
