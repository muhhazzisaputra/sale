@extends('layouts/main')

@section('content')
<!-- Sweet Alert -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert/sweetalert2.css') }}">

<section class="content-header">
  	<div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0">{{ $title }}</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
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
	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data {{ $title }}</h3>
	                	<div class="card-tools">
	                		<a href="/customer/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
			              	<button class="btn btn-sm btn-primary" onclick="add()"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body" id="customer-list">
	              		
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<script>
  	$(function () {

	    read();

  	});

  	// LOAD DATA
    function read() {
        $.get("{{ url('/customer/read') }}", {}, function(data, status) {
            $("#customer-list").html(data);
        });
    }

    function add() {
        $.get("{{ url('/customer/add') }}", {}, function(data) {
            $('#modal-mid').modal('show');
            $('.modal-title').text('Input Data Customer');
            $('#modal_body_mid').html(data);
        });
    }
</script>
@endsection