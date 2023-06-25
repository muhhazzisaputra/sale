<table id="tbl-bank" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th class="text-center">Opsi</th>
            <th>Kode Bank</th>
            <th>Akun Bank</th>
            <th>No Rekening</th>
            <th>Pemilik Rekening</th>
            <th>Cabang</th>
        </tr>
    </thead>
    <tbody>
        @foreach($banks as $bank)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="project-actions text-center">
                <button class="btn btn-info btn-sm" onclick="show({{ $bank->bank_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $bank->bank_id }}, '{{ url('/bank/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
            </td>
            <td>{{ $bank->bank_code }}</td>
            <td>{{ $bank->name }}</td>
            <td>{{ $bank->account_number}}</td>
            <td>{{ $bank->account_owner}}</td>
            <td>{{ $bank->branch}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {

        $("#tbl-bank").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/bank/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('.modal-title').text('Edit Data Bank');
            $('#modal_body_mid').html(data);
        });
    }
</script>