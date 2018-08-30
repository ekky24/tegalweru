@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Surat Keterangan Tidak Mampu</h1>
        </div>
    </div>
	<hr>
	<form method="post" action="/sktm/{{ $sktm->id }}" autocomplete="off">
		{{ csrf_field() }}
		<div class="form-group row">
        	<div class="col-md-3">
				<label>Nomor Surat</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $sktm->nomor }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>NIK</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $sktm->penduduk_id }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Lengkap</label>
			</div>
			<div class="col-md-6">
				<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $sktm->get_penduduk->nama }}" type="text" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Jenis Kelamin</label>
			</div>
			<div class="col-md-6">
				@if($sktm->get_penduduk->jk == 'L')
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
				@else
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
				@endif
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Kewarganegaraan</label>
			</div>
			<div class="col-md-6">
				<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $sktm->get_penduduk->kewarganegaraan }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Alamat</label>
			</div>
			<div class="col-md-6">
				@if($sktm->get_penduduk->get_kk == null)
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
				@else
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $sktm->get_penduduk->get_kk->alamat }}</textarea>
				@endif
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Keperluan</label>
			</div>
			<div class="col-md-6">
				<textarea id="keperluan_surat" placeholder="Masukkan Keperluan SKTM" class="form-control" name="keperluan" required>{{ $sktm->keperluan }}</textarea>
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
						@if($row->id == $sktm->penerbit_id)
							<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
						@else
							<option value="{{ $row->id }}">{{ $row->nama }}</option>
						@endif
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>

@endsection