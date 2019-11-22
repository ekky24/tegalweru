@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Ubah Data RT</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/rt/{{$rt->id}}" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				
				<label class="control-label col-sm-3">Rukun Tetangga</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nomor RT" type="text" value="{{ $rt->nama }}" name="nama" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Ketua RT</label>
				<div class="col-sm-6">
					<input class="form-control" placeholder="Masukkan Nama Ketua RT" type="text" name="ketua" value="{{$rt->ketua}}" required>
				</div>
			</div>
			<div class="form-group">
				
				<label class="control-label col-sm-3">Pilih RW</label>
				<div class="col-sm-6">
					<select name="rukun_warga_id" class="form-control" required>
						@foreach($rw as $row)
						@if($row->id == $rt->rukun_warga_id)
						<option value="{{ $row->id }}" selected>{{ "RW " . $row->nama }}</option>
						@else
						<option value="{{ $row->id }}">{{ "RW " . $row->nama }}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
		@include('layout.success')
	</div>
</div>

@endsection