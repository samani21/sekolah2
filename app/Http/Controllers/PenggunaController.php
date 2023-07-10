<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
            'level' =>$request->level,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('pengguna/pengguna');
    }
}
