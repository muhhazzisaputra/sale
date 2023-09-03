<div class="modal-header">
    <h4 class="modal-title">Edit Data Bank</h4>
</div>
<div class="modal-body">
    <form id="form_edit" autocomplete="off">
        @csrf
        <input type="hidden" name="id" value="{{ $bank->bank_id }}">
        <div class="form-group row">
            <label for="bank_code" class="col-sm-4 col-form-label">Kode Bank<span style="color: red;">*</span></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="bank_code" id="bank_code_edit" value="{{ $bank->bank_code}}" style="text-align: right;" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Bank<span style="color: red;">*</span></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="name" id="name_edit" value="{{ $bank->name}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="account_number" class="col-sm-4 col-form-label">Nomor Rekening<span style="color: red;">*</span></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="account_number" id="account_number_edit" value="{{ $bank->account_number}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="account_owner" class="col-sm-4 col-form-label">Pemilik Rekening<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="account_owner" id="account_owner_edit" value="{{ $bank->account_owner}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="branch" class="col-sm-4 col-form-label">Cabang<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="branch" id="branch_edit" value="{{ $bank->branch}}" required>
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
            alert('Nama bank harus diisi');
            $("#name_edit").focus();
            return false;
        }

        let number = $("#account_number_edit").val();
        if(number == "") {
            alert('No rekening harus diisi');
            $("#account_number_edit").focus();
            return false;
        }

        let owner = $("#account_owner_edit").val();
        if(owner == "") {
            alert('Pemilik rekening harus diisi');
            $("#account_owner_edit").focus();
            return false;
        }

        let branch = $("#branch_edit").val();
        if(branch == "") {
            alert('Cabang harus diisi');
            $("#branch_edit").focus();
            return false;
        }

        $.post("{{ url('/bank/update') }}", $("#form_edit").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil diupdate');
            }
            $('#modal-mid').modal('hide');
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal diupdate");
        });

        $('#form_edit')[0].reset();
    }
</script>