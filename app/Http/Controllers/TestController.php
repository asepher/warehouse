<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;



class TestController extends Controller
{
    public function jquery()
    {
        return view('test.jquery');
    }  
    public function jquery2()
    {
        return view('test.jquery2');
    }

    public function AjaxCrud()
    {
        $tarif = Tarif::all();
        return view('ajax.index')->with(compact('tarif'));
    }

    public function addItem(Request $request) {
        $rules = array (
                'name' => 'required'
        );
        $validator = Validator::make ( Input::all (), $rules );
        if ($validator->fails ())
            return Response::json ( array (
                        
                    'errors' => $validator->getMessageBag ()->toArray ()
            ) );
            else {
                $data = new Data ();
                $data->name = $request->name;
                $data->save ();
                return response ()->json ( $data );
            }
    }

    public function jqueryIndex()
    {

        return view('jquery.index');

    }

    public function jqueryDropdown()
    {
        return view('jquery.dropdown');
    }
}
