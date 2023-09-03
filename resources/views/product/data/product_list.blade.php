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
			              	<a href="/product/create" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Tambah Data</a>
			            </div>
	              	</div>
	              	<div class="card-body table-responsive p-0">
	                	<table id="tbl-product" class="table table-bordered table-hover text-nowrap">
	                  		<thead>
			                  	<tr>
				                    <th class="text-center">#</th>
				                    <th>Opsi</th>
				                    <th class="text-center">Gambar Produk</th>
				                    <th>Nama Produk</th>
				                    <th>Kategori</th>
				                    <th>Kelompok</th>
				                    <th class="text-right">Berat(gram)</th>
				                    <th class="text-right">Stok</th>
				                    <th class="text-right">Harga Modal</th>
				                    <th class="text-right">Harga Jual</th>
				                    <th>SKU Produk</th>
				                    <th>Satuan</th>
				                    <th class="text-right">Minimal Stok</th>
				                    <th>Status Varian</th>
			                  	</tr>
	                  		</thead>
	                  		<tbody>
	                  			@foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                    	<div class="btn-group show">
						                    <button type="button" class="btn btn-default">Opsi</button>
						                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
						                      <span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu" x-placement="top-start" style="position: absolute; transform: translate3d(70px, -164px, 0px); top: 0px; left: 0px; will-change: transform;">
						                      <a class="dropdown-item" href="/product/edit/{{ $product->product_code }}">Edit Produk</a>
						                      <a class="dropdown-item" onclick="get_gallery('{{ $product->product_code }}')" style="cursor: pointer;">Galeri</a>
						                      <a class="dropdown-item" onclick="get_variant('{{ $product->product_code }}')" style="cursor: pointer;">Varian</a>
						                      <a class="dropdown-item" onclick="get_supplier('{{ $product->product_code }}')" style="cursor: pointer;">Pemasok</a>
						                      <a class="dropdown-item" onclick="get_discount('{{ $product->product_code }}')" style="cursor: pointer;">Setting Diskon</a>
						                      <div class="dropdown-divider"></div>
						                      <a class="dropdown-item text-danger" href="#">Hapus Produk</a>
						                    </div>
						                </div>
				                    </td>
                                    <td><img src="{{ asset('storage/product-images/'.$product->image) }}" width="90px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td>{{ $product->group_name }}</td>
                                    <td class="text-right">@currency($product->weight)</td>
                                    <td class="text-right">{{ $product->stock }}</td>
                                    <td class="text-right">Rp. @currency($product->capital_price)</td>
                                    <td class="text-right">Rp. @currency($product->selling_price)</td>
                                    <td>{{ $product->product_sku }}</td>
                                    <td>{{ $product->unit_name }}</td>
                                    <td class="text-right">{{ $product->min_stock }}</td>
                                    <td>{{ ($product->status_variant == 0) ? 'Tidak' : 'Ya'}}</td>
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

<script>
  	function get_gallery(product_code) {
  		$.post("{{ url('/product/get_gallery') }}", {_token, product_code}, function(data) {
            $('#modal-mid').modal('show');
            $('#modal_body_mid').html(data);
        });
  	}

  	function get_variant(product_code) {
  		$.post("{{ url('/product/get_variant') }}", {_token, product_code}, function(data) {
            $('#modal-lg').modal('show');
            $('#modal_body_lg').html(data);
        });
  	}

  	function get_supplier(product_code) {
  		$.post("{{ url('/product/get_supplier') }}", {_token, product_code}, function(data) {
            $('#modal-lg').modal('show');
            $('.modal-title').text('Pemasok Produk');
            $('#modal_body_lg').html(data);
        });
  	}

  	function get_discount(product_code) {
  		$.post("{{ url('/product/get_discount') }}", {_token, product_code}, function(data) {
            $('#modal-lg').modal('show');
            $('#modal_body_lg').html(data);
        });
  	}
</script>

@endsection