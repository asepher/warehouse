<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Negara;

use Alert;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    public function index()
    {
        $country = Negara::all();
        return view('country.index',[
                    'country' => $country
               ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            'kd_neg'      =>  'required|unique:negara|min:3|max:3',
            'negara'    =>  'required|unique:negara'
            ]);
          
         $dtneg = [
               'kd_neg'    => $request->kd_neg,
               'negara'    => $request->negara,
            ];
         Negara::create($dtneg);
         return redirect()->route('country.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $neg = Negara::where('id',$id)->first();
        return view('negara.edit',[ 'neg' => $neg  ,'id' => $id ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'negara'    =>  'required|unique:negara'
            ]);

        $neg = Negara::where('id',$id)->first();
        $neg->kd_neg = $request->kd_neg;
        $neg->negara    =   $request->negara;
        $neg->save();
        return redirect()->route('country');
    }

    public function destroy($id)
    {
      
         Negara::where('id',$id)->delete();
         alert()->success('Sukses','Data Berhasil di delete');                 
         return redirect()->route('country');
    }    
}
