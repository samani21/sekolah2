@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    @if (Auth::user()->level =="Guru" || Auth::user()->level =="Tata_usaha" ||Auth::user()->level =="Super_admin")
                    <div class="col-8">
                        <form action="{{route('siswa/cetak')}}" method="GET">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="cari" placeholder="cetak sisawa siswa" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
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
                    {{-- <div class="col-4">
                        <a href="tambah_siswa" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Siswa</a>
                    </div> --}}
                </div>
            </div>
            <div class="col-4">
                <div style="width: 100%">
                    <div id="reader1" width="300px"></div>
                </div>
            </div>
        </div>
            <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead align="center">
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">NIk</th>
                        <th scope="col">Nama</th>
                        <th scope="col">TTL</th>
                        <th scope="col">Agama</th>
                        <th scope="col">JK</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kelas</th>
                        @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                        <th scope="col">Status</th>
                        @endif
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
                                <td data-title="Alamat">{{$sis->kelas}}</td>
                                @if (Auth::user()->level == "Guru" || Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
                                <td>
                                    <?php
                                        if (strtotime($sis->tgl_harian) == strtotime(date('Y-m-d'))) {
                                            echo"Hadir";
                                        }else {
                                            echo"Belum absen";
                                        }
                                    ?>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $siswa->links() }}
            </div>
        </div>
	</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        // $('#result').val('test');
        function onScanSuccess(decodedText, decodedResult) {
            // alert(decodedText);
            $('#result1').val(decodedText);
            let id = decodedText;                
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('harian/absen') }}",
                    type: 'GET',            
                    data: {
                        id : id
                    },            
                    success: function (response) { 
                        console.log(response);
                        if(response.status == 200){
                            window.location.reload();
                        }else{
                            window.location.reload();
                        }
                        
                    }
                });   
            }).catch(error => {
                alert('something wrong');
            });
            
        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader1",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection