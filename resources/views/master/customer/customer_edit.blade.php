<div class="modal-header">
    <h4 class="modal-title">Edit Data Customer</h4>
</div>
<div class="modal-body">
    <form id="form_edit" autocomplete="off">
        @csrf
        <div class="form-group row">
            <label for="customer_code" class="col-sm-4 col-form-label">Kode Customer<span style="color: red;">*</span></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="customer_code" id="customer_code" value="{{ $customer->customer_code }}" maxlength="6" style="text-transform: uppercase;" required readonly>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Customer<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" id="name_edit" value="{{ $customer->name }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email Customer<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email" id="email_edit" value="{{ $customer->email }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-4 col-form-label">No.Telp/Whatsapp<span style="color: red;">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="phone" id="phone_edit" value="{{ $customer->phone }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Level<span style="color: red;">*</span></label>
            <div class="col-sm-4">
                <select class="form-control" name="level" id="level_edit">
                    <option value="customer"{{ ($customer->level == 'customer') ? ' selected' : '' }}>Customer</option>
                    <option value="reseller"{{ ($customer->level == 'reseller') ? ' selected' : '' }}>Reseller</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Alamat Customer<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="address" id="address_edit" rows="2" style="resize: none;" required>{{ $customer->address }}</textarea>
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
            alert('Nama customer harus diisi');
            $("#name_edit").focus();
            return false;
        } else {
            if(name.length < 3) {
                alert('Nama customer minimal 3 karakter');
                $("#name_edit").focus();
                return false;
            }
        }

        let email = $("#email_edit").val();
        if(email == "") {
            alert('Email customer harus diisi');
            $("#email_edit").focus();
            return false;
        } else {
            if(email.length < 6) {
                alert('Email customer harus 6 karakter');
                $("#email_edit").focus();
                return false;
            }
        }

        let number = $("#phone_edit").val();
        if(number == "") {
            alert('No telp/whatsapp harus diisi');
            $("#phone_edit").focus();
            return false;
        } else {
            if(number.length < 11) {
                alert('No telp/whatsapp minimal 11 nomor');
                $("#phone_edit").focus();
                return false;
            }
        }

        let address = $("#address_edit").val();
        if(address == "") {
            alert('Alamat customer harus diisi');
            $("#address_edit").focus();
            return false;
        }

        $.post("{{ url('/customer/update') }}", $("#form_edit").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil diupdate');
            } else {
                error_notif('Data gagal diupdate');
            }
            $('#modal-mid').modal('hide');
            $('#form_edit')[0].reset();
            read();
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
        });        
    }
</script>