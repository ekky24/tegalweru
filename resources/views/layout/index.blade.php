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
            <h1 class="page-header" id="dashboard">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-3">
            <select name="tahun" id="filter_tahun_sktm" class="form-control" style="width: 100%">
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
        <div class="form-group col-md-3 col-md-offset-3">
            <select name="bulan" id="filter_bulan_sktm" class="form-control" style="width: 100%">
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
    </div>
    
    <h3>Surat Ijin Keramaian</h3>
    <div class="row">
        <div class="col-md-6">
            <canvas id="sik_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="sik_dashboard_bulan"></canvas>
        </div>
    </div><br>


    <h3>Surat Keterangan Usaha</h3>

    <div class="row">
        <div class="col-md-6">
            <canvas id="sku_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="sku_dashboard_bulan"></canvas>
        </div>
    </div><br>

    <h3>Surat Keterangan Kehilangan</h3>
    <div class="row">
        <div class="col-md-6">
            <canvas id="skk_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="skk_dashboard_bulan"></canvas>
        </div>
    </div><br>

    <h3>Surat Kelahiran</h3>
    <div class="row">
        <div class="col-md-6">
            <canvas id="skd_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="skd_dashboard_bulan"></canvas>
        </div>
    </div><br>

    <h3>Surat Kematian</h3>
    <div class="row">
        <div class="col-md-6">
            <canvas id="kematian_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="kematian_dashboard_bulan"></canvas>
        </div>
    </div><br>

    <h3>Surat Domisili</h3>
    <div class="row">
        <div class="col-md-6">
            <canvas id="skdom_dashboard_tahun"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="skdom_dashboard_bulan"></canvas>
        </div>
    </div><br>

@endsection