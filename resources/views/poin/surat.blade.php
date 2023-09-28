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
    <h3 align="center">SURAT PANGGILAN ORANG TUA</h3>
    <hr>
<pre>
Kepada Yth.
Bapak/Ibu Orang Tua/Wali Murid

    Di-
        Tempat

    <i>Assalamualaikum Wr. Wb.</i>

    Bersama surat ini, kami pihak sekolah mengharapkan kehadiran 
    Bapak/Ibu/Wali Murid dari :
        NIS   : {{$siswa->nis}}
        Nama  : {{$siswa->nama}}
        Kelas : {{$kelas}}

    Yang akan dilakasanakan pada waktu dan tempat :
        Hari   : {{$surat->hari}}
        Tanggal: {{$surat->tgl}}
        Jam    : {{$surat->jam}}
        Tempat : {{$surat->tempat}}

    Mengingat pentingnya hal tersebut, kehadiran Bapak/Ibu/Wali Murid 
    sangat kamiharapkan.

    Demikian,dan atas kerjasamanya kami sampaikan terima kasih.

    Wassalamu’alaikum Wr.Wb.
</pre>
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