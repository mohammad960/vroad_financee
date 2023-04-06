<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ImportController;
use DB;
use App\Models\market;
use App\Models\employee;
use App\Models\history;
class ExportController extends Controller
{

   /**
    * Display a listing of the resource.
    * @author Matin Malek
    * @return \Illuminate\Http\Response
    */
   public function generateFile() {
	   $start=$_GET['start'];
		$end=$_GET['end'];
		$store=$_GET['store'];
		$start= date('Y-m-d', strtotime($start));
        $end= date('Y-m-d', strtotime($end));
		$market=market::find($store);
	   $export=new \App\Models\Export;
	   $data=array();
	 
	   $data_db=DB::table('histories')
			->select('date','name_cost','type','market_id','tax','innvoice',DB::raw("sum(amount) as amount"))
			->groupBy('date','name_cost','type','market_id','tax','innvoice')->where('market_id',$store)->whereBetween('time', array($start, $end))->get();
	 $data_salary=DB::table('salaries')
			->select('date','employee_id','market_id',DB::raw("sum(amount) as amount"))
			->groupBy('date','employee_id','market_id')->where('market_id',$store)->whereBetween('time', array($start, $end))->get();
			
	    $char=['AT','AU','AV','AW','AX','AY','AZ'];
	
		foreach ($data_salary as $d){
			$d->name_cost='Employee';
			$d->type='';
			$d->tax='';
			$d->innvoice='';
			$d->employee=employee::find($d->employee_id)->full_name;
			$data_db[]=$d;
		}
	   $arr = array();

		foreach ($data_db as $key => $item) {
		   $arr[$item->date][$key] = $item;
		   
		}
	
	   $export->data=$arr;
      return Excel::download($export, 'balance '.$market->name.'.xlsx');
   }


}
?>