<div class="modal-header">
    <h4 class="modal-title">Detail Pembelian</h4>
</div>
<div class="modal-body">
    <form id="form_edit" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="purchase_id" value="{{ $purchase->purchase_id }}" readonly>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="purchase_date" class="col-sm-7 col-form-label">Tanggal Pembelian<span style="color: red;">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="purchase_date" class="form-control" id="purchase_date" value="{{ $purchase->purchase_date }}" style="width: 108px;" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="purchase_date" class="col-sm-7 col-form-label" data-toggle="tooltip" data-original-title="tanggal">Tanggal Jatuh Tempo<span style="color: red;">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" name="purchase_duedate" class="form-control" id="purchase_duedate" value="{{ $purchase->purchase_duedate }}" style="width: 108px;" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Supplier<span style="color: red;">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="supplier_id" id="supplier_id" readonly>
                                    <option value="">Pilih</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_code }}" {{ ($supplier->supplier_code==$purchase->supplier_code) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label for="note" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="note" id="note" rows="3" style="resize: none;" readonly>{{ $purchase->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th style="width: 200px;">Produk</th>
                                        <th>Satuan</th>
                                        <th class="text-right" style="width: 0px;">Qty</th>
                                        <th class="text-right" style="width: 0px;">Harga Beli</th>
                                        <th class="text-right">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody id="product_list">
                                    @foreach($purchase_items as $item)
                                    <tr>
                                        <td style="text-align: center; width: 0px;">{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-right">{{ number_format($item->purchase_qty) }}</td>
                                        <td class="text-right">{{ number_format($item->purchase_price) }}</td>
                                        <td style="text-align: right;">{{ number_format($item->amount) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot style="text-align: right;">
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1">Subtotal</th>
                                        <th id="total_amount">{{ number_format($purchase->amount_total)}}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1">PPN 11%</th>
                                        <td id="ppn">{{ number_format($purchase->ppn) }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1">Diskon</th>
                                        <th>{{ number_format($purchase->discount) }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1">Biaya Kirim</th>
                                        <th>{{ number_format($purchase->delivery) }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4"></th>
                                        <th colspan="1">Total Bayar</th>
                                        <th id="total_amount_all">{{ number_format(($purchase->amount_total + $purchase->ppn) - $purchase->discount + $purchase->delivery) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <input type="hidden" name="set_val_total_amount" id="set_val_total_amount" value="{{ $purchase->amount_total }}">
                            <input type="hidden" name="set_val_ppn" id="set_val_ppn" value="{{ $purchase->ppn }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal_xl_load()">Tutup</button>
    </div>
</div>

<script>   
    $(function() {
        $('[data-toggle="tooltip"]').tooltip({placement: 'right'});

        const purchase_rows = parseInt('{{ $purchase_rows }}');
        
        for (var i=1; i <= purchase_rows; i++) {
            $('#product_code_alias_'+i).select2();
        }
    });
</script>