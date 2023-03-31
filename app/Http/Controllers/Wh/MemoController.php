<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manifest;
use App\Models\Tarif; 

use App\Helpers\Helper;
use PDF;


class MemoController extends Controller
{
 
    public function MemoView($inv)
    {

      $manifest = Manifest::where('kd_inv',$inv)->first(); 
      $vsl =   $manifest->kd_vsl;
      $tarif = Tarif::where('term',$manifest->term)->get();
      return view('wh.memo.view_memo',[
                        'manifest'  =>  $manifest,
                        'nominv'    =>  $inv,                        
                        'tarif'     =>  $tarif,
                        'vsl'   =>  $vsl,
                ]);
    }

 

    public function MemoGen(Request $request,$inv)
    {

         $tgl = $request->tanggal;       
         $tipe = 'ME';
         $manifest = Manifest::where('kd_inv',$inv)->first();  
         if (!$manifest) {
            return "error code";
         }
         $file = $inv.$tipe.'.PDF';
         $cekDt = Helper::HitInvHd($inv,$tipe);
         
         if ($cekDt >= 0) {          
              Helper::AddInvHeader($inv,$tipe,$tgl);

              $pdf    = PDF::loadView('wh.invoice.mempdf',[
                      'inv'        =>  $inv,
                      'manifest'  =>  $manifest,
                      'tgl'       =>  $tgl,
                      ])->save('wh/'.$file,true);
              //return $pdf->stream('memo.pdf');         
             
         }
   
        $manifest->file_mem = 'ME';
        $manifest->gen_memo = 1;
        $manifest->tgl_mem = $tgl ;
        $manifest->save();

        //flash message

        //CREATE LOG FILE
        $log_msg = 'Generate Memo';
        $log_term = $manifest->term;
        $tgl = now();
        Helper::CreateLog($inv,$log_term,$log_msg,$tgl);     

        return redirect()->route('wh.manifest.index',[$manifest->kd_vsl]);  

    }


    // unposting memo
    public function MemoUnPosting(Request $request,$vsl)
    {

        $manifest = Manifest::where('kd_inv',$request->invoice)->first();         
        $manifest->gen_memo = 0;
        $manifest->tgl_mem = null ;
        $manifest->update();

       // dd("Sukses Update");


        //CREATE LOG FILE
        $log_msg = 'Unposting Memo';
        $log_term = $manifest->term;
        Helper::CreateLog($manifest->kd_inv,$log_term,$log_msg);     

        return redirect()->route('wh.manifest.index',$vsl);
    }

    public function MemoViewFob($inv)
    {

      $manifest = Manifest::where('kd_inv',$inv)->first(); 
      $vsl =   $manifest->kd_vsl;
      $tarif = Tarif::where('term',$manifest->term)->get();
      return view('wh.memo.view_memofob',[
                        'manifest'  =>  $manifest,
                        'nominv'    =>  $inv,                        
                        'tarif'     =>  $tarif,
                        'vsl'   =>  $vsl,
                ]);
    }



    public function MemoFobGen(Request $request,$inv)
    {

         $tgl = $request->tanggal;       
         $tipe = 'ME';
         $manifest = Manifest::where('kd_inv',$inv)->first();  
         if (!$manifest) {
            return "error code";
         }
         $file = $inv.$tipe.'.PDF';
         $cekDt = Helper::HitInvHd($inv,$tipe); // cek : IwhHeader
         
         //dd('IwhHeader' . $cekDt );
         
         if ($cekDt >= 0) {          
              Helper::AddInvHeader($inv,$tipe,$tgl);

              $pdf    = PDF::loadView('wh.invoice.mempdf',[
                      'inv'        =>  $inv,
                      'manifest'  =>  $manifest,
                      'tgl'       =>  $tgl,
                      ])->save('wh/'.$file,true);
              //return $pdf->stream('memo.pdf');         

              $pdf    = PDF::loadView('wh.invoice.crpdf',[
                'tipe'      => $tipe,
                'inv'       => $inv,
                'vessel'    => $vessel,
                'nmfile'    => $nmfile,
                'header'    => $header,
                'manifest'    => $manifest,
                'dtls'       =>  $invDet,
               ])->save('wh/'.$nmfile.'.PDF',true);


             
         }

         $manifest->file_inv = 'CR';
         $manifest->gen_inv = 1;
         $manifest->paid = 1;
         $manifest->paid_at = 3; //3 at VARUNA
         if (empty($manifest->tgl_inv)) {
            $manifest->tgl_inv  = $tgl;         
         }
         if (empty($manifest->tgl_paid)) {
            $manifest->tgl_paid = $tgl; 
         }   

         $manifest->file_mem = 'ME';
         $manifest->gen_memo = 1;

        $manifest->tgl_mem = $tgl ;
        $manifest->save();

         //flash message

         return redirect()->route('wh.manifest.index',[$manifest->kd_vsl]);  
    }    

}
