@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Password</h1>
        </div>
    </div>
	<hr>
	<form method="post" action="/session_pass">
		{{ csrf_field() }}
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Username</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Username" type="text" value="{{ auth()->user()->username }}" readonly>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Password Lama</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Password Lama" type="password" name="pass_lama" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Password Baru</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Masukkan Password Baru" type="password" name="password" required>
			</div>
        </div>
        <div class="form-group row">
        	<div class="col-md-3">
				<label>Konfirmasi Password</label>
			</div>
			<div class="col-md-6">
				<input class="form-control" placeholder="Konfirmasi Password" type="password" name="password_confirmation" required>
			</div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</form>
	@include('layout.error')
@endsection