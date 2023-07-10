<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SiswaController extends Controller
{
    public function index(Request $request){
        $id_user = Auth::user()->id;
        $kelas = Auth::user()->kelas;
        $cari = $request->cari;
        
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
        
        return view('siswa/siswa',['siswa'=>$siswa,'title'=>'Data Siswa']);
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
        $siswa = Siswa::find($id);
        $data['title'] = 'Edit Siswa';
        return view('siswa/edit_siswa',compact(['siswa']),$data);
    }

    public function update(Request $request, $id){
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
        $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_siswa.id','nis')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        return view('profil.profil',['siswa'=>$siswa],$data);
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
}
