@extends('layout.master')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Ubah Data RT</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="/rt/{{$rt->id}}">
				{{ csrf_field() }}
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Rukun Tetangga</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nomor RT" type="text" value="{{substr($rt->nama, 2)}}" name="nama" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Ketua RT</label>
					</div>
					<div class="col-md-6">
						<input class="form-control" placeholder="Masukkan Nama Ketua RT" type="text" name="ketua" value="{{$rt->ketua}}" required>
					</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-md-3">
						<label>Pilih RW</label>
					</div>
					<div class="col-md-6">
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
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </div>
			</form>
		</div>
	</div>
	
@endsection