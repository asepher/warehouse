<?php

namespace App\Exports;

use App\Models\Manifest;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManifestDailyExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

 public function __construct(string $tgl)
    {
        $this->tgl = $tgl;
    }

    public function view(): View
    {
        return view('wh.export.manifest_daily',[
                'data'  => Manifest::whereDate('tgl_inv', $this->tgl)->get(),
                'tgl'   => $this->tgl,
        ]);
    }
}
