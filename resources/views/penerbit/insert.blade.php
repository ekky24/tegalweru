@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Input Data Pejabat</h1>
        </div>
    </div>
	
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/penerbit" autocomplete="off">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>NIP</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan NIP" type="text" name="nip" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Nama Pejabat</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Pejabat Desa" type="text" name="nama" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Jabatan</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Jabatan" type="text" name="jabatan" required>
					</div>
		        </div>
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
		</div>
	</div>
	
@endsection