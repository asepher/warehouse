<?php

namespace App\Http\Controllers\Si;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiSoa;

class SoaController extends Controller
{
    public function soaIndex()
    {
       
         $data['soa'] = SiSoa::all();
         return view('si.soa.index',$data);
    }
}
