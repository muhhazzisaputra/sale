<div class="modal-header">
    <h4 class="modal-title">Pemasok Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save_img" autocomplete="off">
        @csrf
        <button type="button" class="btn btn-sm btn-success mb-2" onclick="supplier_add('{{ $product_code }}')">Tambah Pemasok</button> 
        <div class="table-responsive">
            <table id="tbl-supplier" class="table table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="width: 50px;">Opsi</th>
                        <th class="text-left">Kode Supplier</th>
                        <th class="text-left">Nama Supplier</th>
                        <th class="text-left">No Telepon</th>
                        <th class="text-left">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="project-actions text-center">
                            <button class="btn btn-danger btn-xs" onclick="delete_confirm({{ $supplier->product_supplier_id }}, '{{ url('/bank/destroy') }}')"><i class="fas fa-trash"></i></button>
                        </td>
                        <td>{{ $supplier->supplier_code }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->phone }}</td>
                        <td>{{ $supplier->address }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="close_modal_lg()">Close</button>
        </div>
    </form>
</div>

<script>
    function supplier_add(product_code) {
        close_modal_lg();
        $.post("{{ url('/product/supplier_add') }}", {_token, product_code}, function(data) {
            $('#modal-mid-x').modal('show');
            $('#modal_body_mid_x').html(data);
        });
    }
</script>