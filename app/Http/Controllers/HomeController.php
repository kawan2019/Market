<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar;
use App\Models\User;
use App\Models\supplier;
use App\Models\stocks;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\sold;
use Illuminate\Support\Facades\Auth;

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
        $supplier = supplier::paginate(20);
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
                    return $supplier ? redirect('supplier')->with('result','Supplier Added Successfully'):redirect('supplier')->with('result','Internal Error Occured');
                }
        }elseif($status == 1 && !empty($status) && !empty($id)){
            $supplier = supplier::findOrfail($id);
            $supplier->delete();
            return $supplier ? redirect('supplier')->with('result','Supplier Deleted Successfully'):redirect('supplier')->with('result','Internal Error Occured');
        }else {
            $validator = \Validator::make($request->all(),[
                'name' => 'required',
                'email'=> 'required',
                'address'=> 'required',
                'phonenumber'=> 'required'
                ]);
                if($validator->fails()){
                    return redirect('supplier')->withErrors($validator);
                }else{
                   $supplier =  supplier::where('id',$id)->update([
                        'company_name' => $request->name,
                        'email' => $request->email,
                        'address' => $request->address,
                        'phonenumber' => $request->phonenumber
                    ]);
                    return $supplier ? redirect('supplier')->with('result','Supplier Update Successfully'):redirect('supplier')->with('result','Internal Error Occured');
                }
        }
    }
    //Buy Page
    public function buy(){
        $sidebar =$this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::with('one_supplier')->orderBy('id','DESC')->paginate(20);
        return view('stocks' , compact('sidebar', 'stocks','suppliers'));
    }
    public function addStock($status,$id, Request $request){
        $requires = [
            'id' => 'required',
            'name' => 'required',
            'supplier_id'=> 'required',
            'count'=> 'required',
            'price'=> 'required',
            'expire_date'=> 'required',
            'is_debt'=> 'required',
            'type'=> 'required',];
        $fill = [
            'id' => $request->id,
            'name' => $request->name,
            'supplier_id'=> $request->supplier_id,
            'count'=> $request->count,
            'price'=> $request->price,
            'expire_date'=> $request->expire_date,
            'is_debt'=> $request->is_debt,
            'type'=> $request->type,
        ];
        if($status ==0){
            $validator = \Validator::make($request->all(),$requires);
                if($validator->fails()){
                    return redirect('buy')->withErrors($validator);
                }else{
                   $status =  stocks::create($fill);
                    return $status ? redirect('buy')->with('result','Supplier Added Successfully'):redirect('buy')->with('result','Internal Error Occured');
                }
        }elseif($status == 1 && !empty($status) && !empty($id)){
            $stocks = stocks::findOrfail($id)->delete();
            return $stocks ? redirect('buy')->with('result','Supplier Deleted Successfully'):redirect('buy')->with('result','Internal Error Occured');
        }else {
            $validator = \Validator::make($request->all(),$requires);
                if($validator->fails()){
                    return redirect('buy')->withErrors($validator);
                }else{
                   $stocks =  stocks::where('id',$id)->update($fill);
                    return $stocks ? redirect('buy')->with('result','Supplier Update Successfully'):redirect('buy')->with('result','Internal Error Occured');
                }
        }
    }
    public function notLeft(){
        $sidebar =$this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('count','<',5)->with('one_supplier')->orderBy('id','DESC')->paginate(20);
        return view('notleft',compact('sidebar','stocks','suppliers'));
    }

    public function debtList(){
        $sidebar =$this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('is_debt',1)->with('one_supplier')->orderBy('id','DESC')->paginate(20);
        return view('debtlist',compact('sidebar','stocks','suppliers'));
    }

    public function expire(){
        $sidebar =$this->sidebar();
        $suppliers = supplier::all();
        $stocks = stocks::where('expire_date','<=' ,Carbon::today())->with('one_supplier')->orderBy('id','DESC')->paginate(20);
        return view('expire',compact('sidebar','stocks','suppliers'));
    }
    public function seller(){
        $lists = [
            'All Picecs' => sold::where('clean',1)->sum('piece'),
            'All Price' => sold::where('clean',1)->sum('price_at'),
            'All Picecs Today' => sold::where(['clean'=>1,'created_at' =>Carbon::today()] )->sum('piece'),
            'All Price Today' => sold::where(['clean'=>1,'created_at' =>Carbon::today()])->sum('price_at'),
        ];
        $sidebar =$this->sidebar();
        $sold = sold::where('clean' ,1)->orderBy('id','DESC')->paginate(40);
        return view('seller',compact('sidebar' , 'sold','lists'));
    }
    public function sale(){
        $sidebar =$this->sidebar();
        return view('sale',compact('sidebar'));
    }
    public function getSale(Request $request){
        if(empty($request->id)){
            exit("Code is empty");
        }
        $stock = stocks::find($request->id);
        if($stock){
            if($stock->count!=0){
                if($stock->expire_date> Carbon::today()){
                    $stock->count = $stock->count-1;
                    $stock->save();
                    $find_sold =sold::where(['user_id'=>Auth::id(),'stock_id'=>$stock->id,'clean'=>0])->first();
                    if($find_sold == null){
                        $sold =sold::create([
                            'user_id' =>Auth::id(),
                            'stock_id' => $stock->id,
                            'clean' => 0,
                            'price_at' => $stock->price,
                            'piece' => 1,

                        ]);
                        return $sold ? "success" : "somthing went worng !";

                    }else {
                        
                        $find_sold->piece =$find_sold->piece +1;
                        $find_sold->save();
                        return "success";
                    }
                }else{
                    exit("The prodact is expire");
                }
            }else {
                exit("the prodact no avilable");
            }
        }else {
            exit("Not found");
        }
    }
    public function viewtb(){
        $sold = sold::where(['user_id' => Auth::id(),'clean' => 0])->orderBy('updated_at','DESC')->get();
        return view('layout.table', compact('sold') );
    }
    public function undo(Request $request){
        $find_sold = sold::find($request->sold_id);
        if($find_sold){
            $find_stock = stock::find($find_stock->stock_id);
            if($find_stock){
                $find_stock->count = $find_stock->count +1;
                $find_stock->save();
                if($find_sold->piece == 1){
                    $find_sold->delete();
                }else{
                    $find_sold->piece = $find_sold ->piece -1;
                    $find_sold->save();
                }
                return "success";
                
            }else{
                exit("Fail");
            }
        }else{
            exit("Fail");
        }
    }
}
