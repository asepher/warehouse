<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
        
use App\Models\Manifest;
use App\Models\Tarif;
use App\Models\Container;
use App\Models\Vessel; 
use App\Models\InvDnHeader;
use App\Models\InvDnDetail;
use App\Models\InvWhMaster;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\dtLog;

use App\Helpers\Helper;
use PDF;
  

class InvoiceController extends Controller
{
    public function draft($vsl,$id)
    {

         //return view('manifest.view_inv');
         $manifest = Manifest::where('id',$id)->first();  
         if (!$manifest) {
            return "error";
         } else       
         $tarif = Tarif::where('term',$manifest->term)->get();
         return view('manifest.draft_inv',[
                  'man'       =>  $manifest,
                  'nominv'    =>  $id,                        
                  'tarif'     =>  $tarif,
                  'id'       =>  $id,
                  'vsl'       => $vsl,
               ]);        

    }

    public function generate(Request $request,$id)
    {
         $tanggal = $request->tanggal;   
         $manifest = Manifest::where('id',$id)->first();  
         $tarif = Tarif::where('term',$manifest->term)->get();   
         return view('manifest.gen_inv',[
               'tanggal'   => $tanggal,
               'inv'        => $id,
               'manifest'  =>  $manifest,
               'tarif'     =>  $tarif,
            ]);

    }

    public function generateVessel($vsl)
    {
         $vessel   = Vessel::where('kd_vsl',$vsl)->first();
         //$manifest   = Manifest::where('kd_vsl',$vsl)->get();
         $container  = Container::where('kd_vsl',$vsl)->get();   


         return view('wh.invoice.vessel',[               
               'vsl'       => $vsl,
               'container' => $container,
               'vessel'    => $vessel,

            ]);
    }



