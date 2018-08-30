<?php
	if ($pindah->get_penduduk->jk == "L") {
		$jk = "LAKI-LAKI";
	}
	else {
		$jk = "PEREMPUAN";
	}
?>

@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Pindah Domisili</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/pindah/{{ $pindah->penduduk_id }}" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input id="nik_pindah" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" value="{{ $pindah->penduduk_id }}" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_pindah" class="form-control" placeholder="Masukkan Nama" type="text" value="{{ $pindah->get_penduduk->nama }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<input id="jk_pindah" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" value="{{ $jk }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat Asal</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_asal_pindah" placeholder="Masukkan Alamat Asal" class="form-control" name="alamat_asal" required>{{ $pindah->alamat_asal }}</textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat Tujuan</label>
					</div>
					<div class="col-md-6">
						<textarea placeholder="Masukkan Alamat Tujuan" name="alamat_tujuan" class="form-control" required>{{ $pindah->alamat_tujuan }}</textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alasan Pindah</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Alasan Pindah" type="text" name="alasan" value="{{ $pindah->alasan }}" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>	
		</div>
	</div>

@endsection