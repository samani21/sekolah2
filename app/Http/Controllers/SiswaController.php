<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDF;

class SiswaController extends Controller
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

        if (Auth::user()->kelas == "-"){
            $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
            ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        // ->where('id_user','=',''.$id_user.'')
        
        ->paginate(10);
        }else{
            $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->where('kelas','=',''.$kelas.'')
        ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis')
        ->paginate(10);
        }
        
        return view('siswa/siswa',['siswa'=>$siswa,'user'=>$user,'kelas1'=>$kelas1,'tahun'=>$id_tahun,'title'=>'Data Siswa']);
    }

    public function create(){
        $data['title']= "Data Siswa";
        return view('siswa/tambah_siswa',$data);
    }

    public function store(Request $request){
        $id = $request->id_user;
        $siswa = new Siswa([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'tgl_absen' => "0",
            'nis' => $request->nis,
        ]);
        $siswa->save();

        $edit = User::findorfail($id);
        $data = [
            'status' => $request->status,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }

    

    public function edit_siswa($id){
        $siswa2 = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->where('tb_siswa.id','=',''.$id.'')
        ->select('nama','tb_siswa.id','kelas','nis','nik','tempat','tgl','agama','jk','alamat','id_user')
        ->paginate(1);
        $kelas = DB::table('kelas')->get();
        $data['title'] = 'Edit Siswa';
        return view('siswa/edit_siswa',compact(['siswa2','kelas']),$data);
    }

    public function update(Request $request, $id){
        $id_user = $request->id_user;

        $edit = Siswa::findorfail($id);
        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'nis' => $request->nis,
        ];
        $edit->update($data);

        $edit = User::findorfail($id_user);
        $data = [
            'kelas' => $request->kelas
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }
    public function destroy($id){
        $siswa = Siswa::find($id);
        $siswa->delete();
        toast('Berhasil menghapus data','success');
        return redirect('siswa/siswa');
    }

    public function profil($id){
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas = DB::table('kelas')->get();
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_siswa.id','nis')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        return view('profil.profil',['siswa'=>$siswa,'tahun'=>$id_tahun,'user'=>$user,'kelas'=>$kelas],$data);
    }

    public function cetak_siswa(Request $request)
    {   
        // $tgl = $request->tgl;
        $cari = $request->cari;
        $siswa = DB::table('tb_siswa')->where('nama','LIKE',"%".$cari."%")
        ->orWhere('nik','LIKE',"%".$cari."%")->get();
        $pdf = PDF::loadView('siswa/cetak',compact('siswa'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

    public function edit_kelas(){
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas = DB::table('kelas')->get();
        return view('profil.edit_kelas',['title'=>"Edit Kelas",'user'=>$user,'kelas'=>$kelas]);
    }

    public function updatekelas(Request $request,$id){
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $edit = User::findorfail($id);
        $data = [
            'kelas' => $request->kelas,
            'tahun' => $id_tahun->tahun
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update kelas berhasil');
        return redirect()->back();
    }
}
