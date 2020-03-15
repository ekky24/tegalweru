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
    </head>
        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">{{ $surat->judul }}</p></center>
                    <center><p class="nomor">Nomor : {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan dibawah ini Kepala Desa Karangwidoro  Kecamatan Dau Kabupaten Malang menerangkan bahwa :</p>
                    
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td><b>{{ $surat->get_penduduk->nama }}</b></td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk_id }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ $penduduk->tempat_lahir . ", " . $penduduk_lahir_dummy }}</td>
                        </tr>
                        <tr>
                            <td class="header">Kewarganegaraan</td>
                            <td>:</td>
                            <td>
                                @if($penduduk->kewarganegaraan == 'WNI')
                                    {{ 'INDONESIA' }}
                                @else
                                    {{ 'WNA' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="header">Agama</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_agama->keterangan }}</td>
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
                            <td class="header">Status</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_status_nikah->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_jenis_pekerjaan->keterangan }}</td>
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
                
                    <p class="text-justify body"><b>Menerangkan bahwa.</b></p><br>
                    <table style="margin-left: 0">
                        <tr>
                            <td>1. </td>
                            <td>Orang tersebut di atas benar-benar penduduk Desa karangwidoro Kecamatan Dau Kabupaten Malang dan beradat istiadat baik.</td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td>Orang tersebut di atas telah kehilangan {{ $surat->keterangan }} </td>
                        </tr>
                    </table>

                    <p class="text-justify body">Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p><br><br>

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
                </div>
            </div>
        </body>
</html>