@extends('layouts.main')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}" />

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/purchase">Pembelian</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <form id="form_input" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Data Pembelian</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label for="purchase_date" class="col-sm-6 col-form-label">Tanggal Pembelian<span style="color: red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="purchase_date" class="form-control" id="purchase_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="purchase_date" class="col-sm-6 col-form-label">Tanggal Jatuh Tempo<span style="color: red;">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" name="purchase_date" class="form-control" id="purchase_date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Supplier<span style="color: red;">*</span></label>
                                <div class="col-sm-6">
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
                            <div class="table-responsive mt-2" style="height: 300px;">
                                <table class="table table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hapus</th>
                                            <th>Produk</th>
                                            <th>Ukuran</th>
                                            <th>Warna</th>
                                            <th class="text-right">Harga Beli</th>
                                            <th class="text-right">Qty</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_list">
                                        
                                    </tbody>
                                    <tfoot style="text-align: right;">
                                        <tr>
                                            <th colspan="5"></th>
                                            <th colspan="2">Subtotal :</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5"></th>
                                            <th colspan="2">Biaya Lainnya :</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <table class="table" id="gtotal" style="display: none;">
                                <tr>
                                    <th class="text-right">Subtotal : </th>
                                    <th class="text-right" width="150" name="subtotal" id="subtotal"></th>
                                    <th width="73"></th>
                                </tr>
                                <tr>
                                    <th class="text-right">(+) Biaya Lainnya : </th>
                                    <th class="text-right" width="150">
                                        <input type="text" name="other" id="other" class="form-control" value="0" style="text-align: right;" onkeyup="num_only(this);other_set()">
                                    </th>
                                    <th width="73"></th>
                                </tr>
                                <tr>
                                    <th class="text-right">Grand Total : </th>
                                    <th class="text-right" width="150" name="grand_total" id="grand_total"></th>
                                    <th width="73"></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<div class="modal fade" id="modal-pilih">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="purchase/store">
                    <div class="form-group row">
                        <label for="product_id" class="col-sm-3 col-form-label">Produk <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="product_id" id="product_id" style="width: 100%;">
                                <option value="0" selected disabled>Pilih Produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="variant_id" class="col-sm-3 col-form-label">Ukuran <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="variant_id" id="variant_id" required>
                                <option value="0" selected disabled>Pilih Ukuran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty" class="col-sm-3 col-form-label">Qty <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="qty_head" id="qty_head" min="1" placeholder="Qty" onkeyup="num_only(this)" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-primary" id="pilih">Pilih</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('adminlte/plugins/daterangepicker/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script>
    $(function(){
        add_row(1);
        $('#product_code_'+1).select2();
    });    

    $('#purchase_date').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    function add_row(urut=''){
        no           = parseInt(urut);
        no_urut      = document.getElementsByClassName("no_urut");
        no_akhir     = (no_urut.length=='0') ? 0 : (no_urut[no_urut.length-1].value);
        no_akhir_set = (parseInt(no_akhir) > 0) ? (parseInt(no_akhir)+1) : (1);

        btn_hapus = (no_akhir_set > 1) ? '<button class="btn btn-danger btn-sm" type="button" onclick="delete_row(this,'+no_akhir_set+')" title="Hapus Baris"><i class="fas fa-trash"></i></button>' : "";
        new_row = `<tr>
                        <td>
                            ${no_akhir_set}
                            <input type="hidden" name="no_urut[]" id="no_urut_${no_akhir_set}" class="no_urut" value="${no_akhir_set}" readonly style="text-align: center; width: 45px;">
                        </td>
                        <td style="text-align: center; width: 72px;">${btn_hapus}</td>
                        <td>
                            <select class="form-control" name="product_code[]" id="product_code_${no_akhir_set}" onchange="double_product_check(${no_akhir_set}); get_variant(${no_akhir_set});" style="width: 300px;">
                                <option value="">-PILIH-</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->product_code }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="size_code[]" id="size_code_${no_akhir_set}" style="width: 160px;">
                                <option value="">-PILIH-</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="color_code[]" id="color_code_${no_akhir_set}" style="width: 160px;">
                                <option value="">-PILIH-</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="purchase_price[]" id="purchase_price_${no_akhir_set}" onkeyup="num_only(this)" style="text-align: right; width: 103px;">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="purchase_qty[]" id="purchase_qty_${no_akhir_set}" onkeyup="num_only(this)" style="text-align: right; width: 95px;">
                        </td>
                        <td><span style="text-align: right; width: 95px;"></span></td>
                    </tr>`;
        $("#product_list").append(new_row);
        $('#product_code_'+no_akhir_set).select2();
    }

    function delete_row(data){
        $(data).closest('tr').remove();
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
        // $.post("{{ url('/purchase/double_product_check') }}", $("#form_input").serialize(), function(result) {
        //     console.log(result);
        // },"json");
    }

    function get_variant(urut) {
        let product_code = $('#product_code_'+urut).val();

        $.post("{{ url('/purchase/get_variant') }}", {product_code, _token}, function(result) {
            $('#size_code_'+urut).html(result.size_variant);
            $('#color_code_'+urut).html(result.color_variant);
            $('#purchase_price_'+urut).val(format_number2(result.price));
        }, 'json');
    }
</script>

@endsection