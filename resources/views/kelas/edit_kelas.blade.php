@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('updatekelas',$kelas->id)}}" method="POST">
            @csrf
            <div>
                <label for="">Nama Kelas</label>
                <input class="form-control" type="text" name="nm_kelas" value="{{$kelas->nm_kelas}}" placeholder="Masukkan Nama kelas" aria-label="default input example" autofocus required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection