<?php

namespace App\Http\Controllers;

use App\Models\box;
use App\Models\market;
use App\Models\history;
use App\Models\salary;
use App\Models\cost;
use Carbon\Carbon;
use App\Models\user;
use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class archiveController extends Controller
{
    public function archive()
    {
		$arr_market = array();
	    $arr_box = array();
		$market=market::all();
		$box=box::all();
        foreach($market as $m){
			if(Auth::user()->id==$m->user_id || Auth::user()->role_id==1){
             $arr_market[] = $m;
        }
		}
		  foreach($box as $b){
			 $market=market::find($b->market_id);
			if(Auth::user()->id==$market->user_id || Auth::user()->role_id==1){
             $arr_box[] = $b;
        }
		}
			return view('archive.archive',['box'=>$arr_box,'market'=>$arr_market]);
	}

  public function pagination_archive(Request $r){
		$start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        $box_id=(!empty($_GET["box_id"])) ? ($_GET["box_id"]) : ('');
		 $market_id=(!empty($_GET["market_id"])) ? ($_GET["market_id"]) : ('');

		$history = history::select('*')
			->where('market_id','like',$market_id."%")
			->where('box_id','like',$box_id."%")
			 ->where('removed',1)
			 ->skip($start)
			->take($length)
			->get();
		 if((!empty($_GET["start_time"]))){
			   $history = history::select('*')
			   ->where('market_id','like',$market_id."%")
			->where('box_id','like',$box_id."%")
			 ->where('removed',1)
				->whereBetween('created_at', array($start_time, $end))
				->skip($start)
				->take($length)
				->get();
				 }
				 //////////////////////
		$arr = array();
        foreach($history as $h){
			$market=market::find($h->market_id);
			$cost=cost::find($h->cost_id);
			$box=box::find($h->box_id);
			$parent=cost::find($cost->parent_id);
			$user=user::find($h->user_id);
			if(Auth::user()->id==$market->user_id || Auth::user()->role_id==1){
             $arr[] = array(
					'time' => $h->time,
					'box'=>$box->name,
					'user' => $user->username,
					'balance' => $h->amount.' $',
					'debit' => $h->debit,
					'method' => $h->method,
					'credit' => $h->credit,
					'sub' => $cost->name,
					'cat' => $parent->name,
				   'store' => $market->name,
				   'method' => $h->method,
				    'tax' => $h->tax,
					 'declared' => $h->declared,
					 'restore' => "<a href='archive/".$h->id."/restore' class='btn btn-danger'><i class='fas fa-trash'></i>Restore</a>"

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

	public function create(Request $request)
    {
		return view('archive.create');
	}
   public function restore($id)
    {
		$ar=history::find($id);
		$ar->removed=0;
		$ar->save();
		return redirect()->route('archive')->with('success','archive restore successfully');
	}


	public function store(Request $request)
    {
		$this->validate($request, [
		'time_start' => 'required',
		'time_end' => 'required',
		]);
		$arr=$request->type_name;
		foreach($arr as $a){
			if($a=="all"){
			$affected = DB::table('histories')->whereBetween('time', array($request->time_start, $request->time_end))->update(array('removed' => 1));
			$affected = DB::table('salaries')->whereBetween('time', array($request->time_start, $request->time_end))->update(array('removed' => 1));
			$affected = DB::table('debits')->whereBetween('time', array($request->time_start, $request->time_end))->update(array('removed' => 1));
			$affected = DB::table('goods')->whereBetween('time', array($request->time_start, $request->time_end))->update(array('removed' => 1));
			$affected = DB::table('works')->whereBetween('created_at', array($request->time_start, $request->time_end))->update(array('removed' => 1));
			break;
			}
			$affected = DB::table($a)->whereBetween('time', array($request->time_start, $request->time_end))->update(array('removed' => 1));
		}


		return redirect()->route('archive')->with('success','archive create successfully');
        //
    }
}
