<?php

namespace App\Exports;

use App\Models\IwhHeader;
use App\Models\Manifest;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class IwhHeaderExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $awal,string $akhir)
    {        
        $this->tglawal = $awal;
        $this->tglakhir = $akhir;
    }

    public function view(): View
    {
        return view('wh.export.invbydate',[
                'manifest'  => Manifest::whereDate('tgl_inv', '>=', $this->tglawal)
                            ->whereDate('tgl_inv', '<=', $this->tglakhir)
                            ->get(),
                'awal'  => $this->tglawal,
                'akhir'  => $this->tglakhir,
        ]);

    }

}
