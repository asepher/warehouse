<?php

namespace App\Exports;

use App\Models\Container;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
 
class ContainerMontlyExport implements FromView, ShouldAutoSize
{
  
    public function __construct(string $bln)
    {
        $this->bln = $bln;
    }
    public function view(): View
    {
        return view('wh.export.manifest_bln_container',[
                'data'  => Container::whereMonth('eta', $this->bln)->get(),
                'bln'   => $this->bln,
        ]);
    }
}
