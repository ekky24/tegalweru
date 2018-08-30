<?php
	use Carbon\Carbon;

	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$waktu_ayah = Carbon::createFromFormat('Y-m-d', $skkb->tgl_lahir_ayah);
	$tgl_ayah = $waktu_ayah->toDateString();
	$tgl_dummy_ayah = $waktu_ayah->day . " " . $bulan_arr[$waktu_ayah->month - 1] . " " . $waktu_ayah->year;

	$waktu_ibu = Carbon::createFromFormat('Y-m-d', $skkb->tgl_lahir_ibu);
	$tgl_ibu = $waktu_ibu->toDateString();
	$tgl_dummy_ibu = $waktu_ibu->day . " " . $bulan_arr[$waktu_ibu->month - 1] . " " . $waktu_ibu->year;
?>

@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data Surat Keterangan Kelakuan Baik</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/skkb/{{ $skkb->id }}" autocomplete="off">
				{{ csrf_field() }}
				<h3>Data Pemohon:</h3><br>
				<div class="form-group row">
		        	<div class="col-md-3">
						<label>Nomor Surat</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $skkb->nomor }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIK</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $skkb->penduduk_id }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Lengkap</label>
					</div>
					<div class="col-md-6">
						<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $skkb->get_penduduk->nama }}" type="text" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jenis Kelamin</label>
					</div>
					<div class="col-md-6">
						@if($skkb->get_penduduk->jk == 'L')
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
						<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $skkb->get_penduduk->kewarganegaraan }}" readonly>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						@if($skkb->get_penduduk->get_kk == null)
							<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
						@else
							<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $skkb->get_penduduk->get_kk->alamat }}</textarea>
						@endif
					</div>
		        </div><br>
		        <h3>Data Ayah:</h3><br>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama" type="text" name="nama_ayah" value="{{ $skkb->nama_ayah }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tempat Lahir</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir_ayah" value="{{ $skkb->tempat_lahir_ayah }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Lahir</label>
					</div>
					<div class="col-md-6">
								<input id="date_custom" class="form-control" placeholder="Masukkan Tanggal Lahir" type="date" name="tgl_lahir_ayah" value="{{ $tgl_ayah }}" style="display: none;" required>
								<div class="form-group row" id="div_dummy">
									<div class="col-md-10">
										<input type="text" class="form-control" id="date_dummy" value="{{ $tgl_dummy_ayah }}" readonly>
									</div>
									<div class="col-md-2">
										<button id="button_dummy" class="form-control col-md-2 btn btn-primary">Edit</button>
									</div>
								</div>
							</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Agama</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Agama" type="text" name="agama_ayah" value="{{ $skkb->agama_ayah }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Pekerjaan</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Pekerjaan" type="text" name="pekerjaan_ayah" value="{{ $skkb->pekerjaan_ayah }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_surat" placeholder="Masukkan Alamat" class="form-control" name="alamat_ayah" required>{{ $skkb->alamat_ayah }}</textarea>
					</div>
		        </div>
		        <h3>Data Ibu:</h3><br>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama" type="text" name="nama_ibu" value="{{ $skkb->nama_ibu }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tempat Lahir</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Tempat Lahir" type="text" name="tempat_lahir_ibu" value="{{ $skkb->tempat_lahir_ibu }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Tanggal Lahir</label>
					</div>
					<div class="col-md-6">
								<input id="date_custom2" class="form-control" placeholder="Masukkan Tanggal Lahir" type="date" name="tgl_lahir_ibu" value="{{ $tgl_ibu }}" style="display: none;" required>
								<div class="form-group row" id="div_dummy2">
									<div class="col-md-10">
										<input type="text" class="form-control" id="date_dummy2" value="{{ $tgl_dummy_ibu }}" readonly>
									</div>
									<div class="col-md-2">
										<button id="button_dummy2" class="form-control col-md-2 btn btn-primary">Edit</button>
									</div>
								</div>
							</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Agama</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Agama" type="text" name="agama_ibu" value="{{ $skkb->agama_ibu }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Pekerjaan</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Pekerjaan" type="text" name="pekerjaan_ibu" value="{{ $skkb->pekerjaan_ibu }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Alamat</label>
					</div>
					<div class="col-md-6">
						<textarea id="alamat_surat" placeholder="Masukkan Alamat" class="form-control" name="alamat_ibu" required>{{ $skkb->alamat_ibu }}</textarea>
					</div>
		        </div><br>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Keperluan</label>
					</div>
					<div class="col-md-6">
						<textarea id="keperluan_surat" placeholder="Masukkan Keperluan" class="form-control" name="keperluan" required>{{ $skkb->keperluan }}</textarea>
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
								@if($row->id == $skkb->penerbit_id)
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
		</div>
	</div>

@endsection