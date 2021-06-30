<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\FormatInvoice;
use Illuminate\Support\Facades\Session;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function index(Request $request)
    {
    	$date = date('Y-m-d');
    	$pro_id = $request->session()->get('project');
    	$sql_request = "SELECT (CASE WHEN F.request_item_qty != ''THEN F.request_item_qty ELSE 0 END ) AS request_item_qty, (CASE WHEN F.order_item_qty != ''THEN F.order_item_qty ELSE 0 END ) AS order_item_qty, (CASE WHEN F.order_item_percentage != ''THEN F.order_item_percentage ELSE 0 END ) AS order_item_percentage FROM (SELECT E.*, ROUND(((E.order_item_qty * 100) / E.request_item_qty ), 2 ) AS order_item_percentage FROM (SELECT SUM(D.qty) AS request_item_qty, SUM(D.ordered_qty) AS order_item_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS qty, (C.ordered_qty * C.stock_qty) AS ordered_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_request_items.item_id, pr_request_items.`unit`, pr_request_items.`qty`, pr_request_items.`ordered_qty`, pr_requests.`trans_date` FROM pr_requests INNER JOIN pr_request_items ON pr_requests.`id` = pr_request_items.`pr_id` AND pr_requests.`pro_id`=$pro_id AND pr_requests.`trans_status` IN (1, 2, 3) AND MONTH(pr_requests.`trans_date`) = MONTH('$date')) AS A) AS B) AS C) AS D) AS E) AS F "; 
    	$obj_request = collect(DB::select($sql_request))->first();
		
		$sql_order = "SELECT (CASE WHEN F.total_order != ''THEN F.total_order ELSE 0 END ) AS total_order, (CASE WHEN F.order_items_qty != ''THEN F.order_items_qty ELSE 0 END ) AS order_items_qty, (CASE WHEN F.delivery_items_percentage != ''THEN F.delivery_items_percentage ELSE 0 END ) AS delivery_items_percentage FROM (SELECT E.*, ROUND(((E.delivery_items_qty * 100) / E.order_items_qty ), 2 ) AS delivery_items_percentage FROM (SELECT SUM(D.total) AS total_order, SUM(D.order_qty) AS order_items_qty, SUM(D.delivery_qty) AS delivery_items_qty FROM (SELECT C.trans_date, C.total, C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS order_qty, (C.deliv_qty * C.stock_qty) AS delivery_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_orders.`trans_date`, pr_order_items.`item_id`, pr_order_items.`unit`, pr_order_items.`qty`, pr_order_items.`deliv_qty`, pr_order_items.`total` FROM pr_orders INNER JOIN pr_order_items ON pr_orders.`id` = pr_order_items.`po_id` AND pr_orders.`pro_id`=$pro_id AND pr_orders.`trans_status` IN (1, 2, 3) AND MONTH(pr_orders.`trans_date`) = MONTH('$date')) AS A) AS B) AS C) AS D) AS E) AS F ";
		$obj_order = collect(DB::select($sql_order))->first();

		$sql_delivery = "SELECT (CASE WHEN F.delivery_items_qty != ''THEN F.delivery_items_qty ELSE 0 END ) AS delivery_items_qty, (CASE WHEN F.return_items_percentage != ''THEN F.return_items_percentage ELSE 0 END ) AS return_items_percentage FROM (SELECT E.*, ROUND(((E.return_items_qty * 100) / E.delivery_items_qty ), 2 ) AS return_items_percentage FROM (SELECT SUM(D.delivery_qty) AS delivery_items_qty, SUM(D.return_qty) AS return_items_qty FROM (SELECT (C.qty * C.stock_qty) AS delivery_qty, (C.return_qty * C.stock_qty) AS return_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_delivery_items.item_id, pr_delivery_items.`unit`, pr_delivery_items.`qty`, pr_delivery_items.`return_qty`, pr_deliveries.`trans_date` FROM pr_deliveries INNER JOIN pr_delivery_items ON pr_deliveries.`id` = pr_delivery_items.`del_id` AND pr_deliveries.`pro_id`=$pro_id AND pr_deliveries.`delete` = 0 AND MONTH(pr_deliveries.`trans_date`) = MONTH('$date')) AS A) AS B) AS C) AS D) AS E) AS F ";
		 $obj_delivery = collect(DB::select($sql_delivery))->first();

		$sql_usage = "SELECT T2.*, ROUND(((T2.return_usage_items_qty * 100) / T2.usage_items_qty ), 2 ) AS return_usage_items_percentage FROM (SELECT (CASE WHEN T.usage_items_qty != ''THEN T.usage_items_qty ELSE 0 END ) AS usage_items_qty, (CASE WHEN T.return_usage_items_qty != ''THEN T.return_usage_items_qty ELSE 0 END ) AS return_usage_items_qty FROM (SELECT (SELECT ROUND(SUM(D.usage_qty), 2) AS usage_items_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS usage_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_usages.`trans_date`, pr_usage_details.`item_id`, pr_usage_details.`unit`, pr_usage_details.`qty` FROM pr_usages INNER JOIN pr_usage_details ON pr_usages.`id` = pr_usage_details.`use_id` AND pr_usages.`pro_id`=$pro_id AND pr_usages.`delete` = 0 AND pr_usage_details.`delete` = 0 AND MONTH(pr_usages.`trans_date`) = MONTH('$date')) AS A) AS B) AS C) AS D) AS usage_items_qty, (SELECT ROUND(SUM(E.return_usage_qty), 2) AS return_usage_items_qty FROM (SELECT (C.qty * C.stock_qty) AS return_usage_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.`id` = A.item_id) AS unit_stock FROM (SELECT pr_return_usage_details.item_id, pr_return_usage_details.`unit`, pr_return_usage_details.`qty`, pr_return_usages.`trans_date` FROM pr_return_usages INNER JOIN pr_return_usage_details ON pr_return_usages.`id` = pr_return_usage_details.`return_id` AND pr_return_usages.`pro_id`=$pro_id AND pr_return_usages.`delete` = 0 AND MONTH(pr_return_usages.`trans_date`) = MONTH('$date')) AS A) AS B) AS C) AS E) AS return_usage_items_qty) AS T) AS T2 "; 
		$obj_usage = collect(DB::select($sql_usage))->first();

		$sql_chart_request = "SELECT T.period, T.trans_date, (CASE WHEN T.all_requested != ''THEN T.all_requested ELSE 0 END ) AS all_requested, (CASE WHEN T.all_completed != ''THEN T.all_completed ELSE 0 END ) AS all_completed, (CASE WHEN T.all_rejected != ''THEN T.all_rejected ELSE 0 END ) AS all_rejected FROM (SELECT T1.period, T1.trans_date, T1.all_requested, T2.all_completed, T3.all_rejected FROM (SELECT A.period, A.trans_date, COUNT(A.period) AS all_requested FROM (SELECT MONTH(pr_requests.`trans_date`) period, pr_requests.`trans_date` FROM pr_requests WHERE pr_requests.`trans_status` IN (1, 2, 3, 4) AND YEAR(pr_requests.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T1 LEFT JOIN (SELECT A.period, COUNT(A.period) AS all_completed FROM (SELECT MONTH(pr_requests.`trans_date`) period FROM pr_requests WHERE pr_requests.`trans_status` IN (3) AND YEAR(pr_requests.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T2 ON T1.period = T2.period LEFT JOIN (SELECT A.period, COUNT(A.period) AS all_rejected FROM (SELECT MONTH(pr_requests.`trans_date`) period FROM pr_requests WHERE pr_requests.`trans_status` IN (4) AND pr_requests.pro_id=$pro_id AND YEAR(pr_requests.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T3 ON T1.period = T3.period) AS T ORDER BY T.trans_date";
		$obj_chart_request = collect(DB::select($sql_chart_request));

		$sql_chart_order = "SELECT T.period, T.trans_date, (CASE WHEN T.all_ordered != ''THEN T.all_ordered ELSE 0 END ) AS all_ordered, (CASE WHEN T.all_completed != ''THEN T.all_completed ELSE 0 END ) AS all_completed, (CASE WHEN T.all_rejected != ''THEN T.all_rejected ELSE 0 END ) AS all_rejected FROM (SELECT T1.period, T1.trans_date, T1.all_ordered, T2.all_completed, T3.all_rejected FROM (SELECT A.period, A.trans_date, COUNT(A.period) AS all_ordered FROM (SELECT MONTH(pr_orders.`trans_date`) period, pr_orders.`trans_date` FROM pr_orders WHERE pr_orders.`trans_status` IN (1, 2, 3, 4) AND YEAR(pr_orders.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T1 LEFT JOIN (SELECT A.period, COUNT(A.period) AS all_completed FROM (SELECT MONTH(pr_orders.`trans_date`) period FROM pr_orders WHERE pr_orders.`trans_status` IN (3) AND YEAR(pr_orders.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T2 ON T1.period = T2.period LEFT JOIN (SELECT A.period, COUNT(A.period) AS all_rejected FROM (SELECT MONTH(pr_orders.`trans_date`) period FROM pr_orders WHERE pr_orders.`trans_status` IN (4) AND pr_orders.pro_id=$pro_id AND YEAR(pr_orders.`trans_date`) = YEAR('$date')) AS A GROUP BY A.period) AS T3 ON T1.period = T3.period) AS T ORDER BY T.trans_date";
		$obj_chart_order = collect(DB::select($sql_chart_order));

		$sql_house_type = "SELECT CAST(A.num_house AS DECIMAL(20))AS num_house, (SELECT pr_system_datas.`name` FROM pr_system_datas WHERE pr_system_datas.`id` = A.`house_type`) AS house_type FROM (SELECT SUM(pr_houses.id) AS num_house, pr_houses.`house_type` FROM pr_houses WHERE pr_houses.`pro_id` = $pro_id GROUP BY pr_houses.`house_type`) AS A "; 
		$obj_house_type = collect(DB::select($sql_house_type)); 

		$sql_chart_order_ = "SELECT B.peroid, (CASE WHEN B.total_ordered != ''THEN B.total_ordered ELSE 0 END ) AS total_ordered, (CASE WHEN B.total_completed != ''THEN B.total_completed ELSE 0 END ) AS total_completed FROM (SELECT T1.peroid, T1.total_ordered, T2.total_completed FROM (SELECT SUM(A.grand_total) AS total_ordered, A.peroid FROM (SELECT pr_orders.`trans_date`, pr_orders.`grand_total`, MONTH(pr_orders.`trans_date`) AS peroid FROM pr_orders WHERE pr_orders.`trans_status` IN (1, 2, 3, 4) AND pr_orders.`pro_id` = $pro_id AND YEAR(pr_orders.`trans_date`) = YEAR('$date')) AS A GROUP BY A.peroid) AS T1 LEFT JOIN (SELECT SUM(A.grand_total) AS total_completed, A.peroid FROM (SELECT pr_orders.`trans_date`, pr_orders.`grand_total`, MONTH(pr_orders.`trans_date`) AS peroid FROM pr_orders WHERE pr_orders.`trans_status` IN (4) AND pr_orders.`pro_id` = $pro_id AND YEAR(pr_orders.`trans_date`) = YEAR('$date')) AS A GROUP BY A.peroid) AS T2 ON T1.peroid = T2.peroid) AS B ORDER BY B.peroid";
		$obj_chart_order_ = collect(DB::select($sql_chart_order_));

		$data = [
			'title'			=> trans('lang.dashboard'),
			'small_title'	=> trans('lang.dashboard')." & ".trans('lang.statistics'),
			'background'	=> 'page-container-bg-solid',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
					],
				'dashboard'	=> [
						'caption' 	=> trans('lang.dashboard'),
					],
				],
			'request'		=>$obj_request,
			'order'			=>$obj_order,
			'delivery'		=>$obj_delivery,
			'usage'			=>$obj_usage,
			'chart_request'	=>$obj_chart_request,
			'chart_order'	=>$obj_chart_order,
			'house_type'	=>$obj_house_type,
			'chart_order_'	=>$obj_chart_order_,
		];
        return view('home',$data);
    }
}
