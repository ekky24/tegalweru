<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d', $penduduk->tgl_lahir);
	$tgl = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;

	if ($penduduk->status == 0) {
		$status = "Penduduk Aktif";
	}
	elseif ($penduduk->status == 1) {
		$status = "Meninggal Dunia";
	}
	elseif ($penduduk->status == 2) {
		$status = "Pindah Domisili";
	}
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Penduduk</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>NIK</th>
			<td>{{ $penduduk->id }}</td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Nomor KK</th>
			@if($penduduk->kk_id == "")
				<td>{{ "-" }}</td>
			@else
				<td><a href="/kk/{{ $penduduk->kk_id }}"> {{ $penduduk->kk_id }} </a></td>
			@endif
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Tempat Lahir</th>
			<td>{{ $penduduk->tempat_lahir }}</td>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
		<tr>
			<th>Agama</th>
			@if($penduduk->get_agama == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_agama->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Pendidikan</th>
			@if($penduduk->get_pendidikan == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_pendidikan->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Jenis Pekerjaan</th>
			@if($penduduk->get_jenis_pekerjaan == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_jenis_pekerjaan->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Status Pernikahan</th>
			@if($penduduk->get_status_nikah == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_status_nikah->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Status Hubungan Keluarga</th>
			@if($penduduk->get_status_hubungan == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_status_hubungan->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Nomor Paspor</th>
			@if($penduduk->no_paspor == "")
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->no_paspor }}</td>
			@endif
		</tr>
		<tr>
			<th>Penyandang Cacat</th>
			@if($penduduk->get_penyandang_cacat == NULL)
				<td>{{ "-" }}</td>
			@else
				<td>{{ $penduduk->get_penyandang_cacat->keterangan }}</td>
			@endif
		</tr>
		<tr>
			<th>Ayah</th>
			<td>{{ $penduduk->nama_ayah }}</td>
		</tr>
		<tr>
			<th>Ibu</th>
			<td>{{ $penduduk->nama_ibu }}</td>
		</tr>
		<tr>
			<th>Status</th>
			<td>{{ strtoupper($status) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/penduduk/{{ $penduduk->id }}/edit">Edit Data</a><br><br>
	</center>
@include('layout.success')
@endsection