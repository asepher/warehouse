<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;

class TarifController extends Controller
{
    public function index()
    {
        $tarif = Tarif::all();
        return view('tarif.index',[
            'tarif' =>  $tarif,
        ]);
    }

    public function store(Request $request)
    {

      //dd($request->all());
         $this->validate($request, [
            'kd_tarif'  =>  'required|numeric|unique:tarif|min:3',
            'item'      =>  'required',
            'jumlah'    =>  'required',
            'ppn'       =>  'required',
            'term'       =>  'required',
            ]);
          
         $dttarif = [
               'kd_tarif'  => $request->kd_tarif,
               'term'      => $request->term,
               'nama_tarif'      => $request->item,               
               'jumlah'    => $request->jumlah,
               'ppn'       => $request->ppn,
            ];           
         Tarif::create($dttarif);

         alert()->success('Yess!','Data Berhasil di tambah');         
         return redirect()->route('tarif.index');
    }    

    public function edit($id)
    {
      

         $tarif = Tarif::where('id', $id)->first();        
         return view('tarif.edit',[
                'tarif'  =>  $tarif,
                'id'    =>  $id
            ]);

    }


    public function update(Request $request)
    {

         $item = Tarif::where('id',$request->id)->first();
            $item->update([
            'kd_tarif'  =>  $request->kd_tarif,
            'nama_tarif'      =>  $request->item,
            'jumlah'    =>  $request->jumlah,
            'ppn'       =>  $request->ppn,
            'term'      =>  $request->term,
         ]);

         alert()->success('Sukses','Data Berhasil di update');
         return redirect()->route('tarif.index');  

    }

}
