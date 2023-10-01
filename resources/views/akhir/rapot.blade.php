@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('akhir/rapot')}}" method="get">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Kelas</label>
                                    <select name="kelas" id="" class="form-control" required>
                                        <option value="{{$kelas}}">{{$kelas}}</option>
                                        @foreach ($nilai as $kel)
                                            <option value="{{$kel->kelas}}">{{$kel->kelas}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label for="">Tahun Ajaran</label>
                                    <select name="tahun" id="" class="form-control" required>
                                        <option value="{{$tahun}}">{{$tahun}}</option>
                                        @foreach ($nilai as $n)
                                            <option value="{{$n->tahun}}">{{$n->tahun}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1">
                                    <label for="">Semester</label>
                                    <select name="semester" id="" class="form-control" required>
                                        <option value="{{$kelas}}">{{$semester}}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <br>
                                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i>Cari</button>
                                </div>
                            </form>
                                <div class="col-3">
                                    <br>
                                    <a href="cetak/{{Auth::user()->id}}?kelas={{$kelas}}&tahun={{$tahun}}&semester={{$semester}}" class="btn btn-success"><i class="fa-solid fa-print"></i></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-secondary table-striped" id="no-more-tables">
            <thead>
                <th scope="col">No</th>
                <th scope="col">Mapel</th>
                <th scope="col">Nilai</th>
                <th scope="col">Kelas</th>
                <th scope="col">Tahun</th>
                <th scope="col">Semester</th>
            </thead>
            @php
                $no = 1
            @endphp
            <tbody>
                @foreach ($nilai as $nil)
                    <tr>
                        <td data-title="No">{{ $no++ }}</td>
                    <td data-title="Mapel">{{ $nil->mapel }}</td>
                    <td data-title="Nilai">{{ substr($nil->hasil,0,5) }}</td>
                    <td data-title="Kelas">{{ $nil->kelas }}</td>
                    <td data-title="Tahun">{{ $nil->tahun }}</td>
                    <td data-title="Semester">{{ $nil->semester }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection