@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('pelanggaraan.store')}}" method="POST">
            @csrf
            <div>
                <label for="">Nama Pelanggaran</label>
                <input class="form-control" type="text" name="pelanggaran" placeholder="Masukkan Nama Pelanggaran" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Bobot</label>
                <input class="form-control" type="number" name="bobot"  aria-label="default input example"  required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection