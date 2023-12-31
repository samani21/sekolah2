<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AkhirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HarianController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UrlController;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');//halaman login
Route::get('register', [AuthController::class,'register'])->name('register');//menampilkan halaman register siswa
Route::get('register_pegawai', [AuthController::class,'register_pegawai'])->name('register_pegawai');//menampilkan halaman register
Route::post('register.action',[AuthController::class,'register_action'])->name('register.action');
Route::post('register.actionpegawai',[AuthController::class,'register_action_pegawai'])->name('register.actionpegawai');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:Guru']], function () {
        Route::resource('Guru', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');

    });
    Route::group(['middleware' => ['cek_login:Tata_usaha']], function () {
        Route::resource('Tata_usaha', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');
    });
    Route::group(['middleware' => ['cek_login:Super_admin']], function () {
        Route::resource('Super_admin', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');
    });
    Route::group(['middleware' => ['cek_login:Siswa']], function () {
        Route::resource('Siswa', 'App\Http\Controllers\LoginController');
        //menu sidebar
        Route::get('dashboard/dashboard', [LoginController::class,'dashboard'])->name('dashboard/dashboard');
    });
});

//guru
Route::get('data_guru/guru', [GuruController::class,'index'])->name('guru/guru');//menampilkan data guru
Route::get('data_guru/tambah_guru', [GuruController::class,'create'])->name('guru/tambah_guru');//menampilkan tambah data guru
Route::post('data_guru/tambah_guru',[GuruController::class, 'store'])->name('guru.store');//proses tambah data guru
Route::get('data_guru/edit/{id}',[GuruController::class, 'edit'])->name('guru/edit');//menampilkan edit data guru
Route::post('ubahguru/{id}',[GuruController::class, 'update'])->name('ubahguru');//proses update guru
Route::get('data_guru/hapus_guru/{id}&{id_user}',[GuruController::class, 'destroy'])->name('hapus_guru');//hapus data guru

//profil
Route::get('profil/profil/{id}',[GuruController::class,'profil'])->name('profil/profil');//menampilkan data profil

//siswa
Route::get('/siswa/export_excel',[SiswaController::class,'export_excel'])->name('/siswa/export_excel');//eksport excel
Route::post('/siswa/import_excel', [SiswaController::class,'import_excel'])->name('/siswa/import_excel');//import excel
Route::get('siswa/data_siswa',[SiswaController::class, 'data_siswa'])->name('siswa/data_siswa');//menampilkan data siswa
Route::get('siswa/hapus_data_siswa/{id}',[SiswaController::class, 'destroy_data_siswa'])->name('hapus_data_siswa');//hapus data siswa

Route::get('siswa/siswa',[SiswaController::class, 'index'])->name('siswa/siswa');//menampilkan data siswa
Route::get('siswa/tambah_siswa',[SiswaController::class, 'create'])->name('siswa/tambah_siswa');//input siswa
Route::post('siswa/tambah_siswa',[SiswaController::class, 'store'])->name('siswa.store');//proses tambah data siswa
Route::get('siswa/edit_siswa/{id}',[SiswaController::class, 'edit_siswa'])->name('siswa/edit_siswa');//edit datasiswa
Route::post('updatesis/{id}',[SiswaController::class, 'update'])->name('updatesis');//proses edit data siswa
Route::get('siswa/hapus_siswa/{id}',[SiswaController::class, 'destroy'])->name('hapus_iswa');//hapus data siswa

Route::get('profil/profilsiswa/{id}',[SiswaController::class,'profil'])->name('profil/profilsiswa');//menampilkan data profil
Route::get('profil/edit_kelas',[SiswaController::class,'edit_kelas'])->name('profil/edit_kelas');//menampilkan edit kelas siswa
Route::post('updateke/{id}',[SiswaController::class, 'updatekelas'])->name('updateke');//proses upodate pengguna
Route::get('profil/ubah_gambar/{id}',[SiswaController::class,'edit_gambar'])->name('profil/ubah_gambar');//menampilkan edit kelas siswa
Route::post('updategambar/{id}',[SiswaController::class, 'updategambar'])->name('updategambar');//proses upodate pengguna

