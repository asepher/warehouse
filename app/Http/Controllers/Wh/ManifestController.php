<?php

namespace App\Http\Controllers\Wh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
        
use App\Models\Manifest;
use App\Models\Vessel;
use App\Models\Customer;
use App\Models\Container;
use App\Models\Param;
use App\Models\Tarif;

 
class ManifestController extends Controller
{
    
    public function index($vsl)
    {
        $customer   = Customer::all();
        $consignee  = Customer::all();
        $forwader   = Customer::where('forwader','1')->get();

        $cont = Container::where('kd_vsl',$vsl)->get();
        $vessel = Vessel::where('kd_vsl',$vsl)->first();
        $satuan = Param::where('param1','STGW')->get();
        $manifest = Manifest::where('kd_vsl',$vsl)->get();  

        //dd($manifest);
        return view('wh.manifest.index',[
                'vsl'        =>  $vsl,
                'customer'  =>  $customer,
                'forwader'  =>  $forwader,
                'cont'      =>  $cont,
                'vessel'    =>  $vessel,
                'satuan'    =>  $satuan,
                'manifest'  =>  $manifest,
                ]);
    }

 
    public function create($vsl)
    {
        $vessel = Vessel::where('kd_vsl',$vsl)->first();        
        $customer  = Customer::where('forwader',1)->get();
        $consignee  = Customer::where('consignee',1)->get();
        $forwader  = Customer::where('agent',1)->get();
        $cont = Container::where('kd_vsl',$vsl)->get();
        $satuan = Param::where('param1','STGW')->get(); 
        return view('wh.manifest.create',[
                'vsl'         =>  $vsl,    
                'vessel'     =>  $vessel,
                'customer'   =>  $customer,
                'consignee'  =>  $consignee,
                'forwader'   =>  $forwader,
                'cont'       =>  $cont,
                'satuan'     =>  $satuan,
            ]);

    }

    public function store(Request $request,$vsl)
    {
        //dd($request->all());

        $this->validate($request,[
                'seq'          =>  'required',
                'term'          =>  'required',
                'bill_to'       =>  'required',
                'consignee'     =>  'required',
                'forwader'      =>  'required',
                'description'   =>  'required',
                'container'     =>  'required',
                'seal'          =>  'required',
                'pol'           =>  'required',
                'vessel'        =>  'required',
                'eta'           =>  'required',
                'hbl'           =>  'required',
                'vls_bl'        =>  'required',
                'qty'           =>  'required',
                'sat_qty'       =>  'required',
                'weight'        =>  'required',
                'measure'       =>  'required',
            ]);

        //var_dump($request->all());
        $kapal  = $request->kd_vsl;
        $vessel = Vessel::where('kd_vsl', $kapal)->first();      
        //return $vessel->eta;

        // number idp
        $thn = date('Y',strtotime($vessel->eta));       
        $bln = date('m',strtotime($vessel->eta));       
        $getNom = DB::table('param')->where('param1',"IDP1")->first();
        $nom = (int) $getNom->param2;
        $idp = $thn.$bln.sprintf("%04s", $nom+1);
       
        //nommor inv
        $getkd  = DB::table('param')->where('param1',"INV0")->first();
        $th     = date('Y',strtotime($vessel->eta));
        $nom    = (int) $vessel->last_num+1;        
        $inv4   = sprintf("%02s", $nom);
        $kodeinv =  $getkd->param2.$vessel->inv3.$inv4;

        //hitung minimum actual 
        $weight = $request->weight / 1000;
        if ( $weight >= $request->measure)
        {
            $min_actual = $weight;
            $vol = $weight;
        } else {
            $min_actual = $request->measure;
            $vol = $request->measure;
        }


        //cari minimum
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

        if ($request->term == 'CNF') {
            $inv_soa    = $vol * 350000;
        } else {
            $inv_soa    = ($vol * 200000) + 50000;
        }

        $cnee        = Customer::where('kd_cus',$request->consignee)->first();
        $forwader    = Customer::where('kd_cus',$request->forwader)->first();        
        $data = [
            'seq'           =>  $nom,
            'idp'           =>  $idp,
            'kd_inv'        =>  $kodeinv,
            'term'          =>  $request->term,
            'bill_to'       =>  $request->bill_to,
            'consignee'     =>  $request->consignee,
            'kd_cnee'       =>  $request->consignee,
            'cnee_name'     =>  $cnee->customer, 
            'cnee_address'  =>  $cnee->address,
            'cnee_npwp'     =>  $cnee->npwp,
            'forwader'      =>  $request->forwader,
            'kd_forwader'   =>  $request->forwader,
            'forwader_name' =>  $forwader->customer,
            'forwader_address'  =>  $forwader->address,
            'forwader_npwp' =>  $forwader->npwp,
            'description'   =>  $request->description,
            'container'     =>  $request->container,
            'seal'          =>  $request->seal,
            'pol'           =>  $request->pol,
            'kd_vsl'        =>  $request->kd_vsl,
            'vessel'        =>  $request->vessel,
            'eta'           =>  $request->eta,
            'hbl'           =>  $request->hbl,
            'vls_bl'        =>  $request->vls_bl,
            'qty'           =>  $request->qty,
            'sat_qty'       =>  $request->sat_qty,
            'weight'        =>  $request->weight,
            'measure'       =>  $request->measure,
            'min_actual'    =>  $min_actual,
            'min'           =>  $min,
            'volume'        =>  $vol,
            'cbm'           =>  $cbm,
            'inv_soa'       =>  $inv_soa,
        ];
        //($data);
        Manifest::create($data);
 
        //update IDP
        DB::table('param')->where('param1','IDP1')->update([
            'param2' => substr($idp, 4, 4),
        ]);

        //update konter Invoice
        DB::table('vessel')->where('kd_vsl',$kapal)->update([
            'last_num' => $inv4,
        ]);
        

        //return $request->all();
        $id = $request->kd_vsl;
        $customer   = Customer::all();
        $consignee  = Customer::all();
        $forwader   = Customer::where('forwader','1')->get();
        $cont = Container::where('kd_vsl',$vsl)->get();
        $satuan = Param::where('param1','STGW')->get();
        $manifest = Manifest::where('kd_vsl',$id)->get();
        return redirect()->route("wh.manifest.index",$vsl );
    }    

