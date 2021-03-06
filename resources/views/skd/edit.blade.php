<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $skd->waktu_lahir);
	$tgl = $waktu->toDateString();
	$jam = $waktu->toTimeString();
	$tgl_dummy = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Surat Keterangan Dukun</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/skd/{{ $skd->id }}" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group row">
		        	<div class="col-md-3">
						<label>Nomor Surat</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $skd->nomor }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $skd->penduduk_id }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $skd->get_penduduk->nama }}" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						@if($skd->get_penduduk->jk == 'L')
							<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
						@else
							<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
						@endif
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kewarganegaraan</label>
					</div>
					<div class="col-md-6">
						<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $skd->get_penduduk->kewarganegaraan }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						@if($skd->get_penduduk->get_kk == null)
							<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
						@else
							<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $skd->get_penduduk->get_kk->alamat }}</textarea>
						@endif
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Anak</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Anak" type="text" name="nama_anak" value="{{ $skd->nama_anak }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Suami</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Anak" type="text" name="nama_suami" value="{{ $skd->nama_suami }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Kelahiran</label>
					</div>
					<div class="col-md-6">
						<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Kelahiran" type="date" name="tgl_kelahiran" value="{{ $tgl }}" style="display: none;" required>
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
						<label>Jam Kelahiran</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Jam Kelahiran" type="time" name="jam_kelahiran" value="{{ $jam }}" required>
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
								@if($row->id == $skd->penerbit_id)
									<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->nama }}</option>
								@endif
							@endforeach
						</select>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>	
		</div>
	</div>

@endsection