@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Password</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/session_pass" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">

				<label class="control-label col-sm-3">Username</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Username" type="text" value="{{ auth()->user()->username }}" readonly>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Password Lama</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Password Lama" type="password" name="pass_lama" required>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Password Baru</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Password Baru" type="password" name="password" required>
				</div>
			</div>
			<div class="form-group">

				<label class="control-label col-sm-3">Konfirmasi Password</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Konfirmasi Password" type="password" name="password_confirmation" required>
				</div>
			</div>
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
	</div>
</div>

@endsection