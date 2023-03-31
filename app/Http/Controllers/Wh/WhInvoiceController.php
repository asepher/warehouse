<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
         
use App\Models\Manifest;
use App\Models\Vessel;
use App\Models\Customer;
use App\Models\Container;
use App\Models\Param;
use App\Models\Tarif;
use App\Models\IwhHeader;
use App\Models\IwhDetail;
use App\Models\dtLog;


use App\Imports\TempWhImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TempDataWh;
use App\Helpers\Helper;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
//use RealRashid\SweetAlert\Facades\Alert;

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

      //dd($manifest->eta); 
      //'2022-08-12'
      if ( strtotime($manifest->eta)  >= strtotime("2022-11-01") ) {
          //dd('tarif baru '. $manifest->eta);
          $tarif = Tarif::where('term',$manifest->term)->where('tipe','CR')
                  ->whereDate('period','>=','2022-11-01')->get();
      } 

      if ( strtotime($manifest->eta)  <= strtotime("2022-10-31") ) {
          //dd('tarif lama - ' . $manifest->eta );
          $tarif = Tarif::where('term',$manifest->term)->where('tipe','CR')
                  ->whereDate('period','<=','2022-10-31')->get();
      }

      $invHd    = IwhHeader::where('kd_inv',$inv)->get();
      $invDt    = IwhDetail::where('kd_inv',$inv)->get();  

      return view('wh.invoice.crview',[
                    'man'       =>  $manifest,
                    'nominv'    =>  $inv,    
                    'tarif'     => $tarif,                     
                    'invhd'     =>  $invHd, 
                    'vsl'       => $manifest->kd_vsl,  
                    'dtls'       =>  $invDt,                  
               ]);

    } 
 
    //Create CR #2
    public function InvoiceGen(Request $request,$inv)
    {
 
         $this->validate($request,[
            'tanggal'  =>  'required', 
         ]); 
         $tgl       = $request->tanggal;
         $tipe      = 'CR';        
         $manifest  = Manifest::where('kd_inv',$inv)->first(); 
         $vessel    = Manifest::where('kd_inv',$inv)->first(); 
         $invHd     = IwhHeader::where('kd_inv',$inv)->get();

         //HITUNG INV_WH_HEADER
         $cekDt = Helper::HitInvHd($inv,$tipe);   

         //1. JIKA ADA HAPUS INV_WH_HEADER
         //2. INSERT KE INV_WH_HEADER
         if ($cekDt == 0) {
            Helper::AddInvHeader($inv,$tipe,$tgl);
         } 
          
        //$invHd = IwhHeader::where('kd_inv',$inv)->first();      
        $invDt = IwhDetail::where('kd_inv',$inv)->get();  

        //-----------------
        $header = IwhHeader::where('tipe',$tipe)->where('kd_inv',$inv)->first(); 
        if (!$header) {
           return view('wh.error');
        }          

        //UPDATE INVWH_HEADER
        $sum_tarif_dtl = IwhDetail::where('kd_inv',$inv)->where('kd_vsl', $header->kd_vsl)
                        ->sum('jumlah'); 
        $sum_tarif_vat    = $sum_tarif_dtl * 0.11;
        $sum_tarif_tot = $sum_tarif_dtl + $sum_tarif_vat;
        if ($sum_tarif_tot >= 5000000 ) {
            $sum_tarif_mat    = 10000;          
        } else {
            $sum_tarif_mat    = 0;          
        }
        $sum_tarif_grandtot = $sum_tarif_dtl+$sum_tarif_vat+$sum_tarif_mat;
        $header->jumlah   = $sum_tarif_dtl;
        $header->vat      = $sum_tarif_vat;
        $header->materai  = $sum_tarif_mat;
        $header->grandtot = $sum_tarif_grandtot;
        $header->save();

        //UPDATE BILL TO 

        if ($manifest->term == "CNF") {
            $kd_bill_to       = $manifest->kd_cnee;
            $bill_to_name     = $manifest->cnee_name;
            $bill_to_address  = $manifest->cnee_address;
            $bill_to_npwp     = $manifest->cnee_npwp;
        }  
        if ($manifest->term == "FOB") {
            $kd_bill_to       = $manifest->kd_forwader;
            $bill_to_name     = $manifest->forwader_name;
            $bill_to_address  = $manifest->forwader_address;
            $bill_to_npwp     = $manifest->forwader_npwp;
        }  
        $manifest->kd_bill_to       = $kd_bill_to;
        $manifest->bill_to_name     = $bill_to_name;
        $manifest->bill_to_address  = $bill_to_address;
        $manifest->bill_to_npwp     = $bill_to_npwp;
        $header->save();

 
        $nmfile = $inv.$tipe; 
        $invDet = IwhDetail::where('kd_inv',$inv)->get();   
        $pdf    = PDF::loadView('wh.invoice.crpdf',[
                'tipe'      => $tipe,
                'inv'       => $inv,
                'vessel'    => $vessel,
                'nmfile'    => $nmfile,
                'header'    => $header,
                'manifest'    => $manifest,
                'dtls'       =>  $invDet,
               ])->save('wh/'.$nmfile.'.PDF',true);
       
        $manifest->gen_inv = 1;
        $manifest->file_inv = 'CR';        
        $manifest->tgl_inv = $tgl;
        if ($manifest->term == "FOB") {
          $manifest->tgl_paid = $tgl;
          $manifest->paid = 1;   
          $manifest->paid_at = 3;          
        }                
        $manifest->inv_wh = $sum_tarif_grandtot;
        $manifest->save();

        //CREATE LOG FILE
        if ($manifest->term == "FOB") {
              $log_msg = 'Generate Invoice CR';
              $log_term = $manifest->term;
              Helper::CreateLog($inv,$log_term,$log_msg,$tgl);
              $log_msg = 'Paid Invoice CR';
              $log_term = $manifest->term;
              Helper::CreateLog($inv,$log_term,$log_msg,$tgl);
        } else {
            $log_msg = 'Generate Invoice CR';
            $log_term = $manifest->term;
            Helper::CreateLog($inv,$log_term,$log_msg,$tgl);
        }

        //Alert::success('Invoice', 'Generate Successfully...');
        //session()->flash('message', 'Post successfully updated.');

        return redirect()->route('wh.manifest.index',[$vessel->kd_vsl]);  

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
      // un posting invoice 
      
      //dd($request->all());
      $tgl = null;
      $kd_inv = $request->invoice;
      $manifest       = Manifest::where('kd_inv', $kd_inv)->where('kd_vsl',$vsl)->first();
      if (!$manifest) {
        dd("Error database");
      }
      //dd($kd_inv);

      $manifest->gen_inv = 0;
      $manifest->tgl_inv  = null;
      $manifest->paid = 0;
      $manifest->tgl_paid  = null;
      if ($manifest->term == 'FOB') {
        $manifest->gen_memo = 0;
        $manifest->tgl_mem  = null;      
      }
      $manifest->inv_soa    = 0;
      $manifest->inv_wh    = 0;

      $manifest->save();

      DB::table('invwh_header')->where('kd_inv', $kd_inv)->where('kd_vsl',$vsl)->delete();
      DB::table('invwh_detail')->where('kd_inv', $kd_inv)->where('kd_vsl',$vsl)->delete();

      //dd("unpostign sukses");


      if ($manifest->term == 'FOB' ) {

          //CREATE LOG FILE
          $log_msg    = 'Unposting Invoice CR';
          $log_term   = $manifest->term;
          Helper::CreateLog($kd_inv,$log_term,$log_msg,$tgl);

          //CREATE LOG FILE
          $log_msg    = 'Unpaid Invoice CR';
          $log_term   = $manifest->term;
          Helper::CreateLog($kd_inv,$log_term,$log_msg,$tgl);

      } else {

          //CREATE LOG FILE
          $log_msg    = 'Unposting Invoice CR';
          $log_term   = $manifest->term;
          Helper::CreateLog($kd_inv,$log_term,$log_msg,$tgl);


      }

      //Alert::success('Invoice', ' Unposting Successfully...');
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

    public function FormPaid(Request $request,$vsl)
    {

      $manifest = Manifest::where('kd_inv',$request->kd_inv)->first();
      if (!$manifest) {
            return "error";
      }      
      $data['vsl'] = $request->vsl;
      $data['kd_inv'] = $request->kd_inv;
      $data['man'] = $manifest;

      return view('wh.invoice.formpaid',$data);

    }

    public function paid(Request $request,$vsl)
    {
        //d($request->all());        
        $manifest = Manifest::where('kd_inv',$request->kd_inv)->first();       
        $manifest->tgl_paid = $request->tgl_paid;
        $manifest->paid     = 1;
        $manifest->paid_at  = $request->paid_at;
        $manifest->save();   
 
        $details = [
          'kd_inv'    => $request->kd_inv,
          'vessel'    => $manifest->vessel,
          'cnee_name' => $manifest->cnee_name,
          'tanggal'   => $request->tgl_paid,
          'jumlah'    => $manifest->inv_wh,
        ];

        //dd($request->kd_inv);
        $email = env('MAIL_TO');        
        //Mail::to('zai@sinergisukseslogistik.com')->send(new Email($details));
        //Mail::to($email)->send(new Email($details,$request->kd_inv));

              
        //CREATE LOG FILE
        if ($request->paid_at == 1) {
          $paid_at = 'EDC';
        }
        if ($request->paid_at == 2) {
          $paid_at = 'Transfer';
        }
        $log_msg = 'Paid Invoice CR tanggal '. $request->tgl_paid . ' dengan '. $paid_at;
        $log_term = $manifest->term;
        Helper::CreateLog($request->kd_inv,$log_term,$log_msg,$tgl=null);



        //Alert::success('Invoice', ' Paid Successfully...');
        Mail::to($email)->send(new Email($details,$request->kd_inv));
        return redirect()->route('wh.manifest.index',[$manifest->kd_vsl]);

    }

    public function unpaid(Request $request,$vsl)
    {


        $manifest       = Manifest::where('kd_inv',$request->kd_inv)->where('kd_vsl',$vsl)->first();
        if (!$manifest) {
          dd("Error database");
        }
        $manifest->paid     = 0;
        $manifest->paid_at  = 0;
        $manifest->save();

        //DB::table('invwh_header')->where('kd_inv', $request->kd_inv)->where('kd_vsl',$vsl)->delete();
        //DB::table('invwh_detail')->where('kd_inv', $request->kd_inv)->where('kd_vsl',$vsl)->delete();

        //CREATE LOG FILE
        $log_msg = 'Unpaid Invoice CR';
        $log_term = $manifest->term;
        Helper::CreateLog($manifest->kd_inv,$log_term,$log_msg,$tgl=null);

        return redirect()->route('wh.manifest.index',[$vsl]); 

    }



}
