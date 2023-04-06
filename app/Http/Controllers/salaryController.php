<?php

namespace App\Http\Controllers;

use App\Models\salary;
use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\market;
use App\Models\user;
use App\Models\box;
use Auth;
use DB;
class salaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
 public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        $group=$r->get('group');
        /* Get [Some-Data] from DB */
        /* Obj */
		 $data = salary::select('*')
		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();
		 if((!empty($_GET["start_time"]))){
        $data = salary::select('*')
		->where('removed',0)
		->whereBetween('created_at', array($start_time, $end))
        ->skip($start)
        ->take($length)
        ->get();
		 }

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
		
		    $e=employee::find($d->employee_id);
			$b=box::find($d->box_id);
			$market=market::find($b->market_id);
			$user=user::find($d->user_id);
		   if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
             $arr[] = array(
                 'user' => $user->username,
                'amount' => $d->amount,
				'employee' => $e->full_name,
				'box' => $b->name,
				'market' => $market->name,
                'action' => "
                            <a href='salary/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i>Edit</a>
             
                            ",
                'delete' => "<a href='salary/".$d->id."/destroy' class='btn btn-danger'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = salary::count();
        $count = DB::select("select * from salaries ");
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
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		 $salary = salary::find($id);
        $salary -> removed=1;
		$salary->save();
        return redirect()->route('history.index');
        //
    }
}
