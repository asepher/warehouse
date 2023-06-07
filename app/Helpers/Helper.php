<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\IwhHeader;
use App\Models\IwhDetail;
use App\Models\InvWhMaster;
use App\Models\InvDnHeader;
use App\Models\InvDnDetail;
use App\Models\Vessel;
use App\Models\Manifest;
use App\Models\Tarif;
use App\Models\Pddtl;
use App\Models\Pdhd;
use App\Models\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\dtLog;

  
class Helper {

	public static function Materai()
    {
        return 10000;
    }
    public static function PPn()
    {
        return 0.11;
    }

    public static function jumlahUser()
    {
        return User::whereNotNull('email_verified_at')->count();
    }

   public static function JumInvHeader($term,$vsl,$cont)
    {

    	$HitHeader = IwhHeader::where('term',$term)->where('kd_vsl',$vsl)
                        ->where('container',$cont)->count();
      return $HitHeader;
    }

   public static function XXXGenDnPdf1()
   {

		$pdf  = PDF::loadView('wh.invoice.dnpdf',[
                             'id'        =>  $id,
                             'tanggal'   =>  $request->tanggal,
                             'vessel'     => $vessel,
                             'tarif'      => $tarif,
                             'container'  => $request->container,               
                         ]);
             $nmfile = $kd_inv ;
             
             //return $pdf->stream('hello.pdf'); 
             $pdf->save('pdf/'. $nmfile . '.PDF',true);
     	return true;
   }


   public static function GenKodeInv($vsl)
   {
    //dd($vsl);
   	$vessel  = Vessel::where('kd_vsl',$vsl)->first();
    //dd($vessel);
   	$num 		= $vessel->last_num;
      $kd_inv 	= "SSLI".$vessel->inv3.sprintf("%02s", $num);

      $vessel->last_num = $num+1;
      $vessel->save(); 

      return $kd_inv;

   }

   public static function GenKodeInvDn($vsl)
   {

      $vessel       = Vessel::where('kd_vsl',$vsl)->first();
      $num          = $vessel->last_dn;
      $kd_inv       = "SSLI".$vessel->inv3.sprintf("%02s", $num);

        $vessel->last_dn = $num+1;
        $vessel->save(); 

      return $kd_inv;

   }

   public function GetKodeCust()
   {

        $rec = DB::table('param')->where('param1',"CUST")->first();        
        $nom = (int) $rec->param2;
        $huruf = $rec->param3;
        $kd_cus = $huruf . sprintf("%04s", $nom);

        DB::table('param')->where('param1',"CUST")
                    ->update(['param2' => $nom+1 ]);

        return $kd_cus;
                  

   }


   public static function JumItemDn($cont,$field)
   {
      $jumItem  = Manifest::where('term', 'FOB')->where('container', $cont)->sum($field); 
      return $jumItem;
   }


   public static function JumMeasure()
   {

     	$weight     = DB::table('manifest')->where('term', 'FOB')
                       ->where('container', $cont)->sum('weight'); 
      $measure    = DB::table('manifest')->where('term', 'FOB')
                       ->where('container', $cont)->sum('measure'); 
      $min        = DB::table('manifest')->where('term', 'FOB')
                       ->where('container', $cont)->sum('measure'); 
      $vol_actual  = DB::table('manifest')->where('term', 'FOB')
                       ->where('container', $cont)->sum('measure');
   }



   public static function GetIdp($vsl,$eta)
   {

	   $vessel = Vessel::where('kd_vsl', $vsl)->first();    

	   // number idp
	   $thn = date('Y',strtotime($vessel->eta));       
	   $bln = date('m',strtotime($vessel->eta));       
	   $getNom = DB::table('param')->where(['param1' => "IDP1",'tahun' => $thn ])->first();
	   $nom = (int) $getNom->param2;

	   $idp = $thn.$bln.sprintf("%04s", $nom+1);

	   //update IDP
	   DB::table('param')->where(['param1' => "IDP1",'tahun' => $thn ])->update([
	        'param2' => substr($idp, 6, 4),
	   ]);

	    return $idp;
   }


   public static function JumManifesByCont($term,$container)
   {
		$manifest 	= Manifest::where('term',$term)
							->where('container', $container)->count();
		return $manifest;
   }

   public static function SumManifesByCont($term,$container)
   {		
		$totAktual	= Manifest::where('term',$term)->where('container', $container)->sum('measure'); 
		return $totAktual;	
	}

   public static function CountWeightByCont($term,$container,$vsl)
   {
		$weightm 	= DB::table('invwh_detail')->where('term', 'FOB')
								->where('kd_vsl', $vsl)
								->where('container', $container)
								->count();
		return $weightm;	
	}

