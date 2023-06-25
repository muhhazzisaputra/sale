@extends('layouts/main')

@section('content')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Sweet Alert -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert/sweetalert2.css') }}">

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
	                		<a href="/merk/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
	                		<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#merk-add"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body" id="merk-list">
	              		
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<div class="modal fade" id="merk-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Tambah Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body">
            	<div class="form-group row">
				    <label for="name" class="col-sm-4 col-form-label">Nama Merk<span style="color: red;">*</span></label>
				    <div class="col-sm-5">
				        <input type="text" class="form-control" name="name" id="name" required>
				    </div>
				    <div class="col-sm-2">
				        <button class="btn btn-primary" onclick="store()">Simpan</button>
				    </div>
				</div> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="merk-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Edit Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body">
            	<div class="form-group row">
            		<input type="hidden" id="id">
				    <label for="name" class="col-sm-4 col-form-label">Nama Merk<span style="color: red;">*</span></label>
				    <div class="col-sm-5">
				        <input type="text" class="form-control" name="name" id="name_edit" required>
				    </div>
				    <div class="col-sm-2">
				        <button class="btn btn-primary" onclick="update()">Update</button>
				    </div>
				</div> 
            </div>
        </div>
    </div>
</div>

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
<!-- Sweet Alert -->
<script src="{{ asset('adminlte/plugins/sweetalert/sweetalert2.js') }}"></script>

<script>
	$(function () {

	    read();

  	});

  	// LOAD DATA
    function read() {
        $.get("{{ url('/merk/read') }}", {}, function(data, status) {
            $("#merk-list").html(data);
        });
    }

    // STORE PROCESS
    function store() {
        var name = $("#name").val();
        $.ajax({
            type: "get",
            url: "{{ url('/merk/store') }}",
            data: "name=" + name,
            success: function(data) {
                $(".close").click();
                Swal.fire(
                  'Success!',
                  'Data berhasil disimpan.',
                  'success'
                );
                read();
            }
        });
    }

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/merk/show') }}/" + id, {}, function(data, status) {
        	$('#id').val(data.id);
        	$('#name_edit').val(data.name);
            $("#merk-edit").modal('show');
        }, 'json');
    }

    // UPDATE PROCESS
    function update() {
        var id   = $("#id").val();
        var name = $("#name_edit").val();
        $.ajax({
            type: "get",
            url: "{{ url('/merk/update') }}/" + id,
            data: "name=" + name,
            success: function(data) {
                $(".close").click();
                Swal.fire(
                  'Success!',
                  'Data berhasil diupdate.',
                  'success'
                );
                read();
            }
        });
    }

    function destroy(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/merk/destroy') }}/" + id,
                    data: "name=" + name,
                    success: function(data) {
                        $(".close").click();
                        Swal.fire(
                            'Success!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                        read();
                    }
                });
            }
        });
    }
</script>
@endsection