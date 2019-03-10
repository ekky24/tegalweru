@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data Pejabat</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/penerbit/{{$penerbit->id}}" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">

				<label class="control-label col-sm-3">NIP</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan NIP" type="text" name="nip" value="{{ $penerbit->id }}" required readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Nama Pejabat</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Pejabat Desa" type="text" name="nama" value="{{$penerbit->nama}}" required>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Jabatan</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Jabatan" type="text" name="jabatan" value="{{$penerbit->jabatan}}" required>
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