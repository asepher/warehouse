<?php

namespace App\Http\Controllers\Si;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\InvSiHeader;
use App\Models\InvSiDetail;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\SiInvoice;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
 
//Use Alert;
use PDF;
use HelperSi;

class InvSiController extends Controller
{
    public function createInv($jenis,$si)
    {
        $charge     = Charge::where('dep','SI01')->orderBy('kd_charge','ASC')->get();
        $header     = InvSiHeader::where('kd_si',$si)
                                ->where('jenis',$jenis)
                                ->first();        
        $detail     = InvSiDetail::where('kd_si',$si)
                                ->where('jenis',$jenis)
                                ->get();        
        return view('si.inv.create_inv',[
                        'si'        =>  $si,
                        'jenis'      =>  $jenis,
                        'charge'    =>  $charge,
                        'header'    =>  $header,
                        'detail'    =>  $detail,                        
                ]);

    } 
 
    public function storeInv(Request $request,$jenis,$si)
    {

        $this->validate($request,[
            'charge'        => 'required',
            'keterangan'    => 'required',
            'jumlah'        => 'required',
        ]);
       

        $chkinv = InvSiHeader::where('kd_si', $si)
                        ->where('jenis', $jenis) 
                        ->count();
        $shipping = Shipping::where('kd_si',$si)->first();

        if ($chkinv == 0) {

           
            $nmrInv = HelperSi::GetNomInv($si);

            //$kodein = $huruf . " " . $KdInv ;
            //return $kodein;           
            $kd_inv = HelperSi::GetInvSi($si,$jenis);
           
            //dd($kd_inv);
            InvSiHeader::create([                     
                    'no_inv'        => $nmrInv,
//                    'tp'            => $tp,
                    'kd_inv'        => $kd_inv,
                    'kd_si'         => $si,
                    'jenis'         => $jenis,  
                    'kd_cus'        => $shipping->kd_cus,
                    'cus_name'      => $shipping ->cus_name,
                    'tgl_create'    => date('Y-m-d'),
                    //'tanggal'       => date_format(now(),strtotime('Y/m/d')),   
                    'username'      =>  Auth::user()->username,               
                ]);

            //DB::table('param')->where('param1','IN20')->update([
            //        'param2' => substr($KdInv, 0, 3), 
            //    ]);

            $nominv = $nmrInv;

        } else {

            $rowinv = InvSiHeader::where('kd_si', $si)
                        ->where('jenis', $jenis) 
                        ->first();
            $nominv = $rowinv->no_inv;
        }

        $jml        = str_replace(".","",$request->jumlah);
        $ketChg     = Charge::where('kd_charge', $request->charge)->first();        
        //return $jml;

        $vat        = ($ketChg->ppn * $jml)/100;
        //$vat        =   0 * 1000000/100;
        //return $vat;
        $materai    =  0;

        $subtotal   = $vat +  $jml;

        
        $dtSiDet    = [
                'no_inv'        => $nominv,
//                'tp'            => $tp,
                'kd_si'         => $si,
                'jenis'         => $jenis,
                'kd_chg'        => $request->charge,
                'charge'        => $ketChg->charge,
                'keterangan'    => $request->keterangan,
                'ppn'           => $ketChg->ppn,
                'jumlah'        => $jml,
                'vat'           => $vat,
                'subtotal'      => $subtotal,
            ];
            //dd($dtSiDet);
        InvSiDetail::create($dtSiDet);


        //dd($vat);
        //DB::update("update invsi_header set is_posting = "  " where kd_si = ? and tipe = ? ", [$id,$tipe]);

        $cari = InvSiHeader::where('kd_si', $si)
                        ->where('jenis', $jenis) 
                        ->first();
        if ($cari) {

                $hd_jum = InvSiDetail::where('kd_si',$si)->where('jenis',$jenis)->sum('jumlah');
                $hd_vat = InvSiDetail::where('kd_si',$si)->where('jenis',$jenis)->sum('vat');

                $hit_mat = $hd_jum+$hd_vat;
                 if ($hit_mat >= 5000000) {
                    $materai    =  10000;
                 }

                $grandtot = $hd_jum+$hd_vat+$materai;

                $cari->tgl_create   = date('Y-m-d');
                $cari->jumlah       = $hd_jum;
                $cari->vat          = $hd_vat;
                $cari->materai      = $materai;
                $cari->grandtotal   =  $grandtot;
                $cari->save();
            }    

         //Alert::success('Sukses', 'Data Berhasil di tambahkan');
         return redirect()->route('si.inv.create',[$jenis,$si]);
    }

    public function edit($si,$id)
    {        
        $dtl = InvSiDetail::where('kd_si', $si)
                        ->where('id', $id) 
                        ->first();
                    
        $charge     = Charge::orderBy('kd_charge','ASC')->get();
        return view('si.inv.edit',[
            'si'      =>  $si,
            'id'      =>  $id,            
            'charge'  =>  $charge,
            'dtl'     =>  $dtl,
        ]);
    }

    public function update(Request $request, $si, $id)
    {
         $item = InvSiDetail::where('id',$id)->first();
         $jenis = $item->jenis;
         $data = [
            'charge'       => $request->charge,
            'keterangan'   => $request->keterangan,
            'jumlah'       => $request->jumlah,            
         ];
         //dd($data);         
         $item->update($data);

         //Alert::success('Sukses', 'Data Berhasil di Update');
         return redirect()->route('si.inv.create',[$jenis,$si]);
    }


    public function viewpdf(Request $request)
    {

         $jenis = $request->jenis;
         $si   = $request->si;
         $invHd = InvSiHeader::where('kd_si',$si)
                        ->where('jenis',$jenis)
                        ->first();  
        if (!$invHd) {
          dd('error database');
        }
       
        $invDt = InvSiDetail::where('kd_si',$si)
                        ->where('jenis',$jenis)
                        ->get();
                    
         $si      = Shipping::where('kd_si',$si)->first();         
         $cus     = Customer::where('kd_cus',$si->kd_cus)->first(); 
         
        $noted    = InvSiDetail::where('kd_chg',9999)->where('jenis',$jenis)->get();
        return view('si.inv.viewpdf',[
                'si'        =>  $si,
               'jenis'      =>  $jenis,
               'detail'    =>  $invDt,
               'hd'        =>  $invHd,
               'cus'       =>  $cus,
               'noted'      => $noted,
        ]);


    }
 

    public function printpdf(Request $request)
    {

        $jenis    = $request->jenis;
        $kd_si    = $request->kd_si;
        //dd($request->all());

        $invHd    = InvSiHeader::where('kd_si',$kd_si)
                        ->where('jenis',$jenis)
                        ->first();  

        $invDt    = InvSiDetail::where('kd_si',$kd_si)
                        ->where('jenis',$jenis)
                        ->get(); 

        $siref    = Shipping::where('kd_si',$kd_si)->first();
         //dd($siref);

        $cus      = Customer::where('kd_cus',$siref->kd_cus)->first();

        $noted    = InvSiDetail::where('kd_chg',9999)->where('jenis',$jenis)->get();
        $file     = $invHd->no_inv.$jenis.".PDF";   
            
        $pdf     = PDF::loadView('si.inv.printpdf',[
               'si'        =>  $siref,
               'jenis'     =>  $jenis,
               'detail'    =>  $invDt,
               'hd'        =>  $invHd,
               'cus'       =>  $cus,
               'noted'     => $noted,
               'auth_name'      => Auth::user()->username,
         ]);
        return $pdf->stream();          
 
/*               
        $pdf     = PDF::loadView('si.inv.printpdf',[
               'si'        =>  $siref,
               'tipe'      =>  $tipe,
               'detail'    =>  $invDt,
               'hd'        =>  $invHd,
               'cus'       =>  $cus,
               'noted'      => $noted,
         ])->save('siinv/'.$file,true);

         //return $pdf->stream(); 
         //->save('siinv/'.$file,true);
         //return $pdf->stream('INVOICE.PDF');
         //return $pdf->download('invoice.pdf');
         //return $pdf->download($file.'.PDF');  
         return redirect()->route('si.view.detail',[$invHd->kd_si]);
*/         

    }


    public function testpdf($kd_si)
    {

        $shipping = Shipping::where('kd_si',$kd_si)->first();
        $cus     = Customer::where('kd_cus',$shipping->kd_cus)->first(); 
        $invsi_detail = InvSiDetail::where('kd_si',$kd_si)->get();         

        $pdf     = PDF::loadView('si.inv.testpdf',[
              'kd_si'     =>  $kd_si,
              'cus'       =>  $cus,
              'shipping'  =>  $shipping,
              'details'   =>  $invsi_detail,
         ]);
      return $pdf->stream();

    }


    public function editInv($kd_si,$id)
    {

      $data['id']     = $id;
      $data['kd_si']  = $kd_si;
      $data['item']   = InvSiDetail::where('id',$id)->first();
      $data['charge'] = Charge::where('dep','SI01')->orderBy('kd_charge','ASC')->get();

      //dd($item);
      return view('si.inv.edit_detail',$data);      

    }

    public function updateInv(Request $request,$kd_si,$id)
    {

      $item = InvSiDetail::where('id',$id)->first();
      $jenis = $item->jenis;
      $data = [
            'charge'       => $request->charge,
            'keterangan'   => $request->keterangan,
            'jumlah'       => $request->jumlah,            
      ];
      $item->update($data);


      //UPDATE HEADER
        $cari = InvSiHeader::where('kd_si', $kd_si)
                        ->where('jenis', $jenis) 
                        ->first();
        if ($cari) {

                $hd_jum = InvSiDetail::where('kd_si',$kd_si)->where('jenis',$jenis)->sum('jumlah');
                $hd_vat = InvSiDetail::where('kd_si',$kd_si)->where('jenis',$jenis)->sum('vat');

                $hit_mat = $hd_jum+$hd_vat;

                if ($hit_mat >= 5000000) {
                    $materai    =  10000;
                 } else {
                    $materai    =  0;
                 }

                $grandtot = $hd_jum+$hd_vat+$materai;

                //$cari->tanggal      = date('Y-m-d');
                $cari->jumlah       = $hd_jum;
                $cari->vat          = $hd_vat;
                $cari->materai      = $materai;
                $cari->grandtotal   = $grandtot;
                $cari->save();
            }    

      
      return redirect()->route('si.inv.create',[$jenis,$kd_si]);      

    }


    public function destroy(Request $request,$id)
    {      


       


    }

    public function preview(Request $request)
    {
         $si   = $request->si;
         $tipe = $request->tipe;
         $hd   = InvSiHeader::where('kd_si',$si)
                           ->where('tipe',$tipe)
                           ->first();
         $detail = InvSiDetail::where('kd_si', $si)
                    ->where('tipe', $tipe)  
                    ->get();

        return view('si.inv.preview',[
                'si'        =>  $si,
                'tipe'      =>  $tipe,
                'detail'    =>  $detail,
                'hd'        =>  $hd,                
        ]);

    }

    public function posting($jenis,$kd_si)
    {

        $item = InvSiHeader::where('kd_si',$kd_si)
                           ->where('jenis',$jenis)
                           ->first();

         if (!$item) {
            dd('data error');
         }
         $data = [
            'is_posting'       => 1,
         ];
         
         $item->update($data);

         $shipping = Shipping::where('kd_si',$kd_si)->first();        
         $shipping->update($data);


         $invsi = new SiInvoice;
         $invsi->kd_si      = $kd_si;
          $invsi->kd_inv    = $item->kd_inv;
          $invsi->kd_cus    = $shipping->kd_cus;
          $invsi->cus_name  = $shipping->cus_name;
          $invsi->no_job    = substr($kd_si,0,3);
          $invsi->no_aju    = $shipping->no_aju;
          $invsi->vessel    = $shipping->vessel;
          $invsi->no_bl     = $shipping->bl;
          $invsi->awb       = $shipping->awb;
          $invsi->flight    = $shipping->flight;
          $invsi->debet     = 0;
          $invsi->save();

         Alert::success('Sukses', 'Posting berhasil');

         return redirect()->route('si.view.detail',[$kd_si]);
        
    } 
 
    public function InvSiAll()
    {

        //DB::table('table_name')->distinct()->get(['column_name']);
        $data['allData']    = InvSiHeader::all();
        $data['customer']   = Customer::where('si',1)->get(); 

        return view('si.inv.view_all',$data);

    }

    public function InvSiSeach(Request $request)
    {

        $data['allData']    = InvSiHeader::where('kd_cus',$request->kd_cus)->get();
        $data['customers']   = Customer::where('si',1)->get(); 
        return view('si.inv.view_all',$data);
    }

    public function invCost($si)
    {
        return view('si.cost.create');
    }

    public function deleDetail($id)
    {

        $item = InvSiDetail::where('id',$id)->first();
        if (!$item) {
            dd('error db');            
        }
        $jenis = $item->jenis;
        $si = $item->kd_si;        
        $item->delete();
        

        //HITUNG ULANG TBL HEADER
            //$cari = InvSiHeader::where('kd_si', $si)->where('tipe', $tipe)->first();
            $materai = 0;
            $hd_jum = InvSiDetail::where('kd_si',$si)->where('jenis',$jenis)->sum('jumlah');
            $hd_vat = InvSiDetail::where('kd_si',$si)->where('jenis',$jenis)->sum('vat');
            $hit_mat = $hd_jum+$hd_vat;
                 if ($hit_mat >= 5000000) {
                    $materai    =  10000;
                 }        
            $data =  [                
                'jumlah'       => $hd_jum,
                'vat'          => $hd_vat,
                'materai'      => $materai,
                'grandtotal'   =>  $hit_mat,
                ];
            InvSiHeader::where('kd_si', $si)->where('jenis', $jenis)->update($data);

        //Alert::success('Sukses', 'Data Berhasil di hapus');
        return redirect()->route('si.inv.create',[$jenis,$si]);   

      
    }

}
