<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\Unit;
use App\Model\Item;
use App\Model\RequestItem;
use App\Model\OrderItem;
use App\Model\DeliveryItem;
use App\Model\ReturnDeliveryItem;
use App\Model\UsageDetails;
use App\Model\ReturnUsageDetails;
use App\Model\Stock;
use App\Model\StockAdjustDetails;
use App\Model\StockMoveDetails;

class UnitConvertController extends Controller
{
    public function __unituct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.units'),
			'icon'			=> 'fa fa-refresh',
			'small_title'	=> trans('lang.units_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.units'),
				],
			],
			'rounte'		=> url("unit/dt"),
		];
		
		if(hasRole('unit_add')){
			$data = array_merge($data, ['rounteSave'=> url('unit/save')]);
		}
		if(hasRole('unit_download')){
			$data = array_merge($data, ['rounteDownload'=> url('unit/excel/download')]);
		}
		if(hasRole('unit_upload')){
			$data = array_merge($data, ['rounteUploade'	=> url('unit/excel/upload')]);
		}
		return view('unit.index',$data);
	}
	
	public function getDt()
    {
		$sql = "SELECT 
		  pr_units.`id`,
		  pr_units.`from_code`,
		  pr_units.`from_desc`,
		  pr_units.`to_code`,
		  pr_units.`to_desc`,
		  pr_units.`factor`,
		  pr_units.`status`
		FROM
		  `pr_units`";
        return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_delete = url('unit/delete/'.$row->id);
			$rounte_edit = url('unit/edit/'.$row->id);
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('unit_edit')){
				$btnEdit = "disabled";
			}
			if((Item::where(['unit_purch'=>$row->from_code])->exists()) || (Item::where(['unit_usage'=>$row->from_code])->exists()) || (Item::where(['unit_stock'=>$row->from_code])->exists())){
				$btnDelete = "disabled";
			}
			if(!hasRole('unit_delete')){
				$btnDelete = "disabled";
			}
            return
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
       })->make(true);
    }

    public function save(Request $request){
		$rules = [
				'from_code'	=>'required|max:10',
				'from_desc' =>'required|max:15',
				'to_code' 	=>'required|max:10',
				'to_desc' 	=>'required|max:15',
				'factor' 	=>'required',
				'status' 	=>'required',
			];
        Validator::make($request->all(),$rules)->validate();
		DB::beginTransaction();
		try {
			$data = [
				'from_code'	=>$request->from_code,
				'from_desc'	=>$request->from_desc,
				'to_code'	=>$request->to_code,
				'to_desc'	=>$request->to_desc,
				'status'	=>$request->status,
				'factor'	=>$request->factor,
				'created_by'=>Auth::user()->id,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$id = DB::table('units')->insertGetId($data);
			DB::commit();
			if($request->ajax()){
				return ['id'=>$id,'from_code'=>$request->from_desc,'from_desc'=>$request->from_code];
			}else{
				return redirect()->back()->with('success',trans('lang.save_success'));
			}
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

    public function update(Request $request,$id)
    {
    	$rules = [
				'from_code'	=>'required|max:10',
				'from_desc' =>'required|max:15',
				'to_code' 	=>'required|max:10',
				'to_desc' 	=>'required|max:15',
				'factor' 	=>'required',
				'status' 	=>'required',
			];
    	Validator::make($request->all(),$rules)->validate();
    	DB::beginTransaction();
		try {
			$data = [
				'from_code'	=>$request->from_code,
				'from_desc'	=>$request->from_desc,
				'to_code'	=>$request->to_code,
				'to_desc'	=>$request->to_desc,
				'status'	=>$request->status,
				'factor'	=>$request->factor,
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			$obj = Unit::find($id);
			if ($obj) {
				DB::table('items')->where(['unit_stock'=>$obj->from_code])->update(['unit_stock'=>$request->from_code]);
				DB::table('items')->where(['unit_usage'=>$obj->from_code])->update(['unit_usage'=>$request->from_code]);
				DB::table('items')->where(['unit_purch'=>$obj->from_code])->update(['unit_purch'=>$request->from_code]);
				DB::table('stocks')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('request_items')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('order_items')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('delivery_items')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('return_delivery_items')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('usage_details')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('return_usage_details')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('stock_move_details')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
				DB::table('stock_adjust_details')->where(['unit'=>$obj->from_code])->update(['unit'=>$request->from_code]);
			}
			DB::table('units')->where(['id'=>$id])->update($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.update_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.update_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function destroy($id)
    {
		try {
			DB::beginTransaction();
			DB::table('units')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

    public function downloadExcel()
   	{
   		Excel::create('units.export_'.date('Y_m_d_H_i_s'),function($excel){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Constructor Info',function($sheet){
   				$sheet->cell('A1','From Code');
   				$sheet->cell('B1','From Desc');
   				$sheet->cell('C1','To Code');
   				$sheet->cell('D1','To Desc');
   				$sheet->cell('E1','Factor');
   				$sheet->cell('F1','Status');
				
				$active = trans('lang.active');
				$disable = trans('lang.disable');
				$sql = "SELECT 
				  pr_units.`id`,
				  pr_units.`from_code`,
				  pr_units.`from_desc`,
				  pr_units.`to_code`,
				  pr_units.`to_desc`,
				  pr_units.`factor`,
				  pr_units.`status`,
				  (
					CASE
					  WHEN pr_units.`status` = 1 
					  THEN '$active' 
					  ELSE '$disable' 
					END
				  ) AS `status_desc`
				FROM
				  `pr_units`";
				$data = DB::select($sql);
				if(count($data)>0){
					$key=0;
   					foreach ($data as $value) {
	   					$sheet->cell('A'.($key+2),$value->from_code);
	   					$sheet->cell('B'.($key+2),$value->from_desc);
	   					$sheet->cell('C'.($key+2),$value->to_code);
	   					$sheet->cell('D'.($key+2),$value->to_desc);
	   					$sheet->cell('E'.($key+2),$value->factor);
	   					$sheet->cell('F'.($key+2),$value->status_desc);
						$key++;
	   				}
   				}
   			});
   		})->download('xlsx');
   	}

   	public function uploadExcel(Request $request)
   	{
		if($request->hasFile('excel')){
			$path = $request->file('excel')->getRealPath();
			$data = Excel::load($path, function($reader) {})->get();
			$error = '';
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					// if (count($value)==5 || count($value)==6) {
						if (($value->from_code) && ($value->from_desc) && ($value->to_code) && ($value->to_desc) && ($value->factor)) {
							if (count(DB::table('units')->where('to_code','=',$value->to_code)->where('from_code','=',$value->from_code)->get(['id'])->toArray())==0) {
								$insert[] = [
									'from_code'	=>$value->from_code,
									'from_desc'	=>$value->from_desc,
									'to_code'	=>$value->to_code,
									'to_desc'	=>$value->to_desc,
									'factor'	=>$value->factor,
									'created_by'=>Auth::user()->id,
									'created_at'=>date('Y-m-d H:i:s'),
								];
							}
						}else{
							$error[$key] = array('index' => ($key + 2));
						}
					// }else{
					// 	$request->session()->flash('error',trans('lang.wrong_file'));
					// 	return redirect()->back();
					// }
				}
				if(!empty($insert)){
					DB::table('units')->insert($insert);
					$request->session()->flash('success',trans('lang.upload_success'));
				}else{
					$request->session()->flash('error',trans('lang.upload_error'));
				}
			}
			if ($error) {
				$request->session()->flash('bug',$error);
			}
		}
		return redirect()->back();
   	}
}
