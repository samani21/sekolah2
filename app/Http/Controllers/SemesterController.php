<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;
use PDF;
class SemesterController extends Controller
{
    public function index1(Request $request){
        $kelas = $request->kelas;
        $mapel = $request->mapel;
        $tahun = $request->tahun;
        $semester = $request->semester;
        $kelas1 = DB::table('kelas')->get();
        $mapel1 = DB::table('mapel')->get();
        $bagi = DB::table('presensi')
        ->select(DB::raw("COUNT(mapel) as m"),"s_nilai")
        ->where("kelas",'like',"%".$kelas."%")
        ->where("mapel",'like',"%".$mapel."%")
        ->where("tahun",'like',"%".$tahun."%")
        ->where("semester",'like',"%".$semester."%")
        ->where('s_nilai','=','1')
        ->groupBy('mapel','kelas','s_nilai')
        ->get();
        foreach($bagi as $b)

        $nilai = DB::table('nilai')
        ->join('tb_siswa','tb_siswa.id','=','nilai.id_siswa')
        ->select(DB::raw("(SUM(nilai)/".$b->m.") as hasil"),'mapel','s_akhir','kelas','id_siswa','nama','semester','nilai.tahun','nis','nilai.status')
        ->where("kelas",'like',"%".$kelas."%")
        ->where("mapel",'like',"%".$mapel."%")
        ->where("nilai.tahun",'like',"%".$tahun."%")
        ->where("nilai.semester",'like',"%".$semester."%")
        ->groupBy('mapel','kelas','id_siswa','nama','nis','s_akhir','nilai.status','nilai.tahun','semester')
        // ->select('tb_siswa.nama')
        ->paginate(10);
        $tahun1 = DB::table('nilai')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        $data ['title']="Nilai Akhir Tugas";
        return view('semester.semester1',compact('nilai','mapel1','kelas1','tahun','tahun1','kelas','mapel','semester'),$data);
    }

    public function pilih(){
        if(Auth::user()->level == "Siswa"){
            $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
            dd(Auth::user()->id);
            $kelas = DB::table('nilai')
            ->select('kelas')
            ->groupBy('kelas')
            ->get();
        }else{
            $kelas = DB::table('nilai')
            ->select('kelas')
            ->groupBy('kelas')
            ->get();
        }
        $kelas = DB::table('nilai')
        ->select('kelas')
        ->groupBy('kelas')
        ->get();
        $mapel = DB::table('mapel')->get();
        $nilai = DB::table('nilai')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        $data ['title']="Semester1";
        return view('semester.pilihan',compact('kelas','mapel','nilai'),$data);
    }
    
    public function store1(Request $request){
        $kelas = $request->kelas;
        $mapel = $request->mapel;
        $a = "$request->tahun$request->semester";
        $presensi = new Ujian([
            'id_siswa' => $request->id_siswa,
            'n_akhir' => $request->n_akhir,
            'tgl' => $request->tgl,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
        ]);
        $presensi->save();

        $edit = Siswa::findorfail($request->id_siswa);
        $data = [
            's_akhir'=> $a,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah presensi siswa berhasil');
        return redirect('semester/semester1?kelas='.$kelas.'&mapel'.$mapel.'');
    }

    public function update1 (Request $request,$id){
        $kelas = $request->kelas;
        $mapel = $request->mapel;
        
        $nilai = Ujian::findorfail($id);
        $edit1 = [
            'n_akhir' => $request->n_akhir,
            'uts'=>$request->uts,
            'uas'=>$request->uas,
        ];
        $nilai->update($edit1);
        Alert()->success('SuccessAlert','Tambah presensi siswa berhasil');
        return redirect('semester/semester1?kelas='.$kelas.'&mapel'.$mapel.'');
    }

    public function nilai($id,$nilai,$kelas,$mapel){
        $siswa = Siswa::findorfail($id);
        $tahun = Tahun::findorfail(1);
        $data['title'] = "Tambah nilai semester 1";
        return view('semester.tambah',compact('id','nilai','tahun','kelas','mapel','siswa'),$data);
    }

    public function edit($id,$mapel,$kelas){
        $siswa = Siswa::findorfail($id);
        $akhir = DB::table('ujian')
        ->where('id_siswa','=',''.$siswa->id.'')
        ->get();
        foreach ($akhir as $ak)
        $tahun = Tahun::findorfail(1);
        $data['title'] = "Edit nilai semester 1";
        return view('semester.edit',compact('siswa','tahun','ak'),$data);
    }

    public function cetak1(Request $request){
        $kelas = $request->kelas;
        $mapel = $request->mapel;
        $tahun = $request->tahun;
        $semester = $request->semester;
        $kelas1 = DB::table('kelas')->get();
        $mapel1 = DB::table('mapel')->get();
        $bagi = DB::table('presensi')
        ->select(DB::raw("COUNT(mapel) as m"),"s_nilai")
        ->where("kelas",'like',"%".$kelas."%")
        ->where("mapel",'like',"%".$mapel."%")
        ->where("tahun",'like',"%".$tahun."%")
        ->where("semester",'like',"%".$semester."%")
        ->where('s_nilai','=','1')
        ->groupBy('mapel','kelas','s_nilai')
        ->get();
        foreach($bagi as $b)
        $nilai = DB::table('nilai')
        ->join('tb_siswa','tb_siswa.id','=','nilai.id_siswa')
        ->select(DB::raw("SUM(nilai)/".$b->m." as hasil"),'mapel','s_akhir','kelas','id_siswa','nama','semester','nilai.tahun','nis','nilai.status')
        ->where("kelas",'like',"%".$kelas."%")
        ->where("mapel",'like',"%".$mapel."%")
        ->where("nilai.tahun",'like',"%".$tahun."%")
        ->where("nilai.semester",'like',"%".$semester."%")
        ->groupBy('mapel','kelas','id_siswa','nama','nis','s_akhir','nilai.status','nilai.tahun','semester')
        // ->select('tb_siswa.nama')
        ->get();
        $pdf = PDF::loadView('semester/cetak',compact('nilai','mapel1','kelas1','tahun','kelas','mapel','semester'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_nilai.pdf');
    }
}
