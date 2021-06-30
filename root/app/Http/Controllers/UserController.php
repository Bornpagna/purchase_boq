<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Redirect;
use App\Model\PageAction;
use App\Model\Request as Requests;
use App\Model\Order;
use App\Model\PermissionUserGroup;
use App\Model\SystemData;
use App\Model\ApproveRequest;
use App\Model\ApproveOrder;
use App\User;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function index()
    {
		$data = [
			'title'			=> trans('lang.users'),
			'icon'			=> 'icon-user',
			'small_title'	=> trans('lang.user_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.user'),
				],
			],
			'rounte'		=> url("user/dt"),
		];
		
		if(hasRole('user_add')){
			$data = array_merge($data, ['rounteSave'=> url('user/save')]);
		}
        return view('users.index', $data);
    }
	
	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$users = User::where('delete',0)->whereNotIn('id',[config('app.owner'),config('app.admin')])->get();
		return Datatables::of($users)
		->addColumn('department',function($row){
			if($department = SystemData::find($row->dep_id)){
				return $department->name;
			}
			return "";
		})
		->addColumn('department2',function($row){
			if($department = SystemData::find($row->department2)){
				return $department->name;
			}
			return "";
		})
		->addColumn('department3',function($row){
			if($department = SystemData::find($row->department3)){
				return $department->name;
			}
			return "";
		})
		->addColumn('action', function ($row) {			
			$rounte_delete = url('user/destroy/'.$row->id);
			$rounte_edit = url('user/edit/'.$row->id);
			$rounte_reset = url('user/reset/'.$row->id);
			$rounte_permission = url('user/permis/'.encrypt($row->id).'/'.encrypt(1));
			$btnEdit = 'onclick="onEdit(this)"';
			$btnDelete = 'onclick="onDelete(this)"';
			$btnReset = 'onclick="onReset(this)"';
			$btnPermission = 'onclick="onPermission(this)"';
			
			if(!hasRole('user_reset')){
				$btnReset = "disabled";
			}
			if(!hasRole('user_edit')){
				$btnEdit = "disabled";
			}
			if(!hasRole('user_delete')){
				$btnDelete = "disabled";
			}
			if(!hasRole('user_permission')){
				$btnPermission = "disabled";
			}
            return
				'<a '.$btnPermission.' title="'.trans('lang.permission').'" class="btn btn-xs green permission-record" row_id="'.$row->id.'" row_rounte="'.$rounte_permission.'">'.
				'	<i class="icon-shield"></i>'.
				'</a>'.
				'<a '.$btnReset.' title="'.trans('lang.reset_password').'" class="btn btn-xs blue reset-record" row_id="'.$row->id.'" row_rounte="'.$rounte_reset.'">'.
				'	<i class="fa fa-key"></i>'.
				'</a>'.
				'<a '.$btnEdit.' title="'.trans('lang.edit').'" class="btn btn-xs yellow edit-record" row_id="'.$row->id.'" row_rounte="'.$rounte_edit.'">'.
				'	<i class="fa fa-edit"></i>'.
				'</a>'.
				'<a '.$btnDelete.' title="'.trans('lang.delete').'" class="btn btn-xs red delete-record" row_id="'.$row->id.'" row_rounte="'.$rounte_delete.'">'.
				'	<i class="fa fa-trash"></i>'.
				'</a>';
       })->make(true);
    }
	
    public function store(Request $request)
    {
		try {
            $rules = [
				'name'    =>'required|max:50',
				'tel'     =>'required|max:25',
				'dep_id'  =>'required|max:11',
				'email'   =>'required|email|max:100|unique:users',
				'position'  =>'required',
				'status'  =>'required',
				'password'  =>'required|min:6|max:15|confirmed'
			 ];
            Validator::make($request->all(),$rules)->validate();
            DB::beginTransaction();			
            $data = [
				'name'        => trim($request['name']),
				'tel'         => trim($request['tel']),
				'dep_id'      => $request['dep_id'],
				'email'       => trim($request['email']),
				'position'    => trim($request['position']),
				'password'    => bcrypt($request['password']),
				'status'      => $request['status'],
				'approval_user' => $request['approval_user'],
				'created_by'    => Auth::user()->id,
				'created_at'    => date('Y-m-d H:i:s'),
				'updated_by'    => Auth::user()->id,
				'updated_at'    => date('Y-m-d H:i:s')
			];

			if($department2 = $request['department2']){
				$data = array_merge($data,['department2' => $department2]);
			}

			if($department3 = $request['department3']){
				$data = array_merge($data,['department3' => $department3]);
			}

			if ($request->hasFile('profile')) {
				$photo = upload($request,'profile','assets/upload/picture/users/');
				$data = array_merge($data,['photo'=>$photo]);
			}

			if(!$user_id = DB::table('users')->insertGetId($data)){
				DB::rollback();
				throw new \Exception("User not insert");
			}

            DB::commit();
            $request->session()->flash('success',trans('lang.save_success'));
        } catch (\Exception $e) {
           DB::rollback();
           $request->session()->flash('error',$e->getMessage()); 
        }
        return redirect('/user');
    }
	
	public function update(Request $request, $id)
    {
		try {
			DB::beginTransaction();

			$unique = '';
            if ($request['email']!=$request['old_email']) {
                $unique = '|unique:users';
            }
            $rules = [
				'name'    =>'required|max:50',
				'tel'     =>'required|max:25',
				'dep_id'  =>'required|max:11',
				'email'   =>'required|email|max:100'.$unique,
				'status'  =>'required',
				'position'  =>'required'
			];
            Validator::make($request->all(),$rules)->validate();

			if(!$user = User::find($id)){
				throw new \Exception("User[{$id}] not found");
			}
            
            $data = [
					'name'        => trim($request['name']),
					'tel'         => trim($request['tel']),
					'dep_id'      => $request['dep_id'],
					'email'       => trim($request['email']),
					'status'      => $request['status'],
					'approval_user' => $request['approval_user'],
					'position'    => trim($request['position']),
					'updated_by'  => Auth::user()->id,
					'updated_at'  => date('Y-m-d H:i:s')
				];

			if($department2 = $request['department2']){
				$data = array_merge($data,['department2' => $department2]);
			}

			if($department3 = $request['department3']){
				$data = array_merge($data,['department3' => $department3]);
			}

            if ($request->hasFile('profile')) {
                $photo = upload($request,'profile','assets/uploads/images/');
                $data = array_merge($data,['photo_id'=>$photo]);
            }
            DB::table('users')->where('id',$id)->update($data);
            DB::commit();
            $request->session()->flash('success',trans('lang.update_success'));
        } catch (\Exception $e) {
           DB::rollback();
           $request->session()->flash('error',$e->getMessage()); 
        }
        return redirect('/user');
    }
	
	public function destroy($id)
    {
		$id = base64_decode($id);
        $update = DB::table('users')->where(['id'=>$id])->delete();
        if ($update) {
            return Redirect::to('/user')->with('success',trans('lang.success_delete'));
        }else{
            return Redirect::to('/user')->with('error',trans('lang.error_delete'));
        }
    }
	
	public function resetPass(Request $request,$id)
    {
		try {
            Validator::make($request->all(),['password'=>'required|min:6|confirmed'])->validate();
            DB::beginTransaction();
            DB::table('users')->where(['id'=>$id])->update(['password'=>bcrypt($request['password']),'remember_token' => Str::random(60)]);
			DB::commit();
            $request->session()->flash('success',trans('lang.reset_success'));
        } catch (\Exception $e) {
           DB::rollback();
           $request->session()->flash('error',trans('lang.reset_error')); 
        }
        return redirect('/user');
    }
	
	public function changeInfo(Request $request)
    {
		try {
            $rules = [
                'name'   =>'required',
                'tel'    =>'required',
                'email'  =>'required',
                'position'  =>'required'
            ];
            Validator::make($request->all(),$rules)->validate();
            DB::beginTransaction();
            $info = [
                'name'    	=>$request['name'],
                'tel'      	=>$request['tel'],
                'position'    =>$request['position'],
                'email'     =>$request['email'],
                'updated_at'=>date('Y-m-d H:i:s')
            ];
            DB::table('users')->where('id',Auth::user()->id)->update($info);
            DB::commit();
            $request->session()->flash('success',trans('lang.update_success'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error',trans('lang.save_error').'|'.$e->getLine().'|'.$e->getMessage());
        }
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
		try {
            $rules = [
                'current_password' =>'required',
                'new_password'     =>'required',
                're_new_password'  =>'required'
            ];
            Validator::make($request->all(),$rules)->validate();
            DB::beginTransaction();
            if (!Hash::check($request['current_password'],Auth::user()->password)) {
               $request->session()->flash('error',trans('lang.password_not_match'));
               return redirect()->back();
            }

            if ($request['re_new_password']!=$request['new_password']) {
               $request->session()->flash('error',trans('lang.password_not_match'));
               return redirect()->back();
            }

            DB::table('users')->where('id',Auth::user()->id)->update(['password'=>bcrypt($request['new_password'])]);
			DB::commit();
            $request->session()->flash('success',trans('lang.save_success'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error',trans('lang.save_error').'|'.$e->getLine().'|'.$e->getMessage());
        }
        return redirect()->back();
    }

    public function changeImage(Request $request)
    {
		try {
            DB::beginTransaction();
			$data = [];
            if ($request->hasFile('image')) {
				$photo = upload($request,'image','assets/upload/picture/users/');
				$data = array_merge($data, ['photo'=>$photo]);
			}
			if(isset($request->signature_pad)){
				$data_uri = $request['signature_pad'];
				$encoded_image = explode(",", $data_uri)[1];
				$decoded_image = base64_decode($encoded_image);
				$fileName=uniqid(rand()).".png";
				$url="assets/upload/picture/signature/".$fileName;
				file_put_contents($url, $decoded_image);
				$data=array_merge($data,array('signature'=>$fileName));
			}else if ($request->hasFile('signature')) {
				$signature = upload($request,'signature','assets/upload/picture/signature/');
				$data = array_merge($data, ['signature'=>$signature]);
			}
			DB::table('users')->where('id',Auth::user()->id)->update($data);
            DB::commit();
            $request->session()->flash('success',trans('lang.save_success'));
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('error',trans('lang.save_error').'|'.$e->getLine().'|'.$e->getMessage());
        }
        return redirect()->back();
    }

    public function profile()
    {
        $users = User::all();
		$data = [
			'title'			=> trans('lang.user'),
			'icon'			=> 'icon-user',
			'small_title'	=> trans('lang.profile'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.user'),
				],
			],
			'users'	=>$users	
		];
        return view('users.profile',$data);
    }
	
	public function permission(Request $request, $id, $type)
    {
		$obj = PermissionUserGroup::where(['gu_id'=>decrypt($id),'type'=>decrypt($type)])->select('page')->get();
        $data = [
			'title'			=> trans('lang.permission'),
			'icon'			=> 'icon-shield',
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.user'),
				],
			],
			'permission'=>json_encode($obj),
		];
		$rounteBack = url('user');
		$rounteSave = url('user/permis/save/'.$id.'/'.$type);
		$small_title = trans('lang.set_permission_on_user');
		
		if(decrypt($type)==2){
			$rounteBack = url('group');
			$rounteSave = url('group/permis/save/'.$id.'/'.$type);
			$small_title = trans('lang.set_permission_on_group');
		}
		
		$data = array_merge($data, ['rounteBack'=>$rounteBack, 'rounteSave'=>$rounteSave, 'small_title'=>$small_title]);
        return view('users.permission',$data);
    }
	
	public function savePermission(Request $request, $id, $type){
		$id = decrypt($id);
		$type = decrypt($type);
		try{
			DB::beginTransaction();
			DB::table('permission_user_groups')->where(['gu_id'=>$id,'type'=>$type])->delete();
			
			$pageObj = PageAction::get();
			if(count($pageObj) > 0){
				foreach($pageObj as $row){
					if(isset($request[$row->page])){
						$data[] = [
								'gu_id' =>$id,
								'type' =>$type,
								'page' =>$request[$row->page],
							];
					}
				}
			}
			if(isset($data)){
				DB::table('permission_user_groups')->insert($data);
			}
			DB::commit();
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
            DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').'|'.$e->getLine().'|'.$e->getMessage());
        }
	}
	
	public function viewChangePassword()
    {
		$data = [
			'title'			=> trans('lang.user'),
			'icon'			=> 'icon-user',
			'small_title'	=> trans('lang.change_password'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.change_password'),
				],
			],
		];
        return view('users.change_password',$data);
    }

    public function bcrypt($password)
    {
        echo Hash::check($password,Auth::user()->password);
    }

    public function myTask(Request $request)
    {
		$data = [
			'title'			=> trans('lang.my_tasks'),
			'small_title'	=> '',
			'icon'			=> 'icon-rocket',
			'small_title_pr'	=> trans('lang.approval_request'),
			'small_title_po'	=> trans('lang.approval_order'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.my_tasks'),
				],
			],
			'rountePR'		=> url("user/prDt"),
			'rountePO'		=> url("user/poDt"),
		];
        return view('users.task',$data);
    }

    public function getPRDt(Request $request)
    {
    	$pro_id = $request->session()->get('project');
		$approveRequests = ApproveRequest::select(['approve_requests.*'])
				->leftJoin('requests','approve_requests.pr_id','requests.id')
				->where('requests.pro_id',$pro_id)
				->get();
		return Datatables::of($approveRequests)
		->addColumn('pr_ref',function($row){
			if($purchase = Requests::find($row->pr_id)){
				return $purchase->ref_no;
			}
			return "";
		})
		->addColumn('approved_by',function($row){
			if($user = User::find($row->approved_by)){
				return $user->name;
			}
			return "";
		})
    	->addColumn('action', function ($row) {
    		$rounte_print = url('purch/request/print/'.encrypt($row->pr_id));
    		$actionPrint = 'onclick="onPrint(this)"';
    		
    		return	'<a '.$actionPrint.' title="'.trans('lang.print').'" class="btn btn-xs btn-primary print-record" row_id="'.$row->pr_id.'" row_rounte="'.$rounte_print.'">'.
					'	<i class="fa fa-print"></i>'.
					'</a>';
    	})->make(true);
    }

    public function getPODt(Request $request)
    {
    	$pro_id = $request->session()->get('project');	
		$approveOrders = ApproveOrder::select(['approve_orders.*'])
				->leftJoin('orders','approve_orders.po_id','orders.id')
				->where('orders.pro_id',$pro_id)
				->get();

		return Datatables::of($approveOrders)
		->addColumn('po_ref',function($row){
			if($order = Order::find($row->id)){
				return $order->ref_no;
			}
			return "";
		})
		->addColumn('approved_by',function($row){
			if($user = User::find($row->approved_by)){
				return $user->name;
			}
			return "";
		})
    	->addColumn('action', function ($row) {
    		$rounte_print = url('purch/order/print/'.encrypt($row->po_id));
    		$actionPrint = 'onclick="onPrint(this)"';

    		return	'<a '.$actionPrint.' title="'.trans('lang.print').'" class="btn btn-xs btn-primary print-record" row_id="'.$row->po_id.'" row_rounte="'.$rounte_print.'">'.
					'	<i class="fa fa-print"></i>'.
					'</a>';
    	})->make(true);
    }
}
