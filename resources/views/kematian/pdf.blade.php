<?php
    use Carbon\Carbon;

    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Kematian Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
  
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Kematian Desa Tegalweru</h2></center>  
            </div>
            <br>
            <h5>Tahun: {{ $tahun_choose }}</h5>
            @if($bulan_choose != "Semua Bulan")
                <h5>Bulan: {{ $bulan_arr[$bulan_choose - 1] }}</h5>
            @else
                <h5>Bulan: {{ $bulan_choose }}</h5>
            @endif
            <h5>Kata Kunci: {{ $search_term }}</h5>
            <table>
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat Kematian</th>
                        <th>Waktu Kematian</th>
                        <th>Tempat Pemakaman</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($kematian as $index => $row)
                    <?php
                        $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $row->waktu_kematian);
                    ?>
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->penduduk_id }}</td>
                            <td>{{ $row->get_penduduk->nama }}</td>
                            <td>{{ $row->tempat_kematian }}</td>
                            <td>{{ $waktu->format('d-m-Y H:i') }}</td>
                            <td>{{ $row->tempat_pemakaman }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </body>
    </head>
</html>