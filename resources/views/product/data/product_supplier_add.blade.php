<div class="modal-header">
    <h4 class="modal-title">Tambah Pemasok Produk</h4>
</div>
<div class="modal-body">
    <form id="form_supplier_add" autocomplete="off">
        @csrf
        <input type="hidden" name="product_code" value="{{ $product_code }}">
        <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Supplier<span style="color: red;">*</span></label>
            <div class="col-sm-7">
                <select class="form-control" name="supplier_code" id="supplier_code">
                    <option value="">-Pilih-</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_code }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="save_supplier()">Simpan</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_mid_x()">Batal</button>
    </div>
</div>

<script>
    function close_modal_mid_x() {
        $('#modal-mid-x').modal('hide');
        get_supplier('{{ $product_code }}'); 
    }

    function save_supplier() {
        let supplier_code = $("#supplier_code").val();
        if(supplier_code == "") {
            alert('Supplier harus dipilih');
            $("#supplier_code").focus();
            return false;
        }

        $.post("{{ url('/product/save_supplier') }}", $("#form_supplier_add").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil disimpan');
                $('#modal-mid-x').modal('hide');
                get_supplier('{{ $product_code }}');
            } else {
                error_notif('Data gagal disimpan');
            }
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
        });

        $('#form_supplier_add')[0].reset();
    }
</script>