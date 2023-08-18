<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class HarianController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $id_url = 1;
        $url = Url::find($id_url);
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
            ->select('tb_siswa.updated_at','nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis','tb_siswa.tahun','tgl_harian')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->orWhere('tb_siswa.tahun','like',"%".$cari."%")
        ->orderBy('updated_at','desc')
        // ->where('id_user','=',''.$id_user.'')
        
        ->paginate(10);
        $data['title']= "Absen siswa harian";
        return view('harian/harian',['siswa'=>$siswa,'tahun'=>$id_tahun,'url'=>$url],$data);
    }

    public function siswa(Request $request){
        $cari = $request->cari;
        $it = 1;
        $tahun = Tahun::findorfail($it);
        if(Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha"){
            $siswa = DB::table('abs_harian')->join('tb_siswa','tb_siswa.id','=','abs_harian.id_siswa')
            ->join('users','users.id','=','abs_harian.id_user')
            ->select('abs_harian.tgl','nama','abs_harian.kelas','abs_harian.tahun','abs_harian.jam')
            ->where('abs_harian.tgl','like',"%".$cari."%")
            ->paginate(10);
        }else{
            $siswa = DB::table('abs_harian')->join('tb_siswa','tb_siswa.id','=','abs_harian.id_siswa')
            ->join('users','users.id','=','abs_harian.id_user')
            ->select('abs_harian.tgl','nama','abs_harian.kelas','abs_harian.tahun','abs_harian.jam')
            ->where('abs_harian.id_user','=',''.Auth::user()->id.'')
            ->where('abs_harian.tahun','=',''.$tahun->tahun.'')
            ->where('abs_harian.tgl','like',"%".$cari."%")
            ->paginate(10);
        }
        $data['title']= "Absen siswa harian";
        return view('harian/siswa',['siswa'=>$siswa],$data);
    }


    public function absen(Request $request){
        $id = $request->id;
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $edit = Siswa::findorfail($id);
        $kelas = DB::table('users')->where('id','=',''.$edit->id_user.'')->get();
        foreach ($kelas as $kel)
        if(isset(Auth::user()->level)){
            if(Auth::user()->level == "Super_admin"){
                $data = [
                    'tgl_harian' => date('Y-m-d'),
                ];
                $edit->update($data);
        
                $absen = new Harian([
                    'id_siswa' => $edit->id,
                    'id_user' => $edit->id_user,
                    'tgl' => date('Y-m-d'),
                    'jam'=> date('H:i:s'),
                    'tahun'=> stripslashes($tahun['tahun']),
                    'semester'=> $tahun->sem,
                    'kelas' => $kel->kelas
                ]);
                $absen->save();
            }
        }
        Alert()->success('SuccessAlert','Berhasil');
        return redirect()->back();
    }

    public function cetak(Request $request){
        $cari = $request->cari;
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        if(Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha"){
            if ($cari == ""){
                $dari = $request->dari;
                $sampai = $request->sampai;
                $siswa = DB::table('abs_harian')->join('tb_siswa','tb_siswa.id','=','abs_harian.id_siswa')
                ->join('users','users.id','=','abs_harian.id_user')
                ->select('abs_harian.tgl','nama','abs_harian.kelas','abs_harian.tahun','abs_harian.jam')
                ->where('abs_harian.tgl','like',"%".$cari."%")
                ->whereBetween('abs_harian.tgl',[$dari,$sampai])
                ->get();
            }else{
                $dari = "";
                $sampai = "";
                $siswa = DB::table('abs_harian')->join('tb_siswa','tb_siswa.id','=','abs_harian.id_siswa')
                ->join('users','users.id','=','abs_harian.id_user')
                ->select('abs_harian.tgl','nama','abs_harian.kelas','abs_harian.tahun','abs_harian.jam')
                ->where('abs_harian.tgl','like',"%".$cari."%")
                ->orWhere('nama','like',"%".$cari."%")
                ->orWhere('abs_harian.kelas','like',"%".$cari."%")
                ->orWhere('abs_harian.tahun','like',"%".$cari."%")
                ->get();
            }
        }else{
            $dari = $request->dari;
            $sampai = $request->sampai;
            $siswa = DB::table('abs_harian')->join('tb_siswa','tb_siswa.id','=','abs_harian.id_siswa')
            ->join('users','users.id','=','abs_harian.id_user')
            ->select('abs_harian.tgl','nama','abs_harian.kelas','abs_harian.tahun','abs_harian.jam')
            ->where('abs_harian.id_user','=',''.Auth::user()->id.'')
            ->where('abs_harian.tgl','like',"%".$cari."%")
            ->whereBetween('abs_harian.tgl',[$dari,$sampai])
            ->get();
        }
        $pdf = PDF::loadView('harian/cetak',compact('siswa','dari','sampai'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_harian.pdf');
    }
}
