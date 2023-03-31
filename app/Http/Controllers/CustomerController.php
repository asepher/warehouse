<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\User;

use DataTables;

use Alert;

class CustomerController extends Controller
{

    public function index()
    {

//$brands = Brand::latest()->paginate(2);
//return view('brands.index', compact('brands'));

        $customer = Customer::latest()->get();
        return view('customer.index',[
                'customer' => $customer,
            ]);
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'customer'  =>  ['required','unique:customers'],
            'address'   =>  'required',
            'email'     =>  'required',
            'contact'   =>  'required',
            'npwp'      =>  'required|unique:customers|min:14',

        ]);


        //return $request->all();
        if (isset($request->forwader)) {
             $forwader = 1;
        } else {
            $forwader = 0;
        }
        if (isset($request->consignee)) {
             $consignee = 1;
        } else {
            $consignee = 0;            
        }
        if (isset($request->agent)) {
             $agent = 1;             
        } else {
            $agent = 0;            
        }
        

        $rec = DB::table('param')->where('param1',"CUST")->first();        
        $nom = (int) $rec->param2;
        $huruf = $rec->param3;
        $kd_cus = $huruf . sprintf("%04s", $nom+1);

        $dtcus = [
            'kd_cus'    =>  $kd_cus,
            'customer'  =>  $request->customer,
            'address'   =>  $request->address,
            'email'     =>  $request->email,
            'pic'       =>  $request->contact,
            'npwp'      =>  $request->npwp,
            'username'  =>  Auth::user()->username,            
            'forwader'  =>  1,
            'consignee' =>  $consignee,
            'agent'     =>  $agent,            
        ];   
        //dd($dtcus);            
        Customer::create($dtcus);

        DB::table('param')->where('param1','CUST')->update([
            'param2' => substr($kd_cus, 2, 4),
        ]);

        //request->session()->put('success','TRUE');

        //return  $dtcus;
       

        //Alert::success('Sukses', 'Data  berhasil di tambahkan');
        return redirect()->route('customer.index');
    }

    public function show($id)
    {
     
         $customer = Customer::where('kd_cus', $id)->first();        
        return view('customer.show',[
                'customer'  =>  $customer,
                'id'    =>  $id
            ]);

    }

    public function edit($id)
    {
        $customer = Customer::where('kd_cus', $id)->first(); 
        if (!$customer) {
           dd('error data');
        }              
        return view('customer.edit',[
                'customer'  =>  $customer,
                'id'    =>  $id
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer'  =>  'required',
            'address'    =>  'required',
            'email'     =>  'required',
            'contact'   =>  'required',
            'npwp'      =>  'required',
        ]);

        if (isset($request->forwader)) {
             $forwader = 1;
        } else {
            $forwader = 0;
        }
        if (isset($request->consignee)) {
             $consignee = 1;
        } else {
            $consignee = 0;            
        }
        if (isset($request->agent)) {
             $agent = 1;             
        } else {
            $agent = 0;            
        }
        

        $row = Customer::where('kd_cus',$id)->first();
        $row->customer = $request->customer;
        $row->address = $request->address;
        $row->email = $request->email;
        $row->pic = $request->contact;
        $row->npwp = $request->npwp;

        $row->save();

        //Alert::success('Sukses', 'Data  berhasil di update');
        return redirect()->route('customer.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kd_cus)
    {

        dd($kd_cus);
        $row = Customer::where('kd_cus', $kd_cus)->first(); 
        if (!$row) {
            dd('Error page');
        }
        $row->delete();
        $customer = Customer::latest()->get();
        Alert::success('Sukses', 'Data  berhasil di delete');
        return view('customer.index',[
            'customer' => $customer
        ]);
    }


    public function list(Request $request)
    {

         //dd($request->all());
        if ($request->ajax()) {
           $data = Customer::latest()->get();
           return Datatables::of($data)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])                 
                    ->make(true);
        }
        return view('customer.list');

    }

    public function listDatatable(Request $request)
    {

         //dd($request->all());
        if ($request->ajax()) {
           $data = Customer::latest()->get();
           return Datatables::of($data)
                    ->make(true);
        }
        return view('customer.list_datatable');

    }




}
