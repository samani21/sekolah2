<?php

namespace App\Http\Controllers;

use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use App\Models\DataSiswa;
use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SiswaController extends Controller
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

        $guru = DB::table('tb_guru')->where('id_user','=',''.Auth::user()->id.'')->get();

        if (Auth::user()->kelas == "-"){

            $guru = DB::table('tb_guru')->where('id_user','=',''.Auth::user()->id.'')->get();
            foreach ($guru as $g)

            if($g->wakel == "-" || $g->wakel == "BK" || Auth::user()->level == "Tata_usaha"){
                $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
                ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis','poin','tb_siswa.tahun')
                ->where('nama','like',"%".$cari."%")
                ->orWhere('nik','like',"%".$cari."%")
                ->orWhere('tb_siswa.tahun','like',"%".$cari."%")
                ->paginate(10);
                
            }else{
                $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
                ->where('kelas','=',''.$g->wakel.'')
                ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis','poin')
                ->paginate(10);
            }
        }
        else{

            $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
            ->select('nik','nama','tgl','tempat','agama','jk','users.kelas','alamat','tb_siswa.id','nis','poin','tb_siswa.tahun')
            ->where('kelas','=',''.$kelas.'')
            ->where('nama','like',"%".$cari."%")
            ->paginate(10);
        }

        $ta = DB::table('tb_siswa')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        if (Auth::user()->kelas == "-"){
            return view('siswa/siswa',['siswa'=>$siswa,'user'=>$user,'kelas1'=>$kelas1,'ta'=>$ta,'g'=>$g,'tahun'=>$id_tahun,'title'=>'Data Siswa']); 
        }else{
            return view('siswa/siswa',['siswa'=>$siswa,'user'=>$user,'kelas1'=>$kelas1,'ta'=>$ta,'tahun'=>$id_tahun,'title'=>'Data Siswa']); 
        }
    }

    public function create(){
        $data['title']= "Data Siswa";
        return view('siswa/tambah_siswa',$data);
    }

    public function store(Request $request){
        $this->validate($request, [
            // check validtion for image or file
            'images_portfolio' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('images_portfolio')->getClientOriginalName());
        $request->file('images_portfolio')->move(public_path('images'), $filename);
        
        $id = $request->id_user;
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $siswa = new Siswa([
            'id_user' => $request->id_user,
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'tgl_absen' => "0",
            'tgl_harian' => "0",
            'nis' => $request->nis,
            'tahun' => $id_tahun->tahun,
            'presensi' => "0",
            'foto' => $filename,
            'poin' => 100,
            
        ]);
        $siswa->save();

        $edit = User::findorfail($id);
        $data = [
            'status' => $request->status,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }

    

    public function edit_siswa($id){
        $siswa2 = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->where('tb_siswa.id','=',''.$id.'')
        ->select('nama','tb_siswa.id','kelas','nis','nik','tempat','tgl','agama','jk','alamat','id_user')
        ->paginate(1);
        $kelas = DB::table('kelas')->get();
        $data['title'] = 'Edit Siswa';
        return view('siswa/edit_siswa',compact(['siswa2','kelas']),$data);
    }

    public function update(Request $request, $id){
        $id_user = $request->id_user;

        $edit = Siswa::findorfail($id);
        $data = [
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat' => $request->tempat,
            'tgl' => $request->tgl,
            'agama' => $request->agama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'nis' => $request->nis,
        ];
        $edit->update($data);

        $edit = User::findorfail($id_user);
        $data = [
            'kelas' => $request->kelas
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data Siswa berhasil');
        return redirect()->route('siswa/siswa');
    }
    public function destroy($id){
        $siswa = Siswa::find($id);
        $siswa->delete();
        toast('Berhasil menghapus data','success');
        return redirect('siswa/siswa');
    }

    public function profil($id){
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas = DB::table('kelas')->get();
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $siswa = DB::table('tb_siswa')->join('users','users.id','=','tb_siswa.id_user')
        ->select('users.level','nik','nama','tempat','tgl','alamat','agama','jk','tb_siswa.id','nis','foto')
        ->where('id_user','=',''.$id.'')
        ->get();
        $data['title']= "Data profil";
        return view('profil.profil',['siswa'=>$siswa,'tahun'=>$id_tahun,'user'=>$user,'kelas'=>$kelas],$data);
    }

    public function edit_gambar($id){
        $siswa = Siswa::findorfail($id);
        return view('profil.ubah_gambar',['title'=>"Edit Gambar",'siswa'=>$siswa]);
    }

    public function updategambar(Request $request,$id){
        $this->validate($request, [
            // check validtion for image or file
            'images_portfolio' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('images_portfolio')->getClientOriginalName());
        $request->file('images_portfolio')->move(public_path('images'), $filename);
        
        $edit = Siswa::findorfail($id);
        $data = [
            'foto' => $filename,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Update Gambar berhasil');
        return redirect()->back();
    }

    public function cetak_siswa(Request $request)
    {   
        $tahun = $request->tahun;
        $cari = $request->cari;
        if($cari == ""){
            $siswa = DB::table('tb_siswa')
            ->join('users','users.id','=','tb_siswa.id_user')
            ->where('tb_siswa.tahun','=',''.$tahun.'')->get();
        }else{
            $siswa = DB::table('tb_siswa')
            ->join('users','users.id','=','tb_siswa.id_user')
            ->where('nis','like',"%".$cari."%")
            ->orWhere('nama','like',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")->get();
        }
        $pdf = PDF::loadView('siswa/cetak',compact('siswa','tahun'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

    public function edit_kelas(){
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $kelas = DB::table('kelas')->get();
        return view('profil.edit_kelas',['title'=>"Edit Kelas",'user'=>$user,'kelas'=>$kelas]);
    }

    public function updatekelas(Request $request,$id){
        $it = 1;
        $id_tahun = Tahun::findorfail($it);
        $edit = User::findorfail($id);
        $data = [
            'kelas' => $request->kelas,
            'tahun' => $id_tahun->tahun
        ];
        $edit->update($data);

        $siswa = DB::table('tb_siswa')->where('id_user','=',''.Auth::user()->id.'')->get();
        foreach ($siswa as $sis)
        $siswaa= Siswa::findorfail($sis->id);
        $data = [
            'poin' => "100"
        ];
        $siswaa->update($data);
        Alert()->success('SuccessAlert','Update kelas berhasil');
        return redirect()->back();
    }
    public function cetak_kartu($id){
        $siswa = Siswa::find($id);
        $user = User::find($siswa->id_user);
        return view('profil.cetak_kartu',['siswa'=>$siswa,'user'=>$user]);
    }



    public function import_excel(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_siswa',$nama_file);
 
		// import data
		Excel::import(new SiswaImport, public_path('/file_siswa/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Siswa Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('/siswa/data_siswa');
        
	}

    public function export_excel()
	{
		return Excel::download(new SiswaExport, 'siswa.xlsx');
	}

    public function data_siswa(Request $request){
        $cari = $request->cari;
        $data['title'] = "Data Siswa";
        $ta = DB::table('data_siswa')
        ->select('tahun')
        ->groupBy('tahun')
        ->get();
        $siswa = DB::table('data_siswa')
        ->select('nis','nik','nama','tgl','tempat','agama','jk','kelas','tahun','alamat')
        ->groupBy('nis','nik','nama','tgl','tempat','agama','jk','kelas','tahun','alamat')
        ->where('nama','like',"%".$cari."%")
        ->orWhere('nik','like',"%".$cari."%")
        ->orWhere('tahun','like',"%".$cari."%")
        ->orWhere('kelas','like',"%".$cari."%")
        ->paginate(10);
        return view('siswa/data_siswa',compact('ta','siswa'),$data);
    }

    public function cetak_data_siswa(Request $request){
        $tahun = $request->tahun;
        $cari = $request->cari;
        if($cari == ""){
            $siswa = DB::table('data_siswa')
            ->where('tahun','=',''.$tahun.'')->get();
        }else{
            $siswa = DB::table('data_siswa')
            ->where('nis','like',"%".$cari."%")
            ->orWhere('nama','like',"%".$cari."%")
            ->orWhere('nik','like',"%".$cari."%")
            ->orWhere('kelas','like',"%".$cari."%")->get();
        }
        $pdf = PDF::loadView('siswa/cetak',compact('siswa','tahun'));
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('cetak_siswa.pdf');
    }

    public function destroy_data_siswa($id){
        $siswa = DataSiswa::find($id);
        $siswa->delete();
        toast('Berhasil menghapus data','success');
        return redirect('siswa/data_siswa');
    }
}
