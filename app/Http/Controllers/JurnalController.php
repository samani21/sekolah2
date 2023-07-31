<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Presensi;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    
    public function index(){
        $jurnal = DB::table('jurnal')
        ->join('presensi','presensi.id','=','jurnal.id_presensi')
        ->join('tb_guru','tb_guru.id','=','jurnal.id_guru')
        ->select('nama','presensi.tgl','presensi.tahun','presensi.semester','materi','kegiatan','penilaian','jurnal.id','jam_mulai','jam_selesai')
        ->paginate(10);
        $data['title']= "Data Jurnal Menagajar";
        return view('jurnal.jurnal',compact('jurnal'),$data);
    }

    public function create($id){
        $presensi = DB::table('presensi')
        ->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('presensi.id as presensi','tb_guru.id as guru','nama','mapel','presensi.kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','presensi.semester')
        ->where('presensi.id','=',''.$id.'')
        ->get();

        $tahun = Tahun::findorfail(1);

        foreach ($presensi as $pre)
        $data['title'] = "Tambah Jurnal Mengajar"; 
        return view('jurnal/tambah_jurnal',compact('pre','tahun'),$data) ;
    }

    public function store(Request $request){
        $id_presensi = $request->id_presensi;
        $jurnal = new Jurnal([
            'id_presensi'=>$request->id_presensi,
            'id_guru'=>$request->id_guru,
            'tgl'=>$request->tgl,
            'materi'=>$request->materi,
            'kegiatan'=>$request->kegiatan,
            'penilaian'=>$request->penilaian,
        ]);
        $jurnal->save();
        $edit = Presensi::findorfail($id_presensi);
        $data = [
            's_jurnal' =>1,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah Jurnal mengajar berhasil');
        return redirect()->route('jurnal/jurnal');
    }

    public function edit($id){
        $jurnal =  Jurnal::findorfail($id);

        $tahun = Tahun::findorfail(1);

        $presensi = DB::table('presensi')
        ->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('presensi.id as presensi','tb_guru.id as guru','nama','mapel','presensi.kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','presensi.semester')
        ->where('presensi.id','=',''.$jurnal->id_presensi.'')
        ->get();

        foreach ($presensi as $pre)

        $data['title'] = "Edit Jurnal Mengajar"; 
        return view('jurnal/edit_jurnal',compact('pre','tahun','jurnal'),$data) ;
    }

    public function update(Request $request,$id){
        $edit = Jurnal::findorfail($id);
        $data = [
            'materi'=>$request->materi,
            'kegiatan'=>$request->kegiatan,
            'penilaian'=>$request->penilaian,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update Jurnal mengajar berhasil');
        return redirect()->route('jurnal/jurnal');
    }

    public function destroy($id){
        $prestasi = Jurnal::find($id);
        $id_presensi = $prestasi->id_presensi;
        $prestasi->delete();
        $edit = Presensi::findorfail($id_presensi);
        $data = [
            's_jurnal' =>0,
        ];
        $edit->update($data);
        toast('Berhasil menghapus data','success');
        return redirect()->route('jurnal/jurnal');
    }
}
