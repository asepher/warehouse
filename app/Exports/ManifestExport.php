<?php

namespace App\Exports;
 
use App\Models\Manifest;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManifestExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $keyword)
    {
        $this->name = $keyword;
    }

    public function view(): View
    {
        return view('export.manifest',[
                'data'  => Manifest::where('kd_vsl',  $this->name)->get()
        ]);
    }
}
