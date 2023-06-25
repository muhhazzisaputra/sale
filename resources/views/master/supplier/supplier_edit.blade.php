<form id="form_edit" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="supplier_code" class="col-sm-4 col-form-label">Kode Supplier<span style="color: red;">*</span></label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="supplier_code" id="supplier_code_edit" value="{{ $supplier->supplier_code }}" maxlength="6" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Nama Supplier<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name_edit" value="{{ $supplier->name }}" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-4 col-form-label">No.Telp/Whatsapp<span style="color: red;">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="phone" id="phone_edit" value="{{ $supplier->phone }}" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-4 col-form-label">Alamat Supplier<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <textarea class="form-control" name="address" id="address_edit" rows="2" style="resize: none;" required>{{ $supplier->address }}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="update()">Update</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
    </div>
</form>

<script>
    // UPDATE PROCESS
    function update() {
        let name = $("#name_edit").val();
        if(name == "") {
            alert('Nama supplier harus diisi');
            $("#name_edit").focus();
            return false;
        }

        let phone = $("#phone_edit").val();
        if(phone == "") {
            alert('No telp/whatsapp harus diisi');
            $("#phone_edit").focus();
            return false;
        }

        let address = $("#address_edit").val();
        if(address == "") {
            alert('Alamat supplier harus diisi');
            $("#address_edit").focus();
            return false;
        }

        $.post("{{ url('/supplier/update') }}", $("#form_edit").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil diupdate');
            } else {
                error_notif('Data gagal diupdate');
            }
            $('#modal-mid').modal('hide');
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
        });

        $('#form_edit')[0].reset();
    }
</script>