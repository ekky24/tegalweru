@extends('layout.master')

@section('content')

	<h1>Input RT Baru</h1>
	<hr>
	<form method="post" action="/rt">
		{{ csrf_field() }}
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Rukun Tetangga</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Nomor RT" type="number" name="nama" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Ketua RT</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Nama Ketua RT" type="text" name="ketua" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Pilih RW</label>
			</div>
			<div class="col-md-6">
				<select name="rukun_warga_id" class="form-control" required>
					<option value="" selected disabled hidden>Pilih RW</option>
					@foreach($rw as $row)
						<option value="{{ $row->id }}">{{ $row->nama }}</option>
					@endforeach
				</select>
			</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>

@endsection