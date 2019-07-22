<?php
    use Carbon\Carbon;

    $now = Carbon::now();
    $year = $now->year;

    $diff = $year - 2019;
    $count_year = 2019;

    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>

@extends('layout.master')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<h1 class="filter page-header">Buat Laporan Baru</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<form method="post" action="/laporan_penduduk" autocomplete="off" class="form-horizontal">
			{{ csrf_field() }}
			<div class="form-group">
				<label class="control-label col-sm-3">Tahun</label>
				<div class="col-sm-6">
					<select name="tahun" class="form-control" required>
						<?php
		                    do { 
		                        $diff = $year - $count_year;
		                    ?>
		                    @if($year == $count_year)
		                        <option value="{{ $count_year }}" selected>{{ $count_year }}</option>
		                    @else
		                        <option value="{{ $count_year }}">{{ $count_year }}</option>
		                    @endif
		                    
		                    <?php
		                        $count_year = $count_year + 1;
		                    } while ($diff != 0);
		                ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-3">Bulan</label>
				<div class="col-sm-6">
					<select name="bulan" class="form-control" required>
						@foreach($bulan_arr as $index => $row)
		                    <?php $i_temp = $index + 1; ?>
		                    @if($i_temp == $now->month)
		                        <option value="{{ $i_temp }}" selected>{{ $row }}</option>
		                    @else
		                        <option value="{{ $i_temp }}">{{ $row }}</option>
		                    @endif
		                @endforeach
					</select>
				</div>
			</div><br>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
		@include('layout.error')
	</div>
</div>


@endsection