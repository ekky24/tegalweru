@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Surat Keterangan Dukun</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/skd" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_surat" class="form-control" placeholder="Masukkan Nama" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<input id="jk_surat" class="form-control" placeholder="Masukkan Jenis Kelamin" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Kewarganegaraan</label>
					</div>
					<div class="col-md-6">
						<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Anak</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Anak" type="text" name="nama_anak" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Suami</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Suami" type="text" name="nama_suami" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Kelahiran</label>
					</div>
					<div class="col-md-6">
						<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Kelahiran" type="date" name="tgl_kelahiran" required>
						<div class="form-group row" id="div_dummy" style="display: none;">
							<div class="col-md-10">
								<input type="text" class="form-control" id="date_dummy" readonly>
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
						<input class="form-control" placeholder="Masukkan Jam Kelahiran" type="time" name="jam_kelahiran" required>
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
								<option value="{{ $row->id }}">{{ $row->nama }}</option>
							@endforeach
						</select>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>	
			@include('layout.error')
		</div>
	</div>

@endsection