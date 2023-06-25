<table id="tbl-category" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-left">Kode</th>
            <th class="text-left">Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $category->category_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $category->category_id }}, '{{ url('/category/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $category->category_code}}</td>
            <td class="text-center">{{ $category->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(function() {

        $("#tbl-category").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/category/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('.modal-title').text('Edit Kategori Produk');
            $('#modal_body_mid').html(data);
        });
    }
</script>