<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $pengguna = DB::table('users')
        ->where('name','like',"%".$cari."%")
        ->orWhere('username','like',"%".$cari."%")->paginate(10);
        $data['title'] = "Pengguna";
        return view('pengguna/pengguna',['pengguna'=>$pengguna],$data);
    }
    public function edit_pengguna($id){
        $pengguna = User::find($id);
        $data['title'] = "Edit Pengguna";
        return view('pengguna/edit_pengguna',['pengguna'=>$pengguna],$data);
    }

    public function update(Request $request,$id){
        $edit = User::findorfail($id);
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'password1' => $request->password,
            'kelas' =>$request->kelas,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        if(Auth::user()->level == "Siswa"){
            return redirect('profil/profilsiswa/'.$id.'');
        }
        if(Auth::user()->level == "Tata_usaha" || Auth::user()->level == "Guru"){
            return redirect('/profil/profil/'.$id.'');
        }
        if(Auth::user()->level == "Super_admin"){
            return redirect('/pengguna/pengguna');
        }
    }

    public function create(){
        $id = "1";
        $tahun = Tahun::find($id);
        $kelas = DB::table('kelas')->get();
        $data['title']= "Tambah akun siswa";
        return view('pengguna/tambah_siswa',$data,['tahun'=>$tahun,'kelas'=>$kelas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'password1' =>" $request->password",
            'level' =>substr($request->level,0,5),
            'status' =>$request->status,
            'kelas' =>substr($request->level,6),
            'tahun' =>$request->tahun
        ]);
        $user->save();

        event(new Registered($user));

        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('pengguna/pengguna');
    }

    public function ubah(){
        $user = User::find(Auth::user()->id);
        $data['title']="Ubah password";
        return view('profil.ubah_password',compact('user'),$data);
    }
}
