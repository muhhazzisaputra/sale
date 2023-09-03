<div class="table-responsive">
	<table id="tbl-customers" class="table table-bordered table-striped">
  		<thead>
          	<tr>
                <th class="text-center">#</th>
                <th class="text-center">Opsi</th>
                <th class="text-center">Nama Customer</th>
                <th class="text-center">Email Customer</th>
                <th class="text-center">No. Telp/Whatsapp</th>
                <th class="text-center">Level</th>
                <th class="text-center">Alamat</th>
          	</tr>
  		</thead>
  		<tbody>
  			@foreach($customers as $cust)
          	<tr>
                <td>{{ $loop->iteration }}</td>
                <td class="project-actions text-center">
                	<button class="btn btn-primary btn-sm" onclick="show({{ $cust->customer_id }})"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="delete_confirm({{ $cust->customer_id }}, '{{ url('/customer/destroy') }}')"><i class="fas fa-trash"></i> Hapus</button>
                </td>
                <td>{{ $cust->name }}</td>
                <td>{{ $cust->email }}</td>
                <td>{{ $cust->phone }}</td>
                <td>{{ ucfirst($cust->level) }}</td>
                <td>{{ $cust->address }}</td>
          	</tr>
          	@endforeach 
  		</tbody>
	</table>
</div>

<script>
    $(document).ready(function() {

        $("#tbl-customers").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        });

    });

    // FORM EDIT
    function show(id) {
        $.get("{{ url('/customer/show') }}", {id}, function(data) {
            $('#modal-mid').modal('show');
            $('#modal_body_mid').html(data);
        });
    }
</script>