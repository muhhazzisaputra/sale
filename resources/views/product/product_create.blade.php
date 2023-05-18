@extends('layouts.main')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/product">Data Produk</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
            </div>
            <form action="/product" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Gambar Utama Produk</label>
                                <!-- <img class="img-preview img-fluid mb-3 col-sm-6"> -->
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="weight">Berat Produk(gram) <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" placeholder="Berat Produk" value="{{ old('weight') }}" required>
                                @error('weight')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="capital_price">Harga Modal <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('capital_price') is-invalid @enderror" name="capital_price" id="capital_price" placeholder="Harga Modal" value="{{ old('capital_price') }}" required>
                                @error('capital_price')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock">Stok Produk <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Stok Produk" value="{{ old('stock') }}" required>
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Produk" value="{{ old('name') }}" required autofocus>
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
                                    @if(old('category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="selling_price">Harga Jual <span style="color: red;">*</span></label>
                                <input type="number" class="form-control @error('selling_price') is-invalid @enderror" name="selling_price" id="selling_price" placeholder="Harga Jual" value="{{ old('selling_price') }}" required>
                                @error('selling_price')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Produk <span style="color: red;">*</span></label>
                                <textarea class="form-control" name="description" id="description" value="{{ old('description') }}" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>  

@endsection