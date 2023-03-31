<?php
namespace App\Helpers;


use App\Models\Shipping;
use App\Models\Sijob;
use Illuminate\Support\Facades\DB;

class HelperSi {

	public static function Materai()
    {
        return 10000;
    }
    public static function PPn()
    {
        return 0.11;
    }

    public static function GetNomInv($kd_si)
    {

        //$getNom = DB::table('param')->where('param1',"IN20")->first();
         //$nom = (int) $getNom->param2;
         //$huruf = $getNom->param3;            

          //Manifest

         $tipe    = Sijob::where('kd_si',$kd_si)->first()->tipe;
         $shipping = Shipping::where('kd_si',$kd_si)->first();
         $thn = date('y',strtotime($shipping->eta));
            

          // Format Inv
          $nmrInv = substr($kd_si,0,3). $tipe . substr($thn,-2);

          return $nmrInv;
    }

    public static function  GetInvSi($si,$tp)
    {

        $tipe    = Sijob::where('kd_si',$si)->first()->tipe;   
        if ($tp == 'CN') {
            $tp = 'A ';
        } else {
            $tp = ' ';
        }
        $kd_inv = substr($si,0,3).$tp.$tipe.substr($si,-2);
               
        return $kd_inv;

    }

    public static function  FormatInvSi($inv,$jenis)
    {

        if ($jenis == 'CN') {
            $nom = substr($inv,0,3);             
            $tp = 'A ';
            $tipe = substr($inv,0,3);
            $th = substr($inv,-2);
            $kd_inv = 'INVOICE '.$nom.$tp.$tipe.$th;
        } else {
            $nom = substr($inv,0,3);             
            $tp = '  ';
            $tipe = substr($inv,0,3);
            $th = substr($inv,-2);           
            $kd_inv = 'INVOICE '.$nom.$tp.$tipe.$th;
        }           
        return $kd_inv;

    }



}


