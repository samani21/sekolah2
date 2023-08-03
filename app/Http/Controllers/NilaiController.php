<?php

namespace App\Http\Controllers;

use App\Models\AbsenSiswa;
use App\Models\Nilai;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class NilaiController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas1 = DB::table('kelas')->get();

        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $tah = $tahun->tahun;
        $kelas = Auth::user()->kelas;

        $siswa = Auth::user()->id;

        $d_siswa = DB::table('tb_siswa')->where('id_user','=',''.$siswa.'')->get();
        foreach ($d_siswa as $sis)
        $presensi = DB::table('absen_siswa')
        ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        ->select('mapel','kelas','presensi.tgl','jam','presensi.tahun','presensi.id','absen_siswa.semester','nilai')
        ->where('id_siswa','=',''.$sis->id.'')
        ->where('kelas','=',''.$kelas.'')
        ->where('presensi.tahun','=',''.$tah.'')
        ->where('presensi.tgl','like',"%".$cari."%")
        ->orderBy('id','desc')
        ->paginate(10);

        $tahun = Tahun::findorfail(1);
        // $d_siswa = DB::table('tb_siswa')->where('id_user','=',''.$siswa.'')->get();
        // foreach ($d_siswa as $sis)

        // $tah = $tahun->tahun;
        // $presensi = DB::table('absen_siswa')->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')
        // ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        // ->where('id_siswa','=',''.$sis->id.'')
        // ->where('kelas','=',''.$kelas.'')
        // ->where('presensi.tahun','=',''.$tah.'')
        // ->where('presensi.tgl','like',"%".$cari."%")
        // ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','presensi.id')
        // ->orderBy('id','desc')
        // ->paginate(10);
        $data ['title'] = "Nilai";
        return view('nilai.nilai',compact('presensi','tahun','user','kelas1'),$data);
    }

    public function lihat(Request $request,$id,$mapel){
        $cari = $request->cari;
        $presensi = DB::table('absen_siswa') ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        ->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('mapel','kelas','presensi.tgl','nis','absen_siswa.id as absen','tb_siswa.nama','presensi.tahun','absen_siswa.jam','presensi.id','tb_siswa.id as siswa','presensi.semester','absen_siswa.status','nilai','tb_guru.id as guru')
        ->where('id_presensi','=',''.$id.'')
        ->where('tb_siswa.nama','like',"%".$cari."%")
        ->paginate(10);
        $data ['title'] = "Pemberian Nilai siswa";
        return view('nilai.lihat_nilai',compact('presensi','id','mapel'),$data);
    }

    public function store(Request $request,$id){
        $id_presensi = $request->id_presensi;
        $mapel = $request->mapel;

        $presensi = new Nilai([
            'id_guru' => $request->guru,
            'id_presensi' => $request->id_presensi,
            'id_siswa' => $request->siswa,
            'tgl' => $request->tgl,
            'nilai' => $request->nilai,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
        ]);
        $presensi->save();

        $edit = AbsenSiswa::findorfail($id);
        $data = [
            'status'=>1,
            'nilai'=>$request->nilai,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah presensi siswa berhasil');
        return redirect('nilai/lihat_nilai/'.$id_presensi.'/'.$mapel.'');
    }

    public function update(Request $request,$id){
        $id_presensi = $request->id_presensi;
        $mapel = $request->mapel;
        $id_siswa =  $request->siswa;

        $id_nilai = DB::table('nilai')->where('id_siswa','=',''.$id_siswa.'')
        ->where('id_presensi','=',''.$id_presensi.'')->get();
        foreach ($id_nilai as $nilai)
        $edit = Nilai::findorfail($nilai->id);
        $data = [
            'nilai'=>$request->nilai,
        ];
        $edit->update($data);

        $edit = AbsenSiswa::findorfail($id);
        $data = [
            'status'=>1,
            'nilai'=>$request->nilai,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah presensi siswa berhasil');
        return redirect('nilai/lihat_nilai/'.$id_presensi.'/'.$mapel.'');
    }

    public function cetak (Request $request, $id){
        $cari = $request->cari;
        $nilai =  DB::table('nilai')
        ->join('tb_guru','tb_guru.id','=','nilai.id_guru')
        ->join('tb_siswa','tb_siswa.id','=','nilai.id_siswa')
        ->join('presensi','presensi.id','=','nilai.id_presensi')
        ->select('presensi.tgl','tb_guru.nama as nm_guru','nis','tb_siswa.nama as nm_siswa','presensi.kelas','presensi.mapel','nilai.nilai')
        ->where('id_presensi','=',''.$id.'')
        ->where('tb_siswa.nama','like',"%".$cari."%")
        ->get();

        $ta = DB::table('presensi')
        ->where('id','=',''.$id.'')
        ->get();
        foreach ($ta as $t)
        $pdf = PDF::loadView('nilai/cetak_nilai',compact('nilai','t'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_nilai.pdf');
    }

    public function cetak_siswa(Request $request){

        $cari = $request->cari;
        $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach ($siswa as $sis)
        $cari = $request->cari;
        $nilai =  DB::table('nilai')
        ->join('tb_guru','tb_guru.id','=','nilai.id_guru')
        ->join('tb_siswa','tb_siswa.id','=','nilai.id_siswa')
        ->join('presensi','presensi.id','=','nilai.id_presensi')
        ->select('presensi.tgl','tb_guru.nama as nm_guru','id_siswa','nis','tb_siswa.nama as nm_siswa','presensi.kelas','presensi.mapel','nilai.nilai')
        ->where('id_siswa','=',''.$sis->id.'')
        ->get();
        // $siswa1 = DB::table('absen_siswa')->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')
        // ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        // ->select('mapel','absen_siswa.tgl','jam','presensi.tahun')
        // ->where('id_siswa','=',''.$sis->id.'')
        // ->where('absen_siswa.tgl','like',"%".$cari."%")
        // ->get();
        $pdf = PDF::loadView('nilai/cetak_siswa',compact('nilai','sis'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_nilai.pdf');
    }
}
