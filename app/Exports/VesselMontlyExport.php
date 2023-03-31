<?php

namespace App\Exports;

use App\Models\Vessel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VesselMontlyExport implements FromView, ShouldAutoSize
{
  

    public function __construct(string $bln)
    {
        $this->bln = $bln;
    }

    public function view(): View
    {
        return view('wh.export.manifest_bln_vsl',[
                'data'  => Vessel::whereMonth('eta', $this->bln)->get(),
                'bln'   => $this->bln,
        ]);
    }

}
