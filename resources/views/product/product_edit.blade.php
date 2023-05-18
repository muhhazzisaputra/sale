@extends('layouts/main')

@section('content')

<section class="content-header">
    <div class="container-fluid"> 
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/product">Data Produk</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@php
    $productActive     = '';
    $productShowActive = '';
    if(!session()->has('image') && !session()->has('variant')) {
        $productActive     = ' active';
        $productShowActive = ' show active';
    }

    $imgActive     = '';
    $imgShowActive = '';
    if(session()->has('image')) {
        $imgActive     = ' active';
        $imgShowActive = ' show active';
    }

    $variantActive     = '';
    $variantShowActive = '';
    if(session()->has('variant')) {
        $variantActive     = ' active';
        $variantShowActive = ' show active';
    }
@endphp

<section class="content">
    <div class="container-fluid">
        @if(session()->has('image'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('image') }}
        </div>
        @endif
        @if(session()->has('variant'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> {{ session('variant') }}
        </div>
        @endif
        <div class="card card-default card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link{{ $productActive }}" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Detail Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $imgActive }}" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Galeri Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ $variantActive }}" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Varian Produk</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade{{ $productShowActive }}" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <form action="/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Gambar Utama Produk</label>
                                    <input type="hidden" name="old_image" value="{{ $product->image }}">
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    @error('image')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="weight">Berat Produk(gram) <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" placeholder="Berat Produk" value="{{ old('weight', $product->weight) }}" required>
                                    @error('weight')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="capital_price">Harga Modal <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control @error('capital_price') is-invalid @enderror" name="capital_price" id="capital_price" placeholder="Harga Beli" value="{{ old('capital_price', $product->capital_price) }}" required>
                                    @error('capital_price')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stok Produk <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Stok Produk" value="{{ old('stock', $product->stock) }}" required>
                                    @error('stock')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Produk <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Produk" value="{{ old('name', $product->name) }}" required autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori <span style="color: red;">*</span></label>
                                    <select class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        @if(old('category_id', $product->category_id) == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="selling_price">Harga Jual <span style="color: red;">*</span></label>
                                    <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" id="selling_price" placeholder="Harga Jual" value="{{ old('selling_price', $product->selling_price) }}" required>
                                    @error('selling_price')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Produk <span style="color: red;">*</span></label>
                                    <textarea class="form-control" name="description" id="description" required>{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                    </div>
                    <div class="tab-pane fade{{ $imgShowActive }}" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <form action="/product/upload" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Gambar Produk <span style="color: red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="file" class="form-control" name="image" id="image" required>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>                    
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($images as $img)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($img->image_gallery) 
                                            <img src="{{ asset('storage/'.$img->image_gallery) }}" width="90px">
                                            @else
                                            <img src="{{ asset('storage/no-image.png') }}" width="90px">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/product/deleteImage/{{$img->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade{{ $variantShowActive }}" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                        <div class="row">
                            <div class="col-md-5">
                                <form action="/product/storeVariant" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group row">
                                    <label for="size_id" class="col-sm-3 col-form-label">Ukuran <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="size_id" id="size_id" required>
                                        @foreach($sizes as $size)
                                            @if(old('size_id') == $size->id)
                                                <option value="{{ $size->id }}" selected>{{ $size->name }}</option>
                                            @else
                                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stock_variant" class="col-sm-3 col-form-label">Stok Varian <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock_variant" id="stock_variant" placeholder="Stok Varian" value="{{ old('stock') }}" required>
                                        @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="purchase_price_varian" class="col-sm-3 col-form-label">Harga Modal <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('capital_price') is-invalid @enderror" name="capital_price_variant" id="capital_price_varian" placeholder="Harga Modal" value="{{ old('capital_price') }}" required>
                                        @error('capital_price')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="selling_price_varian" class="col-sm-3 col-form-label">Harga Jual <span style="color: red;">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price_variant" id="selling_price_varian" placeholder="Harga Jual" value="{{ old('selling_price') }}" required>
                                        @error('selling_price')
                                        <div class="invalid-feedback">
                                          {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">Simpan Data Varian</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col-md-7">  
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Ukuran</th>
                                                <th>Stok Varian</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th class="text-center">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($variants as $variant)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $variant->size->name }}</td>
                                                <td>{{ $variant->stock }}</td>
                                                <td>Rp. @currency($variant->capital_price)</td>
                                                <td>Rp. @currency($variant->selling_price)</td>
                                                <td class="project-actions text-center">
                                                    <button class="btn btn-info btn-xs varedit" value="{{$variant->id}}" data-toggle="modal" data-target="#variant-edit"><i class="fas fa-pencil-alt"></i> Edit</button>
                                                    <a href="/product/deleteVariant/{{$variant->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i> Hapus</a>
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
        </div>
    </div>
</section>

<div class="modal fade" id="variant-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Varian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/product/updateVariant" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="id" id="variant_id">
                    <div class="form-group row">
                        <label for="size_id" class="col-sm-3 col-form-label">Ukuran <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="size_id" id="size_id_edit" required disabled>
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock_variant_edit" class="col-sm-3 col-form-label">Stok Varian <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="stock_variant" id="stock_variant_edit" placeholder="Stok Varian" min="0" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purchase_price_variant_edit" class="col-sm-3 col-form-label">Harga Beli <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="purchase_price_variant" id="purchase_price_variant_edit" placeholder="Harga Beli" min="1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selling_price_variant_edit" class="col-sm-3 col-form-label">Harga Jual <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="selling_price_variant" id="selling_price_variant_edit" placeholder="Harga Jual" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Data Varian</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(document).on('click', '.varedit', function() {
            var id = $(this).val();
            $.get("{{ url('/product/showVariant') }}/" + id, {}, function(result) {
                var data = JSON.parse(result);
                $('#variant_id').val(data.id);
                // $('#size_id_edit').val(data.size_id);
                $('#stock_variant_edit').val(data.stock);
                $('#purchase_price_variant_edit').val(data.capital_price);
                $('#selling_price_variant_edit').val(data.selling_price);
            });
        });

    });
</script>

@endsection