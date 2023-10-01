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
    <h3 align="center">RAPORT SISWA</h3>
    <hr>
    <pre>
Nama     : {{$sis->nama}}
Kelas    : {{$kelas}}
Tahun    : {{$tahun}}
Semester : {{$semester}}
    </pre>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
                <tr align="center">
                    <th width="30">No</th>
                    <th width="100">Mapel</th>
                    <th width="70">Nilai</th>
                    <th width="90">Kelas</th>
                    <th width="100">Tahun</th>
                    <th width="70">Semester</th>
                    <th width="50">Huruf</th>
                </tr>
            </thead>
            @php
            $no = 1
            @endphp
            <tbody>
                @foreach ($nilai as $nil)
                    <tr>
                        <td >{{ $no++ }}</td>
                        <td >{{ $nil->mapel }}</td>
                        <td >{{ substr($nil->hasil,0,5) }}</td>
                        <td >{{ $nil->kelas }}</td>
                        <td >{{ $nil->tahun }}</td>
                        <td >Semester {{ $nil->semester }}</td>
                        <td >
                            <?php
                                if ($nil->hasil < 65 ) {
                                    echo "C";
                                }
                                if ($nil->hasil >= 65 AND $nil->hasil <75) {
                                    echo "B";
                                }
                                if ($nil->hasil >= 75 AND $nil->hasil <=100) {
                                    echo "B";
                                }
                            ?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($semester == 2)
            <?php
                if($nilai1 >= 4){
                    ?>
                    <p align="center">
                        <del>Naik</del> / Tetap di kelas
                       </p>
                    <?php
                }else {
                    ?>
                    <p align="center">
                        Naik / <del>Tetap di</del> kelas
                       </p>
                    <?php
                }
            ?>
        @endif
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