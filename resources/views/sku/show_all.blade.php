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
            <h1 class="filter page-header">Data Surat Keterangan Usaha</h1>
        </div>
    </div>
	@include('pindah.filter');

	<table class="table table-hover table-condensed table-bordered">
		<thead>
			<tr>
				<th>No. </th>
				<th>NIK</th>
				<th>Keperluan</th>
				<th>Pejabat Penerbit</th>
				<th>Waktu Pembuatan</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($sku as $index => $row)
			<?php
				$waktu = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
			?>
				<tr>
					<td>{{ ($sku->currentPage() - 1) * $sku->perPage() + $index + 1 }}</td>
					@if($row->jenis_surat == 'domisili_usaha')
						<td>{{ $row->penduduk_id }}</td>
					@else
						<td><a href="/penduduk/{{ $row->penduduk_id }}">{{ $row->penduduk_id }}</a></td>
					@endif
					
					@if(strlen($row->keperluan) > 40)
						<td>{{ substr($row->keperluan, 0, 40) . "..."}}</td>
					@else
						@if($row->keperluan != "")
							<td>{{ $row->keperluan }}</td>
						@else
							<td>-</td>
						@endif
					@endif					

					<td>{{ $row->get_penerbit->nama }}</td>
					<td>{{ strtoupper($bulan_arr[$waktu->month - 1] . " " . $waktu->format('Y')) }}</td>
					<td class="text-center"><a class="btn btn-primary" style="width: 70px" href="/sku/{{$row->id}}">Detail</a>
					<a id="hapus_kematian" class="btn btn-danger" style="width: 70px" href="/sku/{{$row->id}}/delete">Hapus</a>
					</td>
				</tr>
		@endforeach
		</tbody>
	</table>
	<center>
		{{ $sku->links() }}
	</center>
@endsection