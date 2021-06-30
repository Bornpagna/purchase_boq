<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;
use App\Model\Role;
use App\Model\SystemData;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function index(){
		$data = [
			'title'			=> trans('lang.role'),
			'icon'			=> 'fa fa-exclamation-triangle',
			'small_title'	=> trans('lang.role_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
						'url' 		=> url('/'),
						'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
						'caption' 	=> trans('lang.role'),
				],
			],
			'rounte'		=> url("role/dt"),
		];
		
		if(hasRole('role_add')){
			$data = array_merge($data, ['rounteSave'=> url('role/save')]);
		}
		return view('role.index',$data);
	}
	
	public function getDt(Request $request)
    {
		$projectID = $request->session()->get('project');
		$roles = Role::where('level',1)->get();
        return Datatables::of($roles)
		->addColumn('zone_desc',function($row){
			return $row->zone == 1 ? "PR" : "PO";
		})
		->addColumn('department',function($row) use($projectID){
			if($row->dep_id == 0){
				return "Top Lavel";
			}else{
				if($department = SystemData::where(['type' => 'DP','parent_id' => $projectID, 'id' => $row->dep_id])->first()){
					return $department->name;
				}
				return "";
			}
		})
		->addColumn('details_url',function($row){
            return url('role/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_delete = url('role/delete/'.$row->id);
			$rounte_edit = url('role/edit/'.$row->id);
			$rounte_role = url('role/save');
			$rounte_assign = url('role/assign/'.$row->id);
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			$btnRole = 'onclick="onRole(this)"';
			$btnAssign = 'onclick="onAssign(this, '.$row->dep_id.')"';
			
			if(!hasRole('role_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('role_delete')){
				$btnDelete = "disabled";
			}
			if(($row->dep_id==0) || (!hasRole('role_add'))){
				$btnRole = 'disabled';
			}
			if(($row->dep_id!=0) || (!hasRole('role_assign'))){
				$btnAssign = 'disabled';
			}
            return
				'<a '.$btnRole.' title="'.trans('lang.add_sub_role').'" class="btn btn-xs blue role-record" row_id="'.$row->id.'" row_rounte="'.$rounte_role.'">'.
				'	<i class="fa fa-plus"></i>'.
				'</a>'.
				'<a '.$btnAssign.' title="'.trans('lang.assign_user').'" class="btn btn-xs btn-success assign-record" row_id="'.$row->id.'" row_rounte="'.$rounte_assign.'">'.
				'	<i class="fa fa-users"></i>'.
				'</a>'.
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
       })->make(true);
    }
	
	public function subDt(Request $order, $id)
    {
		$columns = [
			'roles.*',
			DB::raw("(SELECT pr_roles.dep_id FROM pr_roles WHERE pr_roles.id=$id LIMIT 1)AS dep_id"),
		];
		$roles   = Role::select($columns)->where(['level'=> 2,'dep_id'=> $id])->get();

        return Datatables::of($roles)
		->addColumn('zone_desc',function($row){
			return $row->zone == 1 ? "PR" : "PO";
		})
		->addColumn('action', function ($row) {
			$sub_rounte_delete = url('role/delete/'.$row->id);
			$sub_rounte_edit = url('role/edit/'.$row->id);
			$rounte_assign = url('role/assign/'.$row->id);
			$btnEdit = 'onclick="onSubEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			$btnAssign = 'onclick="onAssign(this, '.$row->dep_id.')"';
			
			if(!hasRole('role_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('role_delete')){
				$btnDelete = "disabled";
			}
			if(!hasRole('role_assign')){
				$btnAssign = 'disabled';
			}
            return
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-sub-record" row_id="'.$row->id.'" row_rounte="'.$sub_rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnAssign.' title="'.trans('lang.assign_user').'" class="btn btn-xs btn-success assign-record" row_id="'.$row->id.'" row_rounte="'.$rounte_assign.'">'.
				'	<i class="fa fa-users"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-sub-record" row_id="'.$row->id.'" row_rounte="'.$sub_rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>'; 
       })->make(true);
	}

    public function save(Request $request){
		$rules = [
			'name'			=>'required|max:50|unique:roles',
			'level' 		=>'required',
			'zone'			=>'required',
			'min_amount' 	=>'required',
			'max_amount' 	=>'required',
		];
        Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();
			if(isset($request['parent_id'])){
				$data = [
					'name'			=>$request->name,
					'zone'			=>$request->zone,
					'dep_id'		=>$request->parent_id,
					'level'			=>$request->level,
					'min_amount'	=>$request->min_amount,
					'max_amount'	=>$request->max_amount,
					'created_by'	=>Auth::user()->id,
					'created_at'	=>date('Y-m-d H:i:s'),
					'updated_by'	=>Auth::user()->id,
					'updated_at'	=>date('Y-m-d H:i:s'),
					'condition'		=>	$request->condition
				];
			}else{
				$data = [
					'name'			=>$request->name,
					'zone'			=>$request->zone,
					'dep_id'		=>$request->department,
					'level'			=>$request->level,
					'min_amount'	=>$request->min_amount,
					'max_amount'	=>$request->max_amount,
					'created_by'	=>Auth::user()->id,
					'created_at'	=>date('Y-m-d H:i:s'),
					'updated_by'	=>Auth::user()->id,
					'updated_at'	=>date('Y-m-d H:i:s'),
					'condition'		=>	$request->condition
				];
			}
			$id = DB::table('roles')->insertGetId($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

    public function update(Request $request, $id)
    {
		if($request['name']!=$request['old_name']){
			$unique='|unique:roles';
		}else{
			$unique='';
		}
    	$rules = [
			'name'		=>'required|max:50'.$unique,
			'level' 	=>'required',
			'zone'		=>'required',
			'min_amount' 	=>'required',
			'max_amount' 	=>'required',
		];
    	Validator::make($request->all(),$rules)->validate();
		try {
			DB::beginTransaction();
			if(isset($request['parent_id'])){
				$data = [
					'name'		=>$request->name,
					'zone'		=>$request->zone,
					'dep_id'	=>$request->parent_id,
					'level'		=>$request->level,
					'min_amount'	=>$request->min_amount,
					'max_amount'	=>$request->max_amount,
					'updated_by'=>Auth::user()->id,
					'updated_at'=>date('Y-m-d H:i:s'),
					'condition'		=>	$request->condition
				];
			}else{
				$data = [
					'name'		=>$request->name,
					'zone'		=>$request->zone,
					'dep_id'	=>$request->department,
					'level'		=>$request->level,
					'min_amount'	=>$request->min_amount,
					'max_amount'	=>$request->max_amount,
					'updated_by'=>Auth::user()->id,
					'updated_at'=>date('Y-m-d H:i:s'),
					'condition'		=>	$request->condition
				];
			}
			DB::table('roles')->where(['id'=>$id])->update($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.update_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.update_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function assign(Request $request, $id)
    {
		try {
			DB::beginTransaction();

			if(count($request['user']) > 0){
				DB::table('user_assign_roles')->where(['role_id'=>$id])->delete();
				$data = [];
				for($i=0;$i<count($request['user']);$i++){
					$data[] = [
						'role_id'		=>$id,
						'user_id'		=>$request['user'][$i],
						'created_by'=>Auth::user()->id,
						'created_at'=>date('Y-m-d H:i:s'),
					];
				}
				DB::table('user_assign_roles')->insert($data);
			}else{
				DB::rollback();
				throw new \Exception("No user selected");
			}
			DB::commit();
			return redirect()->back()->with('success',trans('lang.assign_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.assign_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
	
	public function destroy($id)
    {
		try {
			DB::beginTransaction();
			DB::table('roles')->where(['id'=>$id])->delete();
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }
}
