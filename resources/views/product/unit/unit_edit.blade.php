<div class="modal-header">
    <h4 class="modal-title">Edit Satuan Produk</h4>
</div>
<div class="modal-body">
    <form id="form_edit" autocomplete="off">
        @csrf
        <input type="hidden" name="unit_id" value="{{ $unit->unit_id }}">
        <div class="form-group row">
            <label for="name_edit" class="col-sm-4 col-form-label">Nama Satuan<span style="color: red;">*</span></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name" id="name_edit" value="{{ $unit->name }}" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="update()">Update</button>
            <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    // UPDATE PROCESS
    function update() {
        let name = $("#name_edit").val();
        if(name == "") {
            alert('Nama satuan harus diisi');
            $("#name_edit").focus();
            return false;
        } else {
            if(name.length < 2) {
                alert('Nama satuan minimal 3 karakter');
                $("#name").focus();
                return false;
            }
        }

        $.post("{{ url('/unit/update') }}", $("#form_edit").serialize(), function(data) {
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