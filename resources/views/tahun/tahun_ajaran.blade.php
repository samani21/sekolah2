@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('update')}}" method="POST">
            @csrf
            <div>
                <label for="">Tahun Ajaran</label>
                <input class="form-control" type="text" name="tahun" value="{{$tahun->tahun}}" placeholder="Masukkan NIK" aria-label="default input example">
            </div>
            <div>
                <label for="">Semester</label>
                <select name="sem" class="form-control" required>
                    <option value="{{$tahun->sem}}">Semester {{$tahun->sem}}</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection