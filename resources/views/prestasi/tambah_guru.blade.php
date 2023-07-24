@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('prestasi.store')}}" method="POST">
            @csrf
            <input type="hidden" value="guru" name="status">
            <input type="hidden" value="0" name="id_siswa">
            <div>
                <label for="">Nama Guru</label>
                <input class="form-control" type="text" name="id_guru" list="siswa" autocomplete="off" placeholder="Masukkan Nama guru" aria-label="default input example" autofocus required>
                <datalist id="siswa">
                    @foreach ($guru as $gur)
                        <option <?php 
                            if ($gur->id <= 9) {
                                ?>
                                value="000{{$gur->id}} NIP: {{$gur->nip}}, Nama: {{$gur->nama}}"
                                <?php
                            }
                            if ($gur->id <= 99) {
                                ?>
                                value="00{{$gur->id}} NIP: {{$gur->nip}}, Nama: {{$gur->nama}}"
                                <?php
                            }
                            if ($gur->id <= 999) {
                                ?>
                                value="0{{$gur->id}} NIP: {{$gur->nip}}, Nama: {{$gur->nama}}"
                                <?php
                            }else {
                                ?>
                                value="{{$gur->id}} NIP: {{$gur->nip}}, Nama: {{$gur->nama}}"
                                <?php
                            }
                        ?>></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nm_kegiatan" autocomplete="off" placeholder="Masukkan Nama kegiatab" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Capaian</label>
                <input class="form-control" type="text" name="capaian" autocomplete="off" placeholder="Masukkan Juara" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tingkat</label>
                <input class="form-control" type="text" name="tingkat" autocomplete="off" placeholder="Masukkan tingkat prestasi" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Tahun</label>
                <input class="form-control" type="text" name="tahun" autocomplete="off" placeholder="Masukkan tahun prestasi" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Waktu</label>
                <input class="form-control" type="date" name="waktu" autocomplete="off" placeholder="Masukkan waktu prestasi" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Bukti</label>
                <input class="form-control" type="text" name="bukti" autocomplete="off" placeholder="Masukkan bukti prestasi" aria-label="default input example" autofocus required>
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
	</div>
@endsection