<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\mapel;
use App\Models\Presensi;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PresensiController extends Controller
{
    public function index(Request $request){
        $cari = $request->cari;
        $id_user = Auth::user()->id;
        $guru = DB::table('tb_guru')->where('id_user','=',$id_user)->get();
        foreach ($guru as $g)
        $gur = $g->id;

        $tahun = DB::table('tahun')->get();
        foreach ($tahun as $t)
        $ta = $t->tahun;
        // $siswa = DB::table('absen_siswa')->select(DB::raw('count(id_presensi) as jumlah'))
        // ->groupBy('id_presensi')->get();
        // dd($siswa);
        if(Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
        {
            $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id','s_nilai','s_jurnal')
        ->where('presensi.tgl','like',"%".$cari."%")
        ->orWhere('mapel','like',"%".$cari."%")
        ->orWhere('nama','like',"%".$cari."%")
        ->groupBy('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id','s_nilai','s_jurnal')
        ->paginate(10);
        }else{
            $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id','s_nilai','s_jurnal')
        ->where('id_guru','=',''.$gur.'')
        ->where('presensi.tahun','=',''.$ta.'')
        ->where('presensi.tgl','like',"%".$cari."%")
        ->groupBy('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id','s_nilai','s_jurnal')
        ->paginate(10);
        }
        // dd($presensi);
        $data ['title'] = "Presensi siswa";
        return view('absensi.presensi',compact('guru','presensi'),$data);
    }

    public function create($id_guru){
        $guru = Guru::find($id_guru);
        $id_tahun = "1";
        $tahun = Tahun::find($id_tahun);
        $mapel = mapel::all();
        $kelas = DB::table('kelas')->get();
        $data ['title'] = "Tambah Presensi";
        return view('absensi.tambah_presensi',compact('guru','tahun','kelas','mapel'),$data);
    }

    public function store(Request $request){
        $presensi = new Presensi([
            'id_guru' => $request->id_guru,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            's_nilai' => $request->s_nilai,
            's_jurnal' => 0,
        ]);
        $presensi->save();
        Alert()->success('SuccessAlert','Tambah presensi siswa berhasil');
        return redirect('absensi/presensi?cari='.date('Y-m-d').'');
    }

    public function edit_presensi($id){
        $presensi = Presensi::find($id);
        $kelas = DB::table('kelas')->get();
        $data['title'] = 'Edit Peresensi';
        return view('absensi.edit_presensi',compact(['presensi','kelas']),$data);
    }

    public function update(Request $request, $id){
        $edit = Presensi::findorfail($id);
        $data = [
            'id_guru' => $request->id_guru,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'tahun' => $request->tahun,
            's_nilai' => $request->s_nilai,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update presensi Kelas berhasil');
        return redirect()->route('absensi/presensi');
    }
    public function destroy($id){
        $per = Presensi::find($id);
        $per->delete();
        toast('Berhasil menghapus data','success');
        return redirect('absensi/presensi');
    }

    public function lihat(Request $request,$id,$mapel){
        $cari = $request->cari;
        $presensi = DB::table('absen_siswa') ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        ->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')
        ->select('mapel','kelas','presensi.tgl','nis','nama','presensi.tahun','absen_siswa.jam')
        ->where('id_presensi','=',''.$id.'')
        ->where('nama','like',"%".$cari."%")
        ->paginate(10);
        $data ['title'] = "Absesn siswa berdasarkan mapel";
        return view('absensi.lihat_presensi',compact('presensi','id','mapel'),$data);
    }
    public function cetak(Request $request, $id,$mapel)
    {   
        $cari = $request->cari;
        $presensi = DB::table('absen_siswa') ->join('presensi','presensi.id','=','absen_siswa.id_presensi')
        ->join('tb_siswa','tb_siswa.id','=','absen_siswa.id_siswa')
        ->select('mapel','kelas','presensi.tgl','nis','nama','presensi.tahun','absen_siswa.jam','id_guru')
        ->where('id_presensi','=',"".$id."")
        ->where('nama','like',"%".$cari."%")
        ->get();
        foreach ($presensi as $re)
        $id_guru = $re->id_guru;
        if(Auth::user()->level == "Super_admin"){
            $guru = DB::table('presensi')
        ->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('tb_guru.nama','mapel','presensi.tgl','kelas')
        ->where('mapel','=',''.$mapel.'')
        ->groupBy('tb_guru.nama','mapel','presensi.tgl','kelas')
        ->get();
        }else{
            $guru = DB::table('presensi')
        ->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->select('tb_guru.nama','mapel','presensi.tgl','kelas')
        ->where('tb_guru.id','=',''.$id_guru.'')
        ->where('mapel','=',''.$mapel.'')
        ->groupBy('tb_guru.nama','mapel','presensi.tgl','kelas')
        ->get();
        }
        $pdf = PDF::loadView('absensi/cetak_presensi',compact('presensi','guru'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

    public function cetak_mapel(Request $request)
    {   
        $cari = $request->cari;
        $dari = $request->dari;
        $sampai = $request->sampai;
        $id_user = Auth::user()->id;
        $guru = DB::table('tb_guru')->where('id_user','=',$id_user)->get();
        foreach ($guru as $g)
        $gur = $g->id;

        $tahun = DB::table('tahun')->get();
        foreach ($tahun as $t)
        $ta = $t->tahun;
        if(Auth::user()->level == "Super_admin" || Auth::user()->level == "Tata_usaha")
        {
            if($cari == ""){
                $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
                ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id')
                ->whereBetween('presensi.tgl',[$dari,$sampai])
                ->paginate(10);
            }else{
                $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
                ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id')
                ->where('presensi.tgl','like',"%".$cari."%")
                ->orWhere('mapel','like',"%".$cari."%")
                ->orWhere('nama','like',"%".$cari."%")
                ->paginate(10);
            }
        }else{
            $presensi = DB::table('presensi')->join('tb_guru','tb_guru.id','=','presensi.id_guru')
        ->join('absen_siswa','absen_siswa.id_presensi','=','presensi.id')
        ->select('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id')
        ->where('id_guru','=',''.$gur.'')
        ->where('presensi.tahun','=',''.$ta.'')
        ->where('presensi.tgl','like',"%".$cari."%")
        ->groupBy('mapel','kelas','presensi.tgl','jam_mulai','jam_selesai','presensi.tahun','nama','presensi.id')
        ->paginate(10);
        }
        
        
        $pdf = PDF::loadView('absensi/cetak_mapel',compact('guru','presensi'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }
}
