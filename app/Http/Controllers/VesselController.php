<?php 
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vessel;
use App\Models\Customer;
use App\Models\Container;
use App\Models\Charge;
use App\Models\InvManHeader;
use App\Models\InvManDetail;
//use App\Models\IwhHeader;
//use App\Models\IwhDetail;

Use Illuminate\Support\Facades\DB;
use App\Exports\VesselExport;
use Maatwebsite\Excel\Facades\Excel;

 
use Helper;
use Alert;
use PDF;

class VesselController extends Controller
{
    public function index()
    {
        $vessel = Vessel::latest()->get();
        return view('wh.vessel.index',[
                'vessels'    =>  $vessel,
            ]);
    }

    public function create()
    {
        $customer   = Customer::all();
        return view('wh.vessel.create',[
            'customer'  =>  $customer,
        ]);
    }

    public function store(Request $request)
    {

         $this->validate($request,[
            'eta'           =>  'required',
            'vessel'        =>  'required',
            'container'     =>  'required',
            'vls_bl'        =>  'required',
            'jum_pos'       =>  'required',
         ]);
         //$tanggal = Helper::TglSimpan($request->eta);
         //dd($request->eta);

         $kdparam = "VSSL";
         $thn = date('Y',strtotime($request->eta));
         $bln = date('m',strtotime($request->eta));
         $getNom = DB::table('param')->where('tahun',$thn)
                    ->where('param1',$kdparam)->first();
         $nom = (int) $getNom->param2;
         $huruf = "VS". substr($thn,-2);
         $kd_vsl = $huruf . sprintf("%04s", $nom+1);
         $urt = sprintf("%02s", $nom+1);

         $dtvessel = [ 
            'kd_vsl'    =>  $kd_vsl,
            'eta'       =>  $request->eta, 
            'vessel'    =>  $request->vessel,
            'container' =>  $request->container,
            'vls_bl'    =>  $request->vls_bl,
            'jum_pos'   =>  $request->jum_pos,
            'inv3'      =>  $thn.$bln.$urt, 
            'inv_th'    =>  $thn,
            'inv_bln'   =>  $bln,
            'inv_urut'  =>  $urt,
            'last_num'  => 0, 
            'last_dn'   => $request->jum_pos+1, 
            'gen_dn'    => 0, 

         ]; 
         //Helper::TglSimpan($request->eta),
        //dd($dtvessel);
        Vessel::create($dtvessel);
 
       
        $list =  explode(",",$request->container);
        $jum_con = count($list);
        foreach ($list as $k) {
            $dt = [
                'kd_vsl'        =>  $kd_vsl,  
                'vessel'        =>  $request->vessel,
                'container'      =>  $k,
                'vls_bl'        =>  $request->vls_bl,
                'eta'            =>  $request->eta,                    
                ];

            Container::create([
                'kd_vsl'        =>  $kd_vsl,  
                'vessel'        =>  $request->vessel,
                'container'      =>  $k,
                'vls_bl'        =>  $request->vls_bl,
                'eta'            =>  $request->eta,
            ]);

        }

        DB::table('param')->where('tahun',$thn)
                ->where('param1',$kdparam)->update(['param2' => substr($kd_vsl, 4, 4),
        ]);

        return redirect()->route('wh.vessel.index');

    }

    public function edit($id)
    {

        $vessel = Vessel::where('kd_vsl',$id)->first();
        return view('wh.vessel.edit',[
            'id'    => $id,
            'vessel'    =>  $vessel,
        ]);
    }

    public function update(Request $request, $vsl)
    {

/*        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
*/
        $this->validate($request,[
            'eta'           =>  'required',
            'vessel'        =>  'required',
            'container'     =>  'required',
            'vls_bl'        =>  'required',
            'jum_pos'       =>  'required',
         ]);


        $row = Vessel::where('kd_vsl',$vsl)->first();
        $data = [
            'eta'           =>  $request->eta,
            'vessel'        =>  $request->vessel,
            'container'     =>  $request->container,
            'vls_bl'        =>  $request->vls_bl,
            'jum_pos'       =>  $request->jum_pos,

        ];    
        $row->update($data);
        
       // dd($data);

        return redirect()->route('wh.vessel.index')
                        ->with('success','Vessel updated successfully');
    }

    public function VslCntEdit($id)
    {

      $data['manDtl']   = InvManDetail::where('id',$dd)->get();

      $data['cont']     = $cont;
      $data['kd_inv']   = $inv;
      $data['manHd']    = InvManHeader::where('container',$cont)->first();     
      $data['charge']   = Charge::where('dep','WH01')->orderBy('kd_charge','ASC')->get();

      return view('wh.vessel.editmannew',$data);


    }

    public function VslCntDelete($cnt,$id)
    {
        $row = InvManDetail::where('container',$cnt)->where('id',$id)->first();
        $vsl = $row->kd_vsl;
        $row->delete();

        //hitung ulang 
        $cekMan = InvManHeader::where('container',$cnt)->first();

        $jumTotal = InvManDetail::where('container',$cnt)->sum('jumlah');
        $ppn =  $jumTotal * 0.11;
        if ($jumTotal >= 5000000 ) {
            $materai = 10000;
        } else {
            $materai = 0;
        }
        $grandtot = $jumTotal + $ppn + $materai ; 


        $cekMan->jumlah = $jumTotal;
        $cekMan->ppn = $ppn;
        $cekMan->materai = $materai;
        $cekMan->grandtotal = $grandtot;
        $cekMan->save();

        //Alert::success('Sukses', 'Data  berhasil di delete');
        return redirect()->route('wh.container.invoice',[$vsl,$cnt]);
        
    }

    public function InfoContainer($vsl)
    {        

       // dd($vsl);
        $data['vsl']    = $vsl;
        $data['container'] = Container::where('kd_vsl',$vsl)->get();

        //cek invman
        return view('wh.vessel.container',$data);
        //dd($vsl);
    }

    public function CreateInvMan($vsl,$cnt)
    {

        $data['cnt']    = $cnt;
        $data['vsl']    = $vsl;
        $data['manHd']  = InvManHeader::where('kd_vsl',$vsl)->where('container',$cnt)
                          ->where('tipe','MA')->first();
        $data['manDtl'] = InvManDetail::where('kd_vsl',$vsl)->where('container',$cnt)
                          ->where('tipe','MA')->get();
        $data['charge'] = Charge::where('dep','WH01')->orderBy('kd_charge','ASC')->get();
        return view('wh.vessel.createinv',$data);

    }
 
    public function VesselDataInv(Request $request,$vsl,$cnt)
    {
     
          // simpan data inv manual
         $this->validate($request,[
            'charge'    =>  'required',
            'keterangan' =>  'required',
            'jumlah'    =>  'required',
            'cont'    =>  'required',
         ]);
         //dd($request->all());


         $cekMan = InvManHeader::where('container', $request->cont)
                              ->where('kd_vsl',$vsl)
                              ->where('tipe','MA')->first();

         if (!$cekMan) {

            $kd_inv   = Helper::GenKodeInvDn($vsl);
            $invMst = [
              'kd_inv'    =>  $kd_inv, 
              'tipe'      => 'MA',
              'kd_vsl'    =>  $vsl,
              'tgl_gen'   => now(),
              'container' =>  $request->cont,
            ];
            InvManHeader::create($invMst);

         } else {
           $kd_inv = $cekMan->kd_inv;
         }

          
         $invDlt = [
            'kd_inv'      =>  $kd_inv, 
            'kd_vsl'      =>  $vsl,
            'container'   =>  $cnt,
            'keterangan'  =>  $request->keterangan,
            'jumlah'      =>   $request->jumlah,         
            'tipe'      =>  'MA', 
          ];         
          InvManDetail::create($invDlt);



          $jumTotal = InvManDetail::where('container',$cnt)->sum('jumlah');

          $ppn =  $jumTotal * 0.11;
          if ($jumTotal >= 5000000 ) {
            $materai = 10000;
          } else {
            $materai = 0;
          }
          $grandtot = $jumTotal + $ppn + $materai ; 

          $cekMan->jumlah = $jumTotal;
          $cekMan->ppn = $ppn;
          $cekMan->materai = $materai;
          $cekMan->grandtotal = $grandtot;
          $cekMan->save();

          $notif = array(
              'message' => 'Simpan berhasil',
              'alert-tipe' => 'info',
          );



          return redirect()->route('wh.container.invoice',[$vsl,$cnt])->with($notif);
    }

