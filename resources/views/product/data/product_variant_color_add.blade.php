<div class="modal-header">
    <h4 class="modal-title">Tambah Varian{{$text_variant}}Produk</h4>
</div>
<div class="modal-body">
    <form id="form_variant_color_add" autocomplete="off">
        @csrf
        <input type="hidden" name="type" value="color">
        <div class="form-group row">
            <label for="" class="col-sm-4 col-form-label">Warna Produk<span style="color: red;">*</span></label>
            <div class="col-sm-4">
                <select class="form-control" name="color_code" id="color_code">
                    <option value="">-Pilih-</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->color_code }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <input type="hidden" name="product_code" value="{{ $product_code }}">
            <label for="capital_price" class="col-sm-4 col-form-label">Harga Modal<span style="color: red;">*</span></label>
            <div class="col-sm-3">
                <input type="text" name="capital_price" class="form-control" id="capital_price" style="text-align: right;" onkeyup="num_only(this)">
            </div>
        </div>
        <div class="form-group row">
            <label for="selling_price" class="col-sm-4 col-form-label">Harga Jual<span style="color: red;">*</span></label>
            <div class="col-sm-3">
                <input type="text" name="selling_price" class="form-control" id="selling_price" style="text-align: right;" onkeyup="num_only(this)">
            </div>
        </div>
        <div class="form-group row">
            <label for="stock" class="col-sm-4 col-form-label">Stok<span style="color: red;">*</span></label>
            <div class="col-sm-2">
                <input type="text" name="stock" class="form-control" id="stock" style="text-align: right;" onkeyup="num_only(this)">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="save_variant_color()">Simpan</button>
            <button type="button" class="btn btn-danger" onclick="close_modal_mid_x()">Batal</button>
        </div>
    </form>
</div>

<script>
    function close_modal_mid_x() {
        $('#modal-mid-x').modal('hide');
        get_variant('{{ $product_code }}'); 
    }

    // STORE PROCESS
    function save_variant_color() {
        let color_code = $("#color_code").val();
        if(color_code == "") {
            alert('Warna harus diisi');
            $("#color_code").focus();
            return false;
        }

        let capital_price = $("#capital_price").val();
        if(capital_price == "") {
            alert('Harga modal harus diisi');
            $("#capital_price").focus();
            return false;
        }

        let selling_price = $("#selling_price").val();
        if(selling_price == "") {
            alert('Harga jual harus diisi');
            $("#selling_price").focus();
            return false;
        }

        let stock = $("#stock").val();
        if(stock == "") {
            alert('Stok harus diisi');
            $("#stock").focus();
            return false;
        }

        $.post("{{ url('/product/save_variants') }}", $("#form_variant_color_add").serialize(), function(data) {
            if(data.status == 'success') {
                success_notif('Data berhasil disimpan');
                $('#modal-mid-x').modal('hide');
                get_variant('{{ $product_code }}');
            } else {
                error_notif('Data gagal disimpan');
            }
        }, 'json').fail(function(data){
            error_notif("Data gagal disimpan");
        });

        $('#form_variant_color_add')[0].reset();
    }
</script>