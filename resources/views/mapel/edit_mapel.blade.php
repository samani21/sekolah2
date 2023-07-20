@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('updatemapel',$mapel->id)}}" method="POST">
            @csrf
            <div>
                <label for="">Mata Pelajaran</label>
                <input class="form-control" type="text" name="mapel" value="{{$mapel->mapel}}" aria-label="default input example" autofocus required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection