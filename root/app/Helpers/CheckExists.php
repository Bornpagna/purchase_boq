<?php

use App\Model\SystemData;
use App\Model\Unit;
use App\Model\Item;
use App\Model\Warehouse;
use Illuminate\Support\Facades\Session;

////////////////////// check allocate /////////////////////////////
function checkAllocate($trans_ref, $alloc_ref){
	$pro_id = Session::get('project');
	$sql = "SELECT COUNT(pr_stocks.`id`) AS num FROM pr_stocks WHERE pr_stocks.`pro_id`='$pro_id' AND pr_stocks.`trans_ref`='$trans_ref' AND pr_stocks.`alloc_ref`='$alloc_ref'";
	$obj = collect(DB::select($sql))->first();
	return $obj->num;
}

////////////////////// check system data ///////////////////////////////
function checkSystemData($name, $type, $pro_id){
	$id = 0;
	$where = ['type'=>$type,'name'=>$name];
	if($type!="IT"){
		$where = array_merge($where,['parent_id'=>$pro_id]);
	}
	$obj = SystemData::select(['id'])->where($where)->first();
	if($obj){
		$id = $obj->id;
	}else{
		$data = [
			'name'		=>$name,
			'desc'		=>$name.' info',
			'type'		=>$type,
			'parent_id'	=>$pro_id,
			'created_by'=>Auth::user()->id,
			'created_at'=>date('Y-m-d H:i:s'),
		];
		$id = SystemData::insertGetId($data);
	}
	return $id;
}

////////////////////// check system data ///////////////////////////////
function checkItem($code, $name , $cat, $unit_stock, $unit_purch, $cost, $pro_id){
	$id = 0;
	$obj = Item::select(['id'])->where(['code'=>$code])->first();
	if($obj){
		$id = $obj->id;
	}else{
		$data = [
			'code'		=>$code,
			'name'		=>$name,
			'desc'		=>$name.' import from excel file',
			'cat_id'	=>checkSystemData($cat, 'IT', $pro_id),
			'unit_usage'=>$unit_stock,
			'unit_stock'=>$unit_stock,
			'unit_purch'=>$unit_purch,
			'cost_purch'=>$cost,
			'created_by'=>Auth::user()->id,
			'created_at'=>date('Y-m-d H:i:s'),
		];
		checkUnit($unit_stock, $unit_purch);
		$id = Item::insertGetId($data);
	}
	return $id;
}

////////////////////// check unit conversion ///////////////////////////////
function checkUnit($stock, $purch){
	$where = ['from_code'=>$purch,'to_code'=>$stock];
	$obj = Unit::where($where)->exists();
	if(!$obj){
		$data = [
			'from_code'	=>$purch,
			'from_desc'	=>$purch,
			'to_code'	=>$stock,
			'to_desc'	=>$stock,
			'created_by'=>Auth::user()->id,
			'created_at'=>date('Y-m-d H:i:s'),
		];
		$id = Unit::insert($data);
	}
}

///////////////////// check warehouse //////////////////////
function checkWarehouse($val, $pro_id){
	$id = 0;
	$obj = Warehouse::select(['id'])->where(['name'=>$val, 'pro_id'=>$pro_id])->first();
	if($obj){
		$id = $obj->id;
	}else{
		$data = [
			'name'		=>$val,
			'tel'		=>'N/A',
			'address'	=>'upload excel file',
			'user_control'=>Auth::user()->id,
			'pro_id'	=>$pro_id,
			'created_by'=>Auth::user()->id,
			'created_at'=>date('Y-m-d H:i:s'),
		];
		$id = DB::table('warehouses')->insertGetId($data);
	}
	return $id;
}
