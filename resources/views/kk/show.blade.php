<?php
	use Carbon\Carbon;
	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d', $kk->tgl_pengurusan);
	$tgl = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Kartu Keluarga</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor KK</th>
			<td>{{ $kk->id }}</td>
		</tr>

		@if($kk->kepala_keluarga != NULL)
			<tr>
				<th>NIK Kepala Keluarga</th>
				<td><a href="/penduduk/{{ $kk->kepala_keluarga }}"> {{ $kk->kepala_keluarga }} </a></td>
			</tr>
			<tr>
				<th>Nama Kepala Keluarga</th>
				<td>{{ $kk->get_kepala_keluarga->nama }}</td>
			</tr>
		@else
			<tr>
				<th>NIK Kepala Keluarga</th>
				<td>-</td>
			</tr>
			<tr>
				<th>Nama Kepala Keluarga</th>
				<td>-</td>
			</tr>
		@endif
		
		<tr>
			<th>Alamat</th>
			<td>{{ $kk->alamat }}</td>
		</tr>
		<tr>
			<th>RT/RW</th>
			<td>{{ $kk->get_rt->nama . "/" . $kk->get_rw->nama }}</td>
		</tr>
		<tr>
			<th>Desa/Kelurahan</th>
			<td>KARANGWIDORO</td>
		</tr>
		<tr>
			<th>Kecamatan</th>
			<td>DAU</td>
		</tr>
		<tr>
			<th>Kabupaten/Kota</th>
			<td>MALANG</td>
		</tr>
		<tr>
			<th>Kode Pos</th>
			<td>65151</td>
		</tr>
		<tr>
			<th>Provinsi</th>
			<td>JAWA TIMUR</td>
		</tr>
		<tr>
			<th>Tanggal Pengurusan</th>
			<td>{{ strtoupper($tgl) }}</td>
		</tr>
	</table>
	<br><br><h2>Daftar Anggota Keluarga</h2>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIK</th>
				<th>Nama Lengkap</th>
				<th>Status Hubungan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($anggota as $index => $row)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td><a href="/penduduk/{{$row->id}}"> {{ $row->id }} </a></td>	
					<td>{{ $row->nama }}</td>	
					<td>{{ $row->get_status_hubungan->keterangan }}</td>		
				</tr>
			@endforeach
		</tbody>
	</table>
	
	<a class="btn btn-primary" href="/kk/{{ $kk->id }}/edit">Edit Data</a><br><br>
	</center>
@endsection