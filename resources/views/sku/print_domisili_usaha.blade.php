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
                    <center><p class="header">SURAT KETERANGAN DOMISILI USAHA</p></center>
                    <center><p class="nomor">Nomor : {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan di bawah ini Kepala Desa Karangwidoro, Kecamatan Dau, Kabupaten Malang, menerangkan bahwa: </p>
                    <table>
                        <tr>
                            <td class="header">Nama Usaha</td>
                            <td>:</td>
                            <td><b>{{ $surat->nama_usaha }}</b></td>
                        </tr>
                        <tr>
                            <td class="header">Tahun Pendirian</td>
                            <td>:</td>
                            <td>{{ $surat->tahun_pendirian_usaha }}</td>
                        </tr>
                        <tr>
                            <td class="header">Bidang Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->bidang_usaha }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat Usaha</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_usaha }}</td>
                        </tr>
                        <tr>
                            <td class="header">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="header">Nama Pimpinan</td>
                            <td>:</td>
                            <td>{{ $surat->nama_pimpinan }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk_id }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alamat Pimpinan</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_pimpinan }}</td>
                        </tr>
                    </table>
                    <p class="text-justify body"><b>Menerangkan Bahwa: </b></p>

                    <p class="text-justify body">Nama Usaha <b>{{ $surat->nama_usaha }}</b> benar-benar berdomisili di {{ $surat->alamat_usaha }}.</p>
                
                    <p class="text-justify body">Demikian surat keterangan ini kami buat dengan sebenar-benarnya berdasarkan Surat Pengantar dari {{ $surat->dari_pengantar }} pada tanggal {{ $surat->tgl_pengantar }} untuk dapat dipergunakan sebagaimana mestinya.</p><br><br>

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