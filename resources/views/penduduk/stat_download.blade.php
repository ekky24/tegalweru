<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Penduduk Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
        <center><h1 style="margin-bottom: 0">STATISTIK PENDUDUK KARANGWIDORO</h1></center>
        <center><h3 style="margin-top: 0">JUMLAH PENDUDUK AKTIF: {{ $count_penduduk }} ORANG</h3></center>
        <center>
            <div style="font-family:Arial; font-size:12pt;">
                <h2>Jumlah Penduduk Berdasarkan Agama</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Agama</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($agama_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
            
            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Status Pernikahan</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Status Nikah</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($status_nikah_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Pendidikan</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Pendidikan</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($pendidikan_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Jenis Pekerjaan</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Jenis Pekerjaan</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($jenis_pekerjaan_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Status Hubungan</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Status Hubungan</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($status_hubungan_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Jenis Kelamin</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Jenis Kelamin</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($jk_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan Usia</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Usia</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($usia_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan RW</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>RW</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($rw_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }} orang</td>
                            <td>{{ $row[2] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>

            <div style="font-family:Arial; font-size:12pt; margin-top: 80px;">
                <h2>Jumlah Penduduk Berdasarkan RT</h2>
            </div>
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>RW</th>
                        <th>RT</th>
                        <th>Jumlah</th>
                        <th>Prosentase</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($rt_arr as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }}</td>
                            <td>{{ $row[2] }} orang</td>
                            <td>{{ $row[3] }}%</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </center>
        </body>
    </head>
</html>