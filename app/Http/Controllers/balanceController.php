<?php

namespace App\Http\Controllers;
use App\Models\box;
use App\Models\market;
use App\Models\history;
use App\Models\salary;
use App\Models\employee;
use App\Models\cost;
use App\Models\type_cost;

use Carbon\Carbon;
use App\Models\user;
use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class balanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function balance()
    {
		$arr_market = array();
	    $arr_box = array();
		$market=market::where('removed',0)->get();
		$box=box::where('removed',0)->get();
        foreach($market as $m){
			$market=market::find($m->id);
			if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
				   $arr_market[] = $m;
			}
		}
		  foreach($box as $b){
			 $market=market::find($b->market_id);
			if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
             $arr_box[] = $b;
        }
		}
		$cost=cost::where('removed',0)->whereRaw('parent_id = type_id')->get();
	   return view('balance.details',['box'=>$arr_box,'market'=>$arr_market,'cat'=>$cost]);
	}
///////////////////////////////////////
public function pagination_balance(Request $r){
		$start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        $group=(!empty($_GET["group"])) ? ($_GET["group"]) : ('');

		$history = history::select('*');

		$history =DB::table('histories')
			->select('type',$group,DB::raw("SUM(amount) as sum"))
			->groupBy('type',$group)->where('removed',0);


		if((!empty($_GET["start_time"]))){
			   $history = $history
				->whereBetween('time', array($start_time, $end));
				}

		$history=$history->get();
		//////////////////////
		$arr_group=[];
		foreach($history as $h){
			if(!in_array($h->$group,$arr_group)){
					$arr_group[]=$h->$group;
			}
		}
		$all=array();
		foreach($arr_group as $a){
					$obj = (object)[];
					$obj->$group=$a;
					$obj->total_in=0;
					$obj->total_ex=0;
					$obj->balance=0;
					foreach($history as $h){
						if($a==$h->$group){
								if($h->type!=3){
									$obj->total_ex=$obj->total_ex-$h->sum;
									$obj->balance=$obj->balance-$h->sum;
								}
								else{
									$obj->total_in=$obj->total_in+$h->sum;
									$obj->balance=$obj->balance+$h->sum;
								}
						}

		}
		$all[]=$obj;
		}


		$arr = array();

        foreach($all as $h){
			if($group=="market_id"){
				$market=market::find($h->market_id);
				$show=0;
				$name="";
				if($market){

					if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
						$show=1;
					}
					$name=$market->name;
				}
				else{
					$show=1;
				}
			}
			if($group=="box_id"){
				$box=box::find($h->box_id);
				$market=market::find($box->market_id);
				$show=0;
				$name="";
				if($market){

					if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
						$show=1;
					}
					$name=$box->name;
				}
				else{
					$show=1;
				}
			}



			if($show==1){
             $arr[] = array(
                'group' => $name,
                'total_in' => round($h->total_in,2).' $',
                'total_ex' => round($h->total_ex,2).' $',
                'balance' => round($h->balance,2).' $',


				'edit' => "<a  class='btn btn-info' id='imageShow'><i class='fas fa-info'></i>Image</a>"
            );
			}
		}

        $count1 = DB::select("select * from histories ");

        $recordsFiltered = count($count1);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $recordsFiltered,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
 }





  public function sheet()
    {
		$history =DB::table('histories')
			->select('type','market_id','cost_id','tax',DB::raw("SUM(amount) as sum"))
			->groupBy('type','market_id','cost_id','tax')->where('removed',0);
		$start=$_GET['start'];
		$end=$_GET['end'];
		$store=$_GET['store'];
		if((!empty($_GET["start"]))){
			   $history = $history
			   ->whereDate('time', '=', $start);
				$yestarday=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $start) ) ));
				$history_yestarday =DB::table('histories')
				->select('type','market_id','cost_id','tax',DB::raw("SUM(amount) as sum"))
				->groupBy('type','market_id','cost_id','tax')->where('removed',0)->where('cost_id','39')->whereDate('time', '=', $yestarday)->get();
				}

		$history=$history->get();
		$total_in=0;
		$total_out=0;
		$balance=0;
		foreach($history as $h){
			if($store!=$h->market_id){
				continue;
			}
				$market=market::find($h->market_id);
				$cost=cost::find($h->cost_id);

				$show=0;
				$name="";
				if($market){

					if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
						$show=1;
					}
					$name=$market->name;
				}
				else{
					$show=1;
				}


			if($show==1){
				$data['market']=$market->name;
				$arr[] = array(
					'market' => $market->name,
					'sum' => $h->sum,
					'cost' => $cost->name,
					'type' => $h->type,
					'tax' => $h->tax,
            );

			$data[$cost->name.$h->tax]=$h->sum;
			if($h->type==3){$total_in=$total_in+$h->sum;}
			if($h->type==2){$total_out=$total_out+$h->sum;}
			}
		}
		try{
			$data['Cash In Hand yestarday']=$history_yestarday[0]->sum;
		}catch(\Exception $e){
			$data['Cash In Hand yestarday']=0;
		}
		$data['total_in']=$total_in+$data['Cash In Hand yestarday'];
		$data['total_out']=$total_out;
		$data['balance']=$data['total_out']-$data['total_in'];
		$data['Date']=$start;

		return view('balance.sheet',['data'=>$data]);
        //
    }








//////////////
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
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function show(history $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(history $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, history $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(history $history)
    {
        //
    }
}
