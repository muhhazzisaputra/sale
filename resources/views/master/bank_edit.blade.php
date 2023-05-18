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
                    <li class="breadcrumb-item"><a href="/bank">Akun Bank</a></li>
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
            <form action="/bank/{{ $bank->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Akun Bank<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Akun Bank" value="{{ $bank->name }}" required autofocus>
                                @error('name')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_number">Nomor Rekening<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" id="account_number" placeholder="Nomor Rekening" value="{{ $bank->account_number }}" required>
                                @error('account_number')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account_owner">Pemilik Rekening<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('account_owner') is-invalid @enderror" name="account_owner" id="account_owner" placeholder="Pemilik Rekening" value="{{ $bank->account_owner }}" required>
                                @error('account_owner')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch">Cabang<span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('branch') is-invalid @enderror" name="branch" id="branch" placeholder="Cabang" value="{{ $bank->branch }}" required>
                                @error('branch')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection