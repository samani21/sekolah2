<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AkhirController extends Controller
{
    public function pilih(){
        $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach($siswa as $sis)
        $nilai = DB::table('nilai')
        ->select('kelas','tahun')
        ->where('id_siswa','=',''.$sis->id.'')
        ->groupBy('kelas','tahun')
        ->get();
        $data ['title']="RAPOT";
        return view('akhir.pilih',compact('nilai'),$data);
    }
    public function raport(Request $request){
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $semester = $request->semester;
        $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach($siswa as $sis)
        $nilai = DB::table('nilai')
        ->join('presensi','presensi.id','=','nilai.id_presensi')
        ->select(DB::raw("((SUM(nilai.nilai)/(COUNT(presensi.mapel)-1))+SUM(uts)+SUM(uas))/3 AS hasil"),DB::raw("COUNT(presensi.mapel)-1 AS aa"),'nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->where('nilai.id_siswa','=',''.$sis->id.'')
        ->where('nilai.tahun','like',"%".$tahun."%")
        ->where('nilai.kelas','like',"%".$kelas."%")
        ->where('nilai.semester','like',"%".$semester."%")
        ->groupBy('nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->having(DB::raw("COUNT(presensi.mapel)-1"),'>',0)
        ->get();
        $data ['title']="RAPOT";
        return view('akhir.rapot',compact('nilai','kelas','tahun','semester'),$data);
    }

    public function cetak(Request $request,$id){
        $kelas = $request->kelas;
        $tahun = $request->tahun;
        $semester = $request->semester;
        $siswa = DB::table('tb_siswa')->where('id_user','=',''.$id.'')->get();
        foreach($siswa as $sis)
        $nilai = DB::table('nilai')
        ->join('presensi','presensi.id','=','nilai.id_presensi')
        ->select(DB::raw("((SUM(nilai.nilai)/(COUNT(presensi.mapel)-1))+SUM(uts)+SUM(uas))/3 AS hasil"),DB::raw("COUNT(presensi.mapel)-1 AS aa"),'nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->where('nilai.id_siswa','=',''.$sis->id.'')
        ->where('nilai.tahun','like',"%".$tahun."%")
        ->where('nilai.kelas','like',"%".$kelas."%")
        ->where('nilai.semester','like',"%".$semester."%")
        ->groupBy('nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->having(DB::raw("COUNT(presensi.mapel)-1"),'>',0)
        ->get();
        $nilai1 = DB::table('nilai')
        ->join('presensi','presensi.id','=','nilai.id_presensi')
        ->select(DB::raw("((SUM(nilai.nilai)/(COUNT(presensi.mapel)-1))+SUM(uts)+SUM(uas))/3 AS hasil"),DB::raw("COUNT(presensi.mapel)-1 AS aa"),'nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->where('nilai.id_siswa','=',''.$sis->id.'')
        ->where('nilai.tahun','like',"%".$tahun."%")
        ->where('nilai.kelas','like',"%".$kelas."%")
        ->where('nilai.semester','like',"%".$semester."%")
        ->groupBy('nilai.mapel','nilai.kelas','nilai.tahun','nilai.semester','nilai.id_siswa')
        ->having('hasil','<','80')
        // ->having(DB::raw("((SUM(nilai.nilai)/(COUNT(presensi.mapel)-1))+SUM(uts)+SUM(uas))/3 AS hasil"),'<','80')
        ->count();
        $pdf = PDF::loadView('akhir/cetak',compact('nilai','sis','kelas','tahun','semester','nilai1'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_nilai.pdf');
    }
}
