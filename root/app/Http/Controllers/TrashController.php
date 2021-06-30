<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function fnEntry(){
		$data = [
			'title'			=> trans('lang.stock_entry'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.stock_entry_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'entry'	=> [
					'caption' 	=> trans('lang.stock_entry'),
				],
			],			
			'rounte'		=> url("trash/entry/dt"),
		];
		return view('trash.entry',$data);
	}
	
	public function entryDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT CONCAT(pr_suppliers.`name`,' (', pr_suppliers.`desc`,')')AS `name` FROM pr_suppliers WHERE pr_suppliers.`id` = A.`sup_id`) AS supplier, (SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by` FROM(SELECT pr_stock_entries.`id`, pr_stock_entries.`ref_no`, pr_stock_entries.`trans_date`, pr_stock_entries.`sup_id`, pr_stock_entries.`desc`, pr_stock_entries.updated_by, pr_stock_entries.updated_at FROM pr_stock_entries WHERE pr_stock_entries.`delete` = 1 AND pr_stock_entries.`pro_id` =$pro_id)AS A"; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/entry/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/entry/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_entry_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function entrySubDt(Request $request, $id)
    {
		$sql = "SELECT A.*,(SELECT CONCAT(pr_items.`name`,' (',pr_items.`code`,')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.`warehouse_id`) AS warehouse FROM(SELECT pr_stocks.`line_no`, pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id`, pr_stocks.reference FROM pr_stocks WHERE pr_stocks.`delete` = 1 AND pr_stocks.`trans_ref` = 'I'AND `pr_stocks`.`ref_id` = $id AND pr_stocks.`ref_type` = 'stock entry')AS A"; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnImport(){
		$data = [
			'title'			=> trans('lang.stock_import'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.stock_import_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'import'	=> [
					'caption' 	=> trans('lang.stock_import'),
				],
			],			
			'rounte'		=> url("trash/import/dt"),
		];
		return view('trash.import',$data);
	}
	
	public function importDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by` FROM(SELECT pr_stock_imports.`id`, pr_stock_imports.`ref_no`, pr_stock_imports.`trans_date`, pr_stock_imports.`file_type`, pr_stock_imports.`file_name`, pr_stock_imports.updated_by, pr_stock_imports.updated_at FROM pr_stock_imports WHERE pr_stock_imports.`delete` = 1 AND pr_stock_imports.`pro_id` = $pro_id)AS A"; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/import/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/import/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_import_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function importSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*,(SELECT CONCAT(pr_items.`name`,' (',pr_items.`code`,')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.`warehouse_id`) AS warehouse FROM(SELECT pr_stocks.`line_no`, pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id`, pr_stocks.reference FROM pr_stocks WHERE pr_stocks.`delete` = 1 AND pr_stocks.`trans_ref` = 'I'AND `pr_stocks`.`ref_id` = $id AND pr_stocks.`ref_type` = 'stock import')AS A"; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnAdjust(){
		$data = [
			'title'			=> trans('lang.adjustment'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.adjustment_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'adjust'	=> [
					'caption' 	=> trans('lang.adjustment'),
				],
			],			
			'rounte'		=> url("trash/adjust/dt"),
		];
		return view('trash.adjust',$data);
	}
	
	public function adjustDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by` FROM(SELECT pr_stock_adjusts.`id`, pr_stock_adjusts.`ref_no`, pr_stock_adjusts.`trans_date`, pr_stock_adjusts.`reference`, pr_stock_adjusts.`desc`, pr_stock_adjusts.`updated_by`, pr_stock_adjusts.`updated_at` FROM pr_stock_adjusts WHERE pr_stock_adjusts.`delete` = 1 AND pr_stock_adjusts.`pro_id` = $pro_id)AS A"; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/adjust/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/adjust/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_adjust_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function adjustSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.`warehouse_id`) AS warehouse, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item FROM (SELECT pr_stock_adjust_details.`id`, pr_stock_adjust_details.`warehouse_id`, pr_stock_adjust_details.`line_no`, pr_stock_adjust_details.`item_id`, pr_stock_adjust_details.`unit`, pr_stock_adjust_details.`stock_qty`, pr_stock_adjust_details.`current_qty`, pr_stock_adjust_details.`adjust_qty`, pr_stock_adjust_details.`note` FROM pr_stock_adjust_details WHERE `pr_stock_adjust_details`.`delete` = 1 AND pr_stock_adjust_details.`adjust_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnMove(){
		$data = [
			'title'			=> trans('lang.movement'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.movement_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'move'	=> [
					'caption' 	=> trans('lang.movement'),
				],
			],			
			'rounte'		=> url("trash/move/dt"),
		];
		return view('trash.move',$data);
	}
	
	public function moveDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by` FROM(SELECT pr_stock_moves.`id`, pr_stock_moves.`ref_no`, pr_stock_moves.`trans_date`, pr_stock_moves.`reference`, pr_stock_moves.`desc`, pr_stock_moves.`updated_by`, pr_stock_moves.`updated_at` FROM pr_stock_moves WHERE pr_stock_moves.`delete` = 1 AND pr_stock_moves.`pro_id` = $pro_id)AS A"; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/move/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/move/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_move_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function moveSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.from_warehouse_id) AS from_warehouse, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.to_warehouse_id) AS to_warehouse, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item FROM (SELECT pr_stock_move_details.`line_no`, pr_stock_move_details.`item_id`, pr_stock_move_details.`unit`, pr_stock_move_details.`qty`, pr_stock_move_details.`note`, pr_stock_move_details.`from_warehouse_id`, pr_stock_move_details.`to_warehouse_id` FROM pr_stock_move_details WHERE pr_stock_move_details.`delete` = 1 AND pr_stock_move_details.`move_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnDelivery(){
		$data = [
			'title'			=> trans('lang.delivery'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.delivery_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'delivery'	=> [
					'caption' 	=> trans('lang.delivery'),
				],
			],			
			'rounte'		=> url("trash/delivery/dt"),
		];
		return view('trash.delivery',$data);
	}
	
	public function deliveryDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, (SELECT pr_orders.`ref_no` FROM pr_orders WHERE pr_orders.`id` = A.po_id) AS po_ref, (SELECT CONCAT(pr_suppliers.`desc`,' (',pr_suppliers.`name`,')') FROM pr_suppliers WHERE pr_suppliers.`id` = A.sup_id) AS supplier FROM (SELECT `pr_deliveries`.`id`, `pr_deliveries`.`po_id`, `pr_deliveries`.`sup_id`, `pr_deliveries`.`ref_no`, `pr_deliveries`.`trans_date`, `pr_deliveries`.`sub_total`, `pr_deliveries`.`disc_usd`, `pr_deliveries`.`grand_total`, `pr_deliveries`.`note`, `pr_deliveries`.`photo`, `pr_deliveries`.updated_by, `pr_deliveries`.updated_at FROM `pr_deliveries` WHERE `pr_deliveries`.`delete` = 1 AND pr_deliveries.pro_id = $pro_id) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/delivery/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/delivery/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_delivery_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function deliverySubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.warehouse_id) AS warehouse, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item FROM (SELECT pr_delivery_items.`id`, pr_delivery_items.`warehouse_id`, pr_delivery_items.`line_no`, pr_delivery_items.`item_id`, pr_delivery_items.`unit`, pr_delivery_items.`qty`, pr_delivery_items.`price`, pr_delivery_items.`amount`, pr_delivery_items.`disc_usd`, pr_delivery_items.`total`, pr_delivery_items.desc FROM pr_delivery_items WHERE pr_delivery_items.`del_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnReturnDelivery(){
		$data = [
			'title'			=> trans('lang.return_delivery'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.return_delivery_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'return'	=> [
					'caption' 	=> trans('lang.return_delivery'),
				],
			],			
			'rounte'		=> url("trash/redelivery/dt"),
		];
		return view('trash.redelivery',$data);
	}
	
	public function redeliveryDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, (SELECT pr_deliveries.`ref_no` FROM pr_deliveries WHERE pr_deliveries.`id` = A.del_id) AS deliv_no, (SELECT CONCAT(pr_suppliers.`desc`, ' (', `pr_suppliers`.`name`, ')') AS `name` FROM pr_suppliers WHERE pr_suppliers.`id` = A.sup_id) AS supplier FROM (SELECT pr_return_deliveries.`id`, pr_return_deliveries.`del_id`, pr_return_deliveries.`sup_id`, pr_return_deliveries.`ref_no`, pr_return_deliveries.`trans_date`, pr_return_deliveries.`sub_total`, `pr_return_deliveries`.`refund`, pr_return_deliveries.`grand_total`, pr_return_deliveries.`desc`, pr_return_deliveries.photo, `pr_return_deliveries`.updated_by, `pr_return_deliveries`.updated_at FROM pr_return_deliveries WHERE pr_return_deliveries.`pro_id` = $pro_id AND pr_return_deliveries.`delete` = 1) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/redelivery/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/redelivery/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_return_delivery_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function redeliverySubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.warehouse_id) AS from_warehouse, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item FROM (SELECT pr_return_delivery_items.`id`, pr_return_delivery_items.`line_no`, pr_return_delivery_items.`item_id`, pr_return_delivery_items.`qty`, pr_return_delivery_items.`unit`, pr_return_delivery_items.`price`, pr_return_delivery_items.`amount`, pr_return_delivery_items.`refund`, pr_return_delivery_items.`total`, pr_return_delivery_items.`warehouse_id`, pr_return_delivery_items.`note` FROM pr_return_delivery_items WHERE pr_return_delivery_items.`return_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnUsage(){
		$data = [
			'title'			=> trans('lang.usage'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.usage_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'usage'	=> [
					'caption' 	=> trans('lang.usage'),
				],
			],			
			'rounte'		=> url("trash/usage/dt"),
		];
		return view('trash.usage',$data);
	}
	
	public function usageDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, (SELECT CONCAT(pr_constructors.`id_card`, ' (', `pr_constructors`.`name`, ')') AS `name` FROM pr_constructors WHERE pr_constructors.`id` = A.eng_usage) AS engineer, (SELECT CONCAT(pr_constructors.`id_card`, ' (', `pr_constructors`.`name`, ')') AS `name` FROM pr_constructors WHERE pr_constructors.`id` = A.sub_usage) AS sub_constructor FROM (SELECT pr_usages.`id`, pr_usages.`ref_no`, pr_usages.`trans_date`, pr_usages.`eng_usage`, pr_usages.`sub_usage`, pr_usages.`desc`, `pr_usages`.updated_by, `pr_usages`.updated_at FROM pr_usages WHERE pr_usages.`delete` = 1 AND pr_usages.`pro_id` = $pro_id) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/usage/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/usage/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_usage_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function usageSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.warehouse_id) AS from_warehouse, (SELECT pr_system_datas.`name` FROM pr_system_datas WHERE pr_system_datas.`type` = 'ST'AND pr_system_datas.`id` = A.street_id) AS street, (SELECT pr_houses.`house_no` FROM pr_houses WHERE pr_houses.`id` = A.house_id) AS on_house FROM (SELECT pr_usage_details.`id`, pr_usage_details.`line_no`, pr_usage_details.`item_id`, pr_usage_details.`unit`, pr_usage_details.`qty`, pr_usage_details.`note`, pr_usage_details.`warehouse_id`, pr_usage_details.`house_id`, pr_usage_details.`street_id` FROM pr_usage_details WHERE pr_usage_details.`delete` = 1 AND pr_usage_details.`use_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function fnReturnUsage(){
		$data = [
			'title'			=> trans('lang.return_usage'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.return_usage_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'reusage'	=> [
					'caption' 	=> trans('lang.return_usage'),
				],
			],			
			'rounte'		=> url("trash/reusage/dt"),
		];
		return view('trash.reusage',$data);
	}
	
	public function reusageDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*,(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, (SELECT CONCAT(pr_constructors.`id_card`, ' (',`pr_constructors`.`name`,')')AS `name` FROM pr_constructors WHERE pr_constructors.`id` = A.eng_return) AS engineer, (SELECT CONCAT(pr_constructors.`id_card`, ' (',`pr_constructors`.`name`,')')AS `name` FROM pr_constructors WHERE pr_constructors.`id` = A.sub_return) AS sub_constructor FROM (SELECT pr_return_usages.`id`, pr_return_usages.`ref_no`, pr_return_usages.`trans_date`, pr_return_usages.`eng_return`, pr_return_usages.`sub_return`, pr_return_usages.`desc`, `pr_return_usages`.updated_by, `pr_return_usages`.updated_at FROM pr_return_usages WHERE pr_return_usages.`delete` = 1 AND pr_return_usages.`pro_id` = $pro_id) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/reusage/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/reusage/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_stock_return_usage_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function reusageSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.warehouse_id) AS from_warehouse, (SELECT pr_system_datas.`name` FROM pr_system_datas WHERE pr_system_datas.`type`='ST' AND pr_system_datas.`id`=A.street_id)AS street, (SELECT pr_houses.`house_no` FROM pr_houses WHERE pr_houses.`id` = A.house_id) AS on_house FROM (SELECT pr_return_usage_details.`id`, pr_return_usage_details.`line_no`, pr_return_usage_details.`item_id`, pr_return_usage_details.`unit`, pr_return_usage_details.`qty`, pr_return_usage_details.`note`, pr_return_usage_details.`warehouse_id`, pr_return_usage_details.`house_id`, pr_return_usage_details.`street_id` FROM pr_return_usage_details WHERE pr_return_usage_details.`delete` = 1 AND pr_return_usage_details.`return_id` = $id) AS A "; return Datatables::of(DB::select($sql))->make(true);
	}

	public function fnRequest(){
		$data = [
			'title'			=> trans('lang.request'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.request_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'request'	=> [
					'caption' 	=> trans('lang.request'),
				],
			],			
			'rounte'		=> url("trash/request/dt"),
		];
		return view('trash.request',$data);
	}

	public function requestDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.id, A.ref_no, A.trans_date, A.delivery_date, A.trans_status, (SELECT CONCAT(pr_constructors.`id_card`, ' (', pr_constructors.`name`, ')') AS `name` FROM pr_constructors WHERE pr_constructors.`id` = A.request_by) AS request_by, (SELECT CONCAT(pr_system_datas.`desc`, ' (', pr_system_datas.`name`, ')') FROM pr_system_datas WHERE pr_system_datas.`id` = A.dep_id) AS `department`, A.note, A.created_by, (SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, A.updated_at FROM (SELECT pr_requests.`id`, pr_requests.`ref_no`, pr_requests.`trans_date`, pr_requests.`delivery_date`, pr_requests.`trans_status`, pr_requests.`request_by`, pr_requests.dep_id, pr_requests.`note`, pr_requests.`created_by`, pr_requests.`updated_by`, pr_requests.`updated_at` FROM pr_requests WHERE pr_requests.`pro_id` = $pro_id AND pr_requests.`trans_status` = 0) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/request/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/request/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_request_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function requestSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT CONCAT(pr_items.`name`,' (',pr_items.`code`,')') AS `name` FROM pr_items WHERE pr_items.`id` = A.item_id) AS item FROM (SELECT pr_request_items.`id`, pr_request_items.`line_no`, pr_request_items.`item_id`, pr_request_items.`unit`, pr_request_items.`qty`, pr_request_items.`desc`,pr_request_items.`size`,pr_request_items.`remark` FROM pr_request_items WHERE pr_request_items.`pr_id` = $id) AS A";
        return Datatables::of(DB::select($sql))->make(true);
	}

	public function fnOrder(){
		$data = [
			'title'			=> trans('lang.order'),
			'icon'			=> 'fa fa-trash-o',
			'small_title'	=> trans('lang.order_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'trash'	=> [
					'caption' 	=> trans('lang.trash'),
					'url' 		=> url('/'),
				],
				'order'	=> [
					'caption' 	=> trans('lang.order'),
				],
			],			
			'rounte'		=> url("trash/order/dt"),
		];
		return view('trash.order',$data);
	}

	public function orderDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sql = "SELECT A.*, (SELECT pr_requests.`ref_no` FROM pr_requests WHERE pr_requests.`id` = A.pr_id) AS pr_no, (SELECT CONCAT(pr_warehouses.`address`, ' (', pr_warehouses.`name`, ')') AS `name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.delivery_address) AS warehouse, (SELECT CONCAT(pr_suppliers.`desc`, ' (', `pr_suppliers`.`name`, ')') AS `name` FROM pr_suppliers WHERE pr_suppliers.`id` = A.sup_id) AS supplier, (SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id` = A.ordered_by) AS ordered_by, (SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`= `A`.`updated_by`)AS `updated_by`, A.updated_at FROM (SELECT pr_orders.id, pr_orders.`pr_id`, pr_orders.`sup_id`, pr_orders.`ref_no`, pr_orders.`trans_date`, pr_orders.`delivery_date`, pr_orders.`delivery_address`, pr_orders.`trans_status`, pr_orders.`sub_total`, pr_orders.`disc_usd`, pr_orders.`grand_total`, pr_orders.`ordered_by`, pr_orders.`note`, pr_orders.`term_pay`, pr_orders.`created_by`, pr_orders.`updated_by`, pr_orders.`updated_at` FROM pr_orders WHERE pr_orders.`trans_status` = 0 AND pr_orders.`pro_id` = $pro_id) AS A "; return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('trash/order/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_restore = url('trash/order/restore/'.$row->id);
			$btnRestore = 'onclick="onRestore(this)"';
			
			if(!hasRole('trash_order_restore')){
				$btnRestore = "disabled";
			}
			return
				'<a '.$btnRestore.' title="'.trans('lang.restore').'" class="btn btn-xs btn-info restore-record" row_id="'.$row->id.'" row_rounte="'.$rounte_restore.'">'.
				'	<i class="fa fa-refresh"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function orderSubDt(Request $request, $id)
    {
		$sql = "SELECT A.*, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = A.`item_id`) AS item FROM (SELECT pr_order_items.`line_no`, pr_order_items.`item_id`, pr_order_items.`unit`, pr_order_items.`qty`, pr_order_items.`price`, pr_order_items.`amount`, pr_order_items.`disc_usd`, pr_order_items.`total`, pr_order_items.`desc` FROM pr_order_items WHERE pr_order_items.`po_id` = $id) AS A ";
        return Datatables::of(DB::select($sql))->make(true);
	}
}
