<?php

namespace App;

use Illuminate\Support\Facades\Session;
use Auth;
use DB;

class Token
{	
	public function setProject(){
		Session::put('project', NULL);
	}
	
	public function setOwner(){
		Session::put('owner', 'Y');
	}
	
	public function setAdmin(){
		Session::put('admin', 'Y');
	}
	
	public function setPermis(){
		$user_id = Auth::user()->id;
		$obj = DB::select("SELECT A.page FROM (SELECT pr_permission_user_groups.`id`, (CASE WHEN pr_permission_user_groups.`type` = 1 THEN pr_permission_user_groups.`gu_id` ELSE (SELECT pr_user_groups.`user_id` FROM pr_user_groups WHERE pr_user_groups.`group_id` = pr_permission_user_groups.`gu_id` AND pr_user_groups.`user_id` = $user_id) END ) AS user_id, pr_permission_user_groups.`page` FROM pr_permission_user_groups WHERE pr_permission_user_groups.`gu_id` = $user_id OR pr_permission_user_groups.`type` = 2) AS A WHERE A.user_id = $user_id"); 
		if(count($obj)){
			foreach($obj as $val){
				Session::put($val->page, 'Y');
			}
		}
	}
}
