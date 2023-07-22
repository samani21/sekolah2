@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                   <div class="col-12">
                        <form action="{{route('harian/cetak')}}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Dari</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="dari" value="{{date('Y-m-d')}}" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Sampai</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="sampai" value="{{date('Y-m-d')}}" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      </div>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <input type="text" class="form-control" name="cari" placeholder="Cetak berdasarkan" aria-label="Recipient's username" aria-describedby="button-addon2">
                                </div>
                                <div class="col-2">
                                    <br>
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <form action="" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="Cari Tanggal" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                        </form>
                    </div>
                    {{-- <div class="col-4">
                        <a href="tambah_siswa" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
                    </div> --}}
                </div>
            </div>
            <div class="col-4">
                <div style="width: 100%">
                    <div id="reader1" width="300px"></div>
                </div>
            </div>
        </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead align="center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Jam</th>
                        <th scope="col">Tahun</th>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index=>$sis)
                            <tr>
                                <td data-title="No">{{ $index + $siswa->firstItem() }}</td>
                                <td data-title="Nama">{{$sis->nama}}</td>
                                <td data-title="Kelas">{{$sis->kelas}}</td>
                                <td data-title="Tanggal">{{$sis->tgl}}</td>
                                <td data-title="Jam">{{$sis->jam}}</td>
                                <td data-title="Tahun">{{$sis->tahun}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $siswa->links() }}
            </div>
        </div>
	</div>
@endsection