<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\Siswa;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    //prestasi siswa
    public function index_siswa(){
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $user = Auth::user()->id;
        if(Auth::user()->level == "Siswa"){
            $prestasi = DB::table('prestasi')->join('tb_siswa','tb_siswa.id','=','prestasi.id_siswa')
            ->where('status','=','siswa')
            ->where('id_user','=',''.$user.'')
            ->select('prestasi.tahun','nama','nm_kegiatan','capaian','tingkat','waktu','bukti','prestasi.id')
            ->paginate(10);
        }else{
            $prestasi = DB::table('prestasi')->join('tb_siswa','tb_siswa.id','=','prestasi.id_siswa')
        ->where('status','=','siswa')
        ->select('prestasi.tahun','nama','nm_kegiatan','capaian','tingkat','waktu','bukti','prestasi.id')
        ->paginate(10);
        }
        $data['title'] = "Prestasi Siswa";
        return view('prestasi.siswa',['tahun'=>$id_tahun,'prestasi'=>$prestasi],$data);
    }

    // prestasi guru
    public function index_guru(){
        $prestasi = DB::table('prestasi')->join('tb_guru','tb_guru.id','=','prestasi.id_guru')
        ->where('prestasi.status','=','guru')
        ->select('prestasi.tahun','nama','nm_kegiatan','capaian','tingkat','waktu','bukti','prestasi.id')
        ->paginate(10);
        $data['title'] = "Prestasi guru";
        return view('prestasi.guru',['prestasi'=>$prestasi],$data);
    }

    //Tambah prestasi guru
    public function create_guru(){
        $guru = Guru::all();
        $data['title']= "Tambah Prestasi Guru";
        return view('prestasi/tambah_guru',$data,['guru' => $guru]);
    }

    //Tambah prestasi siswa
    public function create_siswa(){
        $siswa = Siswa::all();
        $data['title']= "Tambah Prestasi Siswa";
        return view('prestasi/tambah_siswa',$data,['siswa' => $siswa]);
    }

    public function store(Request $request){
        $id_siswa = substr($request->id_siswa,0,4);
        $id_guru = substr($request->id_guru,0,4);
        $prestasi = new Prestasi([
            'id_siswa' => $id_siswa,
            'id_guru' => $id_guru,
            'nm_kegiatan' => $request->nm_kegiatan,
            'capaian' => $request->capaian,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'waktu' => $request->waktu,
            'bukti' => $request->bukti,
            'status' => $request->status,
        ]);
        $prestasi->save();
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        if($request->status == "siswa"){
            return redirect()->route('prestasi/siswa');
        }
        if($request->status == "guru"){
            return redirect()->route('prestasi/guru');
        }
    }

    //edit prestasi siswa
    public function edit_siswa($id){
        $siswa = DB::table('prestasi')->join('tb_siswa','tb_siswa.id','=','prestasi.id_siswa')
        ->where('prestasi.id','=',''.$id.'')
        ->select('prestasi.tahun','nama','nm_kegiatan','capaian','tingkat','waktu','bukti','prestasi.id')
        ->paginate(1);
        $data['title'] = 'Edit Prestasi Siswa';
        return view('prestasi/edit_siswa',compact(['siswa']),$data);
    }

    //edit prestasi guru
    public function edit_guru($id){
        $guru = DB::table('prestasi')->join('tb_guru','tb_guru.id','=','prestasi.id_guru')
        ->where('prestasi.id','=',''.$id.'')
        ->select('prestasi.tahun','nama','nm_kegiatan','capaian','tingkat','waktu','bukti','prestasi.id')
        ->paginate(1);
        $data['title'] = 'Edit Prestasi gurus';
        return view('prestasi/edit_guru',compact(['guru']),$data);
    }

    public function update(Request $request, $id){
        $edit = Prestasi::findorfail($id);
        $data = [
            'nm_kegiatan' => $request->nm_kegiatan,
            'capaian' => $request->capaian,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'waktu' => $request->waktu,
            'bukti' => $request->bukti,
        ];
        $edit->update($data);
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        if($request->status == "siswa"){
            return redirect()->route('prestasi/siswa');
        }
        if($request->status == "guru"){
            return redirect()->route('prestasi/guru');
        }
    }
    public function destroy($id){
        $prestasi = Prestasi::find($id);
        $prestasi->delete();
        toast('Berhasil menghapus data','success');
        if($prestasi->status == "siswa"){
            return redirect('prestasi/siswa');
        }
        if($prestasi->status == "guru"){
            return redirect('prestasi/guru');
        }
    }
}
