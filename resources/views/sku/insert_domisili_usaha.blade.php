@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Domisili Usaha</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/sku" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Usaha</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Usaha" type="text" name="nama_usaha" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Tahun Pendirian</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Tahun Pendirian" type="number" name="tahun_pendirian_usaha" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Bidang Usaha</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Usaha" type="text" name="bidang_usaha" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat Usaha</label>
				<div class="col-sm-6">
					<textarea placeholder="Masukkan Alamat Usaha" class="form-control" name="alamat_usaha" required></textarea>
				</div>
			</div><br>
			<div class="form-group">
				<label class="control-label col-sm-3">Nama Pimpinan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Pimpinan" type="text" name="nama_pimpinan" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">NIK Pimpinan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan NIK Pimpinan" type="number" name="nik" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat Pimpinan</label>
				<div class="col-sm-6">
					<textarea placeholder="Masukkan Alamat Pimpinan" class="form-control" name="alamat_pimpinan" required></textarea>
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
			</div><br>
			<input type="hidden" name="jenis_surat" value="domisili_usaha">
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
	</div>
</div>


@endsection