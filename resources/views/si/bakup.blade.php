
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data Shipping</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2>DataTables Shipping</h2>
				</div>
				<div class="pull-right mb-2">
					<a class="btn btn-success" href="{{ route('si.create') }}"> Create Shipping</a>
				</div>
			</div>
		</div>
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
			<p>{{ $message }}</p>
			</div>
		@endif
		<div class="card-body">
			<table class="table table-bordered" id="datatable-crud">
				<thead>
					<tr>
					<th>Id</th>
					<th>Kode</th>
					<th>Service</th>
					<th>CNEE</th>
					<th>Vessel</th>
					<th width="20%">Action</th>
					</tr>
				</thead>
			</table>
		</div>

	</div>
</body>
<script type="text/javascript">
$(document).ready( function () {
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#datatable-crud').DataTable({
		processing: true,
		serverSide: true,
		ajax: "{{ url('si') }}",
		columns: [
			{ data: 'id', name: 'id' },
			{ data: 'kd_si', name: 'kd_si' },
			{ data: 'service', name: 'service' },		
			{ data: 'kd_cus', name: 'kd_cus' },
			{ data: 'vessel', name: 'vessel' },
			{ data: 'action', name: 'action', orderable: false},		
			],
		order: [[0, 'desc']]
	});
});
</script>
</html>