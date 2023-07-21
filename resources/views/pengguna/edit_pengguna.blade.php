@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('updatepengguna',$pengguna->id)}}" method="POST">
            @csrf
            <div>
                <input type="hidden" name="status" value="{{$pengguna->status}}" id="">
                <label for="">Nama</label>
                <input class="form-control" type="text" name="name" value="{{$pengguna->name}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div>
                <label for="">Username</label>
                <input class="form-control" type="text" name="username" value="{{$pengguna->username}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div>
                <label for="">Password</label>
                <input class="form-control" type="password" name="password" value="{{$pengguna->password1}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div class="mb-3">
                <div>
                    <label>Status</label>
                    <select name="level" name="level" class="form-control">
                        <option value="{{$pengguna->level}}">{{$pengguna->level}}</option>
                        <option value="Guru">Guru</option>
                        <option value="Tata_usaha">Tata Usaha</option>
                        <option value="Siswa">Siswa</option>
                    </select>
                </div>
            </div>
                <input class="form-control" type="hidden" name="kelas" value="{{$user->kelas}}" placeholder="Masukkan NIK" aria-label="default input example">

            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection