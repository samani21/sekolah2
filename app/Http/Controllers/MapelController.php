<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $mapel = DB::table('mapel')->where('mapel','like',"%".$cari."%")->paginate(10);
        $data['title'] = "Setting kelas";
        return view('mapel/mapel',compact('mapel'),$data);
    }

    public function create(){
        $data['title']= "Tambah mapel";
        return view('mapel/tambah_mapel',$data);
    }

    public function store(Request $request){
        $mapel = new mapel([
            'mapel' => $request->mapel,
        ]);
        $mapel->save();
        Alert()->success('SuccessAlert','Tambah data MAPEL berhasil');
        return redirect()->route('mapel/mapel');
    }

    public function edit_mapel($id){
        $mapel = mapel::find($id);
        $data['title'] = 'Edit Kelas';
        return view('mapel/edit_mapel',compact(['mapel']),$data);
    }

    public function update(Request $request, $id){
        $edit = mapel::findorfail($id);
        $data = [
            'mapel' => $request->mapel,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update data mapel berhasil');
        return redirect()->route('mapel/mapel');
    }
    public function destroy($id){
        $mapel = mapel::find($id);
        $mapel->delete();
        toast('Berhasil menghapus data','success');
        return redirect('mapel/mapel');
    }
}
