<?php
    use Carbon\Carbon;

    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Surat Keterangan Kelahiran Desa Karangwidoro</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
  
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Surat Keterangan Kelahiran Desa Karangwidoro</h2></center>  
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
                        <th>NIK Ayah</th>
                        <th>Nama Ayah</th>
                        <th>Nama Anak</th>
                        <th>Waktu Kelahiran Anak</th>
                        <th>Nama Pejabat</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($surat as $index => $row)
                    <?php
                        $waktu = Carbon::createFromFormat('Y-m-d', $row->tgl_kelahiran);
                    ?>
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->nik_ayah }}</td>
                            <td>@if($row->get_penduduk_ayah != NULL) {{ $row->get_penduduk_ayah->nama }} @else {{ '-'}} @endif </td>
                            <td>{{ $row->nama_anak }}</td>
                            <td>{{ $waktu->format('d-m-Y') }}</td>
                            <td>{{ $row->get_penerbit->nama }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </body>
    </head>
</html>