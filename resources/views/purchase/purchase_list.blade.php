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
            	<h1 class="m-0">Data Pembelian</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
	              	<li class="breadcrumb-item active">Data Pembelian</li>
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
        		<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data Pembelian</h3>
	                	<div class="card-tools"> 
			              	<!-- <a href="/purchase/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a> -->
			              	<button class="btn btn-sm btn-primary" onclick="purchase_create(this)"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body">
	                	<table id="tbl-purchase" class="table table-bordered table-striped">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th class="text-center">Opsi</th>
				                    <th class="text-center">No PO</th>
				                    <th class="text-center">Tanggal Transaksi</th>
				                    <th class="text-center">Supplier</th>
				                    <th class="text-center">Catatan</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                	<td class="project-actions text-center">
                                		<button class="btn btn-sm btn-primary" onclick="purchase_edit('{{ $purchase->purchase_id }}')"><i class="fas fa-pencil-alt"></i> Edit</button>
                                		<button class="btn btn-sm btn-primary" onclick="purchase_print('{{ $purchase->purchase_id }}')"><i class="fas fa-print"></i> Print</button>
						            </td>
                                    <td>{{ $purchase->purchase_id }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>{{ $purchase->supplier_code }}</td>
                                    <td>{{ $purchase->note }}</td>
                                </tr>
                                @endforeach
	                  		</tbody>
	                	</table>
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

<script>
  	$(function () {

	    $("#tbl-purchase").DataTable({
	      	"responsive": true,
	      	"lengthChange": false,
	      	"autoWidth": false
	    });

  	});

  	function purchase_create() {
  		$.post("{{ url('/purchase/purchase_create') }}", {_token}, function(data) {
  			$('#modal-xl-load').modal('show');
            $('#modal_body_xl_load').html(data);
  		});
  	}

  	function purchase_edit(purchase_id) {
  		$.post("{{ url('/purchase/purchase_edit') }}", {_token, purchase_id}, function(data) {
  			$('#modal-xl-load').modal('show');
            $('#modal_body_xl_load').html(data);
  		});
  	}
</script>

@endsection