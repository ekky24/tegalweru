@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Ijin Keramaian</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/sik" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_surat" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					<input id="jk_surat" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Kewarganegaraan</label>
				<div class="col-sm-6">
					<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Acara</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Acara" type="text" name="nama_acara" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanggal Acara</label>
				<div class="col-sm-6">
					<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Acara" type="date" name="tgl_acara" required>
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
			<div class="form-group">
				<label class="control-label col-sm-3">Jam Acara</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jam Acara" type="text" name="jam_acara" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat Acara</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tempat Acara" type="text" name="tempat_acara" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Hiburan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Hiburan Acara" type="text" name="hiburan" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Jumlah Undangan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jumlah Undangan" type="number" name="jumlah_undangan">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Pilih Jenis Surat</label>
				<div class="col-sm-6">
					<select name="jenis_surat" class="form-control" required>
						<option value="" selected disabled hidden>Pilih Jenis Surat</option>
						<option value="sound_system">Ijin Sound System</option>
						<option value="tanpa_camat">Ijin Keramaian Tanpa Camat</option>
						<option value="dengan_camat">Ijin Keramaian Dengan Camat
						</option>
					</select>
				</div>
			</div>
			<h4>Surat Pengantar:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">Dari</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Pemberi Surat Pengantar" type="text" name="dari_pengantar">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tanggal Surat Pengantar" type="text" name="tgl_pengantar">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
				<div class="col-sm-6">
					<select name="penerbit_id" class="form-control" required>
						<option value="" selected disabled hidden>Pilih Pejabat</option>
						@foreach($penerbit as $row)
						<option value="{{ $row->id }}">{{ $row->nama }}</option>
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
	</div>
</div>

@endsection