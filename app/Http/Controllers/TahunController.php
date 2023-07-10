<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    public function index(){
        $id = "1";
        $tahun = Tahun::find($id);
        $data['title'] = 'Atur tahun ajaran';
        return view('tahun/tahun_ajaran',compact(['tahun']),$data);
    }

    public function update(Request $request){
        $id = "1";
        $edit = Tahun::findorfail($id);
        $data = [
            'tahun' => $request->tahun,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Tahun ajaran berhasil');
        return redirect()->back();
    }
}
