<?php

namespace App\Imports;

use App\Models\TempDataWh;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UploadImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TempDataWh([
            'seq'               => $row['seq'],
            'no'                => $row['no'],
            'term'              => $row['term'],
            'bill_to'           => $row['bill'],
            'cnee_name'         => $row['cnee_name'],
            'cnee_address'      => $row['cnee_address'],
            'cnee_npwp'         => $row['cnee_npwp'],
            'forwader_name'     => $row['forwader_name'],
            'forwader_address'  => $row['forwader_address'],
            'forwader_npwp'     => $row['forwader_npwp'],
            'kd_vessel'         => $row['kd_vsl'],
            'vessel'            => $row['vessel'],
            'pol'               => $row['pol'],
            'container'         => $row['container'],
            'seal'              => $row['seal'],
            'eta'               => $row['eta'],
            'hbl'               => $row['hbl'],
            'vls_bl'            => $row['vls_bl'],
            'qty'               => $row['qty'],
            'packing'           => $row['qty_satuan'],
            'description'       => $row['description'],
            'weight'            => $row['weight'],
            'measure'           => $row['measure'],
            'username'          => $row['username'],
        ]);
    }
}
