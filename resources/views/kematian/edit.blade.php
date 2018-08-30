@extends('layout.master')

@section('content')
	<?php
		use Carbon\Carbon;

		$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $kematian->waktu_kematian);
		$tgl = $waktu->toDateString();
		$jam = $waktu->toTimeString();
		$tgl_dummy = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;

		if ($kematian->get_penduduk->jk == "L") {
			$jk = "LAKI-LAKI";
		}
		else {
			$jk = "PEREMPUAN";
		}
	?>
	
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Kematian Penduduk</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/kematian/{{ $kematian->penduduk_id }}" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan NIK" type="number" name="nik" value="{{ $kematian->penduduk_id }}" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_kematian" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ $kematian->get_penduduk->nama }}" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<input id="jk_kematian" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" value="{{ $jk }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nomor KK</label>
					</div>
					<div class="col-md-6">
						<input id="no_kk_kematian" class="form-control" placeholder="Masukkan Nomor KK" type="number" value="{{ $kematian->get_penduduk->kk_id }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tempat Kematian</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Lokasi Kematian" type="text" name="tempat" value="{{ $kematian->tempat_kematian }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Kematian</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_kematian" value="{{ $tgl }}" style="display: none;" required>
						<div class="form-group row" id="div_dummy">
							<div class="col-md-10">
								<input type="text" class="form-control" id="date_dummy" value="{{ $tgl_dummy }}" readonly>
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
						<input class="form-control" placeholder="Masukkan Jam Kematian" type="time" name="jam_kematian" value="{{ $jam }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tempat Pemakaman</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Tempat Pemakaman" type="text" name="tempat_pemakaman" value="{{ $kematian->tempat_pemakaman }}" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
	
		</div>
	</div>
@endsection