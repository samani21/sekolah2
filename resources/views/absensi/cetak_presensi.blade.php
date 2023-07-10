<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <td align="left">
                <img src="{{public_path('css/Kayuh_Baimbai.png')}}" width='100' height='90'>
            </td>
            <td align="center">
                <p align="center">
                    <b>PEMERINTAH KOTA BANJARMASIN
                        <br>DINAS PENDIDIKAN DAN KEBUDAYAAN
                        <br>SMA NEGRI 9 BANJARMASIN</b><br>
                        JL. TATAH BANGKAL LUAR NO. 1 RT.32, Kelayan Timur, Kec. Banjarmasin Selatan <br>
                        <a href="http://sman9banjarmasin.sch.id">http://sman9banjarmasin.sch.id</a>,Email:sman9.bjm@gmail.com
                </p>
            </td>
            <td>
                <img src="{{public_path('css/sman9banjarmasin.png')}}" width='100' height='90'
                    style="padding-right: 100%">
            </td>
        </thead>
    </table>
    <hr>
    @foreach ($guru as $g)
    <table>
        <tr align="left">
            <th>Nama Guru :</th>
            <td>{{$g->nama}}</td>
        </tr>
        <tr align="left">
            <th>MAPEL :</th>
            <td>{{$g->mapel}}</td>
        </tr>
        <tr align="left">
            <th>Kelas :</th>
            <td>{{$g->kelas}}</td>
        </tr>
        <tr align="left">
            <th>Tanggal :</th>
            <td>{{$g->tgl}}</td>
        </tr>
    </table>
    @endforeach
    <hr>
    <h3 align="center">LAPORAN ABSEN SISWA PER MAPEL</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='50'>NIS</th>
                <th width='100'>Nama</th>
                <th width='50'>jam</th>
                <th width='70'>Tahun Ajaran</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp 
                @foreach ($presensi as $sis)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$sis->nis}}</td>
                        <td>{{$sis->nama}}</td>
                        <td>{{$sis->jam}}</td>
                        <td>{{$sis->tahun}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <pre align="right">
                                                Banjarmasin,<?php echo date('d-m-Y'); ?>
                                                    Kepala Sekolah






                                                    Nama KEPSEK
                                                    NIP KEPSEK



                            
                           

                                                   
            </pre>
        </div>
</body>
</html>