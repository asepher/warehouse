<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\TempDataWh;
use App\Imports\TempWhImport;
use App\Imports\TempDataWhImport;
use App\Imports\UploadImport;
use App\Models\Manifest;
use App\Models\Vessel;
use App\Models\Customer;
use App\Models\IwhHeader;
use App\Helpers\Helper;
//use RealRashid\SweetAlert\Facades\Alert;
Use Alert;

use App\Mail\MailSuccess;
use Illuminate\Support\Facades\Mail;

class UploadController extends Controller
{


   public function uploadVessel($vsl)
   {

        //Alert::alert('Title', 'Message', 'Type');
        Alert::success('Success Title', 'Success Message');

        return view('wh.upload.vessel',[
            'vsl'   =>  $vsl,
         ]);    
   }

    public function import() 
    {
        Excel::import(new TempDataWhImport, 'temp.xlsx');        
        return redirect('/wh/vessel')->with('success', 'All good!');
    }



    public function uploadResults($vsl)
    {


         $tmpwhimp = TempDataWh::where('kd_vessel',$vsl)->get();         
         return view('wh.upload.results',[
               'vsl' => $vsl,
               'tmpwhimp' => $tmpwhimp,
         ]);

    }


    public function uploadDelete(Request $request, $id)
    {

         $item = TempDataWh::where('id',$id)->first();
         $item->delete();

         return redirect()->route('wh.manifest.upload.results');

    }


    public function addOneManifest(Request $request, $id)
    {

        $item   = TempDataWh::where('seq',$id)->first();
        $kapal  = $request->kd_vessel;
        $vsl    = $request->kd_vessel;
        //dd($item);
        $vessel = Vessel::where('kd_vsl', $kapal)->first(); 
        if (!$item || !$vessel) {
             dd('data error');
        }

        //nommor inv
        $getkd  = DB::table('param')->where('param1',"INV0")->first();
        $th     = date('Y',strtotime($item->eta));
        $nom    = (int) $vessel->last_num;
        $inv4   = sprintf("%02s", $nom+1);
        $kodeinv =  $getkd->param2.$vessel->inv3.$inv4;


         $rec = [
            'seq'           =>  $item->seq,            
            'idp'           =>  '000001',
            'kd_vsl'        =>  $item->kd_vessel,
            'kd_inv'        =>  $kodeinv,
            'term'          =>  $item->term,
            'bill_to'       =>  $item->bill_to,
            'consignee'     =>  'consignee',
            'kd_cnee'       =>  $item->kd_cnee,
            'cnee_name'     =>  $item->cnee_name,
            'cnee_address'     =>  $item->cnee_address,
            'cnee_npwp'     =>  $item->cnee_npwp,
            'forwader'      =>  'forwader',
            'forwader_name'      =>  $item->forwader_name,
            'forwader_address'      =>  $item->forwader_address,
            'forwader_npwp'      =>  $item->forwader_npwp,
            'kd_vessel'        =>  $item->kd_vessel,
            'vessel'        =>  $item->vessel,
            'pol'           =>  $item->pol,
            'container'     =>  $item->container,
            'seal'          =>  $item->seal,                    
            'eta'           =>  date('Y-m-d',strtotime($item->eta)),
            'hbl'           =>  $item->hbl,
            'vls_bl'        =>  $item->vls_bl,
            'qty'           =>  $item->qty,
            'sat_qty'       =>  $item->packing,
            'description'   =>  $item->description,
            'weight'        =>  intval($item->weight),
            'measure'       =>  intval($item->measure),
            'min_actual'    =>  intval($item->min_actual),
            'min'           =>  intval($item->min),            
            'username'      =>  $item->username,
        ];    
        //dd($rec);
         Manifest::create($rec);
         $item->delete();

        //update konter Invoice
        DB::table('vessel')->where('kd_vsl',$kapal)->update([
            'last_num' => $inv4,
        ]);
        

        //Alert::success('Sukses', 'Manifest berhasil di tambahkan');
        //return redirect()->route('wh.manifest.index',[$item->kd_vessel]);

        $tmpwhimp = TempDataWh::where('kd_vessel',$vsl)->get();         
        return  redirect()->route('wh.upload.results', [
               'vsl' => $vsl,
               'tmpwhimp' => $tmpwhimp,
        ]);


    }


