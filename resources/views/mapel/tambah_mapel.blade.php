@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('mapel.store')}}" method="POST">
            @csrf
            <div>
                <label for="">Mata pelajaran</label>
                <input class="form-control" type="text" name="mapel" placeholder="Masukkan Mata pelajaran" aria-label="default input example" autofocus required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection