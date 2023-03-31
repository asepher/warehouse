<?php
function Rupiah($angka){
   $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
   return $hasil_rupiah;
}
function Usd($angka){
   $hasil_usd = "Usd " . number_format($angka,2,',','.');
   return $hasil_usd;
}
function TglIndo($tgl)
    {
        $tg     =  substr($tgl,-2);
        $bln    =  substr($tgl,5,2); 
        $th     =  substr($tgl,0,4); 
        return  $tg.'-'.$bln.'-'.$th;
    }

function FormatInvWh($inv)
    {
        // SLLI 2021 0324 01
        $dept   = substr($inv,0,4);  
        $tahun  = substr($inv,4,4);
        $bln    = substr($inv,8,4);
        $urut   = substr($inv,-2);

        return $dept.'/'.$tahun.'/'.$bln.'/'.$urut;

    }

function Terbilang($x){
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

function call(){
        return 'Hello';
    }

function JumPdHd($idpd){
         $jml = App\Models\Pddtl::where('kd_pd', $idpd)->sum('jumlah');
         $pdhd = App\Models\Pdhd::where('kd_pd', $idpd)->first();
         $dthd = [
            'jumlah'         =>  $jml,
        ];  
        $pdhd->update($dthd);
        return true;
    }


function GetIdpxyx($vsl,$eta){
    
     $vessel = App\Models\Vessel::where('kd_vsl', $vsl)->first();    

    // number idp
    $thn = date('Y',strtotime($vessel->eta));       
    $bln = date('m',strtotime($vessel->eta));       
    $getNom = DB::table('param')->where(['param1' => "IDP1",'tahun1' => $thn ])->first();
    $nom = (int) $getNom->param2;
    $idp = $thn.$bln.sprintf("%04s", $nom+1); //2022030002

    //update IDP
    DB::table('param')->where(['param1' => "IDP1",'tahuns' => $thn ])
        ->update(['param2' => substr($idp, 6, 4)]);

    return $idp;
   
}