    public function VesselInvPdf(Request $request,$vsl,$cnt)
    {

      $vessel     =  Vessel::where('kd_vsl',$vsl)->first();                  
      $header     =  InvManHeader::where('kd_vsl',$vsl)->where('container',$cnt)->first();
      $detail     =  InvManDetail::where('kd_vsl',$vsl)->where('container',$cnt)->get();
      
      //dd($masterDn->kd_inv);      
      $nmfile  = $header->kd_inv . $header->tipe . ".PDF";
      //dd($nmfile);
       $pdf  = PDF::loadView('wh.invoice.contpdf',[
                  'inv' => $header->kd_inv,
                  'cnt'   => $cnt,
                  'kd_vsl' => $vsl,
                  'vessel'  => $vessel,
                  'header'    => $header,                  
                  'detail'    => $detail,                  
                ])->save('wh/'.$nmfile,true); 

                $header->inv_mn = 1;
                $header->save();                       

      return redirect()->route('wh.container',[$vsl]);
    }
  
    public function VslViewData()
    {
        $vessels = Vessel::all();
        return view('wh.vessel.viewdata',['vessels'=>$vessels]);
    }
    
    public function VslExportExcel()
    {
        return Excel::download(new VesselExport, 'vessels.xlsx');
    }
 
    //1
    public function CreateInvoceManualNew($cont)
    {

      $data['cont']    = $cont;
      $data['manHd']  = InvManHeader::where('container',$cont)->first();
      $data['manDtl'] = InvManDetail::where('container',$cont)->where('kd_inv','999999')->get();
      $data['charge'] = Charge::where('dep','WH01')->orderBy('kd_charge','ASC')->get();

      return view('wh.vessel.createinvman',$data);
    }

    //2
    public function StoreInvoceManualNew(Request $request)
    {

        $this->validate($request,[
              'charge'    =>  'required',
              'keterangan' =>  'required',
              'jumlah'    =>  'required',
              'cont'    =>  'required',
        ]);


        $cont     = $request->cont;
        $cekCont  = Container::where('container', $cont)->first();

        if (!isset($kd_inv)) {

          //dd($cekCont->kd_vsl);
          $kd_inv = Helper::GenKodeInvDn($cekCont->kd_vsl);
          $invMst = [
              'kd_inv'    =>  $kd_inv, 
              'tipe'      => 'MA',
              'kd_vsl'    =>  $cekCont->kd_vsl,
              'tgl_gen'   => now(),
              'container' =>  $request->cont,
          ];
          InvManHeader::create($invMst);
        } 

            $trf = Charge::where('kd_charge',$request->charge)->where('dep','WH01')->first();
            if ($trf->no_ppn == 0 ) {
                $jumPPn = 0;
            } else {
                $jumPPn = $request->jumlah * 0.11;
            }
            $invDlt = [
              'kd_inv'      =>  $kd_inv, 
              'kd_vsl'      =>  $cekCont->kd_vsl,
              'container'   =>  $cont,
              'kd_tarif'    =>  $request->charge,
              'nama_tarif'  =>  $trf->charge,
              'keterangan'  =>  $request->keterangan,
              'jumlah'      =>  $request->jumlah,
              'ppn'         =>  $jumPPn,
              'tipe'      =>  'MA', 
            ];         
            InvManDetail::create($invDlt);

            //dd('storenew');
            return redirect()->route('wh.container.createmore',[$cont,$kd_inv]);
    }
 

        public function CreateInvoceManualMore($cont,$inv)
          {

            $data['cont']     = $cont;
            $data['kd_inv']   = $inv;
            $data['manHd']    = InvManHeader::where('container',$cont)->where('kd_inv',$inv)
                                    ->where('tipe','MA')->first();
            $data['manDtl']   = InvManDetail::where('container',$cont)->where('kd_inv',$inv)
                                    ->where('tipe','MA')->get();
            $data['charge']   = Charge::where('dep','WH01')->orderBy('kd_charge','ASC')->get();

            return view('wh.vessel.invmanmore',$data);

        }



      public function StoreInvoceManualMore(Request $request,$cont,$inv)
      {

        $this->validate($request,[
              'charge'    =>  'required',
              'keterangan' =>  'required',
              'jumlah'    =>  'required',
              'cont'    =>  'required',
        ]);

       
        $cekCont  = Container::where('container', $cont)->first();
        $trf      = Charge::where('kd_charge',$request->charge)->where('dep','WH01')->first();
         if ($trf->no_ppn == 0 ) {
                $jumPPn = 0;
            } else {
                $jumPPn = $request->jumlah * 0.11;
            }
        $invDlt   = [
            'kd_inv'      =>  $inv, 
            'kd_vsl'      =>  $cekCont->kd_vsl,
            'container'   =>  $cont,
            'kd_tarif'    =>  $request->charge,
            'nama_tarif'  =>  $trf->charge,
            'keterangan'  =>  $request->keterangan,
            'jumlah'      =>   $request->jumlah,  
            'ppn'         =>  $jumPPn,       
            'tipe'      =>  'MA', 
          ];         
          InvManDetail::create($invDlt);

        return redirect()->route('wh.container.createmore',[$cont,$inv]);        
      }

