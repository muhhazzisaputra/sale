<div class="modal-header">
    <h4 class="modal-title">Input Data Supplier</h4>
</div>
<div class="modal-body">
    <form id="form_add" autocomplete="off">
        @csrf
        <div class="form-group row">
            <label for="supplier_code" class="col-sm-4 col-form-label">Kode Supplier<span style="color: red;">*</span></label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="supplier_code" id="supplier_code" maxlength="6" style="text-transform: uppercase;" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-4 col-form-label">Nama Supplier<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-sm-4 col-form-label">No.Telp/Whatsapp<span style="color: red;">*</span></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-sm-4 col-form-label">Alamat Supplier<span style="color: red;">*</span></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="address" id="address" rows="2" style="resize: none;" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="store()">Simpan</button>
            <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Batal</button>
        </div>
    </form>
</div>

<script>
    // STORE PROCESS
    function store() {
        let code = $("#supplier_code").val();
        if(code == "") {
            alert('Kode supplier harus diisi');
            $("#supplier_code").focus();
            return false;
        }

        if(code.length < 6) {
            alert('Kode supplier harus 6 karakter');
            $("#supplier_code").focus();
            return false;
        }

        let name = $("#name").val();
        if(name == "") {
            alert('Nama bank harus diisi');
            $("#name").focus();
            return false;
        }

        let number = $("#phone").val();
        if(number == "") {
            alert('No telp/whatsapp harus diisi');
            $("#phone").focus();
            return false;
        }

        let address = $("#address").val();
        if(address == "") {
            alert('Alamat supplier harus diisi');
            $("#address").focus();
            return false;
        }

        $.post("{{ url('/supplier/store') }}", $("#form_add").serialize(), function(data) {
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