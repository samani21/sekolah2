@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('presensi.store')}}" method="POST">
            @csrf
            <div>
                <label for="">Nama Guru</label>
                <input class="form-control" type="text"  value="{{$guru->nama}}" aria-label="default input example" readonly required>
            </div>
            <div>
                <label for="">Mata Pelajaran</label>
                <input class="form-control" type="text" name="mapel"  aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="">--pilih--</option>
                    @foreach ($kelas as $kel)
                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input class="form-control" type="date" name="tgl" value="{{date('Y-m-d')}}" aria-label="default input example"  required>
            </div>
            <div>
                <label for="">Jam Mulai</label>
                <input class="form-control" type="text" name="jam_mulai" value="{{date('H:i:s')}}" aria-label="default input example"  required>
            </div>
            <div>
                <label for="">Jam selesai</label>
                <input class="form-control" type="text" name="jam_selesai" value="{{date('H:i:s')}}" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Tahun ajaran</label>
                <input class="form-control" type="text" name="tahun" value="{{$tahun->tahun}}" aria-label="default input example" readonly required>
            </div>
            <input type="hidden" value="{{$guru->id}}" name="id_guru">
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection