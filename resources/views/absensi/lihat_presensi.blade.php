@extends('layouts.sidebar')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-8">
                        <form action="{{route('absensi/cetak_presensi',[$id,$mapel])}}" method="GET">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="cari" placeholder="cetak" aria-label="Recipient's username" aria-describedby="button-addon2">
                                      </div>
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
                        <form action="" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="cari" placeholder="Cari" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div style="width: 100%">
                    <div id="reader" width="300px"></div>
                </div>
            </div>
        </div>
        <hr>
            <div>
                <table class="table table-secondary table-striped" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Mapel</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tahun ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $index=>$pre)
                        <tr>
                            <td data-title="No">{{ $index + $presensi->firstItem() }}</td>
                            <td data-title="NIS" >{{$pre->nis}}</td>
                            <td data-title="Nama" >{{$pre->nama}}</td>
                            <td data-title="Mapel" >{{$pre->mapel}}</td>
                            <td data-title="Kelas" >{{$pre->kelas}}</td>
                            <td data-title="Tanggal" >{{$pre->tgl}}</td>
                            <td data-title="Jam" >{{$pre->jam}}</td>
                            <td data-title="Tahun" >{{$pre->tahun}}</td>
                            {{-- <td data-title="Jam mulai" >{{$pre->jam}}</td> --}}
                            {{-- <td data-title="Tahun" >{{$pre->tahun}}</td>
                            @if (strtotime($pre->tgl) == strtotime(date('Y-m-d')) && strtotime($pre->jam_selesai) >= strtotime(date('H:i:s')))
                            <td>
                                <a href="proses_absen/{{$pre->id}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i>Absen</a>
                            </td>
                            @endif --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $presensi->links() }}
            </div>
        </div>
	</div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script>
        // $('#result').val('test');
        function onScanSuccess(decodedText, decodedResult) {
            // alert(decodedText);
            $('#result').val(decodedText);
            let id = decodedText;                
            html5QrcodeScanner.clear().then(_ => {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('proses_absen',"$id") }}",
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
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection