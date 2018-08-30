<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $waktu_lahir = Carbon::createFromFormat('Y-m-d H:i:s', $surat->waktu_lahir);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tgl_dummy = $waktu_lahir->day . " " . $bulan_arr[$waktu_lahir->month - 1] . " " . $waktu_lahir->year;

    $image_path = '/img/kop.jpg';
    $css_path = '/css/print.css';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Surat Desa Tegalweru</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">

        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">SURAT KETERANGAN</p></center>
                    <center><p class="nomor">NO: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Tegalweru Kecamatan Dau Kabupaten Malang, menerangkan dengan benar bahwa:</p>
                    @include('layout.print')
                        <tr>
                            <td class="header">Keperluan</td>
                            <td>:</td>
                            <td>{{ strtoupper("Untuk menerangkan bahwa orang tersebut di atas telah melahirkan seorang anak pada tanggal " . $tgl_dummy . " pukul " . $waktu_lahir->format('H:i') . " WIB yang bernama " . $surat->nama_anak . ". Anak tersebut benar-benar anak kandung dari pasangan suami/istri " . $surat->nama_suami . " dan " . $surat->get_penduduk->nama . ".") }}</td>
                        </tr>
                    </table>

                    <p class="text-justify body">Demikian surat keterangan ini dibuat dengan benar serta dipergunakan sebagaimana mestinya.</p><br><br>

                    <table class="bawah">
                        <tr>
                            <td>Tegalweru, {{ $waktu->day . " " . $bulan_arr[$waktu->month-1] . " " . $waktu->year }}</td>
                        </tr>
                        @if($surat->get_penerbit->jabatan != 'KEPALA DESA')
                            <tr>
                                <td>A/n Kepala Desa Tegalweru</td>
                            </tr>
                            <tr>
                                <td>{{ $surat->get_penerbit->jabatan }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>Kepala Desa Tegalweru</td>
                            </tr>
                        @endif
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td class="nama_pejabat">{{ $surat->get_penerbit->nama }}</td>
                        </tr>
                        <tr>
                            <td>{{ $surat->get_penerbit->id }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
    </head>
</html>