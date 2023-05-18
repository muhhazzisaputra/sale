@extends('layouts.main')

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
                    <li class="breadcrumb-item"><a href="/customer">Customer</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Edit Data</h3>
            </div>
            <form action="/customer/{{ $customer->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Customer<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama Customer" value="{{ $customer->name }}" required autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Customer<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Nama Customer" value="{{ $customer->email }}" required autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">No.Telp/Whatsapp<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="No.Telp/Whatsapp" value="{{ $customer->phone }}" required>
                                @error('phone')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="level">Level<span style="color: red;">*</span></label>
                                <select class="form-control" name="level">
                                    <option value="0"{{ $customer->level == '0' ? " selected" : "" }}>Customer</option>
                                    <option value="1"{{ $customer->level == '1' ? " selected" : "" }}>Reseller</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Alamat Customer<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Alamat Supplier" value="{{ $customer->address }}" required>
                                @error('address')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
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