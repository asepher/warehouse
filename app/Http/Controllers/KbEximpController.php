<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Harian;
use App\Models\Customer;
use App\Models\KbEximp;
use Illuminate\Support\Facades\DB;
use Excel;
use Alert;


class KbEximpController extends Controller
{

  public function index()
    {

        $username = Auth::user()->username;
        $harian = KbEximp::where('username',$username)->where('kd_tr','like','KB2%')
                    ->where('is_posting',0)->orderBy('kd_tr','DESC')->get();
        $harian2 = KbEximp::where('username',$username)->where('kd_tr','like','KB2%')
                    ->where('is_posting',1)->orderBy('kd_tr','DESC')->get();
        return view('kb.eximp.index',[
                'harian'   => $harian,
                'harian2'   => $harian2,
            ]);
    }

    public function create()
    {

        $customer = Customer::all();
        return view('kb.eximp.create',[
                'customer'  =>  $customer
            ]);
    }


    public function exportToExcel()
    {
         return Excel::download(new HarianExport, 'kb-export.xlsx');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
         'tanggal'      =>  'required',  
         'matauang'     =>  'required',         
         'keterangan1'   =>  'required',
         'jumlah'       =>  'required',
         'keterangan3'   => 'required',
      ]);
    
        $getNom = DB::table('param')->where('param1',"KB02")->first();
        $nom = (int) $getNom->param2;
        $huruf = "KB2";
        $kodekb = $huruf . sprintf("%04s", $nom+1);

        KbEximp::create([
            'kd_tr'  => $kodekb,
            'tanggal'  => $request->tanggal,            
            'matauang' => $request->matauang,
            'keterangan1'  => $request->keterangan1,
            //'jumlah'  => str_replace(".","",strval($request->jumlah)),
            'jumlah'    => $request->jumlah,
            'keterangan2'  => $request->keterangan2,
            'keterangan3'  => $request->keterangan3,
            'username'      => Auth::user()->username,

        ]);

        DB::table('param')->where('param1','KB02')->update([
            'param2' => substr($kodekb, 4, 4),
        ]);

        Alert::success('Sukses', 'Data Berhasil di tambahkan');
        return redirect()->route('kb.eximp.index');
    }

    public function edit($id)
    {
         $item = KbEximp::where('kd_tr',$id)->first();
         $customer = Customer::all();
         return view('kb.eximp.edit',[
               'id'=>$id,
               'item'   => $item,
               'customer' => $customer,
            ]);
    }

    public function update(Request $request,$id)
    {

      $this->validate($request, [
         'tanggal'      => 'required',      
         'keterangan1'  => 'required',
         'jumlah'       => 'required',
         'keterangan3'  => 'required',
      ]);

      $harian = KbEximp::where('kd_tr',$id)->first();
      $harian->update([
         'tanggal'      =>  $request->tanggal,
         'tipe'         =>  $request->tipe,
         'matauang'     => $request->matauang,
         'keterangan1'  =>  $request->keterangan1,
         'jumlah'       =>  $request->jumlah,
         'keterangan2'  =>  $request->keterangan2,
         'keterangan3'  =>  $request->keterangan3,
      ]);

       // alert()->success('Sukses','Data Berhasil di update');
    //  toast('Your Post as been submited!','success');
      //Alert::success('Sukses', 'Data Berhasil di update', 'Type');
      return redirect()->route('kb.eximp.index');            
    }

    public function posting(Request $request)
    {      
         $rec = KbEximp::where('id', $request->id)->first();  
         $rec->update([
                  'is_posting' => 1,
            ]);

        //alert()->success('Sukses','Data Berhasil di posting');
        return redirect()->route('kb.eximp.index');
    }

    public function destroy($id)
    {
        KbEximp::where('kd_tr',$id)->delete();

        alert()->success('Sukses','Data Berhasil di delete');        
        return redirect()->route('kb.eximp.index');
    }




}
