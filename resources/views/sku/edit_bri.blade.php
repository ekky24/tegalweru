@extends('layout.master')

@section('content')
<?php
	$temp_tempat_lahir = $penduduk->tempat_lahir;
	$value_tempat_lahir = substr($temp_tempat_lahir, strpos($temp_tempat_lahir, " ") + 1);
	$arr_tgl_lahir = explode('-', $penduduk->tgl_lahir);
	$value_tgl_lahir = $arr_tgl_lahir[2] . '-' . $arr_tgl_lahir[1] . '-' . $arr_tgl_lahir[0]
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data SKU untuk BRI</h1>
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
			<input name="nama_usaha" class="form-control" placeholder="Jenis Usaha" type="text" value="{{ $sku->nama_usaha }}" required>
		</div>
	</div><br>
	<h4>Tanah Sendiri:</h4>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanah Sawah</label>

		<div class="col-sm-6">
			<input class="form-control" placeholder="Luas Tanah Sawah" type="number" name="sendiri_sawah" value="{{ $sku->sendiri_sawah }}">
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanah Tegal</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Luas Tanah Tegal" type="number" name="sendiri_tegal" value="{{ $sku->sendiri_tegal }}">
		</div>
	</div><br>
	<h4>Tanah Sewa:</h4>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanah Sawah</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Luas Tanah Sawah" type="number" name="sewa_sawah" value="{{ $sku->sewa_sawah }}">
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanah Tegal</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Luas Tanah Tegal" type="number" name="sewa_tegal" value="{{ $sku->sewa_tegal }}">
		</div>
	</div>
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
	<br>
	<input type="hidden" name="jenis_surat" value="bri">
	<div class="form-group text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
@include('layout.error')
@include('layout.success')
@endsection