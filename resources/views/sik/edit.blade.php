<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d', $sik->tgl_acara);
	$tgl = $waktu->toDateString();
	$tgl_dummy = $waktu->day . " " . $waktu->month . " " . $waktu->year;

	$waktu_surat = Carbon::createFromFormat('Y-m-d H:i:s', $sik->created_at);
	$tgl_dummy = $waktu_surat->day . "-" . $waktu_surat->month . "-" . $waktu_surat->year;
?>

@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Ijin Keramaian</h1>
	</div>
</div>
<form method="post" action="/sik/{{ $sik->id }}" autocomplete="off" class="form-horizontal">
	{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-3">Judul Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Judul Surat" type="text" name="judul_surat" value="{{ $sik->judul }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Nomor Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Nomor Surat" type="text" name="nomor_surat" value="{{ $sik->nomor }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">NIK</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $sik->penduduk_id }}" readonly>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Nama Lengkap</label>
		<div class="col-sm-6">
			<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $sik->get_penduduk->nama }}" type="text" readonly>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Jenis Kelamin</label>
		<div class="col-sm-6">
			@if($sik->get_penduduk->jk == 'L')
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
			@else
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Kewarganegaraan</label>
		<div class="col-sm-6">
			<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $sik->get_penduduk->kewarganegaraan }}" readonly>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat</label>
		<div class="col-sm-6">
			@if($sik->get_penduduk->get_kk == null)
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
			@else
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $sik->get_penduduk->get_kk->alamat }}</textarea>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Nama Acara</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Nama Acara" type="text" name="nama_acara" value="{{ $sik->nama_acara }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Tanggal Acara</label>
		<div class="col-sm-6">
			<input class="form-control datepicker" placeholder="Masukkan Tanggal Acara" name="tgl_acara" value="{{ $tgl_dummy }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Jam Acara</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Jam Acara" type="text" name="jam_acara" value="{{ $sik->jam_acara }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Tempat Acara</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Tempat Acara" type="text" name="tempat_acara" value="{{ $sik->tempat_acara }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Hiburan</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Hiburan Acara" type="text" name="hiburan" value="{{ $sik->hiburan }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Jumlah Undangan</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Jumlah Undangan" type="number" name="jumlah_undangan" value="{{ $sik->jumlah_undangan }}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Pilih Jenis Surat</label>
		<div class="col-sm-6">
			<select name="jenis_surat" class="form-control" required>
				@if($sik->jenis_surat == 'sound_system')
					<option value="sound_system" selected>Ijin Sound System</option>
					<option value="tanpa_camat">Ijin Keramaian Tanpa Camat</option>
					<option value="dengan_camat">Ijin Keramaian Dengan Camat</option>
				@elseif($sik->jenis_surat == 'tanpa_camat')
					<option value="sound_system">Ijin Sound System</option>
					<option value="tanpa_camat" selected>Ijin Keramaian Tanpa Camat</option>
					<option value="dengan_camat">Ijin Keramaian Dengan Camat</option>
				@elseif($sik->jenis_surat == 'dengan_camat')
					<option value="sound_system">Ijin Sound System</option>
					<option value="tanpa_camat">Ijin Keramaian Tanpa Camat</option>
					<option value="dengan_camat" selected>Ijin Keramaian Dengan Camat</option>
				@endif
				
			</select>
		</div>
	</div>
	<h4>Surat Pengantar:</h4>
	<div class="form-group">
		<label class="control-label col-sm-3">Dari</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Pemberi Surat Pengantar" type="text" name="dari_pengantar" value="{{ $sik->dari_pengantar }}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Tanggal</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Tanggal Surat Pengantar" type="text" name="tgl_pengantar" value="{{ $sik->tgl_pengantar }}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
		<div class="col-sm-6">
			<select name="penerbit_id" class="form-control" required>
				<option value="" selected disabled hidden>Pilih Pejabat</option>
				@foreach($penerbit as $row)
				@if($row->id == $sik->penerbit_id)
				<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
				@else
				<option value="{{ $row->id }}">{{ $row->nama }}</option>
				@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Tanggal Surat</label>
		<div class="col-sm-6">
			<input class="form-control datepicker" placeholder="Masukkan Tanggal Surat" name="created_at" value="{{ $tgl_dummy }}" required>
		</div>
	</div>
	<br>
	<div class="form-group text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
@include('layout.error')
@include('layout.success')
@endsection