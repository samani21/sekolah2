@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route("semester/semester1")}}" method="get">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Kelas</label>
                                    <select name="kelas" id="" class="form-control" required>
                                        <option value="">--Pilih kelas</option>
                                        @foreach ($kelas as $kel)
                                            <option value="{{$kel->kelas}}">{{$kel->kelas}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="">MAPEL</label>
                                    <select name="mapel" id="" class="form-control" required>
                                        <option value="">--Pilih kelas</option>
                                        @foreach ($mapel as $map)
                                            <option value="{{$map->mapel}}">{{$map->mapel}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="">Tahun Ajaran</label>
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value="">--Pilih tahun ajaran</option>
                                        @foreach ($nilai as $n)
                                            <option value="{{$n->tahun}}">{{$n->tahun}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <label for="">Semester</label>
                                    <select name="semester" id="" class="form-control" required>
                                        <option value="">--Pilih</option>
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
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection