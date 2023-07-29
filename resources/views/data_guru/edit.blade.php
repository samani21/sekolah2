@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('ubahguru',$guru->id)}}" method="POST">
            @csrf
            <div>
                <label for="">NIP</label>
                <input class="form-control" type="text" name="nip" value="{{$guru->nip}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div>
                <label for="">Nik</label>
                <input class="form-control" type="text" name="nik" value="{{$guru->nik}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" name="nama" value="{{$guru->nama}}" placeholder="Masukkan Nama" aria-label="default input example">
            </div>
            <div>
                <label for="">Tempat Tanggal Lahir</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input class="form-control" type="text" name="tempat" value="{{$guru->tempat}}" placeholder="Masukkan Tempat Lahir" aria-label="default input example">
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="date" name="tgl" value="{{$guru->tgl}}" placeholder="Masukkan Tempat Lahir" aria-label="default input example">
                    </div>
                </div>
            </div>
            <div>
                <label for="">Agama</label>
                <select class="form-select" name="agama" aria-label="Default select example">
                    <option selected value="{{$guru->agama}}">{{$guru->agama}}</option>
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghucu">Khonghucu</option>
                  </select>
            </div>
            <div>
                <label for="">Jenis Kelamin</label>
                <select class="form-select" name="jk" aria-label="Default select example">
                    <option selected value="{{$guru->jk}}">{{$guru->jk}}</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control" type="text" name="alamat" value="{{$guru->alamat}}" placeholder="Masukkan alamat" aria-label="default input example">
            </div>
            @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha" )
                <?php 
                    if ($guru->wakel == "BK" || $guru->wakel == "-") {
                        ?>
                        <div>
                            <label for="">Wali kelas</label>
                            <input class="form-control" type="text" name="wakel" value="{{$guru->wakel}}" placeholder="Masukkan alamat" aria-label="default input example" readonly>
                        </div>
                        <?php
                    }else {
                        ?>
                        <div>
                            <label for="">Wali kelas</label>
                            <select name="wakel" class="form-control" required>
                                <option value="{{$guru->wakel}}">{{$guru->wakel}}</option>
                                @foreach ($kelas as $kel)
                                    <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <?php
                    }
                ?>
            @endif
            <div>
                <label for="">Status</label>
                <select class="form-select" name="status1" aria-label="Default select example" required>
                    <option selected value="{{$guru->status}}">{{$guru->status}}</option>
                    <option value="ASN">ASN</option>
                    <option value="Honor">Honor</option>
                  </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection