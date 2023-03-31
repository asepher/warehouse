<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harian;
use Illuminate\Support\Facades\DB;
use App\Exports\HarianExport;
use Excel;
//use Alert;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class KbController extends Controller
{
  public function index()
    {

        $username = Auth::user()->username;
        $harian = Harian::where('username',$username)->where('kd_tr','like','KB1%')
                    ->where('is_posting',0)->orderBy('kd_tr','DESC')->get();
        $harianposting = Harian::where('username',$username)->where('kd_tr','like','KB1%')
                    ->where('is_posting',1)->orderBy('kd_tr','DESC')->get(); 


        //Alert::success(session('success'));
        //Alert::success('Success Title', 'Success Message');
       //alert()->success('Load', 'Loading Data ...');


        return view('kb.index',[
                'harian'   => $harian,
            ]);
    }

    public function create()
    {
      return view('kb.create');
    }


    public function exportToExcel()
    {
         return Excel::download(new HarianExport, 'kb-export.xlsx');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
         'tanggal'      =>  'required',
         'tipe'         =>  'required',         
         'keterangan1'   => 'required',
         'jumlah'       =>  'required',
         'keterangan3'   => 'required',
      ]);
    
        $getNom = DB::table('param')->where('param1',"KB01")->first();
        $nom = (int) $getNom->param2;
        $huruf = "KB1";        
        $kodekb = $huruf . sprintf("%04s", $nom+1);
        $debit = 0 ; $kredit = 0;
        if ($request->tipe == 'Debit') {
          $debit = $request->jumlah;
          $kredit = 0;
        }
        if ($request->tipe == 'Kredit') {
          $debit = 0;
          $kredit = $request->jumlah;          
        }
        $data = [
            'kd_tr'  => $kodekb,
            'tanggal'  => $request->tanggal,
            'tipe'  => $request->tipe,
            'matauang' => 'Rp',
            'keterangan1'  => $request->keterangan1,         
            'keterangan2'  => $request->keterangan2,
            'keterangan3'  => $request->keterangan3,
            //'jumlah'  => str_replace(".","",strval($request->jumlah)),   
            'debit'        => $debit,   
            'kredit'       => $kredit,   
            'jumlah'    => $debit+$kredit,
            'username'      => Auth::user()->username,
        ];
        Harian::create($data);

        DB::table('param')->where('param1','KB01')->update([
            'param2' => substr($kodekb, 4, 4),
        ]);
 
        //Alert::success('Sukses', 'Data Berhasil di tambahkan');
        return redirect('kb');
    }

    public function edit($id)
    {
         $item = Harian::where('kd_tr',$id)
                        ->where('username',Auth::user()->username)->first();
         return view('kb.edit',[
               'id'     =>$id,
               'item'   => $item,
            ]);
    }

    public function update(Request $request,$id)
    {

      $this->validate($request, [
         'tanggal'      => 'required',
         'tipe'         => 'required',
         'keterangan1'  => 'required',
         'jumlah'       => 'required',
         'keterangan3'  => 'required',
      ]);

      $harian = Harian::where('kd_tr',$id)->first();
      $harian->update([
         'tanggal'      =>  $request->tanggal,
         'tipe'         =>  $request->tipe,
         'keterangan1'  =>  $request->keterangan1,
         'jumlah'       =>  $request->jumlah,
         'keterangan2'  =>  $request->keterangan2,
         'keterangan3'  =>  $request->keterangan3,
      ]);

        //alert()->success('Sukses','Data Berhasil di update');
    //  toast('Your Post as been submited!','success');
      Alert::success('Sukses', 'Data Berhasil di update', 'Type');
      //->with('Update', 'Update Data Successfully!')
      return redirect()->route('kb.index');            
    }

    public function posting(Request $request)
    {      
         $rec = Harian::where('id', $request->id)->first();  
         $rec->update([
                  'is_posting' => 1,
          ]);

        //alert()->success('Sukses','Data Berhasil di posting');

        Alert::success('Loading', 'Posting Data Sukses!..');
        return redirect()->route('kb.index');
    }

    public function Unposting(Request $request)
    {
         $rec = Harian::where('id', $request->id)->first();  
         $rec->update([
                  'is_posting' => 0,
          ]);
        //alert()->success('Sukses','Data Berhasil di posting');

        Alert::success('Loading', 'Unposting  sukses ...');
        return redirect()->route('kb.index');


    }

    public function destroy($kd_tr)
    {


        Harian::where('kd_tr',$kd_tr)->delete();

        alert()->success('Sukses','Data Berhasil di delete');        
        return redirect()->route('kb.index');
    }

    public function HarianView()
    {

        $username = Auth::user()->username;
        $harian = Harian::where('username',$username)->where('kd_tr','like','KB1%')
                    ->where('is_posting',1)->orderBy('kd_tr','DESC')->get();      
        return  view('kb.harian.view_index',[
                'harian'   => $harian,
            ]);
    }

}
