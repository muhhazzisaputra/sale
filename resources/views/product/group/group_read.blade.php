<table id="tbl-group" class="table table-bordered table-striped"> 
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama Kelompok</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $group->group_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $group->group_id }}, '{{ url('/group/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $group->code}}</td>
            <td class="text-center">{{ $group->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-group").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/product_group/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('.modal-title').text('Edit Kategori Produk');
            $('#modal_body_mid').html(data);
        });
    }
</script>