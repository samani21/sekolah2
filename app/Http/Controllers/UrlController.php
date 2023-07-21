<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function index(){
        $id = "1";
        $url = Url::find($id);
        $data['title'] = 'Atur tahun ajaran';
        return view('url/url',compact(['url']),$data);
    }

    public function update(Request $request){
        $id = "1";
        $edit = url::findorfail($id);
        $data = [
            'url' => $request->url,
        ];
        $edit->update($data);
        Alert()->success('SuccessAlert','Tambah data URL berhasil');
        return redirect()->back();
    }
}
