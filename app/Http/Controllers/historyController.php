<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\cost;
use Image;
use Storage;
use App\Models\employee;
use App\Models\market;
use App\Models\box;
use App\Models\salary;
use App\Models\type_cost;
use App\Models\user;
use Illuminate\Http\Request;
use Auth;
use DB;
class historyController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
		$start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        $group=(!empty($_GET["group"])) ? ($_GET["group"]) : ('');
        /* Get [Some-Data] from DB */
        /* Obj */
		 $data = history::select('*')
		  ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();
		 if((!empty($_GET["start_time"]))){
        $data = history::select('*')

		->whereBetween('time', array($start_time, $end))
        ->skip($start)
        ->take($length)
        ->get();
		 }
		  if($group!='' && $group!=1){

		  $data = history::groupBy($group)
			->selectRaw('box_id,market_id,cost_id, sum(amount) as amount')
			->get();
		  }
        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$c="";

		    $c=cost::find($d->cost_id);
			$b=box::find($d->box_id);
			$market=market::find($b->market_id);
			$user=user::find($d->user_id);
		   if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
             $arr[] = array(
                 'user' => $user->username,
                'amount' => $d->amount,
				'cost' => $c->name,
				'box' => $b->name,
				'market' => $market->name,
                'action' => "
                            <a href='history/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='history/".$d->id."/destroy' class='btn btn-danger'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = history::count();
        $count = DB::select("select * from histories ");
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


        return view('history.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$parent=type_cost::where('market_id',null)->get();

		return view('history.create',['parents'=>$parent]);
        //
    }
	   public function cat_cost(Request $r)
    {
		if($r->A==4){
				if(Auth::user()->role_id==1){
						return redirect()->route('history.create')->with('success','cost create successfully');
					}
			 $markets_user=user::find(Auth::user()->id)->market_id;
			$market=market::where('id',$markets_user)->where('removed',0)->get()[0];
			$employee=employee::where('market_id',$market->id)->where('removed',0)->get();
            $stores=market::all();

			return view('history.employee',['employee'=>$employee,'type'=>$r->A]);
		}

		$t=type_cost::find($r->A);

		if($t){
			if($t->name=="Inventory"){
				return redirect()->route('good.index');
			}
			if($t->name=="debit"){
				return redirect()->route('debit.create');
			}
		}
		$parent=cost::where('type_id',$r->A)->whereRaw('parent_id = type_id')->where('removed',0)->Orwhere('parent_id',null)->get();
		$all_cat=cost::where('parent_id','!=',null)->get();
		if(Auth::user()->role_id!=1){
				$markets_user=user::find(Auth::user()->id)->market_id;
				$m=market::where('id',$markets_user)->where('removed',0)->get()[0];
				$b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();
			}
			else{
				$m=market::where('removed',0)->get();
				$b=box::where('removed',0)->where('disable',0)->get();
			}
		return view('history.cost',['parents'=>$parent,'type'=>$r->A,'category'=>$all_cat,'box'=>$b,'markets'=>$m]);
        //
    }

	public function child(){
		$all_cat=cost::where('parent_id',$_GET['parent'])->get();
		echo json_encode($all_cat);
	}

	   public function answare(Request $r)
    {
		if($r->A=='4S'){
				$start_date = date('Y-m-d', strtotime($r->start));
				$end_date = date('Y-m-d', strtotime($r->endt));
				 if((!empty($r->start))){
					$salary = DB::table('works')
					 ->select(DB::raw('sum(hours_work) as hours'))
					 ->where('removed',0)
					 ->where('is_pay',0)
					 ->where('employee_id',$r->employee)
					 ->whereBetween('start_time', array($start_date, $end_date))
					 ->get();
				 }

			     else{
					 $salary=DB::select("select sum(hours_work) as hours from works where removed=0 and is_pay=0 and employee_id=".$r->employee);
				 }
				 $price=DB::select("select price_hour from employees where  removed=0 and  id=".$r->employee);
				 $amount=$salary[0]->hours*$price[0]->price_hour;
				 $markets_user=user::find(Auth::user()->id)->market_id;
				 $m=market::where('id',$markets_user)->where('removed',0)->get()[0];
				 $b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();
					return view('history.salary',['start_time'=>$r->start,'end_time'=>$r->endt,'amount'=>$amount,'employee'=>$r->employee,'price'=>$price[0]->price_hour,'box'=>$b,'hours'=>$salary[0]->hours,'type'=>$r->A]);
		}

		$parent=cost::where('parent_id',$r->A)->where('removed',0)->get();
		if(count($parent)==0){
			if(Auth::user()->role_id!=1){
				$markets_user=user::find(Auth::user()->id)->market_id;
				$m=market::where('id',$markets_user)->where('removed',0)->get()[0];
				$b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();
			}
			else{

				$b=box::where('removed',0)->where('disable',0)->get();
			}
			return view('history.box',['box'=>$b,'cost_id'=>$r->A,'type'=>$r->type]);
		}
		return view('history.cost',['parents'=>$parent,'type'=>$r->type]);
        //
    }



    public function box(Request $r)
    {
		$cost=cost::where('name',$r->B)->get()[0];
		$h=new history;
		$h->amount=$r->amount;
		$h->cost_id=$cost->id;
		$h->box_id=$r->box_id;
		$box=box::find($r->box_id);
		$h->market_id=$box->market_id;
		$h->type=$r->type;
		$h->user_id=Auth::user()->id;
		$h->note=$r->note;
		$h->time=$r->time;

		$h->method=$r->method;
		$h->innvoice=$r->innvoice;
		$h->date_check=$r->date_check;
		$h->number_check=$r->number_check;
		$h->to_who=$r->to_who;

		$h->tax=$r->tax;
		$h->declared=$r->declared;
		$b=box::find($r->box_id);

		$t=type_cost::find($r->type);
		if($r->credit !=1 ){
			$b->balance=round($b->balance+$r->amount,2);
			$h->debit=1;
			$h->credit=0;
		}
		else{

			$b->balance=round($b->balance-$r->amount,2);
			$h->amount=-$r->amount;
            $h->credit=1;
			$h->debit=0;
		}
      //nooooooo
		//$h->save();
		if( $r->hasFile('image'))
                {

                    $img = $r->file('image');
                    $filename =  $h->id.$img->getClientOriginalName();
                    $h->image=$filename;
                    $location = storage_path('app/public/') . $filename;
                    Image::make($img)->save($location);
                }
                $b->save();
		$h->save();
		return redirect()->route('history.create')->with('success','Entry create successfully');
        //
    }
//////////////////////////////////
public function viewCost(){

	$category_income=cost::where('type_id',3)->whereRaw('parent_id = type_id')->where('removed',0)->Orwhere('parent_id',null)->get();
	$category_expense=cost::where('type_id',2)->whereRaw('parent_id = type_id')->where('removed',0)->Orwhere('parent_id',null)->get();
	if(Auth::user()->role_id!=1){
				$markets_user=user::find(Auth::user()->id)->market_id;
				$m=market::where('id',$markets_user)->where('removed',0)->get()[0];
				$b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();
			}
	else{
				$m=market::where('removed',0)->get();
				$b=box::where('removed',0)->where('disable',0)->get();
			}

	return view('history.create_cost',['category_income'=>$category_income,'category_expense'=>$category_expense,'funds'=>$b,'stores'=>$m]);
}



public function saveCost(Request $r){

		$h=new history;
		$h->amount=round($r->balance,2);
		$h->cost_id=$r->sub_cat;
		$h->name_cost=cost::find($r->sub_cat)->name;

		$h->date=date("Y/m/d",strtotime ($r->checkin));
		$h->box_id=$r->fund;
		$box=box::find($r->fund);
		$h->market_id=$box->market_id;
		$h->type=$r->type;
		$h->user_id=Auth::user()->id;
		$h->note=$r->note;
		$h->time=$r->checkin;

		$h->method=$r->method;
		$h->innvoice=$r->invoice;
		$h->date_check=$r->date_check;
		$h->number_check=$r->number_check;
		$h->to_who=$r->to_who;

		$h->tax=$r->tax;
		$h->declared=$r->declared;
		$b=box::find($r->fund);

		$t=type_cost::find($r->type);
		if($r->credit !=1 ){
			$b->balance=round($b->balance+$r->amount,2);
			$h->debit=1;
			$h->credit=0;
		}
		else{
			$b->balance=round($b->balance-$r->amount,2);
			$h->amount=-$r->amount;
            $h->credit=1;
			$h->debit=0;
		}
       // nooooooooooo
		//$h->save();
		if( $r->hasFile('image'))
                {
                    $img = $r->file('image');
                    $filename =  $h->id.$img->getClientOriginalName();
                    $h->image=$filename;
                    $location = storage_path('app/public/') . $filename;
                    Image::make($img)->save($location);
                }

		$h->save();
        $b->save();
		return redirect()->route('viewCost')->with('success','Add successfully')->with('tab',$r->type);


}


////////////////// salary ////////////////////////////

	   public function salary(Request $r)
    {
	    $salary=new salary;
		$salary->amount=$r->amount;
		$salary->bonous=$r->bonous;
		$salary->employee_id=$r->employee_id;
		$e=employee::find($r->employee_id);
		$markets_user=user::find(Auth::user()->id)->market_id;
		$m=market::where('id',$markets_user)->where('removed',0)->get()[0];
		$salary->market_id=$m->id;
		$salary->box_id=$r->box_id;
		$salary->transfer=$r->transfer;
		$salary->cache=$r->cache;
		$salary->chec=$r->chec;
		$salary->date=date("Y/m/d",strtotime ($r->time));
		$salary->user_id=Auth::user()->id;
		$salary->note=$r->note;
		$salary->time=$r->time;
		$salary->save();

		$salary_id=cost::where('name','salary')->get()[0]->id;
		$h=new history;
		$h->salary_id=$salary->id;
		$h->amount=-$r->amount;
		$h->cost_id=$salary_id;
		$h->box_id=$r->box_id;
		$box=box::find($r->box_id);
		$h->user_id=Auth::user()->id;
		$h->market_id=$box->market_id;
		$salary_id=type_cost::where('name','salary')->get()[0]->id;
		$h->type=$salary_id;
		$h->note=$r->note;
		$h->name_cost="salary";
		$h->time=$r->time;
		$h->date=date("Y/m/d",strtotime ($r->time));
		$h->method='multi';
		$h->tax=0;
		$h->declared=0;
		$h->credit=1;
		$h->debit=0;
		$h->save();
		$start_date = date('Y-m-d', strtotime($r->start_date));
		$end_date = date('Y-m-d', strtotime($r->end_date));
		 if((!empty($r->start_date))){
			DB::table('works')->where('employee_id',$e->id)
			->whereBetween('start_time', array($start_date, $end_date))
			 ->update(['is_pay' => "1"]);
		 }
		 else{
			DB::select('update works set is_pay=1 where employee_id='.$e->id);
		 }
		return redirect()->route('employee.index')->with('success','salary paid successfully');
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
			if(Auth::user()->role_id!=1){
				$m=market::where('user_id',Auth::user()->id)->where('removed',0)->get()[0];
				$b=box::where('market_id',$m->id)->where('removed',0)->where('disable',0)->get();
			}
			else{

				$b=box::where('removed',0)->where('disable',0)->get();
			}
		return view('history.edit',["history"=>$history,'box'=>$b]);
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
		$history->box_id=$request->box_id;
		$history->method=$request->method;
		$history->amount=$request->amount;
		$history->tax=$request->tax;
		$history->declared=$request->declared;
		$history->note=$request->note;
		$history->time=$request->time;
		$history->user_update=Auth::user()->id;

	   if( $request->hasFile('image'))
                {


                    $img = $request->file('image');
                    $filename =  $history->id.$img->getClientOriginalName();
                    $history->image=$filename;
                    $location = storage_path('app/public/') . $filename;
                    Image::make($img)->save($location);
                }
		$history->save();
        //
		return redirect()->route('history.index')->with('success','update successfully');
    }
 public function change($id)
    {
		$c = (!empty($_GET["c"])) ? ($_GET["c"]) : ('');

		 $history = history::find($id);
		 if($c=="declared"){
			  $old=$history ->declared;
			  if($old=="0" || $old=="none"){
				$history->declared=1;
			  }
			  else{
				$history->declared=0;
			  }

		 }
		 if($c=="tax"){
				  $old=$history->tax;
			  if($old=="0" || $old=="none"){
				$history->tax=1;
			  }
			  else{
				$history->tax=0;
			  }

		 }
		 if($c=="debit"){
				$old=$history ->credit;
				$history->credit=$history->debit;
				$history ->debit=$old;
		 }

		 $history->save();
		return redirect()->route('details');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\history  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
		 $history = history::find($id);
         $history -> removed=1;
		 $history->save();
		return redirect()->route('history.index');
    }
}
