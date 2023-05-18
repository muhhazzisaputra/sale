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
	                		<a href="/color/trash" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i> Trash</a>
                            <button class="btn btn-sm btn-primary" onclick="create()"><i class="fas fa-plus"></i> Tambah Data</button>
			            </div>
	              	</div>
	              	<div class="card-body" id="color-list">
	              		
	              	</div>
            	</div>
            </div>
        </div>
  	</div>
</section>

<div class="modal fade" id="colorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              	<h4 class="modal-title">Form Tambah Data</h4>
              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
              	</button>
            </div>
            <div class="modal-body colormod">

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
        $.get("{{ url('/color/read') }}", {}, function(data, status) {
            $("#color-list").html(data);
        });
    }

    // FORM CREATE
    function create() {
    	$.get("{{ url('/color/create') }}", {}, function(data, status) {
        	$(".modal-title").text('Form Tambah Data');
            $(".colormod").html(data);
            $("#colorModal").modal('show');
        });
    }

    // STORE PROCESS
    function store() {
        var name = $("#color_name").val();
        $.ajax({
            type: "get",
            url: "{{ url('/color/store') }}",
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
        $.get("{{ url('/color/show') }}/" + id, {}, function(data, status) {
        	$(".modal-title").text('Form Edit Data');
            $(".colormod").html(data);
            $("#colorModal").modal('show');
        });
    }

    // UPDATE PROCESS
    function update(id) {
        var name = $("#color_name").val();
        $.ajax({
            type: "get",
            url: "{{ url('/color/update') }}/" + id,
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
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/color/destroy') }}/" + id,
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