<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\Model\FormatInvoice;

class FormatInvoiceController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(){
		$data = [
			'title'			=> trans('lang.format_info'),
			'icon'			=> 'fa fa-file-o',
			'small_title'	=> trans('lang.list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'setting'	=> [
					'url' 		=> "#",
					'caption' 	=> trans('lang.setting'),
				],
				'format'	=> [
					'caption' 	=> trans('lang.format_info'),
				],
			],
			'rounte'		=> url("format/index"),
		];
		if(hasRole('stock_entry_add')){
			$data = array_merge($data, ['rounteAdd'=> url('format/add')]);
		}
		return view('format.index',$data);
	}
	
	public function getJsonFormatInvoice()
    {
		$formatInvoices = FormatInvoice::get();
        return Datatables::of($formatInvoices)
		->addColumn('duration_round',function($row){
			if($row->duration_round == 'M'){
				return 'Round Month';
			}

			return 'Round Year';
		})
		->addColumn('type_invoice',function($row){
			if($row->type == 'PO'){
				return 'Purchase Order';
			}elseif($row->type == 'PI'){
				return 'Purchase Invoice';
			}elseif($row->type == 'SI'){
				return 'Sale Invoice';
			}elseif($row->type == 'POSI'){
				return 'POS Invoice';
			}elseif($row->type == 'SQ'){
				return 'Sale Quote';
			}else{
				return 'Auto';
			}
		})
		->addColumn('status',function($row){
			if($row->status == 0){
				return 'Active';
			}
			return 'Disable';
		})
		->addColumn('user_create',function($row){
			if($user = User::find($row->created_by)){
				return $user->name;
			}
			return '';
		})
		->addColumn('user_update',function($row){
			if($user = User::find($row->updated_by)){
				return $user->name;
			}
			return '';
		})
		->addColumn('action', function ($val) {
                return '
				<div class="btn-group">
					<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> '.trans("lang.action").'
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li>
							<a class="font-yellow bold" href="'.url("format/edit").'/'.$val->id.'">
								<i class="font-yellow fa fa-edit"></i> '.trans("lang.edit").' </a>
						</li>
						<li>
							<a class="font-red bold" onclick="onDelete('.$val->id.')">
								<i class="font-red fa fa-trash"></i> '.trans("lang.delete").' </a>
						</li>
					</ul>
				</div>'; 
       })->make(true);
    }
	
	public function add(){
		$data = [
			'title'			=> trans('lang.format_info'),
			'icon'			=> 'fa fa-file-o',
			'small_title'	=> trans('lang.add_new'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'setting'	=> [
					'url' 		=> "#",
					'caption' 	=> trans('lang.setting'),
				],
				'format'	=> [
					'url' 		=> url("format/index"),
					'caption' 	=> trans('lang.format_info'),
				],
				'add_new'	=> [
					'caption' 	=> trans('lang.add_new'),
				],
			],
			'rounte'		=> url("format/index"),
		];
		if(hasRole('stock_entry_add')){
			$data = array_merge($data, ['rounteAdd'=> url('format/add')]);
		}
		return view('format.add',$data);
	}
	
	public function insert(Request $request){
		try {
			$rules = array(
				'format_code' => 'required|max:10|unique:format_invoices',
				'format_name' => 'required|max:50',
				'prefix' => 'required|max:20',
				'subfix' => 'required|max:3',
				'length' => 'required|max:3',
				'start_from' => 'required|max:3',
				'interval' => 'required|max:5',
				'duration_round' => 'required',
				'type' => 'required',
				'status' => 'required',
			);
			Validator::make($request->all(),$rules)->validate();
			
			if($request['status']==0){
				FormatInvoice::where('type',$request['type'])->update(['status'=>'1']);
			}
			
			FormatInvoice::insert([
				'format_code' 	=> $request['format_code'],
				'format_name' 	=> $request['format_name'],
				'prefix' 		=> $request['prefix'],
				'subfix' 		=> $request['subfix'],
				'length' 		=> $request['length'],
				'start_from'	=> $request['start_from'],
				'interval' 		=> $request['interval'],
				'duration_round'=> $request['duration_round'],
				'type'			=> $request['type'],
				'example'		=> $request['example'],
				'status' 		=> $request['status'],
				'created_at'	=> date('Y-m-d H:i:s'),
				'updated_at'	=> date('Y-m-d H:i:s'),
				'created_by'	=> Auth::user()->id,
				'udpated_by'	=> Auth::user()->id,
			]);
			
			if($request['save_new']){
				return Redirect::to('format/add')->with('success',trans('lang.save_success'));
			}
			return Redirect::to('format/index')->with('success',trans('lang.save_success'));
		}catch (Exception $e) {
			return Redirect::to('format/index')->with('error',trans('lang.save_fail'));
		}
	}
	
	public function edit($id){
		$data = FormatInvoice::find($id);
		if($data){
			return view('format.edit',compact('data'));
		}
		return Redirect::to('format/index');
	}
	
	public function update(Request $request){
		if(FormatInvoice::find($request['id'])){
			if($request['format_code']!=$request['old_format_code']){
				$unique="|unique:format_invoices";
			}else{
				$unique="";
			}
			$rules = array(
				'format_code' => 'required|max:10'.$unique,
				'format_name' => 'required|max:50',
				'prefix' => 'required|max:20',
				'subfix' => 'required|max:3',
				'length' => 'required|max:3',
				'start_from' => 'required|max:3',
				'interval' => 'required|max:5',
				'duration_round' => 'required',
				'type' => 'required',
				'status' => 'required',
			);
			Validator::make($request->all(),$rules)->validate();
			
			FormatInvoice::where('id',$request['id'])->update([
				'format_code' => $request['format_code'],
				'format_name' 	=> $request['format_name'],
				'prefix' 		=> $request['prefix'],
				'subfix' 		=> $request['subfix'],
				'length' 		=> $request['length'],
				'start_from'	=> $request['start_from'],
				'interval' 		=> $request['interval'],
				'duration_round'=> $request['duration_round'],
				'type'			=> $request['type'],
				'status' 		=> $request['status'],
				'updated_at'	=> date('Y-m-d H:i:s'),
				'udpated_by'	=> Auth::user()->id,
			]);
			return Redirect::to('format/index')->with('success',trans('template.update_success'));
		}else{
			return Redirect::to('format/index')->with('fail',trans('template.update_fail'));
		}
	}
	
	public function onDelete(Request $request){
		if($request->ajax() && FormatInvoice::find($request['id'])){
			FormatInvoice::where('id',$request['id'])->delete();
		}
	}
}
