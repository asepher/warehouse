<?php

namespace App\Imports;

use App\Models\TempDataWh;
use Maatwebsite\Excel\Concerns\ToModel;

class TempWhImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TempDataWh([
        'seq'       => $row[0],
        'no'        => $row[1],
        'term'      => $row[2],
        'kd_bill'   => $row[3],
        'bill_to'   => $row[4],
        'kd_cnee'        => $row[5],
        'cnee_name'     => $row[6],
        'cnee_address'  => $row[7],
        'cnee_npwp'      => $row[8],
        'kd_forwader'    => $row[9],
        'forwader_name'  => $row[10],
        'forwader_address'  => $row[11],
        'forwader_npwp'  => $row[12],
        'kd_vessel'      => $row[13],
        'vessel'         => $row[14],
        'pol'            => $row[15],
        'container'      => $row[16],
        'seal'           => $row[17],
        'eta'            => $row[18],
        'hbl'            => $row[19],
        'vls_bl'         => $row[20],
        'qty'           => $row[21],
        'packing'       => $row[22],
        'description'   => $row[23],
        'weight'        => $row[24],
        'measure'       => $row[25],
        'minimum'       => $row[26],
        'username'       => $row[27],
        ]);
    }
}
