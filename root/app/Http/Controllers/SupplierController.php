<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\Order;
use App\Model\Delivery;
use App\Model\SupplierItem;

class SupplierController extends Controller
{
	public function __supplieruct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.supplier'),
			'icon'			=> 'fa fa-user',
			'small_title'	=> trans('lang.supplier_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.supplier'),
				],
			],			
			'rounte'		=> url("supplier/dt"),
		];
		
		if(hasRole('supplier_add')){
			$data = array_merge($data, ['rounteSave'=> url('supplier/save')]);
		}
		if(hasRole('supplier_download')){
			$data = array_merge($data, ['rounteDownload'=> url('supplier/excel/download')]);
		}
		if(hasRole('supplier_upload')){
			$data = array_merge($data, ['rounteUploade'	=> url('supplier/excel/upload')]);
		}
		return view('supplier.index',$data);
	}
	
	public function getDt(Request $request)
    {
		$sql = "SELECT 
			  `pr_suppliers`.`id`,
			  `pr_suppliers`.`name`,
			  `pr_suppliers`.`desc`,
			  `pr_suppliers`.`tel`,
			  `pr_suppliers`.`email`,
			  `pr_suppliers`.`address`,
			  `pr_suppliers`.`status`
			FROM
			  `pr_suppliers`";
        return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_delete = url('supplier/delete/'.$row->id);
			$rounte_edit = url('supplier/edit/'.$row->id);
			$btneEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('supplier_edit')){
				$btneEdit = "disabled";
			}
			if((Order::where(['sup_id'=>$row->id])->exists()) || (Delivery::where(['sup_id'=>$row->id])->exists()) || (SupplierItem::where(['sup_id'=>$row->id])->exists())){
				$btnDelete = "disabled";
			}
			if(!hasRole('supplier_delete')){
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
			'name' 		=>'required|max:50|unique:suppliers',
			'desc' 		=>'max:200',
			'tel' 		=>'required|max:100',
			'address' 	=>'required|max:200',
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
				'desc'		=>$request->desc,
				'email'		=>'N/A',
				'created_by'=>Auth::user()->id,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$id = DB::table('suppliers')->insertGetId($data);
			DB::commit();
			if($request->ajax()){
				return ['id'=>$id, 'name'=>$request->name,'desc'=>$request->desc];
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
			$unique = '||unique:suppliers';
		}
    	$rules = [
			'name' 		=>'required|max:50'.$unique,
			'desc' 		=>'max:200',
			'tel' 		=>'required|max:20',
			'address' 	=>'required|max:200',
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
				'desc'		=>$request->desc,
				'email'		=>'N/A',
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			DB::table('suppliers')->where(['id'=>$id])->update($data);
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
			DB::table('suppliers')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

    public function downloadExcel()
   	{
   		Excel::create('suppliers.export_'.date('Y_m_d_H_i_s'),function($excel){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Constructor Info',function($sheet){
   				$sheet->cell('A1','Name');
   				$sheet->cell('B1','Cheque Name');
   				$sheet->cell('C1','Tel');
   				$sheet->cell('D1','Address');
   				$sheet->cell('E1','Status');
				
				$active = 'Active';
				$disable = 'Disable';
				$sql = "SELECT 
					  `pr_suppliers`.`id`,
					  `pr_suppliers`.`name`,
					  `pr_suppliers`.`desc`,
					  `pr_suppliers`.`tel`,
					  `pr_suppliers`.`email`,
					  `pr_suppliers`.`address`,
					  (CASE WHEN `pr_suppliers`.`status`=1 THEN '$active' ELSE '$disable' END)AS `status`
					FROM
					  `pr_suppliers`";
				$data = DB::select($sql);
				if(count($data)>0){
					$key=0;
   					foreach ($data as $value) {
	   					$sheet->cell('A'.($key+2),$value->name);
	   					$sheet->cell('B'.($key+2),$value->desc);
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
			$error = '';
			if(!empty($data) && $data->count()){
				$active = 'Active';
				$disable = 'Disable';
				foreach ($data as $key => $value) {
					if (count($value)==5) {
						if (($value->name) && ($value->tel) && ($value->address) && ($value->cheque_name) && ($value->status)) {
							if (count(DB::table('suppliers')->where('name','=',$value->name)->get(['id'])->toArray())==0) {
								$insert[] = [
									'name'			=>$value->name,
									'tel'			=>$value->tel,
									'address'		=>$value->address,
									'desc'			=>$value->cheque_name,
									'status'		=>$value->status==$disable?0:1,
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
					DB::table('suppliers')->insert($insert);
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
