<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Vessel;
use App\Models\Customer;
use App\Models\Manifest;
use App\Models\IwhHeader;
use App\Models\InvManHeader;
use App\Models\InvManDetail;
use App\Models\Charge;
use App\Models\Tarif;
use App\Models\Container;
use App\Models\Stripping;


use App\Helpers\Helper;
use PDF;

 
class ReportController extends Controller
{
    
   public function WhInvoice()
   {
      return view('wh.report.index');
   }


    public function InvoiceByVessel()
    {  
       $data['vessels'] = Vessel::all();
       $data['manifest'] = Manifest::where('kd_vsl','99999')->get();
       $data['kd_vsl'] = '';
       return view('wh.report.byvessel',$data);     
    } 

   public function QueryByVessel(Request $request)
    {
      
      $this->validate($request,[
         'kd_vsl'          =>  'required',           
      ]);
      $term = $request->term;
      $data['vessels']     = Vessel::all();
      if (!isset($request->term)) {
              $data['manifest']    = Manifest::where('kd_vsl',$request->kd_vsl)->get();
      } else {
              $data['manifest']    = Manifest::where('kd_vsl',$request->kd_vsl)
                                    ->where('term',$request->term)->get();
      }
      $data['kd_vsl']      =  $request->kd_vsl;
      $data['term']      =  $request->term;     
      return view("wh.report.byvessel",$data);
    }

 
   public function InvoiceByDate()
   {
      $data['tgl_awal']   = '00/00/000';
      $data['tgl_akhir']  = '00/00/000';      
      $data['manifest'] = Manifest::where('kd_vsl','99999')->get();
      return view('wh.report.bydate',$data);
   } 

   public function QueryByDate(Request $request)
   {
      //dd($request->all());

    $this->validate($request,[
         'tgl_awal'          =>  'required',           
         'tgl_akhir'          =>  'required',           
      ]);
    
      $data['tgl_awal']   = $request->tgl_awal;
      $data['tgl_akhir']  = $request->tgl_akhir;
      $data['manifest']  = Manifest::select('*')
                  ->whereDate('tgl_inv', '>=', $request->tgl_awal)
                  ->whereDate('tgl_inv', '<=', $request->tgl_akhir)
                  ->get();
      return view('wh.report.bydate',$data);
   }


   public function InvoiceByCustomer(Request $request)
   {
      $data['customer'] = Customer::all();
      $data['manifest'] = Manifest::where('kd_vsl','99999')->get();
      $data['kd_cus'] = '';
      return view('wh.report.bycustomer',$data);  

   }
 
   public function QueryByCustomer(Request $request)
    {
      
      $this->validate($request,[
         'kd_cus'          =>  'required',           
      ]);

      $data['customer'] = Customer::all();
      $data['manifest']    = Manifest::where('kd_cnee',$request->kd_cus)->get();
      $data['kd_cus']      =  $request->kd_cus;
      return view("wh.report.bycustomer",$data);
    }

   public function InvoiceByNom(Request $request)
   {
      
      $data['manifest'] = Manifest::where('kd_inv','99999')->get();  
     $data['nomor']     =  $request->nomor;      
      return view('wh.report.bynom',$data);  

   }

   public function QueryByNom(Request $request)
    {
      
      $this->validate($request,[
         'nomor'          =>  'required',           
      ]);

      $data['manifest']    = Manifest::where('kd_inv',$request->nomor)->get();
      $data['nomor']      =  $request->nomor;
      return view("wh.report.bynom",$data);
    }


   public function ManCreate()
   {

      $data['container']     = Container::all();
      //$data['charge'] = Charge::where('dep','WH01')->get();
      return view('wh.invoice.manual',$data);
   }


   public function ManCreateNew(Request $request,$cnt)
   {

      $data['container'] = $cnt;
      $data['tarif'] = Tarif::where('term','MAN')->get();
       $data['details'] = InvManDetail::where('container',$cnt)->get();
    
      return view('wh.invoice.manualnew',$data);
   }

   public function ManualStore(Request $request)
   {
      //dd($request->all());
      $this->validate($request,[
            'container'    =>  'required',
            'keterangan'   =>  'required',
            'jumlah'        =>  'required',
      ]);
      $cont = $request->container;
      $vsl = Container::where('container',$cont)->first();
      $kd_inv = Helper::GenKodeInv($vsl->kd_vsl);
      //dd($kd_inv);
      $dthd = [
          'kd_inv'    =>  $kd_inv,
          'kd_vsl'    =>  $vsl->kd_vsl,
          'tipe'      =>  'MN',
        ];  
      //dd($dthd);
      InvManHeader::create($dthd);

      $dtdtl = [
          'kd_inv'        => $kd_inv,
          'container'     => $cont,
          'kd_vsl'        => $vsl->kd_vsl,
          'kd_tarif'      => $request->kd_tarif,
          'nama_tarif'    => $request->kd_tarif,
          'keterangan'    => $request->keterangan,
          'jumlah'        => str_replace(".","",$request->jumlah),
        ];                
        InvManDetail::create($dtdtl);

        //dd('sukses ');

        $data['details'] = InvManDetail::all();
        return redirect()->route('wh.manual.createnew',[$cont]);
   }


   public function ReportDaily()
   {
      $data['vessels'] = Vessel::all();
      $data['manifest'] = Manifest::where('kd_vsl','99999')->get();
      $data['kd_vsl'] = '';
      $data['tgl'] = '';
      $data['totCNF'] = 0;
      $data['totCNfedc'] = 0;
      $data['totCNTrans'] = 0;
      $data['sudahPaid'] = 0;
      $data['blmPaid'] = 0;
      return view('wh.report.daily',$data);
   }

