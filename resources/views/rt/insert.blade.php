@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input RT Baru</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/rt" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Rukun Tetangga</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nomor RT" type="number" name="nama" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Ketua RT</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Ketua RT" type="text" name="ketua" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih RW</label>
				<div class="col-sm-6">
					<select name="rukun_warga_id" class="form-control" required>
						<option value="" selected disabled hidden>Pilih RW</option>
						@foreach($rw as $row)
						<option value="{{ $row->id }}">{{ $row->nama }}</option>
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