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
    <h3 align="center">LAPORAN DATA SISWA</h3>
        <table style="border-collapse:collapse;border-spacing:1;" border="0" align="center">
            @foreach ($guru as $g )
            
            <tr>
                <th>
                    NIP :
                </th> 
                <td>
                    {{$g->nip}}
                </td>
            </tr>
            <tr>
                <th>
                    NIK :
                </th> 
                <td>
                    {{$g->nik}}
                </td>
            </tr>
            <tr>
                <th>
                    Nama :
                </th> 
                <td>
                    {{$g->nama}}
                </td>
            </tr>
            <tr>
                <th>
                    TTL :
                </th> 
                <td>
                    {{$g->tempat}}, {{$g->tgl}}
                </td>
            </tr>
            <tr>
                <th>
                    Agama :
                </th> 
                <td>
                    {{$g->agama}}
                </td>
            </tr>
            <tr>
                <th>
                    Jenis Kelamin :
                </th> 
                <td>
                    {{$g->jk}}
                </td>
            </tr>
            <tr>
                <th>
                    Alamat :
                </th> 
                <td>
                    {{$g->alamat}}
                </td>
            </tr>
            <tr>
                <th>
                    Status :
                </th> 
                <td>
                   Pegawai {{$g->status}}
                </td>
            </tr>
            <tr>
                <th>
                    Jabatanan :
                </th> 
                <td>
                    <?php
                        if ($g->level == "Tata_usaha") {
                                echo "Tata Usaha";
                        }else {
                                echo $g->level;
                        }
                    ?>
                </td>
            </tr>
            @endforeach
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