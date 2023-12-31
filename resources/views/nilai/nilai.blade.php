@extends('layouts.sidebar')

@section('content')

    <?php
    if (Auth::user()->tahun == $tahun->tahun || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha") {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <form action="{{route('nilai/cetak_siswa')}}" method="GET">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari"  placeholder="cetak nilai siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
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
                            <input type="text" class="form-control" name="cari" placeholder="Cari Kelas" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                          </div>
                    </form>
                </div>
            </div>
            <hr>
                <div>
                    <table class="table table-secondary table-striped" id="no-more-tables">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                <th scope="col">Nama</th>
                                @endif
                                <th scope="col">Mapel</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam Absen</th>
                                <th scope="col">Tahun ajaran</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $index=>$pre)
                            <tr>
                                <td data-title="No">{{ $index + $presensi->firstItem() }}</td>
                                {{-- <td data-title="Nama Guru" >{{$pre->nama}}</td> --}}
                                @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                <td data-title="Nama" >{{$pre->nama}}</td>
                                @endif
                                <td data-title="Mapel" >{{$pre->mapel}}</td>
                                <td data-title="Kelas" >{{$pre->kelas}}</td>
                                <td data-title="Tanggal" >{{$pre->tgl}}</td>
                                <td data-title="Jam Absen" >{{$pre->jam}}</td>
                                <td data-title="Tahun" >{{$pre->tahun}}</td>
                                <td data-title="Semester" >Semester {{$pre->semester}}</td>
                                <td data-title="Nilai" >{{$pre->nilai}}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $presensi->links() }}
                </div>
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="container">
            <form action="{{url('updateke',$user->id)}}" method="POST">
                @csrf
                <div>
                    <label for="">NIS</label>
                    <select name="kelas" class="form-control" required>
                        <option value="">--pilih--</option>
                        @foreach ($kelas1 as $kel)
                            <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <?php
    }
?>
@endsection