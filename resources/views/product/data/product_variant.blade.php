<div class="modal-header">
    <h4 class="modal-title">Varian{{$text_variant}}Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save_img" autocomplete="off">
        @if($status_variant == 0)
            <h4 class="text-center text-danger">Produk tidak memiliki varian</h4>
        @else
            <button type="button" class="btn btn-sm btn-success mb-2" onclick="variant_add('{{ $product_code }}')">Tambah Varian</button>
            <div class="table-responsive">
                @if($type_variant == 1)
                    <table id="tbl-variant" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th style="width: 50px;">Opsi</th>
                                <th class="text-left">Varian Warna Produk</th>
                                <th class="text-left">Stok</th>
                                <th class="text-left">Harga Modal</th>
                                <th class="text-left">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $variant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="project-actions text-center">
                                    <button class="btn btn-primary btn-xs" onclick="show({{ $variant->variant_id }})"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-xs" onclick="delete_confirm({{ $variant->variant_id }}, '{{ url('/bank/destroy') }}')"><i class="fas fa-trash"></i></button>
                                </td>
                                <td>{{ $variant->name.', '.$variant->color_name }}</td>
                                <td class="text-right">@currency($variant->variant_stock)</td>
                                <td class="text-right">@currency($variant->variant_capital_price)</td>
                                <td class="text-right">@currency($variant->variant_selling_price)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif($type_variant == 2)
                    <table id="tbl-variant" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th style="width: 50px;">Opsi</th>
                                <th class="text-left">Ukuran</th>
                                <th class="text-left">Stok</th>
                                <th class="text-left">Harga Modal</th>
                                <th class="text-left">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $variant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="project-actions text-center">
                                    <button class="btn btn-primary btn-xs" onclick="show({{ $variant->variant_id }})"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-xs" onclick="delete_confirm({{ $variant->variant_id }}, '{{ url('/bank/destroy') }}')"><i class="fas fa-trash"></i></button>
                                </td>
                                <td>{{ $variant->name.', '.$variant->size_name }}</td>
                                <td class="text-right">@currency($variant->variant_stock)</td>
                                <td class="text-right">@currency($variant->variant_capital_price)</td>
                                <td class="text-right">@currency($variant->variant_selling_price)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table id="tbl-variant" class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th style="width: 50px;">Opsi</th>
                                <th class="text-left">Ukuran</th>
                                <th class="text-left">Warna</th>
                                <th class="text-left">Stok</th>
                                <th class="text-left">Harga Modal</th>
                                <th class="text-left">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $variant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="project-actions text-center">
                                    <button class="btn btn-primary btn-xs" onclick="show({{ $variant->variant_id }})"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-danger btn-xs" onclick="delete_confirm({{ $variant->variant_id }}, '{{ url('/bank/destroy') }}')"><i class="fas fa-trash"></i></button>
                                </td>
                                <td>{{ $variant->name.', '.$variant->size_name }}</td>
                                <td>{{ $variant->name.', '.$variant->color_name }}</td>
                                <td class="text-right">@currency($variant->variant_stock)</td>
                                <td class="text-right">@currency($variant->variant_capital_price)</td>
                                <td class="text-right">@currency($variant->variant_selling_price)</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="close_modal_lg()">Close</button>
        </div>
    </form>
</div>

<script>
    function variant_add(product_code) {
        close_modal_lg();
        $.post("{{ url('/product/variant_add') }}", {_token, product_code}, function(data) {
            $('#modal-mid-x').modal('show');
            $('#modal_body_mid_x').html(data);
        });
    }
</script>