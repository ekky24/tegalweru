@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Kematian Penduduk</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/kematian" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<h4>Data Surat:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">Judul Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Judul Surat" type="text" name="judul_surat" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nomor Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nomor Surat" type="text" name="nomor_surat" required>
				</div>
			</div>

			<h4>Data Orang Meninggal:</h4>
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_kematian" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_kematian" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					<input id="jk_kematian" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_kematian" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanggal Kematian</label>
				<div class="col-sm-6">
					<input class="form-control datepicker" placeholder="Masukkan Tanggal Kematian" name="tgl_kematian" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Jam Kematian</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jam Kematian" type="text" name="jam_kematian" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tempat Kematian</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Lokasi Kematian" type="text" name="tempat_kematian" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Penyebab Kematian</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Penyebab Kematian" type="text" name="penyebab_kematian" required>
				</div>
			</div>
			<br>
			<h4>Data Pelapor:</h4>
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_pelapor" required>
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
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Hubungan Pelapor</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Hubungan Pelapor" type="text" name="hubungan_pelapor" required>
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
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal Surat</label>
				<div class="col-sm-6">
					<input class="form-control datepicker" placeholder="Masukkan Tanggal Surat" name="created_at" required>
				</div>
			</div><br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
				<a class="btn btn-primary" href="/pdf/kematian.pdf" target="_blank">Form Dispenduk</a>
			</div>
		</form>
		@include('layout.error')
		@include('layout.success')
	</div>
</div>
@endsection