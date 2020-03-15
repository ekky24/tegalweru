<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $sku->created_at);
	$tgl = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Usaha</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Judul Surat</th>
			<td>{{ $sku->judul }}</td>
		</tr>
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $sku->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $sku->penduduk_id }}">{{ $sku->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $sku->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($sku->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $sku->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Jenis Usaha</th>
			<td>{{ $sku->nama_usaha }}</td>
		</tr>
		<tr>
			<th>Tanah Sendiri ( Sawah )</th>
			@if($sku->sendiri_sawah != NULL)
				<td>{{ $sku->sendiri_sawah . " " }} m<sup>2</sup></td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Tanah Sendiri ( Tegal )</th>
			@if($sku->sendiri_tegal != NULL)
				<td>{{ $sku->sendiri_tegal . " " }} m<sup>2</sup></td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Tanah Sewa ( Sawah )</th>
			@if($sku->sewa_sawah != NULL)
				<td>{{ $sku->sewa_sawah . " " }} m<sup>2</sup></td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Tanah Sewa ( Tegal )</th>
			@if($sku->sewa_tegal != NULL)
				<td>{{ $sku->sewa_tegal . " " }} m<sup>2</sup></td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Keperluan</th>
			@if($sku->keperluan != NULL)
				<td>{{ $sku->keperluan }}</td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $sku->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $sku->get_penerbit->jabatan }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/sku/{{ $sku->id }}/edit/{{ $sku->jenis_surat }}">Edit Data</a>
	<a class="btn btn-primary" href="/sku/{{ $sku->id }}/download/{{ $sku->jenis_surat }}">Download</a><br><br>
	</center>
@include('layout.success')
@endsection