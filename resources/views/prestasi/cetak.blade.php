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
    @if ($jenis == 'guru')
    <h3 align="center">LAPORAN PRESTASi Guru</h3>
    <hr>
    {{-- <pre>
    Nama   : {{$sis->nama}}
    Nip    : {{$sis->nip}}
    Kelas  : {{Auth::user()->kelas}}
    </pre> --}}
    <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
        <thead>
        <tr align="center">
            <th width='auto'>No</th>
            <th width='50'>NIP</th>
            <th width='50'>Nama</th>
            <th width='90'>Nama kegiatan</th>
            <th width='80'>Hasil</th>
            <th width='70'>Tingkat</th>
            <th width='70'>Tahun</th>
            <th width='70'>Waktu</th>
            <th width='50'>Bukti</th>
        </tr>
        </thead>
        <tbody>
            @php 
            $no=1;
        @endphp
            @foreach ($prestasi as $pres)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$pres->nama}}</td>
                    <td>{{$pres->nip}}</td>
                    <td>{{$pres->nm_kegiatan}}</td>
                    <td>{{$pres->capaian}}</td>
                    <td>{{$pres->tingkat}}</td>
                    <td>{{$pres->tahun}}</td>
                    <td>{{$pres->waktu}}</td>
                    <td>{{$pres->bukti}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    
    @if ($jenis == '')
    <h3 align="center">LAPORAN PRESTASI GURU</h3>
   <?php
        if ($dari == "" && $sampai == "") {
            # code...
        }else {
            ?>
            <pre>
    Peridoe dari {{$dari}} sampai {{$sampai}}
            </pre>
            <?php
        }
   ?>
   <table style="border-collapse:collapse;border-spacing:1;" border="1" align="center">
    <thead>
    <tr align="center">
        <th width='auto'>No</th>
        <th width='50'>NIP</th>
        <th width='50'>Nama</th>
        <th width='90'>Nama kegiatan</th>
        <th width='80'>Hasil</th>
        <th width='70'>Tingkat</th>
        <th width='70'>Tahun</th>
        <th width='70'>Waktu</th>
        <th width='50'>Bukti</th>
    </tr>
    </thead>
    <tbody>
        @php 
        $no=1;
    @endphp
        @foreach ($prestasi as $pres)
            <tr>
                <td>{{$no++}}</td>
                <td>{{$pres->nama}}</td>
                <td>{{$pres->nip}}</td>
                <td>{{$pres->nm_kegiatan}}</td>
                <td>{{$pres->capaian}}</td>
                <td>{{$pres->tingkat}}</td>
                <td>{{$pres->tahun}}</td>
                <td>{{$pres->waktu}}</td>
                <td>{{$pres->bukti}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
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