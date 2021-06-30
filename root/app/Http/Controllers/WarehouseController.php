<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Session;
use App\Model\Stock;

class WarehouseController extends Controller
{
	public function __warehouseuct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.warehouse'),
			'icon'			=> 'fa fa-building',
			'small_title'	=> trans('lang.warehouse_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.warehouse'),
				],
			],			
			'rounte'		=> url("warehouse/dt"),
		];
		
		if(hasRole('warehouse_add')){
			$data = array_merge($data, ['rounteSave'=> url('warehouse/save')]);
		}
		if(hasRole('warehouse_download')){
			$data = array_merge($data, ['rounteDownload'=> url('warehouse/excel/download')]);
		}
		if(hasRole('warehouse_upload')){
			$data = array_merge($data, ['rounteUploade'	=> url('warehouse/excel/upload')]);
		}
		return view('warehouse.index',$data);
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT 
				  pr_warehouses.`id`,
				  pr_warehouses.`name`,
				  pr_warehouses.`address`,
				  pr_warehouses.`user_control`,
				  (SELECT 
					pr_users.`name` 
				  FROM
					pr_users 
				  WHERE pr_users.`id` = pr_warehouses.`user_control`) AS user_control_name,
				  `pr_warehouses`.`tel`,
				  `pr_warehouses`.status
				FROM
				  pr_warehouses 
				WHERE pr_warehouses.`pro_id`='$pro_id'";
        return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_delete = url('warehouse/delete/'.$row->id);
			$rounte_edit = url('warehouse/edit/'.$row->id);
			$btneEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('warehouse_edit')){
				$btneEdit = "disabled";
			}
			if(Stock::where(['warehouse_id'=>$row->id])->exists()){
				$btnDelete = "disabled";
			}
			if(!hasRole('warehouse_delete')){
				$btnDelete = "disabled";
			}
            return
				'<a '.$btneEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
       })->make(true);
    }

    public function save(Request $request){
		$rules = [
			'name' 		=>'required|max:50|unique_warehouse',
			'tel' 		=>'required|max:20',
			'address' 	=>'required|max:200',
			'user_control' 	=>'required',
			'status' 	=>'required',
		];
        Validator::make($request->all(),$rules)->validate();
		DB::beginTransaction();
		try {
			$data = [
				'name'		=>$request->name,
				'tel'		=>$request->tel,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'user_control'	=>$request->user_control,
				'pro_id'	=>$request->session()->get('project'),
				'created_by'=>Auth::user()->id,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$id = DB::table('warehouses')->insertGetId($data);
			DB::commit();
			if($request->ajax()){
				return ['id'=>$id, 'name'=>$request->name];
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
		$unique = '';
		if($request->name!=$request->old_name){
			$unique = '|unique_warehouse';
		}
    	$rules = [
			'name' 		=>'required|max:50',
			'tel' 		=>'required|max:20',
			'address' 	=>'required|max:200',
			'user_control' 	=>'required',
			'status' 	=>'required',
		];
    	Validator::make($request->all(),$rules)->validate();
    	DB::beginTransaction();
		try {
			$data = [
				'name'		=>$request->name,
				'tel'		=>$request->tel,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'user_control'	=>$request->user_control,
				'pro_id'	=>$request->session()->get('project'),
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			DB::table('warehouses')->where(['id'=>$id])->update($data);
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
			DB::table('warehouses')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

    public function downloadExcel()
   	{
   		Excel::create('warehouses.export_'.date('Y_m_d_H_i_s'),function($excel){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Constructor Info',function($sheet){
   				$sheet->cell('A1','Name');
   				$sheet->cell('B1','User Control');
   				$sheet->cell('C1','Tel');
   				$sheet->cell('D1','Address');
   				$sheet->cell('E1','Status');
				
				$active = trans('lang.active');
				$disable = trans('lang.disable');
				$pro_id = Session::get('project');
				$sql = "SELECT 
						  pr_warehouses.`id`,
						  pr_warehouses.`name`,
						  pr_warehouses.`address`,
						  (SELECT 
							pr_users.`name` 
						  FROM
							pr_users 
						  WHERE pr_users.`id` = pr_warehouses.`user_control`) AS user_control,
						  `pr_warehouses`.`tel`,
						  (
							CASE
							  WHEN pr_warehouses.`status` = 1 
							  THEN '$active' 
							  ELSE '$disable' 
							END
						  ) AS `status`
						FROM
						  pr_warehouses 
						WHERE pr_warehouses.`pro_id`='$pro_id'";
				$data = DB::select($sql);
				if(count($data)>0){
					$key=0;
   					foreach ($data as $value) {
	   					$sheet->cell('A'.($key+2),$value->name);
	   					$sheet->cell('B'.($key+2),$value->user_control);
	   					$sheet->cell('C'.($key+2),$value->tel);
	   					$sheet->cell('D'.($key+2),$value->address);
	   					$sheet->cell('E'.($key+2),$value->status);
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
			$pro_id = $request->session()->get('project');
			$error = '';
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					if (count($value)==4 || count($value)==5) {
						if (($value->name) && ($value->tel) && ($value->address) && ($value->user_control)) {
							if (count(DB::table('warehouses')->where('name','=',$value->name)->where('pro_id','=',$pro_id)->get(['id'])->toArray())==0) {
								$user_control = 0;
								$userObj = DB::table('users')->where(['name'=>$value->user_control])->first();
								if($userObj){
									$user_control = $userObj->id;
								}
								$insert[] = [
									'name'			=>$value->name,
									'tel'			=>$value->tel,
									'address'		=>$value->address,
									'user_control'	=>$user_control,
									'pro_id'		=>$pro_id,
									'created_by'	=>Auth::user()->id,
									'created_at'	=>date('Y-m-d H:i:s'),
								];
							}
						}else{
							$error[$key] = array('index' => ($key + 2));
						}
					}else{
						$request->session()->flash('error',trans('lang.wrong_file'));
						return redirect()->back();
					}
				}
				if(!empty($insert)){
					DB::table('warehouses')->insert($insert);
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
