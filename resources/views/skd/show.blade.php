<?php
	use Carbon\Carbon;
	$waktu = Carbon::createFromFormat('Y-m-d', $skd->tgl_kelahiran);
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Kelahiran</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skd->nomor }}</td>
		</tr>
		<tr>
			<th>NIK Ibu</th>
			<td><a href="/penduduk/{{ $skd->nik_ibu }}">{{ $skd->nik_ibu }}</a></td>
		</tr>
		<tr>
			<th>Nama Ibu</th>
			@if($penduduk_ibu != NULL)
				<td>{{ $penduduk_ibu->nama }}</td>
			@else
				<td>-</td>
			@endif
		</tr>
		<tr>
			<th>NIK Ayah</th>
			<td><a href="/penduduk/{{ $skd->nik_ayah }}">{{ $skd->nik_ayah }}</a></td>
		</tr>
		<tr>
			<th>Nama Ayah</th>
			@if($penduduk_ayah != NULL)
				<td>{{ $penduduk_ayah->nama }}</td>
			@else
				<td>-</td>
			@endif
		</tr>
		<tr>
			<th>NIK Pelapor</th>
			<td><a href="/penduduk/{{ $skd->nik_pelapor }}">{{ $skd->nik_pelapor }}</a></td>
		</tr>
		<tr>
			<th>Nama Pelapor</th>
			@if($penduduk_pelapor != NULL)
				<td>{{ $penduduk_pelapor->nama }}</td>
			@else
				<td>-</td>
			@endif
		</tr>
		<tr>
			<th>Hubungan Pelapor</th>
			<td>{{ $skd->hubungan_pelapor }}</a></td>
		</tr>
		<tr>
			<th>Nama Anak</th>
			<td>{{ $skd->nama_anak }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skd->jk_anak == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Tanggal Kelahiran Anak</th>
			<td>{{ $waktu->format('d-m-Y') }}</td>
		</tr>
		<tr>
			<th>Jam Kelahiran Anak</th>
			<td>{{ $skd->jam_kelahiran . " WIB"}}</td>
		</tr>
		<tr>
			<th>Status Kependudukan Anak</th>
			@if($skd->get_kelahiran == NULL)
				<td>{{ 'SUDAH TERDAFTAR' }}</td>
			@else
				<td>{{ 'BELUM TERDAFTAR' }}</td>
			@endif
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skd->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skd->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skd/{{ $skd->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skd/{{ $skd->id }}/download">Download</a>
	@if($skd->get_kelahiran != NULL)
		<a class="btn btn-primary" href="/skd/{{ $skd->id }}/daftar_penduduk">Daftar Penduduk</a>
	@endif
	<br><br>
	</center>
@include('layout.success')
@endsection