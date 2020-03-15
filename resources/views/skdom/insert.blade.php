@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Keterangan Domisili</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/skdom" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
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
			
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_surat" class="form-control" placeholder="Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_surat" class="form-control" placeholder="Tempat Tgl Lahir" type="text" readonly>
				</div>
			</div>
			<div class="form-group">	        	
				<label class="control-label col-sm-3">Agama</label>				
				<div class="col-sm-6">
					<input id="agama_surat" class="form-control" placeholder="Agama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div><br>
			<h4>Surat Pengantar:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">Dari</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Pemberi Surat Pengantar" type="text" name="dari_pengantar">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal Surat Pengantar</label>
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
			<div class="form-group">
				<label class="control-label col-sm-3">Tanggal Surat</label>
				<div class="col-sm-6">
					<input class="form-control datepicker" placeholder="Masukkan Tanggal Surat" name="created_at" required>
				</div>
			</div><br>
			<input type="hidden" name="jenis_surat" value="biasa">
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
		@include('layout.success')
	</div>
</div>


@endsection