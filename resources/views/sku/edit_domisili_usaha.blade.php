@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Domisili Usaha</h1>
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
			<input class="form-control" placeholder="NIK" type="number" name="penduduk_id" value="{{ $sku->penduduk_id }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Nama Lengkap</label>
		<div class="col-sm-6">
			<input name="nama_pimpinan" class="form-control" placeholder="Nama" value="{{ $sku->nama_pimpinan }}" type="text" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat</label>
		<div class="col-sm-6">
			<textarea name="alamat_pimpinan" placeholder="Alamat" class="form-control" required>{{ $sku->alamat_pimpinan }}</textarea>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Nama Usaha</label>

		<div class="col-sm-6">
			<input name="nama_usaha" class="form-control" placeholder="Nama Usaha" type="text" value="{{ $sku->nama_usaha }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tahun Pendirian Usaha</label>

		<div class="col-sm-6">
			<input name="tahun_pendirian_usaha" class="form-control" placeholder="Jenis Usaha" type="number" value="{{ $sku->tahun_pendirian_usaha }}" required>
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Bidang Usaha</label>

		<div class="col-sm-6">
			<input name="bidang_usaha" class="form-control" placeholder="Jenis Usaha" type="text" value="{{ $sku->bidang_usaha }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3">Alamat Usaha</label>
		<div class="col-sm-6">
			<textarea name="alamat_usaha" placeholder="Alamat" class="form-control" required>{{ $sku->alamat_usaha }}</textarea>
		</div>
	</div><br>
	<h4>Surat Pengantar:</h4>
	<div class="form-group">

		<label class="control-label col-sm-3">Dari</label>

		<div class="col-sm-6">
			<input class="form-control" placeholder="Dari" type="text" name="dari_pengantar" value="{{ $sku->dari_pengantar }}">
		</div>
	</div>
	<div class="form-group">

		<label class="control-label col-sm-3">Tanggal</label>
		<div class="col-sm-6">
			<input class="form-control" placeholder="Tanggal Surat Pengantar" type="text" name="tgl_pengantar" value="{{ $sku->tgl_pengantar }}">
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
	<br>
	<input type="hidden" name="jenis_surat" value="domisili_usaha">
	<div class="form-group text-center">
		<button type="submit" class="btn btn-primary">Submit</button>
	</div>
</form>
@include('layout.error')
@include('layout.success')
@endsection