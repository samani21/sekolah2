<?php

namespace App\Http\Controllers;

use App\Models\Poin;
use App\Models\Siswa;
use App\Models\Surat;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Twilio\Rest\Client;

class PoinController extends Controller
{
    public function index(Request $request){
        $id_user = Auth::user()->id;
        $kelas = Auth::user()->kelas;
        $cari = $request->cari;

        $id = Auth::user()->id;
        $user = User::findorfail($id);

        $kelas1 = DB::table('kelas')->get();

        $it = 1;
        $id_tahun = Tahun::findorfail($it);

        if (Auth::user()->kelas == "-"){
            $guru = DB::table('tb_guru')->where('id_user','=',''.Auth::user()->id.'')->get();
            foreach ($guru as $g)
            if($g->wakel == "-" || $g->wakel == "BK"){
                $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                ->join('users','users.id','=','poin.id_user')
                ->select('poin.tahun','poin.kelas','nis','nama','poin.tgl','ket','poin.poin','poin.id')
                ->where('nama','like',"%".$cari."%")
                ->orWhere('nis','like',"%".$cari."%")
                ->orWhere('poin.tgl','like',"%".$cari."%")
                ->orWhere('poin.tahun','like',"%".$cari."%")
                ->paginate(10);
            }else{
                $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                ->join('users','users.id','=','poin.id_user')
                ->select('poin.tahun','poin.kelas','nis','nama','poin.tgl','ket','poin.poin','poin.id')
                ->where('poin.kelas','like',''.$g->wakel.'')
                ->where('nama','like',"%".$cari."%")
                ->paginate(10);
            }
        }else{
                $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                ->join('users','users.id','=','poin.id_user')
                ->select('poin.tahun','poin.kelas','nis','nama','poin.tgl','ket','poin.poin','poin.id')
                ->where('users.id','=',''.$id_user.'')
                ->where('poin.kelas','like',''.$kelas.'')
                ->where('nama','like',"%".$cari."%")
                ->paginate(10);
                // dd($id_user);
        }

        $ta = DB::table('poin')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        if (Auth::user()->kelas == "-"){
            return view('poin/poin',['poin'=>$poin,'user'=>$user,'kelas1'=>$kelas1,'ta'=>$ta,'tahun'=>$id_tahun,'g'=>$g,'title'=>'Point Kedisiplinan']);
        }else{
            return view('poin/poin',['poin'=>$poin,'user'=>$user,'kelas1'=>$kelas1,'ta'=>$ta,'tahun'=>$id_tahun,'title'=>'Point Kedisiplinan']);
        }
    }
    
    public function create($id){
        $siswaa = DB::table('tb_siswa')
        ->join('users','users.id','=','tb_siswa.id_user')
        ->select('tb_siswa.id','kelas','tb_siswa.id_user','nama')
        ->where('tb_siswa.id','=',''.$id.'')
        ->get();
        foreach ($siswaa as $siswa)
        $tahun = Tahun::findorfail(1);
        $data['title'] =  "Tambah Poin";
        return view('poin/tambah_point',compact('siswa','tahun'), $data);
    }

