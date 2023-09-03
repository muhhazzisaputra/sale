<div class="modal-header">
    <h4 class="modal-title">Input Kelompok Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save" autocomplete="off"> 
        @csrf
        <div class="form-group row">
            <label for="group_code" class="col-sm-4 col-form-label">Kode<span style="color: red;">*</span></label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="group_code" id="group_code" maxlength="2" style="text-transform: uppercase;" required>
            </div>
        </div>
    	<div class="form-group row">
    	    <label for="name" class="col-sm-4 col-form-label">Nama Kelompok<span style="color: red;">*</span></label>
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
    function store() {
        let group_code = $("#group_code").val();
        if(group_code == "") {
            alert('Kode kelompok harus diisi');
            $("#group_code").focus();
            return false;
        } else {
           if(group_code.length < 2) {
                alert('Kode kelompok produk minimal 2 karakter');
                $("#group_code").focus();
                return false;
           }
        }

        let name = $("#name").val();
        if(name == "") {
            alert('Nama kelompok produk harus diisi');
            $("#name").focus();
            return false;
        } else {
           if(name.length < 3) {
                alert('Nama kelompok produk minimal 3 karakter');
                $("#name").focus();
                return false;
           }
        }

        $.post("{{ url('/product_group/store') }}", $("#form_save").serialize(), function(data) {
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

        // $('#form_save')[0].reset();
    }
</script>