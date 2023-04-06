<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\role;
use App\Models\market;
use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index()
    {
        return view('user.index');
    }
	    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = user::select('*')


			->skip($start)
			->take($length)
			->get();


        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$market=market::find($d->market_id);
			$role=role::find($d->role_id);

            $status = $d->removed?"Active":"Disable";
			$show=0;
			$market_name="";
			if($market){

				if(Auth::user()->market_id==$market->id || Auth::user()->role_id==1){
					$show=1;
				}
				$market_name=$market?$market->name:'';
			}
			else{
				$show=1;
			}
			if($show==1){
             $arr[] = array(

                'username' => $d->username,
                'store' => $market_name,
				  'role' => $role->name,


                'action' => "<div class='row'>

                            <a href='user/".$d->id."/edit' style='color:#377CDB ;'><i class='fas fa-edit'></i> Edit</a><i>   </i> <div style='margin-left: 2em;'></div>

                            <div style='margin-left: 2em;'></div> <button type='button' class='btn btn-link popup' onclick='clickme(".$d->id.")' data-toggle='modal' data-target='#myModal'> <i class='fa fa-eye' aria-hidden='true'></i>Show</button>

                       </div> ",
                'Disable' => "<a href='user/".$d->id."/destroy' style='color:#377CDB' ><i class='fa fa-ban' aria-hidden='true'></i>".$status. " </a>",
                'Delete' => "<a href='user/".$d->id."/delete' style='color:#DC3545' ><i class='fa fa-trash' aria-hidden='true'></i> Delete </a>"





            );
        }
		}
        /* The count of [All-Data] */
        $total_members = user::count();
        $count = DB::select("select * from users where username like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => 2,
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
		$role=role::all();
		$market=market::all();
		return view("user.create",["role"=>$role,"markets"=>$market]);
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
		'username' => 'required|unique:users',

		'password'=>'required'
		]);
		$user=new user();
		$user->username=$request->username;
		$user->role_id=$request->role_id;
		$user->market_id=$request->market_id;
		$user->password=Hash::make($request->password);
		$user->save();
		return redirect()->route("user.index");
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=user::with('role')->with('market')->find($id);


        return response()->json($user);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
			$market=market::all();
			return view("user.edit",["user"=>$user,"markets"=>$market]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
			$user->username=$request->username;
			if(!empty($request->password)){
				$user->password=Hash::make($request->password);
			}
			$user->market_id=$request->market_id;
			$user->save();

		 return redirect()->route("user.index");
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$user=user::find($id);

        $user->removed = $user->removed==1?0:1;

		$user->save();
		return redirect()->route("user.index");
        //
    }
    public function delete($id)
    {
		$user=user::find($id);

        $user->delete();


		
		return redirect()->route("user.index");
        //
    }
}
