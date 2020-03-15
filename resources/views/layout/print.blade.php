<?php
    use Carbon\Carbon;
    $penduduk_lahir = Carbon::createFromFormat('Y-m-d', $penduduk->tgl_lahir);
    $penduduk_lahir_dummy = strtoupper($penduduk_lahir->day . " " . $bulan_arr[$penduduk_lahir->month - 1] . " " . $penduduk_lahir->year);
?>

<table>
                        <tr>
                            <td class="header">Nama</td>
                            <td>:</td>
                            <td>{{ $surat->get_penduduk->nama }}</td>
                        </tr>
                        <tr>
                            <td class="header">Tempat, Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ $penduduk->tempat_lahir . ", " . $penduduk_lahir_dummy }}</td>
                        </tr>
                        <tr>
                            <td class="header">NIK</td>
                            <td>:</td>
                            <td>{{ $surat->penduduk_id }}</td>
                        </tr>
                        <tr>
                            <td class="header">Suku/Bangsa</td>
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
                            <td class="header">Status Perkawinan</td>
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
                    