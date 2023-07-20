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
        if($cari = $cari){
            $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
            ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
            ->where('id_guru','=',''.$a->id.'')
            ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            
        }else{
            $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
            ->where('tahun','=',''.$tahun['tahun'].'')
            ->where('id_guru','=',''.$a->id.'')
            ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
        }
        if($akun == "Tata_usaha"|| $akun == "Super_admin"){
            if($cari = $cari){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
                
            }else{
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun['tahun'].'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            }
        }
        $data ['title'] = "Absen Guru";
        return view('absensi.absen_guru',compact('absen','absen_guru'),$data);
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
            'tgl' => date('d-m-Y'),
            'jam_mulai'=> date('H:i:s'),
            'jam_selesai'=> "-",
            'tahun'=> stripslashes($tahun['tahun'])
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
        
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $akun = Auth::user()->level;
        $id_user = Auth::user()->id;
        $absen = DB::table('tb_guru')->where('id_user','=',$id_user)->get();
        foreach ($absen as $a)
        $ab = $a->id;
        if($cari = $cari){
            $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
            ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
            ->where('id_guru','=',''.$a->id.'')
            ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            
        }else{
            $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
            ->where('tahun','=',''.$tahun['tahun'].'')
            ->where('id_guru','=',''.$a->id.'')
            ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
        }
        if($akun == "Tata_usaha"|| $akun == "Super_admin"){
            if($cari = $cari){
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','like',"%".$cari."%")->orWhere('absen_guru.tgl','like',"%".$cari."%")
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
                
            }else{
                $absen_guru = DB::table('absen_guru')->join('tb_guru','tb_guru.id','=','absen_guru.id_guru')
                ->where('tahun','=',''.$tahun['tahun'].'')
                ->select('absen_guru.tgl','jam_mulai','jam_selesai','tahun','absen_guru.id','nip','nama')->paginate(10);
            }
        }
        $pdf = PDF::loadView('absensi/cetak_guru',compact('absen_guru'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

//Siswa
    public function index_siswa(){
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas1 = DB::table('kelas')->get();

        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $kelas = Auth::user()->kelas;

        $siswa = Auth::user()->id;
        $d_siswa = DB::table('tb_siswa')->where('id_user','=',''.$siswa.'')->get();
        foreach ($d_siswa as $sis)
        $a_siswa = $sis->tgl_absen;

        $tah = $tahun->tahun;
        $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->where('kelas','=',''.$kelas.'')
        ->where('tahun','=',''.$tah.'')
        ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','tahun','tb_guru.nama','presensi.id')
        ->orderBy('id','desc')
        ->paginate(10);
        $data ['title'] = "Absensi Siswa";
        return view('absensi.absen_siswa',compact('presensi','a_siswa','kelas1','user','tahun'),$data);
    }

    public function store(Request $request, $id){
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $siswa = Auth::user()->id;
        $id_siswa = DB::table('tb_siswa')->where('id_user','=',''.$siswa.'')->get();
        foreach ($id_siswa as $id_s)
        $sis =$id_s->id;
        $absen = new AbsenSiswa([
            'id_siswa' => $sis,
            'id_presensi' => $id,
            'tgl' => date('d-m-Y'),
            'jam'=> date('H:i:s'),
            'tahun'=> stripslashes($tahun['tahun'])
        ]);
        $absen->save();

        $edit = Siswa::find($sis);
        $data = [
            'tgl_absen' => date('Y-m-d H:i:s'),
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Berhasil');
        return redirect()->back();
    }
}
