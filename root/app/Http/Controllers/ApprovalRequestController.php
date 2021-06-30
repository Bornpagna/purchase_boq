<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Datatables;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Excel;

class ApprovalRequestController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function index(){
		$data = [
			'title'			=> trans('lang.approval_request'),
			'icon'			=> 'fa fa-check-square-o',
			'small_title'	=> trans('lang.request_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'approve'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.approval'),
				],
				'request'	=> [
					'caption' 	=> trans('lang.request'),
				],
			],
			'rounte'		=> url("approve/request/dt"),
		];
		return view('approval.request.index',$data);
	}

	public function getDt(Request $request)
    {
		$pro_id = $request->session()->get('project');
		$user_id = Auth::user()->id;
		$OWNER = config("app.owner");
		$ADMIN = config("app.admin");
		$sql = "CALL PRApproval({$pro_id},{$user_id},{$OWNER},{$ADMIN});";
		return Datatables::of(DB::select($sql))
		->addColumn('details_url',function($row){
            return url('purch/request/subdt').'/'.$row->id;
        })
		->addColumn('action', function ($row) {
			$rounte_approve = url('approve/request/approve/'.$row->id.'/'.$row->role_id);
			$rounte_reject = url('approve/request/reject/'.$row->id.'/'.$row->role_id);
			$btnApprove = 'onclick="onApprove(this)"';
			$btnReject = 'onclick="onReject(this)"';
			$btnView = 'onclick="onView(this)"';
			$finish = 0;
			if (floatval($row->request_amount) <= floatval($row->role_max_amount)) {
				$finish = 1;
			}

			if(!hasRole('approve_request_signature')){
				$btnApprove = "disabled";
			}
			if(!hasRole('approve_request_reject')){
				$btnReject = "disabled";
			}
			if(!hasRole('approve_request_view')){
				$btnView = "disabled";
			}
			return
				'<a '.$btnView.' title="'.trans('lang.view').'" class="btn btn-xs btn-info view-record" role_id="'.$row->role_id.'" dep_id="'.$row->dep_id.'" pr_id="'.$row->id.'">'.
				'	<i class="fa fa-eye"></i>'.
				'</a>'.
				'<a '.$btnApprove.' title="'.trans('lang.approve').'" class="btn btn-xs btn-success approval-record" row_finish="'.$finish.'" row_id="'.$row->id.'" row_rounte="'.$rounte_approve.'">'.
				'	<i class="fa fa-check-square-o"></i>'.
				'</a>'.
				'<a '.$btnReject.' title="'.trans('lang.reject').'" class="btn btn-xs btn-danger reject-record" row_id="'.$row->id.'" row_rounte="'.$rounte_reject.'">'.
				'	<i class="fa fa-ban"></i>'.
				'</a>';
       })->make(true);
    }

    public function approve(Request $request, $pr_id, $role_id){
		$pro_id = $request->session()->get('project');
		$is_finish = $request->is_finish;
		try {
			if ($request->all()) {
				DB::beginTransaction();
				$data = [
					'pr_id'			=>$pr_id,
					'role_id'		=>$role_id,
					'role_id'		=>$role_id,
					'approved_by'	=>Auth::user()->id,
					'approved_date'	=>date('Y-m-d H:i:s'),
				];
				if(isset($request->signature_pad)){
					$data_uri = $request['signature_pad'];
					$encoded_image = explode(",", $data_uri)[1];
					$decoded_image = base64_decode($encoded_image);
					$fileName=uniqid(rand()).".png";
					$url="assets/upload/picture/signature/".$fileName;
					file_put_contents($url, $decoded_image);
					$data = array_merge($data, array('signature'=>$fileName));
				}else if ($request->hasFile('image')) {
					$signature = upload($request,'image','assets/upload/picture/signature/');
					$data = array_merge($data, ['signature'=>$signature]);
				}
				DB::table('approve_requests')->insert($data);

				if($is_finish==1){
					DB::table('requests')->where(['id'=>$pr_id])->update(['trans_status'=>3]);
				}else{
					DB::table('requests')->where(['id'=>$pr_id])->update(['trans_status'=>2]);
				}
				DB::commit();
				return redirect()->back()->with('success',trans('lang.save_success'));
			}
			return redirect()->back()->with('success',trans('lang.save_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.save_error').' '.$e->getMessage().' '.$e->getLine());
		}
	}

	public function reject($pr_id, $role_id)
    {
		try {
			DB::beginTransaction();
			DB::table('approve_requests')->where(['pr_id'=>$pr_id])->update(['reject'=>1]);
			DB::table('requests')->where(['id'=>$pr_id])->update(['trans_status'=>4]);
			$data = [
				'pr_id'			=>$pr_id,
				'role_id'		=>$role_id,
				'approved_by'	=>Auth::user()->id,
				'approved_date'	=>date('Y-m-d H:i:s'),
				'reject'		=>2,
			];
			DB::table('approve_requests')->insert($data);
			DB::commit();
			return redirect()->back()->with('success',trans('lang.delete_success'));
		} catch (\Exception $e) {
			DB::rollback();
			return redirect()->back()->with('error',trans('lang.delete_error').' '.$e->getMessage().' '.$e->getLine());
		}
    }

	public function downloadExcel(Request $request)
	{
		try {
			Excel::create("Approval Purchase Request",function($excel) {
				$excel->setCreator(Auth::user()->name)->setCompany(config('app.name'));
				$excel->sheet('Approval',function($sheet){
					// Header
					$sheet->cell('A1', 'Reference No');
					$sheet->cell('B1', 'Date');
					$sheet->cell('C1', 'Delivery Date');
					$sheet->cell('D1', 'Department');
					$sheet->cell('E1', 'Request By');
					$sheet->cell('F1', 'Item Code');
					$sheet->cell('G1', 'Unit');
					$sheet->cell('H1', 'Qty');
					$sheet->cell('I1', 'Size');
					$sheet->cell('J1', 'Note');
					$sheet->cell('K1', 'Remark');
					// Example Body
					$sheet->cell('A2', 'PR0001');
					$sheet->cell('B2', date('Y-m-d'));
					$sheet->cell('C2', date('Y-m-d'));
					$sheet->cell('D2', 'Account');
					$sheet->cell('E2', 'Jonh Doe');
					$sheet->cell('F2', 'ITEM001');
					$sheet->cell('G2', 'Pcs');
					$sheet->cell('H2', 2);
					$sheet->cell('I2', '2 x 4 mm (Optional)');
					$sheet->cell('J2', 'Note Text (Optional)');
					$sheet->cell('K2', 'Remark Text (Optional)');
				});
			})->download('xlsx');
		} catch (\Exception $ex) {
			return redirect('approve/request')->with("error", $ex->getMessage());
		}
	}
}
