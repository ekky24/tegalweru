@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input RW Baru</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/rw">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Rukun Warga</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nomor RW" type="number" name="nama" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Ketua RW</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Ketua RW" type="text" name="ketua" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
		</div>
	</div>

@endsection