//poin
Route::get('poin/poin', [PoinController::class, 'index'])->name('poin/poin');
Route::get('poin/tambah_point/{id}',[PoinController::class,'create'])->name('poin/tambah_poin');
Route::post('poin/tambah_point',[PoinController::class,'store'])->name('poin.store');
Route::get('poin/edit/{id}',[PoinController::class,'edit'])->name('poin/edit');
Route::post('updatepoin/{id}', [PoinController::class,'update'])->name('updatepoin');
Route::get('poin/hapus_poin/{id}',[PoinController::class, 'destroy'])->name('hapus_poin');//hapus data siswa

//pengguna
Route::get('pengguna/pengguna', [PenggunaController::class,'index'])->name('pengguna/pengguna');//menampilkan data pengguna
Route::get('pengguna/edit_pengguna/{id}', [PenggunaController::class,'edit_pengguna'])->name('pengguna/edit_pengguna');//edit pengguna
Route::post('updatepengguna/{id}',[PenggunaController::class, 'update'])->name('updatepengguna');//proses upodate pengguna
Route::get('pengguna/tambah_akun', [PenggunaController::class,'create'])->name('pengguna/tambah_akun');//tambah akun siswa
Route::post('pengguna/tambah_akun', [PenggunaController::class,'store'])->name('pengguna.store');//tambah akun siswa
Route::get('profil/ubah_password',[PenggunaController::class, 'ubah'])->name('profil/ubah_password');//data prestasi siswa
Route::post('ubahpassword/{id}',[PenggunaController::class, 'update_password'])->name('ubahpassword');//prestasi siswa

//tahun ajaran
Route::get('tahun/tahun_ajaran', [TahunController::class,'index'])->name('tahun/tahun');//menampilkan halaman setting tahun ajaran
Route::post('update', [TahunController::class,'update'])->name('update');//proses update tahun ajaran

//url
// Route::get('url/url', [UrlController::class,'index'])->name('url/url');//menampilkan halaman setting tahun ajaran
// Route::post('update', [UrlController::class,'update'])->name('update');//proses update tahun ajaran

//kelas
Route::get('kelas/kelas',[KelasController::class, 'index'])->name('kelas/kelas');//menampilkan data kelas
Route::get('kelas/tambah_kelas',[KelasController::class, 'create'])->name('kelas/tambah_kelas');//input kelas
Route::post('kelas/tambah_kelas',[KelasController::class, 'store'])->name('kelas.store');//proses tambah data kelas
Route::get('kelas/edit_kelas/{id}',[KelasController::class, 'edit_kelas'])->name('siswa/edit_kelas');//edit datasiswa
Route::post('updatekelas/{id}',[KelasController::class, 'update'])->name('updatekelas');//proses edit data siswa
Route::get('kelas/hapus_kelas/{id}',[KelasController::class, 'destroy'])->name('hapus_kelas');//hapus data siswa

//Mata pelajaran
Route::get('mapel/mapel',[MapelController::class, 'index'])->name('mapel/mapel');//menampilkan data mapel
Route::get('mapel/tambah_mapel',[MapelController::class, 'create'])->name('mapel/tambah_mapel');//input mapel
Route::post('mapel/tambah_mapel',[MapelController::class, 'store'])->name('mapel.store');//proses tambah data mapel
Route::get('mapel/edit_mapel/{id}',[MapelController::class, 'edit_mapel'])->name('mapel/edit_mapel');//edit datasiswa
Route::post('updatemapel/{id}',[MapelController::class, 'update'])->name('updatemapel');//proses edit data siswa
Route::get('mapel/hapus_mapel/{id}',[MapelController::class, 'destroy'])->name('hapus_mapel');//hapus data siswa

//absensi
Route::get('absensi/absen_guru', [AbsenController::class ,'index'])->name('absensi/absen_guru');//menampilkan halaman absensi guru
Route::get('absensi/abs_guru/{id}', [AbsenController::class, 'update'])->name('abs_guru');//proses absen guru
Route::get('selesai/{id}', [AbsenController::class, 'selesai'])->name('selesai');//proses selesai absen guru

//presensi siswa
Route::get('absensi/presensi', [PresensiController::class ,'index'])->name('absensi/presensi');//menampilkan data presensi
Route::get('absensi/tambah_presensi/{id_guru}', [PresensiController::class ,'create'])->name('absensi/tambah_presensi');//menampilkan tambah presensi
Route::post('absensi/tambah', [PresensiController::class, 'store'])->name('presensi.store');//proses menyimpan presensi
Route::get('absensi/edit_presensi/{id}',[PresensiController::class, 'edit_presensi'])->name('absensi/edit_presensi');//edit presesni
Route::post('updatepresensi/{id}',[PresensiController::class, 'update'])->name('updatepresensi');//proses edit presensi
Route::get('absensi/hapus_presensi/{id}',[PresensiController::class, 'destroy'])->name('hapus_presensi');//hapus presensi
Route::get('absensi/lihat_presensi/{id}/{mapel}',[PresensiController::class, 'lihat'])->name('absensi/lihat_presensi');//lihat preseni

//absesnsi siswa
Route::get('absensi/absen_siswa', [AbsenController::class ,'index_siswa'])->name('absensi/absen_siswa');//absen siswa
Route::get('proses_absen/{id}', [AbsenController::class, 'store'])->name('proses_absen');//proses absen siswa


//lihat nilai
Route::get('nilai/lihat_nilai/{id}/{mapel}',[NilaiController::class, 'lihat'])->name('nilai/lihat_nilai');//lihat nilai
Route::post('tambah_nilai/{id}',[NilaiController::class, 'store'])->name('tambah_nilai');//Tambah nilai
Route::post('update_nilai/{id}',[NilaiController::class, 'update'])->name('update_nilai');//Tambah nilai
Route::get('nilai/nilai',[NilaiController::class, 'index'])->name('nilai/nilai');//lihat nilai siswa

//prestasi siswa
Route::get('prestasi/siswa',[PrestasiController::class, 'index_siswa'])->name('prestasi/siswa');//data prestasi siswa
Route::get('prestasi/tambah_siswa',[PrestasiController::class, 'create_siswa'])->name('prestasi/tambah_siswa');//prestasi siswa
Route::post('prestasi/tambah_siswa',[PrestasiController::class, 'store'])->name('prestasi.store');//proses tambah prestasi siswa
Route::get('prestasi/edit_siswa/{id}',[PrestasiController::class, 'edit_siswa'])->name('prestasi/edit_siswa');//edit prestasi siswa
Route::post('updatesiswa/{id}',[PrestasiController::class, 'update'])->name('updatesiswa');//proses edit prestasi siswa
Route::get('prestasi/hapus/{id}',[PrestasiController::class, 'destroy'])->name('hapus_prestas');//hapus prestas siswa

//prestasi guru
Route::get('prestasi/guru',[PrestasiController::class, 'index_guru'])->name('prestasi/guru');//data prestasi guru
Route::get('prestasi/tambah_guru',[PrestasiController::class, 'create_guru'])->name('prestasi/tambah_guru');//prestasi guru
Route::post('prestasi/tambah_guru',[PrestasiController::class, 'store'])->name('prestasi.store');//proses tambah prestasi guru
Route::get('prestasi/edit_guru/{id}',[PrestasiController::class, 'edit_guru'])->name('prestasi/edit_guru');//edit prestasi guru
Route::post('updateguru/{id}',[PrestasiController::class, 'update'])->name('updateguru');//proses edit prestasi guru
Route::get('prestasi/hapus/{id}',[PrestasiController::class, 'destroy'])->name('hapus_prestas');//hapus prestas guru

//absen siswa harian
Route::get('harian/harian',[HarianController::class, 'index'])->name('harian/harian');//data absen siswa harian
Route::get('harian/absen',[HarianController::class, 'absen'])->name('harian/absen');//data absen siswa harian
Route::get('harian/siswa',[HarianController::class, 'siswa'])->name('harian/siswa');//data absen siswa harian

//jurnal mengajar
Route::get('jurnal/jurnal',[JurnalController::class, 'index'])->name('jurnal/jurnal');//menapilkan data jurnal
Route::get('jurnal/tambah_jurnal/{id}',[JurnalController::class, 'create'])->name('jurnal/tambah_jurnal');// tambah jurnal
Route::post('jurnal/tambah_jurnal/{id}',[JurnalController::class, 'store'])->name('jurnal.store');//proeses tambah jurnal
Route::get('jurnal/edit_jurnal/{id}',[JurnalController::class, 'edit'])->name('jurnal/edit_jurnal');// edit jurnal
Route::post('updatejurnal/{id}',[JurnalController::class, 'update'])->name('updatejurnal');//proeses Update jurnal
Route::get('jurnal/hapus_jurnal/{id}',[JurnalController::class, 'destroy'])->name('hapus_jurnal');//hapus prestas guru

