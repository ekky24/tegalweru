<?php
	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

@extends('layout.master')

@section('content')
	<?php
		use Carbon\Carbon;
	?>
	
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Surat Keterangan Dukun</h1>
        </div>
    </div>
	@include('pindah.filter');

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIK</th>
				<th>Nama Anak</th>
				<th>Waktu Lahir</th>
				<th>Waktu Pembuatan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($skd as $index => $row)
			<?php
				$waktu_lahir = Carbon::createFromFormat('Y-m-d H:i:s', $row->waktu_lahir);
				$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
			?>
				<tr>
					<td>{{ $index + 1 }}</td>
					<td><a href="/penduduk/{{ $row->penduduk_id }}">{{ $row->penduduk_id }}</a></td>
					
					@if(strlen($row->nama_anak) > 40)
						<td>{{ substr($row->nama_anak, 0, 40) . "..."}}</td>
					@else
						<td>{{ $row->nama_anak }}</td>
					@endif					

					<td>{{ $waktu_lahir->format('d-m-Y H:i') }}</td>
					<td>{{ strtoupper($bulan_arr[$waktu->month - 1] . " " . $waktu->format('Y')) }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/skd/{{$row->id}}">Detail</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/skd/{{$row->id}}/delete">Hapus</a>
					</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center>
		<form action="/skd/download" method="post" autocomplete="off">
			{{ csrf_field() }}
			<input type="hidden" name="surat_download" value="{{ $skd_download }}" required>
			<input type="hidden" name="tahun_choose" value="{{ $tahun_choose }}" required>
			<input type="hidden" name="bulan_choose" value="{{ $bulan_choose }}" required>
			<input type="hidden" name="search_term" value="{{ $search_term }}" required>
			<input type="submit" class="btn btn-primary" value="Download">
		</form>
		{{ $skd->links() }}
	</center>
@endsection