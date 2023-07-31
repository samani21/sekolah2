@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('updatepresensi',$presensi->id)}}" method="POST">
            @csrf
            {{-- <div>
                <label for="">Nama Guru</label>
                <input class="form-control" type="text"  value="{{$guru->nama}}" aria-label="default input example" readonly required>
            </div> --}}
            <div>
                <label for="">Mata Pelajaran</label>
                <input class="form-control" type="text" name="mapel" value="{{$presensi->mapel}}" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="{{$presensi->kelas}}">{{$presensi->kelas}}</option>
                    @foreach ($kelas as $kel)
                        <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">Tanggal</label>
                <input class="form-control" type="date" name="tgl" value="{{$presensi->tgl}}" aria-label="default input example"  required>
            </div>
            <div>
                <label for="">Jam Mulai</label>
                <input class="form-control" type="text" name="jam_mulai" value="{{$presensi->jam_mulai}}" aria-label="default input example"  required>
            </div>
            <div>
                <label for="">Jam selesai</label>
                <input class="form-control" type="text" name="jam_selesai" value="{{$presensi->jam_selesai}}" aria-label="default input example" required>
            </div>
            <div>
                <label for="">Tahun ajaran</label>
                <input class="form-control" type="text" name="tahun" value="{{$presensi->tahun}}" aria-label="default input example" readonly required>
            </div>
            <div>
                <label for="">Jenis penilaian</label>
                <select name="s_nilai" class="form-control" required>
                    <option value="{{$presensi->s_nilai}}">
                        <?php 
                            if ($presensi->s_nilai == 1) {
                               ?>
                                   Nilai tugas dan absen
                               <?php
                            }
                            if ($presensi->s_nilai == 0) {
                               ?>
                                   Absen
                               <?php
                            }
                        ?>
                    </option>
                        <option value="0">Absen</option>
                        <option value="1">Nilai tugas dan absen</option>
                </select>
            </div>
            <input type="hidden" value="{{$presensi->id_guru}}" name="id_guru">
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
	</div>
@endsection