@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Data Kartu Keluarga</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/kk" id="form_kk" autocomplete="off">
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
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						<textarea placeholder="Masukkan alamat" name="alamat" class="form-control" required></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Rukun Warga</label>
					</div>
					<div class="col-md-6">
						<select name="rw" class="form-control" id="rw_form" required>
							<option value="" selected disabled hidden>Pilih RW</option>
							@foreach($rw as $row)
								<option value="{{ $row->id }}">{{ $row->nama }}</option>
							@endforeach
						</select>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Rukun Tetangga</label>
					</div>
					<div class="col-md-6">
						<select name="rt" class="form-control" id="rt_form" required>
							<option value="" selected disabled hidden>Pilih RT</option>
						</select>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kelurahan</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Nama Kelurahan" type="text" value="TEGALWERU" name="kelurahan" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kecamatan</label>
					</div>
					<div class="col-md-6">
						<input id="kecamatan_form" class="form-control" placeholder="Nama Kecamatan" type="text" value="DAU" name="kecamatan" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kota</label>
					</div>
					<div class="col-md-6">
						<input id="kota" value="KABUPATEN MALANG" class="form-control" placeholder="Nama Kota" type="text" name="kota" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Provinsi</label>
					</div>
					<div class="col-md-6">
						<input id="provinsi" class="form-control" placeholder="Nama Provinsi" type="text" name="provinsi" value="JAWA TIMUR" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kode Pos</label>
					</div>
					<div class="col-md-6">
						<input id="kode_pos_form" class="form-control" placeholder="Masukkan Kode Pos" type="text" value="65151" name="kode_pos" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Terbit</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_terbit" required>
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
		</div>
	</div>
	
	
	@include('layout.error')
@endsection