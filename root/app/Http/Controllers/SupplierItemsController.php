<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;

class SupplierItemsController extends Controller
{
	public function __supitemsuct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.supplier_items'),
			'icon'			=> 'fa fa-eyedropper',
			'small_title'	=> trans('lang.supplier_items_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.supplier_items'),
				],
			],			
			'rounte'		=> url("supitems/dt"),
		];
		
		if(hasRole('supplier_item_add')){
			$data = array_merge($data, ['rounteSave'=> url('supitems/save')]);
		}
		if(hasRole('supplier_item_download')){
			$data = array_merge($data, ['rounteDownload'=> url('supitems/excel/download')]);
		}
		return view('supplieritems.index',$data);
	}
	
	public function getDt(Request $request)
    {
		$sql = "SELECT 
				  pr_supplier_items.`id`,
				  pr_supplier_items.`sup_id`,
				  (SELECT pr_suppliers.`name` FROM pr_suppliers WHERE pr_suppliers.`id`=pr_supplier_items.`sup_id`)AS sup_name,
				  pr_supplier_items.`item_id`,
				  (SELECT CONCAT(`pr_items`.`code`,' - ', `pr_items`.`name`)AS item_desc FROM pr_items WHERE pr_items.`id`=pr_supplier_items.`item_id`)AS item_desc,
				  pr_supplier_items.`unit`,
				  pr_supplier_items.`price`,
				  pr_supplier_items.`status` 
				FROM
				  pr_supplier_items ";
        return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_delete = url('supitems/delete/'.$row->id);
			$rounte_edit = url('supitems/edit/'.$row->id);
			$btneEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('supplier_edit')){
				$btneEdit = "disabled";
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
		DB::beginTransaction();
		try {
			for ($i=0;$i<count($request['line_no']);$i++) { 
				$data = [
					'sup_id'	=>$request['line_supplier'][$i],
					'item_id'	=>$request['line_item'][$i],
					'unit'		=>$request['line_unit'][$i],
					'price'		=>$request['line_price'][$i],
					'created_by'=>Auth::user()->id,
					'created_at'=>date('Y-m-d H:i:s'),
				];
				DB::table('supplier_items')->insert($data);
			}
			DB::commit();
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

    public function update(Request $request,$id)
    {
    	DB::beginTransaction();
		try {
			$data = [
				'sup_id'	=>$request['supplier'],
				'item_id'	=>$request['item'],
				'unit'		=>$request['unit'],
				'price'		=>$request['price'],
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			DB::table('supplier_items')->where('id',$id)->update($data);
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
			DB::table('supplier_items')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

    public function downloadExcel()
   	{
   		Excel::create('supplier-item.export_'.date('Y_m_d_H_i_s'),function($excel){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Price Books',function($sheet){
   				$sheet->cell('A1','Supplier');
   				$sheet->cell('B1','Item');
   				$sheet->cell('C1','Unit');
   				$sheet->cell('D1','Price');
   				$sheet->cell('E1','Status');
				
				$active = trans('lang.active');
				$disable = trans('lang.disable');
				$sql = "SELECT 
						  pr_supplier_items.`id`,
						  pr_supplier_items.`sup_id`,
						  (SELECT pr_suppliers.`name` FROM pr_suppliers WHERE pr_suppliers.`id`=pr_supplier_items.`sup_id`)AS sup_name,
						  pr_supplier_items.`item_id`,
						  (SELECT CONCAT(`pr_items`.`code`,' - ', `pr_items`.`name`)AS item_desc FROM pr_items WHERE pr_items.`id`=pr_supplier_items.`item_id`)AS item_desc,
						  pr_supplier_items.`unit`,
						  pr_supplier_items.`price`,
						  (CASE WHEN pr_supplier_items.`status`=1 THEN '$active' ELSE '$disable' END)AS `status` 
						FROM
						  pr_supplier_items";
				$data = DB::select($sql);
				if(count($data)>0){
					$key=0;
   					foreach ($data as $value) {
	   					$sheet->cell('A'.($key+2),$value->sup_name);
	   					$sheet->cell('B'.($key+2),$value->item_desc);
	   					$sheet->cell('C'.($key+2),$value->unit);
	   					$sheet->cell('D'.($key+2),$value->price);
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
				foreach ($data as $key => $value) {
					if (count($value)==4 || count($value)==5) {
						if (($value->supplier) && ($value->item) && ($value->unit) && ($value->price)) {
							$insert[] = [
								'sup_id'		=>0,
								'item_id'		=>0,
								'unit'			=>$value->unit,
								'price'			=>$value->price,
								'created_by'	=>Auth::user()->id,
								'created_at'	=>date('Y-m-d H:i:s'),
							];
						}else{
							$error[$key] = array('index' => ($key + 2));
						}
					}else{
						$request->session()->flash('error',trans('lang.wrong_file'));
						return redirect()->back();
					}
				}
				if(!empty($insert)){
					DB::table('supplier_items')->insert($insert);
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
