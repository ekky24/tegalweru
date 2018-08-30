<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu_ayah = Carbon::createFromFormat('Y-m-d', $skkb->tgl_lahir_ayah);
	$tgl_ayah = $waktu_ayah->day . " " . $bulan_arr[$waktu_ayah->month - 1] . " " . $waktu_ayah->year;
	$waktu_ibu = Carbon::createFromFormat('Y-m-d', $skkb->tgl_lahir_ibu);
	$tgl_ibu = $waktu_ibu->day . " " . $bulan_arr[$waktu_ibu->month - 1] . " " . $waktu_ibu->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Kelakuan Baik</h1>
        </div>
    </div>
    <h3>Data Pemohon:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skkb->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skkb->penduduk_id }}">{{ $skkb->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skkb->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skkb->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skkb->get_penduduk->kewarganegaraan }}</td>
		</tr>
	</table>
	</center>
	<br><h3>Data Ayah:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nama</th>
			<td>{{ $skkb->nama_ayah }}</td>
		</tr>
		<tr>
			<th>Tempat Lahir</th>
			<td>{{ $skkb->tempat_lahir_ayah }}</td>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<td>{{ strtoupper($tgl_ayah) }}</td>
		</tr>
		<tr>
			<th>Agama</th>
			<td>{{ $skkb->agama_ayah }}</td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td>{{ $skkb->pekerjaan_ayah }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $skkb->alamat_ayah }}</td>
		</tr>
	</table>
	</center>
	<br><h3>Data Ibu:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nama</th>
			<td>{{ $skkb->nama_ibu }}</td>
		</tr>
		<tr>
			<th>Tempat Lahir</th>
			<td>{{ $skkb->tempat_lahir_ibu }}</td>
		</tr>
		<tr>
			<th>Tanggal Lahir</th>
			<td>{{ strtoupper($tgl_ibu) }}</td>
		</tr>
		<tr>
			<th>Agama</th>
			<td>{{ $skkb->agama_ibu }}</td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td>{{ $skkb->pekerjaan_ibu }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $skkb->alamat_ibu }}</td>
		</tr>
	</table>
	</center>
	<br><h3>Data Pejabat:</h3>
	<center>
	<table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Keperluan</th>
			<td>{{ $skkb->keperluan }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skkb->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skkb->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skkb/{{ $skkb->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skkb/{{ $skkb->id }}/download">Download</a><br><br>
	</center>
@endsection