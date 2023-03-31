<?php
namespace App\Http\Controllers\Si;

 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Customer;
use App\Models\Negara;
use App\Models\Shipping;
use App\Models\InvSiHeader;
use App\Models\InvSiDetail;
use App\Models\Param;
use App\Models\Sijob;

use Datatables;


class SiController extends Controller
{

   public function index()
   {

        $shipping = Shipping::orderBy('kd_si','DESC')->get();
        return view('si.index',[
                'shipping'  =>  $shipping,
            ]);
   }


   public function createJob()
   {

      //$data['jobnumber'] = Jobnumber::where('tahun','2022')->first()->last_job;
      $data['siJob'] = Sijob::orderBy('kd_si','DESC')->where('status',0)->get();
      //$data['jobnumber']   = $siJob->kd_si;    
      return view('si.job.create',$data);
   }

   public function getJob(Request $request)
   {

       $this->validate($request,[
         'service'   =>  'required',
         'tipe'      =>  'required',
         ]);

/*
$bilangan=1234; // Nilai Proses
$fzeropadded = sprintf("%07d", $bilangan);
echo "$fzeropadded "; // Hasil 0001234
*/

      $serv    = $request->service;
      $tipe    = $request->tipe;
      $param = Param::where('tahun',2022)->where('param1','SJOB')->first();
      $nomJob = $param->param2 + 1;

      $siRef =  sprintf("%03d", $nomJob).substr($serv,0,1).'JKSSL22' ;
    

      $siJob         = new Sijob();
      $siJob->kd_si     = $siRef;
      $siJob->service =  $serv;
      $siJob->tipe   =  $tipe;
      $siJob->save();

      $param->param2 =  $nomJob;
      $param->save();

      $data['jobnumber'] = $siRef;
      //return view('si.job.create',$data);      
      return redirect()->route('si.create.job');
   }


   public function createSi(Request $request)
   {

      //dd($request->all());
      $job = $request->pilihjob;
      $cnee = Customer::where('si',1)->get();
      $negara = Negara::all();
      $siJob     = Sijob::where('kd_si',$job)->first();
      return view('si.create',[
            'customer'  =>   $cnee,
            'negara'    =>   $negara,
            'job'       =>   $job,
            'service'   =>   $siJob->service,
            'tipe'      =>   $siJob->tipe,
      ]);
   }

   public function storeSi(Request $request)
    {
        
        $this->validate($request,[          
            'kd_cus'    =>  'required',
            'coo'       =>  'required',
            'pol'       =>  'required',
            'pod'       =>  'required',
            'vessel'    =>  'required',
            'marking'   =>  'required',
            'term'      =>  'required',
            'eta'       =>  'required',
            'etd'       =>  'required',
        ]);
         
        //return $request->all();
        //return str_replace(".","",$request->gw);
        //die();
        // 001I/JK/SSL/20

//        dd($request->all());
/*
        $service = $request->service; 
        $thn = date('Y',strtotime($request->eta));        
        $getNom = DB::table('param')->where('param1',"SI20")->first();
        $nom = (int) $getNom->param2;
        $huruf = $getNom->param3;
        $kodesi = sprintf("%03s", $nom+1).substr($service,0,1).$huruf.substr($thn,-2);
*/
        $tbjob    =  Sijob::where('kd_si',$request->jobid)->first();
        $cust = Customer::where('kd_cus',$request->kd_cus)->first();
        //dd($cust);

        Shipping::create([
            'kd_si'     =>  $request->jobid,
            'service'   =>  $tbjob->service,
            'tipe'      =>  $tbjob->tipe,
            'kd_cus'     =>  $request->kd_cus,
            'cus_name'   =>     $cust->customer,
            'cus_address'   =>  $cust->address,
            'cus_npwp'      =>  $cust->npwp,            
            'coo'       =>  $request->coo,
            'pol'       =>  $request->pol,
            'pod'       =>  $request->pod,
            'vessel'    =>  $request->vessel,
            'marking'   =>  $request->marking,
            'description'    =>  $request->description,
            'term'      =>  $request->term,
            'bl'        =>  $request->bl,
            'awb'       =>  $request->awb,
            'flight'    =>  $request->flight,
            'eta'       =>  $request->eta,
            'etd'       =>  $request->etd,
            'gw'        =>  $request->gw,
            'sat_gw'        =>  $request->sat_gw,
            'vol'           =>  $request->vol,
            'sat_vol'       =>  $request->sat_vol,
            'tgl_release'   =>  $request->tgl_release,
            'username'  =>  Auth::user()->username,
        ]);

        $tbjob->status = 1;
        $tbjob->update();
/*
        DB::table('param')->where('param1','SI20')->update([
            'param2' => substr($kodesi, 0, 3), 
        ]);
*/
        //Alert::success('Sukses', 'SI berhasil di tambahkan');

        return redirect()->route('si.index');

    }