    public function addAllManifest(Request $request)
    {

      $tmpwhimp = TempDataWh::where('kd_vessel',$request->vsl)->get();   
      $vessel = Vessel::where('kd_vsl', $request->vsl)->first();        
      $getkd  = DB::table('param')->where('param1',"INV0")->first();
      
      foreach ($tmpwhimp as $key => $item) {
         
              //nommor inv
              //$th           = date('Y',strtotime($item->eta));
              //$nom          = (int) $vessel->last_num;
              
              $inv4         = sprintf("%02s", $item->seq);
              $kodeinv      = $getkd->param2.$vessel->inv3.$inv4;              
              $cnee         =  Customer::where('npwp', $item->cnee_npwp)->first(); 
              if (!$cnee) {
                    //$kd_cnee = 'not found';

                    $kd_cnee = Helper::GetKodeCust();
                    //dd($kd_cus);
                    $datacus = [
                        'kd_cus'        => $kd_cnee,
                        'customer'      => $item->cnee_name,
                        'address'       => $item->cnee_address,
                        'npwp'          => $item->cnee_npwp,
                        'forwader'      => 1,
                        'consignee'     => 1,
                        'username'      => $item->username,
                    ];
                    Customer::create($datacus);
              } else {
                    $kd_cnee = $cnee->kd_cus;
              }

              $forwader     = Customer::where('npwp', $item->forwader_npwp)->first(); 
              if (!$forwader) {
                  $kd_forwader = 'not found';
              } else  {
                  $kd_forwader = $forwader->kd_cus;
              }
 
  
        //hitung minimum actual         
        $weight = intval($item->weight) / 1000;
        if ( $weight >= $item->measure)
        {
            $min_actual = $weight;
            $vol = $weight;
        } else {
            $min_actual = $item->measure;
            $vol = $item->measure;
        }

        //cari minimum 
        // ceil : rounds a number UP to the nearest integer
        // The round() function rounds a floating-point number.
        // ceil(0.60) = 1
        $min = ceil($min_actual);
        $cbm = ceil($vol);
        if ($min <= 2) {
            $min = 2;
            $cbm = 2;
        }        
        if ($min_actual <= 1) {
            $min_actual = 1;
            $vol = 1;
        }

        if ($item->term == 'FOB') {
            $inv_soa          = 0; // ($vol * 200000) + 50000;
            $kd_bill_to       = $kd_forwader;
            $bill_to_name     = $item->forwader_name;
            $bill_to_address  = $item->forwader_address;
            $bill_to_npwp     = $item->forwader_npwp;
        }
        if ($item->term == 'CNF') {
            $inv_soa          = 0; // $vol * 350000;            
            $kd_bill_to       = $kd_cnee;
            $bill_to_name     = $item->cnee_name;
            $bill_to_address  = $item->cnee_address;
            $bill_to_npwp     = $item->cnee_npwp;            
        }


               $rec = [
                  'seq'           =>  $item->seq,            
                  'idp'           =>  '2022000000',               
                  'kd_inv'        =>  $kodeinv,
                    //'kd_vsl'        =>  'kd_vessel',
                  'term'          =>  $item->term,
                  'kd_bill_to'    =>  $kd_bill_to,
                  'bill_to_name'  => $bill_to_name,
                  'bill_to_address' => $bill_to_address,
                  'bill_to_npwp'  => $bill_to_npwp,
                  'consignee'     =>  'consignee',
                  'kd_cnee'       =>  $kd_cnee,
                  'cnee_name'     =>  $item->cnee_name,
                  'cnee_address'     =>  $item->cnee_address,
                  'cnee_npwp'     =>  $item->cnee_npwp,
                  'forwader'      =>  'forwader',
                  'kd_forwader'      =>  $kd_forwader,
                  'forwader_name'      =>  $item->forwader_name,
                  'forwader_address'      =>  $item->forwader_address,
                  'forwader_npwp'      =>  $item->forwader_npwp,
                  'kd_vsl'        =>  $item->kd_vessel,
                  'vessel'        =>  $item->vessel,
                  'pol'           =>  $item->pol,
                  'container'     =>  $item->container,
                  'seal'          =>  $item->seal,                    
                  'eta'           =>  date('Y-m-d',strtotime($item->eta)),
                  'hbl'           =>  $item->hbl,
                  'vls_bl'        =>  $item->vls_bl,
                  'qty'           =>  $item->qty,
                  'sat_qty'       =>  $item->packing,
                  'description'   =>  $item->description,
                  'weight'        =>  $item->weight,
                  'measure'       =>  $item->measure,

                  'min_actual'    =>  $min_actual,
                  'min'           =>  $min,
                  'volume'        =>  $vol,
                  'cbm'           =>  $cbm,
                  'inv_soa'       =>  $inv_soa,            

                  'username'      =>  $item->username,
              ];    
              //dd($rec);
               Manifest::create($rec);
               $item->delete();

              //update konter Invoice
              DB::table('vessel')->where('kd_vsl',$request->vsl)->update([
                  'last_num' => $inv4,
              ]);


              //Mail::to('zai@sinergisukseslogistik.com')->send(new Email($details));
              
        

      }

         $details = [
          'kd_vsl'  => $request->vsl,
          'vessel'  =>  $vessel->vessel,
          'jum_pos'     => $vessel->jum_pos
          ];


        $email = env('MAIL_WH');        
        //Mail::to('zai@sinergisukseslogistik.com')->send(new Email($details));
        //Mail::to($email)->send(new MailSuccess($details));

      Mail::to($email)->send(new MailSuccess($details,$vessel->vessel));      
      return redirect()->route('wh.manifest.index',[$vessel->kd_vsl]);

    }




