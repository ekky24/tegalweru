<?php
	use Carbon\Carbon;
	$waktu = Carbon::createFromFormat('Y-m-d', $kematian->tgl_kematian);

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu_surat = Carbon::createFromFormat('Y-m-d H:i:s', $kematian->created_at);
	$tgl = $waktu_surat->day . " " . $bulan_arr[$waktu_surat->month - 1] . " " . $waktu_surat->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Kematian</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Judul Surat</th>
			<td>{{ $kematian->judul }}</td>
		</tr>
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $kematian->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $kematian->penduduk_id }}">{{ $kematian->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $kematian->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($kematian->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $kematian->get_penduduk->get_kk->alamat }}</td>
		</tr>
		<tr>
			<th>Tanggal Kematian</th>
			<td>{{ $waktu->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<th>Jam Kematian</th>
			<td>{{ $kematian->jam_kematian . " WIB"}}</td>
		</tr>
		<tr>
			<th>Tempat Kematian</th>
			<td>{{ $kematian->tempat_kematian }}</td>
		</tr>
		<tr>
			<th>Penyebab Kematian</th>
			<td>{{ $kematian->penyebab_kematian }}</td>
		</tr>
		<tr>
			<th>NIK Pelapor</th>
			<td>{{ $kematian->nik_pelapor }}</td>
		</tr>
		<tr>
			<th>Nama Pelapor</th>
			<td>{{ $pelapor->nama }}</td>
		</tr>
		<tr>
			<th>Alamat Pelapor</th>
			<td>{{ $pelapor->get_kk->alamat }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $kematian->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $kematian->get_penerbit->jabatan }}</td>
		</tr>
		<tr>
			<th>Tanggal Surat</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/kematian/{{ $kematian->penduduk_id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/kematian/{{ $kematian->penduduk_id }}/download">Download</a><br><br>
	</center>
@include('layout.success')
@endsection