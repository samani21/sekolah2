    @extends('layouts.sidebar')

    @section('content')
    <?php
    if (Auth::user()->tahun == $tahun->tahun || Auth::user()->level == "Super_admin" || Auth::user()->level == "Guru" || Auth::user()->level == "Tata_usaha")
    {
        ?>
        <div class="container">
            <div class="row">
                @if (Auth::user()->level =="Guru" ||Auth::user()->level =="Guru"|| Auth::user()->level =="Tata_usaha" ||Auth::user()->level =="Super_admin")
                <div class="col-8">
                    <form action="{{route('siswa/cetak')}}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="cari" placeholder="cetak siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                                </div>
                            </div>
                            <div class="col-4">
                                <select class="form-select" name="tahun" aria-label="Default select example">
                                    <option value="">--Tahun ajaran</option>
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
                @endif
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
                @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                    <div class="col-4">
                        <a href="/siswa/export_excel" class="btn btn-success">EXPORT EXCEL</a>
                    </div>
                @endif
            </div>
                <hr>
                <div>
                    <table class="table table-secondary table-striped" id="no-more-tables">
                        <thead >
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NIk</th>
                            <th scope="col">Nama</th>
                            <th scope="col">TTL</th>
                            <th scope="col">Agama</th>
                            <th scope="col">JK</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kelas</th>
                            @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                <th scope="col">Point</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Rapot</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index=>$sis)
                                <tr>
                                    <td data-title="No">{{ $index + $siswa->firstItem() }}</td>
                                    <td data-title="NIS">{{$sis->nis}}</td>
                                    <td data-title="NIK">{{$sis->nik}}</td>
                                    <td data-title="Nama">{{$sis->nama}}</td>
                                    <td data-title="TTL">{{$sis->tempat}}, {{date('d-m-Y', strtotime($sis->tgl))}}</td>
                                    <td data-title="Agama">{{$sis->agama}}</td>
                                    <td data-title="Jenis Kelamin">{{$sis->jk}}</td>
                                    <td data-title="Alamat">{{$sis->alamat}}</td>
                                    <td data-title="Kelas">{{$sis->kelas}}</td>
                                    @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                    <td data-title="Point">{{$sis->poin}}</td>
                                    <td>
                                        <a href="edit_siswa/{{$sis->id}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                        <a href="hapus_siswa/{{$sis->id}}" class="btn btn-danger" onclick="javascript: return confirm('Konfirmasi data akan dihapus');"><i class="fa-solid fa-trash"></i> Hapus</a>
                                        @if ($g->wakel == "-" || $g->wakel == "BK" )
                                        <a href="/poin/tambah_point/{{$sis->id}}" class="btn btn-secondary" ><i class="fa-solid fa-plus"></i> Point</a>
                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                            if ($tahun->sem == 1) {
                                                ?>
                                                <a href="/akhir/cetak/{{$sis->id_user}}?kelas={{$sis->kelas}}&tahun={{$tahun->tahun}}&semester=1" class="btn btn-danger"><i class="fa-solid fa-print"></i> Sem1</a>
                                                <?php
                                            }else {
                                                ?>
                                                <a href="/akhir/cetak/{{$sis->id_user}}?kelas={{$sis->kelas}}&tahun={{$tahun->tahun}}&semester=1" class="btn btn-danger"><i class="fa-solid fa-print"></i> Sem1</a>
                                                <a href="/akhir/cetak/{{$sis->id_user}}?kelas={{$sis->kelas}}&tahun={{$tahun->tahun}}&semester=2" class="btn btn-danger"><i class="fa-solid fa-print"></i> Sem2</a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $siswa->links() }}
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
                    <label for="">Kelas</label>
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