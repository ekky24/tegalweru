@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Statistik Penduduk Berdasarkan Tempat Tinggal</h1>
        </div>
    </div>

	<center><br><h2>Jumlah Warga Berdasarkan RW</h2>
	<table class="table table-bordered table-hover">
		<?php $count_rw = 0; ?>
		<thead>
			<tr>
				<th>Nama RW</th>
				<th>Jumlah Penduduk</th>
			</tr>
		</thead>
		<tbody>
		@foreach($count_rw_keluarga as $row)
			<?php $count_rw += $row->count ?>
			<tr>
				<td>RW {{ $row->get_rw->nama }}</td>
				<td>{{ $row->count }} orang</td>
			</tr>
		@endforeach
		<tr>
			<th>TOTAL</th>
			<th>{{ $count_rw }} orang</th>
		</tr>
		</tbody>
	</table></center>

	<center><br><h2>Jumlah Warga Berdasarkan RT</h2>
	<table class="table table-bordered table-hover">
		<?php $count_rt = 0; ?>
		<thead>
			<tr>
				<th>Nama RW</th>
				<th>Nama RT</th>
				<th>Jumlah Penduduk</th>
			</tr>
		</thead>
		<tbody>
		@foreach($count_rt_keluarga as $row)
			<?php $count_rt += $row->count ?>
			<tr>
				<td>RW {{ $row->get_rw->nama }}</td>
				<td>RT {{ $row->get_rt->nama }}</td>
				<td>{{ $row->count }} orang</td>
			</tr>
		@endforeach
		<tr>
			<th colspan="2">TOTAL</th>
			<th>{{ $count_rw }} orang</th>
		</tr>
		</tbody>
	</table></center>
@endsection