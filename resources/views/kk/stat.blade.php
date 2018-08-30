@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Statistik Kartu Keluarga</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-center">RT</h3>
			<canvas id="rt_keluarga_chart"></canvas>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">RW</h3>
			<canvas id="rw_keluarga_chart"></canvas>
		</div>
	</div><br>
@endsection