<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu = Carbon::createFromFormat('Y-m-d', $penduduk->tgl_lahir);
	$tgl_dummy = $waktu->day . " " . $bulan_arr[$waktu->month - 1] . " " . $waktu->year;
?>

@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Penduduk</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/penduduk/{{$penduduk->id}}" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan NIK" type="number" name="nik" value="{{$penduduk->id}}" required readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Lengkap" type="text" name="nama" value="{{$penduduk->nama}}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Pilih Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						<select name="jk" class="form-control">
							@if($penduduk->jk == "L")
								<option value="L" selected>Laki-Laki</option>
								<option value="P">Perempuan</option>
							@else
								<option value="L">Laki-Laki</option>
								<option value="P" selected>Perempuan</option>
							@endif
						</select>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tempat Lahir</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" id="kota" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir" value="{{$penduduk->get_tempat_lahir->nama}}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Lahir</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_lahir" value="{{ $penduduk->tgl_lahir }}" style="display: none;" required>
						<div class="form-group row" id="div_dummy">
							<div class="col-md-10">
								<input type="text" class="form-control" id="date_dummy" value="{{ $tgl_dummy }}" readonly>
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
							@foreach($agama as $row)
								@if($row->id == $penduduk->agama_id)
									<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
								@endif
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
							@foreach($pendidikan as $row)
								@if($row->id == $penduduk->pendidikan_id)
									<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
								@endif
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
							@foreach($pekerjaan as $row)
								@if($row->id == $penduduk->jenis_pekerjaan_id)
									<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
								@endif
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
							@foreach($status_nikah as $row)
								@if($row->id == $penduduk->status_nikah_id)
									<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
								@endif
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
							@foreach($status_hubungan as $row)
								@if($row->id == $penduduk->status_hubungan_id)
									<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
								@else
									<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
								@endif
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
							@if($penduduk->kewarganegaraan == "WNI")
								<option value="WNI" selected>WNI</option>
								<option value="WNA">WNA</option>
							@else
								<option value="WNI">WNI</option>
								<option value="WNA" selected>WNA</option>
							@endif
						</select>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>No. Paspor</label>
					</div>
					<div class="col-md-6">
						<input type="number" name="paspor" class="form-control" placeholder="Masukkan Nomor Paspor" value="{{$penduduk->no_paspor}}">
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>No. KITAS/KITAP</label>
					</div>
					<div class="col-md-6">
						<input type="number" name="kitas" class="form-control" placeholder="Masukkan Nomor KITAS/KITAP" value="{{$penduduk->no_kitas}}">
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Ayah</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Ayah" type="text" value="{{$penduduk->ayah}}" name="ayah" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Ibu</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Ibu" type="text" value="{{$penduduk->ibu}}" name="ibu" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>	
		</div>
	</div>

@endsection