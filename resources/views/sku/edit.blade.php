@extends('layout.master')

@section('content')
<?php
	use Carbon\Carbon;
	
	$temp_tempat_lahir = $penduduk->tempat_lahir;
	$value_tempat_lahir = substr($temp_tempat_lahir, strpos($temp_tempat_lahir, " ") + 1);
	$arr_tgl_lahir = explode('-', $penduduk->tgl_lahir);
	$value_tgl_lahir = $arr_tgl_lahir[2] . '-' . $arr_tgl_lahir[1] . '-' . $arr_tgl_lahir[0];

	$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $sku->created_at);
	$tgl_dummy = $waktu->day . "-" . $waktu->month . "-" . $waktu->year;
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data SKU</h1>
	</div>
</div>
<form method="post" action="/sku/{{ $sku->id }}" autocomplete="off" class="form-horizontal">
	{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-3">Judul Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Judul Surat" type="text" name="judul_surat" value="{{ $sku->judul }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Nomor Surat</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Masukkan Nomor Surat" type="text" name="nomor_surat" value="{{ $sku->nomor }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">NIK</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $sku->penduduk_id }}" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Nama Lengkap</label>
		<div class="col-sm-6">
			<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $sku->get_penduduk->nama }}" type="text" readonly>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
		<div class="col-sm-6">
			<input id="ttl_surat" class="form-control" placeholder="Nama" value="{{ $value_tempat_lahir . ', ' . $value_tgl_lahir }}" type="text" readonly>
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
			@if($sku->get_penduduk->jk == 'L')
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
			@else
			<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat</label>
		<div class="col-sm-6">
			@if($sku->get_penduduk->get_kk == null)
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
			@else
			<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $sku->get_penduduk->get_kk->alamat }}</textarea>
			@endif
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Nama Usaha</label>

		<div class="col-sm-6">
			<input name="nama_usaha" class="form-control" placeholder="Nama Usaha" type="text" value="{{ $sku->nama_usaha }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Alamat Usaha</label>

		<div class="col-sm-6">
			<textarea name="alamat_usaha" placeholder="Alamat Usaha" class="form-control" required>{{ $sku->alamat_usaha }}</textarea>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Keperluan</label>
		<div class="col-sm-6">
			<textarea id="keperluan_surat" placeholder="Masukkan Keperluan sku" class="form-control" name="keperluan" required>{{ $sku->keperluan }}</textarea>
		</div>
	</div><br>
	<h4>Surat Pengantar:</h4>
	<div class="form-group">

		<label class="control-label col-sm-3">Dari</label>

		<div class="col-sm-6">
			<input class="form-control" placeholder="Asal Pengantar" type="text" name="dari_pengantar" value="{{ $sku->dari_pengantar }}">
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanggal Surat Pengantar</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Tanggal Pengantar" type="text" name="tgl_pengantar" value="{{ $sku->tgl_pengantar }}">
		</div>
	</div><br>
	<div class="form-group">

		<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
		<div class="col-sm-6">
			<select name="penerbit_id" class="form-control" required>
				<option value="" selected disabled hidden>Pilih Pejabat</option>
				@foreach($penerbit as $row)
				@if($row->id == $sku->penerbit_id)
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
	<input type="hidden" name="jenis_surat" value="biasa">
	<div class="form-group text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
@include('layout.error')
@include('layout.success')
@endsection