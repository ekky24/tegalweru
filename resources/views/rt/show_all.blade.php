@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Rukun Tetangga</h1>
        </div>
    </div>
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>Rukun Tetangga</th>
				<th>Nama Ketua RT</th>
				<th>Rukun Warga</th>
				<th></th>
			</tr>
		</thead>

		@foreach($rt as $index => $row)
			<tbody>
				<tr>
					<td>{{ ($rt->currentPage() - 1) * $rt->perPage() + $index + 1 }}</td>
					<td>{{ $row->nama }}</td>
					<td>{{ $row->ketua }}</td>
					<td>{{ $row->get_rw->nama }}</td>
					<td class="text-center"><a class="btn btn-primary" href="/rt/{{$row->id}}/edit">Edit</a></td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<center>{{ $rt->links() }}</center>
@include('layout.success')
@endsection