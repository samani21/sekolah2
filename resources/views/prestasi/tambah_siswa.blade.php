@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('prestasi.store')}}" method="POST">
            @csrf
            <input type="hidden" value="siswa" name="status">
            <input type="hidden" value="0" name="id_guru">
            <div>
                <label for="">Nama Siswa</label>
                <input class="form-control" type="text" name="id_siswa" list="siswa" autocomplete="off" placeholder="Masukkan Nama siswa" aria-label="default input example" autofocus required>
                <datalist id="siswa">
                    @foreach ($siswa as $sis)
                        <option <?php 
                            if ($sis->id <= 9) {
                                ?>
                                value="000{{$sis->id}} NIS: {{$sis->nis}}, Nama: {{$sis->nama}}"
                                <?php
                            }
                            if ($sis->id <= 99) {
                                ?>
                                value="00{{$sis->id}} NIS: {{$sis->nis}}, Nama: {{$sis->nama}}"
                                <?php
                            }
                            if ($sis->id <= 999) {
                                ?>
                                value="0{{$sis->id}} NIS: {{$sis->nis}}, Nama: {{$sis->nama}}"
                                <?php
                            }else {
                                ?>
                                value="{{$sis->id}} NIS: {{$sis->nis}}, Nama: {{$sis->nama}}"
                                <?php
                            }
                        ?>></option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="">Nama Kegiatan</label>
                <input class="form-control" type="text" name="nm_kegiatan" autocomplete="off" placeholder="Masukkan Nama kegiatan" aria-label="default input example" autofocus required>
            </div>
            <div>
                <label for="">Capaian</label>
                <input class="form-control" type="text" name="capaian" autocomplete="off" placeholder="Masukkan pencapain didapat" aria-label="default input example" autofocus required>
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