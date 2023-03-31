<?php

namespace App\Exports;

use App\Models\InvWhMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class IwhMastExport implements FromView, ShouldAutoSize
{

    public function __construct(string $bulan,string $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('wh.export.inv_soa_master',[
                'data'  => InvWhMaster::whereMonth('eta', $this->bulan)->get(),
                'bulan'   => $this->bulan,
        ]);
    }

}
