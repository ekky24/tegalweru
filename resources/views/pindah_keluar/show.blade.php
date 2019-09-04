@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Pindah Keluar</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $pindah->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $pindah->penduduk_id }}">{{ $pindah->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $pindah->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($pindah->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $pindah->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			@if($penduduk->get_kk->alamat != NULL)
				<td>{{ $penduduk->get_kk->alamat }}</td>
			@else
				<td>-</td>
			@endif
		</tr>
		<tr>
			<th>Pindah Ke</th>
			<td>{{ $pindah->alamat_tujuan }}</td>
		</tr>
		<tr>
			<th>Alasan Pindah</th>
			<td>{{ $pindah->alasan_pindah }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $pindah->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $pindah->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<br><h2>Pengikut</h2>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIK</th>
				<th>Nama Lengkap</th>
				<th>Status Hubungan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pengikut as $index => $row)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td><a href="/penduduk/{{$row->get_penduduk->id}}"> {{ $row->get_penduduk->id }} </a></td>	
					<td>{{ $row->get_penduduk->nama }}</td>	
					<td>{{ $row->get_penduduk->get_status_hubungan->keterangan }}</td>		
				</tr>
			@endforeach
		</tbody>
	</table><br>
	<a class="btn btn-primary" href="/pindah_keluar/{{ $pindah->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/pindah_keluar/{{ $pindah->id }}/download">Download</a><br><br>
	</center>
@endsection