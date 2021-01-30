<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar;
use App\Models\User;
use App\Models\supplier;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
    public function sidebar(){
        return Sidebar::all();
    }

    public function index(){
        $sidebar = $this ->sidebar();
        
        return view('sale',compact('sidebar'));
    }
    //cashier page
    public function casher(){
        $sidebar = $this ->sidebar();
        $cashiers = User::all();
        return view('casher',compact('sidebar', 'cashiers'));
    }
    public function AddCasher(Request $request ){
        $validator = \Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required',
            'password'=> 'required',
            'rule'=> 'required'
            ]);
            if($validator->fails()){
            return redirect('casher')->withErrors($validator);
        }else{
           $create_user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rule' => $request->rule
            ]);
            return $create_user ? redirect('casher')->with('result','Cashier Added Successfully'):redirect('casher')->with('result','Internal Error Occured');
        }
    }
    
    // Supplier Page
    public function supplier(){
        $sidebar = $this->sidebar();
        $supplier = supplier::all();
        return view('supplier', compact('sidebar','supplier'));
    }
    public function AddSupplier($status,$id, Request $request ){
        if($status ==0){
            $validator = \Validator::make($request->all(),[
                'name' => 'required',
                'email'=> 'required',
                'address'=> 'required',
                'phonenumber'=> 'required'
                ]);
                if($validator->fails()){
                    return redirect('supplier')->withErrors($validator);
                }else{
                   $supplier =  supplier::create([
                        'company_name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phonenumber' => $request->phonenumber
                    ]);
                }
        }elseif($status == 1 && !empty($status) && !empty($id)){
            $supplier = supplier::findOrfail($id);
            $supplier->delete();
        }else {
            # code...
        }
        
           
            return $supplier ? redirect('supplier')->with('result','Supplier Added Successfully'):redirect('supplier')->with('result','Internal Error Occured');
        
    }
}
