@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Surat Keterangan Usaha</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/sku" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_surat" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<input id="jk_surat" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kewarganegaraan</label>
					</div>
					<div class="col-md-6">
						<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Usaha</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Jenis Usaha" type="text" name="jenis_usaha" required>
					</div>
		        </div><br>
		        <h4>Tanah Sendiri:</h4>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label style="margin-left: 30px;">Tanah Sawah</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Luas Tanah Sawah" type="number" name="sendiri_sawah">
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label style="margin-left: 30px;">Tanah Tegal</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Luas Tanah Tegal" type="number" name="sendiri_tegal">
					</div>
		        </div><br>
		        <h4>Tanah Sewa:</h4>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label style="margin-left: 30px;">Tanah Sawah</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Luas Tanah Sawah" type="number" name="sewa_sawah">
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label style="margin-left: 30px;">Tanah Tegal</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Luas Tanah Tegal" type="number" name="sewa_tegal">
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Keperluan</label>
					</div>
					<div class="col-md-6">
						<textarea id="keperluan_surat" placeholder="Masukkan Keperluan SKTM" class="form-control" name="keperluan" required></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Pilih Pejabat Penerbit</label>
					</div>
					<div class="col-md-6">
						<select name="penerbit_id" class="form-control" required>
							<option value="" selected disabled hidden>Pilih Pejabat</option>
							@foreach($penerbit as $row)
								<option value="{{ $row->id }}">{{ $row->nama }}</option>
							@endforeach
						</select>
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