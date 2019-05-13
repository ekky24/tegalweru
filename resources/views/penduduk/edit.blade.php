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
		<form method="post" action="/penduduk/{{$penduduk->id}}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Lengkap" type="text" name="nama" value="{{$penduduk->nama}}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan NIK" type="number" name="nik" value="{{$penduduk->id}}" required readonly>
				</div>
			</div>
			<div class="form-group">
		   		<label class="control-label col-sm-3">Alamat Sebelumnya</label>
				<div class="col-sm-6">
					<textarea placeholder="Masukkan alamat" name="alamat_sebelum" class="form-control">{{ $penduduk->alamat_sebelumnya }}</textarea>
				</div>
		    </div>
		    <div class="form-group">
				
				<label class="control-label col-sm-3">No. Paspor</label>
				<div class="col-sm-6">
					<input type="number" name="paspor" class="form-control" placeholder="Masukkan Nomor Paspor" value="{{$penduduk->no_paspor}}">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Jenis Kelamin</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tempat Lahir</label>
				<div class="col-sm-6">
					<input class="form-control" id="kota" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir" value="{{$penduduk->get_tempat_lahir->nama}}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Tanggal Lahir</label>
				<div class="col-sm-6">
					<input class="form-control" id="date_custom" placeholder="Masukkan Tanggal Kematian" type="date" name="tgl_lahir" value="{{ $penduduk->tgl_lahir }}" style="display: none;" required>
					<div class="form-group" id="div_dummy">
						<div class="col-md-10">
							<input type="text" class="form-control" id="date_dummy" value="{{ $tgl_dummy }}" readonly>
						</div>
						<div class="col-md-2">
							<button id="button_dummy" class="form-control col-md-2 btn btn-primary">Edit</button>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nomor Akta Lahir</label>
				<div class="col-sm-6">
					<input type="text" name="akta_lahir" class="form-control" placeholder="Masukkan Nomor Akta Lahir" value="{{ $penduduk->no_akta_lahir }}">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Agama</label>
				<div class="col-sm-6">
					<select id="agama_form" name="agama_id" class="form-control" required>
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
			@if($penduduk->nama_organisasi != NULL)
			<div class="form-group" id="agama_optional">
				<label class="control-label col-sm-3">Nama Organisasi</label>
				<div class="col-sm-6">
					<input type="text" name="nama_organisasi" class="form-control" placeholder="Masukkan Nama Organisasi" value="{{ $penduduk->nama_organisasi }}">
				</div>
			</div>
			@else
			<div class="form-group" id="agama_optional" style="display: none">
				<label class="control-label col-sm-3">Nama Organisasi</label>
				<div class="col-sm-6">
					<input type="text" name="nama_organisasi" class="form-control" placeholder="Masukkan Nama Organisasi">
				</div>
			</div>
			@endif
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Status Pernikahan</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				<label class="control-label col-sm-3">Nomor Akta Pernikahan</label>
				<div class="col-sm-6">
					<input type="text" name="akta_nikah" class="form-control" placeholder="Masukkan Nomor Akta Nikah" value="{{ $penduduk->no_akta_nikah }}">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Nomor Akta Perceraian</label>
				<div class="col-sm-6">
					<input type="text" name="akta_cerai" class="form-control" placeholder="Masukkan Nomor Akta Cerai" value="{{ $penduduk->no_akta_cerai }}">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Status Hubungan Keluarga</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				<label class="control-label col-sm-3">Kelainan Fisik dan Mental</label>
				<div class="col-sm-6">
					<select id="cacat_form" class="form-control" name="penyandang_cacat_id">
						@foreach($penyandang_cacat as $row)
						@if($row->id == $penduduk->penyandang_cacat_id)
						<option value="{{ $row->id }}" selected>{{ $row->keterangan }}</option>
						@else
						<option value="{{ $row->id }}">{{ $row->keterangan }}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Pendidikan</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Jenis Pekerjaan</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Kewarganegaraan</label>
				<div class="col-sm-6">
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
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK Ayah</label>
				<div class="col-sm-6">
					<input type="number" name="nik_ayah" class="form-control" placeholder="Masukkan NIK Ayah" value="{{ $penduduk->nik_ayah }}">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Ayah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Ayah" type="text" value="{{$penduduk->nama_ayah}}" name="nama_ayah" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK Ibu</label>
				<div class="col-sm-6">
					<input type="number" name="nik_ibu" class="form-control" placeholder="Masukkan NIK Ibu" value="{{ $penduduk->nik_ibu }}">
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Ibu</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Ibu" type="text" value="{{$penduduk->nama_ibu}}" name="nama_ibu" required>
				</div>
			</div>
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>	
	</div>
</div>

@endsection