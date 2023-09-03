<div class="table-responsive">    
    <table id="tbl-supplier" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center">Opsi</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>No Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="project-actions text-center">
                    <button class="btn btn-primary btn-sm" onclick="show({{ $supplier->supplier_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $supplier->supplier_id }}, '{{ url('/supplier/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
                </td>
                <td>{{ $supplier->supplier_code }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->phone}}</td>
                <td>{{ $supplier->address}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {

        $("#tbl-supplier").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/supplier/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('#modal_body_mid').html(data);
        });
    }
</script>