@extends('layouts/main')

@section('content')

<section class="content-header">
    <div class="container-fluid"> 
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/product">Data Produk</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <form id="form_edit" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_code" value="{{ $product->product_code }}">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Produk</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="prim_image" class="col-sm-4 col-form-label">Gambar Utama Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-5">
                                    <input type="file" accept="image/png,image/jpg,image/jpeg" name="prim_image" class="form-control" id="prim_image" onchange="preview_awal(this)">
                                    <span class="text-danger" style="font-size: 15px;">*Maks 1Mb, Format .jpg, .jpeg, .png</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Nama Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category_id" class="col-sm-4 col-form-label">Kategori Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="category_code" id="category_code">
                                        <option value="">-Pilih-</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_code }}"{{ ($category->category_code == $product->category_code) ? " selected" : "" }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="group_id" class="col-sm-4 col-form-label">Kelompok Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="group_code" id="group_code">
                                        <option value="">-Pilih-</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->group_code }}"{{ ($group->group_code == $product->group_code) ? " selected" : "" }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="weight" class="col-sm-4 col-form-label">Berat Produk(gram)<span style="color: red;">*</span></label>
                                <div class="col-sm-2">
                                    <input type="text" name="weight" class="form-control" id="weight" value="@currency($product->weight)" style="text-align: right;" onkeyup="num_only(this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stock" class="col-sm-4 col-form-label">Stok Awal<span style="color: red;">*</span></label>
                                <div class="col-sm-2">
                                    <input type="text" name="stock" class="form-control" id="stock" value="@currency($product->stock)" style="text-align: right;" onkeyup="num_only(this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="capital_price" class="col-sm-4 col-form-label">Harga Modal<span style="color: red;">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" name="capital_price" class="form-control" id="capital_price" value="@currency($product->capital_price)" style="text-align: right;" onkeyup="num_only(this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selling_price" class="col-sm-4 col-form-label">Harga Jual<span style="color: red;">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" name="selling_price" class="form-control" id="selling_price" value="@currency($product->selling_price)" style="text-align: right;" onkeyup="num_only(this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Deskripsi Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="description" id="description">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="preview_img_set" class="col-sm-4 col-form-label">Preview Gambar</label>
                                <div class="col-sm-3">
                                    <img src="{{ asset('storage/product-images/'.$product->image) }}" id="preview_img_set" alt="Gambar Utama Produk" class="img-thumbnail" onclick="preview_img(this)" style="height: 115px; width: 120px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_sku" class="col-sm-4 col-form-label">SKU Produk</label>
                                <div class="col-sm-3">
                                    <input type="text" name="product_sku" class="form-control" id="product_sku" value="{{ $product->product_sku }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_id" class="col-sm-4 col-form-label">Satuan Produk<span style="color: red;">*</span></label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="unit_id" id="unit_id">
                                        <option value="">-Pilih-</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->unit_id }}"{{ ($unit->unit_id == $product->unit_id) ? " selected" : "" }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="min_stock" class="col-sm-4 col-form-label">Minimal Stok<span style="color: red;">*</span></label>
                                <div class="col-sm-2">
                                    <input type="text" name="min_stock" class="form-control" id="min_stock" value="@currency($product->min_stock)" style="text-align: right;" onkeyup="num_only(this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Status Varian<span style="color: red;">*</span></label>
                                <div class="col-sm-4" style="margin-top: 8px;">
                                    <!-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="variant" id="ya" value="ya" style="margin-top: 6px;">
                                        <label class="form-check-label" for="ya">Ya</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input class="form-check-input" type="radio" name="variant" id="tidak" value="tidak" style="margin-top: 6px;">
                                        <label class="form-check-label" for="tidak">Tidak</label>
                                    </div> -->
                                    <div class="form-group row">
                                        <div class="custom-control custom-radio col-sm-6">
                                            <input class="custom-control-input" type="radio" id="ya" name="variant" value="ya" onclick="set_variant_status()" {{ ($product->status_variant == 1) ? " checked" : "" }}>
                                            <label for="ya" class="custom-control-label">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio col-sm-6">
                                            <input class="custom-control-input" type="radio" id="tidak" name="variant" value="tidak" onclick="set_variant_status()" {{ ($product->status_variant == 0) ? " checked" : "" }}>
                                            <label for="tidak" class="custom-control-label">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="variant_section" {{ ($product->status_variant == 0) ? "hidden" : "" }}>
                                <label class="col-sm-4 col-form-label">Pilih Varian<span style="color: red;">*</span></label>
                                <div class="col-sm-6" style="margin-top: 8px;">
                                    <div class="form-group row">
                                        <div class="custom-control custom-checkbox col-sm-4">
                                            <input class="custom-control-input" type="checkbox" name="warna" id="warna"{{ ($product->variant_color == 0) ? "" : " checked" }}>
                                            <label for="warna" class="custom-control-label">Warna</label>
                                        </div>
                                        <div class="custom-control custom-checkbox col-sm-6">
                                            <input class="custom-control-input" type="checkbox" name="ukuran" id="ukuran"{{ ($product->variant_size == 0) ? "" : " checked" }}>
                                            <label for="ukuran" class="custom-control-label">Ukuran</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-primary" id="btn_update" onclick="update_product()">Update</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script type="text/javascript">
    function set_img_default() {
        img_default = '{{ asset("storage/product-images-default.png") }}';
        
        preview_img_set.src=img_default;
        $('#prim_image').val(img_default);
    }

    function preview_awal() {
        preview_img_set.src=URL.createObjectURL(event.target.files[0]);
        $('#gambar_default').prop('checked', false);
    }

    function preview_img(data) {
        id = data.id;
        $('#set_img').attr('src', $('#'+id).attr('src'));
        $('#modal-img').modal('show');
    }

    function set_variant_status() {
        let status = $('input[name=variant]:checked').val();
        
        $('#variant_section').prop('hidden', true);
        $('#warna').prop('checked', true);
        $('#ukuran').prop('checked', true);

        if(status=="ya") {
            $('#variant_section').prop('hidden', false);
            $('#warna').prop('checked', true);
            $('#ukuran').prop('checked', true);
        }
    }

    function update_product() {
        let name = $('#name').val();
        if(name == "") {
            alert('Nama produk wajib diisi');
            $('#name').focus();
            return false;
        } else {
            if(name.length < 3) {
                alert('Nama produk wajib diisi minimal 3 karakter');
                $('#name').focus();
                return false;
            }
        }

        let category_id = $('#category_code').val();
        if(category_id == "") {
            alert('Kategori produk wajib diisi');
            $('#category_id').focus();
            return false;
        }

        let group_id = $('#group_code').val();
        if(group_id == "") {
            alert('Kelompok produk wajib diisi');
            $('#group_id').focus();
            return false;
        }

        let weight = $('#weight').val();
        if(weight == "") {
            alert('Berat produk wajib diisi');
            $('#weight').focus();
            return false;
        }

        let stock = $('#stock').val();
        if(stock == "") {
            alert('Stok awal produk wajib diisi');
            $('#stock').focus();
            return false;
        }

        let capital_price = $('#capital_price').val();
        if(capital_price == "") {
            alert('Harga modal produk wajib diisi');
            $('#capital_price').focus();
            return false;
        }

        let selling_price = $('#selling_price').val();
        if(selling_price == "") {
            alert('Harga jual produk wajib diisi');
            $('#selling_price').focus();
            return false;
        }

        let description = $('#description').val();
        if(description == "") {
            alert('Deskripsi produk wajib diisi');
            $('#description').focus();
            return false;
        }

        let unit_id = $('#unit_id').val();
        if(unit_id == "") {
            alert('Satua produk wajib diisi');
            $('#unit_id').focus();
            return false;
        }

        let min_stock = $('#min_stock').val();
        if(min_stock == "") {
            alert('Minimal Stok wajib diisi');
            $('#min_stock').focus();
            return false;
        }

        let varian_status = $('input[name=variant]:checked').val();
        if(varian_status == "ya") {
            if($('#warna').prop('checked') == false && $('#ukuran').prop('checked') == false) {
                alert('Varian harus dipilih');
                return false;
            }
        }

        let form_data = new FormData($('#form_edit')[0]);

        jQuery.ajax({
            type       : "POST",
            url        : "{{ url('/product/update') }}",
            data       : form_data,
            processData: false,
            contentType: false,
            dataType   : "json",
            success    : function(res) {
                if(res.status=="success") {
                    success_notif('Data berhasil disimpan');
                    window.location.replace("{{ url('/product') }}");
                } else {
                    error_notif('Gagal upload gambar. Data gagal disimpan');
                    $('#btn_update').prop('disabled', true);
                    return false;
                }
            },
            error: function(xhr, status, error) {
                error_notif("Data gagal disimpan");
            }
        });
    }
</script>
@endsection