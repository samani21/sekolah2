@extends('layouts.sidebar')

@section('content')
    
<h4>
    Selamat datang {{ Auth::user()->name }}, Anda login sebagai user {{ Auth::user()->level }}
</h4>
<hr>

    <div class="container">
       <div class="row">
        <div class="col-md-6">
            <div id="container"></div>
        </div>
        <div class="col-md-6">
            <div id="container1"></div>
        </div>
       </div>
	</div>


    <script src="https://code.highcharts.com/highcharts.js"></script>
          
          <script type="text/javascript">
            var jumlah = <?php echo json_encode($jum); ?>;
            var bulan  = <?php echo json_encode($bulan); ?>;
            Highcharts.chart('container', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Siswa Masuk Pertahun'
                },
                xAxis: {
                    categories: bulan
                },

                yAxis: {
                    lineWidth: 1,
                    tickWidth: 1,
                    title: {
                        align: 'high',
                        offset: 0,
                        text: 'Jumlah(orang)',
                        rotation: 0,
                        y: -10
                    }
                },

                series: [{
                    data: jumlah
                }]

                });
          </script>

          <script type="text/javascript">
            var jumlah = <?php echo json_encode($absen); ?>;
            var bulan  = <?php echo json_encode($tanggal); ?>;
            Highcharts.chart('container1', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Grafik Siswa Abasen Perhari'
                },
                xAxis: {
                    categories: bulan
                },

                yAxis: {
                    lineWidth: 1,
                    tickWidth: 1,
                    title: {
                        align: 'high',
                        offset: 0,
                        text: 'Jumlah(orang)',
                        rotation: 0,
                        y: -10
                    }
                },

                series: [{
                    data: jumlah
                }]

                });
          </script>
@endsection