   public static function AddInvHeader($inv,$tipe,$tgl){
        
        $manifest = Manifest::where('kd_inv',$inv)->first(); 
        if ($tipe == 'CR') {
            $cr = 1;$me =0;
        }
        if ($tipe == 'ME') {
            $cr = 0;$me =1;
        } 

        //Save ke inv_Header    
        $dtheader = [
             'idp'       =>  $manifest->idp,
             'kd_inv'    =>  $manifest->kd_inv,
             'tipe'      =>  $tipe,                
             'kd_vsl'    =>  $manifest->kd_vsl,
             'term'      =>  $manifest->term,
             'container' =>  $manifest->container,
             'jumlah'    =>  0,
             'tgl_gen'   =>  $tgl,  
             'inv_cr'    =>  $cr,
             'inv_memo'  =>  $me,  
             ];
        //dd($dtheader);
        IwhHeader::create($dtheader);
 
        //simpan  ke inv_detail           
        //$tarif = Tarif::where('term',$manifest->term)->where('tipe',$tipe)->get();

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



            //dd($tarif);
           foreach ($tarif as $tr) { 
                if ($manifest->term == 'FOB') { 
                        $min = number_format($manifest->min_actual,0);
                            }
                if ($manifest->term == 'CNF') { 
                        //$weight = $man->min;
                        $min = number_format($manifest->min,0);
                     }
                if ($tr->is_adm == 1 )  { 
                    $min = 1; 
                } 
/*
                if ($tr->is_adm == 0) {
                    //$min = round($manifest->min_actual);
                    $min = ceil($manifest->min_actual);
                } else {                  
                    $min = 1;                   
                }
*/

              $jumlah = $min * $tr->charge;
              $dtDtl = [
                  'idp'       => $manifest->idp, 
                  'kd_inv'    => $manifest->kd_inv, 
                  'tipe'      => $tipe, 
                  'term'      => $manifest->term, 
                  'kd_vsl'    => $manifest->kd_vsl,
                  'kd_tarif'    => $tr->kd_tarif, 
                  'nama_tarif'  => $tr->nama_tarif, 
                  'tarif'       => $tr->charge, 
                  'weight'      => $manifest->weight, 
                  'measure'     => $manifest->measure, 
                  'vol_actual'  => $manifest->min_actual, 
                  'wm'          => $min,
                  'jumlah'      => $jumlah,
                  'ppn'         => $tr->ppn, 
                  'container'   => $manifest->container, 
              ];
              IwhDetail::create($dtDtl);
             }
             
           return true;
     }

     public static function HitInvHd($inv,$tipe)
     {
        $cekDt = IwhHeader::where('kd_inv',$inv)->where('tipe',$tipe)->count();
        return $cekDt; 
     }

    public static function generate_string($strength = 16) {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }
 
    public static function TglIndo($tgl)
    {
        $tg     =  substr($tgl,-2);
        $bln    =  substr($tgl,5,2); 
        $th     =  substr($tgl,0,4); 
        return  $tg.'-'.$bln.'-'.$th;
    }

    public static function TglBlnTh($tgl)
    {
        $tglind = date('d M Y', strtotime($tgl));
        return  $tglind;
    }



    public static function TglSimpan($tgl)
    {
        $tg     =  substr($tgl,0,2);
        $bln    =  substr($tgl,3,2); 
        $th     =  substr($tgl,6,4); 
        return  $th.'/'.$bln.'/'.$tg;
    }


//FORMAT INVOICE WH
public static function FormatInvWh($inv)
    {
        // SLLI2021032401 = 14
        // SSLI20230410021 = 15

        if ( strlen($inv) == 14 ) {

            $dept   = substr($inv,0,4);  
            $tahun  = substr($inv,4,4);
            $bln    = substr($inv,8,4);          
            $urut   = substr($inv,-2);
            return $dept.'/'.$tahun.'/'.$bln.'/' .$urut;
        } else {
            $dept   = substr($inv,0,4);  
            $tahun  = substr($inv,4,4);
            $bln    = substr($inv,8,2);
            $noves  = substr($inv,10,3);
            $urut   = substr($inv,-2);
            return $dept.'/'.$tahun.'/'.$bln.'/'. $noves .'/'.$urut;

        }


    }


public static function Rupiah($angka){
   $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
   return $hasil_rupiah;
}

public static function Angka($angka){
   $hasil_angka = number_format($angka,2,',','.');
   return $hasil_angka;
}



    public static function GetWeight($term, $container){
        $weight = DB::table('manifest')->where('term', $term)
                    ->where('container', $container)->sum('weight'); 
        return $weight;
    }   

    public static function GetMeasure($term, $container){
         $measure    = DB::table('manifest')->where('term', 'FOB')
                        ->where('container', $container)->sum('measure');  
        return $measure;
    }
    public static function GetMin($term, $container){
        $min        = DB::table('manifest')->where('term', 'FOB')
                                ->where('container', $container)->sum('min'); 
        return $min;
    }

