@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('tambah_uts')}}" method="post">
            @csrf
            {{-- <input type="hidden" class="form-control" name="id_siswa" value="{{$nil->id_siswa}}">
            <input type="hidden" class="form-control" name="tgl" value="{{date('Y-m-d')}}">
            <input type="hidden" class="form-control" name="tahun" value="{{$nil->tahun}}">
            <input type="hidden" class="form-control" name="kelas" value="{{$nil->kelas}}">
            <input type="hidden" class="form-control" name="mapel" value="{{$nil->mapel}}">
            <input type="hidden" class="form-control" name="semester" value="{{$nil->semester}}"> --}}
            {{-- <input type="hidden" class="form-control" name="id_nilai" value="{{$nil->id}}"> --}}
            {{-- <input type="hidden" class="form-control" name="status" value="1">
            <input type="hidden" class="form-control" name="uas" value="-"> --}}
            <input type="hidden" class="form-control" name="id_siswa" value="{{$siswa->id}}">
            <input type="hidden" class="form-control" name="tahun" value="{{$tahun->tahun}}">
            <input type="hidden" class="form-control" name="semester" value="{{$tahun->sem}}">
            <input type="hidden" class="form-control" name="tgl" value="{{date('Y-m-d')}}">
            <input type="hidden" class="form-control" name="kelas" value="{{$kelas}}">
            <input type="hidden" class="form-control" name="mapel" value="{{$mapel}}">
            <div>
                <label for="">NIS</label>
                <input type="text" class="form-control" name="nis" value="{{$siswa->nis}}" readonly required>
            </div>
            <div>
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{$siswa->nama}}" readonly required>
            </div>
            <div>
                <label for="">Nilai akhir</label>
                <input type="number" class="form-control" name="n_akhir" value="{{$nilai}}" required >
            </div>
            <div>
                <label for="">Nilai UTS</label>
                <input type="number" class="form-control" name="uts" required autofocus>
            </div>
            <div>
                <label for="">Nilai UAS</label>
                <input type="number" class="form-control" name="uas" required>
            </div>
            <br>
            <div>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
	</div>
@endsection