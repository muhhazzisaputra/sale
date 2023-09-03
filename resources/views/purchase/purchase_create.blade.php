<link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}" />

<div class="modal-header">
    <h4 class="modal-title">Input Data Pembelian</h4>
</div>
<div class="modal-body">
    <form id="form_input" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="purchase_date" class="col-sm-7 col-form-label">Tanggal Pembelian<span style="color: red;">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="purchase_date" class="form-control today" id="purchase_date" value="{{ date('Y-m-d') }}" style="width: 108px;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="purchase_date" class="col-sm-7 col-form-label">Tanggal Jatuh Tempo<span style="color: red;">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="purchase_duedate" class="form-control today" id="purchase_duedate" value="{{ date('Y-m-d') }}" style="width: 108px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Supplier<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="supplier_id" id="supplier_id">
                                    <option value="">Pilih</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_code }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note" id="note" rows="3" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-success" type="button" onclick="add_row(this)">Tambah Baris</button>
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Hapus</th>
                                        <th style="width: 200px;">Produk</th>
                                        <th>Satuan</th>
                                        <th class="text-right" style="width: 0px;">Qty</th>
                                        <th class="text-right" style="width: 0px;">Harga Beli</th>
                                        <th class="text-right">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="product_list">
                                    
                                </tbody>
                                <tfoot style="text-align: right;">
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="1">Subtotal</th>
                                        <th id="total_amount"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="1">
                                            <div class="custom-control custom-checkbox col-sm-12">
                                                <input name="ppn_check" id="ppn_check" class="custom-control-input" type="checkbox" onclick="set_ppn()">
                                                <label for="ppn_check" class="custom-control-label">PPN 11%</label>
                                            </div>
                                        </th>
                                        <td id="ppn">0</td>
                                    </tr>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="1">Diskon</th>
                                        <th>
                                            <input type="text" class="form-control" name="discount" id="discount" value="0" style="text-align: right; width: 101px; display: inline-block;" onkeyup="set_total_all(this)">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="1">Biaya Kirim</th>
                                        <th>
                                            <input type="text" class="form-control" name="delivery" id="delivery" value="0" style="text-align: right; width: 101px; display: inline-block;" onkeyup="set_total_all(this)">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5"></th>
                                        <th colspan="1">Total Bayar</th>
                                        <th id="total_amount_all"></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="set_val_total_amount" id="set_val_total_amount">
                            <input type="hidden" name="set_val_ppn" id="set_val_ppn">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="purchase_save()">Simpan</button>
        <button type="button" class="btn btn-danger" onclick="close_modal_xl_load()">Batal</button>
    </div>
</div>

<script type="text/javascript" src="{{ asset('adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function(){
        add_row(1);
    });    

    $('.today').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    function add_row(urut='') {
        no_urut      = document.getElementsByClassName("no_urut");
        no_akhir     = (no_urut.length=='0') ? 0 : (no_urut[no_urut.length-1].value);
        no_akhir_set = (parseInt(no_akhir) > 0) ? (parseInt(no_akhir)+1) : (1);

        btn_hapus = (no_akhir_set > 1) ? '<button class="btn btn-danger btn-sm" type="button" onclick="delete_row(this,'+no_akhir_set+')" title="Hapus Baris"><i class="fas fa-trash"></i></button>' : "";
        new_row = `<tr>
                        <td style="text-align: center; width: 0px;">
                            ${no_akhir_set}
                            <input type="hidden" name="no_urut[]" id="no_urut_${no_akhir_set}" class="no_urut" value="${no_akhir_set}" readonly>
                        </td>
                        <td style="text-align: center; width: 72px;">${btn_hapus}</td>
                        <td>
                            <select class="form-control" name="product_code_alias[]" id="product_code_alias_${no_akhir_set}" onchange="double_product_check(${no_akhir_set})" style="width: 400px;">
                                <option value="">-PILIH-</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_code_alias }}">{{ $product->product_variant_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <span style="" id="unit_name_${no_akhir_set}"></span>
                            <input type="hidden" name="unit_id[]" id="unit_id_${no_akhir_set}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="purchase_qty[]" id="purchase_qty_${no_akhir_set}" onkeyup="qty_add(this, ${no_akhir_set})" style="text-align: right; width: 101px;">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="purchase_price[]" id="purchase_price_${no_akhir_set}" onkeyup="price_add(this, ${no_akhir_set})" style="text-align: right; width: 110px;">
                        </td>
                        <td style="text-align: right;">
                            <span id="set_amount_${no_akhir_set}"></span>
                            <input type="hidden" name="amount[]" id="amount_${no_akhir_set}">
                        </td>
                    </tr>`;
        $("#product_list").append(new_row);
        $('#product_code_alias_'+no_akhir_set).select2();
    }

    function delete_row(data){
        $(data).closest('tr').remove();
        calculate();
        return false;
    }

    function get_product(urut, data) {
        supplier_id = $('#supplier_id').val();
        if(supplier_id == "") {
            alert('Pilih supplier terlebih dahulu');
            $('#supplier_id').focus();
            return false;
        }

        $('#product_code_'+urut).select2({
            placeholder: 'Ketik Kode/Nama Produk',
            dropdownAutoWidth : true,
            ajax: {
                url     : "{{ url('/purchase/get_product') }}",
                dataType: 'json',
                type    : "post",
                delay   : 100,
                data    : function (params) {
                    return {
                        term       : params.term,
                        supplier_id: supplier_id,
                        _token     : _token
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    function double_product_check(urut) {
        let product_code_alias = $('#product_code_alias_'+urut).val();

        $.post("{{ url('/purchase/double_product_check') }}", $("#form_input").serialize()+'&get_product_code='+product_code_alias, function(result) {
            if(result.status == "duplicate") {
                alert('Produk baris no '+urut+' sudah dipilh');
                $('#save_btn').prop('disabled', true);
            } else {
                $('#save_btn').prop('disabled', false);
            }

            $('#product_code_'+urut).val(result.product_code);
            $('#unit_id_'+urut).val(result.unit_id);
            $('#unit_name_'+urut).text(result.unit_name);
            $('#purchase_qty_'+urut).val(1);
            $('#purchase_price_'+urut).val(format_number2(result.capital_price));
            $('#set_amount_'+urut).text(format_number2(result.capital_price));
            $('#amount_'+urut).val(result.capital_price);
            calculate();
        },"json");
    }

    function qty_add(data,urut='') {
        var isi = data.value;
        let qty = format_number(isi);
        $(data).val(qty);

        let setqty= 0;
        if(qty!="") {
            setqty = parseInt(qty.replaceAll(",",""));
        }

        let price = $('#purchase_price_'+urut).val();
        price     = format_number(price);
        price     = price.replaceAll(',', '');

        var total = setqty * price;
        $('#amount_'+urut).val(total);
        total     = format_number2(total);
        $('#set_amount_'+urut).text(total);
        calculate();
    }

    function price_add(data,urut='') {
        var isi   = data.value;
        let price = format_number(isi);
        $(data).val(price);

        let setprice = 0;
        if(price!="") {
            setprice = parseInt(price.replaceAll(",",""));
        }

        let qty = $('#purchase_qty_'+urut).val();
        qty     = format_number(qty);
        qty     = qty.replaceAll(',', '');

        var total = setprice * qty;
        $('#amount_'+urut).val(total);
        total     = format_number2(total);
        $('#set_amount_'+urut).text(total);
        calculate();
    }

    function set_ppn() {
        let ppn_val      = 0;
        let total_amount = $('#set_val_total_amount').val();
        if( $('#ppn_check').is(':checked') && total_amount != "") {
            total_amount     = parseInt(total_amount);

            ppn_val = (total_amount * 11) / 100;
        }

        $('#ppn').text(format_number2(ppn_val));
        $('#set_val_ppn').val(ppn_val);
        calculate_total();
    }

    function purchase_save() {        
        let purchase_date = $('#purchase_date').val();
        if(purchase_date=="") {
            alert('Tanggal Pembelian harus diisi');
            $('#purchase_date').focus();
            return false;
        }


        let purchase_duedate = $('#purchase_duedate').val();
        if(purchase_duedate=="") {
            alert('Tanggal Jatuh Tempo harus diisi');
            $('#purchase_duedate').focus();
            return false;
        }

        let supplier_id = $('#supplier_id').val();
        if(supplier_id=="") {
            alert('Supplier harus dipilih');
            $('#supplier_id').focus();
            return false;
        }

        nomor_head = $('.no_urut').map(function () {
                        return this.value;
                     }).get();

        var product_code_alias = document.getElementsByName('product_code_alias[]');

        for (i=0; i < product_code_alias.length; i++) {
            nomor = nomor_head[i];
            
            if ($("#product_code_alias_"+nomor).val() == "") {
                alert("Produk No. "+nomor+" harus dipilih.");
                $("#product_code_alias_"+nomor).focus();
                return false;
            }

            if ($("#purchase_qty_"+nomor).val() == "") {
                alert("Qty No. "+nomor+" harus diisi.");
                $("#purchase_qty_"+nomor).focus();
                return false;
            } else {
                if($("#purchase_qty_"+nomor).val() == 0) {
                    alert("Qty No. "+nomor+" tidak boleh 0.");
                    $("#purchase_qty_"+nomor).focus();
                    return false;
                }
            }

            if ($("#purchase_price_"+nomor).val() == "") {
                alert("Harga beli No. "+nomor+" harus diisi.");
                $("#purchase_price_"+nomor).focus();
                return false;
            } else {
                if($("#purchase_price_"+nomor).val() == 0) {
                    alert("Harga beli No. "+nomor+" tidak boleh 0.");
                    $("#purchase_price_"+nomor).focus();
                    return false;
                }
            }
        }

        $('.overlay').prop('hidden', false);
        $.post("{{ url('/purchase/purchase_save') }}", $("#form_input").serialize(), function(result) {
            setTimeout(function () {
                $('.overlay').prop('hidden', true);
            }, 1000);
            
            if(result.status=="ok") {
                success_notif('Data pembelian berhasil disimpan');
                close_modal_xl_load();
            } else {
                error_notif('Data pembelian gagal disimpan');
                $('.overlay').prop('hidden', false);
            }
        }, 'json').fail(function(data) {
            error_notif("Terjadi suatu kesalahan. Hubungi Admin IT");
            $('.overlay').prop('hidden', true);
        });
    }

    function get_variant(urut) {
        let variant_id = $('#variant_id_'+urut).val();

        console.log(variant_id);

        // $.post("{{ url('/purchase/get_variant') }}", {product_code, _token}, function(result) {
        //     $('#size_code_'+urut).html(result.size_variant);
        //     $('#color_code_'+urut).html(result.color_variant);
        //     $('#purchase_price_'+urut).val(format_number2(result.price));
        // }, 'json');
    }

    function set_total_all(data) {
        var isi   = data.value;
        let value = format_number(isi);
        $(data).val(value);
        
        calculate_total();
    }

    function calculate() {
        let subtotal = 0;
        let product_list = $('#product_list tr').length;
        for (let index = 1; index <= product_list; index++) {
            let amount = $('#set_amount_'+index).text();
            if(amount=="") {
                subtotal += 0;
            } else {  
                subtotal += parseInt(amount.replaceAll(",",""));
            }
        }

        $('#total_amount').text(format_number2(subtotal));
        $('#set_val_total_amount').val(subtotal);
        calculate_total();
    }

    function calculate_total() {
        let subtotal = $('#total_amount').text();
        let discount = $('#discount').val();
        let ppn      = $('#set_val_ppn').val();
        let delivery = $('#delivery').val();

        if(subtotal=="") {
            subtotal = 0;
        } else {
            subtotal = parseInt(subtotal.replaceAll(",",""));
        }

        if(discount=="") {
            discount = 0;
        } else {
            discount = parseInt(discount.replaceAll(",",""));
        }

        if(ppn=="") {
            ppn = 0;
        } else {
            ppn = parseInt(ppn);
        }

        if(delivery=="") {
            delivery = 0;
        } else {
            delivery = parseInt(delivery.replaceAll(",",""));
        }

        let total_all = (subtotal + parseInt(ppn)) - discount + delivery;

        $('#total_amount_all').text(format_number2(total_all));
    }
</script>