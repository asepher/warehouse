<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
         
use App\Models\Manifest;
use App\Models\Vessel;
use App\Models\Customer;
use App\Models\Container;
use App\Models\Param;
use App\Models\Tarif;
use App\Models\IwhHeader;
use App\Models\IwhDetail;

use App\Imports\TempWhImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TempDataWh;
use App\Helpers\Helper;

use Session;
use PDF;
 
class WhInvoiceController extends Controller
{

   //Create CR #1 
   public function InvoiceView($inv)
    { 

      $manifest = Manifest::where('kd_inv',$inv)->first();
      if (!$manifest) {
            return "error";
      }      
      $tarif = Tarif::where('term',$manifest->term)->where('tipe','CR')->get();
      //dd($tarif);
      $invHd    = IwhHeader::where('kd_inv',$inv)->get();
      $invDt = IwhDetail::where('kd_inv',$inv)->get();  
      return view('wh.invoice.crview',[
                     'man'       =>  $manifest,
                     'nominv'    =>  $inv,                        
                     'invhd'     =>  $invHd, 
                     'vsl'       => $manifest->kd_vsl,  
                     'tarif'    => $tarif,     
                      'dtls'       =>  $invDt,                  
               ]);

    }
 
    //Create CR #2
    public function InvoiceGen(Request $request,$inv)
    {

         $this->validate($request,[
            'tanggal'  =>  'required', 
         ]); 
         $tgl      = $request->tanggal;
         $tipe     = 'CR';        
         $manifest = Manifest::where('kd_inv',$inv)->first(); 
         $vessel = Manifest::where('kd_inv',$inv)->first(); 
         $invHd    = IwhHeader::where('kd_inv',$inv)->get();

         $cekDt = Helper::HitInvHd($inv,$tipe);   
         //dd($cekDt);
         if ($cekDt == 0) {
            Helper::AddInvHeader($inv,$tipe,$tgl);
         }
          
        //$invHd = IwhHeader::where('kd_inv',$inv)->first();      
        $invDt = IwhDetail::where('kd_inv',$inv)->get();  

        //$manifest = Manifest::where('kd_inv',$inv)->first(); 

        //$tarif1 = Tarif::where('term',$manifest->term)->where('is_aktif',1)->get();

          return view('wh.invoice.crpdfview',[
                       'inv'        =>  $inv,
                       'hd'          => $invHd,
                       'dtls'       =>  $invDt,
                        'manifest'       =>  $manifest,
                        'tgl'       =>  $tgl,
                   ]);

    }


   public function InvoicePdfView($inv)
   {

    $invHd = IwhHeader::where('kd_inv',$inv)->first();      
    $invDt = IwhDetail::where('kd_inv',$inv)->get();      
    $manifest = Manifest::where('kd_inv',$inv)->first(); 

    //$tarif1 = Tarif::where('term',$manifest->term)->where('is_aktif',1)->get();


    
      return view('wh.invoice.crpdfview',[
                   'inv'        =>  $inv,
                   'hd'          => $invHd,
                   'dtls'       =>  $invDt,
                    'manifest'       =>  $manifest,
                    'tgl'       =>  $invHd->tgl,
               ]);

   }
 
   public function DownloadCrPdf(Request $request)
   {
      //dd($request->all());
      $tipe   = $request->tipe;
      $inv    = $request->inv;
      $header = IwhHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first();  
      if (!$header) {
         return view('wh.error');
      }   
        $nmfile = $inv.$tipe; 
        $vessel = Vessel::where('kd_vsl',$header->kd_vsl)->first(); 
        $manifest = Manifest::where('kd_inv',$inv)->first();
        $invDt = IwhDetail::where('kd_inv',$inv)->get();   
        $pdf    = PDF::loadView('wh.invoice.crpdf',[
                'tipe'      => $tipe,
                'inv'       => $inv,
                'vessel'    => $vessel,
                'nmfile'    => $nmfile,
                'header'    => $header,
                'manifest'    => $manifest,
                'dtls'       =>  $invDt,
               ])->save('wh/'.$nmfile.'.PDF',true);
       
        $manifest->gen_inv = 1;
        $manifest->file_inv = 'CR';
        $manifest->tgl_inv = now();

        $manifest->save();

      return redirect()->route('wh.manifest.index',[$vessel->kd_vsl]);  
      //return $pdf->download($nmfile.'.PDF'); 
      //$pdf->stream();  
   }




