<?php
	use Carbon\Carbon;
	$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $skd->waktu_lahir);
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Dukun</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skd->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skd->penduduk_id }}">{{ $skd->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skd->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skd->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skd->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Nama Anak</th>
			<td>{{ $skd->nama_anak }}</td>
		</tr>
		<tr>
			<th>Nama Suami</th>
			<td>{{ $skd->nama_suami }}</td>
		</tr>
		<tr>
			<th>Tanggal Kelahiran Anak</th>
			<td>{{ $waktu->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<th>Jam Kelahiran Anak</th>
			<td>{{ $waktu->format('H:i') . " WIB"}}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skd->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skd/{{ $skd->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skd/{{ $skd->id }}/download">Download</a><br><br>
	</center>
@endsection