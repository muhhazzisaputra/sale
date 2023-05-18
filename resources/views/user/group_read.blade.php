<table id="tbl-group" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-left">Nama Group</th>
            <th class="text-left">User Input</th>
            <th class="text-left">Tanggal Input</th>
            <th class="text-left">User Edit</th>
            <th class="text-left">Tanggal Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $group->group_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="destroy({{ $group->group_id }})"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-left">{{ $group->group_name }}</td>
            <td class="text-left">{{ $group->name }}</td>
            <td class="text-left">{{ $group->input_date }}</td>
            <td class="text-left">{{ $group->name }}</td>
            <td class="text-left">{{ $group->update_date }}</td>
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
</script>