@extends('layouts.sidebar')

@section('content')
<?php
    if (Auth::user()->tahun == $tahun->tahun) {
        ?>
        @if (Auth::user()->level =='Siswa')
        <div class="container">
            <h3 align="center">PROFIL SISWA</h3>
            <hr>
            @foreach ( $siswa as $s )
            <div class="row">
                <div class="col-6">
                    {!! QrCode::size(100)->generate($s->id); !!}
                    <a href="cetak_kartu/{{$s->id}}" class="btn btn-primary"><i class="fa-solid fa-print"></i> QrCode</a>
                </div>
                <div align="right" class="col-6">
                    <a href="/siswa/edit_siswa/{{$s->id}}" class="btn btn-warning">Edit</a>
                </div>
            </div>
            <br>
            <table class="table table-success table-striped" >
                <tr>
                    <th>
                        NIS :
                    </th> 
                    <td>
                        {{$s->nis}}
                    </td>
                </tr>
                <tr>
                    <th>
                        NIK :
                    </th> 
                    <td>
                        {{$s->nik}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Nama :
                    </th> 
                    <td>
                        {{$s->nama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        TTL :
                    </th> 
                    <td>
                        {{$s->tempat}}, {{$s->tgl}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Agama :
                    </th> 
                    <td>
                        {{$s->agama}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Jenis Kelamin :
                    </th> 
                    <td>
                        {{$s->jk}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Alamat :
                    </th> 
                    <td>
                        {{$s->alamat}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status :
                    </th> 
                    <td>
                        <?php
                            if ($s->level == "Tata_usaha") {
                                    echo "Tata Usaha";
                            }else {
                                    echo $s->level;
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        Kelas :
                    </th>
                    <td>
                        {{Auth::user()->kelas}}
                    </td>
                </tr>
            </table>
           @endforeach
        </div>
        @endif
        <?php
    }else{
        ?>
        <div class="container">
            <form action="{{url('updateke',$user->id)}}" method="POST">
                @csrf
                <div>
                    <label for="">NIS</label>
                    <select name="kelas" class="form-control" required>
                        <option value="">--pilih--</option>
                        @foreach ($kelas as $kel)
                            <option value="{{$kel->nm_kelas}}">{{$kel->nm_kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
        <?php
    }
?>
    @if (Auth::user()->level =='Guru'||Auth::user()->level =='Tata_usaha' ||Auth::user()->level =='Super_admin')
    <div class="container">
        <h3 align="center">PROFIL GURU</h3>
        <hr>
        @foreach ( $guru as $g )
       <div align="right">
        <a href="/data_guru/edit/{{$g->id}}" class="btn btn-warning">Edit</a>
        <a href="/profil/cetak/{{$g->id_user}}" class="btn btn-success">Cetak</a>
       </div>
        <br>
        <table class="table table-success table-striped" >
            <tr>
                <th>
                    NIP :
                </th> 
                <td>
                    {{$g->nip}}
                </td>
            </tr>
            <tr>
                <th>
                    NIK :
                </th> 
                <td>
                    {{$g->nik}}
                </td>
            </tr>
            <tr>
                <th>
                    Nama :
                </th> 
                <td>
                    {{$g->nama}}
                </td>
            </tr>
            <tr>
                <th>
                    TTL :
                </th> 
                <td>
                    {{$g->tempat}}, {{$g->tgl}}
                </td>
            </tr>
            <tr>
                <th>
                    Agama :
                </th> 
                <td>
                    {{$g->agama}}
                </td>
            </tr>
            <tr>
                <th>
                    Jenis Kelamin :
                </th> 
                <td>
                    {{$g->jk}}
                </td>
            </tr>
            <tr>
                <th>
                    Alamat :
                </th> 
                <td>
                    {{$g->alamat}}
                </td>
            </tr>
            <tr>
                <th>
                    Status :
                </th> 
                <td>
                   Pegawai {{$g->status}}
                </td>
            </tr>
            <tr>
                <th>
                    Jabatanan :
                </th> 
                <td>
                    <?php
                        if ($g->level == "Tata_usaha") {
                                echo "Tata Usaha";
                        }else {
                                echo $g->level;
                        }
                    ?>
                </td>
            </tr>
        </table>
       @endforeach
	</div>
    @endif
@endsection