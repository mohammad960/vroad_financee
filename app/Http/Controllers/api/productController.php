<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use DB;
class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return product::all();
        //
    }
  public function byId(Request $r)
    {
		return product::find($r->id);
        //
    }
	
	public function ByAtt(Request $r)
    {
		if(isset($r->category_id) && isset($r->client_id) && !isset($r->city)){
			return product::where('category_id',$r->category_id)->where('client_id',$r->client_id)->get();
		}
		if(isset($r->category_id) && isset($r->client_id) && isset($r->city)){
			return product::where('category_id',$r->category_id)->where('client_id',$r->client_id)->where('city',$r->city)->get();
		}
		if(!isset($r->category_id) && isset($r->client_id) && isset($r->city )){
			return product::where('client_id',$r->client_id)->where('city',$r->city)->get();
		}
		if(isset($r->category_id) && !isset($r->client_id) && isset($r->city)){
			return product::where('category_id',$r->category_id)->where('city',$r->city)->get();
		}
		if(!isset($r->category_id) && !isset($r->client_id) && isset($r->city)){
			return product::where('city',$r->city)->get();
		}
			if(!isset($r->category_id) && isset($r->client_id) && !isset($r->city )){
			return product::where('client_id',$r->client_id)->get();
		}
		if(isset($r->category_id) && !isset($r->client_id) && !isset($r->city)){
			return product::where('category_id',$r->category_id)->get();
		}
        //
    }
	
	public function randomSearch(Request $r)
    {
		$res=DB::select(" select * from (select products.* from products join categories on products.category_id =categories.id  where categories.name like '%".$r->search."%') as s");
		return $res;
        //
    }
	
	public function city()
    {
		$res=DB::select(" select DISTINCT city from products");
		return $res;
        //
    }
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
