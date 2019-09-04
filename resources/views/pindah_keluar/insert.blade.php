@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Surat Pindah Keluar</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/pindah_keluar" autocomplete="off" class="form-horizontal" id="form_pindah_keluar">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input id="nik_surat" class="form-control" placeholder="Masukkan NIK" type="number" name="penduduk_id" required>
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
				<label class="control-label col-sm-3">Agama</label>				
				<div class="col-sm-6">
					<input id="agama_surat" class="form-control" placeholder="Agama" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Pindah Ke</label>
				<div class="col-sm-6">
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" name="alamat_tujuan"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Alasan Pindah</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Alasan Pindah" type="text" name="alasan_pindah">
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
			<div class="form-group">
				<label class="control-label col-sm-3">Pindah Satu Keluarga ?</label>
				<div class="col-sm-1">
					<input type="checkbox" class="form-check-input" id="pindah_satu_keluarga">
			    	<label class="form-check-label" for="pindah_satu_keluarga" style="margin-left: 5px;">Ya</label>
				</div>
				<div class="col-sm-5">
					<input id="nomor_kk" class="form-control" placeholder="Masukkan Nomor KK" type="text" name="nomor_kk" disabled>
				</div>
			</div><br>
			<div id="div_pindah" style="display: none;">
		        <hr>
		       	<h2>Tambahkan Data Anggota Keluarga</h2>
		       	<button type="button" id="tambah_row_pindah" class="btn btn-primary">Tambah</button><br><br>
		    </div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary" id="btn_submit_pindah">Submit</button>
				<button type="button" class="btn btn-default" id="tambah_pindah">Tambah Anggota Keluarga</button>
			</div>
		</form>
		@include('layout.error')
	</div>
</div>


@endsection