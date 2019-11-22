<?php
	$bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

@extends('layout.master')

@section('content')
	<?php
		use Carbon\Carbon;
	?>
	
	<div class="row">
        <div class="col-lg-12">
            <h1 class="filter page-header">Data Surat Pindah Masuk</h1>
        </div>
    </div>
	@include('pindah.filter');

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>Nama Pemohon</th>
				<th>Alamat Asal</th>
				<th>Alamat Tujuan</th>
				<th>Waktu Pembuatan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($pindah as $index => $row)
			<?php
				$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
			?>
				<tr>
					<td>{{ ($pindah->currentPage() - 1) * $pindah->perPage() + $index + 1 }}</td>
					<td>{{ $row->nama_pemohon }}</td>
					
						@if(strlen($row->alamat_asal) > 40)
							<td>{{ substr($row->alamat_asal, 0, 40) . "..."}}</td>
						@else
							<td>{{ $row->alamat_asal }}</td>
						@endif			

						@if(strlen($row->alamat_tujuan) > 40)
							<td>{{ substr($row->alamat_tujuan, 0, 40) . "..."}}</td>
						@else
							<td>{{ $row->alamat_tujuan }}</td>
						@endif		
					<td>{{ strtoupper($bulan_arr[$waktu->month - 1] . " " . $waktu->format('Y')) }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/pindah_masuk/{{$row->id}}">Detail</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/pindah_masuk/{{$row->id}}/delete">Hapus</a>
					</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center>
		<!--<form action="/pindah_masuk/download" method="post" autocomplete="off">
			{{ csrf_field() }}
			<input type="hidden" name="surat_download" value="{{ $pindah_download }}" required>
			<input type="hidden" name="tahun_choose" value="{{ $tahun_choose }}" required>
			<input type="hidden" name="bulan_choose" value="{{ $bulan_choose }}" required>
			<input type="hidden" name="search_term" value="{{ $search_term }}" required>
			<input type="submit" class="btn btn-primary" value="Download">
		</form>-->
		{{ $pindah->links() }}
	</center>
@include('layout.success')
@endsection