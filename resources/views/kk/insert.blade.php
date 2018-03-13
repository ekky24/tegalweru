@extends('layout.master')

@section('content')

	<h1>Input Data Kartu Keluarga</h1>
	<hr>
	<form method="post" action="/kk" id="form_kk">
		{{ csrf_field() }}
		<div class="form-group row">
			<div class="col-md-3">
				<label>Nomor KK</label>
			</div>
			<div class="col-md-6">
				<input id="no_kk_form" class="form-control" placeholder="Masukkan Nomor KK" type="number" name="no_kk" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>NIK Kepala Keluarga</label>
			</div>
			<div class="col-md-6">
				<input id="nik_umum_form" class="form-control" placeholder="Masukkan NIK Kepala Keluarga" type="number" name="kepala_keluarga" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Alamat</label>
			</div>
			<div class="col-md-6">
				<textarea placeholder="Masukkan alamat" name="alamat" class="form-control" required></textarea>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Rukun Tetangga</label>
			</div>
			<div class="col-md-6">
				<input type="number" class="form-control" placeholder="Masukkan RT" name="rt" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Rukun Warga</label>
			</div>
			<div class="col-md-6">
				<input type="number" class="form-control" placeholder="Masukkan RW" name="rw" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Kelurahan</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Nama Kelurahan" type="text" name="kelurahan" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Kecamatan</label>
			</div>
			<div class="col-md-6">
				<input id="kecamatan_form" class="form-control" placeholder="Nama Kecamatan" type="text" name="kecamatan" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Kota</label>
			</div>
			<div class="col-md-6">
				<input id="kota" class="form-control" placeholder="Nama Kota" type="text" name="kota" required readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Provinsi</label>
			</div>
			<div class="col-md-6">
				<input id="provinsi" class="form-control" placeholder="Nama Provinsi" type="text" name="provinsi" required readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Kode Pos</label>
			</div>
			<div class="col-md-6">
				<input id="kode_pos_form" class="form-control" placeholder="Masukkan Kode Pos" type="number" name="kode_pos" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tanggal Terbit</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" type="date" name="tgl_terbit" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Penerbit</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Pejabat Penerbit" type="text" name="penerbit" required>
			</div>
        </div>

        <div id="div_keluarga">
        	<hr>
        	<h2>Input Data Anggota Keluarga</h2>
        	<button type="button" id="tambah_row" class="btn btn-primary">Tambah Row</button><br>
        </div>


        <div class="form-group form_button">
        	<button type="button" class="btn btn-default" id="tambah_keluarga">Tambah Anggota Keluarga</button>
            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>
	
@endsection