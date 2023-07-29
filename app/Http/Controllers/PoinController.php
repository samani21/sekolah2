<?php

namespace App\Http\Controllers;

use App\Models\Poin;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoinController extends Controller
{
    public function index(Request $request){
        $id_user = Auth::user()->id;
        $kelas = Auth::user()->kelas;
        $cari = $request->cari;

        $id = Auth::user()->id;
        $user = User::findorfail($id);

        $kelas1 = DB::table('kelas')->get();

        $it = 1;
        $id_tahun = Tahun::findorfail($it);

        $guru = DB::table('tb_guru')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach ($guru as $g)

        if (Auth::user()->kelas == "-"){
            if($g->wakel == "-" || $g->wakel == "BK"){
                $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                ->join('users','users.id','=','poin.id_user')
                ->select('poin.tahun','kelas','nis','nama','poin.tgl','ket','poin.poin','poin.id')
                ->where('nama','like',"%".$cari."%")
                ->orWhere('nis','like',"%".$cari."%")
                ->orWhere('poin.tgl','like',"%".$cari."%")
                ->orWhere('poin.tahun','like',"%".$cari."%")
                ->paginate(10);
            }
        }

        $ta = DB::table('poin')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        return view('poin/poin',['poin'=>$poin,'user'=>$user,'kelas1'=>$kelas1,'ta'=>$ta,'tahun'=>$id_tahun,'g'=>$g,'title'=>'Point Kedisiplinan']);
    }
    
    public function create($id){
        $siswa = Siswa::findorfail($id);
        $tahun = Tahun::findorfail(1);
        $data['title'] =  "Tambah Poin";
        return view('poin/tambah_point',compact('siswa','tahun'), $data);
    }

    public function store(Request $request){
        $point = new Poin([
            'id_siswa' => $request->id_siswa,
            'id_user' => $request->id_user,
            'poin' => $request->poin,
            'tgl' => $request->tgl,
            'ket' => $request->ket,
            'tahun' => $request->tahun,
        ]);
        $point->save();
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }

    public function edit($id){
        $poin = Poin::findorfail($id);

        $tahun = Tahun::findorfail(1);

        $id_siswaa = $poin->id_siswa;
        $siswa = Siswa::findorfail($id_siswaa);

        $data['title'] =  "Edit Poin";
        return view('poin/edit',compact('siswa','tahun','poin'), $data);
    }

    public function update(Request $request,$id){
        $edit = Poin::findorfail($id);
        $data = [
           'poin'=>$request->poin,
           'tgl'=>$request->tgl,
           'ket'=>$request->ket,

        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Edit Poin berhasil');
        return redirect()->route('poin/poin');
    }
    public function destroy($id){
        $poin = Poin::find($id);
        $poin->delete();
        toast('Berhasil menghapus data','success');
        return redirect('poin/poin');
    }
}
