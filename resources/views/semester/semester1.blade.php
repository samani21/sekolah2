@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-12">
                    <form action="{{route("semester/semester1")}}" method="get">
                        <div class="row">
                            <div class="col-3">
                                <label for="">Kelas</label>
                                <select name="kelas" id="" class="form-control" required>
                                    <option value="{{$kelas}}">{{$kelas}}</option>
                                    @foreach ($kelas1 as $kel)
                                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="">MAPEL</label>
                                <select name="mapel" id="" class="form-control" required>
                                    <option value="{{$mapel}}">{{$mapel}}</option>
                                    @foreach ($mapel1 as $map)
                                        <option value="{{$map->mapel}}">{{$map->mapel}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="">Tahun Ajaran</label>
                                <select name="tahun" id="" class="form-control" required>
                                    <option value="{{$tahun}}">{{$tahun}}</option>
                                    @foreach ($tahun1 as $t)
                                        <option value="{{$t->tahun}}">{{$t->tahun}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <label for="">Semester</label>
                                <select name="semester" id="" class="form-control" required>
                                    <option value="{{$semester}}">{{$semester}}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <br>
                                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Cari</button>
                            </div>
                        </div>
                    </form>
                    <div>
                        <br>
                        <a href="cetak?kelas={{$kelas}}&mapel={{$mapel}}&tahun={{$tahun}}&semester={{$semester}}" class="btn btn-success"><i class="fa-solid fa-print"></i></a>
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
                            <th scope="col">Nilai latihan</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php
                           $no = 1
                       @endphp
                       @foreach ($nilai as $index=>$nil )
                        <tr>
                            <td data-title="No">{{ $index + $nilai->firstItem() }}</td>
                            <td data-title="NIS" >{{$nil->nis}}</td>
                            <td data-title="Nama" >{{$nil->nama}}</td>
                            <td data-title="Mapel" >{{$nil->mapel}}</td>
                            <td data-title="Kelas" >{{$nil->kelas}}</td>
                            <td data-title="Nilai tugas" >{{substr($nil->hasil,0,4)}}</td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
                {{ $nilai->links() }}
            </div>
        </div>
	</div>
@endsection