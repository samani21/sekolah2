@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('updategambar',$siswa->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6">
                <label for="">Masukkan Gambar</label>
                <input type="file" class="form-control" name="images_portfolio" required>
                @if ($errors->has('images_portfolio'))
                <div class="alert alert-danger">Harus diisi gambar</div>
                @endif
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection