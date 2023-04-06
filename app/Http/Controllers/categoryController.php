<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Image;
use Storage;
use DB;
use Auth;
class categoryController extends Controller
{
    public function pagination_ajax(Request $r)
    {
        $start = $r->get('start');
        $length = $r->get('length');
        $search = $r->get('search');
        
        /* Get [Some-Data] from DB */
        /* Obj */
        $data = category::select('*')
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
              
					
                'action' => "
                            <a href='category/".$d->id."/edit' class='btn btn-success'><i class='fas fa-edit'></i>Edit</a>
             
                            ",
                'delete' => "<a href='category/".$d->id."/destroy' class='btn btn-danger'><i class='fas fa-trash'></i>Delete</a>"
            );
        }
        /* The count of [All-Data] */
        $total_members = category::count();
        $count = DB::select("select * from categories where name like '%".$search['value']."%'");
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
   

        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
		return view('category.create');
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
		
		$c=category::create($request->all());
		

		$c->save();
		return redirect()->route('category.index')->with('success','category create successfully');		
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
		
		if(Auth::user()->role_id!=1){
			
			return view('denied');
		}
		return view('category.edit',['category'=>$category]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
		$category->fill($request->all())->save(); 
		return redirect()->route('category.index')->with('success','category update successfully');		
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
		if(Auth::user()->role!=1){
			
			return view('denied');
		}
        //
        $category_data = category::find($id);
        $category_data -> delete();
        return redirect()->route('category.index');
    }
}