   public function genInvoiceDn(Request $request,$vsl)
   {
      
      $container    = Container::where('kd_vsl',$vsl)->get();
      $vessel       = Vessel::where('kd_vsl',$vsl)->first();
      //dd($vessel->vessel);
      $jumcon       = Container::where('kd_vsl',$vsl)->count();
      //$invdn_master = InvWhMaster::where('kd_vsl',$vsl)->first();        
      //$invdn_header = InvDnHeader::where('kd_vsl',$vsl)->get();

      if ( strtotime($vessel->eta)  >= strtotime("2022-11-01") ) {
          //dd('tarif baru '. $manifest->eta);
          $tarif = Tarif::where('term','FOB')->where('tipe','CR')
                  ->whereDate('period','>=','2022-11-01')->get();
      }
      if ( strtotime($vessel->eta)  <= strtotime("2022-10-31") ) {
          //dd('tarif lama - ' . $manifest->eta );
          $tarif = Tarif::where('term','FOB')->where('tipe','CR')
                  ->whereDate('period','<=','2022-10-31')->get();
      }

     
      //$tarif        = Tarif::where('term','FOB')->get(); 
      $flash        = Manifest::where('kd_vsl',$vsl)->where('term', 'FOB')->count();
       
      //dd($invdn_master);
      foreach ($container as $ctn ) { 


         $manifest     = Manifest::where('kd_vsl',$vsl)->where('container',$ctn->container)
                                  ->where('term','FOB')->get();

         //$chkMst     =  InvWhMaster::where('kd_vsl',$vsl)->where('container',$ctn->container)
         //               ->where('tipe','DN')->count();

         $chkMst     = InvWhMaster::where('kd_vsl',$vsl)->where('container',$ctn->container)
                     ->where('tipe','DN')->first();


               if (!$chkMst) {
                   $kd_inv   = Helper::GenKodeInvDn($vsl);

                        $dtInvMst  = [
                           'kd_inv' => $kd_inv,
                           'term'   => 'FOB',
                           'tipe'   => 'DN',
                           'kd_vsl'    => $vsl,
                           'container' => $ctn->container,
                           'eta'       => $ctn->eta,
                           'tgl_gen'   => now(),
                        ];
                        //dd($dtInvMst);
                        InvWhMaster::create($dtInvMst);
               } else {
                  $kd_inv   = $chkMst->kd_inv;                  
                  Helper::deleteDN($vsl,$kd_inv);

               } // end if else
 
               //cari header
               $chkHdr  = InvDnHeader::where('kd_vsl',$vsl)->where('container',$ctn->container)
                     ->where('tipe','DN')->first();

               if (!isset($chkHdr)) {

 

                        foreach ($manifest as $man ) {

                            $dtheader = [
                               'seq'         =>  $man->seq,                              
                               'kd_inv'      =>  $kd_inv,
                               'tipe'        =>  'DN',
                               'kd_vsl'      =>  $vsl,
                               'vessel_name' =>    $vessel->vessel,
                               'term'        =>  'FOB',
                               'container'        =>  $ctn->container,
                               'kd_cnee'           => $man->kd_cnee, 
                               'cnee_name'         => $man->cnee_name, 
                               'cnee_address'      => $man->cnee_address, 
                               'cnee_npwp'         => $man->cnee_npwp, 
                               'kd_forwader'       => $man->kd_forwader,    
                               'forwader_name'     => $man->forwader_name, 
                               'forwader_address'  => $man->forwader_address,  
                               'forwader_npwp'     => $man->forwader_npwp,  
                               'jumlah'            => 0,
                               'hbl'               => $man->hbl,
                               'vls_bl'            => $man->vls_bl,
                               'weight'            => $man->weight,
                               'min_actual'        => $man->min_actual,
                               'vol_soa_vls'       => $man->min_actual,
                               'inv_soa_vls'       => 0,
                               'tgl_gen'           => now(),  
                               ];
                              InvDnHeader::create($dtheader);

                              foreach ($tarif as $trf) {
                                     if ($trf->is_adm == 1) {
                                        $weight = 0;
                                        $measure = 0;
                                        $vol_actual = 1;
                                     } else {
                                        $weight = $man->weight;
                                        $measure = $man->measure;
                                        $vol_actual = $man->min_actual;
                                     }

                                     $dtDtl = [                                         
                                        'seq'       => $man->seq, 
                                        'kd_inv'    => $kd_inv,
                                        'tipe'      => 'DN', 
                                        'term'      => 'FOB', 
                                        'kd_vsl'    => $vsl,
                                        'kd_tarif'   => $trf->kd_tarif, 
                                        'nama_tarif' => $trf->nama_tarif, 
                                        'tarif'      => $trf->charge, 
                                        'weight'      => $weight, 
                                        'measure'     => $measure, 
                                        'vol_actual'  => $vol_actual, 
                                        'wm'          => 0,
                                        'jumlah'      => $vol_actual*$trf->charge,
                                        'ppn'         => $trf->ppn,
                                        'jumPPn'      => ($vol_actual*$trf->charge) * 0.11,
                                        'container'   => $ctn->container, 
                                        'is_adm'      => $trf->is_adm, 
                                    ];
                                    InvDnDetail::create($dtDtl);    

                              }

                              //update invwh master
                              $inv_soa    = InvDnDetail::where('seq', $man->seq)->where('kd_inv',$kd_inv)
                                                         ->sum('jumlah');
                              $invHd      = InvDnHeader::where('kd_inv',$kd_inv)->where('seq',$man->seq)
                                                         ->first();
                              $invHd->inv_soa_vls = $inv_soa;
                              $invHd->save();

                        }  // end if foreach



                  } else {

                     dd('ketemu ');

                  }// end if else 

       }


       $msg = 'Data DN';
       $term = 'FOB';
       $tgl = now();
       //$inv,$term,$msg,$tgl
       Helper::CreateLog($kd_inv,$term,$msg,$tgl);


            return view('wh.invoice.generatedn',[
               'vsl' => $vsl,
               'vessel'  => $vessel,
               'jumcon' => $jumcon,
               'container' => $container,
               //'invdn_master'  => $invdn_master,
               //'invdn_header'  => $invdn_header,
               'manifest'  => $manifest,
               'tarif' => $tarif,
               'flash'  => $flash,
        
            ]); 
    }
 
 

   //PRINT DN
   public function genPdfInvDn(Request $request,$vsl)
   {

      $cont       = $request->container;
      $manifest   = Manifest::where('container',$cont)->first();      
      $header     =  InvDnHeader::where('kd_vsl',$vsl)->where('container',$cont)
                     ->where('tipe','DN')->get();

      $masterDn   =  InvWhMaster::where('container',$cont)->where('kd_vsl',$vsl)
                     ->where('tipe','DN')->first();
/*
      $masterDn->inv_dn = 1;
      $masterDn->save();      
*/
      //dd($masterDn);     
      $nmfile  = $masterDn->kd_inv . $masterDn->tipe . ".PDF";
      //dd($nmfile);
      $pdf  = PDF::loadView('wh.invoice.pdfdn',[
                  'inv'       => $masterDn->kd_inv,
                  'cont'      => $cont,
                  'kd_vsl'    => $vsl,
                  'manifest'  => $manifest,
                  'header'    => $header,  
                  'masterDn'    => $masterDn,  

                ]);                              
      return $pdf->stream();
 
      //save('wh/'.$nmfile,true)
      //$pdf->stream();
      //return redirect()->route('wh.generate.invoicedn',[$manifest->kd_vsl]);
      //dd('Sukses');

   }



    //form tanggal dn
    public function genFormTglDn(Request $request,$vsl)
    {
      
      $data['vsl'] = $vsl;
      $data['container'] = $request->vsl;
      $data['kd_inv'] = $request->kd_inv;
      return view('wh.invoice.formtgldn',$data);
    }

    public function genPdfInvTglDn(Request $request,$vsl)
    {
      //dd($request->all());
      $tglinv  = $request->tgl_invdn;
      $vsl     = $vsl;
      $kd_inv  = $request->kd_inv;
 
      /// update tangal 
      $cariMst = InvWhMaster::where('kd_inv',$kd_inv)->first();
      $cariMst->tgl_gen    =  $tglinv;
      $cariMst->save();

      //dd('update');
      $cont       = $cariMst->container;
      $manifest   = Manifest::where('container',$cont)->first();      
      $header     =  InvDnHeader::where('kd_vsl',$vsl)->where('container',$cont)
                     ->where('tipe','DN')->get();

      $masterDn   =  InvWhMaster::where('container',$cont)->where('kd_vsl',$vsl)
                     ->where('tipe','DN')->first();      
/*
      $masterDn->inv_dn = 1;
      $masterDn->save();      
*/
      //dd($masterDn);     
      $nmfile  = $masterDn->kd_inv . $masterDn->tipe . ".PDF";
      //dd($nmfile);
      $pdf  = PDF::loadView('wh.invoice.pdfdn',[
                  'inv' => $masterDn->kd_inv,
                  'cont'   => $cont,
                  'kd_vsl' => $vsl,
                  'manifest'  => $manifest,
                  'header'    => $header,
                  'masterDn'  => $masterDn,                  
                ]);                              
      return $pdf->stream();

      //save('wh/'.$nmfile,true)
      //$pdf->stream();
      //return redirect()->route('wh.generate.invoicedn',[$manifest->kd_vsl]);
      //dd('Sukses');

    }

 

