<?php
    use Carbon\Carbon;

    $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $surat->created_at);
    $waktu_ayah = Carbon::createFromFormat('Y-m-d', $surat->tgl_lahir_ayah);
    $waktu_ibu = Carbon::createFromFormat('Y-m-d', $surat->tgl_lahir_ibu);
    $waktu_anak = Carbon::createFromFormat('Y-m-d', $surat->get_penduduk->tgl_lahir);
    
    $bulan_arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $tgl_ayah = $waktu_ayah->day . " " . $bulan_arr[$waktu_ayah->month - 1] . " " . $waktu_ayah->year;
    $tgl_ibu = $waktu_ibu->day . " " . $bulan_arr[$waktu_ibu->month - 1] . " " . $waktu_ibu->year;
    $tgl_anak = $waktu_anak->day . " " . $bulan_arr[$waktu_anak->month - 1] . " " . $waktu_anak->year;

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
                <div class="isi" style="line-height: 1" >
                    <center><p class="header" style="margin-top: 30px">SURAT KETERANGAN</p></center>
                    <center><p class="nomor" style="margin-bottom: 30px">NO: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Tegalweru Kecamatan Dau Kabupaten Malang, menerangkan dengan benar bahwa:</p>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $surat->nama_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($surat->tempat_lahir_ayah) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($tgl_ayah) }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $surat->agama_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->pekerjaan_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_ayah }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ strtoupper("Bahwa orang tersebut diatas setelah diadakan penelitian ternyata terdaftar / tidak terdaftar dalam buku OT / Walap.") }}</td>
                        </tr>
                    </table>
                    <p><b>Dengan Istri</b></p>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $surat->nama_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($surat->tempat_lahir_ibu) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($tgl_ibu) }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $surat->agama_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->pekerjaan_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_ibu }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ strtoupper("Bahwa orang tersebut diatas setelah diadakan penelitian ternyata terdaftar / tidak terdaftar dalam buku OT / Walap.") }}</td>
                        </tr>
                    </table>
                    <p><b><u>Adalah benar-benar orang tua dari:</u></b></p>
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($surat->get_penduduk->get_tempat_lahir->nama) }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ strtoupper($tgl_anak) }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->get_agama->keterangan }}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->get_kk->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ strtoupper("Bahwa orang tersebut diatas setelah diadakan penelitian ternyata terdaftar / tidak terdaftar dalam buku OT / Walap.") }}</td>
                        </tr>
                    </table>
                    <p>Surat Keterangan ini dipergunakan untuk : <b>{{ $surat->keperluan }}</b></p>
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