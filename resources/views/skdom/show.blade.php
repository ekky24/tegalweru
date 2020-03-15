<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu_surat = Carbon::createFromFormat('Y-m-d H:i:s', $skdom->created_at);
	$tgl = $waktu_surat->day . " " . $bulan_arr[$waktu_surat->month - 1] . " " . $waktu_surat->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Domisili</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Judul Surat</th>
			<td>{{ $skdom->judul }}</td>
		</tr>
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skdom->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skdom->penduduk_id }}">{{ $skdom->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skdom->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skdom->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skdom->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $penduduk->get_kk->alamat }}</td>
		</tr>
		<tr>
			<th>Asal Surat Pengantar</th>
			<td>{{ $skdom->dari_pengantar }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat Pengantar</th>
			<td>{{ $skdom->tgl_pengantar }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skdom->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skdom->get_penerbit->jabatan }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skdom/{{ $skdom->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skdom/{{ $skdom->id }}/download">Download</a><br><br>
	</center>
@include('layout.success')
@endsection