<div class="form-group row">
    <label for="color_name" class="col-sm-4 col-form-label">Nama Warna<span style="color: red;">*</span></label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="color_name" value="{{ $color->color_name }}" id="color_name" required>
    </div>
    <div class="col-sm-2">
        <button class="btn btn-primary" onclick="update({{ $color->id }})">Update</button>
    </div>
</div>  