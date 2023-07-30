<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{isset($title) ? $title : 'Title tidak diatur' }}</title>
    <script src="https://kit.fontawesome.com/a284c48079.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://davidshimjs.github.io/qrcodejs/qrcode.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
            <img src="{{asset('sman9banjarmasin.png')}}" alt="">
            <div class="sidebar-brand" style="margin-top: -20%">
                <h1>
                    <span>SMAN 9 BANJARMASIN</span>
                </h1>
            </div>
            <div class="sidebar-menu">
                <ul>
                    @if(Auth::user()->level =='Super_admin')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('d-m-Y').'&tahun='.date('Y').'') }}"
                            class="{{ request()->is('dashboard/*')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->status =='0')
                    <li>
                         <a href="{{ url('data_guru/tambah_guru') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                     
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('pengguna/*')?'active' :'' }}">
                            <span class="fa-regular fa-user"></span>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('siswa/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('data_guru/*')?'active' :'' }}">
                            <span class="fa-solid fa-chalkboard-user"></span>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('absensi/absen_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('absensi/presensi*','absensi/lihat_presensi*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Presensi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('prestasi/siswa*','prestasi/tambah_siswa*','prestasi/edit_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('prestasi/guru*','prestasi/edit_guru*','prestasi/tambah_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('harian/harian*','harian/siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->status =='1')
                    <li>
                         <a href="{{ url('profil/profil/'.Auth::user()->id.'') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                     <li>
                        <a class="dropdown-btn"><i class="fa-solid fa-gear"></i> Setting
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-container" style="display: none">
                            <a href="{{url('tahun/tahun_ajaran')}}"
                                class="{{ request()->is('tahun/tahun_ajaran')?'active' :'' }}">Tahun ajaran</a>
                            <a href="{{url('kelas/kelas')}}"
                                class="{{ request()->is('kelas/kelas')?'active' :'' }}">Kelas</a>
                            <a href="{{url('mapel/mapel')}}"
                                class="{{ request()->is('mapel/mapel')?'active' :'' }}">MAPEL</a>
                            {{-- <a href="{{url('url/url')}}"
                                class="{{ request()->is('url/url')?'active' :'' }}">URL</a> --}}
                        </div>
                    </li>
                    <hr>
                    <li>
                        <a href="{{ url('pengguna/pengguna') }}"
                            class="{{ request()->is('pengguna/*')?'active' :'' }}">
                            <span class="fa-regular fa-user"></span>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/siswa') }}"
                            class="{{ request()->is('siswa/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/guru') }}"
                            class="{{ request()->is('data_guru/*')?'active' :'' }}">
                            <span class="fa-solid fa-chalkboard-user"></span>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('absensi/absen_guru?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('absensi/absen_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('absensi/presensi?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('absensi/presensi*','absensi/lihat_presensi*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Presensi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('prestasi/siswa') }}"
                            class="{{ request()->is('prestasi/siswa*','prestasi/tambah_siswa*','prestasi/edit_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('prestasi/guru') }}"
                            class="{{ request()->is('prestasi/guru*','prestasi/edit_guru*','prestasi/tambah_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('harian/harian') }}"
                            class="{{ request()->is('harian/harian*','harian/siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    @endif
                    @endif

                    @if(Auth::user()->level =='Guru')
                        <li>
                            <a href="{{ url('dashboard/dashboard?tgl='.date('d-m-Y').'&tahun='.date('Y').'') }}"
                                class="{{ request()->is('dashboard/*')?'active' :'' }}">
                                <span class="las la-tachometer-alt"></span>
                                <span>dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->status =='0')
                        <li>
                            <a href="{{ url('data_guru/tambah_guru') }}"
                                class="{{ request()->is('profil/*')?'active' :'' }}">
                                <span class="fa-solid fa-address-card"></span>
                                <span>Profil</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->status =='1')
                        <li>
                            <a href="{{ url('profil/profil/'.Auth::user()->id.'') }}"
                                class="{{ request()->is('profil/*')?'active' :'' }}">
                                <span class="fa-solid fa-address-card"></span>
                                <span>Profil</span>
                            </a>
                        </li>
                        @endif
                    <hr>
                        @if (Auth::user()->status =='0')
                            <li>
                                <a href="{{ url('data_guru/tambah_guru') }}"
                                    class="{{ request()->is('profil/*')?'active' :'' }}">
                                    <span class="fa-solid fa-person"></span>
                                    <span>Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('data_guru/tambah_guru') }}"
                                    class="{{ request()->is('profil/*')?'active' :'' }}">
                                    <span class="fa-solid fa-chalkboard-user"></span>
                                    <span>Guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('data_guru/tambah_guru') }}"
                                    class="{{ request()->is('profil/*')?'active' :'' }}">
                                    <span class="fa-solid fa-clipboard-list"></span>
                                    <span>Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('data_guru/tambah_guru') }}"
                                    class="{{ request()->is('profil/*')?'active' :'' }}">
                                    <span class="fa-solid fa-clipboard-list"></span>
                                    <span>Presensi Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('data_guru/tambah_guru') }}"
                                    class="{{ request()->is('profil/*')?'active' :'' }}">
                                    <span class="fa-solid fa-award"></span>
                                    <span>Prestasi guru</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->status =='1')
                            <li>
                                <a href="{{ url('siswa/siswa') }}"
                                    class="{{ request()->is('siswa/*')?'active' :'' }}">
                                    <span class="fa-solid fa-person"></span>
                                    <span>Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('data_guru/guru') }}"
                                    class="{{ request()->is('data_guru/*')?'active' :'' }}">
                                    <span class="fa-solid fa-chalkboard-user"></span>
                                    <span>Guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('absensi/absen_guru') }}"
                                    class="{{ request()->is('absensi/absen_guru*')?'active' :'' }}">
                                    <span class="fa-solid fa-clipboard-list"></span>
                                    <span>Absensi</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('absensi/presensi?cari='.date('Y-m-d').'') }}"
                                    class="{{ request()->is('absensi/presensi*','absensi/lihat_presensi*')?'active' :'' }}">
                                    <span class="fa-solid fa-clipboard-list"></span>
                                    <span>Presensi Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('prestasi/guru') }}"
                                    class="{{ request()->is('prestasi/guru*','prestasi/edit_guru*','prestasi/tambah_guru*')?'active' :'' }}">
                                    <span class="fa-solid fa-award"></span>
                                    <span>Prestasi guru</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('poin/poin') }}"
                                    class="{{ request()->is('poin/*')?'active' :'' }}">
                                    <span class="fa-solid fa-triangle-exclamation"></span>
                                    <span>Point Disiplin</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Auth::user()->level =='Tata_usaha')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('d-m-Y').'&tahun='.date('Y').'') }}"
                            class="{{ request()->is('dashboard/*')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->status =='0')
                    <li>
                         <a href="{{ url('data_guru/tambah_guru') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                     <hr>
                     <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-chalkboard-user"></span>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Presensi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/tambah_guru') }}"
                            class="{{ request()->is('profil/*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->status =='1')
                    <li>
                         <a href="{{ url('profil/profil/'.Auth::user()->id.'') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                    <hr>
                    <li>
                        <a href="{{ url('siswa/siswa') }}"
                            class="{{ request()->is('siswa/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('data_guru/guru') }}"
                            class="{{ request()->is('data_guru/*')?'active' :'' }}">
                            <span class="fa-solid fa-chalkboard-user"></span>
                            <span>Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('absensi/absen_guru?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('absensi/absen_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi Guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('absensi/presensi?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('absensi/presensi*','absensi/lihat_presensi*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Presensi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('prestasi/siswa') }}"
                            class="{{ request()->is('prestasi/siswa*','prestasi/tambah_siswa*','prestasi/edit_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('prestasi/guru') }}"
                            class="{{ request()->is('prestasi/guru*','prestasi/edit_guru*','prestasi/tambah_guru*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi guru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('harian/harian') }}"
                            class="{{ request()->is('harian/harian*','harian/siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    @endif
                    @endif
                    @if(Auth::user()->level =='Siswa')
                    <li>
                        <a href="{{ url('dashboard/dashboard?tgl='.date('d-m-Y').'&tahun='.date('Y').'') }}"
                            class="{{ request()->is('dashboard/*')?'active' :'' }}">
                            <span class="las la-tachometer-alt"></span>
                            <span>dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->status =='0')
                    <li>
                         <a href="{{ url('siswa/tambah_siswa') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                     <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('absensi/absen_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('siswa/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('prestasi/siswa*','prestasi/tambah_siswa*','prestasi/edit_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('harian/siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('poin/*')?'active' :'' }}">
                            <span class="fa-solid fa-triangle-exclamation"></span>
                            <span>Point Disiplin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/tambah_siswa') }}"
                            class="{{ request()->is('nilai/*')?'active' :'' }}">
                            <span class="fa-solid fa-triangle-exclamation"></span>
                            <span>Nilai</span>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->status =='1')
                    <li>
                         <a href="{{ url('profil/profilsiswa/'.Auth::user()->id.'') }}"
                             class="{{ request()->is('profil/*')?'active' :'' }}">
                             <span class="fa-solid fa-address-card"></span>
                             <span>Profil</span>
                         </a>
                     </li>
                    <hr>
                    <li>
                        <a href="{{ url('absensi/absen_siswa?cari='.date('Y-m-d').'') }}"
                            class="{{ request()->is('absensi/absen_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('siswa/siswa') }}"
                            class="{{ request()->is('siswa/*')?'active' :'' }}">
                            <span class="fa-solid fa-person"></span>
                            <span>Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('prestasi/siswa') }}"
                            class="{{ request()->is('prestasi/siswa*','prestasi/tambah_siswa*','prestasi/edit_siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-award"></span>
                            <span>Prestasi Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('harian/siswa') }}"
                            class="{{ request()->is('harian/siswa*')?'active' :'' }}">
                            <span class="fa-solid fa-clipboard-list"></span>
                            <span>Absen siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('poin/poin') }}"
                            class="{{ request()->is('poin/*')?'active' :'' }}">
                            <span class="fa-solid fa-triangle-exclamation"></span>
                            <span>Point Disiplin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('nilai/nilai') }}"
                            class="{{ request()->is('nilai/*')?'active' :'' }}">
                            <span class="fa-solid fa-triangle-exclamation"></span>
                            <span>Nilai</span>
                        </a>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-content">
            <header>
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars" style="color: black"></span>
                    </label>
                    {{
        
                    isset($title) ? $title : 'Title tidak diatur'
                    
                    }}
                </h1>
                <div>
                    {{ Auth::user()->name }}

                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">Logout</a>

                </div>

            </header>
            <main>
                @yield('content')
            </main>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
</body>

</html>