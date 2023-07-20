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
            <div class="col-8">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari Kelas" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            <div class="col-4">
                <a href="tambah_mapel" class="btn btn-success">Tambah mapel</a>
            </div>
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pelajaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapel as $index=>$ma)
                            <tr>
                                <td data-title="No">{{ $index + $mapel->firstItem() }}</td>
                                <td data-title="Nama Kelas" >{{$ma->mapel}}</td>
                                <td>
                                    <a href="edit_mapel/{{$ma->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    <a href="hapus_mapel/{{$ma->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $mapel->links() }}
            </div>
        </div>
	</div>
@endsection