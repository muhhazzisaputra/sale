<div class="modal-header">
    <h4 class="modal-title">Input Kategori Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save" autocomplete="off">
        @csrf
        <div class="form-group row">
            <label for="code" class="col-sm-4 col-form-label">Kode<span style="color: red;">*</span></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="code" id="code" maxlength="2" style="text-transform: uppercase;" required>
            </div>
        </div>
    	<div class="form-group row">
    	    <label for="name" class="col-sm-4 col-form-label">Nama Kategori<span style="color: red;">*</span></label>
    	    <div class="col-sm-5">
    	        <input type="text" class="form-control" name="name" id="name" required>
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
        let code = $("#code").val();
        if(code == "") {
            alert('Kode harus diisi');
            $("#code").focus();
            return false;
        }

        if(code.length < 2) {
            alert('Kode harus 2 karakter');
            $("#code").focus();
            return false;
        }

        let name = $("#name").val();
        if(name == "") {
            alert('Nama kategori harus diisi');
            $("#name").focus();
            return false;
        }

        $.post("{{ url('/category/store') }}", $("#form_save").serialize(), function(data) {
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