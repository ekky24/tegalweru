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
        <title>Data surat Desa Tegalweru</title>
        <link href="{{ public_path() . $css_path }}" rel="stylesheet">

        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">SURAT KETERANGAN USAHA</p></center>
                    <center><p class="nomor">NO: {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Tegalweru Kecamatan Dau Kabupaten Malang, menerangkan dengan benar bahwa:</p>

                    @include('layout.print')
                    
                    <p>Adalah  benar - benar mempunyai usaha {{ strtoupper($surat->jenis_usaha) }}. Ybs mempunyai areal garapan berupa:</p>
                    <table>
                        @if($surat->sendiri_sawah != NULL || $surat->sendiri_tegal != NULL)
                            <table>
                                <tr>
                                    <td style="width: 100px;">Tanah Sendiri</td>
                                    <td>:</td>
                                    <td><br>
                                    <table style="margin-left: 0;">
                            @if($surat->sendiri_sawah != NULL)
                                    <tr>
                                        <td style="width: 100px;">Tanah Sawah</td>
                                        <td>:</td>
                                        <td>{{ $surat->sendiri_sawah . " "}} m</td>
                                    </tr>
                            @endif
                            @if($surat->sendiri_tegal != NULL)
                                    <tr>
                                        <td style="width: 100px;">Tanah Tegal</td>
                                        <td>:</td>
                                        <td>{{ $surat->sendiri_tegal . " " }} m</td>
                                    </tr>
                            @endif
                                </table>
                                </td>
                                </tr>
                            </table>
                        @endif

                        @if($surat->sewa_sawah != NULL || $surat->sewa_tegal != NULL)
                            <table>
                                <tr>
                                    <td style="width: 100px;">Tanah Sewa</td>
                                    <td>:</td>
                                    <td><br>
                                    <table style="margin-left: 0;">
                            @if($surat->sewa_sawah != NULL)
                                    <tr>
                                        <td style="width: 100px;">Tanah Sawah</td>
                                        <td>:</td>
                                        <td>{{ $surat->sewa_sawah . " "}} m</td>
                                    </tr>
                            @endif
                            @if($surat->sewa_tegal != NULL)
                                    <tr>
                                        <td style="width: 100px;">Tanah Tegal</td>
                                        <td>:</td>
                                        <td>{{ $surat->sewa_tegal . " "}} m</td>
                                    </tr>
                            @endif
                                </table>
                                </td>
                                </tr>
                            </table>
                        @endif
                    </table>
                    <table>
                        <tr>
                            <td>Keperluan</td>
                            <td>:</td>
                            <td>{{ $surat->keperluan }}</td>
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