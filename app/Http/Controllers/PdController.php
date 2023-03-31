<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pdhd;
use App\Models\Pddtl;
use App\Models\Charge;
use App\Models\Customer;
use App\Exports\PdhdExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

Use PDF;
Use Excel;
Use Alert;

class PdController extends Controller
{
    public function index()
    {
 
/*
         $username = Auth::user()->username;
         if (Auth::user()->user_type == 'Admin') {
            $pdhd    = Pdhd::where('is_posting',0)->orderBy('kd_pd','DESC')->get();   
            $posting = Pdhd::where('is_posting',1)->orderBy('kd_pd','DESC')->get(); 
         } else {
            $pdhd    = Pdhd::where('username',$username)->where('is_posting',0)->orderBy('kd_pd','DESC')->get();  
            $posting = Pdhd::where('username',$username)->where('is_posting',1)->orderBy('kd_pd','DESC')->get();  
         }

//       $pdhd = Pdhd::where('username',$username)->where('is_posting',0)->orderBy('kd_pd','DESC')->get();   
//       $posting = Pdhd::where('username',$username)->where('is_posting',1)->orderBy('kd_pd','DESC')->get();  
         return view('pd.index',[
                'pdhd'     => $pdhd,
                'posting'  => $posting,                
         ]);
*/

      $data['pdhd'] = Pdhd::where('is_posting',0)->orderBy('kd_pd','DESC')->get();
      return view('pd.index',$data);
         
    }

    public function exportToExcel()
    {
         return Excel::download(new PdhdExport, 'pd-export.xlsx');
    } 

   public function create()
    {
        $customer = Customer::all();
        return view('pd.create',[
                'customer' => $customer,
            ]);        
    }

   public function store(Request $request)
   {
        $this->validate($request,[
                'tanggal'       =>  'required',
                'dept'          =>  'required',
                'customer'      =>  'required',
                'penerima'      =>  'required',
                'keterangan'    =>  'required',
            ]);

        //dd($request->all());
        $thn = date('Y');
        $rec = DB::table('param')->where('param1',"PEDE")->first();
        $nom = (int) $rec->param2;
        $huruf = $rec->param3.substr($thn,2);
        $kd_pd = $huruf.sprintf("%04s", $nom+1);
        $nmcus = Customer::where('kd_cus',$request->customer)->first();
        $dthd = [
            'kd_pd'         =>  $kd_pd,
            'tanggal'       =>  $request->tanggal,
            'kd_cus'        =>  $request->customer,
            'customer'      =>  $nmcus->customer,
            'penerima'      =>  $request->penerima,
            'keterangan'    =>  $request->keterangan,
            'noted'         =>  $request->noted,
            'username'      =>  Auth::user()->username,
            'dept'          =>  $request->dept,
        ];        

        //dd($dthd);
        Pdhd::create($dthd);
        DB::table('param')->where('param1','PEDE')->update([
            'param2' => substr($kd_pd, 4, 4),
        ]);        

        //Alert::success('Sukses', 'PD berhasil di tambahkan', 'Type');
        return redirect('pd');
    }
    
    public function edit($pd)
    {

      $hd = Pdhd::where('kd_pd',$pd)->first();       
      $customer = Customer::all();
      return view('pd.edit',[
               'pd'  => $pd,
               'hd'  => $hd,
               'customer'  => $customer,
         ]);
    }

    public function update(Request $request,$pd)
    {
      //$pd = Pdhd::where('kd_pd',$pd)->first();
      $nmcus = Customer::where('kd_cus',$request->customer)->first();      
      $data =  [
            'tanggal'       =>  $request->tanggal,
            'kd_cus'        =>  $request->customer,
            'customer'      =>  $nmcus->customer,
            'penerima'      =>  $request->penerima,
            'keterangan'     =>  $request->keterangan,
            'noted'         =>  $request->noted, 
            ];
            //dd($data);
        Pdhd::where('kd_pd', $pd)->update($data);
        
        //Alert::success('Sukses', 'PD berhasil di Update');
        return redirect()->route('pd.index');
    }

    public function detail($kd_pd)
    {

        $pdhd    = Pdhd::where('kd_pd',$kd_pd)->first();
        $charge  = Charge::where('dep','PD01')->OrderBy('kd_charge','ASC')->get();   
        $pddtl   = Pddtl::where('kd_pd',$kd_pd)->get();
  

        return view('pd.detail',[
                'kd_pd'    => $kd_pd,
                'pdhd'  => $pdhd,
                'charge'   => $charge,
                'detail'   => $pddtl,
                'title' => 'PD'
            ]);

    }

    public function StoreDetail(Request $request)
    {

     // dd($request->all());
        $this->validate($request,[           
            'charge'        =>  'required',
            'keterangan'    =>  'required',
            'jumlah'        =>  'required',
        ]);
        
        //dd($request->all());
        $kd = Charge::where('kd_charge',$request->charge)->first();
        $dtdtl = [
            'kd_pd'         => $request->id,
            //'tanggal'       => $request->tanggal,
            'ket_charge'    => $request->charge,
            'keterangan'    => $request->keterangan,
            'noted'         => $kd->noted,
            'operator'      => $kd->operator,
            'jumlah'        => str_replace(".","",$request->jumlah),
            ];                
        Pddtl::create($dtdtl);

        Helper::JumPdHd($request->id);

        //Update Data Header 
        //Task::find($id)->update([ 'list' => $request->list ]);        
        //return redirect('tasks');

        //Alert::success('Sukses', 'Detail berhasil di Tambahkan');
        return redirect()->route('pd.detail',[$request->id]);
    }

