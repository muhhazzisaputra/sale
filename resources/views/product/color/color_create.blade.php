<form id="form_save" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Nama Warna<span style="color: red;">*</span></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
    </div>
</form>

<script type="text/javascript">
    // STORE PROCESS
    function store() {
        let name = $("#name").val();
        if(name == "") {
            alert('Nama warna harus diisi');
            $("#name").focus();
            return false;
        } else {
            if(name.length < 3) {
                alert('Nama warna minimal 3 karakter');
                $("#name").focus();
                return false;
            }
        }

        $.post("{{ url('/color/store') }}", $("#form_save").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil disimpan');
            } else {
                error_notif('Data gagal disimpan');
            }
            $('#modal-mid').modal('hide');
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
        });

        $('#form_save')[0].reset();
    }
</script>