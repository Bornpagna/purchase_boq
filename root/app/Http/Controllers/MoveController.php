<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\StockMove;
use App\Model\StockMoveDetails;
use App\Model\Warehouse;
use App\Model\Item;

class MoveController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.movement'),
			'icon'			=> 'fa fa-arrows',
			'small_title'	=> trans('lang.movement_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.movement'),
				],
			],
			'rounte'		=> url("stock/move/dt"),
		];
		if(hasRole('stock_move_add')){
			$data = array_merge($data, ['rounteAdd'=> url('stock/move/add')]);
		}
		return view('stock.move.index',$data);
	}
	
	public function add(Request $request){
		$data = [
			'title'			=> trans('lang.movement'),
			'icon'			=> 'fa fa-plus',
			'small_title'	=> trans('lang.add_new'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'index'	=> [
					'url' 		=> url('stock/move'),
					'caption' 	=> trans('lang.movement'),
				],
				'add'	=> [
					'caption' 	=> trans('lang.add_new'),
				],
			],
			'rounteSave'	=> url('stock/move/save'),
			'rounteBack'	=> url('stock/move'),
			'pro_id'		=> $request->session()->get('project'),
		];
		return view('stock.move.add',$data);
	}
	
	public function edit(Request $request, $id){
		$id = decrypt($id);
		$obj = StockMove::find($id);
		if($obj){
			$data = [
				'title'			=> trans('lang.movement'),
				'icon'			=> 'fa fa-edit',
				'small_title'	=> trans('lang.edit'),
				'background'	=> '',
				'link'			=> [
					'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
					],
					'index'	=> [
						'url' 		=> url('stock/move'),
						'caption' 	=> trans('lang.movement'),
					],
					'edit'	=> [
						'caption' 	=> trans('lang.edit'),
					],
				],
				'rounteSave'	=> url('stock/move/update/'.$id),		
				'rounteBack'	=> url('stock/move'),		
				'obj'	=> $obj,
				'pro_id'=> $request->session()->get('project'),
			];
			return view('stock.move.edit',$data);
		}else{
			return redirect()->back();
		}
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$stockMovements = StockMove::where(['delete'=> 0,'pro_id'=> $pro_id])->get();
        return Datatables::of($stockMovements)
		->addColumn('details_url',function($row){
            return url('stock/move/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_delete = url('stock/move/delete/'.$row->id);
			$rounte_edit = url('stock/move/edit/'.encrypt($row->id));
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('stock_move_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('stock_move_delete')){
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
		$stockMovementDetails = StockMoveDetails::where(['delete'=> 0,'move_id' => $id])->get();
		return Datatables::of($stockMovementDetails)
		->addColumn('from_warehouse',function($row){
			if($warehouse = Warehouse::find($row->from_warehouse_id)){
				return $warehouse->name;
			}
			return '';
		})
		->addColumn('to_warehouse',function($row){
			if($warehouse = Warehouse::find($row->to_warehouse_id)){
				return $warehouse->name;
			}
			return '';
		})
		->addColumn('item',function($row){
			if($item = Item::find($row->item_id)){
				return "{$item->name} ({$item->code})";
			}
			return '';
		})
		->make(true);
	}

    public function save(Request $request){
		$rules = [
			'reference_no' 	=>'required|max:20|unique_stock_move',
			'trans_date' 	=>'required|max:20',
			'reference' 	=>'required',
		];
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i]          = 'required';
				$rules['line_from_warehouse.'.$i] = 'required|max:11';
				$rules['line_to_warehouse.'.$i]   = 'required|max:11';
				$rules['line_item.'.$i]           = 'required|max:11';
				$rules['line_unit.'.$i]           = 'required';
				$rules['line_move_qty.'.$i]       = 'required';
				$rules['line_stock_qty.'.$i]      = 'required';
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
				'reference'		=>$request->reference,
				'desc'			=>$request->desc,
				'created_by'	=>Auth::user()->id,
				'created_at'	=>date('Y-m-d H:i:s'),
			];

			if(!$id = DB::table('stock_moves')->insertGetId($data)){
				throw new \Exception("Stock Movement not insert.");
			}

			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){
					$detail = [
						'move_id'			=>$id,
						'from_warehouse_id'	=>$request['line_from_warehouse'][$i],
						'to_warehouse_id'	=>$request['line_to_warehouse'][$i],
						'line_no'			=>$request['line_index'][$i],
						'item_id'			=>$request['line_item'][$i],
						'unit'				=>$request['line_unit'][$i],
						'qty'				=>$request['line_move_qty'][$i],
						'stock_qty'			=>$request['line_stock_qty'][$i],
						'note'				=>$request['line_note'][$i],
						'created_by'		=>Auth::user()->id,
						'created_at'		=>date('Y-m-d H:i:s'),
					];
					DB::table('stock_move_details')->insert($detail);
					$in = [
						'pro_id'		=>$request->session()->get('project'),
						'ref_id'		=>$id,
						'ref_no'		=>$request->reference_no,
						'ref_type'		=>'stock move',
						'line_no'		=>$request['line_index'][$i],
						'item_id'		=>$request['line_item'][$i],
						'unit'			=>$request['line_unit'][$i],
						'qty'			=>$request['line_move_qty'][$i],
						'warehouse_id'	=>$request['line_to_warehouse'][$i],
						'trans_date'	=>$trans_date,
						/*'reference'		=>$request['line_note'][$i],*/
						'reference'		=>$request->reference,
						'trans_ref'		=>'I',
						'alloc_ref'		=>$request->reference_no,
						'created_by'	=>Auth::user()->id,
						'created_at'	=>date('Y-m-d H:i:s'),
					];
					DB::table('stocks')->insert($in);

					$out = [
						'pro_id'		=>$request->session()->get('project'),
						'ref_id'		=>$id,
						'ref_no'		=>$request->reference_no,
						'ref_type'		=>'stock move',
						'line_no'		=>$request['line_index'][$i],
						'item_id'		=>$request['line_item'][$i],
						'unit'			=>$request['line_unit'][$i],
						'qty'			=>($request['line_move_qty'][$i]) * -1,
						'warehouse_id'	=>$request['line_from_warehouse'][$i],
						'trans_date'	=>$trans_date,
						/*'reference'		=>$request['line_note'][$i],*/
						'reference'		=>$request->reference,
						'trans_ref'		=>'O',
						'alloc_ref'		=>getAllocateRef($request->reference_no),
						'created_by'	=>Auth::user()->id,
						'created_at'	=>date('Y-m-d H:i:s'),
					];
					DB::table('stocks')->insert($out);
				}
			}
			DB::commit();
			if($request->btnSubmit==1){
				return redirect('stock/move')->with('success',trans('lang.save_success'));
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
			'reference' 	=>'required',
		];
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i] 			= 'required';
				$rules['line_from_warehouse.'.$i] 	= 'required|max:11';
				$rules['line_to_warehouse.'.$i] 	= 'required|max:11';
				$rules['line_item.'.$i] 		= 'required|max:11';
				$rules['line_unit.'.$i]			= 'required';
				$rules['line_move_qty.'.$i]		= 'required';
				$rules['line_stock_qty.'.$i]	= 'required';
			}
		}
        Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();

			if(!$stockMovement = StockMove::find($id)){
				throw new \Exception("StockMove[{$id}] not found.");
			}

			if(checkAllocate("O", $request->reference_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}

			$originalDate = $request['trans_date'];
			$trans_date = date("Y-m-d", strtotime($originalDate));
			$data = [
				'trans_date'	=>$trans_date,
				'reference'		=>$request->reference,
				'desc'			=>$request->desc,
				'created_by'	=>Auth::user()->id,
				'created_at'	=>date('Y-m-d H:i:s'),
			];
			
			DB::table('stock_moves')->where(['id'=>$id])->update($data);
			DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$request->reference_no,'ref_type'=>'stock move','trans_ref'=>'O'])->delete();
			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){
					$detail = [
						'from_warehouse_id'	=>$request['line_from_warehouse'][$i],
						'to_warehouse_id'	=>$request['line_to_warehouse'][$i],
						'item_id'			=>$request['line_item'][$i],
						'unit'				=>$request['line_unit'][$i],
						'qty'				=>$request['line_move_qty'][$i],
						'stock_qty'			=>$request['line_stock_qty'][$i],
						'note'				=>$request['line_note'][$i],
						'updated_by'	=>Auth::user()->id,
						'updated_at'	=>date('Y-m-d H:i:s'),
					];
					DB::table('stock_move_details')->where(['move_id'=>$id,'delete'=>0,'line_no'=>$request['line_index'][$i]])->update($detail);
					$in = [
						'item_id'		=>$request['line_item'][$i],
						'unit'			=>$request['line_unit'][$i],
						'qty'			=>$request['line_move_qty'][$i],
						'warehouse_id'	=>$request['line_to_warehouse'][$i],
						'trans_date'	=>$trans_date,
						/*'reference'		=>$request['line_note'][$i],*/
						'reference'		=>$request->reference,
						'updated_by'	=>Auth::user()->id,
						'updated_at'	=>date('Y-m-d H:i:s'),
					];
					DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$request->reference_no,'ref_type'=>'stock move','line_no'=>$request['line_index'][$i],'trans_ref'=>'I'])->update($in);

					$out = [
						'pro_id'		=>$request->session()->get('project'),
						'ref_id'		=>$id,
						'ref_no'		=>$request->reference_no,
						'ref_type'		=>'stock move',
						'line_no'		=>$request['line_index'][$i],
						'item_id'		=>$request['line_item'][$i],
						'unit'			=>$request['line_unit'][$i],
						'qty'			=>($request['line_move_qty'][$i])*(-1),
						'warehouse_id'	=>$request['line_from_warehouse'][$i],
						'trans_date'	=>$trans_date,
						'reference'		=>$request->reference,
						/*'reference'		=>$request['line_note'][$i],*/
						'trans_ref'		=>'O',
						'alloc_ref'		=>getAllocateRef($request->reference_no),
						'created_by'	=>Auth::user()->id,
						'created_at'	=>date('Y-m-d H:i:s'),
					];
					DB::table('stocks')->insert($out);
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
			$obj = StockMove::find($id);
			if(checkAllocate("O", $obj->ref_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}
			$data = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stock_moves')->where(['id'=>$id])->update($data);
			$dataDetails = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stock_move_details')->where(['move_id'=>$id])->update($dataDetails);
			$stock = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$obj->ref_no,'ref_type'=>'stock move'])->update($stock);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
