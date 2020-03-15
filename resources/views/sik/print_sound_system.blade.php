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
<html style="margin: 0; padding: 0;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Data surat Desa Karangwidoro</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">
    </head>
        <body style="margin: 0; padding: 0; line-height: 1; font-size: 11pt;">
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi" style="padding-left: 0.5cm; padding-right: 0.5cm">
                    <center><p class="header" style="margin-top: 20px; font-size: 12pt">{{ $surat->judul }}</p></center>
                    <center><p class="nomor" style="margin-bottom: 20px; font-size: 12pt">Nomor : {{ $surat->nomor }}</p></center>
                    <table style="margin-left: 0" width="100%" border="0">
                        <tr>
                            <td class="header">Pertimbangan</td>
                            <td>:</td>
                            <td>
                                <table style="margin-left: 0">
                                    <tr>
                                        <td>1</td>
                                        <td>Bahwa telah dipenuhi segala hal yang merupakan persyaratan formal, dalam rangka pelaksanaan kegiatan oleh pihak pemohon.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Bahwa kegiatan yang dilaksanakan dipandang tidak bertentangan dengan kebijakan Pemerintah Pusat pada umumnya, serta kebijaksanaan Pemerintah Daerah khususnya ditempat kegiatan dilaksanakan.</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Bahwa kegiatan yang dilaksanakan itu dimungkinkan untuk tidak menimbulkan kerawanan kamtibmas, terutama dalam lingkungan dimana kegiatan dilaksanakan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">Dasar</td>
                            <td>:</td>
                            <td>
                                <table style="margin-left: 0">
                                    <tr>
                                        <td>1</td>
                                        <td>Undang-Undang Republik Indonesia Nomor 2 Tahun 2002, tentang Kepolisian Negara Republik Indonesia.</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Juklak Kapolri No. Pol : Juklak/02/XII/1995 tanggal 29 Desember 1995 tentang perijinan dan Pemberitahuan masyarakat.</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Surat Rekomendasi dari {{ $surat->dari_pengantar }} setempat tanggal {{ $surat->tgl_pengantar }}.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">Memperhatikan</td>
                            <td>:</td>
                            <td>
                                Segala kebijakan Pemerintah sehubungan dengan adanya ketentuan-ketentuan peraturan yang berlaku untuk kegiatan tersebut.
                            </td>
                        </tr>
                    </table>
                    <center><p class="header" style="margin-top: 20px; font-size: 12pt">MEMBERIKAN IJIN</p></center>

                    <p class="text-justify body">Kepada :</p>
                    <table style="margin-left: 0">
                        <tr>
                            <td class="header">Nama Penanggung Jawab</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pekerjaan</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat</td>
                            <td>:</td>
                            <td>{{ $penduduk->get_kk->alamat }}</td>
                        </tr>
                    </table>
                    <p class="text-justify body">Untuk menyelenggarakan kegiatan sebagai berikut :</p>
                    <table style="margin-left: 0">
                        <tr>
                            <td class="header">1.   Bentuk/Dalam Rangka</td>
                            <td>:</td>
                            <td>{{ $surat->nama_acara }}</td>
                        </tr>
                        <tr>
                            <td class="header">2.   Hiburan</td>
                            <td>:</td>
                            <td>{{ $surat->hiburan }}</td>
                        </tr>
                        <tr>
                            <td class="header">3.   Hari dan Waktu</td>
                            <td>:</td>
                            <td>{{ strtoupper($hari . " Tanggal " . $tgl_acara->day . " " . $bulan_arr[$tgl_acara->month-1] . " " . $tgl_acara->year) }}</td>
                        </tr>
                        <tr>
                            <td class="header">4.   Tempat</td>
                            <td>:</td>
                            <td>{{ $surat->tempat_acara }}</td>
                        </tr>
                        <tr>
                            <td class="header">5.   Jumlah peserta/undangan</td>
                            <td>:</td>
                            @if($surat->jumlah_undangan != NULL)
                                <td>{{ $surat->jumlah_undangan . " Orang" }}</td>
                            @else
                                <td>{{ "- Orang" }}</td>
                            @endif
                        </tr>
                    </table>
                    <p class="header" style="margin-top: 20px; font-size: 12pt">DENGAN CATATAN</p>
                    <table style="margin-left: 0" width="100%" border="0">
                        <tr>
                            <td class="header">1.</td>
                            <td>Penanggung jawab wajib mentaati ketentuan – ketentuan sebagai berikut :</td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td style="text-align: left;">
                                <table style="margin-left: 0" width="100%">
                                    <tr>
                                        <td width="3%">a.</td>
                                        <td>Menjaga keamanan dan ketertiban umum dalam kegiatan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td style="text-align: left;">
                                <table style="margin-left: 0" width="100%">
                                    <tr>
                                        <td width="3%">b.</td>
                                        <td>Wajib mencegah supaya para peserta tidak melakukan kegiatan-kegiatan yang bertentangan ataupun penyimpangan dari tujuan kegiatan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td>
                                <table style="margin-left: 0" width="100%">
                                    <tr>
                                        <td width="3%">c.</td>
                                        <td>Wajib melaporkan 3 x 24 jam sebelum kegiatan dilaksanakan, kepada RT, RW dan Desa setempat dimana kegiatan dilaksanakan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td>
                                <table style="margin-left: 0" width="100%">
                                    <tr>
                                        <td width="3%">d.</td>
                                        <td>Wajib mentaati ketentuan lain yang diberikan oleh pejabat setempat berhubungan dengan kegiatan yang akan dilaksanakan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td>
                                <table style="margin-left: 0" width="100%">
                                    <tr>
                                        <td width="3%">e.</td>
                                        <td>Tidak membunyikan petasan / sejenisnya saat melaksanakan kegiatan.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="header">2.</td>
                            <td>Bilamana terdapat penyimpangan dan ataupun pelanggaran terhadap Ketentuan dalam Surat Ijin ini, maka petugas keamanan / kepolisian setempat dapat membubarkan, menghentikan ataupun mengambil tindakan </td>
                        </tr>
                        <tr>
                            <td class="header">3.</td>
                            <td>Surat keterangan / ijin ini diberikan kepada yang berkepentingan untuk dipergunakan sebagaimana mestinya kecuali dalam hal ini terdapat kekeliruan akan diralat seperlunya.</td>
                        </tr>
                        <tr>
                            <td class="header">4.</td>
                            <td>Setelah selesai pelaksanaan kegiatan, maka penanggung jawab agar memberikan laporan kepada RT, RW dan Pemerintah desa setempat yang memberikan Surat Ijin dalam waktu selambat-lambatnya 1 (satu) Minggu setelah kegiatan dimaksud.</td>
                        </tr>
                    </table><br><br>

                    <table class="bawah">
                        <tr>
                            <td><b>DIKELUARKAN DI : KARANGWIDORO</b></td>
                        </tr>
                        <tr>
                            <td style="text-decoration: underline;"><b>PADA TANGGAL : {{ strtoupper($waktu->day . " " . $bulan_arr[$waktu->month-1] . " " . $waktu->year) }}</b></td>
                        </tr>
                        @if($surat->get_penerbit->jabatan != 'KEPALA DESA')
                            <tr>
                                <td><b>A/N KEPALA DESA KARANGWIDORO</b></td>
                            </tr>
                            <tr>
                                <td><b>{{ strtoupper($surat->get_penerbit->jabatan) }}</b></td>
                            </tr>
                        @else
                            <tr>
                                <td><b>KEPALA DESA KARANGWIDORO</b></td>
                            </tr>
                        @endif
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td class="nama_pejabat"><b>{{ strtoupper($surat->get_penerbit->nama) }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
</html>