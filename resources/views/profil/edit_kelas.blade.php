@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{url('updateke',$user->id)}}" method="POST">
            @csrf
            <div>
                <label for="">NIS</label>
                <select name="kelas" class="form-control" required>
                    <option value="">--pilih--</option>
                    @foreach ($kelas as $kel)
                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection