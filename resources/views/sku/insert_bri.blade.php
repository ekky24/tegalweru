@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Keterangan Usaha</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/sku" autocomplete="off" class="form-horizontal">
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
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_surat" class="form-control" placeholder="Masukkan Tempat Tgl Lahir" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Usaha</label>	
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jenis Usaha" type="text" name="nama_usaha" required>
				</div>
			</div><br>
			<h4>Tanah Sendiri:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanah Sawah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Luas Tanah Sawah" type="number" name="sendiri_sawah">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanah Tegal</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Luas Tanah Tegal" type="number" name="sendiri_tegal">
				</div>
			</div><br>
			<h4>Tanah Sewa:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">Tanah Sawah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Luas Tanah Sawah" type="number" name="sewa_sawah">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanah Tegal</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Luas Tanah Tegal" type="number" name="sewa_tegal">
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
			<input type="hidden" name="jenis_surat" value="bri">
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
		@include('layout.success')
	</div>
</div>


@endsection