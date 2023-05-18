<table id="tbl-color" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nama Warna</th>
            <th class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colors as $color)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-center">{{ $color->color_name }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $color->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="destroy({{ $color->id }})"><i class="fas fa-trash"></i> Hapus</button>
            </td>
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
</script>