@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Data Kartu Keluarga</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/kk" id="form_kk" autocomplete="off" class="form-horizontal">
				{{ csrf_field() }}
				<div class="form-group">
						<label class="control-label col-sm-3">Nomor KK</label>
					<div class="col-sm-6">
						<input id="no_kk_form" class="form-control" placeholder="Masukkan Nomor KK" type="number" name="no_kk" required>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Alamat</label>
					<div class="col-sm-6">
						<textarea placeholder="Masukkan alamat" name="alamat" class="form-control" required></textarea>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Rukun Warga</label>
					<div class="col-sm-6">
						<select name="rw" class="form-control" id="rw_form" required>
							<option value="" selected disabled hidden>Pilih RW</option>
							@foreach($rw as $row)
								<option value="{{ $row->id }}">RW {{ $row->nama }}</option>
							@endforeach
						</select>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Rukun Tetangga</label>
					<div class="col-sm-6">
						<select name="rt" class="form-control" id="rt_form" required>
							<option value="" selected disabled hidden>Pilih RT</option>
						</select>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Desa</label>
					<div class="col-sm-6">
						<input class="form-control" placeholder="Nama Desa" type="text" value="KARANGWIDORO" name="kelurahan" required readonly>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Kecamatan</label>
					<div class="col-sm-6">
						<input id="kecamatan_form" class="form-control" placeholder="Nama Kecamatan" type="text" value="DAU" name="kecamatan" required readonly>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Kabupaten</label>
					<div class="col-sm-6">
						<input id="kota" value="KABUPATEN MALANG" class="form-control" placeholder="Nama Kota" type="text" name="kota" required readonly>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Provinsi</label>
					<div class="col-sm-6">
						<input id="provinsi" class="form-control" placeholder="Nama Provinsi" type="text" name="provinsi" value="JAWA TIMUR" required readonly>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Kode Pos</label>
					<div class="col-sm-6">
						<input id="kode_pos_form" class="form-control" placeholder="Masukkan Kode Pos" type="text" value="65151" name="kode_pos" required readonly>
					</div>
		        </div>
		        <div class="form-group">
		   
						<label class="control-label col-sm-3">Tanggal Pengurusan</label>
					<div class="col-sm-6">
						<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_pengurusan" required>
						<div class="form-group" id="div_dummy" style="display: none;">
							<div class="col-md-10">
								<input type="text" class="form-control" id="date_dummy" readonly>
							</div>
							<div class="col-md-2">
								<button id="button_dummy" class="form-control col-md-2 btn btn-primary">Edit</button>
							</div>
						</div>
					</div>
		        </div>

		        <div id="div_keluarga">
		        	<hr>
		        	<h2>Input Data Anggota Keluarga</h2>
		        	<button type="button" id="tambah_row" class="btn btn-primary">Tambah</button><br>
		        </div>


		        <div class="form-group form_button text-center">
		        	<button type="button" class="btn btn-default" id="tambah_keluarga">Tambah Anggota Keluarga</button>
		            <button id="btn_submit" type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
		</div>
	</div>
	
	
	@include('layout.error')
	@include('layout.success')
@endsection