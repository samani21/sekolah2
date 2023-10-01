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
    <h3 align="center">LAPORAN NILAI TUGAS SISWA</h3>
    <hr>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
                <tr align="center">
                    <th width="20">No</th>
                    <th width="60">NIS</th>
                    <th width="120">Nama</th>
                    <th width="70">Mapel</th>
                    <th width="60">Kelas</th>
                    <th width="50">Nilai latihan</th>
                    <th width="110">Tahun ajaran</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1
                @endphp
                @foreach ($nilai as $nil )
                 <tr>
                     <td>{{ $no++}}</td>
                     <td>{{$nil->nis}}</td>
                     <td>{{$nil->nama}}</td>
                     <td>{{$nil->mapel}}</td>
                     <td>{{$nil->kelas}}</td>
                     <td>{{substr($nil->hasil,0,4)}}</td>
                     <td>{{$nil->tahun}} Semester{{$nil->semester}}</td>
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