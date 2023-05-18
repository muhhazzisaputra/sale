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
	                		<a href="/group/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
	                		<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#group-add"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body" id="group-list">
	              		
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<div class="modal fade" id="group-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Tambah Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body">
                <form id="form_save" autocomplete="off">
                    @csrf
                	<div class="form-group row">
                        <label for="code" class="col-sm-4 col-form-label">Kode<span style="color: red;">*</span></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="code" id="code" maxlength="2" style="text-transform: uppercase;" required>
                        </div>
                    </div>
                    <div class="form-group row">
    				    <label for="name" class="col-sm-4 col-form-label">Nama Kelompok<span style="color: red;">*</span></label>
    				    <div class="col-sm-5">
    				        <input type="text" class="form-control" name="name" id="name" required>
    				    </div>
    				    <div class="col-sm-2">
    				        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
    				    </div>
    				</div> 
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="group-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Edit Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body">
                <form id="form_edit" autocomplete="off">
                    @csrf
                	<div class="form-group row">
                		<input type="hidden" name="id" id="id">
                        <label for="code" class="col-sm-4 col-form-label">Kode<span style="color: red;">*</span></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="code" id="code_edit" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
    				    <label for="name" class="col-sm-4 col-form-label">Nama Kelompok<span style="color: red;">*</span></label>
    				    <div class="col-sm-5">
    				        <input type="text" class="form-control" name="name" id="name_edit" required>
    				    </div>
    				    <div class="col-sm-2">
    				        <button type="button" class="btn btn-primary" onclick="update()">Update</button>
    				    </div>
    				</div>
                </form> 
            </div>
        </div>
    </div>
</div>

<script>
	$(function () {

	    read();

  	});

  	// LOAD DATA
    function read() {
        $.get("{{ url('/group/read') }}", {}, function(data, status) {
            $("#group-list").html(data);
        });
    }

    // STORE PROCESS
    function store() {
        let code = $("#code").val();
        if(code == "") {
            alert('Kode harus diisi');
            $("#code").focus();
            return false;
        }

        if(code.length < 2) {
            alert('Kode harus 2 karakter');
            $("#code").focus();
            return false;
        }

        let name = $("#name").val();
        if(name == "") {
            alert('Nama kelompok harus diisi');
            $("#name").focus();
            return false;
        }

        $.post("{{ url('/group/store') }}", $("#form_save").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil disimpan');
            } else {
                error_notif('Data gagal disimpan');
            }

            $('#group-add').modal('hide');
            $('#form_save')[0].reset();
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
            $('#group-add').modal('hide');
            $('#form_save')[0].reset();
        });
    }

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/group/show') }}/" + id, {}, function(data, status) {
        	$('#id').val(data.id);
            $('#code_edit').val(data.code);
        	$('#name_edit').val(data.name);
            $("#group-edit").modal('show');
        }, 'json');
    }

    // UPDATE PROCESS
    function update() {
        let name = $("#name_edit").val();
        if(name == "") {
            alert('Nama kelompok harus diisi');
            $("#name_edit").focus();
            return false;
        }

        $.post("{{ url('/group/update') }}", $("#form_edit").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil diupdate');
            }
            $('#group-edit').modal('hide');
            $('#form_edit')[0].reset();
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal diupdate");
            $('#group-edit').modal('hide');
            $('#form_edit')[0].reset();
        });
    }

    function destroy(id) {
        let _token = $('input[name="_token"]').val();

        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{ url('/group/destroy') }}", {id, _token}, function(data) {
                    if(data.status == 'success') {
                        success_notif('Data berhasil dihapus');
                    }
                    read();
                }, 'json').fail(function(data){
                    error_notif("Data gagal dihapus");
                });
            }
        });
    }
</script>
@endsection