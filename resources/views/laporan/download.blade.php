<?php
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    use Carbon\Carbon;
    $waktu = Carbon::createFromFormat('Y-m-d', $laporan->laporan_bulan);
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Penduduk Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
        <center>
            <div style="font-family:Arial; font-size:12pt;">
                <h2>Jumlah Penduduk Desa Karangwidoro</h2>
                <h4>{{ $bulan_arr[$waktu->month - 1] . " " . $waktu->format('Y') }}</h4>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th colspan="3">Jumlah Penduduk Awal</th>
                        <th colspan="3">Jumlah Lahir</th>
                        <th colspan="3">Jumlah Meninggal</th>
                        <th colspan="3">Jumlah Pindah Masuk</th>
                        <th colspan="3">Jumlah Pindah Keluar</th>
                        <th colspan="3">Jumlah Penduduk Akhir</th>
                        <th colspan="3">Jumlah</th>
                    </tr>
                    <tr>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>L</th>
                        <th>P</th>
                        <th>L+P</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>KK</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                    <tr>
                        <td>{{ $penduduk_awal_l }}</td>
                        <td>{{ $penduduk_awal_p }}</td>
                        <td>{{ $penduduk_awal_l + $penduduk_awal_p }}</td>
                        <td>{{ $laporan->lahir_l }}</td>
                        <td>{{ $laporan->lahir_p }}</td>
                        <td>{{ $laporan->lahir_l + $laporan->lahir_p }}</td>
                        <td>{{ $laporan->mati_l }}</td>
                        <td>{{ $laporan->mati_p }}</td>
                        <td>{{ $laporan->mati_l + $laporan->mati_p }}</td>
                        <td>{{ $laporan->pindah_masuk_l }}</td>
                        <td>{{ $laporan->pindah_masuk_p }}</td>
                        <td>{{ $laporan->pindah_masuk_l + $laporan->pindah_masuk_p }}</td>
                        <td>{{ $laporan->pindah_keluar_l }}</td>
                        <td>{{ $laporan->pindah_keluar_p }}</td>
                        <td>{{ $laporan->pindah_keluar_l + $laporan->pindah_keluar_p }}</td>
                        <td>{{ $laporan->penduduk_akhir_l }}</td>
                        <td>{{ $laporan->penduduk_akhir_p }}</td>
                        <td>{{ $laporan->penduduk_akhir_l + $laporan->penduduk_akhir_p }}</td>
                        <td>{{ $laporan->rt }}</td>
                        <td>{{ $laporan->rw }}</td>
                        <td>{{ $laporan->kk }}</td>
                    </tr>
                </tbody>
            </table>
        </center>
        </body>
    </head>
</html>