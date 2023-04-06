<?php

namespace App\Http\Controllers;

use App\Models\cost;
use App\Models\type_cost;

use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class costController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = cost::select('*')
        ->where('name','like','%'.$search['value'].'%')
		 ->where('removed',0)

        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";
			$c=cost::find($d->parent_id);
			if($d->parent_id != null && $c){

				$c=$c->name;

             $arr[] = array(

                'name' => $d->name,
             'parent' => $c,
                'action' => "
                            <a href='cost/".$d->id."/edit' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='cost/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
			}
        }
        /* The count of [All-Data] */
        $total_members = cost::count();
        $count = DB::select("select * from costs where name like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }
  ///////////////////// expense //////////////////
   public function pagination_exp(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = cost::select('*')
        ->where('name','like','%'.$search['value'].'%')
		->where('type_id',2)
		 ->where('removed',0)
		  ->whereRaw('parent_id != type_id')
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";
			 $c=cost::find($d->parent_id);
			if($d->parent_id != null && $c){

			$c=$c->name;
			}
             $arr[] = array(

                'name' => $d->name,
             'parent' => $c,
                'action' => "
                            <a href='cost/".$d->id."/edit?is=2' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='cost/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = cost::count();
        $count = DB::select("select * from costs where type_id=2 and parent_id != type_id  and  name like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }
	///////////////////////////// revenue //////////////////
   public function pagination_rev(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = cost::select('*')
		 ->where('removed',0)
        ->where('name','like','%'.$search['value'].'%')
		->where('type_id',3)
	  ->whereRaw('parent_id != type_id')
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";
			 $c=cost::find($d->parent_id);
			if($d->parent_id != null && $c){

			$c=$c->name;
			}
             $arr[] = array(

                'name' => $d->name,
             'parent' => $c,
                'action' => "
                            <a href='cost/".$d->id."/edit?is=3' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='cost/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = cost::count();
        $count = DB::select("select * from costs where type_id=3 and parent_id != type_id and name like '%".$search['value']."%'");
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

        return view('cost.index');
    }
	public function revenue()
    {

        return view('cost.revenue');
    }
		public function expense()
    {

        return view('cost.expense');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$cost=cost::where('type_id',$_GET['is'])  ->whereRaw('parent_id = type_id')->where('removed',0)->get();
		$type_cost=type_cost::all();
		$type_id=$_GET['is'];
		return view('cost.create',['costs'=>$cost,'type'=>$type_cost,'type_id'=>$type_id]);
        //
    }
    public function create_parent()
    {

		$type_id=$_GET['is'];
		return view('cost.create_parent',['type_id'=>$type_id]);
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
		'name' => 'required|unique:costs',

		]);

		$c=cost::create($request->all());
	     if(!$request->parent_id){

			 $c->parent_id=$request->type_id;
			 $c->save();
		 }
		 if($request->type_id==2){
				return redirect()->route('cost.expense')->with('success','cost create successfully');
		 }
		  if($request->type_id==3){
				return redirect()->route('cost.revenue')->with('success','cost create successfully');
		 }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function show(cost $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function edit(cost $cost)
    {

		$costs=cost::where('type_id',$_GET['is']) ->whereRaw('parent_id != type_id') ->where('removed',0)->get();
		$type_cost=type_cost::all();
		$type_id=$_GET['is'];
		return view('cost.edit',['cost'=>$cost,'costs'=>$costs,'type'=>$type_cost,'type_id'=>$type_id]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cost $cost)
    {

		$cost->fill($request->all())->save();
			 if($request->type_id==2){
				return redirect()->route('cost.expense')->with('success','cost update successfully');
		 }
		  if($request->type_id==3){
				return redirect()->route('cost.revenue')->with('success','cost update successfully');
		 }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cost  $cost
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {

        $cost_data = cost::find($id);
        $cost_data -> removed=1;
		$cost_data->save();
        return redirect()->route('cost.index');
    }
 ///////////////////// expense //////////////////
   public function pagination_exp_parent(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = cost::select('*')
        ->where('name','like','%'.$search['value'].'%')
		->where('type_id',2)
		 ->where('removed',0)
		  ->whereRaw('parent_id = type_id')
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";
			 $c=cost::find($d->parent_id);
			if($d->parent_id != null && $c){

			$c=$c->name;
			}
             $arr[] = array(

                'name' => $d->name,
             'parent' => $c,
                'action' => "
                            <a href='/cost/".$d->id."/edit?is=2' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='/cost/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = cost::count();
        $count = DB::select("select * from costs where type_id=2 and parent_id = type_id  and  name like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }
	///////////////////////////// revenue //////////////////
   public function pagination_rev_parent(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = cost::select('*')
		 ->where('removed',0)
        ->where('name','like','%'.$search['value'].'%')
		->where('type_id',3)
	  ->whereRaw('parent_id = type_id')
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";
			 $c=cost::find($d->parent_id);
			if($d->parent_id != null && $c){

			$c=$c->name;
			}
             $arr[] = array(

                'name' => $d->name,
             'parent' => $c,
                'action' => "
                            <a href='/cost/".$d->id."/edit?is=3' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='/cost/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = cost::count();
        $count = DB::select("select * from costs where type_id=3 and parent_id = type_id and name like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }
		public function revenue_parent()
    {

        return view('cost.revenuep');
    }
		public function expense_parent()
    {

        return view('cost.expensep');
    }

}