   public function genInvoiceCn(Request $request,$vsl)
   {   

      $tgl_eta               = Vessel::where('kd_vsl',$vsl)->first()->eta;
      $data['vsl']           = $vsl;
      $data['container']     = Container::where('kd_vsl',$vsl)->get();
      $data['vessel']        = Vessel::where('kd_vsl',$vsl)->first();
      $data['jumcon']        = Container::where('kd_vsl',$vsl)->count();
      $data['invdn_header']  = InvDnHeader::where('kd_vsl',$vsl)->get();  

      if ( strtotime($tgl_eta)  >= strtotime("2022-11-01") ) {
         //dd('tarif baru');
            $data['tarif']    = Tarif::where('term','CNF')->where('is_adm',2)
            ->whereDate('period','>=','2022-11-01')->get(); 
      }
      if ( strtotime($tgl_eta)  <= strtotime("2022-10-31") ) {
         //dd('tarif lama');
            $data['tarif']    = Tarif::where('term','CNF')->where('is_adm',2)
            ->whereDate('period','<=','2022-10-31')->get(); 
      }


      $data['manifest']      = Manifest::where('term','CNF')->where('kd_vsl',$vsl)->get(); 
      $data['flash']         = Manifest::where('kd_vsl',$vsl)->where('term', 'CNF')->count();

         //dd($container);
      foreach ($data['container'] as $ctn ) { 

         $manifest     = Manifest::where('kd_vsl',$vsl)->where('container',$ctn->container)
                                  ->where('term','CNF')->get();

         $chkMst     =  InvWhMaster::where('kd_vsl',$vsl)->where('container',$ctn->container)
                        ->where('tipe','CN')->count();         
         if ($chkMst == 0) {
            //invoice master
            $kd_inv   = Helper::GenKodeInvDn($vsl);
            $dtInvMst  = [
               'kd_inv' => $kd_inv,
               'term'   => 'CNF',
               'tipe'   => 'CN',
               'kd_vsl'    => $vsl,
               'container' => $ctn->container,
               'tgl_gen'   => now(),
            ];
            //dd($dtInvMst);
            InvWhMaster::create($dtInvMst);

            //$tarif = Tarif::where('term','FOB')->get();
            //dd($manifest);
            foreach ($manifest as $man ) {
                $dtheader = [
                   'seq'         =>  $man->seq,                              
                   'kd_inv'      =>  $kd_inv,
                   'tipe'        =>  'CN',
                   'kd_vsl'      =>  $vsl,
                   'term'        =>  'CNF',
                   'container'      =>  $ctn->container,
                   'kd_cnee'           => $man->kd_cnee, 
                   'cnee_name'         => $man->cnee_name, 
                   'cnee_address'      => $man->cnee_address, 
                   'cnee_npwp'         => $man->cnee_npwp, 
                   'kd_forwader'       => $man->kd_forwader,    
                   'forwader_name'     => $man->forwader_name, 
                   'forwader_address'  => $man->forwader_address,  
                   'forwader_npwp'     => $man->forwader_npwp,  
                   'jumlah'            =>  0,
                   'tgl_gen'           =>  now(),  
                   ];
                  InvDnHeader::create($dtheader);

                  foreach ($data['tarif']  as $trf) {

                     if ($trf->is_adm == 2) {

                         $dtDtl = [                                         
                            'seq'       => $man->seq, 
                            'kd_inv'    => $kd_inv,
                            'tipe'      => 'CN', 
                            'term'      => 'CNF', 
                            'kd_vsl'    => $vsl,
                            'kd_tarif'   => $trf->kd_tarif, 
                            'nama_tarif' => $trf->nama_tarif, 
                            'tarif'      => $trf->charge, 
                            'weight'      => $man->weight, 
                            'measure'     => $man->measure, 
                            'vol_actual'  => $man->min_actual, 
                            'wm'        => 0,
                            'jumlah'    => $man->min_actual*$trf->jumlah,
                            'ppn'       => $trf->ppn, 
                            'container' => $ctn->container, 
                        ];
                        InvDnDetail::create($dtDtl);         

                     } // end if 


                  }

            }  // end foreach manifest



         }// end foreach container

       }


      //dd($data['manifest']);
      return view('wh.invoice.generatecn',$data);
   }


