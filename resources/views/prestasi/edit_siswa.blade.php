@extends('layouts.sidebar')

@section('content')

    <div class="container">
        @foreach ($siswa as $sis)    
            <form action="{{url('updatesiswa',$sis->id)}}" method="POST">
                @csrf
                <input type="hidden" value="siswa" name="status">
                <div>
                    <label for="">Nama Siswa</label>
                    <input class="form-control" type="text" name="id_siswa" value="{{$sis->nama}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" readonly>
                </div>
                <div>
                    <label for="">Nama Kegiatan</label>
                    <input class="form-control" type="text" name="nm_kegiatan" value="{{$sis->nm_kegiatan}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Capaian</label>
                    <input class="form-control" type="text" name="capaian" value="{{$sis->capaian}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Tingakat</label>
                    <input class="form-control" type="text" name="tingkat" value="{{$sis->tingkat}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Tahun</label>
                    <input class="form-control" type="text" name="tahun" value="{{$sis->tahun}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Waktu</label>
                    <input class="form-control" type="date" name="waktu" value="{{$sis->waktu}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Bukti</label>
                    <input class="form-control" type="text" name="bukti" value="{{$sis->bukti}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        @endforeach
	</div>
@endsection