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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
        <h3 align="center">LAPORAN JURNAL MENGAJAR</h3>
        <?php
        if ($dari == "" && $sampai == "") {
            
        }else {
            ?>
        <pre>
    Periode tanggal {{$dari}} sampai {{$sampai}}
        </pre>
            <?php
        }
    ?>
        <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
            <thead>
            <tr align="center">
                <th width='auto'>No</th>
                <th width='70'>tanggal</th>
                <th width='70'>nip</th>
                <th width='70'>Nama</th>
                <th width='70'>Kelas</th>
                <th width='50'>MAPEL</th>
                <th width='70'>Jam</th>
                <th width='40'>Tahun</th>
                <th width='70'>Semeseter</th>
                <th width='50'>Materi</th>
                <th width='70'>Kegiatan</th>
                <th width='70'>Penilaian</th>
            </tr>
            </thead>
            <tbody>
                @php 
                $no=1;
            @endphp
                @foreach ($jurnal as $jur)
                <tr>
                    <td>{{$no++ }}</td>
                    <td>{{$jur->tgl}}</td>
                    <td>{{$jur->nip}}</td>
                    <td>{{$jur->nama}}</td>
                    <td>{{$jur->kelas}}</td>
                    <td>{{$jur->mapel}}</td>
                    <td>{{$jur->jam_mulai}} - {{$jur->jam_selesai}}</td>
                    <td>{{$jur->tahun}}</td>
                    <td>Semester {{$jur->semester}}</td>
                    <td>{{$jur->materi}}</td>
                    <td>{{$jur->kegiatan}}</td>
                    <td>{{$jur->penilaian}}</td>
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