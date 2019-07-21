@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Pindah Masuk</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $pindah->nomor }}</td>
		</tr>
		<tr>
			<th>Nama Pemohon</th>
			<td>{{ $pindah->nama_pemohon }}</td>
		</tr>
		<tr>
			<th>Kartu Keluarga Lama</th>
			<td>{{ $pindah->kk_lama }}</td>
		</tr>
		<tr>
			<th>Alamat Asal</th>
			<td>{{ $pindah->alamat_asal }}</td>
		</tr>
		<tr>
			<th>Alamat Tujuan</th>
			<td>{{ $pindah->alamat_tujuan }}</td>
		</tr>
		<tr>
			<th>Alasan Pindah</th>
			<td>{{ $pindah->alasan_pindah }}</td>
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
	<a class="btn btn-primary" href="/pindah_masuk/{{ $pindah->id }}/edit">Edit Data</a>
	</center>
@endsection