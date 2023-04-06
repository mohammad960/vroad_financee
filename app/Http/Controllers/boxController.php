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
class boxController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = box::select('*')
        ->where('name','like','%'.$search['value'].'%')
		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
					$market=market::find($d->market_id);
                    $status = $d->disable?"Active":"Disable";

			$show=0;
			$market_name="";
			if($market){

				if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
					$show=1;
				}
				$market_name=$market->name;

			}
			else{
				$show=1;
			}
			if($show==1){
             $arr[] = array(

                'name' => $d->name,
                'number' => $d->number,
				  'balance' => $d->balance.' $',
				    'type' => $d->type,
					'amount' => $d->amount.' $',
					'market' => $market->name,
					'disable' => $d->disable==1?'Yes':'No',
                'action' => "<div class='row'>
					<a href='box/".$d->id."/disable' style='color:#377CDB;'><i class='fa fa-ban'></i>".$status. "</a><div style='margin-left: 2em;'></div>
                            <a href='box/".$d->id."/edit' style='color:#377CDB;' ><i class='fas fa-edit'></i> Edit</a>

                            </div> ",
                'delete' => "<a href='box/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i> Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = box::count();
        $count = DB::select("select * from boxes where name like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('box.index');
    }
 public function disable($id)
    {
			if(Auth::user()->role_id!=1){
				return redirect()->route('box.index')->with('success','permission denied');
			}

			$box=box::find($id);
			if($box->disable==1){
				$box->disable=0;
			}
			else{
				$box->disable=1;
			}
			$box->save();
			return redirect()->route('box.index')->with('success','Fund '.$box->name.' update successfully');
        //
        //
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$market=market::where('removed',0)->get();
		return view('box.create',['markets'=>$market]);
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
		$this->validate($request, [
		'name' => 'required|unique:boxes',
        'amount' => 'required',
        'number' => 'required|integer',
        'type' =>'nullable|string|min:2|max:255',


		]);

        $data = $request->all();
        $data['amount'] = round($data['amount'], 2);

		box::create( $data);

		return redirect()->route('box.index')->with('success','Fund '.$request->name.' create successfully');
        //
    }
	public function details()
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
	   return view('box.details',['box'=>$arr_box,'market'=>$arr_market,'cat'=>$cost]);
	}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$box=box::find($id);
		$now = Carbon::now();
		$weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
		$weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');


		$history = history::select('*')
		 ->where('removed',0)
		->where('box_id',$id)

        ->get();
		///// salary //////
		$salary = salary::select('*')
		 ->where('removed',0)
		->where('box_id',$id)

        ->get();



		//////////////////////
		$arr = array();
        foreach($history as $h){
			$market=market::find($h->market_id);
			$cost=cost::find($h->cost_id);
			$parent=cost::find($cost->parent_id);
			$user=user::find($h->user_id);
			if(Auth::user()->id==$market->user_id || Auth::user()->role_id==1){
             $arr[] = array(
					'time' => $h->time,
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

            );
        }
		}
		foreach($salary as $s){
			$market=market::find($s->market_id);

			if(Auth::user()->id==$market->user_id || Auth::user()->role_id==1){
             $arr[] = array(
					'created_at' => $s->created_at,
					'amount' => $s->amount,
					'cost' => 'salary',

            );
        }
		}
		return view('box.show',['box'=>box::all(),'history'=>$arr]);
    }
 //////////////////////////////// Archive ///////////////////

 ////////////////////
 public function pagination_show(Request $r){
		$start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        $box_id=(!empty($_GET["box_id"])) ? ($_GET["box_id"]) : ('');
		$market_id=(!empty($_GET["market_id"])) ? ($_GET["market_id"]) : ('');
		$sort=(!empty($_GET["sort"])) ? ($_GET["sort"]) : ('');
		$filter=(!empty($_GET["filter"])) ? ($_GET["filter"]) : ('');
		$textfilter=(!empty($_GET["textfilter"])) ? ($_GET["textfilter"]) : ('');
		$cost_parent_id=(!empty($_GET["cost_parent_id"])) ? ($_GET["cost_parent_id"]) : ('');

		$history = history::select('*');
		 if((!empty($_GET["start_time"]))){
			   $history = $history
				->whereBetween('created_at', array($start_time, $end)); }

		if(!empty($sort)){
			   $history = $history
				->orderBy($sort,'ASC');}

		if(!empty($filter)){
				if($filter=="cost_id"){
					$textfilter=cost::where('name',$textfilter)->get();
					if(count($textfilter)!=0){
						$textfilter=$textfilter[0]->id;
					}
					else{
						$textfilter="";
					}
				}
			   $history = $history
				->where($filter,$textfilter);
		}
		if(!empty($cost_parent_id)){
		       $all_costs=cost::where('parent_id',$cost_parent_id)->pluck('id');
			   $history = $history
				->whereIn('cost_id',$all_costs);
		}
		$history=$history
			->where('market_id','like',$market_id."%")
			->where('box_id','like',$box_id."%")->where('removed',0)
			 ->skip($start)
			->take($length)
			->get();
		//////////////////////
		$arr = array();
        foreach($history as $h){
			$market=market::find($h->market_id);
			$cost=cost::find($h->cost_id);
			$type_cost=type_cost::find($cost->type_id);
			$cost_name=$cost->name;
			$box=box::find($h->box_id);
			if($cost_name=="salary"){
				$parent_name="Labor";
				$s=salary::find($h->salary_id);
				$employee=employee::find($s->employee_id);
				$cost_name=$employee->full_name;
			}
			else{
				$parent_name=cost::find($cost->parent_id)->name;
			}
			$user=user::find($h->user_id);
			$user_update=user::find($h->user_update);
			if(!$user_update){
				$user_update='';
			}
			else{
				$user_update=$user_update->username;
			}
			$market=market::find($h->market_id);

			$show=0;
			$market_name="";
			if($market){

				if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
					$show=1;
				}
				$market_name=$market->name;
			}
			else{
				$show=1;
			}
			if($show==1){
                $tax=$h->tax=='1'?'Yes':'No';
                $declare=$h->declared=='1'?'Yes':'No';
                $credit=$h->credit=='1'?'Yes':'No';
             $arr[] = array(
					'time' => $h->time,
					'box'=>$box->name,
					'user' => $user->username,
					'balance' => $h->amount.' $',
					'debit' => $h->debit=='1'?'YES':'No',
					'img' => $h->image,
					'updated_at' => $h->updated_at,
					'user_update' => $user_update,
					'method' => $h->method,
					'credit' => "<a  class='btn btn-info' href='history/$h->id/change?c=debit'>$credit</a>",
					'type'=>	$type_cost->name,
					'sub' => $cost_name,
					'cat' => $parent_name,
				   'store' => $market->name,
				   'method' => $h->method,
				    'tax' => "<a  class='btn btn-info' href='history/$h->id/change?c=tax'>$tax</a>",
					 'declared' =>"<a  class='btn btn-info' href='history/$h->id/change?c=declared'>$declare</a>",

				'image' => "<a  class='btn btn-info' id='imageShow'><i class='fas fa-info'></i>Image</a>"

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
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
	 /////////////////////////////////////////////////////////////////////// chart /////////////////////
	public function chartBar(){
		$color=['red','green','blue','gray','black','yellow','orange','cyan'];
		$market=(!empty($_GET["market_id"])) ? ($_GET["market_id"]) : ('');
		 $box = box::select('*')
		  ->where('removed',0)
			->where('market_id','like',$market."%")
			->get();
		$arr_box = array();
		$arr_balance = array();
		$arr_color = array();
		$i=0;
        foreach($box as $b){
			if($i>7){
				$i=0;
			}
			$market=market::find($b->market_id);

			if(Auth::user()->id==$market->user_id || Auth::user()->role_id==1){
			 $arr_box[] = $b->name;
			 $arr_balance[] = $b->balance;
			 $arr_color[]=$color[$i];
			 $i=$i+1;
			}
		}
		  $data = array(
            'box' => $arr_box,
			'balance' => $arr_balance,
			'color' => $arr_color,
        );
        echo json_encode($data);
	}
	//////////////////////////////////////////////////////////////////////// line .//////////////////

		public function chartLine(){
		$color=['red','green','blue','gray','black','yellow','orange','cyan'];
		$box_id=(!empty($_GET["box_id"])) ? ($_GET["box_id"]) : ('');
		$start_time = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
		 $box = history::select('*')
		  ->where('removed',0)
		 ->where('box_id',$box_id)
		->orderBy('time','DESC')
		->get();
		 if((!empty($_GET["start_date"]))){
			   $box = history::select('*')
			    ->where('removed',0)
				->whereBetween('time', array($start_time, $end))
				->orderBy('time','ASC')
				->get();
				 }
		$arr_history = array();
		$arr_date = array();
		$arr_color = array();
		$i=0;
        foreach($box as $b){
			if($i>7){
				$i=0;
			}
			 $arr_history[] = $b->amount;
			 $arr_date[] = $b->time;
			 $arr_color[]=$color[$i];
			 $i=$i+1;
		}
		  $data = array(
            'history' => $arr_history,
			'date' => $arr_date,
			'color' => $arr_color,
        );
        echo json_encode($data);
	}


	public function chartPie(){
		$color=['red','green','blue','gray','black','yellow','orange','cyan'];
		$box_id=(!empty($_GET["box_id"])) ? ($_GET["box_id"]) : ('');
		$start_time = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
		$market=(!empty($_GET["market_id"])) ? ($_GET["market_id"]) : ('');

		if(Auth::user()->role_id!=1){
			$market=market::where('user_id',Auth::user()->id)->get()[0]->id;
		}
		$data=DB::table('histories')
		->where('market_id','like',$market."%")
		 ->where('removed',0)
		->where('box_id','like',$box_id."%")
		 ->select('cost_id',DB::raw("sum(amount) as amount"))
		 ->groupby('cost_id')
		->get();
		 if((!empty($_GET["start_date"]))){
			$data = DB::table('histories')
				->where('market_id','like',$market."%")
				 ->where('removed',0)
				->where('box_id','like',$box_id."%")
				->whereBetween('time', array($start_time, $end))
				 ->select('cost_id',DB::raw("sum(amount) as amount"))
				->groupby('cost_id')
				->get();
				 }
		$arr_cat = array();
		$arr_amount = array();
		$arr_color = array();
		$i=0;
        foreach($data as $b){
			if($i>7){
				$i=0;
			}
			 $arr_cat[] = cost::find($b->cost_id)->name;
			 $arr_amount[] = abs($b->amount);
			 $arr_color[]=$color[$i];
			 $i=$i+1;
		}

		  $data = array(
            'cat' => $arr_cat,
			'value' => $arr_amount,
			'color' => $arr_color,
        );
        echo json_encode($data);

	}
	////////////////////////////////////////
    public function edit(box $box)
    {
			if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
				}
				else{
						return redirect()->route('box.index')->with('success','permission denied');
				}

		return view('box.edit',['box'=>$box,'markets'=>$markets]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, box $box)
    {
		$box->fill($request->all())->save();
		return redirect()->route('box.index')->with('success','Fund update successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\box  $box
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
		if(Auth::user()->role_id!=1){
			return redirect()->route('box.index')->with('success','Fund update successfully');
				}

		$box = box::find($id);
        $box -> removed=1;
		$box->save();
        return redirect()->route('box.index');
    }
}
