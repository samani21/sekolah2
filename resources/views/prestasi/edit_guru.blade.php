@extends('layouts.sidebar')

@section('content')

    <div class="container">
        @foreach ($guru as $gur)    
            <form action="{{url('updateguru',$gur->id)}}" method="POST">
                @csrf
                <input type="hidden" value="guru" name="status">
                <div>
                    <label for="">Nama Guru</label>
                    <input class="form-control" type="text" name="id_siswa" value="{{$gur->nama}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" readonly>
                </div>
                <div>
                    <label for="">Nama Kegiatan</label>
                    <input class="form-control" type="text" name="nm_kegiatan" value="{{$gur->nm_kegiatan}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Capaian</label>
                    <input class="form-control" type="text" name="capaian" value="{{$gur->capaian}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Tingkat</label>
                    <input class="form-control" type="text" name="tingkat" value="{{$gur->tingkat}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Tahun</label>
                    <input class="form-control" type="text" name="tahun" value="{{$gur->tahun}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Waktu</label>
                    <input class="form-control" type="date" name="waktu" value="{{$gur->waktu}}" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                </div>
                <div>
                    <label for="">Bukti prestasi</label>
                    <select name="bukti" class="form-control" required>
                        <option value="{{$gur->bukti}}">{{$gur->bukti}}</option>
                        <option value="Piala">Piala</option>
                        <option value="Sertifikat">Sertifikat</option>
                        <option value="Medali">Medali</option>
                    </select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        @endforeach
	</div>
@endsection