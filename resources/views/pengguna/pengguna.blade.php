@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            <div class="col-4">
                <a href="tambah_akun" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
            </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead align="center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($pengguna as $index=>$peng)
                            <tr>
                                <td data-title="No">{{ $index + $pengguna->firstItem() }}</td>
                                <td data-title="Nama">{{$peng->name}}</td>
                                <td data-title="Username">{{$peng->username}}</td>
                                <td data-title="Status"><?php
                                    if ($peng->level == "Tata_usaha") {
                                            echo "Tata Usaha";
                                    }else {
                                            echo $peng->level;
                                    }
                                ?></td>
                                <td align="center">
                                    <a href="edit_pengguna/{{$peng->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                    {{-- <a href="hapus_pengguna/{{$peng->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pengguna->links() }}
            </div>
        </div>
	</div>
@endsection