<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\BoqItem;
use App\Model\Stock;
use App\Model\Usage;
use App\Model\UsageDetails;
use App\Model\ReturnUsage;
use App\Model\ReturnUsageDetails;
use App\Model\Constructor;
use App\Model\Warehouse;
use App\Model\Item;
use App\Model\SystemData;

class ReturnUsageSingleController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.return_usage'),
			'icon'			=> 'fa fa-exchange',
			'small_title'	=> trans('lang.return_usage_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.return_usage'),
				],
			],
			'rounte'		=> url("stock/reuse_single/dt"),
		];
		
		if(hasRole('usage_return_add')){
			$data = array_merge($data, ['rounteAdd'=> url('stock/reuse_single/add')]);
		}
		return view('stock.usage.return_multi.index',$data);
	}
	
	public function add(Request $request){
		$data = [
			'title'			=> trans('lang.return_usage'),
			'icon'			=> 'fa fa-plus',
			'small_title'	=> trans('lang.add_new'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'index'	=> [
						'url' 		=> url('stock/reuse_single'),
						'caption' 	=> trans('lang.return_usage'),
				],
				'add'	=> [
						'caption' 	=> trans('lang.add_new'),
				],
			],
			'rounteSave'	=> url('stock/reuse_single/save'),
			'rounteBack'	=> url('stock/reuse_single'),
			'pro_id'		=> $request->session()->get('project'),
		];
		return view('stock.usage.return_multi.add',$data);
	}
	
	public function edit(Request $request, $id){
		$id = decrypt($id);
		$obj = ReturnUsage::find($id);
		if($obj){
			$data = [
				'title'			=> trans('lang.return_usage'),
				'icon'			=> 'fa fa-edit',
				'small_title'	=> trans('lang.edit'),
				'background'	=> '',
				'link'			=> [
					'home'	=> [
							'url' 		=> url('/'),
							'caption' 	=> trans('lang.home'),
					],
					'index'	=> [
							'url' 		=> url('stock/reuse_single'),
							'caption' 	=> trans('lang.return_usage'),
					],
					'edit'	=> [
							'caption' 	=> trans('lang.edit'),
					],
				],
				'rounteSave'	=> url('stock/reuse_single/update/'.$id),		
				'rounteBack'	=> url('stock/reuse_single'),		
				'obj'	=> $obj,
				'pro_id'=> $request->session()->get('project'),
			];
			return view('stock.usage.return_multi.edit',$data);
		}else{
			return redirect()->back();
		}
	}
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$returnUsages = ReturnUsage::where(['delete'=> 0, 'pro_id'=> $pro_id])->get();
        return Datatables::of($returnUsages)
		->addColumn('engineer',function($row){
			if($engineer = Constructor::find($row->eng_return)){
				return "{$engineer->id_card} ({$engineer->name})";
			}
            return '';
        })
		->addColumn('sub_constructor',function($row){
			if($subcontractor = Constructor::find($row->sub_return)){
				return "{$subcontractor->id_card} ({$subcontractor->name})";
			}
            return '';
        })
		->addColumn('details_url',function($row){
            return url('stock/reuse_single/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_delete = url('stock/reuse_single/delete/'.$row->id);
			$rounte_edit = url('stock/reuse_single/edit/'.encrypt($row->id));
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			
			if(!hasRole('usage_return_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('usage_return_delete')){
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
		$returnUsageDetails = ReturnUsageDetails::where(['delete'=> 0, 'return_id'=> $id])->get();
        return Datatables::of($returnUsageDetails)
		->addColumn('item',function($row){
			if($item = Item::find($row->item_id)){
				return "{$item->name} ({$item->code})";
			}
			return '';
		})
		->addColumn('from_warehouse',function($row){
			if($warehouse = Warehouse::find($row->warehouse_id)){
				return $warehouse->name;
			}
			return '';
		})
		->addColumn('street',function($row){
			if($street = SystemData::find($row->street_id)){
				return $street->name;
			}
			return '';
		})
		->addColumn('on_house',function($row){
			if($house = House::find($row->house_id)){
				return $house->house_no;
			}
			return '';
		})
		->make(true);
	}

    public function save(Request $request){
		$rules = [
			'reference_no' 	=>'required|max:20|unique_return_usage',
			'trans_date' 	=>'required|max:20',
			'reference' 	=>'required',
			'engineer' 		=>'required|max:11',
			'warehouse_id' 	=>'required|max:11',
			'street_id' 	=>'required|max:11',
			'house_id' 		=>'required|max:11',
		];
		if(getSetting()->return_constructor==1){
			$rules['sub_const']= 'required|max:11';
		}
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i] 			= 'required';
				$rules['line_item.'.$i] 			= 'required|max:11';
				$rules['line_unit.'.$i]				= 'required';
				$rules['line_return_qty.'.$i]		= 'required';
				$rules['line_usage_qty.'.$i]		= 'required';
				$rules['line_boq_set.'.$i]			= 'required';
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
				'eng_return'	=>$request->engineer,
				'desc'			=>$request->desc,
				'created_by'	=>Auth::user()->id,
				'created_at'	=>date('Y-m-d H:i:s'),
			];
			if(getSetting()->return_constructor==1){
				$data = array_merge($data, ['sub_return'=>$request->sub_const]);
			}
			
			if(!$id = DB::table('return_usages')->insertGetId($data)){
				throw new \Exception("Return Usage not insert.");
			}

			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){

					$detail = [
						'return_id'      => $id,
						'warehouse_id'   => $request->warehouse_id,
						'house_id'       => $request->house_id,
						'street_id'      => $request->street_id,
						'line_no'        => $request['line_index'][$i],
						'item_id'        => $request['line_item'][$i],
						'unit'           => $request['line_unit'][$i],
						'qty'            => $request['line_return_qty'][$i],
						'usage_qty'      => $request['line_usage_qty'][$i],
						'boq_set'        => $request['line_boq_set'][$i],
						'note'           => $request['line_note'][$i],
						'created_by'     => Auth::user()->id,
						'created_at'     => date('Y-m-d H:i:s'),
						'updated_by'     => Auth::user()->id,
						'updated_at'     => date('Y-m-d H:i:s'),
					];

					$stockIn = [
						'pro_id'         =>$request->session()->get('project'),
						'ref_id'         =>$id,
						'ref_no'         =>$request->reference_no,
						'ref_type'       =>'return usage',
						'line_no'        =>$request['line_index'][$i],
						'item_id'        =>$request['line_item'][$i],
						'unit'           =>$request['line_unit'][$i],
						'warehouse_id'   =>$request->warehouse_id,
						'trans_date'     =>$trans_date,
						'trans_ref'      =>'I',
						'alloc_ref'      =>$request->reference_no,
						'reference'      =>$request->reference,
						'created_by'     =>Auth::user()->id,
						'created_at'     =>date('Y-m-d H:i:s'),
					];

					if (getSetting()->is_costing==1) {
						$itemID = $request['line_item'][$i];
						$streetID = $request->street_id;
						$houseID = $request->house_id;
						$warehouseID = $request->warehouse_id;

						$whereUsageDetail = [
							'warehouse_id' => $warehouseID,
							'street_id' => $streetID,
							'house_id'=> $houseID,
							'item_id'=> $itemID,
						];

						if(!$usageItem = UsageDetails::select(['usage_details.*','usages.ref_no'])->leftJoin('usages','usages.id','usage_details.use_id')->where($whereUsageDetail)->orderBy('id','DESC')->first()){
							throw new \Exception("ItemID[{$itemID}] not found.");
						}

						$whereStock = [
							'ref_id' => $usageItem->use_id,
							'ref_no' => $usageItem->ref_no,
							'ref_type' => 'usage items',
							'warehouse_id' => $usageItem->warehouse_id,
							'trans_ref' => 'O'
						];

						if(!$usageStock = Stock::where($whereStock)->first()){
							throw new \Exception("Stock [{$itemID}] not found.");
						}

						$qty = (float)$request['line_return_qty'][$i];
						$cost = $usageStock->cost;
						$amount = $qty * $cost;

						$stockIn = array_merge($stockIn,['qty' => $qty]);
						$stockIn = array_merge($stockIn,['cost' => $cost]);
						$stockIn = array_merge($stockIn,['amount' => $amount]);

						if(!$stockInId = DB::table('stocks')->insert($stockIn)){
							DB::rollback();
							throw new \Exception("Stock In[{$i}] not insert.");
						}
					}else{
						$stockIn = array_merge($stockIn,['qty' => $request['line_return_qty'][$i]]);
						if(!$stockInId = DB::table('stocks')->insert($stockIn)){
							DB::rollback();
							throw new \Exception("Stock In[{$i}] not insert.");
						}
					}

					if(!$returnUsageDetailID = DB::table('return_usage_details')->insert($detail)){
						DB::rollback();
						throw new \Exception("ReturnUsageDetail[{$i}] not insert.");
					}
				}
			}

			DB::commit();
			if($request->btnSubmit==1){
				return redirect('stock/reuse_single')->with('success',trans('lang.save_success'));
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
			'engineer' 		=>'required|max:11',
			'warehouse_id' 	=>'required|max:11',
			'street_id' 	=>'required|max:11',
			'house_id' 		=>'required|max:11',
		];
		if(getSetting()->return_constructor==1){
			$rules['sub_const']= 'required|max:11';
		}
		if(count($request['line_index']) > 0){
			for($i=0;$i<count($request['line_index']);$i++){
				$rules['line_index.'.$i] 			= 'required';
				$rules['line_item.'.$i] 			= 'required|max:11';
				$rules['line_unit.'.$i]				= 'required';
				$rules['line_return_qty.'.$i]		= 'required';
				$rules['line_usage_qty.'.$i]		= 'required';
				$rules['line_boq_set.'.$i]			= 'required';
			}
		}
        Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();

			if(!$returnUsage = ReturnUsage::find($id)){
				throw new \Exception("ReturnUsage[{$id}] not found.");
			}

			if(checkAllocate("O", $request->reference_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}
			$originalDate = $request['trans_date'];
			$trans_date = date("Y-m-d", strtotime($originalDate));
			$data = [
				'trans_date'	=>$trans_date,
				'reference'		=>$request->reference,
				'eng_return'	=>$request->engineer,
				'desc'			=>$request->desc,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			if(getSetting()->return_constructor==1){
				$data = array_merge($data, ['sub_return'=>$request->sub_const]);
			}
			
			DB::table('return_usages')->where(['id'=>$id])->update($data);
			// delete all return usage details
			DB::table('return_usage_details')->where(['return_id' => $id])->delete();
			// delete all stock return usage details
			DB::table('stocks')->where(['ref_id' => $id, 'ref_no' => $returnUsage->ref_no,'ref_type' => 'return usage'])->delete();

			if(count($request['line_index']) > 0){
				for($i=0;$i<count($request['line_index']);$i++){

					$detail = [
						'return_id'      => $id,
						'warehouse_id'   => $request->warehouse_id,
						'house_id'       => $request->house_id,
						'street_id'      => $request->street_id,
						'line_no'        => $request['line_index'][$i],
						'item_id'        => $request['line_item'][$i],
						'unit'           => $request['line_unit'][$i],
						'qty'            => $request['line_return_qty'][$i],
						'usage_qty'      => $request['line_usage_qty'][$i],
						'boq_set'        => $request['line_boq_set'][$i],
						'note'           => $request['line_note'][$i],
						'created_by'     => Auth::user()->id,
						'created_at'     => date('Y-m-d H:i:s'),
						'updated_by'     => Auth::user()->id,
						'updated_at'     => date('Y-m-d H:i:s'),
					];

					$stockIn = [
						'pro_id'         =>$request->session()->get('project'),
						'ref_id'         =>$id,
						'ref_no'         =>$request->reference_no,
						'ref_type'       =>'return usage',
						'line_no'        =>$request['line_index'][$i],
						'item_id'        =>$request['line_item'][$i],
						'unit'           =>$request['line_unit'][$i],
						'warehouse_id'   =>$request->warehouse_id,
						'trans_date'     =>$trans_date,
						'trans_ref'      =>'I',
						'alloc_ref'      =>$request->reference_no,
						'reference'      =>$request->reference,
						'created_by'     =>Auth::user()->id,
						'created_at'     =>date('Y-m-d H:i:s'),
					];

					if (getSetting()->is_costing==1) {
						$itemID = $request['line_item'][$i];
						$streetID = $request->street_id;
						$houseID = $request->house_id;
						$warehouseID = $request->warehouse_id;

						$whereUsageDetail = [
							'warehouse_id' => $warehouseID,
							'street_id' => $streetID,
							'house_id'=> $houseID,
							'item_id'=> $itemID,
						];

						if(!$usageItem = UsageDetails::select(['usage_details.*','usages.ref_no'])->leftJoin('usages','usages.id','usage_details.use_id')->where($whereUsageDetail)->orderBy('id','DESC')->first()){
							throw new \Exception("ItemID[{$itemID}] not found.");
						}

						$whereStock = [
							'ref_id' => $usageItem->use_id,
							'ref_no' => $usageItem->ref_no,
							'ref_type' => 'usage items',
							'warehouse_id' => $usageItem->warehouse_id,
							'trans_ref' => 'O'
						];

						if(!$usageStock = Stock::where($whereStock)->first()){
							throw new \Exception("Stock [{$itemID}] not found.");
						}

						$qty = (float)$request['line_return_qty'][$i];
						$cost = $usageStock->cost;
						$amount = $qty * $cost;

						$stockIn = array_merge($stockIn,['qty' => $qty]);
						$stockIn = array_merge($stockIn,['cost' => $cost]);
						$stockIn = array_merge($stockIn,['amount' => $amount]);

						if(!$stockInId = DB::table('stocks')->insert($stockIn)){
							DB::rollback();
							throw new \Exception("Stock In[{$i}] not insert.");
						}
					}else{
						$stockIn = array_merge($stockIn,['qty' => $request['line_return_qty'][$i]]);
						if(!$stockInId = DB::table('stocks')->insert($stockIn)){
							DB::rollback();
							throw new \Exception("Stock In[{$i}] not insert.");
						}
					}

					if(!$returnUsageDetailID = DB::table('return_usage_details')->insert($detail)){
						DB::rollback();
						throw new \Exception("ReturnUsageDetail[{$i}] not insert.");
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
			$obj = ReturnUsage::find($id);
			if(checkAllocate("O", $obj->ref_no) > 0){
				return redirect()->back()->with('error',trans('lang.trans_error'));
			}
			$data = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('return_usages')->where(['id'=>$id])->update($data);
			$dataDetails = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('return_usage_details')->where(['return_id'=>$id])->update($dataDetails);
			$stock = [
				'delete'		=>1,
				'updated_by'	=>Auth::user()->id,
				'updated_at'	=>date('Y-m-d H:i:s'),
			];
			DB::table('stocks')->where(['ref_id'=>$id,'ref_no'=>$obj->ref_no,'ref_type'=>'return usage','trans_ref'=>'I'])->update($stock);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function getItemStock(Request $request){
		if($request->ajax()){
			$house_id = $request['house_id'];
			$item_id = $request['item_id'];
			$unit = $request['unit'];
			
			$usage_qty = 0;
			$return_qty = 0;
			$boq_qty = -1;
			
			$sql_use = "SELECT (F.stock_qty / F.use_qty) AS use_qty FROM (SELECT E.stock_qty, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = '$unit'AND pr_units.`to_code` = E.unit_stock) AS use_qty FROM (SELECT D.item_id, D.unit_stock, SUM(D.stock_qty) AS stock_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.id = A.item_id) AS unit_stock FROM (SELECT pr_usage_details.`id`, pr_usage_details.`item_id`, pr_usage_details.`unit`, pr_usage_details.`qty` FROM pr_usage_details WHERE pr_usage_details.`delete` = 0 /* AND pr_usage_details.`boq_set` != - 1 */ AND pr_usage_details.`house_id` = $house_id AND pr_usage_details.`item_id` = $item_id) AS A) AS B) AS C) AS D GROUP BY D.item_id, D.unit_stock) AS E) AS F";
			$objUse = collect(DB::select($sql_use))->first();
			if($objUse){
				$usage_qty = floatval($objUse->use_qty);
			}
			
			$sql_return = "SELECT (F.stock_qty / F.use_qty) AS return_qty FROM (SELECT E.stock_qty, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = '$unit'AND pr_units.`to_code` = E.unit_stock) AS use_qty FROM (SELECT D.item_id, D.unit_stock, SUM(D.stock_qty) AS stock_qty FROM (SELECT C.item_id, C.unit_stock, (C.qty * C.stock_qty) AS stock_qty FROM (SELECT B.*, (SELECT pr_units.`factor` FROM pr_units WHERE pr_units.`from_code` = B.unit AND pr_units.`to_code` = B.unit_stock) AS stock_qty FROM (SELECT A.*, (SELECT pr_items.`unit_stock` FROM pr_items WHERE pr_items.id = A.item_id) AS unit_stock FROM (SELECT pr_return_usage_details.`id`, pr_return_usage_details.`item_id`, pr_return_usage_details.`unit`, pr_return_usage_details.`qty` FROM pr_return_usage_details WHERE pr_return_usage_details.`delete` = 0 /* AND pr_return_usage_details.`boq_set` != - 1 */ AND pr_return_usage_details.`house_id` = $house_id AND pr_return_usage_details.`item_id` = $item_id) AS A) AS B) AS C) AS D GROUP BY D.item_id, D.unit_stock) AS E) AS F";
			$objReturn = collect(DB::select($sql_return))->first();
			if($objReturn){
				$return_qty = floatval($objReturn->return_qty);
			}
			$usage_qty = $usage_qty - $return_qty;
			
			$boq = BoqItem::where(['house_id'=>$house_id,'item_id'=>$item_id])->exists();
			if($boq){
				$boq_qty = 1;
			}
			return ['usage_qty'=>$usage_qty,'boq_set'=>$boq_qty];
		}
		return ['usage_qty'=>0,'boq_set'=>-1];
	}
}
