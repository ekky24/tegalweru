<?php
	use Carbon\Carbon;
?>

@extends('layout.master')

@section('content')
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Detail Surat Keterangan Lunas PBB</h1>
        </div>
    </div>
	<center><table class="table table-bordered table-hover tabel_detail_penduduk">
		<tr>
			<th>Nomor Surat</th>
			<td>{{ $sklp->nomor }}</td>
		</tr>
		<tr>
			<th>NIK</th>
			<td><a href="/penduduk/{{ $sklp->penduduk_id }}">{{ $sklp->penduduk_id }}</a></td>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td>{{ $sklp->get_penduduk->nama }}</td>
		</tr>
		<tr>
			<th>Jenis Kelamin</th>
			@if($sklp->get_penduduk->jk == 'L')
				<td>{{ 'LAKI-LAKI' }}</td>
			@else
				<td>{{ 'PEREMPUAN' }}</td>
			@endif
		</tr>
		<tr>
			<th>Kewarganegaraan</th>
			<td>{{ $sklp->get_penduduk->kewarganegaraan }}</td>
		</tr>
		<tr>
			<th>Tahun Lunas PBB</th>
			<td>
				<?php
					$now = Carbon::now();
					$tahun = $now->year;
					for ($i=0; $i < $sklp->tahun_lunas; $i++) { 
						echo "$tahun";
						if ($i != $sklp->tahun_lunas-1) {
							echo ", ";
						}
						$tahun--;
					}
				?>
			</td>
		</tr>
		<tr>
			<th>Keperluan</th>
			<td>{{ $sklp->keperluan }}</td>
		</tr>
		<tr>
			<th>Nama Pejabat Penerbit</th>
			<td>{{ $sklp->get_penerbit->nama }}</td>
		</tr>
		<tr>
			<th>Jabatan Pejabat Penerbit</th>
			<td>{{ $sklp->get_penerbit->jabatan }}</td>
		</tr>
	</table>
	<a class="btn btn-primary" href="/sklp/{{ $sklp->id }}/edit">Edit Data</a>
	<a class="btn btn-primary" href="/sklp/{{ $sklp->id }}/download">Download</a><br><br>
	</center>
@endsection