<form id="form_edit" autocomplete="off">
    @csrf
    <input type="hidden" name="color_id" value="{{ $color->color_id }}">
    <div class="form-group row">
        <label for="name_edit" class="col-sm-4 col-form-label">Nama Ukuran<span style="color: red;">*</span></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" id="name_edit" value="{{ $color->name }}" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update()">Update</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
    </div>
</form>

<script type="text/javascript">
    // UPDATE PROCESS
    function update() {
        let name = $("#name_edit").val();
        if(name == "") {
            alert('Nama warna harus diisi');
            $("#name_edit").focus();
            return false;
        } else {
            if(name.length < 3) {
                alert('Nama warna minimal 3 karakter');
                $("#name").focus();
                return false;
            }
        }

        $.post("{{ url('/color/update') }}", $("#form_edit").serialize(), function(data) {
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