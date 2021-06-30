<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Excel;
use App\Model\Project;
use App\Model\Item;
use App\Model\Unit;
use App\Model\SystemData;
use App\Model\Boq;
use App\Model\BoqItem;
use App\Model\House;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
		$request->session()->put('project', NULL);
		
		$started = trans('lang.started');
		$stopped = trans('lang.stopped');
		$finished = trans('lang.finished');
		$profile = "assets/pages/img/avatars/team7.jpg";
		$cover = "assets/pages/img/background/32.jpg";
		$obj = DB::select("SELECT 
				  pr_projects.id,
				  pr_projects.name,
				  pr_projects.desc,
				  pr_projects.tel,
				  pr_projects.email,
				  pr_projects.url,
				  pr_projects.address,
				  (CASE WHEN pr_projects.profile!='' THEN pr_projects.profile ELSE '$profile' END)AS `profile`,
				  (CASE WHEN pr_projects.`cover`!='' THEN pr_projects.cover ELSE '$cover' END)AS cover,
				  pr_projects.`status`,
				  (CASE WHEN pr_projects.`status`='1' THEN '$started' WHEN pr_projects.`status`='2' THEN '$finished' ELSE '$stopped' END)AS `stat`,
				  (SELECT 
					`pr_users`.`name` 
				  FROM
					`pr_users` 
				  WHERE `pr_users`.`id` = `pr_projects`.`created_by`) AS created_by,
				  created_at 
				FROM
				  `pr_projects` WHERE `pr_projects`.`status`!=0");
		if(count($obj)<=0){return false;} 
		$data = [
			'title'			=> trans('lang.login_project'),
			'small_title'	=> trans('lang.select_option'),
			'background'	=> '',
			'link'	=> [
					'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
					],
					'dashboard'	=> [
						'caption' 	=> trans('lang.login_project'),
					],
			],
			'rounteSave'	=> url('project/save'),
			'rounteDownload'=> url('project/excel/download'),
			'rounteExcel'	=> url('project/downloadSampleExcelBOQ'),
			'rounteUploade'	=> url('project/importSampleExcelBOQ'),
			'data'			=> $obj,
		];
        return view('project.index',$data);
    }
	
	public function save(Request $request){
		$rules = [
			'name'		=>'required|max:50|unique:projects',
			'tel' 		=>'required|max:20',
			'email' 	=>'required|max:100',
			'url' 		=>'required|max:50',
			'address' 	=>'required|max:200',
			'status' 	=>'required',
		];
        Validator::make($request->all(),$rules)->validate();
		DB::beginTransaction();
		try {
			$data = [
				'name'		=>$request->name,
				'tel'		=>$request->tel,
				'email'		=>$request->email,
				'url'		=>$request->url,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'created_by'=>Auth::user()->id,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			if ($request->hasFile('cover_photo')) {
				$cover = upload($request,'cover_photo','assets/pages/img/background/');
				$data = array_merge($data,['cover'=>'assets/pages/img/background/'.$cover]);
			}
			if ($request->hasFile('profile_photo')) {
				$profile = upload($request,'profile_photo','assets/pages/img/avatars/');
				$data = array_merge($data,['profile'=>'assets/pages/img/avatars/'.$profile]);
			}
			$id = DB::table('projects')->insertGetId($data);			
			DB::commit();
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}
	
	public function update(Request $request,$id)
    {
		$unique='';
		if($request['name']!=$request['old_name']){
			$unique='|unique:projects';
		}
    	$rules = [
			'name'		=>'required|max:50'.$unique,
			'tel' 		=>'required|max:20',
			'email' 	=>'required|max:100',
			'url' 		=>'required|max:50',
			'address' 	=>'required|max:200',
			'status' 	=>'required',
		];
    	Validator::make($request->all(),$rules)->validate();
    	DB::beginTransaction();
		try {
			$data = [
				'name'		=>$request->name,
				'tel'		=>$request->tel,
				'email'		=>$request->email,
				'url'		=>$request->url,
				'address'	=>$request->address,
				'status'	=>$request->status,
				'updated_by'=>Auth::user()->id,
				'updated_at'=>date('Y-m-d H:i:s'),
			];
			if ($request->hasFile('cover_photo')) {
				$cover = upload($request,'cover_photo','assets/pages/img/background/');
				$data = array_merge($data,['cover'=>'assets/pages/img/background/'.$cover]);
			}
			if ($request->hasFile('profile_photo')) {
				$profile = upload($request,'profile_photo','assets/pages/img/avatars/');
				$data = array_merge($data,['profile'=>'assets/pages/img/avatars/'.$profile]);
			}
			DB::table('projects')->where(['id'=>$id])->update($data);
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
			DB::table('projects')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function downloadExcel(Request $request)
   	{
		$pro_id = $request->session()->get('project');
   		Excel::create('projects_list.export_'.date('Y_m_d_H_i_s'),function($excel)use($pro_id){
   			$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
   			$excel->sheet('projects info',function($sheet)use($pro_id){
   				$sheet->cell('A1','Project name');
   				$sheet->cell('B1','Phone');
   				$sheet->cell('C1','E-mail');
   				$sheet->cell('D1','URL');
   				$sheet->cell('E1','Address');
   				$sheet->cell('F1','Status');
				
				$arr = ['', trans('lang.started'), trans('lang.finished'), trans('lang.stopped')];
				$data = DB::table('projects')->get();
				if(count($data)>0){
					foreach ($data as $key=>$value) {
	   					$sheet->cell('A'.($key+2),$value->name);
	   					$sheet->cell('B'.($key+2),$value->tel);
	   					$sheet->cell('C'.($key+2),$value->email);
	   					$sheet->cell('D'.($key+2),$value->url);
	   					$sheet->cell('E'.($key+2),$value->address);
	   					$sheet->cell('F'.($key+2),$arr[$value->status]);
	   				}
   				}
   			});
   		})->download('xlsx');
   	}
	
	public function choose(Request $request, $id){
		$request->session()->put('project', $id);
		return redirect('/');
	}

	public function downloadSampleExcelBOQ(Request $request)
	{
		try {
			$date = date('Y-m-d H:i:s');
			Excel::create("Original BOQ ({$date})",function($excel) {
				$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
				$excel->sheet('Setup Project and BOQ',function($sheet){
					// Header
					$sheet->cell('A1', 'Project');
					$sheet->cell('B1', 'Zone');
					$sheet->cell('C1', 'Block');
					$sheet->cell('D1', 'Street');
					$sheet->cell('E1', 'House Type');
					$sheet->cell('F1', 'House');
					$sheet->cell('G1', 'Item Type');
					$sheet->cell('H1', 'Item Code');
					$sheet->cell('I1', 'Item Name');
					$sheet->cell('J1', 'Unit Convert');
					$sheet->cell('K1', 'Unit');
					$sheet->cell('L1', 'Cost');
					$sheet->cell('M1', 'Quantity');
					// Example Body
					$sheet->cell('A2', 'Project A');
					$sheet->cell('B2', 'Zone A');
					$sheet->cell('C2', 'Block A');
					$sheet->cell('D2', 'Street A');
					$sheet->cell('E2', 'Queen');
					$sheet->cell('F2', 'House 001');
					$sheet->cell('G2', 'Cement');
					$sheet->cell('H2', 'CM0001');
					$sheet->cell('I2', 'Cement A');
					$sheet->cell('J2', 'A=1|B=2|C=10');
					$sheet->cell('K2', 'A');
					$sheet->cell('L2', 2);
					$sheet->cell('M2', 10);
					// Example Body
					$sheet->cell('A3', 'Project A');
					$sheet->cell('B3', 'Zone A');
					$sheet->cell('C3', 'Block A');
					$sheet->cell('D3', 'Street A');
					$sheet->cell('E3', 'Queen');
					$sheet->cell('F3', 'House 001|House 002');
					$sheet->cell('G3', 'Cement');
					$sheet->cell('H3', 'CM0002');
					$sheet->cell('I3', 'Cement B');
					$sheet->cell('J3', 'A=1|B=2|C=10');
					$sheet->cell('K3', 'A');
					$sheet->cell('L3', 2);
					$sheet->cell('M3', 10);
				});
			})->download('xlsx');
		} catch (\Exception $ex) {
			return redirect('project')->with("error", $ex->getMessage());
		}
	}

	public function importSampleExcelBOQ(Request $request)
	{
		try {
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

			foreach($data as $index => $row){
				$columnCount = $index + 1;
				$cellCount = $columnCount + 1;

				if(empty($row->project)){
					throw new \Exception("Column[A{$cellCount}] is empty");
				}

				if(empty($row->street)){
					throw new \Exception("Column[D{$cellCount}] is empty");
				}

				if(empty($row->house_type)){
					throw new \Exception("Column[E{$cellCount}] is empty");
				}

				if(empty($row->house)){
					throw new \Exception("Column[F{$cellCount}] is empty");
				}

				if(empty($row->item_type)){
					throw new \Exception("Column[G{$cellCount}] is empty");
				}

				if(empty($row->item_code)){
					throw new \Exception("Column[H{$cellCount}] is empty");
				}

				if(empty($row->item_name)){
					throw new \Exception("Column[I{$cellCount}] is empty");
				}

				if(empty($row->unit_convert)){
					throw new \Exception("Column[J{$cellCount}] is empty");
				}

				if(empty($row->unit)){
					throw new \Exception("Column[K{$cellCount}] is empty");
				}

				if(empty($row->cost)){
					throw new \Exception("Column[L{$cellCount}] is empty");
				}

				if(empty($row->quantity)){
					throw new \Exception("Column[M{$cellCount}] is empty");
				}

				// project
				if(!$project = Project::where(['name' => $row->project,'status' => 1])->first()){
					$project_ = [
						'name' 			=> $row->project,
						'tel'			=> '0',
						'profile'		=> 'assets/system/project/default_logo.png',
						'cover'			=> 'assets/system/project/default_cover.png',
						'created_by'	=> Auth::user()->id,
						'updated_by'	=> Auth::user()->id,
						'created_at'	=> date('Y-m-d H:i:s'),
						'updated_at'	=> date('Y-m-d H:i:s'),
					];

					if(!$projectId = DB::table('projects')->insertGetId($project_)){
						DB::rollback();
						throw new \Exception("Project [{$row->project}] not create");
					}

					$project = Project::find($projectId);
				}

				// zone
				if(!empty($row->zone)){
					if(!$zone = SystemData::where(['type'=> 'ZN','name'=>$row->zone,'status'=>1])->first()){
						$zone_ = [
							'name'  		=> $row->zone,
							'type'			=> 'ZN',
							'parent_id'		=> $project->id,
							'created_by'	=> Auth::user()->id,
							'updated_by'	=> Auth::user()->id,
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s'),
						];

						if(!$zoneId = DB::table('system_datas')->insertGetId($zone_)){
							DB::rollback();
							throw new \Exception("Zone [{$row->zone}] not create");
						}
	
						$zone = SystemData::find($zoneId);
					}
				}

				// block
				if(!empty($row->block)){
					if(!$block = SystemData::where(['type'=> 'BK','name'=>$row->block,'status'=>1])->first()){
						$block_ = [
							'name'  		=> $row->block,
							'type'			=> 'BK',
							'parent_id'		=> $project->id,
							'created_by'	=> Auth::user()->id,
							'updated_by'	=> Auth::user()->id,
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s'),
						];

						if(!$blockId = DB::table('system_datas')->insertGetId($block_)){
							DB::rollback();
							throw new \Exception("Block [{$row->block}] not create");
						}
	
						$block = SystemData::find($blockId);
					}
				}

				// street
				if(!$street = SystemData::where(['type'=> 'ST','name'=>$row->street,'status'=>1])->first()){
					$street_ = [
						'name'  		=> $row->street,
						'type'			=> 'ST',
						'parent_id'		=> $project->id,
						'created_by'	=> Auth::user()->id,
						'updated_by'	=> Auth::user()->id,
						'created_at'	=> date('Y-m-d H:i:s'),
						'updated_at'	=> date('Y-m-d H:i:s'),
					];

					if(!$streetId = DB::table('system_datas')->insertGetId($street_)){
						DB::rollback();
						throw new \Exception("Street [{$row->street}] not create");
					}

					$street = SystemData::find($streetId);
				}

				// house type
				if(!$houseType = SystemData::where(['type'=> 'HT','name'=>$row->house_type,'status'=>1])->first()){
					$houseType_ = [
						'name'  		=> $row->house_type,
						'type'			=> 'HT',
						'parent_id'		=> $project->id,
						'created_by'	=> Auth::user()->id,
						'updated_by'	=> Auth::user()->id,
						'created_at'	=> date('Y-m-d H:i:s'),
						'updated_at'	=> date('Y-m-d H:i:s'),
					];

					if(!$houseTypeId = DB::table('system_datas')->insertGetId($houseType_)){
						DB::rollback();
						throw new \Exception("House Type [{$row->house_type}] not create");
					}

					$houseType = SystemData::find($houseTypeId);
				}

				// Item Type
				if(!$itemType = SystemData::where(['type'=> 'IT','name'=>$row->item_type,'status'=>1])->first()){
					$itemType_ = [
						'name'  		=> $row->item_type,
						'type'			=> 'IT',
						'created_by'	=> Auth::user()->id,
						'updated_by'	=> Auth::user()->id,
						'created_at'	=> date('Y-m-d H:i:s'),
						'updated_at'	=> date('Y-m-d H:i:s'),
					];

					if(!$itemTypeId = DB::table('system_datas')->insertGetId($itemType_)){
						DB::rollback();
						throw new \Exception("Item Type [{$row->item_type}] not create");
					}

					$itemType = SystemData::find($itemTypeId);
				}

				// house
				// get all houses from house type
				$houses = House::where('house_type',$houseType->id)->get();
				if(count($houses) == 0){
					$houses = [];
					$houses_ = explode("|",$row->house);
					for ($i=0; $i < count($houses_); $i++) {
						if(!$house = House::where('house_no',$houses_[$i])->first()){
							$house_ = [
								'house_no'  	=> $row->house,
								'house_type'	=> $houseType->id,
								'pro_id'		=> $project->id,
								'street_id'		=> $street->id,
								'created_by'	=> Auth::user()->id,
								'updated_by'	=> Auth::user()->id,
								'created_at'	=> date('Y-m-d H:i:s'),
								'updated_at'	=> date('Y-m-d H:i:s'),
							];
		
							if(!empty($zone)){
								$house_ = array_merge($house_,['zone_id' => $zone->id]);
							}
		
							if(!empty($block)){
								$house_ = array_merge($house_,['block_id' => $block->id]);
							}
		
							if(!$houseId = DB::table('houses')->insertGetId($house_)){
								DB::rollback();
								throw new \Exception("House [{$row->house}] not create");
							}
		
							$house = House::find($houseId);
							array_push($houses,$house);
						}
						array_push($houses,$house);
					}
				}

				// unit convert
				$units = [];
				$unitConvertWithEqualSymbols = explode("|",$row->unit_convert);
				$CODE = 0;
				$FACTOR = 1;
				for ($j=0; $j < count($unitConvertWithEqualSymbols); $j++) {
					$lastUnit = Unit::orderBy('id','DESC')->first();
					$last = explode("=",$unitConvertWithEqualSymbols[$j]);

					if(!$unit = Unit::where(['from_desc' => $last[$CODE],'to_desc' => $last[$CODE], 'factor' => $last[$FACTOR]])->first()){
						$unit_ = [
							'from_desc' 	=> $last[$CODE],
							'to_desc'		=> $last[$CODE],
							'factor'		=> 1,
							'from_code' 	=> "{$last[$CODE]}_{$last[$FACTOR]}",
							'to_code'		=> "{$last[$CODE]}_{$last[$FACTOR]}",
							'created_by'	=> Auth::user()->id,
							'updated_by'	=> Auth::user()->id,
							'created_at'	=> date('Y-m-d H:i:s'),
							'updated_at'	=> date('Y-m-d H:i:s'),
						];

						if(!$unitId = DB::table('units')->insertGetId($unit_)){
							DB::rollback();
							throw new \Exception("Unit [{$unitConvertWithEqualSymbols[$j]}] not create");
						}
	
						$unit = Unit::find($unitId);
						array_push($units,$unit);
					}

					array_push($units,$unit);

					// if(count($unitConvertWithEqualSymbols) > 1){
					// 	if(isset($unitConvertWithEqualSymbols[$j+1])){
					// 		$next = explode("=",$unitConvertWithEqualSymbols[$j+1]);
					// 		if(!$unit = Unit::where(['from_desc' => $last[$CODE],'to_desc' => $next[$CODE], 'factor' => $next[$FACTOR]])->first()){
					// 			$unit_ = [
					// 				'from_desc' 	=> $last[$CODE],
					// 				'to_desc'		=> $next[$CODE],
					// 				'factor'		=> $next[$FACTOR],
					// 				'from_code' 	=> "{$last[$CODE]}_{$last[$FACTOR]}",
					// 				'to_code'		=> "{$next[$CODE]}_{$next[$FACTOR]}",
					// 				'created_by'	=> Auth::user()->id,
					// 				'updated_by'	=> Auth::user()->id,
					// 				'created_at'	=> date('Y-m-d H:i:s'),
					// 				'updated_at'	=> date('Y-m-d H:i:s'),
					// 			];

					// 			if(!$unitId = DB::table('units')->insertGetId($unit_)){
					// 				DB::rollback();
					// 				throw new \Exception("Unit [{$unitConvertWithEqualSymbols[$j]}] not create");
					// 			}
			
					// 			$unit = Unit::find($unitId);
					// 			array_push($units,$unit);
					// 		}

					// 		array_push($units,$unit);
					// 	}else{
					// 		if(!$unit = Unit::where(['from_desc' => $units[0]['from_desc'],'to_desc' => $last[$CODE], 'factor' => $last[$FACTOR]])->first()){
					// 			$unit_ = [
					// 				'from_desc' 	=> $units[0]['from_desc'],
					// 				'to_desc'		=> $last[$CODE],
					// 				'factor'		=> $last[$FACTOR],
					// 				'from_code' 	=> "{$units[0]['from_code']}",
					// 				'to_code'		=> "{$last[$CODE]}_{$last[$FACTOR]}",
					// 				'created_by'	=> Auth::user()->id,
					// 				'updated_by'	=> Auth::user()->id,
					// 				'created_at'	=> date('Y-m-d H:i:s'),
					// 				'updated_at'	=> date('Y-m-d H:i:s'),
					// 			];

					// 			if(!$unitId = DB::table('units')->insertGetId($unit_)){
					// 				DB::rollback();
					// 				throw new \Exception("Unit [{$unitConvertWithEqualSymbols[$j]}] not create");
					// 			}
			
					// 			$unit = Unit::find($unitId);
					// 			array_push($units,$unit);
					// 		}

					// 		array_push($units,$unit);
					// 	}
					// }else{
					// 	if(!$unit = Unit::where(['from_desc' => $last[$CODE],'to_desc' => $last[$CODE], 'factor' => $last[$FACTOR]])->first()){
					// 		$unit_ = [
					// 			'from_desc' 	=> $last[$CODE],
					// 			'to_desc'		=> $last[$CODE],
					// 			'factor'		=> $last[$FACTOR],
					// 			'from_code' 	=> "{$last[$CODE]}_{$last[$FACTOR]}",
					// 			'to_code'		=> "{$last[$CODE]}_{$last[$FACTOR]}",
					// 			'created_by'	=> Auth::user()->id,
					// 			'updated_by'	=> Auth::user()->id,
					// 			'created_at'	=> date('Y-m-d H:i:s'),
					// 			'updated_at'	=> date('Y-m-d H:i:s'),
					// 		];

					// 		if(!$unitId = DB::table('units')->insertGetId($unit_)){
					// 			DB::rollback();
					// 			throw new \Exception("Unit [{$unitConvertWithEqualSymbols[$j]}] not create");
					// 		}
		
					// 		$unit = Unit::find($unitId);
					// 		array_push($units,$unit);
					// 	}

					// 	array_push($units,$unit);
					// }
				}

				// Item
				if(!$item = Item::where('code',$row->item_code)->first()){

					$item_ = [
						'code'  		=> $row->item_code,
						'name'			=> $row->item_name,
						'cat_id'		=> $itemType->id,
						'unit_stock'	=> $units[0]['from_code'],
						'unit_usage'	=> $units[0]['from_code'],
						'unit_purch'	=> $units[0]['from_code'],
						'created_by'	=> Auth::user()->id,
						'updated_by'	=> Auth::user()->id,
						'created_at'	=> date('Y-m-d H:i:s'),
						'updated_at'	=> date('Y-m-d H:i:s'),
					];

					if(!empty($row->cost)){
						$item_ = array_merge($item_,['cost_purch' => $row->cost]);
					}
					
					if(!$itemId = DB::table('items')->insertGetId($item_)){
						DB::rollback();
						throw new \Exception("Item Code [{$row->item_code}] not create");
					}

					$item = Item::find($itemId);
				}

				if(count($houses) == 0){
					DB::rollback();
					throw new \Exception("No house select");
				}

				// and insert boqs first
				$boqs = [];
				foreach ($houses as $house) {
					$boq = [
						'house_id'		=> $house->id,
						'line_no' 		=> getLineNo($house->id),
						'trans_date'	=> date('Y-m-d'),
						'trans_by'		=> Auth::user()->id,
						'trans_type'	=> 'Import',
					];

					if(!$boqId = DB::table('boqs')->insertGetId($boq)){
						DB::rollback();
						throw new \Exception("BOQ for house[{$house->house_no}] was\'t set.");
						exit;
					}

					array_push($boqs,['boq_id' => $boqId,'house_id' => $house->id]);
					
				}

				if(count($boqs) == 0){
					DB::rollback();
					throw new \Exception("No BOQ wasn\'t created.");
					exit;
				}

				foreach ($boqs as $boq) {

					$boqItem = [
						'boq_id' 	=> $boq['boq_id'],
						'house_id' 	=> $boq['house_id'],
						'item_id' 	=> $item->id,
						'unit'		=> $units[0]['from_code'],
						'qty_std'	=> $row->quantity,
						'qty_add'	=> 0,
						'updated_by'=> Auth::user()->id,
						'updated_at'=> date('Y-m-d H:i:s'),
					];
	
					if(!$boqItemId = DB::table('boq_items')->insertGetId($boqItem)){
						DB::rollback();
						throw new \Exception("BOQ for house[{$house->house_no}] was\'t set.");
						exit;
					}
				}
			}

			DB::commit();
			return redirect('project')->with("success", trans('lang.upload_success'));
		} catch (\Exception $ex) {
			DB::rollback();
			return redirect('project')->with("error", $ex->getMessage());
		}
	}

}
