<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class KelasController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $kelas = DB::table('kelas')->where('nm_kelas','like',"%".$cari."%")->paginate(10);
        $data['title'] = "Setting kelas";
        return view('kelas/kelas',compact('kelas'),$data);
    }

    public function create(){
        $data['title']= "Tambah kelas Kelas";
        return view('kelas/tambah_kelas',$data);
    }

    public function store(Request $request){
        $kelas = new Kelas([
            'nm_kelas' => $request->nm_kelas,
        ]);
        $kelas->save();
        Alert()->success('SuccessAlert','Tambah data kelas berhasil');
        return redirect()->route('kelas/kelas');
    }

    public function edit_kelas($id){
        $kelas = Kelas::find($id);
        $data['title'] = 'Edit Kelas';
        return view('kelas/edit_kelas',compact(['kelas']),$data);
    }

    public function update(Request $request, $id){
        $edit = Kelas::findorfail($id);
        $data = [
            'nm_kelas' => $request->nm_kelas,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update data Kelas berhasil');
        return redirect()->route('kelas/kelas');
    }
    public function destroy($id){
        $kelas = Kelas::find($id);
        $kelas->delete();
        toast('Berhasil menghapus data','success');
        return redirect('kelas/kelas');
    }
}