    public function manifestStore(Request $request, $vsl)
    {

        $this->validate($request,[
            'file' => 'required|mimes:csv,xls,xlsx'            
        ]);

        //dd($request->all());
        $file = $request->file('file');
        //$nama_file = rand().$file->getClientOriginalName();
        //$file->move('file_manifest',$nama_file);
        //Excel::import(new TempDataWhImport, $file);
        Excel::import(new UploadImport, $file);
        //Excel::import(new TempWhImport, public_path('/file_manifest/'.$nama_file));

/*
        //validasi..
        $cek   = TempDataWh::where('kd_vessel',$vsl)->first();
        dd($cek);
        if (!$cek) {
            dd('error data vessel');
        }
*/
        
        //Session::flash('sukses','Data Siswa Berhasil Diimport!');
        //alert()->success('Sukses','Data Berhasil di Import');   
        //$tmpwhimp = TempDataWh::all();  
        
        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return redirect()->route('wh.upload.results',[$vsl]);           

    }



    public function AddManifest(Request $request)
    {

      $dataTemp = TempDataWh::all();

      return view('wh.upload.add_manifest',[
         'dataTemp'     => $dataTemp,
      ]);
      

    }

    public function uploadEdit($vsl,$seq)
    {

        dd('edit page');

    }


    public function ViewUploadVessel()
    {

        $data['vessels'] = Vessel::all();
        $data['temdatawh'] = TempDataWh::where('kd_vessel','99999')->get();
        $data['kd_vsl'] = '';
        return view('wh.upload.view_upload',$data);
       
    }

    public function ViewDataResult(Request $request)
    {

        $data['vessels'] = Vessel::all();
        $data['temdatawh'] = TempDataWh::where('kd_vessel',$request->kd_vsl)->get();
        $data['kd_vsl'] = $request->kd_vsl;
        return view('wh.upload.view_upload',$data);
       
    }


}
