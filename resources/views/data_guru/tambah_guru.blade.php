@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('guru.store')}}" method="POST">
            @csrf
            <input type="hidden" value="{{ Auth::user()->id }}" name="id_user">
            <input type="hidden" value="1" name="status">
            <input type="hidden" value="-" name="tgl_absen">
            <div>
                <label for="">NIP</label>
                <input class="form-control" type="text" name="nip" placeholder="Masukkan nip" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Nik</label>
                <input class="form-control" type="text" name="nik" placeholder="Masukkan NIK" aria-label="default input example"  required>
            </div>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Tempat Tanggal Lahir</label>
                <div class="row g-2">
                    <div class="col-6">
                        <input class="form-control" type="text" name="tempat" placeholder="Masukkan Tempat Lahir" aria-label="default input example" required>
                    </div>
                    <div class="col-6">
                        <input class="form-control" type="date" name="tgl" placeholder="Masukkan Tempat Lahir" aria-label="default input example" required>
                    </div>
                </div>
            </div>
            <div>
                <label for="">Agama</label>
                <select class="form-select" name="agama" aria-label="Default select example" required>
                    <option selected value="">--Pilih</option>
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
                <select class="form-select" name="jk" aria-label="Default select example" required>
                    <option selected value="">--Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
            </div>
            <div>
                <label for="">Alamat</label>
                <input class="form-control" type="text" name="alamat" placeholder="Masukkan alamat" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Wali kelas</label>
                <select name="wakel" class="form-control" required>
                    @foreach ($kelas as $kel)
                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                    @endforeach
                    <option value="BK">BK</option>
                </select>
            </div>
            <div>
                <label for="">Status</label>
                <select class="form-select" name="status1" aria-label="Default select example" required>
                    <option selected value="">--Pilih</option>
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