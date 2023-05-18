<table id="tbl-merk" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Nama Merk</th>
            <th class="text-center">Opsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($merks as $merk)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-center">{{ $merk->name }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $merk->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="destroy({{ $merk->id }})"><i class="fas fa-trash"></i> Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-merk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });
</script>