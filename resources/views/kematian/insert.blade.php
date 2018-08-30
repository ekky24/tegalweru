@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Kematian Penduduk</h1>
        </div>
    </div>
	<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/kematian" autocomplete="off">
		{{ csrf_field() }}
        <div class="form-group row">
        	<div class="col-md-3">
				<label>NIK</label>
			</div>
			<div class="col-md-6">
				<input id="nik_kematian" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Lengkap</label>
			</div>
			<div class="col-md-6">
				<input id="nama_kematian" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Jenis Kelamin</label>
			</div>
			<div class="col-md-6">
				<input id="jk_kematian" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nomor KK</label>
			</div>
			<div class="col-md-6">
				<input id="no_kk_kematian" class="form-control" placeholder="Masukkan Nomor KK" type="number" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tempat Kematian</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Lokasi Kematian" type="text" name="tempat" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tanggal Kematian</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_kematian" required>
				<div class="form-group row" id="div_dummy" style="display: none;">
					<div class="col-md-10">
						<input type="text" class="form-control" id="date_dummy" readonly>
					</div>
					<div class="col-md-2">
						<button id="button_dummy" class="form-control col-md-2 btn btn-primary">Edit</button>
					</div>
				</div>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Jam Kematian</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Jam Kematian" type="time" name="jam_kematian" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tempat Pemakaman</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Tempat Pemakaman" type="text" name="tempat_pemakaman" required>
			</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>
	@include('layout.error')
	</div>
	</div>
@endsection