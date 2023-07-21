@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('prestasi.store')}}" method="POST">
            @csrf
            <input type="hidden" value="guru" name="status">
            <input type="hidden" value="0" name="id_siswa">
            <div>
                <label for="">Nama Siswa</label>
                <input class="form-control" type="text" name="id_guru" list="siswa" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                <datalist id="siswa">
                    @foreach ($guru as $gur)
                        <option value="00{{$gur->id}} NIP: {{$gur->nip}}, Nama: {{$gur->nama}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nm_kegiatan" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Capaian</label>
                <input class="form-control" type="text" name="capaian" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tingakat</label>
                <input class="form-control" type="text" name="tingkat" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tahun</label>
                <input class="form-control" type="text" name="tahun" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Waktu</label>
                <input class="form-control" type="date" name="waktu" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Bukti</label>
                <input class="form-control" type="text" name="bukti" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection