<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunController;
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

Route::get('data_guru/guru', [GuruController::class,'index'])->name('guru/guru');//menampilkan data guru
Route::get('data_guru/tambah_guru', [GuruController::class,'create'])->name('guru/tambah_guru');//menampilkan tambah data guru
Route::post('data_guru/tambah_guru',[GuruController::class, 'store'])->name('guru.store');//proses tambah data guru
Route::get('data_guru/edit/{id}',[GuruController::class, 'edit'])->name('guru/edit');//menampilkan edit data guru
Route::post('updateguru/{id}',[GuruController::class, 'update'])->name('updateguru');//proses update guru
Route::get('data_guru/hapus_guru/{id}&{id_user}',[GuruController::class, 'destroy'])->name('hapus_guru');//hapus data guru

//profil
Route::get('profil/profil/{id}',[GuruController::class,'profil'])->name('profil/profil');//menampilkan data profil

//siswa
Route::get('siswa/siswa',[SiswaController::class, 'index'])->name('siswa/siswa');//menampilkan data siswa
Route::get('siswa/tambah_siswa',[SiswaController::class, 'create'])->name('siswa/tambah_siswa');//input siswa
Route::post('siswa/tambah_siswa',[SiswaController::class, 'store'])->name('siswa.store');//proses tambah data siswa
Route::get('siswa/edit_siswa/{id}',[SiswaController::class, 'edit_siswa'])->name('siswa/edit_siswa');//edit datasiswa
Route::post('updatesiswa/{id}',[SiswaController::class, 'update'])->name('updatesiswa');//proses edit data siswa
Route::get('siswa/hapus_siswa/{id}',[SiswaController::class, 'destroy'])->name('hapus_iswa');//hapus data siswa

Route::get('profil/profilsiswa/{id}',[SiswaController::class,'profil'])->name('profil/profilsiswa');//menampilkan data profil

//pengguna
Route::get('pengguna/pengguna', [PenggunaController::class,'index'])->name('pengguna/pengguna');//menampilkan data pengguna
Route::get('pengguna/edit_pengguna/{id}', [PenggunaController::class,'edit_pengguna'])->name('pengguna/edit_pengguna');//edit pengguna
Route::post('updatepengguna/{id}',[PenggunaController::class, 'update'])->name('updatepengguna');//proses upodate pengguna

//tahun ajaran
Route::get('tahun/tahun_ajaran', [TahunController::class,'index'])->name('tahun/tahun');//menampilkan halaman setting tahun ajaran
Route::post('update', [TahunController::class,'update'])->name('update');//proses update tahun ajaran

//kelas
Route::get('kelas/kelas',[KelasController::class, 'index'])->name('kelas/kelas');//menampilkan data kelas
Route::get('kelas/tambah_kelas',[KelasController::class, 'create'])->name('kelas/tambah_kelas');//input kelas
Route::post('kelas/tambah_kelas',[KelasController::class, 'store'])->name('kelas.store');//proses tambah data kelas
Route::get('kelas/edit_kelas/{id}',[KelasController::class, 'edit_kelas'])->name('siswa/edit_kelas');//edit datasiswa
Route::post('updatekelas/{id}',[KelasController::class, 'update'])->name('updatekelas');//proses edit data siswa
Route::get('kelas/hapus_kelas/{id}',[KelasController::class, 'destroy'])->name('hapus_kelas');//hapus data siswa

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
Route::get('absensi/proses_absen/{id}', [AbsenController::class, 'store'])->name('proses_absen');

//cetak
Route::get('siswa/cetak', [SiswaController::class, 'cetak_siswa'])->name('siswa/cetak');//cetak siswa
Route::get('data_guru/cetak', [GuruController::class, 'cetak_guru'])->name('guru/cetak');//cetak guru
Route::get('absensi/cetak_guru', [AbsenController::class, 'cetak_guru'])->name('absensi/cetak_guru');//cetak guru
Route::get('absensi/cetak_presensi/id{id}&mapel{mapel}', [PresensiController::class, 'cetak'])->name('absensi/cetak_presensi');//cetak presesnsi 
Route::get('absensi/cetak_mapel', [PresensiController::class, 'cetak_mapel'])->name('absensi/cetak_mapel');//cetak absen mapel
Route::get('profil/cetak/{id}', [GuruController::class, 'cetak_profil'])->name('profil/cetak');//cetak profil
