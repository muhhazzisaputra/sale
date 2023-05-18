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
            	<h1 class="m-0">Data Produk</h1>
          	</div>
          	<div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              	<li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
	              	<li class="breadcrumb-item active">Data Produk</li>
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
        		@if(Session::has('message'))
		            <p>oke siap!</p>
		        @endif
        		@if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('success') }}
                </div>
                @endif
	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Data Produk</h3>
	                	<div class="card-tools"> 
			              	<a href="/product/create" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
			            </div>
	              	</div>
	              	<div class="card-body">
	                	<table id="tbl-product" class="table table-bordered table-striped">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th class="text-center">Gambar Produk</th>
				                    <th class="text-center">Nama Produk</th>
				                    <th class="text-center">Kategori</th>
				                    <th class="text-center">Stok</th>
				                    <th class="text-center">Harga Modal</th>
				                    <th class="text-center">Harga Jual</th>
				                    <th class="text-center">Option</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('storage/'.$product->image) }}" width="90px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>Rp. @currency($product->capital_price)</td>
                                    <td>Rp. @currency($product->selling_price)</td>
                                    <td class="project-actions text-center">
				                    	<a href="/product/{{ $product->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
				                    	<form action="/product/{{ $product->id }}" method="post" class="d-inline">
				                        @method('delete')
				                        @csrf
				                          	<button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')">
				                              <i class="fas fa-trash"></i> Hapus
				                          	</button>
				                        </form>
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

	    $("#tbl-product").DataTable({
	      	"responsive": true,
	      	"lengthChange": false,
	      	"autoWidth": false
	    });

  	});

</script>

@endsection