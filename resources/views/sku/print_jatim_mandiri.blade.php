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
    </head>
        <body>
            <div class="size">
                <center><img src="{{ public_path() . $image_path }}"></center>
                <div class="isi">
                    <center><p class="header">SURAT KETERANGAN USAHA</p></center>
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
                    <p class="text-justify body">menerangkan dengan sebenarnya bahwa: </p>
                    @include('layout.print')

                    <tr>
                        <td>Keperluan</td>
                        <td>:</td>
                        <td>{{ $surat->keperluan }}</td>
                    </tr>
                    <tr>
                        <td>Memiliki Usaha</td>
                        <td>:</td>
                        <td>{{ $surat->nama_usaha }}</td>
                    </tr>
                    <tr>
                        <td>Tempat Usaha</td>
                        <td>:</td>
                        <td>{{ $surat->alamat_usaha }}</td>
                    </tr>
                    </table>
                
                    <p class="text-justify body">Demikian surat keterangan ini kami buat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p><br><br>

                    <table class="bawah-ybs">
                        @if($surat->get_penerbit->jabatan != 'KEPALA DESA')
                            <tr><td><br></td></tr>
                            <tr><td><br></td></tr>
                        @else
                            <tr><td><br></td></tr>
                        @endif
                        <tr>
                            <td>Yang bersangkutan</td>
                        </tr>
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr><td><br></td></tr>
                        <tr>
                            <td class="nama_pejabat">{{ $penduduk->nama }}</td>
                        </tr>
                    </table>
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