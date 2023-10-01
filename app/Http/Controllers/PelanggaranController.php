<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PelanggaranController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $data['title'] = 'Tambah Pelanggaran';
        $pelanggaran = DB::table('pelanggaran')
        ->where('pelanggaran','like',"%".$cari."%")
        ->orWhere('bobot','like',"%".$cari."%")
        ->paginate(10);
        return view('pelanggaran.pelanggaran',compact('pelanggaran'),$data);
    }

    public function tambah(){
        $data['title'] = 'Tambah Pelanggaran';
        return view('pelanggaran.tambah',$data);
    }

    public function store(Request $request){
        $pelanggaran = new Pelanggaran([
            'pelanggaran' =>$request->pelanggaran,
            'bobot' =>$request->bobot,
        ]);
        $pelanggaran->save();
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect('pelanggaran/pelanggaran');
    }


    public function edit(Request $request, $id){
        $pelanggaran = Pelanggaran::findorfail($id);
        $data['title'] = 'Edit Pelanggaran';
        return view('pelanggaran.edit',compact('pelanggaran'),$data);
    }

    public function update(Request $request, $id){
        $pelanggaran = Pelanggaran::findorfail($id);
        $data = [
            'pelanggaran' =>$request->pelanggaran,
            'bobot' =>$request->bobot,
        ];
        $pelanggaran->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect('pelanggaran/pelanggaran');
    }
    public function destroy($id){
        $kelas = Pelanggaran::find($id);
        $kelas->delete();
        toast('Berhasil menghapus data','success');
        return redirect('pelanggaran/pelanggaran');
    }

    public function cetak (Request $request){
        $cari = $request->cari;
        $pelanggaran = DB::table('pelanggaran')
        ->where('pelanggaran','like',"%".$cari."%")
        ->orWhere('bobot','like',"%".$cari."%")
        ->get();
        $pdf = PDF::loadView('pelanggaran/cetak',compact('pelanggaran'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_pelanggaran.pdf');
    }
}
