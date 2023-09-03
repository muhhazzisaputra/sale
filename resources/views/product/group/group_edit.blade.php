<div class="modal-header">
    <h4 class="modal-title">Edit Kelompok Produk</h4>
</div>
<div class="modal-body">
    <form id="form_edit" autocomplete="off">
        @csrf
        <input type="hidden" name="group_id" value="{{ $group->group_id }}">
        <div class="form-group row">
            <label for="group_code_edit" class="col-sm-4 col-form-label">Kode<span style="color: red;">*</span></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="code" id="group_code_edit" value="{{ $group->group_code }}" maxlength="2" style="text-transform: uppercase;" required readonly>
            </div>
        </div>
    	<div class="form-group row">
    	    <label for="name_edit" class="col-sm-4 col-form-label">Nama Kelompok<span style="color: red;">*</span></label>
    	    <div class="col-sm-5">
    	        <input type="text" class="form-control" name="name" id="name_edit" value="{{ $group->name }}" required>
    	    </div>
    	</div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="update()">Update</button>
            <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
        </div>
    </form>
</div>

<script>
    // UPDATE PROCESS
    function update() {
        let name = $("#name_edit").val();
        if(name == "") {
            alert('Nama kategori harus diisi');
            $("#name_edit").focus();
            return false;
        }

        $.post("{{ url('/category/update') }}", $("#form_edit").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil diupdate');
            }
            $('#modal-mid').modal('hide');
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal diupdate");
        });
    }
</script>