<?php
use Carbon\Carbon;

$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$waktu = Carbon::createFromFormat('Y-m-d', $skwn->tgl_lahir_nikah);
$tgl = $waktu->toDateString();
$tgl_dummy = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Surat Keterangan Wali Nikah</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/skwn/{{ $skwn->id }}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<h3>Orang yang Menikahkan:</h3><br>
			<div class="form-group">

				<label class="control-label col-sm-3">Nomor Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $skwn->nomor }}" readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $skwn->penduduk_id }}" readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $skwn->get_penduduk->nama }}" type="text" readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					@if($skwn->get_penduduk->jk == 'L')
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
					@else
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
					@endif
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Kewarganegaraan</label>
				<div class="col-sm-6">
					<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $skwn->get_penduduk->kewarganegaraan }}" readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					@if($skwn->get_penduduk->get_kk == null)
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
					@else
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $skwn->get_penduduk->get_kk->alamat }}</textarea>
					@endif
				</div>
			</div><br>
			<h3>Orang yang Dinikahkan:</h3><br>
			<div class="form-group">

				<label class="control-label col-sm-3">Nama</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama yang Dinikahkan" type="text" name="nama_nikah" value="{{ $skwn->nama_nikah }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat Lahir</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir_nikah" value="{{ $skwn->tempat_lahir_nikah }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal Lahir</label>
				<div class="col-sm-6">
					<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Lahir" type="date" name="tgl_lahir_nikah" value="{{ $tgl }}" style="display: none;" required>
					<div class="form-group" id="div_dummy">
						<div class="col-md-10">
							<input type="text" class="form-control" id="date_dummy" value="{{ $tgl_dummy }}" readonly>
						</div>
						<div class="col-md-2">
							<button id="button_dummy" class="form-control col-md-2 btn btn-primary">Edit</button>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Agama</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Agama" type="text" name="agama_nikah" value="{{ $skwn->agama_nikah }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Pekerjaan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Pekerjaan" type="text" name="pekerjaan_nikah" value="{{ $skwn->pekerjaan_nikah }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Masukkan Alamat" class="form-control" name="alamat_nikah" required>{{ $skwn->alamat_nikah }}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
				<div class="col-sm-6">
					<select name="penerbit_id" class="form-control" required>
						<option value="" selected disabled hidden>Pilih Pejabat</option>
						@foreach($penerbit as $row)
						@if($row->id == $skwn->penerbit_id)
						<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
						@else
						<option value="{{ $row->id }}">{{ $row->nama }}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>	
	</div>
</div>

@endsection