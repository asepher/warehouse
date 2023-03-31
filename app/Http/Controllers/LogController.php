<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dtLog;

class LogController extends Controller
{
    public function DataLog()
    {
        $data['logs'] = [];
        return view('wh.log.index',$data);
    }
    public function LogSearch(Request $request)
    {
        //dd($request->all());
        $data['logs'] = dtLog::where('inv',$request->invoice)->orderBy('updated_at','DESC')->get();
        return view('wh.log.index',$data);
    }
}
