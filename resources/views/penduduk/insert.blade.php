@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Data Penduduk</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
    	<form method="post" action="/penduduk" autocomplete="off">
		{{ csrf_field() }}
        <div class="form-group row">
        	<div class="col-md-3">
				<label>NIK</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan NIK" type="number" name="nik" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Lengkap</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Nama Lengkap" type="text" name="nama" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Jenis Kelamin</label>
			</div>
			<div class="col-md-6">
				<select name="jk" class="form-control">
					<option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
					<option value="L">Laki-Laki</option>
					<option value="P">Perempuan</option>
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tempat Lahir</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" id="kota" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Tanggal Lahir</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Lahir" type="date" name="tgl_lahir" required>
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
				<label>Pilih Agama</label>
			</div>
			<div class="col-md-6">
				<select name="agama_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Agama</option>
					@foreach($agama as $row)
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Pendidikan</label>
			</div>
			<div class="col-md-6">
				<select name="pendidikan_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Pendidikan</option>
					@foreach($pendidikan as $row)
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Jenis Pekerjaan</label>
			</div>
			<div class="col-md-6">
				<select name="jenis_pekerjaan_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Jenis Pekerjaan</option>
					@foreach($pekerjaan as $row)
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Status Pernikahan</label>
			</div>
			<div class="col-md-6">
				<select name="status_nikah_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Status Pernikahan</option>
					@foreach($status_nikah as $row)
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Status Hubungan Keluarga</label>
			</div>
			<div class="col-md-6">
				<select name="status_hubungan_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Status Hubungan</option>
					@foreach($status_hubungan as $row)
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih Kewarganegaraan</label>
			</div>
			<div class="col-md-6">
				<select name="kewarganegaraan" class="form-control" required>
					<option value="" selected disabled hidden>Pilih Kewarganegaraan</option>
					<option value="WNI">WNI</option>
					<option value="WNA">WNA</option>
				</select>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>No. Paspor</label>
			</div>
			<div class="col-md-6">
				<input type="number" name="paspor" class="form-control" placeholder="Masukkan Nomor Paspor">
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>No. KITAS/KITAP</label>
			</div>
			<div class="col-md-6">
				<input type="number" name="kitas" class="form-control" placeholder="Masukkan Nomor KITAS/KITAP">
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Ayah</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Nama Ayah" type="text" name="ayah" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Ibu</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Nama Ibu" type="text" name="ibu" required>
			</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>
    </div>
    </div>

@endsection