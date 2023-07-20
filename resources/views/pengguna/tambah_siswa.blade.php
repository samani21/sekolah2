@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('pengguna.store')}}" method="POST">
            @csrf
            <div>
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
            </div>
            <div>
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="username" name="username"
                    value="{{ old('username') }}" />
            </div>
            <div>
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" />
            </div>
            <div>
                <label>Password Confirmation<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password_confirm" />
            </div>
            <div>
                <div>
                    <label>Level</label>
                    <select name="level" class="form-control" required>
                        <option value="">--pilih--</option>
                        @foreach ($kelas as $kel)
                            <option value="Siswa {{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" value="0" name="status">
            <input type="hidden" value="{{$tahun->tahun}}" name="tahun">
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection