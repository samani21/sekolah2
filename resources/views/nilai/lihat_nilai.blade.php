@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-8">
                        <form action="{{route('absensi/cetak_presensi',[$id,$mapel])}}" method="GET">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="cari" placeholder="cetak" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      </div>
                                </div>
                                <div class="col-md-4">
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
                                <input type="text" class="form-control" name="cari" placeholder="Cari" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tahun ajaran</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $index=>$pre)
                        <tr>
                            <td data-title="No">{{ $index + $presensi->firstItem() }}</td>
                            <td data-title="NIS" >{{$pre->nis}}</td>
                            <td data-title="Nama" >{{$pre->nama}}</td>
                            <td data-title="Mapel" >{{$pre->mapel}}</td>
                            <td data-title="Kelas" >{{$pre->kelas}}</td>
                            <td data-title="Tanggal" >{{$pre->tgl}}</td>
                            <td data-title="Jam" >{{$pre->jam}}</td>
                            <td data-title="Tahun" >{{$pre->tahun}}</td>
                            <td>
                               <?php
                                    if ($pre->status == 0) {
                                        ?>
                                         <form action="{{route('tambah_nilai',$pre->absen)}}" method="post">
                                            @csrf
                                            <input type="hidden" class="form-control" name="mapel" value="{{$pre->mapel}}">
                                            <input type="hidden" class="form-control" name="id_presensi" value="{{$pre->id}}">
                                            <input type="hidden" class="form-control" name="guru" value="{{$pre->guru}}">
                                            <input type="hidden" class="form-control" name="siswa" value="{{$pre->siswa}}">
                                            <input type="hidden" class="form-control" name="tgl" value="{{date('Y-m-d')}}">
                                            <input type="hidden" class="form-control" name="tahun" value="{{$pre->tahun}}">
                                            <input type="hidden" class="form-control" name="semester" value="{{$pre->semester}}">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="nilai">
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php
                                    }else {
                                        ?>
                                           <form action="{{route('update_nilai',$pre->absen)}}" method="post">
                                            @csrf
                                            <input type="hidden" class="form-control" name="mapel" value="{{$pre->mapel}}">
                                            <input type="hidden" class="form-control" name="id_presensi" value="{{$pre->id}}">
                                            <input type="hidden" class="form-control" name="siswa" value="{{$pre->siswa}}">
                                            <input type="hidden" class="form-control" name="siswa" value="{{$pre->siswa}}">
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="nilai" value="{{$pre->nilai}}">
                                                </div>
                                                <div class="col-6">
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                            </div>
                                        </form>
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