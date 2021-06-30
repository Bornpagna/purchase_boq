<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\StockEntry;
use App\Model\Stock;
use App\Model\Item;
use App\Model\Warehouse;
use App\Model\Supplier;

class EntryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function GetDetail(Request $request)
    {
    	try {
			
			$select = [
				'stocks.*',
				'items.cat_id',
				'items.code',
				'items.name',
				'items.alert_qty',
				'items.unit_stock',
				'items.unit_usage',
				'items.unit_purch',
				'items.cost_purch'
			];

			$OrderItem  = Stock::select($select)
						->leftJoin('items','stocks.item_id','items.id')
						->where('stocks.ref_id',$request->id)
						->where('stocks.ref_no',$request->code)
						->where('stocks.ref_type','stock entry')
						->where('stocks.delete',0)
						->get();

			return response()->json($OrderItem,200); 

		} catch (\Exception $e) {
			return response()->json([],200);
		}
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.stock_entry'),
			'icon'			=> 'fa fa-sign-in',
			'small_title'	=> trans('lang.stock_entry_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.stock_entry'),
				],
			],
			'rounte'		=> url("stock/entry/dt"),
		];
		if(hasRole('stock_entry_add')){
			$data = array_merge($data, ['rounteAdd'=> url('stock/entry/add')]);
		}
		return view('stock.entry.index',$data);
	}
	
	public function add(){
		$data = [
			'title'			=> trans('lang.stock_entry'),
			'icon'			=> 'fa fa-plus',
			'small_title'	=> trans('lang.add_new'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'index'	=> [
						'url' 		=> url('stock/entry'),
						'caption' 	=> trans('lang.stock_entry'),
				],
				'add'	=> [
						'caption' 	=> trans('lang.add_new'),
				],
			],
			'rounteSave'	=> url('stock/entry/save'),		
			'rounteBack'	=> url('stock/entry'),		
		];
		return view('stock.entry.add',$data);
	}
	
	public function edit(Request $request, $id){
		$id = decrypt($id);
		$obj = StockEntry::find($id);
		if($obj){
			$data = [
				'title'			=> trans('lang.stock_entry'),
				'icon'			=> 'fa fa-edit',
				'small_title'	=> trans('lang.edit'),
				'background'	=> '',
				'link'			=> [
					'home'	=> [
							'url' 		=> url('/'),
							'caption' 	=> trans('lang.home'),
					],
					'index'	=> [
							'url' 		=> url('stock/entry'),
							'caption' 	=> trans('lang.stock_entry'),
					],
					'edit'	=> [
							'caption' 	=> trans('lang.edit'),
					],
				],
				'rounteSave'	=> url('stock/entry/update/'.$id),		
				'rounteBack'	=> url('stock/entry'),		
				'obj'	=> $obj,		
			];
			return view('stock.entry.edit',$data);
		}else{
			return redirect()->back();
		}
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$stockEntries = StockEntry::where(['stock_entries.delete' => 0, 'stock_entries.pro_id' => $pro_id])->get();
        return Datatables::of($stockEntries)
		->addColumn('supplier',function($row){
			if($supplier = Supplier::find($row->sup_id)){
				return "{$supplier->name} ({$supplier->desc})";
			}
			return '';
		})
		->addColumn('details_url',function($row){
            return url('stock/entry/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_delete = url('stock/entry/delete/'.$row->id);
			$rounte_edit = url('stock/entry/edit/'.encrypt($row->id));
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';			
			
			if(!hasRole('stock_entry_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('stock_entry_delete')){
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
	
	public function subDt(Request $request, $id)
    {
		$stocks = Stock::where('stocks.delete',0)
				->where('stocks.trans_ref','I')
				->where('stocks.ref_id',$id)
				->where('stocks.ref_type','stock entry')
				->get();

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

    public function save(Request $request){
		$rules = [
			'reference_no' 	=>'required|max:20|unique_stock_entry',
			'trans_date' 	=>'required|max:20',
			'supplier' 		=>'required|max:11',
		];
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i] 		= 'required';
				$rules['line_warehouse.'.$i] 	= 'required|max:11';
				$rules['line_item.'.$i] 		= 'required|max:11';
				$rules['line_unit.'.$i] 		= 'required';
				$rules['line_qty.'.$i] 			= 'required';
			}
		}
        Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();
			$originalDate = $request['trans_date'];
			$trans_date = date("Y-m-d", strtotime($originalDate));
			$data = [
				'pro_id'		=>$request->session()->get('project'),
				'ref_no'		=>$request->reference_no,
				'trans_date'	=>$trans_date,
				'sup_id'		=>$request->supplier,
				'desc'			=>$request->desc,
				'created_by'	=>Auth::user()->id,
				'created_at'	=>date('Y-m-d H:i:s'),
			];
			if(!$id = DB::table('stock_entries')->insertGetId($data)){
				throw new \Exception("Data not insert to table stock_entries.");
			}

			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){

					$stockIn = [
						'pro_id'         =>$request->session()->get('project'),
						'ref_id'         =>$id,
						'ref_no'         =>$request->reference_no,
						'ref_type'       =>'stock entry',
						'line_no'        =>$request['line_index'][$i],
						'item_id'        =>$request['line_item'][$i],
						'unit'           =>$request['line_unit'][$i],
						'qty'            =>$request['line_qty'][$i],
						'warehouse_id'   =>$request['line_warehouse'][$i],
						'trans_date'     =>$trans_date,
						'trans_ref'      =>'I',
						'alloc_ref'      =>$request->reference_no,
						'reference'      =>$request['line_reference'][$i],
						'created_by'     =>Auth::user()->id,
						'created_at'     =>date('Y-m-d H:i:s'),
					];

					if (getSetting()->is_costing==1) {
						if ($request['line_cost'][$i]) {
							$cost 	= floatval($request['line_cost'][$i]);
							$qty 	= floatval($request['line_qty'][$i]);
							$amount = $cost * $qty;

							$stockIn = array_merge($stockIn,['cost' => $cost]);
							$stockIn = array_merge($stockIn,['amount' => $amount]);
						}
					}

					if(!$stockID = DB::table('stocks')->insertGetId($stockIn)){
						DB::rollback();
						throw new \Exception("Stock not insert at row[{$i}]");
					}
				}
			}
			DB::commit();
			if($request->btnSubmit==1){
				return redirect('stock/entry')->with('success',trans('lang.save_success'));
			}
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

    public function update(Request $request, $id)
    {
		$rules = [
			'reference_no' 	=>'required|max:20',
			'trans_date' 	=>'required|max:20',
			'supplier' 		=>'required|max:11',
		];
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i] 		= 'required';
				$rules['line_warehouse.'.$i] 	= 'required|max:11';
				$rules['line_item.'.$i] 		= 'required|max:11';
				$rules['line_unit.'.$i] 		= 'required';
				$rules['line_qty.'.$i] 			= 'required';
			}
		}
        Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();
			$originalDate = $request['trans_date'];
			$trans_date = date("Y-m-d", strtotime($originalDate));
			if(checkAllocate("O", $request->reference_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}

			if(!$stockEntry = StockEntry::find($id)){
				throw new \Exception("StockEntry[{$id}] not found.");
			}

			$data = [
				'trans_date'	=>$trans_date,
				'sup_id'		=>$request->supplier,
				'desc'			=>$request->desc,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];

			// update stock entries
			DB::table('stock_entries')->where(['id'=>$id])->update($data);
			// delete all stock transaction of stock entries
			DB::table('stocks')->where([
				'ref_id' 	=> $id,
				'ref_no' 	=> $stockEntry->ref_no,
				'ref_type' 	=> 'stock entry',
			])->delete();

			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){

					$stockIn = [
						'item_id'        =>$request['line_item'][$i],
						'unit'           =>$request['line_unit'][$i],
						'qty'            =>$request['line_qty'][$i],
						'warehouse_id'   =>$request['line_warehouse'][$i],
						'trans_date'     =>$trans_date,
						'reference'      =>$request['line_reference'][$i],
						'updated_by'     =>Auth::user()->id,
						'updated_at'     =>date('Y-m-d H:i:s'),
					];

					if (getSetting()->is_costing==1) {
						if ($request['line_cost'][$i]) {
							$cost 	= floatval($request['line_cost'][$i]);
							$qty 	= floatval($request['line_qty'][$i]);
							$amount = $cost * $qty;

							$stockIn = array_merge($stockIn,['cost' => $cost]);
							$stockIn = array_merge($stockIn,['amount' => $amount]);
						}
					}

					if(!$stockId = DB::table('stocks')->insertGetId()){
						DB::rollback();
						throw new \Exception("Stock row[{$i}] not insert at the moment.");
					}
				}
			}
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
			$obj = StockEntry::find($id);
			if(checkAllocate("O", $obj->ref_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}
			$data = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stock_entries')->where(['id'=>$id])->update($data);
			$stock = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$obj->ref_no,'ref_type'=>'stock entry','trans_ref'=>'I'])->update($stock);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
