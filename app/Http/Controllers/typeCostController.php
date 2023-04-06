<?php

namespace App\Http\Controllers;

use App\Models\type_cost;
use App\Models\market;
use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class typeCostController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
        
        /* Get [Some-Data] from DB */
        /* Obj */
        $data = type_cost::select('*')
        ->where('name','like','%'.$search['value'].'%')
		 ->where('amount','!=',0)
		  ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$market=market::find($d->market_id);
			if($market->user_id==Auth::user()->id || Auth::user()->role_id==1){
             $arr[] = array(
                
                'name' => $d->name,
              'amount' => $d->amount,
			  'start_amount' => $d->start_amount,
					'market'=>$market->name,
                'action' => "
                            <a href='type_cost/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i>Edit</a>
             
                            ",
                'delete' => "<a href='type_cost/".$d->id."/destroy' class='btn btn-danger'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = type_cost::count();
        $count = DB::select("select * from type_costs where name like '%".$search['value']."%'");
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
   

        return view('type_cost.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		return view('type_cost.create',['markets'=>market::all()]);
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
		
		type_cost::create($request->all());
		
		return redirect()->route('type_cost.index')->with('success','type_cost create successfully');		
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type_cost  $type_cost
     * @return \Illuminate\Http\Response
     */
    public function show(type_cost $type_cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type_cost  $type_cost
     * @return \Illuminate\Http\Response
     */
    public function edit(type_cost $type_cost)
    {
		
		
		return view('type_cost.edit',['type_cost'=>$type_cost,'markets'=>market::all()]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\type_cost  $type_cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, type_cost $type_cost)
    {
		$type_cost->fill($request->all())->save(); 
		return redirect()->route('type_cost.index')->with('success','type_cost update successfully');		
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type_cost  $type_cost
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
		
        //
        $type_cost_data = type_cost::find($id);
        $type_cost_data -> removed=1;
		$type_cost_data->save();
        return redirect()->route('type_cost.index');
    }
}
