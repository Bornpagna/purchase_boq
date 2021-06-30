<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Model\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index()
    {
		$row = Setting::find(1);
		$data = [
			'title'			=> trans('lang.system'),
			'icon'			=> 'fa fa-cogs',
			'small_title'	=> trans('lang.setting'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.setting'),
				],
			],
			'rounteSave'	=> url('setting/save'),
			'row'			=> $row,
		];
		return view('setting.index',$data);
    }

	public function save(Request $request)
    {
		$rules = [
			'app_name'		=>'required',
			'report_header'	=>'required'
		];
    	Validator::make($request->all(),$rules)->validate();
    	try {
			DB::beginTransaction();			
			if ($request->hasFile('app_icon')) {
				$destination = 'assets/upload/temps';
				$newName = 'app_icon.png';
				$photoFile = $request->file('app_icon');
				$photoFile->move($destination, $newName);
			}
			if ($request->hasFile('app_logo')) {
				$destination = 'assets/upload/temps';
				$newName = 'app_logo.png';
				$photoFile = $request->file('app_logo');
				$photoFile->move($destination, $newName);
			}
			$data = [
				'app_name'          	=> $request->app_name,
				'report_header'      	=> $request->report_header,
				'company_name'     		=> $request->company_name,
				'company_phone'     	=> $request->company_phone,
				'company_email'     	=> $request->company_email,
				'company_address'   	=> $request->company_address,
				'allow_zone'			=> $request->allow_zone,
				'allow_block'			=> $request->allow_block,
				'request_photo'			=> $request->request_photo,
				'order_photo'			=> $request->order_photo,
				'delivery_photo'		=> $request->delivery_photo,
				'return_delivery_photo'	=> $request->return_delivery_photo,
				'usage_photo'			=> $request->usage_photo,
				'return_usage_photo'	=> $request->return_usage_photo,
				'usage_constructor'		=> $request->usage_constructor,
				'return_constructor'	=> $request->return_constructor,
				'round_number'			=> $request->round_number,
				'round_dollar'			=> $request->round_dollar,
				'modal_header_color'	=> $request->modal_header_color,
				'modal_title_color'		=> $request->modal_title_color,
				'format_date'			=> $request->format_date,
				'is_costing'			=> $request->is_costing,
				'stock_account'			=> $request->stock_account,
				'image_size'			=> $request->image_size,
			];
			DB::table('settings')->where('id',1)->update($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
