@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('updatepengguna',$user->id)}}" method="POST">
            @csrf
            <div>
                <label for="">Nama</label>
                <input class="form-control" type="text" name="name" value="{{$user->name}}" placeholder="Masukkan NIK" aria-label="default input example" readonly>
            </div>
            <div>
                <label for="">Username</label>
                <input class="form-control" type="text" name="username" value="{{$user->username}}" placeholder="Masukkan NIK" aria-label="default input example" readonly>
            </div>
            @if (Auth::user()->level == "Siswa")
            <div>
                <label for="">Kelas</label>
                <input class="form-control" type="text" name="kelas" value="{{$user->kelas}}" placeholder="Masukkan NIK" aria-label="default input example" readonly>
            </div>
            @endif
            @if (Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha" || Auth::user()->level == "Guru")
                
                    <input class="form-control" type="hidden" name="kelas" value="{{$user->kelas}}" placeholder="Masukkan NIK" aria-label="default input example" readonly>
            @endif
            <div>
                <label for="">Password</label>
                <input class="form-control" type="password" name="password" value="{{$user->password1}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <input type="hidden" value="{{$user->level}}" name="level">
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection