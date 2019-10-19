@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Penduduk</h1>
        </div>
    </div>
	
	@include('penduduk.filter')

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIK</th>
				<th>Nama Lengkap</th>
				<th>Nomor KK</th>
				<th>Pendidikan</th>
				<th>Jenis Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($penduduk as $index => $row)
				<tr>
					<td>{{ ($penduduk->currentPage() - 1) * $penduduk->perPage() + $index + 1 }}</td>
					<td><a href="/penduduk/{{ $row->id }}"> {{ $row->id }} </a></td>
					<td>{{ $row->nama }}</td>
					@if($row->kk_id != NULL)
						<td><a href="/kk/{{ $row->kk_id }}"> {{ $row->kk_id }} </a></td>
					@else
						<td>-</td>
					@endif
					<td>{{ $row->get_pendidikan->keterangan }}</td>
					<td>{{ $row->get_jenis_pekerjaan->keterangan }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<center> 
		<!--<form action="/penduduk/download" method="post" autocomplete="off">
			{{ csrf_field() }}
			<input type="hidden" name="penduduk_download" value="{{ $penduduk_download }}" required>
			<input type="hidden" name="jk_choose" value="{{ $jk_choose_report }}" required>
			<input type="hidden" name="pendidikan_choose" value="{{ $pendidikan_choose_report }}" required>
			<input type="hidden" name="pekerjaan_choose" value="{{ $pekerjaan_choose_report }}" required>
			<input type="hidden" name="agama_choose" value="{{ $agama_choose_report }}" required>
			<input type="hidden" name="hubungan_choose" value="{{ $hubungan_choose_report }}" required>
			<input type="hidden" name="search_term" value="{{ $search_term }}" required>
			<input type="submit" class="btn btn-primary" value="Download">
		</form>-->
		{{ $penduduk->links() }} 
	</center>
@endsection