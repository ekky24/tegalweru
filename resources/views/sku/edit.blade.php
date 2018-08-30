@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Surat Keterangan Usaha</h1>
        </div>
    </div>
	<hr>
	<form method="post" action="/sku/{{ $sku->id }}" autocomplete="off">
		{{ csrf_field() }}
		<div class="form-group row">
        	<div class="col-md-3">
				<label>Nomor Surat</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $sku->nomor }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>NIK</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $sku->penduduk_id }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Nama Lengkap</label>
			</div>
			<div class="col-md-6">
				<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $sku->get_penduduk->nama }}" type="text" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Jenis Kelamin</label>
			</div>
			<div class="col-md-6">
				@if($sku->get_penduduk->jk == 'L')
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
				<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $sku->get_penduduk->kewarganegaraan }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Alamat</label>
			</div>
			<div class="col-md-6">
				@if($sku->get_penduduk->get_kk == null)
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
				@else
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $sku->get_penduduk->get_kk->alamat }}</textarea>
				@endif
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Jenis Usaha</label>
			</div>
			<div class="col-md-6">
				<input name="jenis_usaha" class="form-control" placeholder="Jenis Usaha" type="text" value="{{ $sku->jenis_usaha }}" required>
			</div>
        </div>
        <h4>Tanah Sendiri:</h4>
        <div class="form-group row">
        	<div class="col-md-3">
				<label style="margin-left: 30px;">Tanah Sawah</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Luas Tanah Sawah" type="number" name="sendiri_sawah" value="{{ $sku->sendiri_sawah }}">
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label style="margin-left: 30px;">Tanah Tegal</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Luas Tanah Tegal" type="number" name="sendiri_tegal" value="{{ $sku->sendiri_tegal }}">
			</div>
        </div><br>
        <h4>Tanah Sewa:</h4>
        <div class="form-group row">
        	<div class="col-md-3">
				<label style="margin-left: 30px;">Tanah Sawah</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Luas Tanah Sawah" type="number" name="sewa_sawah" value="{{ $sku->sewa_sawah }}">
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label style="margin-left: 30px;">Tanah Tegal</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Luas Tanah Tegal" type="number" name="sewa_tegal" value="{{ $sku->sewa_tegal }}">
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Keperluan</label>
			</div>
			<div class="col-md-6">
				<textarea id="keperluan_surat" placeholder="Masukkan Keperluan sku" class="form-control" name="keperluan" required>{{ $sku->keperluan }}</textarea>
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
						@if($row->id == $sku->penerbit_id)
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