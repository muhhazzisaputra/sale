<table id="tbl-size" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-center">Nama Ukuran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sizes as $size)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $size->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="destroy({{ $size->id }})"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $size->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-size").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });
</script>