<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $tgl_lahir_nikah = Carbon::createFromFormat('Y-m-d', $surat->tgl_lahir_nikah);
    $tgl_lahir = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk->tgl_lahir);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tgl = $tgl_lahir_nikah->day . " " . $bulan_arr[$tgl_lahir_nikah->month - 1] . " " . $tgl_lahir_nikah->year;
    $tgl2 = $tgl_lahir->day . " " . $bulan_arr[$tgl_lahir->month - 1] . " " . $tgl_lahir->year;

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
                    <center><p class="header">SURAT KETERANGAN WALI NIKAH</p></center>
                    <center><p class="nomor">NO: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Tegalweru Kecamatan Dau Kabupaten Malang, menerangkan dengan benar bahwa:</p>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            @if($surat->get_penduduk->jk == 'L')
                                <td>{{ 'LAKI-LAKI' }}</td>
                            @else
                                <td>{{ 'PEREMPUAN' }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($tgl2) }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            @if($surat->get_penduduk->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $surat->get_penduduk->get_kk->alamat }}</td>
                            @endif
                        </tr>
                    </table>
                    <p>Adalah benar-benar wali nikah dari: </p>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $surat->nama_nikah }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>:</td>
                            <td>{{ $surat->tempat_lahir_nikah}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($tgl) }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $surat->agama_nikah }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->pekerjaan_nikah }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_nikah }}</td>
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