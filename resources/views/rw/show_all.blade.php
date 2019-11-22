@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Rukun Warga</h1>
        </div>
    </div>
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>Rukun Warga</th>
				<th>Nama Ketua RW</th>
				<th></th>
			</tr>
		</thead>

		@foreach($rw as $index => $row)
			<tbody>
				<tr>
					<td>{{ ($rw->currentPage() - 1) * $rw->perPage() + $index + 1 }}</td>
					<td>{{ $row->nama }}</td>
					<td>{{ $row->ketua }}</td>
					<td class="text-center"><a class="btn btn-primary" href="/rw/{{$row->id}}/edit">Edit</a></td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<center>{{ $rw->links() }}</center>
@include('layout.success')
@endsection