@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Surat Keterangan Kehilangan</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/skk" autocomplete="off">
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
						<label>Keperluan</label>
					</div>
					<div class="col-md-6">
						<textarea id="keperluan_surat" placeholder="Masukkan Keperluan" class="form-control" name="keperluan" required></textarea>
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