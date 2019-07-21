@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Surat Pindah Masuk</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/pindah_masuk/{{ $pindah->id }}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">Nomor Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nomor Surat" type="text" name="nomor" value="{{ $pindah->nomor }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap Pemohon</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Nama" type="text" name="nama_pemohon" value="{{ $pindah->nama_pemohon }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Kartu Keluarga Lama</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Kartu Keluarga Lama" type="number" name="kk_lama" value="{{ $pindah->kk_lama }}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat Asal</label>
				<div class="col-sm-6">
					<textarea placeholder="Alamat Asal" class="form-control" name="alamat_asal" required>{{ $pindah->alamat_asal }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat Tujuan</label>
				<div class="col-sm-6">
					<textarea placeholder="Alamat Tujuan" class="form-control" name="alamat_tujuan" required>{{ $pindah->alamat_tujuan }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alasan Pindah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Alasan Pindah" type="text" name="alasan_pindah" value="{{ $pindah->alasan_pindah }}" required>
				</div>
			</div>
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
	</div>
</div>


@endsection