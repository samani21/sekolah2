<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HarianController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $id_url = 1;
        $url = Url::find($id_url);
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
            ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis','tb_siswa.tahun','tgl_harian')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->orWhere('tb_siswa.tahun','like',"%".$cari."%")
        // ->where('id_user','=',''.$id_user.'')
        
        ->paginate(10);
        $data['title']= "Absen siswa harian";
        return view('harian/harian',['siswa'=>$siswa,'tahun'=>$id_tahun,'url'=>$url],$data);
    }

    public function absen(Request $request, $id){
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $edit = Siswa::findorfail($id);
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
                    'tahun'=> stripslashes($tahun['tahun'])
                ]);
                $absen->save();
            }
        }
        Alert()->success('SuccessAlert','Berhasil');
        return redirect()->back();
    }

    public function cetak_kartu($id){
        $id_url = 1;
        $url = Url::find($id_url);
        return view('harian.cetak_kartu',['url'=>$url,'id'=>$id]);
    }
}
