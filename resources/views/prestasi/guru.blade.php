@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row">
            @if (Auth::user()->level =="Guru" ||Auth::user()->level =="Tata_usaha" ||Auth::user()->level =="Super_admin")
            <div class="col-12">
                <form action="{{route('prestasi/cetak')}}" method="GET">
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
            @endif
        </div>
        <div class="row">
            <div class="col-8">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            @if (Auth::user()->level =="Tata_usaha" ||Auth::user()->level =="Super_admin")
            <div class="col-4">
                <a href="tambah_guru" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Prestasi</a>
            </div>
            @endif
        </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead align="center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Hasil</th>
                        <th scope="col">Tingkat</th>
                        <th scope="col">Tahun</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Bukti</th>
                        @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                        <th scope="col">Aksi</th>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($prestasi as $index=>$pre)
                            <tr>
                                <td data-title="No">{{ $index + $prestasi->firstItem() }}</td>
                                <td data-title="Nama">{{$pre->nama}}</td>
                                <td data-title="Kegiatan">{{$pre->nm_kegiatan}}</td>
                                <td data-title="Hasil">{{$pre->capaian}}</td>
                                <td data-title="Tingkat">{{$pre->tingkat}}</td>
                                <td data-title="Tahun">{{$pre->tahun}}</td>
                                <td data-title="Waktu">{{$pre->waktu}}</td>
                                <td data-title="Bukti">{{$pre->bukti}}</td>
                                @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                <td>
                                    <a href="edit_guru/{{$pre->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus/{{$pre->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $prestasi->links() }}
            </div>
        </div>
	</div>
@endsection