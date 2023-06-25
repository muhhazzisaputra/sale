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
  		@csrf
  		@yield('content')

  		<!-- Modal small -->
	  	<div class="modal fade" id="modal-sm">
	        <div class="modal-dialog modal-sm">
	          	<div class="modal-content">
		            <div class="modal-header">
		              	<h4 class="modal-title">Small Modal</h4>
		            </div>
		            <div class="modal-body" id="modal_body_sm">
		              	<p>One fine body&hellip;</p>
		            </div>
	          	</div>
	        </div>
	    </div>

	    <!-- Modal middle -->
	    <div class="modal fade" id="modal-mid">
	        <div class="modal-dialog">
	          	<div class="modal-content">
		            <div class="modal-header">
		              	<h4 class="modal-title">Middle Modal</h4>
		            </div>
		            <div class="modal-body" id="modal_body_mid">
		              	
		            </div>
	          	</div>
	        </div>
	    </div>

	    <!-- Modal large -->
	    <div class="modal fade" id="modal-lg">
	        <div class="modal-dialog">
	          	<div class="modal-content">
		            <div class="modal-header">
		              	<h4 class="modal-title">Large Modal</h4>
		            </div>
		            <div class="modal-body" id="modal_body_lg">
		              	
		            </div>
	          	</div>
	        </div>
	    </div>

	    <!-- Modal xlarge -->
	    <div class="modal fade" id="modal-xl">
	        <div class="modal-dialog">
	          	<div class="modal-content">
		            <div class="modal-header">
		              	<h4 class="modal-title">XLarge Modal</h4>
		            </div>
		            <div class="modal-body" id="modal_body_xl">
		              	
		            </div>
	          	</div>
	        </div>
	    </div>
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
	function close_modal_sm() {
		$('#modal-sm').modal('hide');
	}

	function close_modal_mid() {
		$('#modal-mid').modal('hide');
	}

	function close_modal_lg() {
		$('#modal-lg').modal('hide');
	}

	function close_modal_xl() {
		$('#modal-xl').modal('hide');
	}

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

	// DELETE CONFIRM
    function delete_confirm(id, url_delete="") {
        let _token = $('input[name="_token"]').val();

        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(url_delete, {id, _token}, function(data) {
                    if(data.status == 'success') {
                        success_notif('Data berhasil dihapus');
                    }
                    read();
                }, 'json').fail(function(data){
                    error_notif("Data gagal dihapus");
                });
            }
        });
    }

	function num_only(data) {
        var isi   = data.value;
        var isi2  = $(this);
        let hasil = formatRupiah(isi);
        $(data).val(hasil);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka) {
        let str = angka.toString();
        var number_string = str.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah;
    }
</script>
</body>
</html>