//semester1
Route::get('semester/pilihan',[SemesterController::class, 'pilih'])->name('semester/pilihan');
Route::get('semester/semester1',[SemesterController::class, 'index1'])->name('semester/semester1');
Route::get('semester/tambah/{id}/{nilai}/{kelas}/{mapel}',[SemesterController::class,'nilai'])->name('semester/tambah');
Route::get('semester/edit/{id}/{mapel}/{kelas}',[SemesterController::class,'edit'])->name('semester/edit');
Route::post('tambah_uts',[SemesterController::class,'store1'])->name('tambah_uts');
Route::post('update_uts/{id}',[SemesterController::class, 'update1'])->name('update_uts');//Tambah nilai

//akhir
Route::get('akhir/pilih',[AkhirController::class, 'pilih'])->name('akhir/pilih');
Route::get('akhir/rapot',[AkhirController::class, 'raport'])->name('akhir/rapot');

//pelanggaran
Route::get('pelanggaran/pelanggaran',[PelanggaranController::class,'index'])->name('pelanggaran/pelanggaran');
Route::get('pelanggaran/tambah',[PelanggaranController::class,'tambah'])->name('pelanggaran/tambah');
Route::post('pelanggaran/tambah',[PelanggaranController::class,'store'])->name('pelanggaraan.store');
Route::get('pelanggaran/edit/{id}',[PelanggaranController::class,'edit'])->name('pelanggaran/tambah');
Route::post('update/{id}',[PelanggaranController::class,'update'])->name('update');
Route::get('pelanggaran/hapus/{id}',[PelanggaranController::class,'destroy'])->name('hapus');

//cetak
Route::get('siswa/cetak', [SiswaController::class, 'cetak_siswa'])->name('siswa/cetak');//cetak siswa
Route::get('siswa/cetak_data_siswa', [SiswaController::class, 'cetak_data_siswa'])->name('siswa/cetak_data_siswa');//cetak data siswa
Route::get('data_guru/cetak', [GuruController::class, 'cetak_guru'])->name('guru/cetak');//cetak guru
Route::get('absensi/cetak_guru', [AbsenController::class, 'cetak_guru'])->name('absensi/cetak_guru');//cetak guru
Route::get('absensi/cetak_presensi/id={id}&mapel={mapel}', [PresensiController::class, 'cetak'])->name('absensi/cetak_presensi');//cetak presesnsi 
Route::get('absensi/cetak_mapel', [PresensiController::class, 'cetak_mapel'])->name('absensi/cetak_mapel');//cetak absen mapel
Route::get('profil/cetak/{id}', [GuruController::class, 'cetak_profil'])->name('profil/cetak');//cetak profil
Route::get('profil/profilsiswa/cetak_kartu/{id}', [SiswaController::class, 'cetak_kartu'])->name('siswa/cetak_kartu');//cetak kartu absen
Route::get('prestasi/cetak_prestasi', [PrestasiController::class, 'cetak_siswa'])->name('prestasi/cetak_prestasi');//cetak prestasi
Route::get('prestasi/cetak', [PrestasiController::class, 'cetak_guru'])->name('prestasi/cetak');//cetak prestasi guru
Route::get('harian/cetak', [PrestasiController::class, 'cetak_guru'])->name('prestasi/cetak');//cetak prestasi guru
Route::get('harian/cetak', [HarianController::class, 'cetak'])->name('harian/cetak');//cetak absen harian
Route::get('absensi/cetak_siswa', [AbsenController::class, 'cetak_siswa'])->name('absensi/cetak_siswa');//cetak absen harian
Route::get('jurnal/cetak',[JurnalController::class, 'cetak'])->name('jurnal/cetak');//hapus prestas guru
Route::get('nilai/cetak_nilai/id={id}',[NilaiController::class, 'cetak'])->name('nilai/cetak_nilai');//hapus prestas guru
Route::get('nilai/cetak_siswa',[NilaiController::class, 'cetak_siswa'])->name('nilai/cetak_siswa');//cetak nilai siswa
Route::get('poin/cetak', [PoinController::class, 'cetak_poin'])->name('poin/cetak');//cetak siswa
Route::get('poin/surat/{id}', [PoinController::class, 'cetak_surat'])->name('poin/surat');//cetak surat panggailan 
Route::get('semester/cetak',[SemesterController::class,'cetak1'])->name('semester/cetak');
Route::get('akhir/cetak/{id}',[AkhirController::class,'cetak'])->name('akhir/cetak');
Route::get('pelanggaran/cetak',[PelanggaranController::class,'cetak'])->name('pelanggaran/cetak');