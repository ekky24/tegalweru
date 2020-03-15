<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari_arr = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");

    $tgl_kematian = Carbon::createFromFormat('Y-m-d', $surat->tgl_kematian);
    $image_path = '/img/kop.jpg';
    $css_path = '/css/print.css';

    $hari = strtoupper($hari_arr[$tgl_kematian->format('N') - 1]);
    $now = Carbon::now();

    $lahir_pelapor = Carbon::createFromFormat('Y-m-d', $pelapor->tgl_lahir);
    $diff_pelapor = $now->diffInSeconds($lahir_pelapor);
    $umur_pelapor = ceil($diff_pelapor / (365*24*60* 60));
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
                    <p class="text-justify body">Telah meninggal dunia pada:</p>
                    <table style="min-width: 60%">
                        <tr>
                            <td class="header">Hari</td>
                            <td>:</td>
                            <td>{{ $hari }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tanggal</td>
                            <td>:</td>
                            <td>{{ $tgl_kematian->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pukul</td>
                            <td>:</td>
                            <td>{{ $surat->jam_kematian . " WIB" }}</td>
                        </tr>
                        <tr>
                            <td class="header">Di</td>
                            <td>:</td>
                            <td>{{ $surat->tempat_kematian }}</td>
                        </tr>
                        <tr>
                            <td class="header">Disebabkan karena</td>
                            <td>:</td>
                            <td><b>{{ $surat->penyebab_kematian }}</b></td>
                        </tr>
                    </table>

                    <p class="text-justify body">Surat ini dibuat berdasarkan keterangan pelapor:</p>
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $pelapor->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $pelapor->id }}</td>
                        </tr>
                        <tr>
                            <td class="header">Umur</td>
                            <td>:</td>
                            <td>{{ $umur_pelapor . " TAHUN" }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $pelapor->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            @if($pelapor->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $pelapor->get_kk->alamat }}</td>
                            @endif
                        </tr>
                    </table>
                    <p class="text-justify body">Hubungan pelapor dengan yang meninggal: <b>{{ $surat->hubungan_pelapor }}</b></p>
                    <p class="text-justify body">Demikian surat keterangan ini kami buat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p><br><br>

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