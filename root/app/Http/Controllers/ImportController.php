<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\StockImport;
use App\Model\Stock;
use App\Model\Item;
use App\Model\Warehouse;
use App\Model\SystemData;
use App\Model\Unit;

class ImportController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.stock_import'),
			'icon'			=> 'fa fa-sign-in',
			'small_title'	=> trans('lang.stock_import_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.stock_import'),
				],
			],
			'rounte'		=> url("stock/import/dt"),
		];
		
		if(hasRole('stock_import_upload')){
			$data = array_merge($data, ['rounteUploade'=> url('stock/import/excel/upload')]);
		}
		if(hasRole('stock_import_download_sample')){
			$data = array_merge($data, ['rounteExample'=> url('stock/import/excel/download/exaple')]);
		}
		return view('stock.import.index',$data);
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$stockImports = StockImport::where(['stock_imports.delete'=> 0,'stock_imports.pro_id' => $pro_id])->get();
        return Datatables::of($stockImports)
		->addColumn('details_url',function($row){
            return url('stock/import/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_delete = url('stock/import/delete/'.$row->id);
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('stock_import_delete')){
				$btnEdit = "disabled";
			}
			return
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function subDt(Request $request, $id)
    {
		$stocks = Stock::where(['stocks.delete'=> 0, 'stocks.trans_ref'=> 'I', 'stocks.ref_id'=> $id, 'stocks.ref_type' => 'stock import'])->get();
        return Datatables::of($stocks)
		->addColumn('item',function($row){
			if($item = Item::find($row->item_id)){
				return "{$item->name} ({$item->code})";
			}
			return '';
		})
		->addColumn('warehouse',function($row){
			if($warehouse = Warehouse::find($row->warehouse_id)){
				return $warehouse->name;
			}
			return '';
		})
		->make(true);
	}
	
	public function downloadExample(Request $request)
   	{
		Excel::create('example_file_upload_stock',function($excel) {
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('upload stock',function($sheet){
   				$sheet->cell('A1', 'Warehouse Name');
   				$sheet->cell('B1', 'Item Code');
   				$sheet->cell('C1', 'Item Name');
   				$sheet->cell('D1', 'Item Type');
   				$sheet->cell('E1', 'Unit Stock');
   				$sheet->cell('F1', 'Unit Purch');
   				$sheet->cell('G1', 'Purch Cost');
   				$sheet->cell('H1', 'Current Qty');
   				$sheet->cell('I1', 'Unit');
   			});
   		})->download('xlsx');
   	}

   	public function uploadExcel(Request $request)
   	{
		
		try{
			ini_set('max_execution_time', 0);
			DB::beginTransaction();
			// check exist file
			if(!$request->hasFile('excel')){
				throw new \Exception("No file selected.");
			}

			if(!$excel_select = $request->file('excel')){
				throw new \Exception("No excel file was created.");
			}

			if(!$data = Excel::load($excel_select->getRealPath(), function($reader) {})->get()){
				throw new \Exception("This excel file no content.");
			}

			if(empty($data)){
				throw new \Exception("This excel is empty.");
			}

			$projectID = $request->session()->get('project');

			$reference_no = generatePrefix('IMP', 'StockImport', 'ref_no');
			$import = [
				'pro_id'		=>$projectID,
				'ref_no'		=>$reference_no,
				'trans_date'	=>date('Y-m-d'),
				'file_type'		=>$excel_select->getClientOriginalExtension(),
				'file_name'		=>$excel_select->getClientOriginalName(),
				'created_by'	=>Auth::user()->id,
				'created_at'	=>date('Y-m-d H:i:s'),
			];

			if(!$id = DB::table('stock_imports')->insertGetId($import)){
				throw new \Exception("Stock imports not insert.");
			}

			foreach($data as $index => $row){
				$cellCount = $index + 1;

				if(empty($row->warehouse_name)){
					throw new \Exception("Column[A{$cellCount}] is empty");
				}

				if(!$warehouse = Warehouse::where(['name' => $row->warehouse_name])->first()){
					throw new \Exception("Warehouse[{$row->warehouse_name}] not found at Column[A{$cellCount}]");
				}

				if(empty($row->item_code)){
					throw new \Exception("Column[B{$cellCount}] is empty");
				}

				if(!$item = Item::where(['code' => $row->item_code])->first()){

					if(empty($row->item_name)){
						throw new \Exception("Column[C{$cellCount}] is empty");
					}
	
					if(empty($row->item_type)){
						throw new \Exception("Column[D{$cellCount}] is empty");
					}
	
					if(!$itemType = SystemData::where(['name' => $row->item_type])->first()){
						$itemTypeColumns = [
							'name' => $row->item_type,
							'desc' => $row->item_type,
							'type' => 'IT',
							'parent_id' => $projectID,
							'created_by' => Auth::user()->id,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_by' => Auth::user()->id,
							'updated_at' => date('Y-m-d H:i:s'),
						];
						if(!$itemTypeID = DB::table('system_datas')->insertGetId($itemTypeColumns)){
							DB::rollback();
							throw new \Exception("Item Type[{$row->item_type}] not insert at Column[D{$cellCount}]");
						}

						$itemType = SystemData::find($itemTypeID);
					}

					$itemColumns = [
						'cat_id' => $itemType->id,
						'code' => $row->item_code,
						'name' => $row->item_name,
						'desc' => $row->item_name,
						'alert_qty' => 10,
						'unit_stock' => $row->unit_stock,
						'unit_purch' => $row->unit_purch,
						'unit_usage' => $row->unit,
						'cost_purch' => $row->purch_cost,
						'created_by' => Auth::user()->id,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_by' => Auth::user()->id,
						'updated_at' => date('Y-m-d H:i:s'),
					];

					if(!$itemId = DB::table('items')->insertGetId($itemColumns)){
						DB::rollback();
						throw new \Exception("Item[{$row->item_code}] not insert at Column[B{$cellCount}]");
					}

					$item = Item::find($itemId);
				}

				if(empty($row->unit_stock)){
					throw new \Exception("Column[E{$cellCount}] is empty");
				}

				if(empty($row->unit_purch)){
					throw new \Exception("Column[F{$cellCount}] is empty");
				}

				if(empty($row->purch_cost)){
					throw new \Exception("Column[G{$cellCount}] is empty");
				}

				if(empty($row->current_qty)){
					throw new \Exception("Column[H{$cellCount}] is empty");
				}

				if(empty($row->unit)){
					throw new \Exception("Column[I{$cellCount}] is empty");
				}

				$insert = [
					'pro_id'		=> $projectID,
					'ref_id'		=> $id,
					'ref_no'		=> $reference_no,
					'ref_type'		=> 'stock import',
					'line_no'		=> formatZero(($key+1), 3),
					'item_id'		=> $item->id,
					'unit'			=> trim($row->unit),
					'qty'			=> trim($row->current_qty),
					'cost'			=> $row->purch_cost,
					'amount'		=> $row->current_qty * $row->purch_cost,
					'warehouse_id'	=> $warehouse->id,
					'trans_date'	=> date('Y-m-d'),
					'trans_ref'		=> 'I',
					'alloc_ref'		=> $reference_no,
					'reference'		=> 'upload excel file',
					'created_by'	=> Auth::user()->id,
					'created_at'	=> date('Y-m-d H:i:s'),
					'updated_by'	=> Auth::user()->id,
					'updated_at'	=> date('Y-m-d H:i:s'),
				];

				if(!$stockID = DB::table('stocks')->insertGetId($insert)){
					DB::rollback();
					throw new \Exception("Stock not insert");
				}
			}

			DB::commit();
			return redirect('stock/import')->with("success", trans('lang.upload_success'));
		}catch(\Exception $ex){
			DB::rollback();
			return redirect('stock/import')->with("error", $ex->getMessage());
		}
   	}
	
	public function destroy($id)
    {
		try {
			DB::beginTransaction();
			$obj = StockImport::find($id);
			if(checkAllocate("O", $obj->ref_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}
			$data = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stock_imports')->where(['id'=>$id])->update($data);
			$stock = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$obj->ref_no,'ref_type'=>'stock import','trans_ref'=>'I'])->update($stock);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
