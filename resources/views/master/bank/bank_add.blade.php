<form id="form_add" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="bank_code" class="col-sm-4 col-form-label">Kode Bank<span style="color: red;">*</span></label>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="bank_code" id="bank_code" maxlength="3" onkeyup="num_only(this)" style="text-align: right;" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Nama Bank<span style="color: red;">*</span></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="account_number" class="col-sm-4 col-form-label">Nomor Rekening<span style="color: red;">*</span></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="account_number" id="account_number" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="account_owner" class="col-sm-4 col-form-label">Pemilik Rekening<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="account_owner" id="account_owner" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="branch" class="col-sm-4 col-form-label">Cabang<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="branch" id="branch" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
    </div>
</form>

<script>
    // STORE PROCESS
    function store() {
        let code = $("#bank_code").val();
        if(code == "") {
            alert('Kode bank harus diisi');
            $("#bank_code").focus();
            return false;
        }

        if(code.length < 3) {
            alert('Kode bank harus 3 karakter');
            $("#bank_code").focus();
            return false;
        }

        let name = $("#name").val();
        if(name == "") {
            alert('Nama bank harus diisi');
            $("#name").focus();
            return false;
        }

        let number = $("#account_number").val();
        if(number == "") {
            alert('No rekening harus diisi');
            $("#account_number").focus();
            return false;
        }

        let owner = $("#account_owner").val();
        if(owner == "") {
            alert('Pemilik rekening harus diisi');
            $("#account_owner").focus();
            return false;
        }

        let branch = $("#branch").val();
        if(branch == "") {
            alert('Cabang harus diisi');
            $("#branch").focus();
            return false;
        }

        $.post("{{ url('/bank/store') }}", $("#form_add").serialize(), function(data) {
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