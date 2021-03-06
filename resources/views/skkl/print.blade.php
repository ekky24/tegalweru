<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

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
                    <center><p class="header">SURAT KETERANGAN KENAL LAHIR</p></center>
                    <center><p class="nomor">NO: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Tegalweru Kecamatan Dau Kabupaten Malang, menerangkan dengan benar bahwa:</p>
                    @include('layout.print')
                        <tr>
                            <td class="header">Keterangan</td>
                            <td>:</td>
                            <td>{{ strtoupper("Menerangkan bahwa orang  tersebut  diatas adalah anak kandung dari seorang Ibu yang bernama " . $surat->get_penduduk->ibu . ", istri sah dari seorang Bapak bernama " . $surat->get_penduduk->ayah . ".") }}</td>
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