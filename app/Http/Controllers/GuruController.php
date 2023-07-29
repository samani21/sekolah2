<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class GuruController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_guru.id','id_user','tb_guru.status','nip','wakel')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->paginate(10);
        return view('data_guru/guru',['title'=>'Data Guru','guru'=>$guru]);
    }

    public function create(){
        $data['title']= "Tambah Data";
        $kelas = DB::table('kelas')->get();
        return view('data_guru/tambah_guru',$data,['kelas'=>$kelas]);
    }

    public function store(Request $request){
        $id = $request->id_user;
        $guru = new Guru([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'tgl_absen' => $request->tgl_absen,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'status' => $request->status1,
            'nip' => $request->nip,
            'wakel' => $request->wakel,
        ]);
        $guru->save();

        $edit = User::findorfail($id);
        $data = [
            'status' => $request->status,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data GUru berhasil');
        return redirect()->route('guru/guru');
    }

    public function edit($id){
        $guru = Guru::find($id);
        $data['title'] = 'Edit Guru';
        $kelas = DB::table('kelas')->get();
        return view('data_guru/edit',compact(['guru','kelas']),$data);
    }
    public function update(Request $request, $id){
        $edit = Guru::findorfail($id);
        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'status' => $request->status1,
            'nip' => $request->nip,
            'wakel' => $request->wakel,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Guru berhasil');
        return redirect()->route('guru/guru');
    }

    public function destroy($id,$id_user){
        $guru = Guru::find($id);
        $guru->delete();

        $edit = User::findorfail($id_user);
        $data = [
            'status' => "0",
        ];
        $edit->update($data);
        toast('Berhasil menghapus data','success');
        return redirect('data_guru/guru');
    }

    public function profil($id){
        $tahun = Tahun::find(1);
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','id_user','nama','tempat','tgl','alamat','agama','jk','tb_guru.id','tb_guru.status','nip','wakel')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        return view('profil.profil',['guru'=>$guru,'tahun'=>$tahun],$data);
    }
    public function cetak_guru(Request $request)
    {   
        // $tgl = $request->tgl;
        $cari = $request->cari;
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_guru.id','id_user')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->orWhere('nip','like',"%".$cari."%")
        ->orWhere('level','like',"%".$cari."%")->get();
        $pdf = PDF::loadView('data_guru/cetak',compact('guru'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

    public function cetak_profil($id){
        $guru = DB::table('tb_guru')->join('users','users.id','=','tb_guru.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_guru.id','tb_guru.status','nip')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        
        $pdf = PDF::loadView('profil/cetak',compact('guru'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }
}
