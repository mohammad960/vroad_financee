<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\market;

use Illuminate\Http\Request;
use Image;
use Storage;
use App\Models\user;
use DB;
use Auth;
class employeeController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = employee::select('*')
        ->where('full_name','like','%'.$search['value'].'%')
		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$market=market::find($d->market_id);

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


                'full_name' => $d->full_name,
                'number' => $d->number,
				  'phone' => $d->phone,
				    'price_hour' => $d->price_hour.' $',
					'market' => $market_name,


                'action' => "<div class='row'>
                            <a href='employee/".$d->id."/edit'style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a><div style='margin-left: 2em;'></div>
							<a href='employee/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash' ></i>Delete</a>

                            ",
                'pay' =>  "<a href='work/".$d->id."/pay' style='color:#377CDB;'><i class='fab fa-amazon-pay'></i>Pay Salary</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = employee::count();
        $count = DB::select("select * from employees where full_name like '%".$search['value']."%'");
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


        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
		}
		else{
				$markets_user=user::find(Auth::user()->id)->market_id;
				 $markets=market::where('id',$markets_user)->where('removed',0)->get();

		}
		return view('employee.create',['markets'=>$markets]);
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
		'number' => 'required|integer|unique:employees',
        'full_name'=> ['required','alpha'],
        'phone' => 'required|string',
        'price_hour'=>  'required|regex:/^\d+(\.\d{1,2})?$/',


		]);
		employee::create($request->all());

		return redirect()->route('employee.index')->with('success','employee create successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
		if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
		}
		else{
				$markets=market::where('removed',0)->where('id',Auth::user()->market_id)->get();
		}

		return view('employee.edit',['employee'=>$employee,'markets'=>$markets]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
		$employee->fill($request->all())->save();
		return redirect()->route('employee.index')->with('success','employee update successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {

        $employee_data = employee::find($id);
         $employee_data -> removed=1;
		$employee_data->save();
        return redirect()->route('employee.index');
    }
}
