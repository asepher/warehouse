<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vessel;
use App\Models\Manifest;
use App\Models\Customer;
use App\Models\Container;
use App\Models\IwhHeader;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['jum_vsl']    = Vessel::whereYear('created_at','2022')->count();
        $data['jum_man']    = Manifest::whereYear('created_at','2022')->count();
        $data['jum_cont']   = Container::whereYear('created_at','2022')->count();
        $data['jum_cust']   = Customer::whereYear('created_at','2022')->count();
        $data['jum_inv']    = IwhHeader::whereYear('created_at','2022')->count();
        return view('home',$data);

    }
}
 