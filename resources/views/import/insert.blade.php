@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Input Data Penduduk</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/import" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">File Excel</label>
				<div class="col-sm-6">
					<input class="form-control" name="file" type="file">
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