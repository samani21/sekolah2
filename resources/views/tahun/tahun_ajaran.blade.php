@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('update')}}" method="POST">
            @csrf
            <div>
                <label for="">Tahun Ajaran</label>
                <input class="form-control" type="text" name="tahun" value="{{$tahun->tahun}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection