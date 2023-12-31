@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('absensi/cetak_mapel')}}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="dari" value="{{date('Y-m-d')}}" placeholder="cetak presensi" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="sampai" value="{{date('Y-m-d')}}" placeholder="cetak presensi" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="cetak presensi" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Presensi" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            @foreach ($guru as $g)
            <div class="col-4">
                <a href="tambah_presensi/{{$g->id}}" class="btn btn-success"><i class="fa-solid fa-clipboard-list"></i> Presensi</a>
            </div>
            @endforeach
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Guru</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">kelas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam mulai</th>
                            <th scope="col">Jam selesai</th>
                            <th scope="col">Tahun ajaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $index=>$pre)
                            <tr>
                                <td data-title="No">{{ $index + $presensi->firstItem() }}</td>
                                <td data-title="Nama Guru" >{{$pre->nama}}</td>
                                <td data-title="Mapel" >{{$pre->mapel}}</td>
                                <td data-title="Kelas" >{{$pre->kelas}}</td>
                                <td data-title="Tanggal" >{{$pre->tgl}}</td>
                                <td data-title="Jam mulai" >{{$pre->jam_mulai}}</td>
                                <td data-title="Jam selesai" >{{$pre->jam_selesai}}</td>
                                <td data-title="Tahun" >{{$pre->tahun}}</td>
                                <td data-title="Status" >    
                                    <?php if ($pre->s_nilai == 1) {
                                    ?>
                                       Tugas
                                    <?php
                                 }
                                 if ($pre->s_nilai == 0) {
                                    ?>
                                        Absen
                                    <?php
                                 }
                                 if ($pre->s_nilai == 2) {
                                     ?>
                                        UTS
                                    <?php
                                 }
                                 if ($pre->s_nilai == 3) {
                                    ?>
                                        UAS
                                    <?php
                                 }
                             ?></td>
                                <td>
                                    <a href="edit_presensi/{{$pre->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus_presensi/{{$pre->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                    <a href="lihat_presensi/{{$pre->id}}/{{$pre->mapel}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Lihat</a>
                                    <?php
                                        if ($pre->s_nilai == 1) {
                                            ?>
                                            <a href="/nilai/lihat_nilai/{{$pre->id}}/{{$pre->mapel}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i>Nilai</a>
                                            <?php
                                        }
                                    ?>
                                    <?php
                                    if ($pre->s_nilai == 2) {
                                        ?>
                                        <a href="/nilai/lihat_nilai/{{$pre->id}}/{{$pre->mapel}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i>Nilai</a>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($pre->s_nilai == 3) {
                                        ?>
                                        <a href="/nilai/lihat_nilai/{{$pre->id}}/{{$pre->mapel}}" class="btn btn-secondary"><i class="fa-solid fa-plus"></i>Nilai</a>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if ($pre->s_jurnal == 0) {
                                        ?>
                                        <a href="/jurnal/tambah_jurnal/{{$pre->id}}" class="btn btn-success"><i class="fa-solid fa-plus"></i>Jurnal</a>
                                        <?php
                                        }
                                    ?>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $presensi->links() }}
            </div>
        </div>
	</div>
@endsection