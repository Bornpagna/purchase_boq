@extends('layouts.app')

@section('content')
<?php 
	$start_date   = '';
	$end_date     = '';
	$depArray     = [];
	$statusArray  = [];
	$dep_id       = '';
	$trans_status = '';
	$param        = '?v=1';
	$start        = 0;
    if (Request::input('start_date')) {
        $start_date = Request::input('start_date');
        $param.='&start_date='.$start_date;
    }else{
        $start_date = date('Y-m-d');
        $param.='&start_date='.$start_date;
    }

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.='&end_date='.$end_date;
    }else{
        $end_date = date('Y-m-d');
        $param.='&end_date='.$end_date;
    }

    if (Request::input('dep_id')) {
        $dep_id = '';
        foreach (Request::input('dep_id') as $jkey => $jv) {
            $dep_id.=','.$_POST['dep_id'][$jkey];
            $depArray[$jkey] = $_POST['dep_id'][$jkey];
        }
        $param.='&dep_id='.$dep_id;
    }else{
        $param.='&dep_id='.$dep_id;
    }

    if (Request::input('trans_status')) {
        $trans_status = "";
        foreach (Request::input('trans_status') as $jkey => $jv) {
            $trans_status.=",".$_POST['trans_status'][$jkey];
            $statusArray[$jkey] = $_POST['trans_status'][$jkey];
        }
        $param.='&trans_status='.$trans_status;
    }else{
        $param.='&trans_status='.$trans_status;
    }
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title}}</span>
				</div>
				<div class="actions">
					<a title="{{trans('lang.print')}}" onclick="onPrint(this);" version="print" class="btn btn-circle btn-icon-only btn-default">
						<i class="fa fa-print"></i>
					</a>
					<a title="{{trans('lang.download')}}" onclick="onPrint(this);" version="excel"  class="btn btn-circle btn-icon-only btn-default">
						<i class="fa fa-file-excel-o"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<?php if(Session::has('bug') && count(Session::get('bug')>0)): ?>
					<?php
						echo '<div class="alert alert-danger display-show"><button class="close" data-close="alert"></button>';
						foreach(Session::get('bug') as $key=>$val){
								echo '<strong>'.trans('lang.error').'!</strong>'.trans('lang.dublicate_at_record').' '.$val['index'].'<br/>';
						}
						echo '</div>';
					?>
				<?php endif; ?>
				<div class="portlet-body" style="padding-bottom: 10px;">
	                <form method="post">
	                    {{csrf_field()}}
	                    <input type="hidden" value="{{$start_date}}" name="start_date" id="start_date">
	                    <input type="hidden" value="{{$end_date}}" name="end_date" id="end_date">
	                    <div class="portlet-body form-horizontal" style="border: 1px solid #72aee2;padding: 5px 0px;background: #f8f9fb;">
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <div class="col-md-4">
	                                    <label class="control-label bold">{{trans('lang.created_at')}}</label>
	                                    <div id="report_date" class="btn btn-info" style="width: 100%;">
	                                        <i class="fa fa-calendar"></i> &nbsp;
	                                        <span> </span>
	                                        <b class="fa fa-angle-down"></b>
	                                    </div>
	                                </div>
	                                <div class="col-md-4">
	                                    <label for="dep_id" class="control-label bold">{{trans('lang.department')}}</label>
	                                    <select class="form-control" id="dep_id" name="dep_id[]" multiple>
	                                        <option value=""></option>
	                                        {{getSystemData('DP')}}
	                                    </select>
	                                </div>
	                                <div class="col-md-4">
	                                    <label class="control-label bold">{{trans('lang.status')}}</label>
	                                    <select class="form-control" id="trans_status" name="trans_status[]" multiple>
	                                        <option value=""></option>
	                                        <option value="1">Pendding</option>
	                                        <option value="2">Approving</option>
	                                        <option value="3">Completed</option>
	                                        <option value="4">Rejected</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div class="form-group">
	                                <div class="col-md-6">
	                                    
	                                </div>
	                                <div class="col-md-6 text-right">
	                                    <button type="submit" class="btn btn-primary" id="btnSearch" name="btnSearch"><i class="fa fa-refresh"></i>&nbsp;{{trans('rep.search')}}</button>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="clearfix"></div>
	                    </div>
	                </form>
	            </div>
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
							<th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
							<th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
							<th width="10%" class="none">{{ trans('lang.department') }}</th>
							<th width="10%" class="none">{{ trans('lang.request_by') }}</th>
							<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_type') }}</th>
							<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_code') }}</th>
							<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_name') }}</th>
							<th width="5%" class="all phone-l phone-p">{{ trans('lang.qty') }}</th>
							<th width="5%" class="all phone-l phone-p">{{ trans('rep.ordered_qty') }}</th>
							<th width="5%" class="all phone-l phone-p">{{ trans('lang.units') }}</th>
							<th width="5%" class="all phone-l phone-p">{{ trans('lang.boq') }}</th>
							<th width="5%" class="all">{{ trans('lang.status') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="invoice" style="display: none;">
    @include('reports.header')
    <div style="width: -webkit-fill-available;">
        <span style="position: absolute;
        margin: 153px 0px 0px 0px;
        width: -webkit-fill-available;
        font-size: 12px;
        font-family: myKhBattambang;
        font-weight: bold;">*{{trans("rep.start_date")}} :.....................{{trans("rep.end_date")}} :.....................</span>
        <span style="position: absolute;
        margin: 149px 0px 0px 45px;
        width: -webkit-fill-available;
        font-size: 12px;
        font-family: myKhBattambang;
        font-weight: bold;
        color: {{getSetting()->report_header_color}};">{{date('d/m/Y',strtotime($start_date))}}</span>
        <span style="position: absolute;
        margin: 149px 0px 0px 144px;
        width: -webkit-fill-available;
        font-size: 12px;
        font-family: myKhBattambang;
        font-weight: bold;
        color: {{getSetting()->report_header_color}};">{{date('d/m/Y',strtotime($end_date))}}</span>
    </div>
    <style type="text/css">
        .invoice-table th {
            font-family: myKhBattambang !important;
            background-color: {{getSetting()->report_header_color}} !important;
            color: white !important;
            border-top: 1px solid {{getSetting()->report_header_color}} !important;
            border-bottom: 1px solid {{getSetting()->report_header_color}} !important;
            border-right: 1px solid {{getSetting()->report_header_color}} !important;
            border-left: 1px solid {{getSetting()->report_header_color}} !important;
            padding: 1px !important;
            font-size: 8px !important;
            text-align: center !important;
        }

        .invoice-table td {
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px dotted #9E9E9E !important;
            border-bottom: 1px dotted #9E9E9E !important;
            border-right: 1px solid #fff0 !important;
            border-left: 1px solid #fff0 !important;
        }
        
        .invoice-table-sub td{
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px solid #fff !important;
            border-bottom: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
            border-left: 1px solid #fff !important; 
        }

        .invoice-table-sub th{
            font-family: myKhBattambang !important;
            background-color: #0f92b1 !important;
            color: white !important;
            border-top: 1px solid #0f92b1 !important;
            border-bottom: 1px solid #0f92b1 !important;
            border-right: 1px solid #0f92b1 !important;
            border-left: 1px solid #0f92b1 !important;
            padding: 1px !important;
            font-size: 7px !important;
            text-align: center !important;
        }

    </style>
    <div class="invoice-items">
        <div class="div-table">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
						<th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
						<th width="10%" class="none">{{ trans('lang.department') }}</th>
						<th width="10%" class="none">{{ trans('lang.request_by') }}</th>
						<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_type') }}</th>
						<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_code') }}</th>
						<th width="10%" class="all phone-l phone-p">{{ trans('lang.item_name') }}</th>
						<th width="5%" class="all phone-l phone-p">{{ trans('lang.qty') }}</th>
						<th width="5%" class="all phone-l phone-p">{{ trans('rep.ordered_qty') }}</th>
						<th width="5%" class="all phone-l phone-p">{{ trans('lang.units') }}</th>
						<th width="5%" class="all phone-l phone-p">{{ trans('lang.boq') }}</th>
						<th width="5%" class="all">{{ trans('lang.status') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-tbody"></tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Varian -->
@endsection()

@section('javascript')
<script type="text/javascript">

	function generatePrint(response) {
        if (response) {
            var div = $('.invoice-table-tbody');
            div.empty();
			var divString   = '';
			var project     = [];
			var request_obj = [];

            $.each(response,function(key,v){
            	divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center !important;" class="black-all">'+formatDate(v.trans_date)+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.ref_no+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.department+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.request_people_name+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.category+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.item_code+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.item_name+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.qty+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.ordered_qty+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+v.unit+'</td>';

                if (v.boq_set=="-1") {
                	boq_set = "Not set";
                }else{
                	boq_set = "Set";
                }

                if(v.trans_status==1){
					status='Pendding';
				}else if(v.trans_status==2){
					status='Approving';
				}else if(v.trans_status==3){
					status='Completed';
				}else if(v.trans_status==4){
					status='Rejected';
				}

                divString += '<td style="text-align:center !important;" class="black-all">'+boq_set+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+status+'</td>';
                divString += '</tr>';
            });

            div.append(divString);
        }
        diplayPrint();
    }

    function diplayPrint() {
        var strInvioce=$('.invoice').html();
        var styleInvoice = $('.style-invoice').html();
        var popupWin = window.open('', '_blank', 'width=714,height=800');
        var printInvoice = '<html>';
            printInvoice += '<head>';
            printInvoice += '<title></title>';
            printInvoice += styleInvoice;
            printInvoice += '</head>';
            printInvoice += '<body>';
            printInvoice += strInvioce;
            printInvoice += '</body>';
            printInvoice += '</html>';
        popupWin.document.open();
        popupWin.document.write(printInvoice);
        popupWin.print();
    }

	function onPrint(argument) {
		var version = $(argument).attr('version');
		if (version=='print') {
			$.ajax({
				url:'<?php echo url("/report/purchase-request-and-order-data").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/purchase-request-and-order-data").$param;?>&version="+version;
		}
	}

	$(document).ready(function(){

		$.fn.select2.defaults.set('theme','classic');
        $('#dep_id,#trans_status').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

        var start_date = '{{$start_date}}';
        var end_date = '{{$end_date}}';

        if(start_date=='' || start_date==null){
            var date  = Date.parse(jsonStartDate[0].start_date);
            start_date = date.toString('MMMM d, yyyy');
        }else{
            var date =  Date.parse(start_date);
            start_date = date.toString('MMMM d, yyyy');
        }

        if(end_date=='' || end_date==null){
            var date  = Date.parse(jsonEndDate[0].end_date);
            end_date = date.toString('MMMM d, yyyy');
        }else{
            var date  = Date.parse(end_date);
            end_date = date.toString('MMMM d, yyyy');
        }
        $('#report_date span').html(start_date + ' - ' + end_date);
        $('#report_date').show();

        $('#dep_id').select2('val',<?php echo json_encode($depArray);?>);
        $('#trans_status').select2('val',<?php echo json_encode($statusArray);?>);

		$('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/purchase-request-and-order-data").$param;?>&version=datatables',
			columns: [
				{data: 'trans_date', name:'trans_date'},
				{data: 'ref_no', name:'ref_no'},
				{data: 'department', name:'department'},
				{data: 'request_people_name', name:'request_people_name'},
				{data: 'category', name:'category'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'qty', name:'qty'},
				{data: 'ordered_qty', name:'ordered_qty'},
				{data: 'unit', name:'unit'},
				{data: 'boq_set', name:'boq_set'},
				{data: 'trans_status', name:'trans_status'}
			],fnCreatedRow:function(nRow,aData,iDataIndex){
				var boq_set = '';
				var trans_status = '';
				if(aData['trans_status']==1){
					trans_status='<span class="label label-warning">Pendding</span>';
				}else if(aData['trans_status']==2){
					trans_status='<span class="label label-info">Approving</span>';
				}else if(aData['trans_status']==3){
					trans_status='<span class="label label-success">Completed</span>';
				}else if(aData['trans_status']==4){
					trans_status='<span class="label label-danger">Rejected</span>';
				}
				if(aData['boq_set']==-1){
					boq_set='<span class="label label-danger">Not Set</span>';
				}else{
					boq_set='<span class="label label-info">Set</span>';
				}
				$('td:eq(10)',nRow).html(boq_set).addClass("text-center");
				$('td:eq(11)',nRow).html(trans_status).addClass("text-center");
				$('td:eq(0)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			}
		});
	});
</script>
@endsection()