   public function InvoicePDFGen(Request $request,$inv)
    {


        $this->validate($request,[
            'tanggal'  =>  'required',
        ]);
        $tgl = $request->tanggal;
        $tipe = 'CR';        
        $manifest = Manifest::where('kd_inv',$inv)->first(); 
        $file = $inv.$tipe.'.PDF';
        $tarif = Tarif::where('term',$manifest->term)->get();
        $cekDt = Helper::HitInvHd($inv,$tipe);
        if ($cekDt == 0 ) {
            $pdf    = PDF::loadView('wh.invoice.pdf',[
                    'inv'        =>  $inv,
                    'manifest'  =>  $manifest,
                    'tarif'     =>  $tarif,
                    'tgl'       =>  $tgl,
                    ])->save('wh/'.$file,true)->stream('invoice.pdf');
            Helper::AddInvHeader($inv,$tipe,$tgl);
        }    
        return redirect()->route('wh.vessel.manifest.detail.index',[$manifest->kd_vsl]);  
        
    }

    public function unPosting(Request $request, $vsl)
    {

      $manifest       = Manifest::where('kd_inv',$request->invoice)
                        ->where('kd_vsl',$vsl)->first();
      if (!$manifest) {
        dd("Error database");
      }

      $manifest->gen_inv = 0;
      $manifest->save();
      //dd("unpostign sukses");
      return redirect()->route('wh.manifest.index',[$vsl]);

    }


    //Create DN #1
    public function InvByVessel($id)
    {

        $vessel         = Vessel::where('kd_vsl',$id)->first();
        $container      = Container::where('kd_vsl',$id)->get();
        $manifest       = Manifest::where('term','FOB')->where('kd_vsl',$id)->get();
        $IwhHeader      = IwhHeader::all();

        return view('wh.invoice.vessel',[
                    'id'        =>  $id,
                    'vessel'    =>  $vessel,
                    'container' =>  $container,
                    'manifest'  =>  $manifest,
                    'IwhHeader' =>  $IwhHeader,
                ]);
    }