   public function genCnPdfView(Request $request,$vsl){

      //dd($request->all());
        $manifest   = Manifest::where('kd_vsl',$vsl)->first();
        $vessel     = Vessel::where('kd_vsl',$vsl)->first();
        $container  = $request->container;
        $invMst     = InvWhMaster::where('kd_vsl',$vsl)->where('container',$container)
                        ->where('tipe','CN')->first();

         // ambil NOMOR kode invoice
         //$kd_inv = Helper::GenKodeInvDn($vsl);                     
         //$header = IwhDnHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first();  

         $header = InvDnHeader::where('kd_vsl',$vsl)->where('container',$request->container)
                           ->where('tipe','CN')->get();

         //dd($header);
         if (!$header) {
               return view('wh.error');
            }   
         //$vessel = Vessel::where('kd_vsl',$header->kd_vsl)->first();   

         //dd($manifest);
         return view('wh.invoice.viewcn',[  
               'inv'          => $invMst->kd_inv,
               'tipe'         => 'CN',
               'manifest'     => $manifest,
               'vessel'       => $vessel,                           
               'container'    => $container,                           
               'header'       => $header, 

         ]);

   }



   public function genCnPdfPrint(Request $request,$vsl)
   {
 //dd($request->all());
      $cont       = $request->container;
      $manifest   = Manifest::where('container',$cont)->first();      
      $header     =  InvDnHeader::where('kd_vsl',$vsl)->where('container',$cont)
                     ->where('tipe','CN')->get();

      $masterDn   =  InvWhMaster::where('container',$cont)
                      ->where('tipe','CN')->first();
      //dd($masterDn->kd_inv);     
      $nmfile  = $masterDn->kd_inv . $masterDn->tipe . ".PDF";
      //dd($nmfile);

                $masterDn->inv_cn = 1;
                $masterDn->save();                       

       $pdf  = PDF::loadView('wh.invoice.pdfcn',[
                  'inv' => $masterDn->kd_inv,
                  'cont'   => $cont,
                  'kd_vsl' => $vsl,
                  'manifest'  => $manifest,
                  'header'    => $header,                      
                ]);
       //->save('wh/'.$nmfile,true); 
      return $pdf->stream();
      //return redirect()->route('wh.generate.invoicecn',[$manifest->kd_vsl]);
      //dd('Sukses');

   }



   public function generateVesselView(Request $request,$vsl)    
   {

        $manifest   = Manifest::where('kd_vsl',$vsl)->first();
        $vessel     = Vessel::where('kd_vsl',$vsl)->first();
        $container  = $request->container;
        $invMst     = InvWhMaster::where('kd_vsl',$vsl)->where('container',$container)
                        ->where('tipe','DN')->first();

         // ambil kode invoice
         //$kd_inv = Helper::GenKodeInvDn($vsl);                     
         //$header = IwhDnHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first();  

         $header = InvDnHeader::where('kd_vsl',$vsl)->where('container',$request->container)
                        ->where('tipe','DN')->get();
         //dd($header);
         if (!$header) {
               return view('wh.error');
            }   
         //$vessel = Vessel::where('kd_vsl',$header->kd_vsl)->first();   

         //dd($manifest);
         return view('wh.invoice.viewdn',[  
               'inv'          => $invMst->kd_inv,
               'tipe'         => 'DN',
               'manifest'     => $manifest,
               'vessel'       => $vessel,                           
               'container'    => $container,                           
               'header'       => $header, 

         ]);

   }



