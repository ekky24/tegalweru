@extends('layout.master')

@section('content')
<?php
	use Carbon\Carbon;

	$temp_tempat_lahir = $penduduk->tempat_lahir;
	$arr_tgl_lahir = explode('-', $penduduk->tgl_lahir);
	$value_tgl_lahir = $arr_tgl_lahir[2] . '-' . $arr_tgl_lahir[1] . '-' . $arr_tgl_lahir[0];

	$waktu_surat = Carbon::createFromFormat('Y-m-d H:i:s', $pindah->created_at);
	$tgl_dummy = $waktu_surat->day . "-" . $waktu_surat->month . "-" . $waktu_surat->year;
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Surat Pindah Keluar</h1>
	</div>
</div>
<form id="form_pindah_keluar" method="post" action="/pindah_keluar/{{ $pindah->id }}" autocomplete="off" class="form-horizontal">
	{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-3">Judul Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Judul Surat" type="text" name="judul_surat" value="{{ $pindah->judul }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Nomor Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Nomor Surat" type="text" name="nomor_surat" value="{{ $pindah->nomor }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">NIK</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $pindah->penduduk_id }}" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Nama Lengkap</label>
		<div class="col-sm-6">
			<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $pindah->get_penduduk->nama }}" type="text" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
		<div class="col-sm-6">
			<input id="ttl_surat" class="form-control" placeholder="Nama" value="{{ $temp_tempat_lahir . ', ' . $value_tgl_lahir }}" type="text" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Agama</label>
		<div class="col-sm-6">
			<input id="agama_surat" class="form-control" placeholder="Nama" value="{{ $penduduk->get_agama->keterangan }}" type="text" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Jenis Kelamin</label>
		<div class="col-sm-6">
			@if($pindah->get_penduduk->jk == 'L')
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
			@else
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat</label>
		<div class="col-sm-6">
			@if($pindah->get_penduduk->get_kk == null)
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
			@else
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $pindah->get_penduduk->get_kk->alamat }}</textarea>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Pindah Ke</label>
		<div class="col-sm-6">
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" name="alamat_tujuan">{{ $pindah->alamat_tujuan }}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alasan Pindah</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Alasan Pindah" type="text" name="alasan_pindah" value="{{ $pindah->alasan_pindah }}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
		<div class="col-sm-6">
			<select name="penerbit_id" class="form-control" required>
				<option value="" selected disabled hidden>Pilih Pejabat</option>
				@foreach($penerbit as $row)
				@if($row->id == $pindah->penerbit_id)
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
	<div class="form-group">
		<label class="control-label col-sm-3">Pindah Satu Keluarga ?</label>
		<div class="col-sm-1">
			<input type="checkbox" class="form-check-input" id="pindah_satu_keluarga">
	    	<label class="form-check-label" for="pindah_satu_keluarga" style="margin-left: 5px;">Ya</label>
		</div>
		<div class="col-sm-5">
			<input id="nomor_kk" class="form-control" placeholder="Masukkan Nomor KK" type="text" name="nomor_kk" disabled>
		</div>
	</div>
	<br>
	<input type="hidden" name="penduduk_id" value="{{ $pindah->penduduk_id }}">
	<div id="div_pindah" style="display: none;">
		<hr>
       	<h2>Ubah Data Anggota Keluarga</h2>
		<button type="button" id="tambah_row_pindah" class="btn btn-primary">Tambah</button><br><br>
	    </div>
	<div class="form-group text-center">
		<button type="submit" class="btn btn-primary" id="btn_submit_pindah">Submit</button>
		<button type="button" class="btn btn-default" id="tambah_pindah">Ubah Anggota Keluarga</button>
	</div>
</form>
@include('layout.error')
@include('layout.success')

@endsection