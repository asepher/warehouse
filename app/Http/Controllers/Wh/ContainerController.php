<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Container;
use App\Models\IwhHeader;
use App\Models\InvManHeader;
use App\Models\InvWhMaster;
use App\Models\InvDnHeader;
use App\Models\InvDnDetail;

use PDF;

class ContainerController extends Controller
{
    public function index()
    {

      $data['container'] = Container::orderBy('eta','DESC')->get();
      return view('wh.container.index',$data);

    }
    public function ViewPdf()

    {
      $pdf = app('dompdf.wrapper');
      $pdf->getDomPDF()->set_option("enable_php", true);
      $pdf->loadView('wh.container.pdf',[
                  'container' => Container::all(),                 
                ]);      
      return $pdf->stream('test_pdf.pdf');
    }

    public function ReportByContainer($cont)
    {
        //dd($cont);
        $data['invoices'] = IwhHeader::where('container',$cont)
                            ->where('term','CNF')->where('tipe','CR')->get();
        $data['container'] = $cont;                             
        return view('wh.container.report',$data);
    }

    public function InvByContainer()
    {
 
        return view('wh.container.bycontainer');
    }

   public function QueryByContainer(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'bulan'     =>  'required',
            'tahun'     =>  'required',
            'modul'    => 'required',
        ]);

        $bln = $request->bulan;
        if ($bln == 10) {
          $nmbulan = 'Januari';
        }
        if ($bln == 11) {
          $nmbulan = 'November';
        }
        if ($bln == 12) {
          $nmbulan = 'Desember';
        }

      if ($request->modul == 'inv' ) {
            
         $data['bulan']  = $request->bulan;
         $data['tahun']  = $request->tahun;
          $data['nmbulan']  = $nmbulan;
         $data['container'] = Container::whereMonth('eta',$request->bulan)->orderBy('eta','DESC')->get();
         return view('wh.container.qbycontainer',$data);
      }
      if ($request->modul == 'soa' ) {

         $data['bulan']  = $request->bulan;
         $data['tahun']  = $request->tahun;
         $data['nmbulan']  = $nmbulan;
         //$data['container'] = Container::whereMonth('eta',$request->bulan)->get();
         $data['invMaster'] = InvWhMaster::whereMonth('eta',$request->bulan)
                            ->where('term','FOB')->orderBy('eta','DESC')->get();
         return view('wh.container.qbysoa',$data);
        }

    }
 

    public function QueryBySingleCont(Request $request)
    {

        $this->validate($request,[
            'container'    =>  'required',
        ]);
        $data['container']  = $request->container;
        $data['result']     = Container::where('container',$request->container)->first();
        $data['invWh']      = IwhHeader::where('container',$request->container)
                                          ->where('tipe','CR')->get();
        $data['invMan']     = InvManHeader::where('container',$request->container)->get();
        
        return view('wh.container.result',$data);

    }

    public function PdfBySingleCont(Request $request)
    {

        $container  = $request->container;
        $result     = Container::where('container',$request->container)->first();
        $invWh      = IwhHeader::where('container',$request->container)
                                          ->where('tipe','CR')->get();
        $invMan     = InvManHeader::where('container',$request->container)->get();

        $pdf = PDF::loadview('wh.container.singlecontpdf',[
                     'container'   => $container,
                     'whHeader'    => $invWh,                   
                  ]);
        $pdf->setPaper('A4', 'portrait');
        //$pdf->setPaper('A5', 'Landscape');
        //setPaper('A4', 'portrait');       
        return $pdf->stream();

    }



    public function PdfByContainer(Request $request)
    {


        $bln = $request->bulan;
        $thn = $request->tahun;
        $container = Container::whereMonth('eta',$request->bulan)->orderBy('eta','ASC')->get();
        //$container = Container::all();
        //return view('wh.container.qbycontpdf',$data);

        //dd($request->all());
        if ($bln == 10) {
          $nmbulan = 'Januari';
        }
        if ($bln == 11) {
          $nmbulan = 'November';
        }
        if ($bln == 12) {
          $nmbulan = 'Desember';
        }


        $pdf = PDF::loadview('wh.container.qbycontpdf',[
                    'bln' => $bln,
                    'thn' => $thn,
                    'nmbulan' => $nmbulan,
                     'container'  => $container,
                  ]);
        $pdf->setPaper('A4', 'Landscape');
        //$pdf->setPaper('A5', 'Landscape');
        //setPaper('A4', 'portrait');
       
        return $pdf->stream();

    }

    public function PdfBySoa(Request $request) 
    {

        $bln = $request->bulan;
        $thn = $request->tahun;
        $invMst = InvWhMaster::whereMonth('eta',$request->bulan)->get();
        //$container = Container::all();
        //return view('wh.container.qbycontpdf',$data);

        //dd($request->all());
        if ($bln == 10) {
          $nmbulan = 'Januari';
        }
        if ($bln == 11) {
          $nmbulan = 'November';
        }
        if ($bln == 12) {
          $nmbulan = 'Desember';
        }

        $pdf = PDF::loadview('wh.container.qbysoapdf',[
                    'bln' => $bln,
                    'thn' => $thn,
                    'nmbulan' => $nmbulan,
                    'invmaster'  => $invMst,
                  ]);
        $pdf->setPaper('A4', 'Landscape');
        //$pdf->setPaper('A5', 'Landscape');
        //setPaper('A4', 'portrait');
       
        return $pdf->stream();


    }



}