    public static function deleteDN($vsl,$kd_inv)
    {

        //DB::table('invdn_master')->where('kd_vsl',$vsl)->delete();
        DB::table('invdn_header')->where('kd_vsl',$vsl)->where('kd_inv',$kd_inv)->delete();
        DB::table('invdn_detail')->where('kd_vsl',$vsl)->where('kd_inv',$kd_inv)->delete();

        return true;
    }



    public static function Terbilang($x){
        //$_this = new self;
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka[$x];
        } else if ($x <20) {
            $temp = Terbilang($x - 10). " belas";
        } else if ($x <100) {
            $temp = Terbilang($x/10)." puluh". Terbilang($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . Terbilang($x - 100);
        } else if ($x <1000) {
            $temp = Terbilang($x/100) . " ratus" . Terbilang($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . Terbilang($x - 1000);
        } else if ($x <1000000) {
            $temp = Terbilang($x/1000) . " ribu" . Terbilang($x % 1000);
        } else if ($x <1000000000) {
            $temp = Terbilang($x/1000000) . " juta" . Terbilang($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = Terbilang($x/1000000000) . " milyar" . Terbilang(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = Terbilang($x/1000000000000) . " trilyun" . Terbilang(fmod($x,1000000000000));
        }     
            return $temp;
    }

public static function JumPdHd($idpd){
/*
         $jml = Pddtl::where('kd_pd', $idpd)->sum('jumlah');         
         $dthd = [
            'jumlah'         =>  $jml,
        ];  
        $pdhd->update($dthd);
*/
        $pdhd = Pdhd::where('kd_pd', $idpd)->first();
        //update Header 
        $jum_plus = Pddtl::where('kd_pd',$idpd)->where('operator','plus')->sum('jumlah');
        $jum_minus = Pddtl::where('kd_pd',$idpd)->where('operator','minus')->sum('jumlah');
        $pdhd->jumlah  = $jum_plus - $jum_minus;
        $pdhd->save();   


        return true;
    }


     public static function AddInvDN($vsl)
     {

         //invoice master
         $kd_inv   = Helper::GenKodeInvDn($vsl);
         $invmaster  = [
         'kd_inv' => $kd_inv,
         'term'   => 'FOB',
         'tipe'   => 'DN',
         'kd_vsl'    => $vsl,
         'container' => $ctn->container,
         'tgl_gen'   => now(),
         ];
         InvWhMaster::create($invmaster);

            $manifest     = Manifest::where('kd_vsl',$vsl)->where('container',$ctn->container)
                                  ->where('term','FOB')->get(); 
            $tarif = Tarif::where('term','FOB')->get();
            //dd($manifest);
            foreach ($manifest as $man ) {
                $dtheader = [
                   'seq'         =>  $man->seq,                              
                   'kd_inv'      =>  $kd_inv,
                   'tipe'        =>  'DN',
                   'kd_vsl'      =>  $vsl,
                   'term'        =>  'FOB',
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
                            'wm'        => 0,
                            'jumlah'    => $vol_actual*$trf->jumlah,
                            'ppn'       => $trf->ppn, 
                            'container' => $ctn->container, 
                        ];
                        InvDnDetail::create($dtDtl);         
                      }

                }
         return true;
      
     } 

    public static function hitung_act()
     {


     }

     public static function GetMonth($bln)
     {


        if ($bln == 1) {
            $nmBln = 'Januari';
        } elseif ($bln == 2) {
            $nmBln = 'Pebruari';
        } elseif ($bln == 3) {
            $nmBln = 'Maret';
        } elseif ($bln == 4) {
            $nmBln = 'April';
        } elseif ($bln == 5) {
            $nmBln = 'Mei';
        } elseif ($bln == 6) {
            $nmBln = 'Juni';
        } elseif ($bln == 7) {
            $nmBln = 'Juli';
        } elseif ($bln == 8) {
            $nmBln = 'Agustus';
        } elseif ($bln == 9) {
            $nmBln = 'September';
        } elseif ($bln == 10) {
            $nmBln = 'Oktober';
        } elseif ($bln == 11) {
            $nmBln = 'November';
        } elseif ($bln == 12) {
            $nmBln = 'Desember';
        } 

        return $nmBln;

     }

     public static function CreateLog($inv,$term,$msg,$tgl)
     {

        //dd($inv);
        //CREATE LOG FILE
       $logdb = new dtLog;
       $logdb->inv = $inv;
       $logdb->term = $term;
       $logdb->description = $msg;
       //$logdb->tgl_inv = $tgl;
       $logdb->username = Auth::user()->username;
       $logdb->save();

       return true;

     }


}