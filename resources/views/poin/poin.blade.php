@extends('layouts.sidebar')

@section('content')
<?php
if (Auth::user()->tahun == $tahun->tahun || Auth::user()->level == "Super_admin" || Auth::user()->level == "Guru" || Auth::user()->level == "Tata_usaha")
 {
    ?>
    <div class="container">
        <div class="row">
            {{-- @if (Auth::user()->level =="Guru" ||Auth::user()->level =="Guru"|| Auth::user()->level =="Tata_usaha" ||Auth::user()->level =="Super_admin") --}}
            <div class="col-8">
                <form action="{{route('poin/cetak')}}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="cetak siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="tahun" aria-label="Default select example" required>
                                @foreach ($ta as $t)
                                    <option value="{{$t->tahun}}">{{$t->tahun}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- @endif --}}
        </div>
        <div class="row">
            <div class="col-8">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
            {{-- <div class="col-4">
                <a href="tambah_siswa" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
            </div> --}}
        </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Point</th>
                        <th scope="col">Tahun Ajaran</th>
                        @if (Auth::user()->kelas == "-")
                            @if ($g->wakel == "BK" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                            <th scope="col">Aksi</th>
                            @endif
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($poin as $index=>$po)
                            <tr>
                                <td data-title="No">{{ $index + $poin->firstItem() }}</td>
                                <td data-title="NIS">{{$po->nis}}</td>
                                <td data-title="Nama">{{$po->nama}}</td>
                                <td data-title="Kelas">{{$po->kelas}}</td>
                                <td data-title="Keterangan">{{$po->ket}}</td>
                                <td data-title="Tanggal">{{$po->tgl}}</td>
                                <td data-title="Point">{{$po->poin}}</td>
                                <td data-title="Tahun Ajaran">{{$po->tahun}}</td>
                                @if (Auth::user()->kelas == "-")
                                    @if ($g->wakel == "BK" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                    <td>
                                        <a href="edit/{{$po->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <a href="hapus_poin/{{$po->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                    </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $poin->links() }}
            </div>
        </div>
	</div>
    <?php
}else{
    ?>
    <div class="container">
        <form action="{{url('updateke',$user->id)}}" method="POST">
            @csrf
            <div>
                <label for="">NIS</label>
                <select name="kelas" class="form-control" required>
                    <option value="">--pilih--</option>
                    @foreach ($kelas1 as $kel)
                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
    <?php
}
?>
@endsection