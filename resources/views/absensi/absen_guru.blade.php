@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('absensi/cetak_guru')}}" method="GET">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="">Dari</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="dari" value="{{date('Y-m-d')}}" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-md-5">
                            <label for="">Sampai</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="sampai" value="{{date('Y-m-d')}}" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" name="cari" placeholder="Cetak berdasarkan" aria-label="Recipient's username" aria-describedby="button-addon2">
                        </div>
                        <div class="col-5">
                            <select name="ta" class="form-control">
                                <option value="">Pilih tahun & semester</option>
                                @foreach ($ta as $t)
                                    <option value="{{$t->tahun}} {{$t->semester}}">{{$t->tahun}} Semester {{$t->semester}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-8">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Kelas" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            @foreach ($absen as $abs)
               <?php
                    if (strtotime($abs->tgl_absen) < strtotime(date('d-m-Y'))) {
                        ?>
                         <div class="col-4">
                            <a href="abs_guru/{{$abs->id}}" class="btn btn-success"><i class="fa-solid fa-clipboard-list"></i> Absen</a>
                        </div>
                        <?php
                    }else{
                    }
               ?>
            @endforeach
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam mulai</th>
                            <th scope="col">Jam selesai</th>
                            <th scope="col">Tahun ajaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absen_guru as $index=>$abs)
                            <tr>
                                <td data-title="No">{{ $index + $absen_guru->firstItem() }}</td>
                                <td data-title="NIP" >{{$abs->nip}}</td>
                                <td data-title="Nama" >{{$abs->nama}}</td>
                                <td data-title="Tanggal" >{{$abs->tgl}}</td>
                                <td data-title="Jam mulai" >{{$abs->jam_mulai}}</td>
                                <td data-title="Jam selesai" >{{$abs->jam_selesai}}</td>
                                <td data-title="Tahun" >{{$abs->tahun}}</td>
                                <td data-title="Aksi">
                                @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin")
                                    @if ($abs->jam_selesai == "-")
                                            <a href="/selesai/{{$abs->id}}" class="btn btn-success">Selesai</a>
                                    @endif
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $absen_guru->links() }}
            </div>
        </div>
	</div>
@endsection