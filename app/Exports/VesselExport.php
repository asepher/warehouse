<?php

namespace App\Exports;

use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\FromCollection;

class VesselExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Vessel::all();
    }
}
