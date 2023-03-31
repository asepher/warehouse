<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;

class ChargeController extends Controller
{
    public function index()
    {
        $charge = Charge::OrderBy('kd_charge', 'ASC')->get();
        return view('charge.index',[
                    'charge' => $charge
               ]);
    }


    public function store(Request $request)
    {
         $this->validate($request, [
            'kd_charge'     =>  'required|unique:charges|min:4|max:4',
            'charge'        =>  'required',
            'ppn'           =>  'required'
            ]);        
         $dtchg = [
               'kd_charge'  => $request->kd_charge,
               'charge'     => $request->charge,
               'ppn'        => $request->ppn,
               'dep'        =>  'SI01',
            ];
         Charge::create($dtchg);
         return redirect()->route('charge');
    }

    public function edit($id)
    {


        $row = Charge::where('id',$id)->first();
        return view('charge.edit',[
               'id'  => $id,
               'row' => $row,    
            ]);
    }

    public function update(Request $request)
    {
         $this->validate($request, [
            'kd_charge'     =>  'required|min:4|max:4',
            'charge'        =>  'required',
            'ppn'           =>  'required'
         ]);           
         //dd($request->all());
         $row = Charge::where('id',$request->id)->first();
         $row->charge = $request->charge;
         $row->ppn = $request->ppn;         
         $row->save();

         return redirect()->route('charge.index')->with(['success' => 'Update Sukses' ]);;



    }

}
