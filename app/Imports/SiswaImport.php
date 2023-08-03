<?php

namespace App\Imports;

use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataSiswa([
            'nik' => $row[0],
            'nis' => $row[1], 
            'nama' => $row[2], 
            'alamat' => $row[3], 
            'tgl' => $row[4], 
            'tempat' => $row[5], 
            'agama' => $row[6], 
            'jk' => $row[7],
            'kelas' => $row[8],
            'tahun' => $row[9], 
        ]);
    }
}
