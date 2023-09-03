<div class="modal-header">
    <h4 class="modal-title">Galeri Produk</h4>
</div>
<div class="modal-body">
    <form id="form_save_img" autocomplete="off">
        @csrf
        <input type="hidden" name="product_code" value="{{ $product_code }}">
        <div class="form-group row">
            <label for="gallery_add" class="col-sm-4 col-form-label">Upload Gambar<span style="color: red;">*</span></label>
            <div class="col-sm-6">
                <input type="file" class="form-control" name="gallery_add" id="gallery_add">
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-primary" id="btn_save_img" onclick="save_img()">Simpan</button>
            </div>
        </div>
        <div class="card-body">
            <table id="tbl-product" class="table table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="width: 50px;">Opsi</th>
                        <th class="text-center">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_images as $pim)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm" onclick="delete_confirm({{ $pim->product_image_id }}, '{{ url('/product/deleteImage') }}')"><i class="fas fa-trash"></i></button>
                        </td>
                        <td><img src="{{ asset('storage/product-images/'.$pim->product_image) }}" width="90px"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="close_modal_mid()">Close</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    function save_img() {
        let form_data = new FormData($('#form_save_img')[0]);

        jQuery.ajax({
            type       : "POST",
            url        : "{{ url('/product/save_image') }}",
            data       : form_data,
            processData: false,
            contentType: false,
            dataType   : "json",
            success    : function(res) {
                if(res.status=="success") {
                    success_notif('Gambar berhasil disimpan');
                    window.location.replace("{{ url('/product') }}");
                } else {
                    error_notif('Gambar gagal disimpan');
                    $('#btn_save_img').prop('disabled', true);
                    return false;
                }
            },
            error: function(xhr, status, error) {
                error_notif("Data gagal disimpan");
            }
        });
    }
</script>