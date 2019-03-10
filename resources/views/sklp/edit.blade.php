@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Surat Keterangan Lunas PBB</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/sklp/{{ $sklp->id }}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nomor Surat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Nomor Surat" type="text" value="{{ $sklp->nomor }}" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">NIK</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="NIK" type="number" name="nik" value="{{ $sklp->penduduk_id }}" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Nama Lengkap</label>
				<div class="col-sm-6">
					<input id="nama_surat" class="form-control" placeholder="Nama" value="{{ $sklp->get_penduduk->nama }}" type="text" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Jenis Kelamin</label>
				<div class="col-sm-6">
					@if($sklp->get_penduduk->jk == 'L')
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'LAKI-LAKI' }}" type="text" readonly>
					@else
					<input id="jk_surat" class="form-control" placeholder="Jenis Kelamin" value="{{ 'PEREMPUAN' }}" type="text" readonly>
					@endif
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Kewarganegaraan</label>
				<div class="col-sm-6">
					<input id="kewarganegaraan_surat" class="form-control" placeholder="Kewarganegaraan" type="text" value="{{ $sklp->get_penduduk->kewarganegaraan }}" readonly>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Alamat</label>
				<div class="col-sm-6">
					@if($sklp->get_penduduk->get_kk == null)
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ "-" }}</textarea>
					@else
					<textarea id="alamat_surat" placeholder="Alamat" class="form-control" readonly>{{ $sklp->get_penduduk->get_kk->alamat }}</textarea>
					@endif
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Jumlah Tahun Lunas</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jumlah Tahun Lunas PBB" type="number" name="tahun_lunas" value="{{ $sklp->tahun_lunas }}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Keperluan</label>
				<div class="col-sm-6">
					<textarea id="keperluan_surat" placeholder="Masukkan Keperluan sklp" class="form-control" name="keperluan" required>{{ $sklp->keperluan }}</textarea>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih Pejabat Penerbit</label>
				<div class="col-sm-6">
					<select name="penerbit_id" class="form-control" required>
						<option value="" selected disabled hidden>Pilih Pejabat</option>
						@foreach($penerbit as $row)
						@if($row->id == $sklp->penerbit_id)
						<option value="{{ $row->id }}" selected>{{ $row->nama }}</option>
						@else
						<option value="{{ $row->id }}">{{ $row->nama }}</option>
						@endif
						@endforeach
					</select>
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