<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $waktu_lahir = Carbon::createFromFormat('Y-m-d', $surat->tgl_kelahiran);
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari_arr = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
    $tgl_dummy = $waktu_lahir->day . " " . $bulan_arr[$waktu_lahir->month - 1] . " " . $waktu_lahir->year;

    $image_path = '/img/kop.jpg';
    $css_path = '/css/print.css';

    $hari = strtoupper($hari_arr[$waktu_lahir->format('N') - 1]);
    $now = Carbon::now();

    $lahir_ibu = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk_ibu->tgl_lahir);
    $diff = $now->diffInSeconds($lahir_ibu);
    $umur_ibu = ceil($diff / (365*24*60* 60));

    $lahir_ayah = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk_ayah->tgl_lahir);
    $diff_ayah = $now->diffInSeconds($lahir_ayah);
    $umur_ayah = ceil($diff_ayah / (365*24*60* 60));

    $lahir_pelapor = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk_pelapor->tgl_lahir);
    $diff_pelapor = $now->diffInSeconds($lahir_pelapor);
    $umur_pelapor = ceil($diff_pelapor / (365*24*60* 60));
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data Surat Desa Tegalweru</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">

        <body style="line-height: 1.3; font-size: 11pt">
            <div class="size">
                <p style="font-size: 10pt; margin-bottom: 0"><b>Kode : F-2.02</b></p>
                <table style="font-size: 10pt; margin-left: 0; margin-top: 0">
                    <tr>
                        <td class="header">Pemerintah Kab./Kota</td>
                        <td>:</td>
                        <td>Malang</td>
                    </tr>
                    <tr>
                        <td class="header">Kecamatan</td>
                        <td>:</td>
                        <td>Dau</td>
                    </tr>
                    <tr>
                        <td class="header">Desa/Kelurahan</td>
                        <td>:</td>
                        <td>KARANGWIDORO</td>
                    </tr>
                </table>

                <div class="isi">
                    <center><p style="margin-top: 20px; margin-bottom: 0">UNTUK YANG BERSANGKUTAN</p></center>
                    <center><p class="header" style="margin-top: 0">{{ $surat->judul }}</p></center>
                    <center><p class="nomor" style="margin-bottom: 20px;">No: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertandatangan dibawah ini Kepala Desa Karangwidoro Kecamatan Dau Kabupaten Malang menerangkan bahwa pada :</p>
                    <table>
                        <tr>
                            <td class="header">Hari</td>
                            <td>:</td>
                            <td>{{ $hari }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tanggal</td>
                            <td>:</td>
                            <td>{{ $waktu_lahir->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pukul</td>
                            <td>:</td>
                            <td>{{ $surat->jam_kelahiran . " WIB" }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tempat Kelahiran</td>
                            <td>:</td>
                            <td>{{ $surat->tempat_kelahiran }}</td>
                        </tr>
                        <tr>
                            <td class="header">Telah lahir seorang anak</td>
                            <td>:</td>
                            @if($surat->jk_anak == 'L')
                                <td>{{ 'LAKI-LAKI' }}</td>
                            @else
                                <td>{{ 'PEREMPUAN' }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="header">Anak ke</td>
                            <td>:</td>
                            <td>{{ $surat->anak_ke }}</td>
                        </tr>
                        <tr>
                            <td class="header">Bernama</td>
                            <td>:</td>
                            <td style="border: 1px solid black; text-align: center;">
                                <b>{{ $surat->nama_anak }}</b>
                            </td>
                        </tr>
                    </table>
                    <p class="text-justify body">Dari seorang ibu:</p>
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_ibu->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->nik_ibu }}</td>
                        </tr>
                        <tr>
                            <td class="header">Umur</td>
                            <td>:</td>
                            <td>{{ $umur_ibu . " Tahun"}}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_ibu->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            @if($surat->get_penduduk_ibu->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $surat->get_penduduk_ibu->get_kk->alamat }}</td>
                            @endif
                        </tr>
                    </table>

                    <p class="text-justify body">Istri dari:</p>
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_ayah->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->nik_ayah }}</td>
                        </tr>
                        <tr>
                            <td class="header">Umur</td>
                            <td>:</td>
                            <td>{{ $umur_ayah . " Tahun"}}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_ayah->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            @if($surat->get_penduduk_ayah->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $surat->get_penduduk_ayah->get_kk->alamat }}</td>
                            @endif
                        </tr>
                    </table>

                    <p class="text-justify body">Surat Keterangan ini di buat berdasarkan keterangan pelapor:</p>
                    <table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_pelapor->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->nik_pelapor }}</td>
                        </tr>
                        <tr>
                            <td class="header">Umur</td>
                            <td>:</td>
                            <td>{{ $umur_pelapor . " Tahun"}}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk_pelapor->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            @if($surat->get_penduduk_pelapor->get_kk == null)
                                <td>{{ "-" }}</td>
                            @else
                                <td>{{ $surat->get_penduduk_pelapor->get_kk->alamat }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="header">Hubungan Pelapor</td>
                            <td>:</td>
                            <td>{{ $surat->hubungan_pelapor }}</td>
                        </tr>
                    </table><br><br>

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
    </head>
</html>