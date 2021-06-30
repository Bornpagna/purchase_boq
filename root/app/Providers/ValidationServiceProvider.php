<?php

namespace App\Providers;

use Validator;
use DB;
use Illuminate\Support\ServiceProvider;
use App\Model\SystemData;
use App\Model\Warehouse;
use App\Model\House;
use App\Model\StockEntry;
use App\Model\StockAdjust;
use App\Model\StockMove;
use App\Model\Usage;
use App\Model\ReturnUsage;
use App\Model\Request;
use App\Model\Order;
use App\Model\Delivery;
use App\Model\ReturnDelivery;
use Illuminate\Support\Facades\Session;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_system_data', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !SystemData::where(['parent_id'=>$pro_id,'name'=>$value,'type'=>$parameters[0]])->exists();
		});
		Validator::extend('unique_warehouse', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !Warehouse::where(['pro_id'=>$pro_id,'name'=>$value])->exists();
		});
		Validator::extend('unique_house', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !House::where(['pro_id'=>$pro_id,'house_no'=>$value,'street_id'=>$parameters[0]])->exists();
		});
		Validator::extend('unique_stock_entry', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !StockEntry::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_stock_adjust', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !StockAdjust::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_stock_move', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !StockMove::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_stock_use', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !Usage::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_return_usage', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !ReturnUsage::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_request', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !Request::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_order', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !Order::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_delivery', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !Delivery::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
		Validator::extend('unique_return_delivery', function($attribute, $value, $parameters, $validator) {
			$pro_id = Session::get('project');
			return !ReturnDelivery::where(['pro_id'=>$pro_id,'ref_no'=>$value])->exists();
		});
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
