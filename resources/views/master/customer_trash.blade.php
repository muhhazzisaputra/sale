@extends('layouts/main')

@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<section class="content-header">
  	<div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0">{{ $title }}</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
	              	<li class="breadcrumb-item"><a href="/customer">Customer</a></li>
	              	<li class="breadcrumb-item active">{{ $title }}</li>
	            </ol>
          	</div>
        </div>
  	</div>
</section>

<!-- Main content -->
<section class="content">
  	<div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
        		@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('success') }}
                </div>
                @endif
	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data {{ $title }}</h3>
	                	<div class="card-tools">
	                		<a href="/customer/restore" class="btn btn-sm btn-success"><i class="fa fa-trash-restore"></i> Restore Semua Data</a>
			              	<a href="/customer/forceDelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus Permanen Semua Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	              		<div class="table-responsive">
		                	<table id="tbl-customers" class="table table-bordered table-striped">
		                  		<thead>
				                  	<tr>
					                    <th class="text-center">#</th>
					                    <th class="text-center">Nama Customer</th>
					                    <th class="text-center">Email Customer</th>
					                    <th class="text-center">No. Telp/Whatsapp</th>
					                    <th class="text-center">Level</th>
					                    <th class="text-center">Alamat</th>
					                    <th class="text-center">Opsi</th>
				                  	</tr>
		                  		</thead>
		                  		<tbody>
		                  			@foreach($customers as $cust)
				                  	<tr>
					                    <td>{{ $loop->iteration }}</td>
					                    <td>{{ $cust->name }}</td>
					                    <td>{{ $cust->email }}</td>
					                    <td>{{ $cust->phone }}</td>
					                    <td>{{ $cust->level == '0' ? "Customer" : "Reseller" }}</td>
					                    <td>{{ $cust->address }}</td>
					                    <td class="project-actions text-center">
					                    	<a href="/customer/restore/{{ $cust->id }}" class="btn btn-success btn-sm">Restore</a>
				                    		<a href="/customer/forceDelete/{{ $cust->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Data akan dihapus permanen. Lanjutkan?')">Hapus Permanen</a>
					                    </td>
				                  	</tr>
				                  	@endforeach
		                  		</tbody>
		                	</table>
		                </div>
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

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

<script>
  	$(function () {

	    $("#tbl-customers").DataTable({
	      	"responsive": false,
	      	"lengthChange": false,
	      	"autoWidth": false
	    });

  	});

</script>
@endsection