<table id="tbl-category" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Opsi</th>
            <th class="text-left">Kode</th>
            <th class="text-left">Nama Kategori</th>
            <th class="text-left">User Input</th>
            <th class="text-left">Tgl Input</th>
            <th class="text-left">User Edit</th>
            <th class="text-left">Tgl Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $category->id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="destroy({{ $category->id }})"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td class="text-center">{{ $category->category_code}}</td>
            <td class="text-center">{{ $category->name }}</td>
            <td>{{ $category->UserInput }}</td>
            <td>{{ tglIndo($category->input_date, false, true) }}</td>
            <td>{{ $category->UserEdit }}</td>
            <td>{{ tglIndo($category->update_date, false, true) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-category").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });
</script>