    public function edit($vsl,$seq)
    {

         $manifest = Manifest::where('kd_vsl',$vsl)->where('seq',$seq)->first();
         $vessel = Vessel::where('kd_vsl',$vsl)->first();
         $customer = Customer::all();
         $cont = Container::where('kd_vsl',$vsl)->get();
         $satuan = Param::where('param1','STGW')->get();          
         $consignee  = Customer::all(); 
         $forwader  = Customer::all();       

         return view('wh.manifest.edit',[
                    'seq'       =>  $seq,
                    'vsl'       =>  $vsl,
                    'man'       =>  $manifest,
                    'vessel'    =>  $vessel,
                    'customer'  =>  $customer,
                    'cont'      =>  $cont,
                    'satuan'    =>  $satuan,
                    'consignee'    =>  $consignee,
                    'forwader'    =>  $forwader,
                ]);


    }

    public function update(Request $request,$vsl)
    {

        $seq    = $request->seq;
        $term   = $request->term;
        $this->validate($request,[
             'term'          =>  'required',
             'kd_bill_to'    =>  'required',
             'consignee'     =>  'required',
             'forwader'      =>  'required',
             'description'   =>  'required',
             'container'     =>  'required',
             'seal'          =>  'required',
             'pol'           =>  'required',
             'vessel'        =>  'required',
             'eta'           =>  'required',
             'hbl'           =>  'required',
             'vls_bl'        =>  'required',
             'qty'           =>  'required',
             'sat_qty'       =>  'required',
             'weight'        =>  'required',
             'measure'       =>  'required',
      ]);


        //dd($request->all());


        if ($term == "CNF") {
            $bill_to = Customer::where('kd_cus',$request->consignee)->first();
        }  
        if ($term == "FOB") {
            $bill_to = Customer::where('kd_cus',$request->forwader)->first();
        }  

        $cnee       = Customer::where('kd_cus',$request->consignee)->first();
        $forwader   = Customer::where('kd_cus',$request->forwader)->first();
        $manifest        = Manifest::where('kd_vsl',$vsl)->where('seq',$seq)->first(); 

        // menghitung weight actual 
        // The intval() function returns the integer value of a variable

        $weight = $request->weight / 1000;
        //$weight = 9.62167;

        //dd(number_format($weight,5));
        
        if ( $weight >= $request->measure)
        {
            $min_actual = $weight;
            $vol = $weight;
        } else {
            $min_actual = $request->measure;
            $vol = $request->measure;
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


        $manifest->term              = $request->term;
        $manifest->kd_bill_to        = $request->kd_bill_to;
        $manifest->bill_to_name      = $bill_to->customer;
        $manifest->bill_to_address   = $bill_to->address;
        $manifest->bill_to_npwp      = $bill_to->npwp;

        $manifest->consignee         = $request->consignee;
        $manifest->kd_cnee           = $request->consignee;
        $manifest->cnee_name         = $cnee->customer;
        $manifest->cnee_address      = $cnee->address;
        $manifest->cnee_npwp         = $cnee->npwp;

        $manifest->forwader          = $request->forwader;
        $manifest->kd_forwader       = $request->forwader;
        $manifest->forwader_name     = $forwader->customer;
        $manifest->forwader_address  = $forwader->address;
        $manifest->forwader_npwp     = $forwader->npwp;


          $manifest->description = $request->description;
          $manifest->container   = $request->container;
          $manifest->seal        = $request->seal;
          $manifest->pol         = $request->pol;
          $manifest->hbl         = $request->hbl;
          $manifest->qty         = $request->qty;
          $manifest->sat_qty     = $request->sat_qty;
          $manifest->weight      = $request->weight;
          $manifest->measure     = $request->measure;


        $manifest->min_actual  =  $min_actual;
        $manifest->min         =  $min;
        $manifest->volume      =  $vol;
        $manifest->cbm         =  $cbm;
        $manifest->inv_soa     =  0;

          $manifest->save();

    



      //alert()->success('Sukses','Data Berhasil di update');        
      return redirect()->route('wh.manifest.index',[$manifest->kd_vsl]);

    }

    public function destroy(Request $request,$kd_vsl)    
    {

      //dd('error database');
      $cek = Manifest::where('kd_vsl',$kd_vsl)->first();
      if (!$cek) {
         dd('error database');
      }

      //DB::delete('delete from  where id = ?',[$id]);
      Manifest::where('kd_vsl',$kd_vsl)->delete();
      
      //alert()->success('Sukses','Data Berhasil di delete');
      return redirect()->route('wh.manifest.index',[$kd_vsl]);
    }

    public function show($inv)
    {


      //$vsl = $id;   
      $manifest = Manifest::where('kd_inv',$inv)->first();
      $vessel = Vessel::where('kd_vsl',$manifest->kd_vsl)->first();
      $customer = Customer::all();
      $cont = Container::where('kd_vsl',$manifest->kd_vsl)->get();
      $satuan = Param::where('param1','STGW')->get();          
      $consignee  = Customer::all(); 
      $forwader  = Customer::all();       

      return view('wh.manifest.show',[
               'vsl' => $vessel->kd_vsl,
               'man'       =>  $manifest,
               'vessel'    =>  $vessel,
               'customer'  =>  $customer,
               'cont'      =>  $cont,
               'satuan'    =>  $satuan,
               'consignee'    =>  $consignee,
               'forwader'    =>  $forwader,
             ]);


    }


    public function SatuanIndex(){

        $data['satuan'] = Param::where('param1','STGW')->get();
        
        return view('wh.satuan',$data);

    }
    public function SatuanStore(Request $request){

        //dd($request->all());
          $data = [

            'tahun'        =>  '2022',
            'param1'        =>  'STGW',
            'param2'        =>  $request->kd_charge,
        ];
        Param::create($data);

      //$data = Param::where('id',$request->id);
      return redirect()->route('wh.satuan.index');

    }

    public function SatuanEdit($id){

        $data['satuan'] = Param::where('param1','STGW')->get();
        $data['row'] = Param::where('id',$id)->first();
        return view('wh.satuan',$data);

    }

    public function searchHbl()
    {

      $data['manifest'] = Manifest::where('kd_inv','99999')->get();  
      $data['hbl']      =  '';      
      return view('wh.manifest.byhbl',$data);  

    }


   public function QueryByHbl(Request $request)
    {

       $this->validate($request,[
         'hbl'          =>  'required',           
      ]);
    
      //dd($request->all());
      $data['hbl']   = $request->hbl;
      $data['manifest']  = Manifest::select('*')
                  ->where('hbl',$request->hbl)
                  ->get();

      return view('wh.manifest.byhbl',$data);
    }
 

    public function InvByMonth()
    {

        return view('wh.report.bymonth');
    }
    
    public function QueryByMonth(Request $request)
    {     

        $this->validate($request,[
            'bulan'     => 'required',
            'dtquery'   =>  'required',
        ]);

        //dd($request->all());
        if ($request->dtquery == 'container') {
            $data['container'] = Container::whereMonth('eta', $request->bulan)->get();
            $data['bulan'] = $request->bulan;
            return view('wh.report.qbymonth_con',$data);

        }
        if ($request->dtquery == 'vessel') {
            $data['vessel'] = Vessel::whereMonth('eta', $request->bulan)->get();
            $data['bulan'] = $request->bulan;
            return view('wh.report.qbymonth_ves',$data);
        }

    }

}
