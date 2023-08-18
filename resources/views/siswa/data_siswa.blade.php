@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row"><div class="col-8">
                <form action="{{route('siswa/cetak_data_siswa')}}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="cetak siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                              </div>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="tahun" aria-label="Default select example">
                                @foreach ($ta as $t)
                                    <option value="{{$t->tahun}}">{{$t->tahun}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <form action="" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Cari siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                      </div>
                </form>
            </div>
        </div>
        {{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
        <form method="post" action="/siswa/import_excel" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </div>
        </form>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead >
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">NIk</th>
                        <th scope="col">Nama</th>
                        <th scope="col">TTL</th>
                        <th scope="col">Agama</th>
                        <th scope="col">JK</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tahun</th>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $index=>$sis)
                            <tr>
                                <td data-title="No">{{ $index + $siswa->firstItem() }}</td>
                                <td data-title="NIS">{{$sis->nis}}</td>
                                <td data-title="NIK">{{$sis->nik}}</td>
                                <td data-title="Nama">{{$sis->nama}}</td>
                                <td data-title="TTL">{{$sis->tempat}}, {{date('d-m-Y', strtotime($sis->tgl))}}</td>
                                <td data-title="Agama">{{$sis->agama}}</td>
                                <td data-title="Jenis Kelamin">{{$sis->jk}}</td>
                                <td data-title="Alamat">{{$sis->alamat}}</td>
                                <td data-title="Kelas">{{$sis->kelas}}</td>
                                <td data-title="Tahun">{{$sis->tahun}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $siswa->links() }}
            </div>
        </div>
	</div>
@endsection