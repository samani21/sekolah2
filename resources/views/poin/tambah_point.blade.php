@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('poin.store')}}" method="POST" >
            @csrf
            <input class="form-control" type="text" name="id_user" value="{{$siswa->id_user}}" aria-label="default input example" readonly>
            <input class="form-control" type="text" name="id_siswa" value="{{$siswa->id}}" aria-label="default input example" readonly>
            <input class="form-control" type="hidden" name="tahun" value="{{$tahun->tahun}}" aria-label="default input example" readonly>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" value="{{$siswa->nama}}" aria-label="default input example" required readonly>
            </div>
            <div>
                <label for="">Kelas</label>
                <input class="form-control" type="text" name="kelas" value="{{$siswa->kelas}}" aria-label="default input example" required readonly>
            </div>
            <div>
                <label for="">Poin</label>
                <input class="form-control" type="number" name="poin" placeholder="Masukkan pengurangan point" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input class="form-control" type="date" name="tgl" value="{{date('Y-m-d')}}" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Keterangan</label>
                <textarea class="form-control" id="" cols="30" rows="10" name="ket" placeholder="Masukkan Keterangan" required></textarea>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection