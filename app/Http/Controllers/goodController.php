<?php

namespace App\Http\Controllers;

use App\Models\good;
use Illuminate\Http\Request;
use Auth;
use DB;
use Image;
use Storage;
use App\Models\market;
use App\Models\box;
use App\Models\user;
class goodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
		}
		else{
				$markets_user=user::find(Auth::user()->id)->market_id;
				$markets=market::where('id',$markets_user)->where('removed',0)->get();

		}
		 return view('good.index',["markets"=>$markets]);


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
	public function details()
    {
	   if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
		}
		else{
			   $markets_user=user::find(Auth::user()->id)->market_id;
				$markets=market::where('removed',0)->where('id',$markets_user)->get();
		}
		return view('good.details',["market"=>$markets]);
        //
    }
	 public function pagination_ajax(Request $r){
		$start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');

		 $market_id=(!empty($_GET["market_id"])) ? ($_GET["market_id"]) : ('');

		$good = good::select('*')
			->where('market_id','like',$market_id."%")
			->where('removed',0)
			 ->skip($start)
			->take($length)
			->get();
		 if((!empty($_GET["start_time"]))){
			   $good = good::select('*')
			    ->where('removed',0)
			   ->where('market_id','like',$market_id."%")
				->whereBetween('created_at', array($start_time, $end))
				->skip($start)
				->take($length)
				->get();
				 }



		//////////////////////
		$arr = array();
        foreach($good as $h){
			$market=market::find($h->market_id);

			$user=user::find($h->user_id);
			if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
             $arr[] = array(
					'time' => $h->time,
					'user' => $user->username,
					'balance' => $h->amount.' $',

				   'store' => $market->name,
				    'action' => "<div class='row'>
                            <a href='good/".$h->id."/edit' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a><div style='margin-left: 2em;'></div>
						<a href='good/".$h->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>
                            ",

            );
        }
		}

        $count1 = DB::select("select * from goods ");

        $recordsFiltered = count($count1);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $recordsFiltered,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$good=new good();
		if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
		}
		else{
				$markets_user=user::find(Auth::user()->id)->market_id;
				$markets=market::where('id',$markets_user)->where('removed',0)->get();

		}
		$good->amount=$request->amount;

		$good->market_id=$markets[0]->id;
		$good->user_id=Auth::user()->id;
		$good->time=$request->time;
			if( $request->hasFile('image'))
                {
                    $img = $request->file('image');
                    $filename =  $good->id.$img->getClientOriginalName();
                    $good->image=$filename;
                    $location = storage_path('app/public/') . $filename;
                    Image::make($img)->save($location);
                }
		$good->save();
		return redirect()->route('viewCost')->with('success','good update successfully')->with('tab','good');	;
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\good  $good
     * @return \Illuminate\Http\Response
     */
    public function show(good $good)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\good  $good
     * @return \Illuminate\Http\Response
     */
    public function edit(good $good)
    {
		return view('good.edit',['good'=>$good]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, good $good)
    {
		$good->time=$request->time;
		$good->amount=$request->amount;
		$good->user_id=Auth::user()->id;
		$good->save();
		return redirect()->route('detailsGood')->with('success','good update successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $good = good::find($id);
         $good -> removed=1;
		 $good->save();
		return redirect()->route('detailsGood');
    }
}
