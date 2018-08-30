@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Kenal Lahir</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $skkl->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $skkl->penduduk_id }}">{{ $skkl->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $skkl->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($skkl->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $skkl->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Keterangan</th>
			<td>{{ strtoupper("Ayah: " . $skkl->get_penduduk->ayah . ", Ibu: " . $skkl->get_penduduk->ibu) }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $skkl->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $skkl->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/skkl/{{ $skkl->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/skkl/{{ $skkl->id }}/download">Download</a><br><br>
	</center>
@endsection