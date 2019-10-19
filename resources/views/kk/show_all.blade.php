@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Kartu Keluarga</h1>
        </div>
    </div>
	
	@include('kk.filter');

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>Nomor KK</th>
				<th>NIK Kepala Keluarga</th>
				<th>Nama Kepala Keluarga</th>
				<th>RT</th>
				<th>RW</th>
				<th>Jumlah Anggota</th>
			</tr>
		</thead>
		<tbody id="list_kk">
		@foreach($kk as $index => $row)
				<tr>
					<td>{{ ($kk->currentPage() - 1) * $kk->perPage() + $index + 1 }}</td>
					<td><a href="/kk/{{ $row->id }}"> {{ $row->id }} </a></td>

					@if($row->kepala_keluarga != NULL)
						<td><a href="/penduduk/{{ $row->kepala_keluarga }}"> {{ $row->kepala_keluarga }} </a></td>
						<td>{{ $row->get_kepala_keluarga->nama }}</td>
					@else
						<td>-</td>
						<td>-</td>
					@endif

					@if($row->get_rt != NULL)
						<td>{{ $row->get_rt->nama }}</td>
					@else
						<td>-</td>
					@endif

					@if($row->get_rw != NULL)
						<td>{{ $row->get_rw->nama }}</td>
					@else
						<td>-</td>
					@endif
					<td>{{ $row->get_penduduk->count() . ' orang' }}</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center> 
		{{ $kk->links() }} 
		@include('layout.error')
	</center>
@endsection