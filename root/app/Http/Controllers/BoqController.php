<?php

namespace App\Http\Controllers;

use App\Model\Boq;
use App\Model\BoqHouse;
use Auth;
use DB;
use Datatables;
use Redirect;
use Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\House;
use App\Model\SystemData;
use App\Model\BoqItem;
use App\Model\UsageDetails;
use App\Model\Item;
use Illuminate\Database\Eloquent\Model;

class BoqController extends Controller
{
	public function __boqsuct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.boq'),
			'icon'			=> 'fa fa-bitcoin',
			'small_title'	=> trans('lang.boq_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.boq'),
				],
			],
			'rounte'		=> url("boqs/dt"),
		];
		
		if(hasRole('boq_add')){
			$data = array_merge($data, ['rounteSave'=> url('boqs/save')]);
		}
		if(hasRole('boq_download')){
			$data = array_merge($data, ['rounteDownload'=> url('boqs/excel/download/0')]);
		}
		if(hasRole('boq_download_sample')){
			$data = array_merge($data, ['rounteExample'	=> url('boqs/excel/example')]);
			$data = array_merge($data, ['rounteUpload'=> url('boqs/excel/upload')]);
		}
		return view('boq.index',$data);
	}
	public function replicateBoq(Request $request, $id){
		try {
			DB::beginTransaction();
			// Get old BOQ
			$boq = BOQ::find($id);
			// print_r($boq);
			//Duplicate BOQ
			// print_r($boq->revise_count);exit;
			$newBoq = $boq->replicate();
			
			//Add new Value to BOQ
			$newBoq->created_at = date('Y-m-d H:i:s');
			$newBoq->revise_by = Auth::user()->id;
			$newBoq->referent_id = $id;
			$newBoq->revise_count = $newBoq->revise_count + 1;
			$newBoq->status = 1;
			//Save New BOQ
			$newBoq->save();
			$newBoqId = $newBoq->id;

			//get old BOQ House
			$boqHouses = BoqHouse::where('boq_id',$id)->get();
			if(count($boqHouses) > 0){
				foreach($boqHouses as $key=> $boqHouse){
					//add new Value to BOQ House
					$newBoqHouse =  $boqHouse->replicate();;
					$newBoqHouse->boq_id = $newBoqId;
					//Save New Boq House
					$newBoqHouse->save();
					$newBoqHouseId = $newBoqHouse->id;
					//get Boq house Items
					$boqHouseItems = BoqItem::where('boq_id',$boqHouse->id)->get();
					if(count($boqHouseItems) > 0){
						foreach($boqHouseItems as $key=>$boqHouseItem){
							//Dupplicate Boq House Item
							$newBoqHouseItem =  $boqHouseItem->replicate();

							//add new value to Boq House Item
							$newBoqHouseItem->boq_id = $newBoqHouseId;
							//save new Boq House Item
							$newBoqHouseItem->save();
							DB::table('boq_items')->where('id',$boqHouseItem->id)->update(['remain_qty'=>0]);
						}
					}
				}
			}

			$boq->status = 0;
			$boq->is_revise = 1;
			DB::table('boqs')->where('id',$id)->update(['status'=>0,'is_revise'=>$boq->is_revise+1]);
			DB::commit();
			$redirect = url('boqs');
			$items = $this->getBoqItem($newBoqId);
			$data = [
				'id'			=> $id,
				'title'			=> trans('lang.view'),
				'icon'			=> 'fa fa-eye',
				'small_title'	=> trans('lang.boq_details'),
				'background'	=> '',
				'link'			=> [
					'home'	=> [
							'url' 		=> url('/'),
							'caption' 	=> trans('lang.home'),
					],
					'boq'	=> [
							'url' 		=> url('/boqs'),
							'caption' 	=> trans('lang.boq'),
					],
					'view'	=> [
							'caption' 	=> trans('lang.view'),
					],
				],			
				'rounte'		=> url('boqs/subdt').'/'.$id,			
				'rounteBack'	=> $redirect,
				'boqItems'=>$items,
				'boqItemJson'=>json_encode($items)
			];
			
			return view('boq.revise_boq',$data);
		}catch (\Exception $e) {
			DB::rollback();
			print_r($e->getMessage());exit;
			// return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
		
	}

	public function getBoq($id){
		$boq = BOQ::find($id);
		return $boq;
	}

	public function getBoqHouse($id){
		$boqHouse = BoqHouse::where('boq_id',$id);
	}

	public function getBoqItem($id){
		$boqItems = BoqItem::select(
			'boq_items.*',
			'items.cat_id',
			'system_datas.name as working_type_name',
			DB::raw('SUM(pr_boq_items.qty_std) as total_qty')
		)->join('boq_houses','boq_houses.id','boq_items.boq_id')
		->join('system_datas','system_datas.id','boq_items.working_type')
		->join('items','items.id','boq_items.item_id')
		->where('boq_houses.boq_id',$id)
		->groupBy('boq_items.item_id')
		->orderBy('boq_items.working_type')->get();
		return $boqItems;
	}

	public function reviseBoq(Request $request,$id){
		$back = url('house');
		$id = decrypt($id);
		$back = decrypt($back);
		$redirect = url('boqs');
		if($back==2){
			$redirect = url('house');
		}
		$data = [
			'id'			=> $id,
			'title'			=> trans('lang.view'),
			'icon'			=> 'fa fa-eye',
			'small_title'	=> trans('lang.boq_details'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'boq'	=> [
						'url' 		=> url('/boqs'),
						'caption' 	=> trans('lang.boq'),
				],
				'view'	=> [
						'caption' 	=> trans('lang.view'),
				],
			],			
			'rounte'		=> url('boqs/subdt').'/'.$id,			
			'rounteBack'	=> $redirect,
		];
		return view('boq.revise_boq',$data);
		
	}
	
	public function getDt()
    {
        return Datatables::of(getBOQs())
		->addColumn('action', function ($row) {
			$rounte_download = url('boqs/excel/download/'.$row->id);
			$rounte_view = url('boqs/view/'.encrypt($row->id).'/'.encrypt(1));
			$rounte_revise = url('boqs/replicateboq/'.$row->id);
			$rounte_delete = url('boqs/delete/'.$row->id);
			$route_add_type = url('boqs/addworktype/'.$row->id);
			$btnDelete = 'onclick="onDelete(this)"';
			$btnDownload = 'href="'.$rounte_download.'"';
			$btnView = 'onclick="onView(this)"';
			$btnRevise = 'href="'.$rounte_revise.'"';
			$btnAddType = 'href="'.$route_add_type.'"';
			
			if(hasRole('boq_download')){
				$btnDownload = "disabled";
			}
			if(BoqItem::where(['boq_id'=>$row->id])->exists()){
				$btnDelete = "disabled";
			}
			if(!hasRole('boq_delete')){
				$btnDelete = "disabled";
			}
			if(!hasRole('boq_view')){
				$btnView = "disabled";
			}
			// return
			// 	'<a '.$btnDownload.' title="'.trans('lang.download').'" class="btn btn-xs view-record">'.
			// 	'	<i class="fa fa-file-excel-o"></i><br /><span>'.trans('lang.download').'</span>'.
			// 	'</a>'.
			// 	'<a '.$btnView.' title="'.trans('lang.view').'" class="btn btn-xs view-record" row_id="'.$row->id.'" row_rounte="'.$rounte_view.'">'.
			// 	'	<i class="fa fa-eye"></i><br /><span>'.trans('lang.view').'</span>'.
			// 	'</a>'.
			// 	'<a '.$btnRevise.' title="'.trans('lang.revised_boq').'" class="btn btn-xs view-record" row_id="'.$row->id.'" row_rounte="'.$rounte_revise.'">'.
			// 	'	<i class="fa fa-pencil-square-o"></i><br /><span>'.trans('lang.revised_boq').'</span>'.
			// 	'</a>'.
			// 	'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs delete-boq-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
			// 	'	<i class="fa fa-trash"></i><br /><span>'.trans('lang.delete').'</span>'.
			// 	'</a>'.
			// 	'<a '.$btnAddType.' title="'.trans('lang.add_working_type').'" class="btn btn-xs delete-boq-record" row_id="'.$row->id.'" row_rounte="'.$route_add_type.'">'.
			// 	'	<i class="fa fa-plus"></i><br /><span>'.trans('lang.add_working_type').'</span>'.
			// 	'</a>'; 
			return '<div class="dropup">
			<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  '.trans('lang.action').' <span class="caret"></span>
			</button><ul class="dropdown-menu dropdown-menu-right">'.
			'<li><a '.$btnDownload.' title="'.trans('lang.download').'"><i class="fa fa-file-excel-o"></i> '.trans('lang.download').'</a></li>'.
			'<li><a '.$btnView.' title="'.trans('lang.view').'" row_id="'.$row->id.'" row_rounte="'.$rounte_view.'"><i class="fa fa-eye"></i> '.trans('lang.view').'</a></li>'.
			'<li><a '.$btnRevise.' title="'.trans('lang.revised_boq').'" row_id="'.$row->id.'" row_rounte="'.$rounte_revise.'"><i class="fa fa-pencil-square-o"></i> '.trans('lang.revised_boq').'</a></li>'.
			'<li><a '.$btnDelete.' title="'.trans('lang.delete').'" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'"><i class="fa fa-trash"></i> '.trans('lang.delete').'</a></li>'.
			'<li><a '.$btnAddType.' title="'.trans('lang.add_working_type').'" row_id="'.$row->id.'" row_rounte="'.$route_add_type.'"><i class="fa fa-plus"></i> '.trans('lang.add_working_type').'</a></li>'.
			'</ul></div>';
		})->addColumn('details_url',function($row){
            // return url('boqs/subdt').'/'.$row->id;
			return url('boqs/boqhousesdt').'/'.$row->id;
        })->make(true);
    }
	public function boqHousesDt(Request $request, $id){
		return Datatables::of(getBoqHouses($id))
		->addColumn('action', function ($row) {
			$rounte_edit = url('boqs/edit/'.$row->id);
			$rounte_delete = url('boqs/sub/delete/'.$row->id);
			$btnDelete = 'onclick="onDelete(this)"';
			$btnEdit = 'onclick="onEdit(this)"';
			$btnView = 'onclick="onView(this)"';
			$rounte_view = url('boqs/view/'.encrypt($row->id).'/'.encrypt(1));
			
			if(!hasRole('boq_edit')){
				$btnEdit = "disabled";
			}
			// if(UsageDetails::where(['house_id'=>$row->house_id,'item_id'=>$row->item_id])->exists()){
			// 	$btnDelete = "disabled";
			// }
			// if(!hasRole('boq_delete')){
			// 	$btnDelete = "disabled";
			// }
			return
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnView.' title="'.trans('lang.view').'" class="btn btn-xs yellow view-record" row_id="'.$row->id.'" row_rounte="'.$rounte_view.'">'.
				'	<i class="fa fa-eye"></i>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-boq-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
		})->make(true);
	}
	
	public function subDt(Request $request, $id)
    {
        return Datatables::of(getBOQItems($id))
		->addColumn('action', function ($row) {
			$rounte_edit = url('boqs/edit/'.$row->id);
			$rounte_delete = url('boqs/sub/delete/'.$row->id);
			$btnDelete = 'onclick="onDelete(this)"';
			$btnEdit = 'onclick="onEdit(this)"';
			
			if(!hasRole('boq_edit')){
				$btnEdit = "disabled";
			}
			if(UsageDetails::where(['house_id'=>$row->house_id,'item_id'=>$row->item_id])->exists()){
				$btnDelete = "disabled";
			}
			if(!hasRole('boq_delete')){
				$btnDelete = "disabled";
			}
			return
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-boq-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
		})->make(true);
	}
	public function getBoqCode(){
		$last_id = DB::table('boqs')->select('id')->orderBy('id','desc')->first();
		if($last_id){
			return formatZero($last_id->id+1,3);
		}else{
			return formatZero(1,3);
		}
		
		
	}

	public function getBoqHouseCode($code){
		return formatZero($code,3);
	}

    public function save(Request $request){
		// print_r($request->all());
		try {

			$rules = [
				'zone_id'	=> 'required',
				'block_id' 	=> 'required',
				'building_id' 	=> 'required',
				// 'street_id'	=>'required',
				// 'house'		=>'required',
			];
			if(count($request['working_type_no'])>0){
				for($i=0; $i< count($request['working_type_no']); $i++){
					$working_type_id = $request['working_type_no'][$i];
					if(count($request["line_item_type_".$working_type_id]) > 0){
						for($j=0; $j < count($request["line_item_type_".$working_type_id]); $j++){
							$line_item_type = $request["line_item_type_".$working_type_id][$j];
							$rules['line_item_'.$working_type_id] = 'required';
							$rules['line_unit_'.$working_type_id] = 'required';
							$rules['line_qty_add_'.$working_type_id] = 'required|max:11';
							$rules['line_qty_std_'.$working_type_id] = 'required|max:11';
							$rules['line_cost_'.$working_type_id] = 'required|max:11';
						}
					}
					
				}
			}
			// exit;
			Validator::make($request->all(),$rules)->validate();
			$where = ['status'=>1];
			if(!empty($request['zone_id'])){
				$where = array_merge($where, ['zone_id'=>$request['zone_id']]);
			}
			if(!empty($request['block_id'])){
				$where = array_merge($where, ['block_id'=>$request['block_id']]);
			}
			if(!empty($request['building_id'])){
				$where = array_merge($where, ['building_id'=>$request['building_id']]);
			}
			if(!empty($request['house_type_id'])){
				$where = array_merge($where, ['house_type'=>$request['house_type_id']]);
			}
			if(!empty($request['house'])){
				$where = array_merge($where, ['id'=>$request['house']]);
			}
			if(!empty($request['street_id'])){
				$where = array_merge($where, ['street_id'=>$request['street_id']]);
			}
			$houses = DB::table('houses')->where($where)->get();
			
			// if(count($request['line_item_type']) > 0){
			// 	for($i=0;$i<count($request['line_item_type']);$i++){
			// 		$rules['line_item_type.'.$i] = 'required';
			// 		$rules['line_item.'.$i] = 'required';
			// 		$rules['line_unit.'.$i] = 'required';
			// 		$rules['line_qty_add.'.$i] = 'required|max:11';
			// 		$rules['line_qty_std.'.$i] = 'required|max:11';
			// 	}
			// }
			
			DB::beginTransaction();
			$pro_id = $request->session()->get('project');
			// print_r($houses);exit;
			if(count($houses) > 0){
				$boq = [
					'pro_id'	=>$pro_id,
					'zone_id'	=>	$request["zone_id"],
					'block_id'	=>	$request["block_id"],
					'building_id'	=>	$request["building_id"],
					'street_id'	=>	$request["street_id"],
					'boq_code'	=> "BOQ-".$this->getBoqCode(),
					'line_no'	=>getLineNo($request['house']),
					'trans_date'=>date('Y-m-d'),
					'trans_by'	=>	Auth::user()->id,
					'trans_type'=>'Entry',
					'created_by'	=> Auth::user()->id,
				];
				$boq_id = DB::table('boqs')->insertGetId($boq);
				foreach($houses as $key=>$house){
					$boq_house = [
						'boq_id'			=>	$boq_id,
						'house_id'			=>	$house->id,
						'boq_house_code'	=>	"BOQ-".$this->getBoqHouseCode($house->id,3),
						'created_by'		=>	Auth::user()->id,
						'created_at'		=>	date('Y-m-d H:i:s'),
						'created_by'	=> Auth::user()->id,
					];
					$boq_house_id = DB::table('boq_houses')->insertGetId($boq_house);

					if(count($request["working_type_no"]) > 0){
						foreach($request["working_type_no"] as $key=>$working_type){
							if(count($request["line_item_type_".$working_type]) > 0){
								foreach($request['line_item_type_'.$working_type] as $key=>$item_type){
									$item_types = [
										'boq_id' 		=>	$boq_id,
										'boq_house_id' 	=>	$boq_house_id,
										'house_id'		=>	$house->id,
										'item_id'		=>	$request["line_item_".$working_type][$key],
										'unit'			=>	$request["line_unit_".$working_type][$key],
										'qty_std'		=>	$request["line_qty_std_".$working_type][$key],
										'qty_add'		=>	$request["line_qty_add_".$working_type][$key],
										'cost'			=>	$request["line_cost_".$working_type][$key],
										'remain_qty'	=>	$request["line_qty_std_".$working_type][$key],
										'working_type'	=>	$working_type,
										'created_at'	=>	date('Y-m-d H:i:s'),
										'created_at'	=>	Auth::user()->id,
									];
									$boq_item = DB::table('boq_items')->insertGetID($item_types);
								}
							}
						}
					}

				}
				DB::commit();
				return redirect()->back()->with('success',trans('lang.save_success'));
			}

			

			// if($request['option_house']==1){
			// 	$boq = [
			// 		'house_id'	=>$request['house'],
			// 		'line_no'	=>getLineNo($request['house']),
			// 		'trans_date'=>date('Y-m-d'),
			// 		'trans_by'	=>Auth::user()->id,
			// 		'trans_type'=>'Entry'
			// 	];
			// 	$boq_id = DB::table('boqs')->insertGetId($boq);
			// 	for ($i=0;$i<count($request['line_no']);$i++) { 
			// 		$data[] = [
			// 			'boq_id'	=>$boq_id,
			// 			'house_id'	=>$request['house'],
			// 			'item_id'	=>$request['line_item'][$i],
			// 			'unit'		=>$request['line_unit'][$i],
			// 			'qty_std'	=>$request['line_qty_std'][$i],
			// 			'qty_add'	=>$request['line_qty_add'][$i],
			// 		]; 
			// 	}
			// 	DB::table('boq_items')->insert($data);
			// 	DB::commit();
			// 	return redirect()->back()->with('success',trans('lang.save_success'));
			// }else{
				
			// 	$where = ['status'=>1,'house_type'=>$request['house']];
			// 	if($request['street_id']!=0){
			// 		$where = array_merge($where, ['street_id'=>$request['street_id']]);
			// 	}
			// 	$house = House::where($where)->get(['id']);
			// 	// print_r($house);exit;
			// 	if(count($house)>0){
			// 		foreach($house as $val){
			// 			$boq = [
			// 				'house_id'	=>$val->id,
			// 				'line_no'	=>getLineNo($val->id),
			// 				'trans_date'=>date('Y-m-d'),
			// 				'trans_by'	=>Auth::user()->id,
			// 				'trans_type'=>'Entry'
			// 			];
			// 			$boq_id[$val->id] = DB::table('boqs')->insertGetId($boq);
			// 		}
			// 		if(!empty($boq_id)){
			// 			foreach($boq_id as $k=>$row){
			// 				for ($i=0;$i<count($request['line_no']);$i++) {
			// 					$data[] = [
			// 						'boq_id'	=>$row,
			// 						'house_id'	=>$k,
			// 						'item_id'	=>$request['line_item'][$i],
			// 						'unit'		=>$request['line_unit'][$i],
			// 						'qty_std'	=>$request['line_qty_std'][$i],
			// 						'qty_add'	=>$request['line_qty_add'][$i],
			// 					]; 
			// 				}
			// 			}
			// 		}
			// 	}
			// 	if(!empty($data)){
			// 		DB::table('boq_items')->insert($data);
			// 		DB::commit();
			// 		return redirect()->back()->with('success',trans('lang.save_success'));
			// 	}else{
			// 		DB::rollback();
			// 		throw new \Exception("UsageDetail[{$i}] not insert.");
			// 		// return redirect()->back()->with('error',trans('lang.no_house_'));
			// 	}
				
			// }
		} catch (\Exception $e) {
			DB::rollback();
			print_r($e->getMessage());exit;
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

    public function update(Request $request,$id)
    {
		$rules = [
				'street_id'	=>'required',
				'house_id' 	=>'required',
				'item_id' 	=>'required',
				'unit' 		=>'required',
				'qty_std' 	=>'required|max:11',
				'qty_add' 	=>'required|max:11',
			];
    	Validator::make($request->all(),$rules)->validate();
    	DB::beginTransaction();
		try {
			$data = [
				'house_id'	=>$request->house_id,
				'item_id'	=>$request->item_id,
				'unit'		=>$request->unit,
				'qty_std'	=>$request->qty_std,
				'qty_add'	=>$request->qty_add,
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			DB::table('boq_items')->where(['id'=>$id])->update($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.update_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.update_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	function view(Request $request, $id, $back){
		$id = decrypt($id);
		$back = decrypt($back);
		$redirect = url('boqs');
		if($back==2){
			$redirect = url('house');
		}
		$data = [
			'id'			=> $id,
			'title'			=> trans('lang.view'),
			'icon'			=> 'fa fa-eye',
			'small_title'	=> trans('lang.boq_details'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'boq'	=> [
						'url' 		=> url('/boqs'),
						'caption' 	=> trans('lang.boq'),
				],
				'view'	=> [
						'caption' 	=> trans('lang.view'),
				],
			],			
			'rounte'		=> url('boqs/subdt').'/'.$id,			
			'rounteBack'	=> $redirect,
		];
		return view('boq.view',$data);
	}
	
	public function destroy($id)
    {
		try {
			DB::beginTransaction();
			DB::table('boqs')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function destroySub($id)
    {
		try {
			DB::beginTransaction();
			DB::table('boq_items')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function downloadExample(Request $request)
   	{
		Excel::create('example_file_upload_boq_house_house_type',function($excel) {
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('Upload BOQ',function($sheet){
   				$sheet->cell('A1', 'Item Code');
   				$sheet->cell('B1', 'item Name');
   				$sheet->cell('C1', 'Item Type');
   				$sheet->cell('D1', 'Unit Stock');
  				$sheet->cell('E1', 'Unit Purch');
   				$sheet->cell('F1', 'Purch Cost');
  				$sheet->cell('G1', 'Qty Std');
   				$sheet->cell('H1', 'Qty Add');
   				$sheet->cell('I1', 'Unit BOQ');
   			});
   		})->download('xlsx');
   	}

   	public function uploadExcel(Request $request)
   	{
   		try {
   			if($request->hasFile('excel')){
				$fileUpdate = $request->file('excel');
				$data = Excel::load($fileUpdate->getRealPath(), function($reader) {})->get();
				$error = '';
				$house_id = 0;
				$house_type = 0;
				$main_boq_id = 0;
				if(!empty($data) && $data->count()){
					DB::beginTransaction();
					
					foreach ($data as $key => $value) {
						if (count($value)==6) {
							if ($value->house_type) {
								if ($value->item && $value->unit && stringValue($value->qty_std) && stringValue($value->qty_add)) {
									$houseTypeObj = SystemData::where('name',$value->house_type)->where('type','HT')->first();
									$itemObj  = Item::where('code',$value->item)->first();
									if (empty($houseTypeObj)) {
										$request->session()->flash('error','House Type not found');
										return redirect()->back();
									}

									$houseObj = House::where('house_type',$houseTypeObj->id)->get();

									if(empty($houseObj)){
										$request->session()->flash('error','House not found');
										return redirect()->back();
									}

									if (empty($itemObj)) {
										$request->session()->flash('error','Item not found');
										return redirect()->back();
									}

									foreach ($houseObj as $key => $val) {
										$boq_insert = [
											'house_id'   =>$val->id,
											'trans_date' =>date('Y-m-d'),
											'trans_by'   =>Auth::user()->id,
											'trans_type' =>'Entry',
										];

										if ($val->id!=$house_id) {
											$house_id = $val->id;
											$main_boq_id = DB::table('boqs')->insertGetId($boq_insert);
										}

										$insert[] = [
										'boq_id'   =>$main_boq_id,
										'house_id' =>$val->id,
										'item_id'  =>$itemObj->id,
										'unit'     =>$value->unit,
										'qty_std'  =>empty(stringValue($value->qty_std)) ? 0 : stringValue($value->qty_std),
										'qty_add'  =>empty(stringValue($value->qty_add)) ? 0 : stringValue($value->qty_add),
										];
									}

								}else{
									$request->session()->flash('error',"invalid column value");
									return redirect()->back();
								}
							}else{
								if ($value->house && $value->item && $value->unit && stringValue($value->qty_std) && stringValue($value->qty_add)) {
									$houseObj = House::where('house_no',$value->house)->first();
									$itemObj  = Item::where('code',$value->item)->first();

									if (empty($houseObj)) {
										$request->session()->flash('error','House not found');
										return redirect()->back();
									}

									if (empty($itemObj)) {
										$request->session()->flash('error','Item not found');
										return redirect()->back();
									}

									if ($houseObj->id!=$house_id) {
										$house_id = $houseObj->id;

										$insert_boq = [
											'house_id'   =>$houseObj->id,
											'trans_date' =>date('Y-m-d'),
											'trans_by'   =>Auth::user()->id,
											'trans_type' =>'Entry',
										];

										$main_boq_id = DB::table('boqs')->insertGetId($insert_boq);
									}

									$insert[] = [
										'boq_id'   =>$main_boq_id,
										'house_id' =>$houseObj->id,
										'item_id'  =>$itemObj->id,
										'unit'     =>$value->unit,
										'qty_std'  =>empty(stringValue($value->qty_std)) ? 0 : stringValue($value->qty_std),
										'qty_add'  =>empty(stringValue($value->qty_add)) ? 0 : stringValue($value->qty_add),
									];
								}else{
									$request->session()->flash('error',"invalid column value");
									return redirect()->back();
								}
							}
						}
					}

					if(!empty($insert)){
						DB::table('boq_items')->insert($insert);
						DB::commit();
						$request->session()->flash('success',trans('lang.upload_success'));
					}else{
						DB::rollback();
						$request->session()->flash('error',trans('lang.upload_error'));
					}

				}
				if ($error) {
					$request->session()->flash('bug',$error);
				}
			}
			return redirect()->back();
   		} catch (\Exception $e) {
   			DB::rollback();
			return redirect()->back()->with('error',$e->getMessage());
   		}
   	}

    public function downloadExcel($id)
   	{
		Excel::create('BOQ.export_'.date('Y_m_d_H_i_s'),function($excel) use($id){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('BOQ Info',function($sheet) use($id){
   				$cells = 1;
				$sheet->cell('A'.$cells,trans('lang.house_no'));
   				$sheet->cell('B'.$cells,trans('lang.street'));
   				$sheet->cell('C'.$cells,trans('lang.line_no'));
   				$sheet->cell('D'.$cells,trans('lang.trans_date'));
   				$sheet->cell('E'.$cells,trans('lang.trans_by'));
   				$sheet->cell('F'.$cells,trans('lang.trans_ref'));
				
				$cells++;
				$boq = getBOQs($id);
				if(count($boq)>0){
					foreach ($boq as $value) {
	   					$sheet->cell('A'.($cells),$value->house_no);
	   					$sheet->cell('B'.($cells),$value->street);
	   					$sheet->cell('C'.($cells),$value->line_no);
	   					$sheet->cell('D'.($cells),$value->trans_date);
	   					$sheet->cell('E'.($cells),$value->trans_by);
	   					$sheet->cell('F'.($cells),$value->trans_type);
						$cells++;
						
						$sheet->cell('A'.$cells,'');
						$sheet->cell('B'.$cells,trans('lang.item_code'));
						$sheet->cell('C'.$cells,trans('lang.item_name'));
						$sheet->cell('D'.$cells,trans('lang.units'));
						$sheet->cell('E'.$cells,trans('lang.qty_std'));
						$sheet->cell('F'.$cells,trans('lang.qty_add'));
						
						$cells++;
						$boq_item = getBOQItems($value->id);
						if($boq_item){
							foreach($boq_item as $val){
								$sheet->cell('A'.($cells),'');
								$sheet->cell('B'.($cells),$val->code);
								$sheet->cell('C'.($cells),$val->name);
								$sheet->cell('D'.($cells),$val->unit);
								$sheet->cell('E'.($cells),$val->qty_std);
								$sheet->cell('F'.($cells),$val->qty_add);
								$cells++;
							}
						}
	   				}
   				}
   			});
   		})->download('xlsx');
   	}
}
