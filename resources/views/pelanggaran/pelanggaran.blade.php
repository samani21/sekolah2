@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                {{-- <form action="{{route('guru/cetak')}}" method="GET">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari pelanggaran" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            <div class="col-4">
                <form action="cetak" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="cetak pelanggaran" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-warning" type="submit" id="button-addon2"><i class="fa-solid fa-print"></i></button>
                      </div>
                </form>
            </div>
            <div class="col-4">
                <a href="tambah" class="btn btn-success">Tambah data</a>
            </div>
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama pelanggaran</th>
                            <th scope="col">Bobot</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggaran as $index=>$pel)
                            <tr>
                                <td data-title="No">{{ $index + $pelanggaran->firstItem() }}</td>
                                <td data-title="Nama pelanggaran" >{{$pel->pelanggaran}}</td>
                                <td data-title="Bobot" >{{$pel->bobot}}</td>
                                <td>
                                    <a href="edit/{{$pel->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus/{{$pel->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pelanggaran->links() }}
            </div>
        </div>
	</div>
@endsection