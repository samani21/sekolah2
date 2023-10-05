@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('poin.store')}}" method="POST" >
            @csrf
            <input class="form-control" type="hidden" name="id_user" value="{{$siswa->id_user}}" aria-label="default input example" readonly>
            <input class="form-control" type="hidden" name="id_siswa" value="{{$siswa->id}}" aria-label="default input example" readonly>
            <input class="form-control" type="hidden" name="tahun" value="{{$tahun->tahun}}" aria-label="default input example" readonly>
            <div class="row">
                <div class="col-6">
                    <div>
                        <label for="">Nama</label>
                        <input class="form-control" type="text" value="{{$siswa->nama}}" aria-label="default input example" required readonly>
                    </div>
                    <div>
                        <label for="">Kelas</label>
                        <input class="form-control" type="text" name="kelas" value="{{$siswa->kelas}}" aria-label="default input example" required readonly>
                    </div>
                    <div>
                        <label for="">Poin</label>
                        <input class="form-control" type="text" name="poin" list="poin" autocomplete="off" placeholder="Masukkan pengurangan poin" aria-label="default input example" autofocus required>
                <datalist id="poin">
                    @foreach ($poin as $po)
                        <option <?php 
                            if ($po->bobot <= 9) {
                                ?>
                                value="Poin :0{{$po->bobot}} Keterangan: {{$po->pelanggaran}}"
                                <?php
                            }else {
                                ?>
                                value="Poin :{{$po->bobot}} Keterangan: {{$po->pelanggaran}}"
                                <?php
                            }
                        ?>></option>
                    @endforeach
                </datalist>
                    </div>
                    <div>
                        <label for="">Tanggal</label>
                        <input class="form-control" type="date" name="tgl" value="{{date('Y-m-d')}}" aria-label="default input example" autofocus required>
                    </div>
                    <div>
                        <label for="">Keterangan</label>
                        <textarea class="form-control" id="" cols="30" rows="10" name="ket" placeholder="Masukkan Keterangan" required></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <h3>Buat surat</h5>
                    </div>
                    <div>
                        <label for="">Hari</label>
                        <select name="hari" class="form-control" id="" required>
                            <option value="">--Pilih hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jum'at">Jum'at</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div>
                        <label for="">tgl</label>
                        <input class="form-control" type="date" name="tgl_surat" value="{{date('Y-m-d')}}"  aria-label="default input example" required>
                    </div>
                    <div>
                        <label for="">Jam</label>
                        <input class="form-control" type="time" name="jam" placeholder="Masukkan pengurangan point" aria-label="default input example" autofocus required>
                    </div>
                    <div>
                        <label for="">Tempat</label>
                        <input class="form-control" type="tet" name="tempat"  aria-label="default input example" autofocus required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </div>
        </form>
	</div>
@endsection