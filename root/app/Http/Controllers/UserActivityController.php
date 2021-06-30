<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Model\Activity;

class UserActivityController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }
	
    public function index(Request $request)
    {
		$data = [
			'title'			=> trans('lang.user_activity'),
			'icon'			=> 'fa fa-expeditedssl',
			'small_title'	=> trans('lang.user_activity_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
					],
				'dashboard'	=> [
						'caption' 	=> trans('lang.user_activity'),
					],
			],			
			'rounte'		=> url("activity/dt"),
		];
        return view('user_activity.index', $data);
	}
	
	public function show(){
		return Datatables::of(Activity::all())
		->addColumn('user_name', function ($row) {
			return User::find($row->user_id)->name;
		})->make(true);
	}
}