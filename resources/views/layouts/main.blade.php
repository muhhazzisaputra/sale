<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>{{ $title }}</title>

	  	<!-- Google Font: Source Sans Pro -->
	  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	  	<!-- Font Awesome -->
	  	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	  	<!-- Ionicons -->
	  	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  	<!-- JQVMap -->
	  	<link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
	  	<!-- Select2 -->
		  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
	  	<!-- Theme style -->
	  	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
	  	<!-- overlayScrollbars -->
	  	<link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	  	<!-- DataTables -->
		<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
		<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert/sweetalert2.css') }}">
  		<!-- jQuery -->
		<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  	@include('sweetalert::alert')

  	@include('layouts/navbar')

  	@include('layouts/sidebar')

  	<!-- Content Wrapper. Contains page content -->
  	<div class="content-wrapper">
  	@yield('content')
	</div>
  	<!-- /.content-wrapper -->
  	
  	<footer class="main-footer">
	    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
	    All rights reserved.
	    <div class="float-right d-none d-sm-inline-block">
	      	<b>Version</b> 3.1.0
	    </div>
  	</footer>

  	<!-- Control Sidebar -->
  	<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  	</aside>
  	<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Select2 -->
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('adminlte/plugins/sweetalert/sweetalert2.js') }}"></script>

<script type="text/javascript">
	function success_notif(message) {
		Swal.fire(
            'Success!',
            message,
            'success'
        );
	}

	function error_notif(message) {
		Swal.fire(
            'Failed!',
            message,
            'error'
        );
	}
</script>
</body>
</html>