    public function EditDetail($pd,$id)
    {
      //dd($pd . ' - ' . $id);
      $item = Pddtl::where('id',$id)->first();      
      return view('pd.edit_detail',[
            'pd'     => $pd,
            'id'     => $id,
            'charge' => Charge::get(),
            'det' => $item,
         ]);
    }

    public function UpdateDetail(Request $request)
    {

         //dd($request->all());
         $kd = Charge::where('kd_charge',$request->charge)->first();
         Pddtl::where('id', $request->id)->update([
            'kd_pd'         => $request->pd,
            'ket_charge'    => $request->charge,
            'keterangan'    => $request->keterangan,
            'noted'         => $kd->noted,
            'jumlah'        => str_replace(".","",$request->jumlah),              
         ]);
         //Task::find($id)->update([ 'list' => $request->list ]);
         //
        Helper::JumPdHd($request->pd);

         //Alert::success('Sukses', 'Detail berhasil di update', 'Type');
         return redirect()->route('pd.detail',$request->pd);
    }

    public function Deletedetail(Request $request,$id)
    {

     
         $row = Pddtl::where('kd_pd',$request->kd_pd)
                     ->where('id',$id)
                     ->first();  
         if (!$row) {
            dd('Error Data');
         }       
         $row->delete();

        Helper::JumPdHd($request->kd_pd);

         return redirect()->route('pd.detail',$request->kd_pd);
    }

    public function PrintPdf(Request $request)
    {
            $pd = $request->pd;
            $pdhd = Pdhd::where('kd_pd',$pd)->first();
            $pddtl = Pddtl::where('kd_pd',$pd)->get();
    
            // (Optional) Setup the paper size and orientation            
            $file = $pd.".PDF";
            $pdf = PDF::loadview('pd.pd_pdf',[
                     'pddtl'  => $pddtl,
                     'pd' => $pdhd
                  ]);
            $pdf->setPaper('A4', 'portrait');
            //$pdf->setPaper('A5', 'Landscape');
       
            return $pdf->stream();
/*
             $pdf    = PDF::loadView('wh.invoice.mempdf',[
                      'inv'        =>  $inv,
                      'manifest'  =>  $manifest,
                      'tgl'       =>  $tgl,
                      ])->save('wh/'.$file,true);
*/
    }

    public function Posting(Request $request)
    {



        Pdhd::where('kd_pd', $request->pd)->update([ 'is_posting'   => 1]);

/*
         //PRINT PDF
         $pd      = $request->pd;
         $pdhd    = Pdhd::where('kd_pd',$pd)->first();
         $pddtl   = Pddtl::where('kd_pd',$pd)->get();                    

         // (Optional) Setup the paper size and orientation            
         $file    = $pd.".PDF";
         $pdf     = PDF::loadview('pd.export',[
                     'pddtl'  => $pddtl,
                     'pd'     => $pdhd,
                  ])->setPaper('A4', 'portrait')->save('pede/'.$file,true);

         //return $pdf->download('export.pdf');
         //$pdf->setPaper('A4', 'portrait');
         //$pdf->setPaper('A5', 'Landscape');
         //return $pdf->stream();
*/
         //Alert::success('Sukses', 'PD berhasil di posting', 'Type');
         return redirect()->route('pd.index');
         //dd($request->pd);
    }


    public function Pdpdf($kd)
    {
        $kode = Pdhd::where('kd_pd',$kd)->first();        
        if (!$kode){
            dd('error data');
        }
        $file = $kode->kd_pd.".PDF";
        return view('/pede/'.$file);
    }


    public function SavePdf(Request $request)
    {


         $pd = $request->pd;
         $pdhd = Pdhd::where('kd_pd',$pd)->first();
         $pddtl = Pddtl::where('kd_pd',$pd)->get();                    

         // (Optional) Setup the paper size and orientation            
         $file = $pd.".PDF";
         $pdf = PDF::loadview('pd.export',[
                  'pddtl'  => $pddtl,
                  'pd' => $pdhd
               ])->save('pede/'.$file,true);
           //return $pdf->download('export.pdf');
         $pdf->setPaper('A4', 'portrait');
           //$pdf->setPaper('A5', 'Landscape');
         return $pdf->stream();

    }

    public function PdQuery()
    {

      $data['pdhd'] = Pdhd::where('is_posting',1)->get();
      return view('pd.pd_query',$data);

    }

    public function QueryDetail($kd_pd)
    {

        $pdhd    = Pdhd::where('kd_pd',$kd_pd)->first();
        $charge  = Charge::OrderBy('kd_charge','ASC')->get();   
        $pddtl   = Pddtl::where('kd_pd',$kd_pd)->get();
  
        return view('pd.query_detail',[
                'kd_pd'    => $kd_pd,
                'pdhd'  => $pdhd,
                'charge'   => $charge,
                'detail'   => $pddtl,
                'title' => 'PD'
            ]);
        
    }

    
}