      public function EditContainerMore($vsl,$id)
      {

        $row = InvManDetail::where('id',$id)->where('tipe','MA')->first(); 
        $data['id']   = $id; 
        $data['kd_inv']   = $row->kd_inv; 
        $data['cont']   = $row->container; 
        $data['row']   =  $row;
        $data['charge']   = Charge::where('dep','WH01')->orderBy('kd_charge','ASC')->get();
        return view('wh.vessel.editmanmore',$data);

      }

      public function UpdateContainerMore(Request $request,$inv,$id)
      {

        $this->validate($request,[
              'charge'    =>  'required',
              'keterangan' =>  'required',
              'jumlah'    =>  'required',
              'cont'    =>  'required',
        ]);

        //dd($request->all());
        $row      = InvManDetail::where('id',$id)->first();        
        $trf      = Charge::where('kd_charge',$request->charge)->where('dep','WH01')->first();
        if ($trf->no_ppn == 0 ) {
                $jumPPn = 0;
            } else {
                $jumPPn = $request->jumlah * 0.11;
            }
        $row->kd_tarif    = $request->charge;  
        $row->nama_tarif  = $trf->charge;  
        $row->keterangan  = $request->keterangan;  
        $row->jumlah      = $request->jumlah;  
        $row->ppn         = $jumPPn;  
        $row->save();


        return redirect()->route('wh.container.createmore',[$row->container,$inv]);          
      }

      public function DeleContainerMore($vsl,$id)
      {

          $manDtl   = InvManDetail::where('id',$id)->first(); 
          $kd_inv = $manDtl->kd_inv;
          $manDtl->delete();
          //dd($manDtl);               
          return redirect()->route('wh.container.createmore',[$vsl,$kd_inv]);
        
      }

      public function ContainerInvPdfMore(Request $request,$cont,$inv)
      {


      $kd_vsl     =  Container::where('container',$cont)->first();  
      //dd($kd_vsl);
      $header     =  InvManHeader::where('kd_inv',$inv)->where('container',$cont)->first();
      $detail     =  InvManDetail::where('kd_inv',$inv)->where('container',$cont)->get();
      
      //UPDATE INV HEADER
      $invHd  = InvManHeader::where('kd_inv',$inv)->first();
      $jumInv = InvManDetail::where('kd_inv',$inv)->sum('jumlah');      
      $jumPPn = InvManDetail::where('kd_inv',$inv)->sum('ppn');
      $grandtotal  = $jumInv+$jumPPn;
      $materai = 0;  
      if ($grandtotal >= 5000000) {
         $materai = 10000;  
      } 
      $header->jumlah      =  $jumInv;
      $header->ppn         =  $jumPPn;
      $header->grandtotal  =  $grandtotal;
      $header->materai     =  $materai;
      $header->inv_mn = 1;
      $header->save();                       


      //dd($header->all());
      //dd($kd_vsl->kd_vsl);      
      $nmfile  = $header->kd_inv . $header->tipe . ".PDF";
      //dd($nmfile);
       $pdf  = PDF::loadView('wh.invoice.contpdf',[
                  'inv' => $header->kd_inv,
                  'cnt'   => $cont,
                  'kd_vsl' => $kd_vsl->kd_vsl,
                  'vessel'  => $kd_vsl,
                  'header'    => $header,                  
                  'detail'    => $detail,                  
                ])->save('wh/'.$nmfile,true); 

      return redirect()->route('wh.container',[$kd_vsl->kd_vsl]);      
      }


      public function ContainerInvPdfPosting($cont,$inv)
      {

        $invMan  = InvManHeader::where('kd_inv',$inv)->first();
        if ($invMan) {
          $invMan->is_posting = 1;
          $invMan->save();    
          return redirect()->route('wh.container',[$invMan->kd_vsl]);
        };
        dd('error db');
      }


}

