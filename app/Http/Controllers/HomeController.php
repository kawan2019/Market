<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar;

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
}
