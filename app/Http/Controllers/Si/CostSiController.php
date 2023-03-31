<?php

namespace App\Http\Controllers\Si;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\InvSiHeader;
use App\Models\SiCostHeader;
use App\Models\SiCostDetail;
use App\Models\Shipping;
use App\Models\Customer;
use PDF;

class CostSiController extends Controller
{
    public function Create($si)
    {   
         $charge     = Charge::orderBy('kd_charge','ASC')->get();
         $header     = InvSiHeader::where('kd_si',$si)
                                ->first();  
         $costdtl      = SiCostDetail::where('kd_si',$si)
                                ->get();
         return view('si.cost.create',[
               'si'       =>  $si,
               'charge'   =>  $charge,
               'header'   =>  $header,
               'biaya'    =>  $costdtl,
            ]);
    }

    public function CostStore(Request $request,$si)
    {
        $this->validate($request,[
            'charge'        => 'required',
            'keterangan'    => 'required',
            'jumlah'        => 'required',
        ]);

        $ketChg     = Charge::where('kd_charge', $request->charge)->first(); 
        $jml        = str_replace(".","",$request->jumlah);
        $dtCost    = [
            'kd_si'         => $si,
            'kd_chg'        => $request->charge,
            'charge'        => $ketChg->charge,            
            'keterangan'    => $request->keterangan,
            'jumlah'        => $jml,
         ];
         SiCostDetail::create($dtCost);
         return redirect()->route('si.cost.create',[$si]);
   }

   public function CostEdit($id)
   {
         $det        = SiCostDetail::where('id',$id)->first(); 
         $charge     = Charge::orderBy('kd_charge','ASC')->get();
         return view('si.cost.edit',[
            'si'    => $det->kd_si,
            'det'   =>  $det,   
            'charge'    =>  $charge,
            'id'    =>  $id,
         ]); 
   }

    public function CostUpdate(Request $request,$id)
    {

        $dt         = SiCostDetail::where('id',$id)->first();
        $ketChg     = Charge::where('kd_charge', $request->charge)->first(); 
        $jml        = str_replace(".","",$request->jumlah);
        
        $dt->kd_chg      = $request->charge;
        $dt->charge      = $ketChg->charge;
        $dt->keterangan  = $request->keterangan;
        $dt->jumlah      = $jml;
        $dt->save();

         return redirect()->route('si.cost.create',$dt->kd_si);
    }



    public function destroy(Request $request,$id)
    {

        $item = SiCostDetail::where('id',$id)->first();
        if (!$item) {
            dd('error db');            
        }
        $si = $item->kd_si;        
        $item->delete();

        //dd($request->all());
        return redirect()->route('si.cost.create',[$si]);   

    }


    public function posting(Request $request)
    {

       dd($request->all());

    }


    public function preview(Request $request)
    {
         $si = $request->si;
         $header  =  Shipping::where('kd_si',$si)->first();
         $biaya = SiCostDetail::where('kd_si', $si)
                    ->get();
         $invHeader = InvSiHeader::where('kd_si',$si)
                     ->get();

         return view('si.cost.preview',[
                    'si'    =>  $si,
                    'hd'    =>  $header,
                    'biaya' =>  $biaya,                    
                    'selling' => $invHeader,
                ]);
    }

    public function exportpdf(Request $request)
    {
         $si = $request->si;
         $header  =  Shipping::where('kd_si',$si)->first();
         //dd($header);
         $biaya = SiCostDetail::where('kd_si', $si)
                    ->get();
         $invHeader = InvSiHeader::where('kd_si',$si)
                     ->get();

          $pdf     = PDF::loadView('si.cost.exportpdf',[
                    'si'    =>  $si,
                    'hd'    =>  $header,
                    'biaya' =>  $biaya,                    
                    'selling' => $invHeader,
                ]);
          return $pdf->stream('Cost.PDF');
 
    }

    public function soaIndex()
    {
      dd('soaIndex');
    }

}
