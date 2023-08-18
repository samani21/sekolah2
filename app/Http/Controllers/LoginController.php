<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use App\Models\Harian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(Request $request){
        $tahun = $request->tahun;
        $bulan =  Siswa::select(DB::raw("tahun as ba"))
        ->orderBy('ba','asc')
        ->GroupBy(DB::raw("tahun"))
        ->pluck('ba');
        $jum =  DB::table('tb_siswa')->select(DB::raw("COUNT(tahun) as jumlah"))
        ->GroupBy(DB::raw("tahun"))
        ->pluck('jumlah');

        $tanggal = Harian::select(DB::raw("tgl as ba"))
        ->orderBy('ba','asc')
        ->GroupBy(DB::raw("tgl"))
        ->pluck('ba');

        $absen= Harian::select(DB::raw("COUNT(tgl) as jumlah"))
        ->GroupBy(DB::raw("tgl"))
        ->pluck('jumlah');
        return view('dashboard/dashboard',['title'=>'Dashboard','jum'=>$jum,'bulan'=>$bulan,'tanggal'=>$tanggal,'absen'=>$absen]);
    }

    public function dashboard(Request $request){
        $tahun = $request->tahun;
        $bulan =  Siswa::select(DB::raw("tahun as ba"))
        ->orderBy('ba','asc')
        ->GroupBy(DB::raw("tahun"))
        ->pluck('ba');
        $jum =  DB::table('tb_siswa')->select(DB::raw("COUNT(tahun) as jumlah"))
        ->GroupBy(DB::raw("tahun"))
        ->pluck('jumlah');

        $tanggal = Harian::select(DB::raw("tgl as ba"))
        ->orderBy('ba','asc')
        ->GroupBy(DB::raw("tgl"))
        ->pluck('ba');

        $absen= Harian::select(DB::raw("COUNT(tgl) as jumlah"))
        ->GroupBy(DB::raw("tgl"))
        ->pluck('jumlah');
        return view('dashboard/dashboard',['title'=>'Dashboard','jum'=>$jum,'bulan'=>$bulan,'tanggal'=>$tanggal,'absen'=>$absen]);
    }
}
