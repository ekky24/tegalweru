<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Penduduk Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
  
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Penduduk Desa Tegalweru</h2></center>  
            </div>
            <br>
            <h5>Jenis Kelamin: {{ $jk_choose }}</h5>
            <h5>Tingkat Pendidikan: {{ $pendidikan_choose }}</h5>
            <h5>Jenis Pekerjaan: {{ $pekerjaan_choose }}</h5>
            <h5>Agama: {{ $agama_choose }}</h5>
            <h5>Status Hubungan: {{ $hubungan_choose }}</h5>
            <h5>Kata Kunci: {{ $search_term }}</h5>
            <table>
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor KK</th>
                        <th>Pendidikan</th>
                        <th>Jenis Pekerjaan</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($penduduk as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->nama }}</td>
                            @if($row->kk_id != NULL)
                                <td>{{ $row->kk_id }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>{{ $row->get_pendidikan->keterangan }}</td>
                            <td>{{ $row->get_jenis_pekerjaan->keterangan }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </body>
    </head>
</html>