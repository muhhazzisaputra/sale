<table id="tbl-unit" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-center">Nama Satuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($units as $unit)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-primary btn-sm" onclick="show({{ $unit->unit_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $unit->unit_id }}, '{{ url('/unit/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $unit->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-unit").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/unit/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('.modal-title').text('Edit Satuan Produk');
            $('#modal_body_mid').html(data);
        });
    }
</script>