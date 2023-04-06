<?php

namespace App\Http\Controllers;
use App\Models\market;
use App\Models\box;
use App\Models\user;
use App\Models\debit;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;
use Storage;
class debitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('debit.index');
        //
    }
public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
        $start_time = (!empty($_GET["start_time"])) ? ($_GET["start_time"]) : ('');
        $end = (!empty($_GET["end_time"])) ? ($_GET["end_time"]) : ('');
        /* Get [Some-Data] from DB */
        /* Obj */
        $data = debit::select('*')
        ->where('debtor','like','%'.$search['value'].'%')
		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();
		if((!empty($_GET["start_time"]))){
        $data = debit::select('*')

		->whereBetween('time', array($start_time, $end))
        ->skip($start)
        ->take($length)
        ->get();
		 }
        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$m=market::find($d->market_id);
			$b=box::find($d->box_id);
			$user=user::find($d->user_id);
			  if(Auth::user()->market_id==$m->id || Auth::user()->role_id==1){
             $arr[] = array(

                'type' => $d->type,
                'debtor' => $d->debtor,
				  'amount' => $d->amount.' $',
				    'note' => $d->note,
					'market' => $m->name,
					'user' => $user->username,
					'time' => $d->time,
			'box' => $b->name,
            'img' => $d->image,
                'action' => "
                            <a href='debit/".$d->id."/edit' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='debit/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>",
                'image' => "<a  class='btn btn-info' id='imageShow'><i class='fas fa-info'></i>Image</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = debit::count();
        $count = DB::select("select * from debits where debtor like '%".$search['value']."%'");
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
		if(Auth::user()->role_id==1){
			$markets=market::where('removed',0)->get();
			$box=box::where('removed',0)->where('disable',0)->get();
		}
		else{
				$markets_user=user::find(Auth::user()->id)->market_id;
				 $markets=market::where('id',$markets_user)->where('removed',0)->get();
				$box=box::where('removed',0)->where('market_id',$markets[0]->id)->where('disable',0)->get();
		}
		 return view('debit.create',["markets"=>$markets,"box"=>$box]);

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

        $this->validate($request,[

            'debtor'=> 'required',
            'amount'=> 'required',

             ]);

			$debit=new debit();
			$debit->debtor=$request->debtor;
			$debit->type=$request->type;
				if(Auth::user()->role_id==1){
					$markets=market::where('removed',0)->get();
					$box=box::where('removed',0)->where('disable',0)->get();
				}
				else{
						$markets_user=user::find(Auth::user()->id)->market_id;
						 $markets=market::where('id',$markets_user)->where('removed',0)->get();
						$box=box::where('removed',0)->where('market_id',$markets[0]->id)->where('disable',0)->get();
				}
			$debit->amount=$request->amount;
			$debit->market_id=$markets[0]->id;
			$debit->box_id=$request->box_id;
			$debit->note=$request->note;
			$debit->time=$request->time;
			$debit->user_id=Auth::user()->id;
			if( $request->hasFile('image'))
                {
                    $img = $request->file('image');
                    $filename =  $debit->id.$img->getClientOriginalName();
                    $debit->image=$filename;
                    $location = storage_path('app/public/') . $filename;
                    Image::make($img)->save($location);
                }

			$debit->save();

			return redirect()->route('viewCost')->with('success','debit updated successfully')->with('tab','debit');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function show(debit $debit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function edit(debit $debit)

    {
        $selected_box=box::find($debit->box_id);
        $boxlist=box::where('id','!=',$debit->box_id)->pluck('name','id');



        $selected_market=market::find($debit->market_id);
        $marketlist=market::where('id','!=',$debit->market_id)->pluck('name','id');


       // $debit->market_name=market::all()->pluck('name','id');


        return view('debit.edit',['debit'=>$debit,'boxlist'=>$boxlist,'selected_box'=>$selected_box,'selected_market'=>$selected_market,'marketlist'=>$marketlist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\debit  $debit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, debit $debit)
    {
        $debit->debtor=$request->name;
       // $debit->type=$request->type;

            if(Auth::user()->role_id==1){
                $markets=market::where('removed',0)->get();
                $box=box::where('removed',0)->where('disable',0)->get();
            }
            else{
                    $markets_user=user::find(Auth::user()->id)->market_id;
                     $markets=market::where('id',$markets_user)->where('removed',0)->get();
                    $box=box::where('removed',0)->where('market_id',$markets[0]->id)->where('disable',0)->get();
            }
        $debit->amount=$request->amount;

        //$debit->market_name=market::find('id')->name;

        $debit->box_id=$request->fund;
        $debit->market_id=$request->store;
        $debit->time=$request->time;


        $debit->save();

        return redirect()->route('debit.index')->with('success','debit create successfully')->with('tab','debit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\debit  $debit
     * @return \Illuminate\Http\Response
     */
       public function destroy( $id)
    {
		 $debit = debit::find($id);
         $debit -> removed=1;
		 $debit->save();
		return redirect()->route('debit.index');
    }
}
