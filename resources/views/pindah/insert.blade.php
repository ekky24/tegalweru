@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Data Pindah Domisili</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/pindah" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_pindah" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_pindah" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					<input id="jk_pindah" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Alamat Asal</label>
				<div class="col-sm-6">
					<textarea id="alamat_asal_pindah" placeholder="Masukkan Alamat Asal" class="form-control" name="alamat_asal" required></textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Alamat Tujuan</label>
				<div class="col-sm-6">
					<textarea placeholder="Masukkan Alamat Tujuan" name="alamat_tujuan" class="form-control" required></textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Alasan Pindah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Alasan Pindah" type="text" name="alasan" required>
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