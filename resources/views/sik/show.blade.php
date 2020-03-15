<?php
	use Carbon\Carbon;
	$waktu = Carbon::createFromFormat('Y-m-d', $sik->tgl_acara);

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu_surat = Carbon::createFromFormat('Y-m-d H:i:s', $sik->created_at);
	$tgl = $waktu_surat->day . " " . $bulan_arr[$waktu_surat->month - 1] . " " . $waktu_surat->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Ijin Keramaian</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Judul Surat</th>
			<td>{{ $sik->judul }}</td>
		</tr>
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $sik->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $sik->penduduk_id }}">{{ $sik->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $sik->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($sik->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $sik->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Nama Acara</th>
			<td>{{ $sik->nama_acara }}</td>
		</tr>
		<tr>
			<th>Tanggal Acara</th>
			<td>{{ $waktu->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<th>Jam Acara</th>
			<td>{{ $sik->jam_acara . " WIB"}}</td>
		</tr>
		<tr>
			<th>Tempat Acara</th>
			<td>{{ $sik->tempat_acara }}</td>
		</tr>
		<tr>
			<th>Hiburan</th>
			<td>{{ $sik->hiburan }}</td>
		</tr>
		<tr>
			<th>Jumlah Undangan</th>
			@if($sik->jumlah_undangan != NULL)
				<td>{{ $sik->jumlah_undangan . " orang" }}</td>
			@else
				<td>{{ "-" }}</td>
			@endif
		</tr>
		<tr>
			<th>Jenis Surat</th>
			@if($sik->jenis_surat == 'sound_system')
				<td>{{ 'IJIN SOUND SYSTEM' }}</td>
			@elseif($sik->jenis_surat == 'tanpa_camat')
				<td>{{ 'IJIN KERAMAIAN TANPA CAMAT' }}</td>
			@elseif($sik->jenis_surat == 'dengan_camat')
				<td>{{ 'IJIN KERAMAIAN DENGAN CAMAT' }}</td>
			@endif
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $sik->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $sik->get_penerbit->jabatan }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/sik/{{ $sik->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/sik/{{ $sik->id }}/download">Download</a><br><br>
	</center>
@include('layout.success')
@endsection