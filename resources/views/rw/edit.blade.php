@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data RW</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/rw/{{$rw->id}}">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Rukun Warga</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nomor RW" type="text" name="nama" value="{{ $rw->nama }}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Ketua RW</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Ketua RW" type="text" name="ketua" value="{{$rw->ketua}}" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
			@include('layout.error')
			@include('layout.success')
		</div>
	</div>
	
@endsection