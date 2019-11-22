<?php
use Carbon\Carbon;

$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$waktu = Carbon::createFromFormat('Y-m-d', $skd->tgl_kelahiran);
$tgl = $waktu->toDateString();
$tgl_dummy = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;

$temp_tempat_lahir = $skd->get_penduduk_ibu->get_tempat_lahir->nama;
$value_tempat_lahir = substr($temp_tempat_lahir, strpos($temp_tempat_lahir, " ") + 1);
$arr_tgl_lahir = explode('-', $skd->get_penduduk_ibu->tgl_lahir);
$value_tgl_lahir = $arr_tgl_lahir[2] . '-' . $arr_tgl_lahir[1] . '-' . $arr_tgl_lahir[0];

$temp_tempat_lahir2 = $skd->get_penduduk_ayah->get_tempat_lahir->nama;
$value_tempat_lahir2 = substr($temp_tempat_lahir2, strpos($temp_tempat_lahir2, " ") + 1);
$arr_tgl_lahir2 = explode('-', $skd->get_penduduk_ayah->tgl_lahir);
$value_tgl_lahir2 = $arr_tgl_lahir2[2] . '-' . $arr_tgl_lahir2[1] . '-' . $arr_tgl_lahir2[0];

$temp_tempat_lahir3 = $skd->get_penduduk_pelapor->get_tempat_lahir->nama;
$value_tempat_lahir3 = substr($temp_tempat_lahir3, strpos($temp_tempat_lahir3, " ") + 1);
$arr_tgl_lahir3 = explode('-', $skd->get_penduduk_ibu->tgl_lahir);
$value_tgl_lahir3 = $arr_tgl_lahir3[2] . '-' . $arr_tgl_lahir3[1] . '-' . $arr_tgl_lahir3[0];
?>

@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Surat Keterangan Kelahiran</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/skd/{{ $skd->id }}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nomor Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $skd->nomor }}" readonly>
				</div>
			</div>
			<h4>Data Ibu:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_ibu" value="{{ $skd->nik_ibu }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_surat" class="form-control" placeholder="Nama" type="text" value="{{ $skd->get_penduduk_ibu->nama }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_surat" class="form-control" placeholder="Nama" value="{{ $value_tempat_lahir . ', ' . $value_tgl_lahir }}" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					@if($skd->get_penduduk_ibu->get_kk == null)
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
					@else
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $skd->get_penduduk_ibu->get_kk->alamat }}</textarea>
					@endif
				</div>
			</div>

			<h4>Data Ayah:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_ayah" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_ayah" value="{{ $skd->nik_ayah }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_ayah" class="form-control" placeholder="Nama" type="text" value="{{ $skd->get_penduduk_ayah->nama }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_ayah" class="form-control" placeholder="Tempat Tgl Lahir" type="text" value="{{ $value_tempat_lahir2 . ', ' . $value_tgl_lahir2 }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					@if($skd->get_penduduk_ayah->get_kk == null)
					<textarea id="alamat_ayah" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
					@else
					<textarea id="alamat_ayah" placeholder="Alamat" class="form-control" readonly>{{ $skd->get_penduduk_ayah->get_kk->alamat }}</textarea>
					@endif
				</div>
			</div>

			<h4>Data Pelapor:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_pelapor" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_pelapor" value="{{ $skd->nik_pelapor }}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_pelapor" class="form-control" placeholder="Nama" type="text" value="{{ $skd->get_penduduk_pelapor->nama }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_pelapor" class="form-control" placeholder="Tempat Tgl Lahir" type="text" value="{{ $value_tempat_lahir3 . ', ' . $value_tgl_lahir3 }}" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					@if($skd->get_penduduk_pelapor->get_kk == null)
					<textarea id="alamat_pelapor" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
					@else
					<textarea id="alamat_pelapor" placeholder="Alamat" class="form-control" readonly>{{ $skd->get_penduduk_pelapor->get_kk->alamat }}</textarea>
					@endif
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Hubungan Pelapor</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Hubungan Pelapor" type="text" name="hubungan_pelapor" value="{{ $skd->hubungan_pelapor }}" required>
				</div>
			</div>
			<h4>Data Kelahiran:</h4>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanggal Kelahiran</label>
				<div class="col-sm-6">
					<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Kelahiran" type="date" name="tgl_kelahiran" value="{{ $tgl }}" style="display: none;" required>
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
				
				<label class="control-label col-sm-3">Jam Kelahiran</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jam Kelahiran" type="text" name="jam_kelahiran" value="{{ $skd->jam_kelahiran }}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tempat Kelahiran</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tempat Kelahiran" type="text" name="tempat_kelahiran" value="{{ $skd->tempat_kelahiran }}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Anak</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Anak" type="text" name="nama_anak" value="{{ $skd->nama_anak }}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Jenis Kelamin Anak</label>
				<div class="col-sm-6">
					<select name="jk_anak" class="form-control">
						@if($skd->jk_anak == "L")
						<option value="L" selected>LAKI-LAKI</option>
						<option value="P">PEREMPUAN</option>
						@else
						<option value="L">LAKI-LAKI</option>
						<option value="P" selected>PEREMPUAN</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Anak Ke</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Anak Ke" type="number" name="anak_ke" value="{{ $skd->anak_ke }}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
				<div class="col-sm-6">
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
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>	
		@include('layout.error')
		@include('layout.success')
	</div>
</div>

@endsection