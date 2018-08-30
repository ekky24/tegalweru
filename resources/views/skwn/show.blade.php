<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d', $skwn->tgl_lahir_nikah);
	$tgl = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Wali Nikah</h1>
        </div>
    </div>
	<h3>Data yang Menikahkan:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skwn->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skwn->penduduk_id }}">{{ $skwn->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skwn->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skwn->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skwn->get_penduduk->kewarganegaraan }}</td>
		</tr>
	</table>
	</center>
	<br><h3>Data yang Dinikahkan:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nama</th>
			<td>{{ $skwn->nama_nikah }}</td>
		</tr>
		<tr>
			<th>Tempat Lahir</th>
			<td>{{ $skwn->tempat_lahir_nikah }}</td>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
		<tr>
			<th>Agama</th>
			<td>{{ $skwn->agama_nikah }}</td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td>{{ $skwn->pekerjaan_nikah }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $skwn->alamat_nikah }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skwn->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skwn->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skwn/{{ $skwn->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skwn/{{ $skwn->id }}/download">Download</a><br><br>
	</center>
@endsection