@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Kelahiran</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/skd" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<h4>Data Ibu:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_ibu" required>
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
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<h4>Data Ayah:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_ayah" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_ayah" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_ayah" class="form-control" placeholder="Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_ayah" class="form-control" placeholder="Tempat Tgl Lahir" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_ayah" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<h4>Data Pelapor:</h4>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_pelapor" class="form-control" placeholder="Masukkan NIK" type="number" name="nik_pelapor" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_pelapor" class="form-control" placeholder="Nama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tempat, Tgl Lahir</label>
				<div class="col-sm-6">
					<input id="ttl_pelapor" class="form-control" placeholder="Tempat Tgl Lahir" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_pelapor" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Hubungan Pelapor</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Hubungan Pelapor" type="text" name="hubungan_pelapor" required>
				</div>
			</div>
			<h4>Data Kelahiran:</h4>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanggal Kelahiran</label>
				<div class="col-sm-6">
					<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Kelahiran" type="date" name="tgl_kelahiran" required>
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
				
				<label class="control-label col-sm-3">Jam Kelahiran</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jam Kelahiran" type="text" name="jam_kelahiran" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tempat Kelahiran</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tempat Kelahiran" type="text" name="tempat_kelahiran" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Anak</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Anak" type="text" name="nama_anak" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Jenis Kelamin Anak</label>
				<div class="col-sm-6">
					<select name="jk_anak" class="form-control">
						<option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
						<option value="L">Laki-Laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Anak Ke</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Anak Ke" type="number" name="anak_ke" required>
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
				<a class="btn btn-primary" href="/pdf/kelahiran.pdf" target="_blank">Form Dispenduk</a><br><br>
			</div>
		</form>	
		@include('layout.error')
	</div>
</div>

@endsection