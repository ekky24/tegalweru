@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Statistik Penduduk</h1>
            <h3>Jumlah Penduduk Aktif: <span class="filter page-header"><b>{{ $count_penduduk }} ORANG</b></span></h3>
            @if(auth()->check())
            	<form action="/penduduk/stat/download" method="get">
            		{{ csrf_field() }}
            		<button type="submit" class="btn btn-primary btn-lg">Download</button>
            	</form>
            @endif
        </div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">Jenis Kelamin</h3>
			<canvas id="jk_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Jenis Kelamin</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($count_jk as $index => $row)
					<tr>
						@if($index == 0)
							<td>Laki-Laki</td>
						@else
							<td>Perempuan</td>
						@endif
						<td>{{ $row->count }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Status Pernikahan</h3>
			<canvas id="status_nikah_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Status Nikah</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($count_status_nikah as $index => $row)
					<tr>
						<td>{{ $row->get_status_nikah->keterangan }}</td>
						<td>{{ $row->count }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">Agama</h3>
			<canvas id="agama_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Agama</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($count_agama as $index => $row)
					<tr>
						<td>{{ $row->get_agama->keterangan }}</td>
						<td>{{ $row->count }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Usia</h3>
			<canvas id="usia_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Rentang Usia</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($age_count as $index => $row)
					<tr>
						<td>{{ $row['nama'] }}</td>
						<td>{{ $row['count'] }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Pendidikan</h3>
			<canvas id="pendidikan_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Pendidikan</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($count_pendidikan as $index => $row)
					<tr>
						<td>{{ $row->get_pendidikan->keterangan }}</td>
						<td>{{ $row->count }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Status Hubungan dalam Keluarga</h3>
			<canvas id="status_hubungan_chart"></canvas>
			<br>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Status</th>
						<th>Jumlah Penduduk</th>
					</tr>
				</thead>
				<tbody>
				@foreach($count_status_hubungan as $index => $row)
					<tr>
						<td>{{ $row->get_status_hubungan->keterangan }}</td>
						<td>{{ $row->count }} orang</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div><br>

@endsection