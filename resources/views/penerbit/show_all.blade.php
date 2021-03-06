@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Pejabat Desa</h1>
        </div>
    </div>
	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIP</th>
				<th>Nama Pejabat</th>
				<th>Jabatan</th>
				<th></th>
			</tr>
		</thead>

		@foreach($penerbit as $index => $row)
			<tbody>
				<tr>
					<td>{{ $index + 1 }}</td>
					<td>{{ $row->id }}</td>
					<td>{{ $row->nama }}</td>
					<td>{{ $row->jabatan }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/penerbit/{{$row->id}}/edit">Edit</a>
					<a class="btn btn-danger" id="delete_penerbit" style="width: 70px" href="/penerbit/{{$row->id}}/delete">Hapus</a></td>
				</tr>
			</tbody>
		@endforeach
	</table>
@endsection