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
	              	<li class="breadcrumb-item"><a href="/merk">Merk Produk</a></li>
	              	<li class="breadcrumb-item active">{{ $title }}</li>
	            </ol>
          	</div>
        </div>
  	</div>
</section><!-- Main content -->
<section class="content">
  	<div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data {{ $title }}</h3>
	                	<div class="card-tools">
	                		<a href="/merk/restore" class="btn btn-sm btn-success"><i class="fa fa-trash-restore"></i> Restore Semua Data</a>
			              	<a href="/merk/forceDelete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus Permanen Semua Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	                	<table id="tbl-merk" class="table table-bordered table-striped">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th class="text-center">Nama Merk</th>
				                    <th class="text-center">Opsi</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($merks as $merk)
			                  	<tr>
				                    <td>{{ $loop->iteration }}</td>
				                    <td>{{ $merk->name }}</td>
				                    <td class="project-actions text-center">
				                    	<a href="/merk/restore/{{ $merk->id }}" class="btn btn-success btn-sm">Restore</a>
				                    	<a href="/merk/forceDelete/{{ $merk->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Data akan dihapus permanen. Lanjutkan?')">Hapus Permanen</a>
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
</section>

@endsection