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
    <h3 align="center">LAPORAN DATA GURU</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='6'>NIk</th>
                <th width='100'>Nama</th>
                <th width='100'>TTL</th>
                <th width='50'>Jk</th>
                <th width='70'>Alamat</th>
                <th width='70'>Status</th>
                <th width='70'>Jabatan</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
                @foreach ($guru as $gur)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$gur->nik}}</td>
                        <td>{{$gur->nama}}</td>
                        <td>{{$gur->tempat}},{{date('d-m-Y', strtotime($gur->tgl))}}</td>
                        <td>{{$gur->jk}}</td>
                        <td>{{$gur->alamat}}</td>
                        <td>Pegawai {{$gur->status}}</td>
                        <td><?php
                            if ($gur->level == "Tata_usaha") {
                                echo "Tata Usaha";
                            }else {
                               if ($gur->level == "Super_admin") {
                                echo "Super Admin" ;
                               }
                               if ($gur->level == "Guru") {
                                echo ''.$gur->level.' / '.$gur->wakel.'' ;
                               }
                               
                            }
                        ?></td>
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