    public function showSi($id)
    {
        $si         = Shipping::where('kd_si',$id)->first();
        $invHd      = InvSiHeader::where('kd_si',$id)->first();
        $invDt      = InvSiDetail::where('kd_si',$id)->get();
        $viewInv    = InvSiHeader::where('kd_si',$id)->get();
        $tipe       = Param::where('param1', 'TIPE')->get();

        return view('si.show',[
                    'si'    =>  $si,
                    'id'    =>  $id,
                    'invHd' =>  $invHd,
                    'invDt' =>  $invDt,
                    'viewInv' => $viewInv,
                    'tipe'      => $tipe,
                ]);
    }


    public function editSi($id)
    {
        //dd($id);        
        $customer = Customer::all();
        $negara = Negara::all();
        $shipping = Shipping::where('kd_si',$id)->first();
        return view('si.edit',[
            'id'        =>  $id,
            'customer'  =>  $customer,
            'negara'    =>  $negara,
            'si'        =>  $shipping
        ]);

    }

    public function updateSi(Request $request, $id)
    {
            $this->validate($request,[
            'service'   =>  'required',
            'tipe'      =>  'required',
            'kd_cus'      =>  'required',
            'coo'       =>  'required',
            'pol'       =>  'required',
            'pod'       =>  'required',
            'vessel'    =>  'required',
            'marking'   =>  'required',
            'term'      =>  'required',
            'eta'       =>  'required',
            'etd'       =>  'required',
        ]);

        $si = Shipping::where('kd_si',$id)->first();
        $si->service    = $request->service;
        $si->tipe       = $request->tipe;
        $si->kd_cus       = $request->kd_cus;
        $si->coo       = $request->coo;
        $si->pol        = $request->pol;
        $si->vessel     = $request->vessel;
        $si->marking    = $request->marking;
        $si->description = $request->description;
        $si->term       = $request->term;
        $si->bl         = $request->bl;
        $si->awb        = $request->awb;
        $si->flight     = $request->flight;
        $si->eta        = $request->eta;
        $si->etd        = $request->etd;
        $si->gw         = $request->gw;
        $si->sat_gw     = $request->sat_gw;
        $si->vol        = $request->vol;
        $si->sat_vol    = $request->sat_vol;
        $si->tgl_release = $request->tgl_release;
        $si->save();

        //Alert::success('Sukses', 'SI berhasil di Update', 'Type');
        return redirect()->route('si.index');
    }

   public function destroySi(Request $request,$id)
   {      
        dd('delete record');

   }

   public function SiViewDetail($kd_si)
   { 

        $si         = Shipping::where('kd_si',$kd_si)->first();
        $invHd      = InvSiHeader::where('kd_si',$kd_si)->first();

        $invDt      = InvSiDetail::where('kd_si',$kd_si)->get();
        $viewInv    = InvSiHeader::where('kd_si',$kd_si)->get();

        $jenis       = Param::where('param1', 'TIPE')->get();

        return view('si.view_detail',[
               'si'        =>  $si,
               'kd_si'     =>  $kd_si,
               'invHd'     =>  $invHd,
               'invDt'     =>  $invDt,
               'viewInv'   => $viewInv,
               'jenis'      => $jenis,
        ]);

   } 

   public function InputAju($si)
   {
      return view('si.formaju',[
          'si'  => $si,
      ]);
   }

   public function StoreAju(Request $request,$si)
   {
      $shipping = Shipping::where('kd_si',$si)->first();

      $shipping->no_aju = $request->no_aju;
      $shipping->update() ;  

      return redirect()->route('si.index'); 
   }

}