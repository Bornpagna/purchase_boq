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
use PHPExcel_Worksheet_Drawing;
use PHPExcel_IOFactory;

class BalanceController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.stock_balance'),
			'icon'			=> 'fa fa-balance-scale',
			'small_title'	=> trans('lang.stock_balance_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.stock_balance'),
				],
			]
		];
		return view('stock.balance.index',$data);
	}
	
	public function view(Request $request){
		$data = [
			'title'			=> trans('lang.stock_balance'),
			'icon'			=> 'fa fa-eye',
			'small_title'	=> trans('lang.view_details'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'index'	=> [
					'url' 		=> url('stock/balance'),
					'caption' 	=> trans('lang.stock_balance'),
				],
				'view'	=> [
					'caption' 	=> trans('lang.view'),
				],
			],
			'rounteBack'	=> url('stock/balance'),
			'item_id'		=> decrypt($request->item_id),
			'warehouse_id'	=> decrypt($request->warehouse_id),
			'start_date'	=> decrypt($request->sd),
			'end_date'		=> decrypt($request->ed),
		];
		return view('stock.balance.view',$data);
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$sd = $request->query('sd');
		$ed = $request->query('ed');
		$prefix = getSetting()->round_number;

		/*$sql = "SELECT F.warehouse_id, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = F.warehouse_id) AS warehouse, F.item_id, (SELECT CONCAT(pr_items.`name`,' (',pr_items.`code`,')') AS `name` FROM pr_items WHERE pr_items.`id` = F.item_id) AS item, (SELECT pr_items.`photo` FROM pr_items WHERE pr_items.`id` = F.item_id) AS photo, F.unit_stock, F.stock_in, F.stock_out, (F.stock_in + F.stock_out) AS current_stock, (SELECT pr_items.`alert_qty` FROM pr_items WHERE pr_items.`id`=F.item_id)AS alert_qty, (CASE WHEN (SELECT pr_stock_alerts.`id` FROM pr_stock_alerts WHERE pr_stock_alerts.`item_id`=F.item_id AND pr_stock_alerts.`warehouse_id`=F.warehouse_id)!='' THEN 1 ELSE 0 END)AS stock_alert FROM (SELECT E.warehouse_id, E.item_id, E.unit_stock, SUM(E.stock_in) AS stock_in, SUM(E.stock_out) AS stock_out FROM (SELECT D.warehouse_id, D.item_id, D.unit_stock, (CASE WHEN D.stock_qty >= 0 THEN D.stock_qty ELSE 0 END ) AS stock_in, (CASE WHEN D.stock_qty <= 0 THEN D.stock_qty ELSE 0 END ) AS stock_out FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty, C.warehouse_id FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id` FROM pr_stocks WHERE pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` BETWEEN '$sd'AND '$ed') AS A) AS B) AS C) AS D) AS E GROUP BY E.warehouse_id,E.item_id,E.unit_stock) AS F ";*/ 

		$sql = "SELECT G.warehouse_id, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = G.warehouse_id) AS warehouse, (SELECT CONCAT(pr_system_datas.`name`,' (',pr_system_datas.`desc`,')')AS `cat_name` FROM pr_system_datas WHERE pr_system_datas.`id`=(SELECT pr_items.`cat_id` FROM pr_items WHERE pr_items.`id`=G.item_id LIMIT 1) LIMIT 1) AS cat_name, G.item_id, (SELECT CONCAT(pr_items.`name`, ' (', pr_items.`code`, ')') AS `name` FROM pr_items WHERE pr_items.`id` = G.item_id) AS item, (SELECT pr_items.`photo` FROM pr_items WHERE pr_items.`id` = G.item_id) AS photo, G.unit_stock, ROUND(G.begin_balance,$prefix)AS begin_balance, ROUND(G.stock_in,$prefix)AS stock_in, ROUND(G.stock_out, $prefix)AS stock_out, ROUND(ROUND(G.begin_balance, $prefix) + (ROUND(G.stock_in, $prefix) + ROUND(G.stock_out, $prefix)), $prefix)AS ending_balance, (SELECT pr_items.`alert_qty` FROM pr_items WHERE pr_items.`id` = G.item_id) AS alert_qty, (CASE WHEN (SELECT pr_stock_alerts.`id` FROM pr_stock_alerts WHERE pr_stock_alerts.`item_id` = G.item_id AND pr_stock_alerts.`warehouse_id` = G.warehouse_id) != ''THEN 1 ELSE 0 END ) AS stock_alert FROM (SELECT F.warehouse_id, F.item_id, F.unit_stock, SUM(F.begin_balance) AS begin_balance, SUM(F.stock_in) AS stock_in, SUM(F.stock_out) AS stock_out FROM (SELECT E.warehouse_id, E.item_id, E.unit_stock, (0) AS begin_balance, SUM(E.stock_in) AS stock_in, SUM(E.stock_out) AS stock_out FROM (SELECT D.warehouse_id, D.item_id, D.unit_stock, (CASE WHEN D.stock_qty >= 0 THEN D.stock_qty ELSE 0 END ) AS stock_in, (CASE WHEN D.stock_qty <= 0 THEN D.stock_qty ELSE 0 END ) AS stock_out FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty, C.warehouse_id FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id` FROM pr_stocks WHERE pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` BETWEEN '$sd'AND '$ed') AS A) AS B) AS C) AS D) AS E GROUP BY E.warehouse_id, E.item_id, E.unit_stock UNION SELECT E.warehouse_id, E.item_id, E.unit_stock, SUM(E.stock_qty) AS begin_balance, (0) AS stock_in, (0) AS stock_out FROM (SELECT D.warehouse_id, D.item_id, D.unit_stock, D.stock_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty, C.warehouse_id FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id` FROM pr_stocks WHERE pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` < '$sd') AS A) AS B) AS C) AS D) AS E GROUP BY E.warehouse_id, E.item_id, E.unit_stock) AS F GROUP BY F.warehouse_id, F.item_id, F.unit_stock) AS G "; 
		return Datatables::of(DB::select($sql))
		->addColumn('action', function ($row) {
			$rounte_view = url('stock/balance/view/'.encrypt($row->item_id).'/'.encrypt($row->warehouse_id));
			$rounte_alert = url('stock/balance/show_alert/'.$row->item_id.'/'.$row->warehouse_id);
			$title = trans('lang.show_alert');
			$icon = 'fa fa-bell-o';
			$color = 'blue';
			$btnView = 'onclick="onView(this)"';
			$btnAlert = 'onclick="onAlert(this)"';
			
			if(!hasRole('stock_balance_view')){
				$btnEdit = "disabled";
			}
			if(floatval($row->alert_qty) < 0){
				$btnAlert = "disabled";
			}
			if(!hasRole('stock_balance')){
				$btnAlert = "disabled";
			}
			if(floatval($row->alert_qty) >-1 && floatval($row->stock_alert)==1){
				$title = trans('lang.close_alert');
				$rounte_alert = url('stock/balance/close_alert/'.$row->item_id.'/'.$row->warehouse_id);
				$color = 'red';
				$icon = 'fa fa-bell-slash-o';
			}
			return
				'<a '.$btnAlert.' title="'.$title.'" class="btn btn-xs '.$color.' alert-record" row_id="'.$row->item_id.'" row_rounte="'.$rounte_alert.'">'.
				'	<i class="'.$icon.'"></i>'.
				'</a>'.
				'<a '.$btnView.' title="'.trans('lang.view').'" class="btn btn-xs yellow view-record" row_id="'.$row->item_id.'" row_rounte="'.$rounte_view.'">'.
				'	<i class="fa fa-eye"></i>'.
				'</a>'; 
       })->make(true);
    }

    public function downloadExcel(Request $request){
    	$pro_id = $request->session()->get('project');
		$sd = $request->query('sd');
		$ed = $request->query('ed');
		Excel::create('stock_balance_export_'.date('Y_m_d_H_i_s'),function($excel) use($pro_id,$sd,$ed){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Stock Balance',function($sheet) use($pro_id,$sd,$ed){
   				$startRows = 1;
				$sheet->setAutoSize(true);
				$sheet->mergeCells('A1:A3');
				$objDrawing = new PHPExcel_Worksheet_Drawing;
		        $objDrawing->setPath(str_replace('root','',base_path('assets/upload/temps/app_icon.png')));
		        $objDrawing->setCoordinates('A1');
		        $objDrawing->setHeight(120);
		        $objDrawing->setWorksheet($sheet);

				$sheet->mergeCells(('B'.$startRows.':I'.$startRows));
				$sheet->cell(('B'.$startRows),getSetting()->report_header);
				$sheet->cell(('B'.$startRows.':I'.$startRows),function($cells){
					$cells->setFontFamily('Khmer OS Battambang');
                    $cells->setFontSize(28);
                    $cells->setFontColor(getSetting()->report_header_color);
                    $cells->setAlignment('center');
				});
				$startRows++;
				$sheet->mergeCells(('B'.$startRows.':I'.$startRows));
				$sheet->cell(('B'.$startRows),getSetting()->company_name);
				$sheet->cell(('B'.$startRows.':I'.$startRows),function($cells){
					$cells->setFontFamily('Khmer OS Battambang');
                    $cells->setFontSize(28);
                    $cells->setFontColor(getSetting()->company_name_color);
                    $cells->setAlignment('center');
				});
				$startRows++;
				$sheet->mergeCells(('B'.$startRows.':I'.$startRows));
				$sheet->cell(('B'.$startRows),trans('lang.report_stock_balance'));
				$sheet->cell(('B'.$startRows.':I'.$startRows),function($cells){
					$cells->setFontFamily('Khmer OS Battambang');
                    $cells->setFontSize(16);
                    $cells->setFontColor(getSetting()->report_header_color);
                    $cells->setAlignment('center');
				});
				$startRows++;
				$sheet->mergeCells(('A'.$startRows.':D'.$startRows));
				$sheet->cell(('A'.$startRows),"*".trans("lang.date")." : ".(date('d/m/Y',strtotime($sd)))." ".trans("lang.to")." : ".(date('d/m/Y',strtotime($ed))));
				$sheet->cell(('A'.$startRows.':D'.$startRows),function($cells){
					$cells->setFontFamily('Khmer OS Battambang');
                    $cells->setFontSize(12);
                    $cells->setAlignment('left');
				});
            	
				$startRows++;
   				$sheet->cell('A'.$startRows,'Item Code');
   				$sheet->cell('B'.$startRows,'Item Name');
   				$sheet->cell('C'.$startRows,'Category');
   				$sheet->cell('D'.$startRows,'Unit Stock');
   				$sheet->cell('E'.$startRows,'Begin Balance');
   				$sheet->cell('F'.$startRows,'Stock In');
   				$sheet->cell('G'.$startRows,'Stock Out');
   				$sheet->cell('H'.$startRows,'Ending Balance');
   				$sheet->cell('I'.$startRows,'Warehouse');

   				$prefix = getSetting()->round_number;
				$sql = "SELECT G.warehouse_id, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = G.warehouse_id) AS warehouse, (SELECT CONCAT(pr_system_datas.`name`,' (',pr_system_datas.`desc`,')')AS `cat_name` FROM pr_system_datas WHERE pr_system_datas.`id`=(SELECT pr_items.`cat_id` FROM pr_items WHERE pr_items.`id`=G.item_id LIMIT 1) LIMIT 1) AS cat_name, G.item_id, (SELECT pr_items.`code` FROM pr_items WHERE pr_items.`id` = G.item_id) AS item_code, (SELECT pr_items.`name` FROM pr_items WHERE pr_items.`id` = G.item_id) AS item_name, (SELECT pr_items.`photo` FROM pr_items WHERE pr_items.`id` = G.item_id) AS photo, G.unit_stock, ROUND(G.begin_balance, $prefix)AS begin_balance, ROUND(G.stock_in, $prefix)AS stock_in, ROUND(G.stock_out, $prefix)AS stock_out, ROUND(ROUND(G.begin_balance, $prefix) + (ROUND(G.stock_in, $prefix) + ROUND(G.stock_out, $prefix)), $prefix)AS ending_balance, (SELECT pr_items.`alert_qty` FROM pr_items WHERE pr_items.`id` = G.item_id) AS alert_qty, (CASE WHEN (SELECT pr_stock_alerts.`id` FROM pr_stock_alerts WHERE pr_stock_alerts.`item_id` = G.item_id AND pr_stock_alerts.`warehouse_id` = G.warehouse_id) != ''THEN 1 ELSE 0 END ) AS stock_alert FROM (SELECT F.warehouse_id, F.item_id, F.unit_stock, SUM(F.begin_balance) AS begin_balance, SUM(F.stock_in) AS stock_in, SUM(F.stock_out) AS stock_out FROM (SELECT E.warehouse_id, E.item_id, E.unit_stock, (0) AS begin_balance, SUM(E.stock_in) AS stock_in, SUM(E.stock_out) AS stock_out FROM (SELECT D.warehouse_id, D.item_id, D.unit_stock, (CASE WHEN D.stock_qty >= 0 THEN D.stock_qty ELSE 0 END ) AS stock_in, (CASE WHEN D.stock_qty <= 0 THEN D.stock_qty ELSE 0 END ) AS stock_out FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty, C.warehouse_id FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id` FROM pr_stocks WHERE pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` BETWEEN '$sd'AND '$ed') AS A) AS B) AS C) AS D) AS E GROUP BY E.warehouse_id, E.item_id, E.unit_stock UNION SELECT E.warehouse_id, E.item_id, E.unit_stock, SUM(E.stock_qty) AS begin_balance, (0) AS stock_in, (0) AS stock_out FROM (SELECT D.warehouse_id, D.item_id, D.unit_stock, D.stock_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty, C.warehouse_id FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id` FROM pr_stocks WHERE pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` < '$sd') AS A) AS B) AS C) AS D) AS E GROUP BY E.warehouse_id, E.item_id, E.unit_stock) AS F GROUP BY F.warehouse_id, F.item_id, F.unit_stock) AS G ";
				$data = DB::select($sql);
				if(count($data)>0){
   					foreach ($data as $value) {
   						$startRows++;
						$sheet->cell('A'.($startRows),$value->item_code);
	   					$sheet->cell('B'.($startRows),$value->item_name);
	   					$sheet->cell('C'.($startRows),$value->cat_name);
	   					$sheet->cell('D'.($startRows),$value->unit_stock);
	   					$sheet->cell('E'.($startRows),$value->begin_balance);
	   					$sheet->cell('F'.($startRows),$value->stock_in);
	   					$sheet->cell('G'.($startRows),$value->stock_out);
	   					$sheet->cell('H'.($startRows),$value->ending_balance);
	   					$sheet->cell('I'.($startRows),$value->warehouse);
	   				}
   				}
   			});
   		})->download('xlsx');
    }
	
	public function subDt(Request $request, $item_id, $warehouse_id)
    {
		$pro_id = $request->session()->get('project');
		/* $item_id = $request->item_id;
		$warehouse_id = $request->warehouse_id; */
		$sd = $request->sd;
		$ed = $request->ed;
		$sql = "SELECT B.trans_date,B.ref_no,(CASE WHEN B.reference!='' THEN B.reference ELSE '' END)AS reference,B.ref_type,B.line_no,B.item_id,B.item,B.unit,SUM(B.qty)AS qty,B.warehouse_id,B.warehouse FROM(SELECT A.*, (SELECT CONCAT(pr_items.`name`,' (',pr_items.`code`,')') AS `name` FROM pr_items WHERE pr_items.`id` = A.item_id) AS item, (SELECT pr_warehouses.`name` FROM pr_warehouses WHERE pr_warehouses.`id` = A.warehouse_id) AS warehouse FROM (SELECT pr_stocks.`trans_date`, pr_stocks.`ref_no`, pr_stocks.`line_no`, pr_stocks.`item_id`, pr_stocks.`unit`, pr_stocks.`qty`, pr_stocks.`warehouse_id`, pr_stocks.`ref_type`, pr_stocks.`reference` FROM pr_stocks WHERE pr_stocks.`item_id` = $item_id AND pr_stocks.`warehouse_id` = $warehouse_id AND pr_stocks.`delete` = 0 AND pr_stocks.`pro_id` = $pro_id AND pr_stocks.`trans_date` BETWEEN '$sd'AND '$ed') AS A)AS B GROUP BY B.item_id,B.ref_no,B.line_no,B.trans_date,B.unit"; 
		return Datatables::of(DB::select($sql))->make(true);
	}
	
	public function showAlert($item_id, $warehouse_id)
    {
		try {
			DB::beginTransaction();
			DB::table('stock_alerts')->insert(['item_id'=>$item_id,'warehouse_id'=>$warehouse_id,'created_at'=>date('Y-m-d H:i:s')]);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function closeAlert($item_id, $warehouse_id)
    {
		try {
			DB::beginTransaction();
			DB::table('stock_alerts')->where(['item_id'=>$item_id,'warehouse_id'=>$warehouse_id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
