<div class="modal-header">
    <h4 class="modal-title">Setting Diskon Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save_img" autocomplete="off">
        @csrf
        <button type="button" class="btn btn-sm btn-success mb-2" onclick="add_row('{{ $product_code }}')">Tambah Baris</button> 
        <div class="table-responsive">
            <table id="tbl-supplier" class="table table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th class="text-center" style="width: 50px;">Opsi</th>
                        <th class="text-left">Dari</th>
                        <th class="text-left"></th>
                        <th class="text-left">Sampai</th>
                        <th class="text-left">Harga Diskon</th>
                    </tr>
                </thead>
                <tbody id="new_row">

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="close_modal_lg()">Close</button>
        </div>
    </form>
</div>

<script>
    $(function(){
        add_row(1);
    });

    function add_row(urut='') {
        let no           = parseInt(urut);
        let no_urut      = document.getElementsByClassName("no_urut");
        let no_akhir     = (no_urut.length==0) ? 0 : (no_urut[no_urut.length-1].value);
        let no_akhir_set = (parseInt(no_akhir) > 0) ? (parseInt(no_akhir)+1) : (1)

        let btn_hapus = (no_akhir_set>1) ? '<button class="btn btn-danger btn-xs" type="button" onclick="delete_row(this,'+no_akhir_set+')"><i class="fas fa-trash"></i></button>' : "";

        let row_baris = `<tr>
                            <td class="text-center">
                                ${no_akhir_set}
                                <input type="hidden" name="no_urut[]" id="no_urut_${no_akhir_set}" class="no_urut" value="${no_akhir_set}" readonly>
                            </td>
                            <td style="white-space:nowrap;">${btn_hapus}</td>
                            <td>
                                <input class="form-control" type="text" name="qty_start[]" id="qty_start_${no_akhir_set}" style="text-align: right;" onkeyup="num_only(this, ${no_akhir_set})">
                            </td>
                            <td class="text-center"> - </td>
                            <td>
                                <input class="form-control" type="text" name="qty_end[]" id="qty_end_${no_akhir_set}" style="text-align: right;" onkeyup="num_only(this, ${no_akhir_set})">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="discount_price[]" id="discount_price_${no_akhir_set}" style="text-align: right;" onkeyup="num_only(this, ${no_akhir_set})">
                            </td>
                        </tr>`;
        $("#new_row").append(row_baris);
    }

    function delete_row(data){
        $(data).closest('tr').remove();
        return false;
    }
</script>