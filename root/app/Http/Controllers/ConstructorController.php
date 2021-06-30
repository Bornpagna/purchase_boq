<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\Usage;

class ConstructorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.constructor'),
			'icon'			=> 'fa fa-user',
			'small_title'	=> trans('lang.constructor_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.constructor'),
				],
			],			
			'rounte'		=> url("constr/dt"),
		];
		
		if(hasRole('constructor_add')){
			$data = array_merge($data, ['rounteSave'=> url('constr/save')]);
		}
		if(hasRole('constructor_download')){
			$data = array_merge($data, ['rounteDownload'=> url('constr/excel/download')]);
		}
		if(hasRole('constructor_upload')){
			$data = array_merge($data, ['rounteUploade'	=> url('constr/excel/upload')]);
		}
		return view('constructor.index',$data);
	}
	
	public function getDt()
    {
		$engineer = trans('lang.engineer');
		$sub_const = trans('lang.sub_const');
		$worker = trans('lang.worker');
		$security = trans('lang.security');
		$driver = trans('lang.driver');
		$sql = "SELECT 
				  `pr_constructors`.`id`,
				  `pr_constructors`.`id_card`,
				  `pr_constructors`.`name`,
				  `pr_constructors`.`tel`,
				  `pr_constructors`.`address`,
				  `pr_constructors`.`type`,
				  (
					CASE
					  WHEN pr_constructors.`type` = 1 
					  THEN '$engineer' 
					  WHEN pr_constructors.`type` = 2 
					  THEN '$sub_const' 
					  WHEN pr_constructors.`type` = 3 
					  THEN '$worker' 
					  WHEN pr_constructors.`type` = 4 
					  THEN '$security' 
					  ELSE '$driver' 
					END
				  ) AS `type_desc`,
				  `pr_constructors`.`status`
				FROM
				  `pr_constructors`";
        return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_delete = url('constr/delete/'.$row->id);
			$rounte_edit = url('constr/edit/'.$row->id);
			$btneEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('constructor_edit')){
				$btneEdit = "disabled";
			}
			if((Usage::where(['sub_usage'=>$row->id])->exists()) || (Usage::where(['eng_usage'=>$row->id])->exists())){
				$btnDelete = "disabled";
			}
			if(!hasRole('constructor_delete')){
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
				'id_card'	=>'required|max:20',
				'name' 		=>'required|max:50',
				'tel' 		=>'required|max:20',
				'address' 	=>'required|max:200',
				'type' 		=>'required',
				'status' 	=>'required',
			];
        Validator::make($request->all(),$rules)->validate();
		DB::beginTransaction();
		try {
			$data = [
				'id_card'	=>$request->name,
				'name'		=>$request->id_card,
				'tel'		=>$request->tel,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'type'		=>$request->type,
				'created_by'=>Auth::user()->id,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$id = DB::table('constructors')->insertGetId($data);
			DB::commit();
			if($request->ajax()){
				return ['id'=>$id,'id_card'=>$request->name,'name'=>$request->id_card,'tel'=>$request->tel];
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
				'id_card'	=>'required|max:20',
				'name' 		=>'required|max:50',
				'tel' 		=>'required|max:20',
				'address' 	=>'required|max:200',
				'type' 		=>'required',
				'status' 	=>'required',
			];
    	Validator::make($request->all(),$rules)->validate();
    	DB::beginTransaction();
		try {
			$data = [
				'id_card'	=>$request->name,
				'name'		=>$request->id_card,
				'tel'		=>$request->tel,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'type'		=>$request->type,
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			DB::table('constructors')->where(['id'=>$id])->update($data);
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
			DB::table('constructors')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

    public function downloadExcel()
   	{
   		Excel::create('constructors.export_'.date('Y_m_d_H_i_s'),function($excel){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Constructor Info',function($sheet){
   				$sheet->cell('A1','ID Card');
   				$sheet->cell('B1','Name');
   				$sheet->cell('C1','Tel');
   				$sheet->cell('D1','Type');
   				$sheet->cell('E1','Address');
   				$sheet->cell('F1','Status');
				
				$engineer = 'Engineer';
				$sub_const = 'Sub Constructor';
				$worker = 'Worker';
				$security = 'Security';
				$driver = 'Driver';
				
				$active = 'Active';
				$disable = 'Disable';
				$sql = "SELECT 
				  `pr_constructors`.`id`,
				  `pr_constructors`.`id_card`,
				  `pr_constructors`.`name`,
				  `pr_constructors`.`tel`,
				  `pr_constructors`.`address`,
				  `pr_constructors`.`type`,
				  (
					CASE
					  WHEN pr_constructors.`type` = 1 
					  THEN '$engineer' 
					  WHEN pr_constructors.`type` = 2 
					  THEN '$sub_const' 
					  WHEN pr_constructors.`type` = 3 
					  THEN '$worker' 
					  WHEN pr_constructors.`type` = 4 
					  THEN '$security' 
					  ELSE '$driver' 
					END
				  ) AS `type_desc`,
				  `pr_constructors`.`status`,
				  (
					CASE
					  WHEN pr_constructors.`status` = 1 
					  THEN '$active' 
					  ELSE '$disable' 
					END
				  ) AS `status_desc`
				FROM
				  `pr_constructors`";
				$data = DB::select($sql);
				if(count($data)>0){
					$key=0;
   					foreach ($data as $value) {
	   					$sheet->cell('A'.($key+2),$value->name);
	   					$sheet->cell('B'.($key+2),$value->id_card);
	   					$sheet->cell('C'.($key+2),$value->tel);
	   					$sheet->cell('D'.($key+2),$value->type_desc);
	   					$sheet->cell('E'.($key+2),$value->address);
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
			$arr = ['Engineer'=>1,'Sub Constructor'=>2,'Worker'=>3,'Security'=>4,'Driver'=>5];
			$active = 'Active';
			$disable = 'Disable';
			$error = '';
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					if (count($value)==6) {
						if (($value->id_card) && ($value->name) && ($value->tel) && ($value->address) && ($value->type) && ($value->status)) {
							if (count(DB::table('constructors')->where('name','=',$value->id_card)->get(['id'])->toArray())==0) {
								$status = 0;
								if($value->status == $active){
									$status = 1;
								}
								$insert[] = [
									'id_card'	=>$value->name,
									'name'		=>$value->id_card,
									'tel'		=>$value->tel,
									'address'	=>$value->address,
									'type'		=>isset($arr[$value->type])?$arr[$value->type]:0,
									'status'	=>$status,
									'created_by'=>Auth::user()->id,
									'created_at'=>date('Y-m-d H:i:s'),
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
					DB::table('constructors')->insert($insert);
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
