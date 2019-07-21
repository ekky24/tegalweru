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
                    <center><p class="header">SURAT KETERANGAN PINDAH</p></center>
                    <center><p class="nomor">Nomor : {{ $surat->nomor }}</p></center>
                    <p class="text-justify body">Yang bertanda tangan dibawah ini Kepala Desa Karangwidoro  Kecamatan Dau Kabupaten Malang, menerangkan bahwa :</p>
                    
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
                            <td>{{ $penduduk->get_tempat_lahir->nama . ", " . $penduduk_lahir_dummy }}</td>
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
                        <tr>
                            <td class="header">Pindah Ke</td>
                            <td>:</td>
                            <td>{{ $surat->alamat_tujuan }}</td>
                        </tr>
                        <tr>
                            <td class="header">Alasan Pindah</td>
                            <td>:</td>
                            <td>{{ $surat->alasan_pindah }}</td>
                        </tr>
                        <tr>
                            <td class="header">Pengikut</td>
                            <td>:</td>
                            <td>{{ count($pengikut) }}</td>
                        </tr>
                    </table>

                    @if(count($pengikut) > 0)
                        <table width="100%" style="margin: 0; border-collapse: collapse; text-align: center;" border="1"><center>
                            <tr>
                                <th align="center">No.</th>
                                <th align="center">NAMA</th>
                                <th align="center">L/P</th>
                                <th align="center">ST. PERKAWINAN</th>
                                <th align="center">KETERANGAN</th>
                            </tr>
                            @foreach($pengikut as $i => $row)
                                <tr>
                                    <td align="center">{{ $i + 1 }}</td>
                                    <td align="center">{{ $row->get_penduduk->nama }}</td>
                                    <td align="center">{{ $row->get_penduduk->jk }}</td>
                                    <td align="center">{{ $row->get_penduduk->get_status_nikah->keterangan }}</td>
                                    <td align="center">{{ $row->get_penduduk->get_status_hubungan->keterangan }}</td>
                                </tr>
                            @endforeach
                        </center>
                        </table>
                    @endif

                    <p class="text-justify body">Demikian surat keterangan pindah ini dibuat dengan sebenarnya dan untuk dipergunakan sebagaimana mestinya.</p><br><br>

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
                                <td>&nbsp;</td>
                            </tr>
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