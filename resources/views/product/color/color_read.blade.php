<table id="tbl-color" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-center">Nama Warna</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colors as $color)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-primary btn-sm" onclick="show({{ $color->color_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $color->color_id }}, '{{ url('/color/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $color->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-color").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/color/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('#modal_body_mid').html(data);
        });
    }
</script>