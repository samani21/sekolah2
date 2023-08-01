@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route('jurnal/cetak')}}" method="GET">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="dari" value="{{date('Y-m-d')}}" placeholder="cetak presensi" aria-label="Recipient's username" aria-describedby="button-addon2">
                                  </div>
                            </div>
                            sampai
                            <div class="col-md-3">
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
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Materi</th>
                            <th scope="col" width="100">Kegiatan</th>
                            <th scope="col"  width="100">Penilaian</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $index=>$jur)
                            <tr>
                                <td data-title="No">{{ $index + $jurnal->firstItem() }}</td>
                                <td data-title="Nama">{{$jur->nama}}</td>
                                <td data-title="Tanggal">{{$jur->tgl}}</td>
                                <td data-title="Jam">{{$jur->jam_mulai}} - {{$jur->jam_selesai}}</td>
                                <td data-title="Materi">{{$jur->materi}}</td>
                                <td data-title="Kegiatan">{{$jur->kegiatan}}</td>
                                <td data-title="Penilaian">{{$jur->penilaian}}</td>
                                <td>
                                    <a href="edit_jurnal/{{$jur->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus_jurnal/{{$jur->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $jurnal->links() }}
            </div>
        </div>
	</div>
@endsection