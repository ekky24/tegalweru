<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari_arr = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");

    $tgl_acara = Carbon::createFromFormat('Y-m-d', $surat->tgl_acara);
    $image_path = '/img/kop.jpg';
    $css_path = '/css/print.css';

    $hari = strtoupper($hari_arr[$tgl_acara->format('N') - 1]);
    $now = Carbon::now();

    $lahir = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk->tgl_lahir);
    $diff = $now->diffInSeconds($lahir);
    $umur = ceil($diff / (365*24*60* 60));
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data surat Desa Karangwidoro</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">
    </head>
        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">{{ $surat->judul }}</p></center>
                    <center><p class="nomor">Nomor : {{ $surat->nomor }}</p></center>
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
                    <p class="text-justify body">Dengan ini menerangkan bahwa: </p>
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
                            <td class="header">Umur</td>
                            <td>:</td>
                            <td>{{ $umur . " Tahun" }}</td>
                        </tr>
                        <tr>
                            <td class="header">Jenis Kelamin</td>
                            <td>:</td>
                            @if($surat->get_penduduk->jk == 'L')
                                <td>{{ 'LAKI-LAKI' }}</td>
                            @else
                                <td>{{ 'PEREMPUAN' }}</td>
                            @endif
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
                    <p class="text-justify body">Orang tersebut di atas akan mempunyai Hajat: <span style="text-decoration: underline"><b>{{ $surat->nama_acara }}</b></span></p>
                    <p class="text-justify body">Dengan Hiburan: <span style="text-decoration: underline;"><b>{{ $surat->hiburan }}</b></span></p>
                    <p class="text-justify body">Yang dilaksanakan pada: </p>
                    <table style="min-width: 80%">
                        <tr>
                            <td class="header" style="width: 40%">Hari</td>
                            <td style="width: 5%">:</td>
                            <td>{{ $hari }}</td>
                        </tr>
                        <tr>
                            <td class="header" style="width: 40%">Tanggal</td>
                            <td style="width: 5%">:</td>
                            <td>{{ $tgl_acara->day . " " . $bulan_arr[$tgl_acara->month-1] . " " . $tgl_acara->year }}</td>
                        </tr>
                        <tr>
                            <td class="header" style="width: 40%">Jam</td>
                            <td style="width: 5%">:</td>
                            <td>{{ $surat->jam_acara }}</td>
                        </tr>
                        <tr>
                            <td class="header" style="width: 40%">Bertempat Di</td>
                            <td style="width: 5%">:</td>
                            <td>{{ $surat->tempat_acara }}</td>
                        </tr>
                    </table>
                    <p class="text-justify body">Surat Keterangan ini digunakan untuk <b>Permohonan/Pengajuan Ijin </b>pada Mapolsek Dau</p>

                    <p class="text-justify body">Demikian surat keterangan ini dibuat dengan sebenarnya dan yang bersangkutan dimohon bantuan sepenuhnya.</p><br>

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
                        <tr><td><br></td></tr>
                        <tr>
                            <td class="nama_pejabat">{{ $surat->get_penerbit->nama }}</td>
                        </tr>
                    </table>
                    <br><br><br><br><br><br><br><br><br><p class="text-justify body">Mengetahui: </p>
                    <table width="100%" style="margin-left: 0">
                        <tr>
                            <td style="text-align: left;">KAPOLSEK DAU</td>
                            <td style="text-align: center;">DANRAMIL DAU</td>
                            <td style="text-align: right;">CAMAT DAU</td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td><br></td>
                            <td><br></td>
                            <td><br></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">..................................</td>
                            <td style="text-align: center;">..................................</td>
                            <td style="text-align: right;">..................................</td>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
</html>