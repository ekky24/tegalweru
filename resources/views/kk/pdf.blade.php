<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Data Kartu Keluarga Desa Tegalweru</title>
        <link href="{{ public_path() . '/css/pdf.css' }}" rel="stylesheet">

        <body>
  
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Data Kartu Keluarga Desa Tegalweru</h2></center>  
            </div>
            <br>
            <h5>RW: {{ $rw_choose }}</h5>
            <h5>RT: {{ $rt_choose }}</h5>
            <h5>Kata Kunci: {{ $q }}</h5>
            <table>
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nomor KK</th>
                        <th>NIK Kepala Keluarga</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody id="list_kk">
                @foreach($kk as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->id }}</td>

                            @if($row->kepala_keluarga != NULL)
                                <td>{{ $row->kepala_keluarga }}</td>
                            @else
                                <td>-</td>
                            @endif

                            <td>{{ $row->get_rt->nama }}</td>
                            <td>{{ $row->get_rw->nama }}</td>

                            <?php $count = 0 ?>
                            @foreach($row->get_penduduk as $row2)
                                <?php
                                    $count++;
                                ?>
                            @endforeach

                            <td>{{ $count . ' orang' }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </body>
    </head>
</html>