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
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
            </div>
            <form id="form_save" autocomplete="off">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="purchase_date">Tanggal Pembelian <span style="color: red;">*</span></label>
                                <input type="text" class="form-control @error('purchase_date') is-invalid @enderror" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Supplier <span style="color: red;">*</span></label>
                                <select class="form-control" name="supplier_id" id="supplier_id">
                                    <option value="">Pilih</option>
                                    @foreach($suppliers as $supplier)
                                        @if(old('supplier_id') == $supplier->id)
                                            <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                                        @else
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="note">Catatan Pembelian</label>
                                <textarea class="form-control" name="note" id="note" value="{{ old('note') }}" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-block btn-primary mb-2" data-toggle="modal" data-target="#modal-pilih"><i class="fa fa-plus"></i> Pilih Produk</button>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered display no-wrap">
                            <thead>
                                <tr>
                                    <th width="20">No</th>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th width="130" class="text-right">Harga Beli</th>
                                    <th width="100" class="text-right">Qty</th>
                                    <th width="150" class="text-right">Total</th>
                                    <th width="30" class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="list">
                                
                            </tbody>
                        </table>
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
                    <div class="row justify-content-center" id="btn_po" style="display: none;">
                        <div class="col-md-3">
                            <a href="/purchase" class="btn btn-block btn-danger"><i class="fas fa-arrow-left"></i> Batal</a>
                        </div> 
                        <div class="col-md-3">
                            <button type="button" class="btn btn-block btn-primary" id="save_btn" onclick="save_process(this)"><i class="fa fa-save"></i> Simpan</button>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
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
    $(document).ready(function() {

        $('#purchase_date').daterangepicker({
            singleDatePicker: true,
            minDate: 0,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });

        $('.select2').select2();

        $(document).on('change', '#product_id', function() {
            var id = $(this).val();

            if(id != null) {
                $.get("{{ url('/purchase/getVariant') }}/" + id, function(result) {
                    $('#variant_id').empty();
                    $('#variant_id').append(result);
                });
            }
        });

        $(document).on('click', '#pilih', function() {
            let product_id = $('#product_id').val();

            if(product_id == null) {
                alert('Produk wajib dipilih!');
                return false;
            }

            let variant_id = $('#variant_id').val();
            if(variant_id == null) {
                alert('Ukuran wajib dipilih!');
                return false;
            }

            let qty = $('#qty_head').val();
            if(qty == "" || qty == "0") {
                alert('Qty wajib diisi!');
                $('#qty_head').focus();
                return false;
            }

            $('#modal-pilih').modal('hide');

            $.get("{{ url('/purchase/chooseProduct/') }}", {id: variant_id}, function(data) {
                if(data != null) {
                    let row  = $("#list tr").length;
                    let num  = parseInt(row + 1);

                    let list = `<tr>
                                    <td width="20" id="urut_${num}">${num}</td>
                                    <td>
                                        ${data.product_name}
                                        <input type="hidden" name="product_id[]" id="product_id_${num}" value="${data.product_id}">
                                    </td>
                                    <td>${data.size_name}</td>
                                    <td class="text-right" width="130">
                                        <input type="text" name="capital_price[]" id="capital_price_${num}" class="form-control" value="${formatRupiah(data.capital_price)}" onkeyup="num_only(this);get_total(${num})" style="text-align: right; direction: rtl;">
                                    </td>
                                    <td class="text-right" width="100">
                                        <input type="text" name="qty[]" id="qty_${num}" class="form-control" value="${qty}" onkeyup="num_only(this);get_total(${num})" style="text-align: right;">
                                    </td>
                                    <td class="text-right" width="150" name="total[]" id="total_${num}">${formatRupiah(data.capital_price * qty)}</td>
                                    <td class="text-center" width="30">
                                        <button type="button" class="btn btn-sm btn-danger del_row"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>`;

                    $('#list').append(list);
                    
                    $('#product_id').select2("val", "0");
                    $('#variant_id').prop('selectedIndex', 0);
                    $('#qty_head').val('');
                    show_gtotal(num);
                    calculate();
                }
            }, 'json');
        });

        $(document).on('click', '.del_row', function() {
            let ele = $(this);
            ele.parents("tr").remove();

            let row = $('#list tr').length;
            show_gtotal(row);
            calculate();
        });

    });

    function show_gtotal(num) {
        if(num > 0) {
            $('#gtotal').removeAttr('style');
            $('#btn_po').removeAttr('style');
        } else {
            $('#gtotal').css('display', 'none');
            $('#btn_po').css('display', 'none');
        }
    }

    function get_total(num) {
        let qty   = $('#qty_'+num).val();
        let price = $('#capital_price_'+num).val();

        qty   = qty.replace('.', '');
        price = price.replace('.', '');

        if(qty > 0 && price > 0) {
            let total = parseInt(price) * parseInt(qty);
            $('#total_'+num).text(formatRupiah(total));
            calculate();
        }
    }

    function other_set() {
        let other = $('#other').val();

        if(other != "" || other > 0) {
            calculate();
        }
    }

    function calculate() {
        let sum = 0;

        let total = document.getElementsByName('total[]');
        for (i=0; i<total.length; i++) {
            nomor = parseInt(i)+1;
            let total = $('#total_'+nomor).text();
            total = total.replace('.', '');
            sum += parseInt(total);
        }

        isNaN(sum) ? $('#subtotal').val(0) : $('#subtotal').text(formatRupiah(sum));

        let other_set = 0;

        let other = $('#other').val();
        if(other != "" || other > 0) {
            other_set = other.replace('.', '');
        }

        let grand_total = parseInt(sum) + parseInt(other_set);
        $('#grand_total').text(formatRupiah(grand_total));
    }

    function save_process() {
        let supplier = $("#supplier_id").val();
        if(supplier == "") {
            alert("Supplier harus dipilih!");
            $("#supplier_id").focus();
            return false;
        }

        let row  = $("#list tr").length + 1;
        for (i=1; i < row; i++) {
            if ($("#capital_price_"+i).val() == "") {
                alert("Harga beli No. "+i+" tidak boleh kosong!");
                $("#capital_price_"+i).focus();
                return false;
            }

            if ($("#capital_price_"+i).val() == 0) {
                alert("Harga beli No. "+i+" tidak boleh 0!");
                $("#capital_price_"+i).focus();
                return false;
            }

            if ($("#qty_"+i).val() == "") {
                alert("Qty No. "+i+" tidak boleh kosong!");
                $("#qty_"+i).focus();
                return false;
            }

            if ($("#qty_"+i).val() == 0) {
                alert("Qty No. "+i+" tidak boleh 0!");
                $("#qty_"+i).focus();
                return false;
            }
        }

        // $("#btn_simpan").prop("disabled",true);
        $.post("{{ url('/purchase/store') }}", $("#form_save").serialize(), function(data) {

        });
    }

    function num_only(data) {
        var isi   = data.value;
        var isi2  = $(this);
        let hasil = formatRupiah(isi);
        $(data).val(hasil);
    }

    /* Fungsi formatRupiah */
    function formatRupiah(angka) {
        let str = angka.toString();
        var number_string = str.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah;
    }
</script>

@endsection