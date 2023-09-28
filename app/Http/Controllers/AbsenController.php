<?php

namespace App\Http\Controllers;

use App\Models\AbsenGuru;
use App\Models\AbsenSiswa;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class AbsenController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $akun = Auth::user()->level;
        $id_user = Auth::user()->id;
        $absen = DB::table('tb_guru')->where('id_user','=',$id_user)->get();
        foreach ($absen as $a)
        $ab = $a->id;
        if($akun == "Tata_usaha"|| $akun == "Super_admin"){
            if($cari = $cari){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
                
            }else{
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun['tahun'].'')
                ->where('semester','like',''.$tahun['sem'].'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            }
        }else{
            if($cari = $cari){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")
                ->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->where('id_guru','=',''.$a->id.'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
                
            }else{
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun['tahun'].'')
                ->where('id_guru','=',''.$a->id.'')
                ->where('semester','like',''.$tahun['sem'].'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            }
        }

        $ta = DB::table('absen_guru')
        ->select(DB::raw('distinct(tahun)'),'semester')
        ->get();
        $data ['title'] = "Absen Guru";
        return view('absensi.absen_guru',compact('absen','absen_guru','ta'),$data);
    }

    public function update(Request $request, $id){
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $edit = Guru::findorfail($id);
        $data = [
            'tgl_absen' => date('d-m-Y'),
        ];
        $edit->update($data);

        $absen = new AbsenGuru([
            'id_guru' => $id,
            'tgl' => date('Y-m-d'),
            'jam_mulai'=> date('H:i:s'),
            'jam_selesai'=> "-",
            'tahun'=> stripslashes($tahun['tahun']),
            'semester'=> $tahun['sem']
        ]);
        $absen->save();
        Alert()->success('SuccessAlert','Berhasil');
        return redirect()->back();
    }

    public function selesai(Request $request, $id){
        $edit = AbsenGuru::findorfail($id);
        $data = [
            'jam_selesai' => date('H:i:s'),
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert',' Berhasil');
        return redirect()->back();
    }

    public function cetak_guru(Request $request)
    {   
        $cari = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $ta = $request->ta;
        $tahun_ajaran = substr($request->ta,0,9);
        $semester = substr($request->ta,10);
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $akun = Auth::user()->level;
        $id_user = Auth::user()->id;
       
        if($akun == "Tata_usaha"|| $akun == "Super_admin"){
            if($cari == $cari && $ta == ""){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->orWhere('nama','like',"%".$cari."%")
                ->orWhere('nip','like',"%".$cari."%")
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
                
            }
            if($cari == "" && $ta == $ta){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun_ajaran.'')
                ->where('semester','=',''.$semester.'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
                
            }
            if($cari == "" && $ta == ""){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->whereBetween('absen_guru.tgl',[$dari,$sampai])
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
            }
        }else{
            $absen = DB::table('tb_guru')->where('id_user','=',$id_user)->get();
            foreach ($absen as $a)
            $ab = $a->id;
            if($cari = $cari){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->where('id_guru','=',''.$a->id.'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
                
            }
            if($cari == "" && $ta == $ta){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun_ajaran.'')
                ->where('id_guru','=',''.$a->id.'')
                ->where('semester','=',''.$semester.'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
                
            }
            if($cari == "" && $ta == ""){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun['tahun'].'')
                ->where('id_guru','=',''.$a->id.'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama','semester')->get();
            }
        }
        $pdf = PDF::loadView('absensi/cetak_guru',compact('absen_guru','dari','sampai'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_guru.pdf');
    }

//Siswa
    public function index_siswa(Request $request){
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
        ->select('mapel','kelas','presensi.tgl','jam','presensi.tahun','presensi.id','absen_siswa.semester')
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
        $data ['title'] = "Absensi Siswa";
        return view('absensi.absen_siswa',compact('presensi','tahun','user','kelas1'),$data);
    }

    public function store(Request $request, $id){
        $id_siswa = $request->id;
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $absen = new AbsenSiswa([
            'id_siswa' => $id_siswa,
            'id_presensi' => $id,
            'tgl' => date('Y-m-d'),
            'jam'=> date('H:i:s'),
            'tahun'=> stripslashes($tahun['tahun']),
            'semester'=> $tahun['sem'],
            'nilai'=> 0,
            'status'=> 0,
        ]);
        $absen->save();

        $edit = Siswa::find($id_siswa);
        $data = [
            'tgl_absen' => date('Y-m-d H:i:s'),
            'presensi' => $id,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Berhasil');
        return redirect()->back();
    }

    public function cetak_siswa(Request $request)
    {   
        $cari = $request->cari;
        $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach ($siswa as $sis)
        $cari = $request->cari;
        $siswa1 = DB::table('absen_siswa')->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')
        ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        ->select('mapel','absen_siswa.tgl','jam','presensi.tahun')
        ->where('id_siswa','=',''.$sis->id.'')
        ->where('absen_siswa.tgl','like',"%".$cari."%")
        ->get();
        $pdf = PDF::loadView('absensi/cetak_siswa',compact('siswa1','sis'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_absen_siswa.pdf');
    }
}
