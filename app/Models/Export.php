<?php
namespace App\Models;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;

class Export implements WithEvents
{
    /**
    * Export data 
    * @author Matin Malek
    * @return Array
    */
	public $data=[];
    public function registerEvents(): array
    {
      return [
         BeforeExport::class => function(BeforeExport $event){
            $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path('balance.xlsx')),Excel::XLSX);

            $event->writer->getSheetByIndex(0);
			$i=3;
			$bussnies=0;
			$worker_hours=0;
			$cig_ck=0;
			$total_side=0;
			$sum_doordash=0;
			$sum_tax_invoice=0;
			$sum_drizly=0;
			$sum_labor=0;
			$sum_delevery=0;
			$cach_in_hand=0;
			foreach ($this->data as $key => $item) {
				$event->getWriter()->getSheetByIndex(0)->setCellValue('A'.$i,$key);
				$event->getWriter()->getSheetByIndex(0)->setCellValue('AV'.$i,$key);
				$event->getWriter()->getSheetByIndex(0)->setCellValue('B'.$i,strtoupper(date('D', strtotime($key))));
				$total_income=0;
				$total_exp=0;
				$tax=0;
				$no_tax=0;
				$innvoice=0;
				$total_dep=0;
				$char_index=0;
				$event->getWriter()->getSheetByIndex(0)->setCellValue('D'.$i,$cach_in_hand);
				foreach($item as $t){
					$char=['AW','AX','AY','AZ','BA','BB','BC'];
					if($t->name_cost=="Employee"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue($char[$char_index]."1",$t->employee);
						$char_index=$char_index+1;
					}
					
				}
				$char_index=0;
				foreach($item as $t){
					if($t->amount < 0 ){
							$t->amount=$t->amount*-1;
						}
					///////////////////////       INCOME     /////////////////////////////////////
				
					if($t->name_cost=="Money Order"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('E'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Money Gram"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('F'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Net Sales"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('G'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
						$bussnies=$t->amount+$bussnies;
					}
					if($t->name_cost=="Lotto"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('H'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Scratch Sold"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('I'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Cash In"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('J'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Safe In"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('K'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="Order Bost"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('L'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
					}
					if($t->name_cost=="CIG CK"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('M'.$i,$t->amount);
						$total_income=$total_income+$t->amount;
						$cig_ck=$cig_ck+$t->amount;
					}
					if($t->name_cost=="Workers Check"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('N'.$i,$t->amount);
						$worker_hours=$worker_hours+$t->amount;
						$total_income=$total_income+$t->amount;
					}
					$event->getWriter()->getSheetByIndex(0)->setCellValue('o'.$i,$total_income);
					
					////////////////////////////////// EXCPENSE ////////////////////////////////
					if($t->name_cost=="Scratch PO"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('Q'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="Lotto PO"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('R'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
					}
					if($t->tax=="0"){
						$tax=$tax+$t->amount;
						$event->getWriter()->getSheetByIndex(0)->setCellValue('S'.$i,$tax);
						$total_exp=$total_exp+$t->amount;
						$sum_tax_invoice=$sum_tax_invoice+$t->amount;
					}
					if($t->tax=="1"){
						$no_tax=$no_tax+$t->amount;
						$event->getWriter()->getSheetByIndex(0)->setCellValue('T'.$i,$no_tax);
						$total_exp=$total_exp+$t->amount;
						$sum_tax_invoice=$sum_tax_invoice+$t->amount;
					}
					if($t->innvoice=="0"){
						$innvoice=$innvoice+$t->amount;
						$event->getWriter()->getSheetByIndex(0)->setCellValue('V'.$i,$innvoice);
						$total_exp=$total_exp+$t->amount;
						$sum_tax_invoice=$sum_tax_invoice+$t->amount;
					}
					if($t->name_cost=="Dep 1"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('W'.$i,$t->amount);
						$total_dep=$total_dep+$t->amount;
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="Safe 2"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('X'.$i,$t->amount);
						$total_dep=$total_dep+$t->amount;
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="Cash In Hand"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('Y'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$cach_in_hand=$t->amount;
					}
					if($t->name_cost=="ATM"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('Z'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="EBT"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AA'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_labor=$sum_labor+$t->amount;
					}
					if($t->name_cost=="salary"){
						
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AB'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_labor=$sum_labor+$t->amount;
					}
					if($t->name_cost=="BOX BOY"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AE'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_labor=$sum_labor+$t->amount;
					}
					if($t->name_cost=="Asherf"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AF'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_labor=$sum_labor+$t->amount;
					}
					if($t->name_cost=="Expence"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AG'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="Big ATM"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AH'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
					}
					if($t->name_cost=="Uber Eats"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AI'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_delevery=$sum_delevery+$t->amount;
					}
					if($t->name_cost=="Sausy"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AJ'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_delevery=$sum_delevery+$t->amount;
					}
						if($t->name_cost=="Drizly"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AK'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_drizly=$sum_drizly+$t->amount;
						$sum_delevery=$sum_delevery+$t->amount;
					}
					if($t->name_cost=="Door Dash"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue('AL'.$i,$t->amount);
						$total_exp=$total_exp+$t->amount;
						$sum_doordash=$sum_doordash+$t->amount;
						$sum_delevery=$sum_delevery+$t->amount;
					}
					$char=['AW','AX','AY','AZ','BA','BB','BC'];
					if($t->name_cost=="Employee"){
						$event->getWriter()->getSheetByIndex(0)->setCellValue($char[$char_index].$i,$t->amount);
						$char_index=$char_index+1;
						$total_exp=$total_exp+$t->amount;
						$sum_doordash=$sum_doordash+$t->amount;
						$sum_delevery=$sum_delevery+$t->amount;
					}
					
					
					
					
					$event->getWriter()->getSheetByIndex(0)->setCellValue('AM'.$i,$total_exp);
					$event->getWriter()->getSheetByIndex(0)->setCellValue('AN'.$i,$total_exp-$total_income);
					$event->getWriter()->getSheetByIndex(0)->setCellValue('AO'.$i,$total_dep);
				
					
				}
				$i=$i+1;
			}
			$total_side=$bussnies+$worker_hours+$worker_hours+$cig_ck;
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU17',$bussnies);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU18',$worker_hours);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU19',$worker_hours);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU20',$cig_ck);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU21',$total_side);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU22',$sum_tax_invoice);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU23',$sum_doordash);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU24',$sum_drizly);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU27',$sum_labor);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU28',$sum_delevery);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU32',$sum_delevery+$sum_tax_invoice+$sum_doordash+$sum_drizly+$sum_labor);
			$event->getWriter()->getSheetByIndex(0)->setCellValue('AU34',$total_side-($sum_delevery+$sum_tax_invoice+$sum_doordash+$sum_drizly+$sum_labor));
		
            return $event->getWriter()->getSheetByIndex(0);
         }
      ];
    }
}