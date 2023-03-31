<?php

namespace App\Imports;

use App\Models\TempDataWh;
use Maatwebsite\Excel\Concerns\ToModel;

class TempDataWhImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TempDataWh([
        'seq'               => $row[0],
        'no'                => $row[1],
        'term'              => $row[2],
        'bill_to'           => $row[3],
        'cnee_name'         => $row[4],
        'cnee_address'      => $row[5],
        'cnee_npwp'         => $row[6],
        'forwader_name'     => $row[7],
        'forwader_address'  => $row[8],
        'forwader_npwp'  => $row[9],
        'kd_vessel'      => $row[10],
        'vessel'         => $row[11],
        'pol'            => $row[12],
        'container'      => $row[13],
        'seal'           => $row[14],
        'eta'            => $row[15],
        'hbl'            => $row[16],
        'vls_bl'         => $row[17],
        'qty'           => $row[18],
        'packing'       => $row[19],
        'description'   => $row[20],
        'weight'        => $row[21],
        'measure'       => $row[22],
        'minimum'       => $row[23],
        'username'       => $row[24],
        ]);
    }
}