    public function store(Request $request){
        $point = Poin::create([
            'id_siswa' => $request->id_siswa,
            'id_user' => $request->id_user,
            'poin' => $request->poin,
            'tgl' => $request->tgl,
            'ket' => $request->ket,
            'tahun' => $request->tahun,
            'kelas' => $request->kelas,
        ]);
        $surat = Surat::create([
            'id_poin' => $point->id,
            'hari' => $request->hari,
            'tgl' => $request->tgl_surat,
            'jam' => $request->jam,
            'tempat' => $request->tempat,
        ]);
        $id = $request->id_siswa;
        $kelas = $request->kelas;
        $siswa = Siswa::findorfail($id);
        $surat = Surat::findorfail($surat->id);
        $this->whatsappNotification($siswa->id,$surat->id);
        $pdf = PDF::loadView('poin/surat',compact('siswa','kelas','surat'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('surat_panggilan.pdf');
    }

    public function edit($id){
        $poin = Poin::findorfail($id);

        $tahun = Tahun::findorfail(1);

        $id_siswaa = $poin->id_siswa;
        $siswa = Siswa::findorfail($id_siswaa);

        $data['title'] =  "Edit Poin";
        return view('poin/edit',compact('siswa','tahun','poin'), $data);
    }

    public function update(Request $request,$id){
        $edit = Poin::findorfail($id);
        $data = [
           'poin'=>$request->poin,
           'tgl'=>$request->tgl,
           'ket'=>$request->ket,

        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Edit Poin berhasil');
        return redirect()->route('poin/poin');
    }
    public function destroy($id){
        $poin = Poin::find($id);
        $poin->delete();
        toast('Berhasil menghapus data','success');
        return redirect('poin/poin');
    }

    public function cetak_poin(Request $request){
        $tahun = $request->tahun;
        $cari = $request->cari;

        if(Auth::user()->level == "Guru"){
            $guru = DB::table('tb_guru')->where('id_user','=',''.Auth::user()->id.'')->get();
            foreach ($guru as $g)
            if($g->wakel == "-" || $g->wakel == "BK"){
                if($cari == ""){
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','poin.kelas','nis','nama','tb_siswa.tgl','ket','poin.poin','poin.id','tempat','agama','jk','alamat')
                    ->where('poin.tahun','like',''.$tahun.'')
                    ->paginate(10);
                }else{
                    $tahun = "";
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','poin.kelas','nis','nama','tb_siswa.tgl','ket','poin.poin','poin.id','tempat','agama','jk','alamat')
                    ->where('nama','like',"%".$cari."%")
                    ->orWhere('nis','like',"%".$cari."%")
                    ->orWhere('poin.tgl','like',"%".$cari."%")
                    ->orWhere('poin.tahun','like',"%".$cari."%")
                    ->paginate(10);
                }
            }else{
                if($cari == ""){
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','poin.kelas','nis','nama','tb_siswa.tgl','ket','poin.poin','poin.id','tempat','agama','jk','alamat')
                    ->where('poin.kelas','like',''.$g->wakel.'')
                    ->where('nama','like',"%".$cari."%")
                    ->where('poin.tahun','like',"%".$tahun."%")
                    ->paginate(10);
                }else{
                    $tahun = "";
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','kelas','nis','nama','tb_siswa.tgl','ket','poin.poin','poin.id','tempat','agama','jk','alamat')
                    ->where('poin.kelas','like',''.$g->wakel.'')
                    ->where('nama','like',"%".$cari."%")
                    ->orWhere('nis','like',"%".$cari."%")
                    ->paginate(10);
                }
            }
            
        }else{
            // $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
            // foreach ($siswa as $s)
           
                if($cari == ""){
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','poin.kelas','nis','nama','tb_siswa.tgl','ket','poin.tgl','poin.poin','poin.id','tempat','agama','jk','alamat')
                    ->where('tb_siswa.id_user','=',''.Auth::user()->id.'')
                    ->where('nama','like',"%".$cari."%")
                    ->where('poin.tahun','like',"%".$tahun."%")
                    ->paginate(10);
                }else{
                    $tahun = "";
                    $poin =  DB::table('poin')->join('tb_siswa','tb_siswa.id','=','poin.id_siswa')
                    ->join('users','users.id','=','poin.id_user')
                    ->select('poin.tahun','poin.kelas','nis','nama','tb_siswa.tgl','ket','poin.poin','poin.tgl','poin.id','tempat','agama','jk','alamat')
                    ->where('tb_siswa.id_user','=',''.Auth::user()->id.'')
                    ->where('nama','like',"%".$cari."%")
                    ->orWhere('nis','like',"%".$cari."%")
                    ->orWhere('poin.tgl','like',"%".$cari."%")
                    ->paginate(10);
                
            }
        }
        $pdf = PDF::loadView('poin/cetak',compact('poin','tahun'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_poin.pdf');
    }
    
    public function cetak_surat($id){
        $poin = Poin::findorfail($id);
        $kelas = $poin->kelas;
        $siswa = Siswa::findorfail($poin->id_siswa);
        $surat1 = DB::table('surat')->where("id_poin","=","".$id."")->get();
        foreach ($surat1 as $surat)
        $pdf = PDF::loadView('poin/surat',compact('siswa','kelas','surat'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('surat_panggilan.pdf');
    }

    private function whatsappNotification(string $recipient,string $recipient1)
    {
        $siswa = Siswa::findorfail($recipient);
        $surat = Surat::findorfail($recipient1);
        $sid    = getenv("TWILIO_AUTH_SID");
        $token  = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $twilio = new Client($sid, $token);
        
        $body = "Assalamu'alaikum. Yang terhormat Bapak/Ibu Wali siswa yang bernama {$siswa->nama} untuk berhadir kesekolahan pada hari {$surat->hari},jam {$surat->jam}, tanggal {$surat->tgl}, bertempatkan di {$surat->tempat}";

        return $twilio->messages->create("whatsapp:$siswa->phone",["from" => "whatsapp:$wa_from", "body" => $body]);
    }
}
