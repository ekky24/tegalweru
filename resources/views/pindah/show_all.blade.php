@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Kepindahan Penduduk</h1>
        </div>
    </div>
	@include('pindah.filter')

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIK</th>
				<th>Alamat Asal</th>
				<th>Alamat Tujuan</th>
				<th>Alasan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($pindah as $index => $row)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td><a href="/penduduk/{{ $row->penduduk_id }}"> {{ $row->penduduk_id }} </a></td>
					<td>{{ $row->alamat_asal }}</td>
					<td>{{ $row->alamat_tujuan }}</td>
					<td>{{ $row->alasan }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/pindah/{{$row->penduduk_id}}/edit">Edit</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/pindah/{{$row->penduduk_id}}/delete">Hapus</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<center> 
		<form action="/pindah/download" method="post" autocomplete="off">
			{{ csrf_field() }}
			<input type="hidden" name="pindah_download" value="{{ $pindah_download }}" required>
			<input type="hidden" name="tahun_choose" value="{{ $tahun_choose }}" required>
			<input type="hidden" name="bulan_choose" value="{{ $bulan_choose }}" required>
			<input type="hidden" name="search_term" value="{{ $search_term }}" required>
			<input type="submit" class="btn btn-primary" value="Download">
		</form>
		{{ $pindah->links() }} 
	</center>
@endsection