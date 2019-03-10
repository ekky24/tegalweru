@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input RW Baru</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/rw" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Rukun Warga</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nomor RW" type="number" name="nama" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Ketua RW</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Ketua RW" type="text" name="ketua" required>
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