@extends('layout.master')

@section('content')
	<?php
		use Carbon\Carbon;
	?>
	
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Kematian Penduduk</h1>
        </div>
    </div>
	@include('kematian.filter');

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIK</th>
				<th>Tempat Kematian</th>
				<th>Waktu Kematian</th>
				<th>Tempat Pemakaman</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($kematian as $index => $row)
			<?php
				$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $row->waktu_kematian);
			?>
				<tr>
					<td>{{ $index + 1 }}</td>
					<td><a href="/penduduk/{{ $row->penduduk_id }}">{{ $row->penduduk_id }}</a></td>
					<td>{{ $row->tempat_kematian }}</td>
					<td>{{ $waktu->format('d-m-Y H:i') }}</td>
					<td>{{ $row->tempat_pemakaman }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/kematian/{{$row->penduduk_id}}/edit">Edit</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/kematian/{{$row->penduduk_id}}/delete">Hapus</a>
					</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center>
		<form action="/kematian/download" method="post" autocomplete="off">
			{{ csrf_field() }}
			<input type="hidden" name="kematian_download" value="{{ $kematian_download }}" required>
			<input type="hidden" name="tahun_choose" value="{{ $tahun_choose }}" required>
			<input type="hidden" name="bulan_choose" value="{{ $bulan_choose }}" required>
			<input type="hidden" name="search_term" value="{{ $search_term }}" required>
			<input type="submit" class="btn btn-primary" value="Download">
		</form>
		{{ $kematian->links() }}
	</center>
@endsection