<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\market;
use App\Models\box;
class initController extends Controller
{
	
	public function index(){
		$s=3;
		$t=1;
		$c=2;
	return view('home',["s"=>$s,"t"=>$t,"c"=>$c]);
	}
	public function chart(){
		
		$markets=market::all();
		$box=box::all();
		return view('home',["markets"=>$markets,"box"=>$box]);
	}
	
    //
}
