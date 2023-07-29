@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('updatepoin',$poin->id)}}" method="POST" >
            @csrf
            <input class="form-control" type="text" name="id_user" value="{{$siswa->id_user}}" aria-label="default input example" readonly>
            <input class="form-control" type="text" name="id_siswa" value="{{$siswa->id}}" aria-label="default input example" readonly>
            <input class="form-control" type="text" name="tahun" value="{{$tahun->tahun}}" aria-label="default input example" readonly>
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" value="{{$siswa->nama}}" aria-label="default input example" readonly>
            </div>
            <div>
                <label for="">Poin</label>
                <input class="form-control" type="number" name="poin" value="{{$poin->poin}}" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input class="form-control" type="date" name="tgl" value="{{$poin->tgl}}" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Keterangan</label>
                <textarea class="form-control" id="" cols="30" rows="10" name="ket" placeholder="Masukkan Keterangan" required>{{$poin->ket}}</textarea>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection