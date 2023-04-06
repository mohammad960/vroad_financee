<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Models\user;
use Illuminate\Http\Request;
use DB;
use Auth;
class messageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('message.index');
        //
    }

	public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');

        /* Get [Some-Data] from DB */
        /* Obj */
        $data = message::select('*')
        ->where('text','like','%'.$search['value'].'%')
		 ->where('removed',0)
        ->skip($start)
        ->take($length)
        ->get();

        /* To send (data) to ->(view.index).
            I need to convert from Obj to [Arr-of-Arr]. */
        $arr = array();
        foreach($data as $d){
			$user_from=user::find($d->from_user);
			$user_to=user::find($d->to_user);
			if(Auth::user()->id==$user_to->id || $user_from->id==Auth::user()->id || Auth::user()->role_id==1){
             $arr[] = array(

                'to' => $user_to->username,
                'from' => $user_from->username,
				  'text' => $d->text,
				    'status' => $d->status,
                'delete' => "<a href='message/".$d->id."/destroy' style='color:#DC3545'><i class='fas fa-trash'></i> Delete</a>"
            );
        }
		}
        /* The count of [All-Data] */
        $total_members = message::count();
        $count = DB::select("select * from messages where text like '%".$search['value']."%'");
        $recordsFiltered = count($count);
        /* Send Data [JSON] */
        $data = array(
            'recordsTotal' => $total_members,
            'recordsFiltered' => $recordsFiltered,
            'data' => $arr,
        );
        echo json_encode($data);
    }


public function change($id)
    {
		$noti=message::find($id);
		$noti->status='show';
		$noti->save();
		return redirect()->route("message.index");
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$user=user::all();

		return view('message.create',["users"=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		$user=user::find(Auth::user()->id);

		if($user->role_id==1){
            if($request->user_id==null){

                $users=user::where('id','!=',Auth::user()->id)->get();
                foreach($users as $u){
				$m=new message();
				$m->from_user=$user->id;
				$m->to_user=$u->id;
				$m->text=$request->text;
				$m->save();}
            }
            else{
			$all=$request->user_id;
			foreach($all as $u){
				$u=user::find($u);
				$m=new message();
				$m->from_user=$user->id;
				$m->to_user=$u->id;
				$m->text=$request->text;
				$m->save();
			}
        }
		}
		else{
			$all=user::where('role_id',1)->get();
			foreach($all as $u){
				$m=new message();
				$m->from_user=$user->id;
				$m->to_user=$u->id;
				$m->text=$request->text;
				$m->save();
			}
		}


		return redirect()->route('message.index')->with('success','successfully');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
		 $message = message::find($id);
          $message->delete();
		return redirect()->route('message.index');
    }
}
