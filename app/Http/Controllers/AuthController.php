<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {   
        
        if ($user = Auth::user()) {
            if ($user->level == 'Guru') {
                return redirect()->intended('Guru?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }
             elseif ($user->level == 'Tata_usaha') {
                return redirect()->intended('Tata_usaha?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }
            elseif ($user->level == 'Super_admin') {
                return redirect()->intended('Super_admin?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }elseif ($user->level == 'Siswa') {
                return redirect()->intended('Siswa?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('username','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                
                    if ($user->level == 'Guru') {
                        return redirect()->intended('Guru?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                     elseif ($user->level == 'Tata_usaha') {
                        return redirect()->intended('Tata_usaha?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                    elseif ($user->level == 'Super_admin') {
                        return redirect()->intended('Super_admin?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                    elseif ($user->level == 'Siswa') {
                        return redirect()->intended('Siswa?tgl='.date('d-m-Y').'&tahun='.date('Y').'');
                    }
                return redirect()->intended('login');
            }

        return redirect('login')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'PASSWORD SALAH']);
    }
    
    public function register_pegawai()
    {
        return view('register_pegawai');
    }
    public function register()
    {   
        $id = "1";
        $tahun = Tahun::find($id);
        $kelas = DB::table('kelas')->get();
        return view('register',compact('kelas','tahun'));
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'password1' =>" $request->password",
            'level' =>substr($request->level,0,5),
            'status' =>$request->status,
            'kelas' =>substr($request->level,6),
            'tahun' =>$request->tahun
        ]);
        $user->save();

        event(new Registered($user));
        auth()->login($user);

        return redirect('/')->with('success', 'Registration success.');
    }

    public function register_action_pegawai(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'password1' => $request->password,
            'level' =>$request->level,
            'status' =>$request->status,
            'kelas' =>"-",
            'tahun' =>$request->tahun
        ]);
        $user->save();

        event(new Registered($user));
        auth()->login($user);

        return redirect('/')->with('success', 'Registration success.');
    }
    
    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('/');
    }
}
