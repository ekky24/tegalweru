@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Domisili Usaha</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $sku->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td>{{ $sku->penduduk_id }}</td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $sku->nama_pimpinan }}</td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td>{{ $sku->alamat_pimpinan }}</td>
		</tr>
		<tr>
			<th>Nama Usaha</th>
			<td>{{ $sku->nama_usaha }}</td>
		</tr>
		<tr>
			<th>Tahun Berdiri</th>
			<td>{{ $sku->tahun_pendirian_usaha }}</td>
		</tr>
		<tr>
			<th>Bidang Usaha</th>
			<td>{{ $sku->bidang_usaha }}</td>
		</tr>
		<tr>
			<th>Alamat Usaha</th>
			<td>{{ $sku->alamat_usaha }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $sku->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $sku->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/sku/{{ $sku->id }}/edit/{{ $sku->jenis_surat }}">Edit Data</a>
	<a class="btn btn-primary" href="/sku/{{ $sku->id }}/download/{{ $sku->jenis_surat }}">Download</a><br><br>
	</center>
@include('layout.success')
@endsection