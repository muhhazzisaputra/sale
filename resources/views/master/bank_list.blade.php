@extends('layouts/main')

@section('content')
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
	                		<a href="/bank/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
			              	<a href="/bank/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	              		<div class="table-responsive">
		                	<table id="tbl-bank" class="table table-bordered table-striped">
		                  		<thead>
				                  	<tr>
					                    <th class="text-center">#</th>
					                    <th class="text-center">Opsi</th>
					                    <th class="text-center">Akun Bank</th>
					                    <th class="text-center">Nomor Rekening</th>
					                    <th class="text-center">Atas Nama</th>
					                    <th class="text-center">Cabang</th>
				                  	</tr>
		                  		</thead>
		                  		<tbody>
		                  			@foreach($banks as $bank)
				                  	<tr>
					                    <td>{{ $loop->iteration }}</td>
					                    <td class="project-actions text-center">
					                    	<a href="/bank/{{ $bank->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
					                    	<a href="/bank/delete/{{ $bank->id }}" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i> Hapus</a>
					                    </td>
					                    <td>{{ $bank->name }}</td>
					                    <td>{{ $bank->account_number }}</td>
					                    <td>{{ $bank->account_owner }}</td>
					                    <td>{{ $bank->branch }}</td>
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

<!-- Sweet Alert -->
<script src="{{ asset('adminlte/plugins/sweetalert/sweetalert2.js') }}"></script>

<script>
  	$(function () {

	    $("#tbl-bank").DataTable({
	      	"responsive": false,
	      	"lengthChange": false,
	      	"autoWidth": false
	    });

	    $(document).on('click','.delete',function(e){
			e.preventDefault();
			const href = $(this).attr('href');
			Swal.fire({
	            title: 'Yakin ingin menghapus data?',
	            icon: 'warning',
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Ya, hapus!'
	        }).then((result) => {
	            if (result.isConfirmed) {
	                document.location.href = href;
	            }
	        });
		});

  	});

</script>
@endsection