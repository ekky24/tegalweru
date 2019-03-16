<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $penduduk_lahir = Carbon::createFromFormat('Y-m-d', $penduduk->tgl_lahir);
    $penduduk_lahir_dummy = strtoupper($penduduk_lahir->day . " " . $bulan_arr[$penduduk_lahir->month - 1] . " " . $penduduk_lahir->year);

    $image_path = '/img/kop.jpg';
    $css_path = '/css/print.css';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data surat Desa Tegalweru</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">

        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">SURAT KETERANGAN USAHA</p></center>
                    <center><p class="nomor" style="margin-bottom: 30px;">Nomor: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini: </p>
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $penerbit->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">Jabatan</td>
                            <td>:</td>
                            <td>Kepala Desa Karangwidoro Kecamatan Dau Kabupaten Malang</td>
                        </tr>
                    </table>
                    <p class="text-justify body">menerangkan dengan sebenarnya bahwa: </p>

                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk_id }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_tempat_lahir->nama . ", " . $penduduk_lahir_dummy }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            @if($surat->get_penduduk->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $surat->get_penduduk->get_kk->alamat }}</td>
                            @endif
                        </tr>
                    </table>
                    <p class="text-justify body">Orang tersebut mempunyai usaha: {{ $surat->nama_usaha }}</p>
                    <p class="text-justify body">Untuk usaha perdagangan *) Ybs mempunyai areal berupa: </p>
                    <table style="margin-left: 0px">
                        <tr>
                            <td class="bri_header">Tanah Sendiri</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Tanah Sawah</td>
                            <td>:</td>
                            @if($surat->sendiri_sawah != NULL)
                                <td>{{ $surat->sendiri_sawah . " " }}M <sup>2</sup></td>
                            @else
                                <td>- M<sup>2</sup></td>
                            @endif
                        </tr>
                        <tr>
                            <td>b. Tanah Tegal</td>
                            <td>:</td>
                            @if($surat->sendiri_tegal != NULL)
                                <td>{{ $surat->sendiri_tegal . " " }}M <sup>2</sup></td>
                            @else
                                <td>- M<sup>2</sup></td>
                            @endif
                        </tr>
                        <tr>
                            <td class="bri_header">Tanah Sewa</td>
                            <td>:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Tanah Sawah</td>
                            <td>:</td>
                            @if($surat->sewa_sawah != NULL)
                                <td>{{ $surat->sewa_sawah . " " }}M <sup>2</sup></td>
                            @else
                                <td>- M<sup>2</sup></td>
                            @endif
                        </tr>
                        <tr>
                            <td>b. Tanah Tegal</td>
                            <td>:</td>
                            @if($surat->sewa_tegal != NULL)
                                <td>{{ $surat->sewa_tegal . " " }}M <sup>2</sup></td>
                            @else
                                <td>- M<sup>2</sup></td>
                            @endif
                        </tr>
                    </table>

                    <p class="text-justify body">Demikian surat keterangan ini kami buat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

                    <table class="bawah">
                        <tr>
                            <td>Karangwidoro, {{ $waktu->day . " " . $bulan_arr[$waktu->month-1] . " " . $waktu->year }}</td>
                        </tr>
                        @if($surat->get_penerbit->jabatan != 'KEPALA DESA')
                            <tr>
                                <td>a/n Kepala Desa Karangwidoro</td>
                            </tr>
                            <tr>
                                <td>{{ $surat->get_penerbit->jabatan }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>Kepala Desa Karangwidoro</td>
                            </tr>
                        @endif
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td class="nama_pejabat">{{ $surat->get_penerbit->nama }}</td>
                        </tr>
                    </table><br><br><br><br><br>
                    <p class="text-justify body">Hasil Pemeriksaan Mantri: </p>
                    <table border=1 width='100%' class="bri-table">
                            <tr>
                                <th width="10%">No.</th>
                                <th width="20%">Tgl. Diperiksa</th>
                                <th width="50%">Keterangan Usaha saat dilakukan Pemeriksaan</th>
                                <th width="20%">Paraf Mantri</th>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    </table>
                </div>
            </div>
        </body>
    </head>
</html>