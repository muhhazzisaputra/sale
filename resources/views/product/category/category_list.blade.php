@extends('layouts/main')

@section('content')

<section class="content-header">
  	<div class="container-fluid">
        <div class="row mb-2">
          	<div class="col-sm-6">
            	<h1 class="m-0">{{ $title }}</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
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
	                		<a href="/category/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
			              	<button class="btn btn-sm btn-success" onclick="add()"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body" id="category-list">
	              		
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
        $.get("{{ url('/category/read') }}", {}, function(data, status) {
            $("#category-list").html(data);
        });
    }

    function add() {
        $.get("{{ url('/category/add') }}", {}, function(data) {
            $('#modal-mid').modal('show');
            $('#modal_body_mid').html(data);
        });
    }
</script>
@endsection