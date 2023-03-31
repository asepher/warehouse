<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\User;
use DataTables;

class DataTableController extends Controller
{
    public function index(Request $request)
    {
      
      $data = Customer::latest()->get();   
      return view('datatable.index',[
               'data'   => $data,
         ]);

    }  

    public function index1(Request $request)
    {

         if ($request->ajax()) {
            $data = Customer::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
 
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('datatable.index');

    }


    public function chosen()
    {

        return view('datatable.chosen');
    }

  

}
