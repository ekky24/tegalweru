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
            <h1 class="filter page-header">Data Jumlah Penduduk</h1>
        </div>
    </div>

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>Lahir</th>
				<th>Meninggal</th>
				<th>Pindah Masuk</th>
				<th>Pindah Keluar</th>
				<th>Penduduk Akhir</th>
				<th>Laporan Bulan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($laporan as $index => $row)
			<?php
				$waktu = Carbon::createFromFormat('Y-m-d', $row->laporan_bulan);
			?>
				<tr>
					<td>{{ $index + 1 }}</td>
					<td>{{ $row->lahir_l + $row->lahir_p }} org</td>
					<td>{{ $row->mati_l + $row->mati_p }} org</td>
					<td>{{ $row->pindah_masuk_l + $row->pindah_masuk_p }} org</td>
					<td>{{ $row->pindah_keluar_l + $row->pindah_keluar_p }} org</td>
					<td>{{ $row->penduduk_akhir_l + $row->penduduk_akhir_p }} org</td>
					<td>{{ strtoupper($bulan_arr[$waktu->month - 1] . " " . $waktu->format('Y')) }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 100px" href="/laporan_penduduk/{{$row->id}}/download">Download</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/laporan_penduduk/{{$row->id}}/delete">Hapus</a>
					</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center>
		<form action="/laporan_penduduk/insert" method="get">
			<button type="submit" class="btn btn-primary">Buat Laporan Baru</button>
		</form>
		{{ $laporan->links() }}
	</center>
@include('layout.success')
@endsection