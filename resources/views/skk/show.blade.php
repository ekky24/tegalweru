<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $skk->created_at);
	$tgl = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Kehilangan</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Judul Surat</th>
			<td>{{ $skk->judul }}</td>
		</tr>
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skk->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skk->penduduk_id }}">{{ $skk->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skk->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skk->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skk->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $penduduk->get_kk->alamat }}</td>
		</tr>
		<tr>
			<th>Keterangan</th>
			<td>{{ $skk->keterangan }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skk->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skk->get_penerbit->jabatan }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skk/{{ $skk->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skk/{{ $skk->id }}/download">Download</a><br><br>
	</center>
@include('layout.success')
@endsection