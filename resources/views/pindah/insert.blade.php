@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Data Pindah Domisili</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/pindah" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input id="nik_pindah" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_pindah" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<input id="jk_pindah" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat Asal</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_asal_pindah" placeholder="Masukkan Alamat Asal" class="form-control" name="alamat_asal" required></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat Tujuan</label>
					</div>
					<div class="col-md-6">
						<textarea placeholder="Masukkan Alamat Tujuan" name="alamat_tujuan" class="form-control" required></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alasan Pindah</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Alasan Pindah" type="text" name="alasan" required>
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