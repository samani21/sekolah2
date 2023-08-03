<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('tb_siswa')
        ->select('nik','nis','nama','alamat','tgl','tempat','agama','jk','kelas','tb_siswa.tahun')
        ->join('users','users.id','=','tb_siswa.id_user')->get();
    }
}