   public function ReportDailyView(Request $request)
   {

     //dd($request->all());
    /*
      $this->validate($request,[
            'tanggal'    =>  'required',
            'bulan'   =>  'required',
            'tahun'        =>  'required',
      ]);
      */
      //dd($request->all()); strtotime($this->attributes['start_date'])
      // 2022-09-19 11:48:38
      //return date('m/d/Y', strtotime($this->attributes['start_date']));
      //$data = App\Models\Manifest::whereDate('tgl_inv', '=', $tgl )->get(); 
      //$data['manifest'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime('2022-09-19')) );

      $tgl_skrg     = $request->tahun ."/". $request->bulan . "/" . $request->tanggal;
      $data[ 'tgl'] =  date('Y-m-d', strtotime($tgl_skrg));       
      $data['manifest'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))->get();
      //$data['manifest'] = Manifest::all();      
      //dd($data['manifest']);
      $data['totCNF'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))
                    ->where('term','CNF')->where('gen_inv',1)->sum("inv_wh");
      $data['totCNfedc'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))
                    ->where('term','CNF')->where('gen_inv',1)->where('paid_at',1)->sum("inv_wh");
      $data['totCNTrans'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))->where('term','CNF')->where('gen_inv',1)->where('paid_at',2)->sum("inv_wh");

      $data['sudahPaid'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))
                    ->where('gen_inv',1)->where('paid',1)->count();

      $data['blmPaid'] = Manifest::whereDate('tgl_inv', '=', date('Y-m-d', strtotime($tgl_skrg)))
                    ->where('gen_inv',1)->where('paid',0)->count();
      return view('wh.report.daily',$data);
   }
   
   public function ReportDailyManifest(Request $request)
   {
      dd($request->all());

   } 

   public function StrippingVsl($vsl)
   {
      $data['vessel']   = Vessel::where('kd_vsl',$vsl)->first();
      $data['vsl']      = $vsl;
      return view('wh.stripping.form',$data);
   }  

   public function StrippingStore(Request $request)
   {

      $this->validate($request,[
            'tgl_stripping'   =>  'required',
            'keterangan'   =>  'required',
            'photo'           =>  'required|mimes:png,jpg,jpeg|max:2048'
      ]);      
      
      //dd($request->all());
      $data['vessel']       = Vessel::where('kd_vsl',$request->vsl)->first();
      //$data['stripping']    = Stripping::where('kd_vsl',$request->vsl)->first();
      //$data['kd_vsl']          = $request->vsl;


      $data =  new Stripping();
      $data->kd_vsl         =  $request->vsl;
      $data->status         =  1;
      $data->tgl_stripping  =  $request->tgl_stripping;
      $data->keterangan     =  $request->keterangan;

        //$path = $request()->file('photo')->store('stripping');
        //$slug = Str::slug($post->title, '-'); 
        $file = $request->file('photo');      
        $fullname = $file->getClientOriginalName();
        $extetion = $file->getClientOriginalExtension();
        $filenameTemp = explode(".",$fullname);
        $filename = $filenameTemp[0];
        $slug = Str::slug($filename, '-');
        $filename_Date = date('YmdHi').'-'.$slug.'.'.$extetion;
        $file->move(public_path('upload'),$filename_Date);

      $data->photo     =  $filename_Date;
      $data->save();

      return redirect()->route('wh.vessel.index');
    

/*
      //dd($path);
      if ($request->hasFile('photo')) {
          $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('filename')->getClientOriginalName());
          $request->file('filename')->move(public_path('stripping'), $filename);  
          $data->photo = $filename;
      }
*/


   }


   public function StrippingView($vsl)
   {

      $data['vsl']          = $vsl;
      $data['stripping']    =  Stripping::where('kd_vsl',$vsl)->get(); 
      $data['vessel']       =  Vessel::where('kd_vsl',$vsl)->first();
      return view('wh.stripping.view',$data);
   }


   public function StrippingEdit($vsl,$id)
   {

      $data['vsl']        =   $vsl;
      $data['id']         =   $id;
      $data['stripping']  =  Stripping::where('kd_vsl',$vsl)
                                ->where('id',$id)->first(); 

      return view('wh.stripping.edit',$data);
   }

   public function StrippingUpdate(Request $request,$vsl)
   {

      $data  =  Stripping::where('kd_vsl',$vsl)
                              ->where('id',$request->id)->first(); 

      //dd($request->tgl_stripping);

      $data->tgl_stripping = $request->tgl_stripping;
      $data->keterangan    = $request->keterangan;


      if ($request->hasfile('photo')) {

          //$path = $request()->file('photo')->store('stripping');
              //$slug = Str::slug($post->title, '-'); 
              $file = $request->file('photo');      
              $fullname = $file->getClientOriginalName();
              $extetion = $file->getClientOriginalExtension();
              $filenameTemp = explode(".",$fullname);
              $filename = $filenameTemp[0];
              $slug = Str::slug($filename, '-');
              $filename_Date = date('YmdHi').'-'.$slug.'.'.$extetion;
              $file->move(public_path('upload'),$filename_Date);
            $data->photo     =  $filename_Date;
      }

      $data->save();


      //dd(" Updated ");
      return redirect()->route('wh.stripping.view',$vsl);

   }
   
   public function StrippingDelete(Request $request,$id)
   {
      $vsl    =   $request->vsl;
      $data   =   Stripping::where('kd_vsl',$vsl)
                              ->where('id',$request->id)->first();

      $data->delete();

      return redirect()->route('wh.stripping.view',$vsl);

   }
}
