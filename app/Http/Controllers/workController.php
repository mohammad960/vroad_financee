<?php

namespace App\Http\Controllers;

use App\Models\work;
use App\Models\employee;
use App\Models\market;
use App\Models\box;
use App\Models\user;
use Illuminate\Http\Request;
use DB;
use Auth;
class workController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('work.index');
        //
    }
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = work::select('*')

		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$employee=employee::find($d->employee_id);
			$market=market::find($employee->market_id);

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

                'market' => $market_name,
                'employee' => $employee->full_name,
				  'hours_work' => $d->hours_work,
				    'start_time' => $d->start_time,
					'end_time' => $d->end_time,
					'is_pay' => $d->is_pay==1?'Yes':'No',
                'action' => "


                            ",
                'delete' => "<a href='work/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = work::count();
        $count = DB::select("select * from works ");
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$markets_user=user::find(Auth::user()->id)->market_id;
		$market_id=market::where('id',$markets_user)->where('removed',0)->get()[0]->id;
	    $emp=DB::select('select * from employees where removed=0 and  employees.market_id='.$market_id);
		return view('work.create',['employee'=>$emp]);
        //
    }
	 public function pay($id, Request $request)
    {
		//$start_date = date('Y-m-d', strtotime($r->start));
	//	$end_date = date('Y-m-d', strtotime($r->endt));
		if((!empty($r->start))){
					$salary = DB::table('works')
					 ->select(DB::raw('sum(hours_work) as hours'))
					 ->where('removed',0)
					 ->where('is_pay',0)
					 ->where('employee_id',$id)
					 ->whereBetween('start_time', array($start_date, $end_date))
					 ->get();
		}
		else{
					 $salary=DB::select("select sum(hours_work) as hours from works where removed=0 and is_pay=0 and employee_id=".$id);
				 }
		$price=DB::select("select id,price_hour,full_name from employees where  removed=0 and  id=".$id);
		$amount=$salary[0]->hours*$price[0]->price_hour;
		$markets_user=user::find(Auth::user()->id)->market_id;

        $market=employee::find($id)->market;
        $markets_user = $markets_user ?? $market->id;
		$m=market::where('id',$markets_user)->where('removed',0)->get()[0];
		$b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();






		return view('history.pay_salary',['employee'=>$price[0],'amount'=>$amount,'funds'=>$b]);




        //
    }
	public function pay_ajax(Request $r)
    {

		$start_date = date('Y-m-d', strtotime($r->start));
		$end_date = date('Y-m-d', strtotime($r->endt));
		$id = $r->id;
		$salary = DB::table('works')
					 ->select(DB::raw('sum(hours_work) as hours'))
					 ->where('removed',0)
					 ->where('is_pay',0)
					 ->where('employee_id',$id)
					 ->whereBetween('start_time', array($start_date, $end_date))
					 ->get();

		$price=DB::select("select id,price_hour,full_name from employees where  removed=0 and  id=".$id);
		$amount=$salary[0]->hours*$price[0]->price_hour;
		 $data = array(
            'amount' => $amount,
        );
        echo json_encode($data);

        //
    }


	 public function work_state(Request $r)
    {
		$markets_user=user::find(Auth::user()->id)->market_id;
		$market_id=market::where('id',$markets_user)->where('removed',0)->get()[0]->id;

		if($r->state=="end"){
			$emp=DB::select('select works.id,employees.full_name,employees.number from works  join employees on employees.id=works.employee_id where employees.removed=0 and works.removed=0 and  works.hours_work=0 and employees.market_id='.$market_id);
		}
		else{
			$emp=DB::select('select * from employees where removed=0 and  employees.market_id='.$market_id);
		}
		return view('work.employee',['employee'=>$emp,'state'=>$r->state]);
        //
    }


 public function employee(Request $r)
    {
		if($r->state=="start"){
			$w=new work;
			$w->start_time=$r->date;
			$w->employee_id=$r->employee_id;
			$w->save();
		}
		if($r->state=="end"){

			$w=work::where('employee_id',$r->employee_id)->first();

			$w->end_time=$r->date;
			$diff=date_diff(date_create($w->end_time),date_create($w->start_time));

			$w->hours_work=$diff->h.'.'.$diff->i;
			$w->save();
		}
		return redirect()->route('work.index');
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
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$work = work::find($id);
        $work -> removed=1;
		$work->save();
        return redirect()->route('work.index');
        //
    }
}
