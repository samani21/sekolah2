@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <form action="{{route('jurnal.store',$pre->presensi)}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div>
                        <label for="">Materi mengajar</label>
                        <input class="form-control" type="text" name="materi" placeholder="Masukkan Materi" aria-label="default input example" required autofocus>
                    </div>
                    <div>
                        <label for="">Kegiatan</label>
                        <textarea name="kegiatan" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <label for="">Penilaian</label>
                        <textarea name="penilaian"  class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <label for="">Nama</label>
                        <input class="form-control" type="text"  value="{{$pre->nama}}" aria-label="default input example" readonly>
                    </div>
                    <div>
                        <label for="">Mapel</label>
                        <input class="form-control" type="text"  value="{{$pre->mapel}}" aria-label="default input example" readonly>
                    </div>
                    <div>
                        <label for="">Kelas</label>
                        <input class="form-control" type="text"  value="{{$pre->kelas}}" aria-label="default input example" readonly>
                    </div>
                    <div>
                        <label for="">Tanggal</label>
                        <input class="form-control" type="text"  value="{{$pre->tgl}}" aria-label="default input example" readonly>
                    </div>
                    <div>
                        <label for="">Lama mengajar</label>
                        <input class="form-control" type="text"  value="{{$pre->jam_mulai}} - {{$pre->jam_selesai}}" aria-label="default input example" readonly>
                    </div>
                    <input type="hidden" name="id_guru" value="{{$pre->guru}}">
                    <input type="hidden" name="id_presensi" value="{{$pre->presensi}}">
                    <input type="hidden" name="tgl" value="{{date('Y-m-d')}}">
                    <hr>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
	</div>
@endsection