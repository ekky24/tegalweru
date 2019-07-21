<?php
    use Carbon\Carbon;

    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Kepindahan Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">
        <body>
  
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Surat Pindah Masuk Desa Karangwidoro</h2></center>  
            </div>
            <br>
            <h5>Tahun: {{ $tahun_choose }}</h5>
            @if($bulan_choose != "Semua Bulan")
                <h5>Bulan: {{ $bulan_arr[$bulan_choose - 1] }}</h5>
            @else
                <h5>Bulan: {{ $bulan_choose }}</h5>
            @endif
            <h5>Kata Kunci: {{ $search_term }}</h5>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama Pemohon</th>
                        <th>Alamat Asal</th>
                        <th>Alamat Tujuan</th>
                        <th>Alasan Pindah</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($surat as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->nama_pemohon }}</td>
                            <td>{{ $row->alamat_asal }}</td>
                            <td>{{ $row->alamat_tujuan }}</td>
                            <td>{{ $row->alasan_pindah }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </body>
    </head>
</html>