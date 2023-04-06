<?php

namespace App\Http\Controllers;

use App\Models\market;
use App\Models\user;

use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class marketController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = market::select('*')
		 ->where('removed',0)
        ->where('name','like','%'.$search['value'].'%')
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){

             $arr[] = array(

                'name' => $d->name,
                'number' => $d->number,
				  'owner' => $d->owner_name,


                'action' => "
                            <a href='market/".$d->id."/edit' style='color:#377CDB;'><i class='fas fa-edit'></i>Edit</a>

                            ",
                'delete' => "<a href='market/".$d->id."/destroy' style='color:#DC3545;'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = market::count();
        $count = DB::select("select * from markets where name like '%".$search['value']."%'");
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


        return view('market.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

		return view('market.create');
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
		'name' => 'required|unique:markets',
        'number' => 'required',
        'address' => 'required',
        'owner_name'=>'nullable',
        

		]);
		market::create($request->all());

		return redirect()->route('market.index')->with('success','store '.$request->name.' create successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\market  $market
     * @return \Illuminate\Http\Response
     */
    public function show(market $market)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\market  $market
     * @return \Illuminate\Http\Response
     */
    public function edit(market $market)
    {


		return view('market.edit',['market'=>$market]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\market  $market
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, market $market)
    {
		$market->fill($request->all())->save();
		return redirect()->route('market.index')->with('success','store '.$market->name.' update successfully');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\market  $market
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
		$market = market::find($id);
         $market -> removed=1;
		 $market->save();
		return redirect()->route('market.index');
    }
}