        //Create DN #2
    public function GenByVessel(Request $request,$vsl){

            $this->validate($request,[
               'container'  =>  'required',
            ]);
         
            $tipe      =  'DN';
            $term      =  "FOB";
            $cont      =  $request->container;
            $vessel    =   Vessel::where('kd_vsl',$vsl)->first();

            $cekHd     =   IwhHeader::where('term',$term)->where('kd_vsl',$vsl)
                            ->where('container',$cont)->count(); 

           
            //Cek Ada FOB 
            $cekFOB = Manifest::where('term',$term)->where('container',$cont)->count();
            //dd($cekFOB);
            if ($cekFOB >> 0) {
               
                 
                  if ($cekHd == 0 ) {
                      $tarif      = Tarif::where('term',$term)->get();                                       
                      $IwhHeader  = IwhHeader::where('term',$term)->where('kd_vsl',$vsl)
                                      ->where('container',$cont)->get();
                      $kd_inv     = Helper::GenKodeInvDn($vsl);
                      $idp        = Helper::GetIdp($vsl,$vessel->eta);
                      //insert header dan detail 
                        $dtheader = [
                          'idp'       =>  $idp,
                          'kd_inv'    =>  $kd_inv,
                          'tipe'      =>  $tipe,                
                          'kd_vsl'    =>  $vsl,
                          'term'      =>  $term,
                          'container' =>  $cont,
                          'jumlah'    =>  0,
                          'tgl_gen'   =>  date('Y/m/d'),
                        ];
                        //dd($dtheader);
                        IwhHeader::create($dtheader);   
                        //echo $man->consignee;

                        //hitung 
                        $weight  = Helper::JumItemDn($cont,'weight');
                        $measure = Helper::JumItemDn($cont,'measure');
                        $min     = Helper::JumItemDn($cont,'min');
                        $min_actual  = Helper::JumItemDn($cont,'min_actual');
                              
                                 foreach ($tarif as $trf) {
                                     $dtDtl = [
                                       'idp'       => $idp, 
                                       'kd_inv'    => $kd_inv, 
                                       'tipe'      => $tipe, 
                                       'term'      => $term, 
                                       'kd_vsl'    => $vsl,
                                       'kd_tarif'   => $trf->kd_tarif, 
                                       'nama_tarif' => $trf->nama_tarif, 
                                       'tarif'      => $trf->jumlah, 
                                       'weight'    => $weight, 
                                       'measure'   => $measure, 
                                       'vol_actual' => $min_actual,
                                       'wm'        => $min,
                                       'jumlah'    => $trf->tarif * $min,
                                       'ppn'       => 0, 
                                       'container' => $cont, 
                                       'is_adm'    => $trf->is_adm, 
                                   ];
                                   //dd($dtDtl);
                                   IwhDetail::create($dtDtl);
                               }

                        $nmfile = $kd_inv.$tipe;                      
                        /*                  
                        $pdf  = PDF::loadView('wh.invoice.dnpdf',[
                                'id'        =>  $vsl,
                                'kd_inv'     => $nmfile,
                                'tanggal'   =>  date('m-d-Y'),
                                'vessel'     => $vessel,
                                'tarif'      => $tarif,
                                'container'  => $request->container,
                            ])->save('wh/'.$nmfile.'.PDF',true)->stream('invoicedn.pdf');
                        */
                        /*
                          return view('wh.invoice.dnpdf',[
                                'id'        =>  $vsl,
                                'kd_inv'     => $nmfile,
                                'tanggal'   =>  date('m-d-Y'),
                                'vessel'     => $vessel,
                                'tarif'      => $tarif,
                                'container'  => $request->container,
                            ])->with(['success' => 'Berhasil  Generate']);
                        */                       
                     return redirect()->route('wh.invoice.genvessel',$vsl)
                              ->with(['success' => 'Invoice berhasil di generate']);

                  } else {

                     //inv sudah pernah ada 
                     return redirect()->route('wh.invoice.genvessel',$vsl)
                        ->with(['success' => 'Invoice Sdh pernah di generate']);
                  }

            }
         // Tidak ada data FOB   
         return redirect()->route('wh.invoice.genvessel',$vsl)->with(['success' => 'Data FOB Tidak ada']);;

    }

        //Create DN #3
    public function Pdfdn($tipe,$inv){
         $nmfile = $inv.$tipe; 
         $header = IwhHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first();  
         //dd($header);
         if (!$header) {
               return view('wh.error');
            }   
         $vessel = Vessel::where('kd_vsl',$header->kd_vsl)->first();   
     
         return view('wh.invoice.viewdn',[  
               'tipe'      => $tipe,
               'inv'       => $inv,
               'vessel'    => $vessel,
               'nmfile'    => $nmfile,
               'header'    => $header,
               'tarif'     => Tarif::where('term','FOB')->get(),
         ]);



    }

    //Create DN #4
    public function PrintPdfdn(Request $request)
    {

        $tipe   = $request->tipe;
        $inv    = $request->inv;
        $header = IwhHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first();  
        if (!$header) {
            return view('wh.error');
        }   
        $nmfile = $inv.$tipe; 
        $vessel = Vessel::where('kd_vsl',$header->kd_vsl)->first(); 
        $pdf    = PDF::loadView('wh.invoice.pdfdn',[
              'tipe'      => $tipe,
              'inv'       => $inv,
              'vessel'    => $vessel,
              'nmfile'    => $nmfile,
              'header'    => $header,
              'tarif'     => Tarif::where('term','FOB')->get(),
               ])->save('wh/'.$nmfile.'.PDF',true);
         return $pdf->download($nmfile.'.PDF'); //$pdf->stream();  

    }


}
