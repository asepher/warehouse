<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ManifestExport;
use App\Exports\IwhHeaderExport;
use App\Exports\ManifestDailyExport;
use App\Exports\VesselMontlyExport;
use App\Exports\ContainerMontlyExport;
use App\Exports\IwhMastExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function ManifestExcel($vsl)
    {
        return Excel::download(new ManifestExport($vsl), 'manifest.xlsx');
    }

    public function IwhDetailByDate(Request $request)

    {             
        return Excel::download(new IwhHeaderExport($request->tgl_awal,$request->tgl_akhir), 'invbydate.xlsx');
    }

    public function ReportDailyExcel(Request $request)
    {
         return Excel::download(new ManifestDailyExport($request->tgl), 'manifest_daily.xlsx');
    }

    public function ReportMontlyVsl(Request $request)
    {
        return Excel::download(new VesselMontlyExport($request->bln), 
            'VESSEL_BLN_'.$request->bln.'.xlsx');
    }

    public function ReportMontlyCont(Request $request)
    {
        return Excel::download(new ContainerMontlyExport($request->bln), 
            'CONTAINER_BLN_'.$request->bln.'.xlsx');
    }

    public function ReportSoaExcel(Request $request)
    {

        return Excel::download(new IwhMastExport($request->bulan,$request->tahun), 
            'SOA_BLN_'.$request->bulan.'.xlsx');
        
        //dd($request->all());

    }


}
