@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Statistik Penduduk</h1>
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
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Usia</h3>
			<canvas id="usia_chart"></canvas>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">Agama</h3>
			<canvas id="agama_chart"></canvas>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Status Pernikahan</h3>
			<canvas id="status_nikah_chart"></canvas>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">Kewarganegaraan</h3>
			<canvas id="kewarganegaraan_chart"></canvas>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">Status Penduduk</h3>
			<canvas id="status_chart"></canvas>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Pendidikan</h3>
			<canvas id="pendidikan_chart"></canvas>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Jenis Pekerjaan</h3>
			<canvas id="jenis_pekerjaan_chart"></canvas>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h3 class="text-center">Status Hubungan dalam Keluarga</h3>
			<canvas id="status_hubungan_chart"></canvas>
		</div>
	</div><br>

@endsection