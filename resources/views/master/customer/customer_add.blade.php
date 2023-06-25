<form id="form_add" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="customer_code" class="col-sm-4 col-form-label">Kode Customer<span style="color: red;">*</span></label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="customer_code" id="customer_code" maxlength="6" style="text-transform: uppercase;" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Nama Customer<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Email Customer<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="email" id="email" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-4 col-form-label">No.Telp/Whatsapp<span style="color: red;">*</span></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="phone" id="phone" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label">Level<span style="color: red;">*</span></label>
        <div class="col-sm-4">
            <select class="form-control" name="level" id="level">
                <option value="customer">Customer</option>
                <option value="reseller">Reseller</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="address" class="col-sm-4 col-form-label">Alamat Customer<span style="color: red;">*</span></label>
        <div class="col-sm-8">
            <textarea class="form-control" name="address" id="address" rows="2" style="resize: none;" required></textarea>
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
        let code = $("#customer_code").val();
        if(code == "") {
            alert('Kode customer harus diisi');
            $("#customer_code").focus();
            return false;
        } else {
            if(code.length < 6) {
                alert('Kode customer harus 6 karakter');
                $("#customer_code").focus();
                return false;
            }
        }
        
        let name = $("#name").val();
        if(name == "") {
            alert('Nama customer harus diisi');
            $("#name").focus();
            return false;
        } else {
            if(name.length < 3) {
                alert('Nama customer minimal 3 karakter');
                $("#name").focus();
                return false;
            }
        }

        let email = $("#email").val();
        if(email == "") {
            alert('Email customer harus diisi');
            $("#email").focus();
            return false;
        } else {
            if(email.length < 6) {
                alert('Email customer harus 6 karakter');
                $("#email").focus();
                return false;
            }
        }

        let number = $("#phone").val();
        if(number == "") {
            alert('No telp/whatsapp harus diisi');
            $("#phone").focus();
            return false;
        } else {
            if(number.length < 11) {
                alert('No telp/whatsapp minimal 11 nomor');
                $("#phone").focus();
                return false;
            }
        }

        let address = $("#address").val();
        if(address == "") {
            alert('Alamat customer harus diisi');
            $("#address").focus();
            return false;
        }

        $.post("{{ url('/customer/store') }}", $("#form_add").serialize(), function(data) {
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

        $('#form_add')[0].reset();
    }
</script>