   public function generateVesselPdf($vsl)
   {

      dd($vsl);


      //$vsl        = $request->vls;
      $vessel     = Vessel::where('kd_vsl',$vsl)->first();
      $tarif      = Tarif::where('term','FOB')->get();   
      $container  = Container::where('kd_vsl',$vsl)->get();
      $manifest   = Manifest::where('term','FOB')
                           ->where('kd_vsl',$vsl)
                           ->get();       
      //dd($manifest);
      //$request->cont;

      //PROSES SAVE DN
      $cek = InvDnHeader::where('kd_vsl',$vsl)->count();
      if ($cek == 0) {
         $tipe = "DN";

         $num = $vessel->last_num+1;
         $kd_inv = "SSLI".$vessel->inv3.sprintf("%02s", $num);

         $vessel->last_num = $num;
                $vessel->save(); 

         $idp    = "202000";
                
         $dtheader = [         
               'idp'          =>  '2020101010',
               'kd_inv'       =>  $kd_inv,
               'term'         =>  'FOB',            
               'tipe'         =>  $tipe,                
               'kd_vsl'       =>  $vsl,
               'vls_bl'       =>  $vessel->vls_bl,
               'container'    =>  $request->cont,    
               'tgl_gen'      =>  now(),      
         ];
         InvDnHeader::create($dtheader);          

          $weight     = GetWeight('FOB', $container);
          $measure    = GetMeasure('FOB', $container);
          $min        = GetMin('FOB', $container);

         
         foreach ($tarif as $trf) {
            $dtdetail = [

               'idp'          => '2020101010',
               'kd_vsl'       => $vsl,
               'container'    =>  $request->cont,  
               'kd_tarif'     => $trf->kd_tarif ,
               'nama_tarif'   => $trf->nama_tarif,
               'jumlah'       => 0,

            ];
            InvDnDetail::create($dtdetail);
         }





      } 

      return view('invoice.vessel',[
               'vsl'   => $vsl,   
               'container'  => $container,
               'vessel'     => $vessel,
            ]);
     //return $id; 
     
    }

    public function genContainer(Request $request,$cont)
   {

      $row        = Container::where('container',$cont)->first();   
      $manifest   = Manifest::where('container',$cont)->get();  

      return view('wh.invoice.containerview',[
               'row' => $row,
               'container' => $cont,
               'manifest'  => $manifest,
         ]);
    }


    public function genInvoiceByCont(Request $request,$cont)
    {
      //dd($request->kd_vsl);
      $vsl = $request->kd_vsl;
      dd($vsl);
      Helper::deleteDN($vsl);
      //$manifest   = Manifest::where('container',$cont)->first(); 
      $container  = Container::where('container',$cont)->first(); 
      $tarif = Tarif::where('term','FOB')->get();

      $cekhd = InvDnHeader::where('kd_vsl',$vsl)->where('container',$cont)->count();  

      if ($cekhd == 0) {

               //invoice Genrate Number :
               $nominv = Helper::GenKodeInvDn($vsl);
               $idp = Helper::GetIdp($vsl,$container->eta);

               $data = [
                  'idp'          =>  $idp,
                  'kd_inv'       =>  $nominv,
                  'kd_vsl'       =>  $vsl,
                  'container'    =>  $cont,
                  'tipe'         =>  'DN',
                  'term'         =>  'FOB',
               ];
               InvDnHeader::create($data);  

               $cekdtl = InvDnDetail::where('kd_vsl',$vsl)
                  ->where('container',$cont)->count();

               if ($cekdtl == 0) {

                  $weight     = Helper::GetWeight('FOB', $cont);
                  $measure    = Helper::GetMeasure('FOB', $cont);
                  $min        = Helper::GetMin('FOB', $cont);
               
                  foreach ($tarif as $trf) {
                     $dtdetail = [
                        'idp'          => $idp,
                        'kd_vsl'       => $vsl,
                        'container'    => $cont,  
                        'kd_tarif'     => $trf->kd_tarif ,
                        'nama_tarif'   => $trf->nama_tarif,
                        'jumlah'       => 0,
                     ];
                     InvDnDetail::create($dtdetail);            
                     }    
               }  
 
              // genrerate DN PDF
               $manifest = Manifest::where('kd_vsl',$vsl)->first();

               return view('wh.invoice.viewdn',[  
                     'inv'          => $nominv,
                     'tipe'         => 'DN',
                     'manifest'     => $manifest,
                     'vessel'       => $vsl,                           
                     'container'    => $cont,                           
                     'tarif'        => $tarif,
               ]);
           
         } else {
            return view('wh.error');
         }

   } 


}

