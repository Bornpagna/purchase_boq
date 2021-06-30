@extends('layouts.app')

@section('stylesheet')
	<style>
		td.details-control {
            background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
            cursor: pointer !important;
        }
        tr.shown td.details-control {
            background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
        }
        td.tdetails-control {
            background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
            cursor: pointer !important;
        }
        tr.shown td.tdetails-control {
            background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
        }
	</style>
@endsection

@section('content')
<?php
    $start_date     = '';
    $end_date       = '';
    $warehouseArray = [];
    $streetArray    = [];
    $houseArray     = [];
    $eng_usage      = '';
    $sub_usage      = '';
    $block_id      = '';
    $street_id      = '';
    $house_id       = '';
    $warehouse_id   = '';
    $param          = '?v=1';
    $start          = 0;
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

    if (Request::input('eng_usage')) {
        $eng_usage = Request::input('eng_usage');
        $param.='&eng_usage='.$eng_usage;
    }

    if (Request::input('sub_usage')) {
        $sub_usage = Request::input('sub_usage');
        $param.='&sub_usage='.$sub_usage;
    }

    if (Request::input('block_id')) {
        $block_id = Request::input('block_id');
        $param.='&block_id='.$block_id;
    }
    if (Request::input('street_id')) {
        $street_id = Request::input('street_id');
        $param.='&street_id='.$street_id;
    }
    if (Request::input('house_id')) {
        $house_id = '';
        foreach (Request::input('house_id') as $jkey => $jv) {
            $house_id.=','.$_POST['house_id'][$jkey];
            $houseArray[$jkey] = $_POST['house_id'][$jkey];
        }
        $param.='&house_id='.$house_id;
    }else{
        $param.='&house_id='.$house_id;
    }

    if (Request::input('warehouse_id')) {
        $warehouse_id = "";
        foreach (Request::input('warehouse_id') as $jkey => $jv) {
            $warehouse_id.=",".$_POST['warehouse_id'][$jkey];
            $warehouseArray[$jkey] = $_POST['warehouse_id'][$jkey];
        }
        $param.='&warehouse_id='.$warehouse_id;
    }else{
        $param.='&warehouse_id='.$warehouse_id;
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
                                        <label for="block_id" class="control-label bold">{{trans('lang.block')}}</label>
                                        <select class="form-control" id="block_id" name="block_id">
                                            <option></option>
                                            {{getSystemData('BK')}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="street_id" class="control-label bold">{{trans('lang.street')}}</label>
                                        <select class="form-control" id="street_id" name="street_id">
                                            <option></option>
                                            {{getSystemData('ST')}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="house_id" class="control-label bold">{{trans('lang.house')}}</label>
                                        <select class="form-control" id="house_id" name="house_id[]" multiple></select>
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
							<th width="3%" class="all"> </th>
							<th width="3%" class="all">{{ trans('lang.id') }}</th>
							<th width="3%" class="all">{{ trans('lang.house_type') }}</th>
							<th width="15%" class="all">{{ trans('lang.house_no') }}</th>
							<th width="7%" class="all">{{ trans('lang.street') }}</th>
							<th width="7%" class="all">{{ trans('lang.block') }}</th>
							<th width="10%" class="all">{{ trans('lang.zone') }}</th>
							<th width="10%" class="all" style="text-align: center;">{{ trans('lang.cost') }}</th>
							<th width="3%" class="all" style="text-align: center;">{{ trans('lang.action') }}</th>
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
        .invoice-table1 th {
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

        .invoice-table1 td {
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px dotted #9E9E9E !important;
            border-bottom: 1px dotted #9E9E9E !important;
            border-right: 1px solid #fff0 !important;
            border-left: 1px solid #fff0 !important;
        }

        .invoice-table1-sub td{
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px solid #fff !important;
            border-bottom: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
            border-left: 1px solid #fff !important;
        }

        .invoice-table1-sub th{
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
        .invoice-table2 th {
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

        .invoice-table2 td {
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px dotted #9E9E9E !important;
            border-bottom: 1px dotted #9E9E9E !important;
            border-right: 1px solid #fff0 !important;
            border-left: 1px solid #fff0 !important;
        }

        .invoice-table2-sub td{
            font-size: 7px !important;
            font-family: myKhBattambang !important;
            padding: 1px 1px 1px 1px !important;
            border-top: 1px solid #fff !important;
            border-bottom: 1px solid #fff !important;
            border-right: 1px solid #fff !important;
            border-left: 1px solid #fff !important;
        }

        .invoice-table2-sub th{
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
            <table class="invoice-table" >
                <thead>
                    <tr>
						<th width="3%" class="all">{{ trans('lang.id') }}</th>
						<th width="15%" class="all">{{ trans('lang.house_type') }}</th>
                        <th width="15%" class="all">{{ trans('lang.house_no') }}</th>
                        <th width="15%" class="all">{{ trans('lang.street') }}</th>
                        <th width="15%" class="all">{{ trans('lang.block') }}</th>
                        <th width="15%" class="all">{{ trans('lang.zone') }}</th>
                        <th width="15%" class="all" style="text-align: center;">{{ trans('lang.cost') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-tbody"></tbody>
            </table>
            <table class="invoice-table1" style="width: 100% !important;">
                <thead>
                    <tr>
						<th width="3%" class="all">{{ trans('lang.id') }}</th>
						<th width="15%" class="all">{{ trans('lang.item_code') }}</th>
                        <th width="25%" class="all">{{ trans('lang.item_name') }}</th>
                        <th width="15%" class="all">{{ trans('lang.qty') }}</th>
                        <th width="15%" class="all">{{ trans('lang.units') }}</th>
                        <th width="15%" class="all" style="text-align: center;">{{ trans('lang.total') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-main"></tbody>
            </table>
            <table class="invoice-table2" style="width: 100% !important;">
                <thead>
                    <tr>
						<th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
						<th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
                        <th width="10%" class="all">{{ trans('lang.engineer') }}</th>
                        <th width="10%" class="all">{{ trans('lang.constructor') }}</th>
                        <th width="10%" class="all">{{ trans('lang.warehouse') }}</th>
                        <th width="10%" class="all">{{ trans('lang.street') }}</th>
                        <th width="10%" class="all">{{ trans('lang.item_code') }}</th>
                        <th width="10%" class="all">{{ trans('lang.item_name') }}</th>
                        <th width="5%" class="all">{{ trans('lang.qty') }}</th>
                        <th width="5%" class="all">{{ trans('lang.units') }}</th>
                        <th width="5%" class="all">{{ trans('lang.cost') }}</th>
                        <th width="5%" class="all" style="text-align: center;">{{ trans('lang.total') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-main"></tbody>
            </table>
        </div>
    </div>
</div>
@endsection()

@section('javascript')
<script type="text/javascript">  
    var plushs = 1;
    function initHouse(argument,street_id) {
        $(argument).empty();
        $.ajax({
            url:'{{url("/report/getHouse")}}',
            type:'get',
            data:{'street_id':street_id},
            success:function(response){
                if (response.length > 0) {
                    $.each(response,function(key,val){
                        $(argument).append($('<option></option>').val(val.id).text(val.house_no+' - '+val.house_desc));
                    });
                }
            },complete:function(){
                $('#house_id').select2('val',<?php echo json_encode($houseArray);?>);
            }
        });
    }

    $('#street_id').on('change',function(){
        initHouse('#house_id',this.value);
    });

	function generatePrint(response) {
        if (response) {
            var div = $('.invoice-table-tbody');
            $('.invoice-table').css('display','table');
            $('.invoice-table1').css('display','none');
            $('.invoice-table2').css('display','none');
            div.empty();
			var divString   = '';
            var i= 1;
            $.each(response,function(key,val){
                divString += '<tr>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+(i++)+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.house_type_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.house_no+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.street_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.block_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.zone_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+formatDollar(val.cost_usage)+'</td>';
                divString += '</tr>';
            });
            div.append(divString);
        }
        diplayPrint();
    }
    function generateMainPrint(response) {
        if (response) {
            var div = $('.invoice-table-main');
            $('.invoice-table2').css('display','none');
            $('.invoice-table1').css('display','table');
            $('.invoice-table1').css('margin-top','170px');
            $('.invoice-table').css('display','none');
            div.empty();
			var divString   = '';
            var i= 1;
            $.each(response,function(key,val){
                divString += '<tr>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+(i++)+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.total_qty+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.unit+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+formatDollar(val.total_cost_usage)+'</td>';
                divString += '</tr>';
            });
            div.append(divString);
        }
        diplayPrint();
    }
    function generateDetailPrint(response) {
        if (response) {
            var div = $('.invoice-table-main');
            $('.invoice-table2').css('display','table');
            $('.invoice-table1').css('display','none');
            $('.invoice-table').css('display','none');
            $('.invoice-table2').css('margin-top','170px');            
            div.empty();
			var divString   = '';
            $.each(response,function(key,val){
                divString += '<tr>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.trans_date+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.reference+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.engineer_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.subconstructor_name+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.street+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.qty+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+val.unit+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+formatDollar(val.cost_usage)+'</td>';
                    divString += '<td style="text-align:center !important;" class="black-all">'+formatDollar(val.total_cost_usage)+'</td>';
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
		var value_id = $(argument).attr('id');
		if (version=='print') {
			$.ajax({
				url:'<?php echo url("/report/generate_usageHouse").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}
        else if(version=='excel'){
			window.location.href="<?php echo url("/report/generate_usageItem");?>/'+value_id+'<?php echo $param; ?>&version="+version;
		}
        else if(version=='printMain'){            
			$.ajax({
				url:'<?php echo url("/report/generate_usageItem");?>/'+value_id+'<?php echo $param; ?>&version='+version,
				type:'GET',
				success:function(response){
					generateMainPrint(response);
				}
			});
		}
        else if(version=='excelMain'){
            console.log(argument);
			window.location.href='<?php echo url("/report/generate_usageItem");?>/'+value_id+'<?php echo $param; ?>&version='+version;
		}
        else if(version=='printDetial'){
			$.ajax({
				url:'<?php echo url("/report/generate_usageHouseDetail");?>/'+value_id+'<?php echo $param; ?>&version='+version,
				type:'GET',
				success:function(response){
					generateDetailPrint(response);
				}
			});
		}
        else if(version=='excelDetail'){
			window.location.href='<?php echo url("/report/generate_usageHouseDetail");?>/'+value_id+'<?php echo $param; ?>&version='+version;
		}
	}
    initDateRange = function(){
        $('#block_id,#street_id,#house_id').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});
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

        // $('#sub_usage').select2('val','{{$sub_usage}}');
        // $('#warehouse_id').select2('val',<?php //echo json_encode($warehouseArray);?>);
        // $('#eng_usage').select2('val','{{$eng_usage}}');
        $('#block_id').select2('val','{{$block_id}}');
        $('#street_id').select2('val','{{$street_id}}');
        $('#house_id').select2('val',<?php echo json_encode($houseArray);?>);
        // $.fn.select2.defaults.set('theme','classic');
    }
    nitDatatable = function(){
        var table = $('#my-table').DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
            processing: true,
            serverSide: true,
            ajax: '<?php echo url("/report/generate_usageHouse").$param;?>&version=datatables&group_by=1',
            columns: [
                {className: 'details-control',orderable: false,searchable: false,data: null,defaultContent: ''},
                {data: 'rownum', name:'rownum'},
                {data: 'house_type_name', name:'house_type_name'},
                {data: 'house_no', name:'house_no'},
                {data: 'street_name', name:'street_name'},
                {data: 'block_name', name:'block_name'},
                {data: 'zone_name', name:'zone_name'},
                {data: 'cost_usage', name:'cost_usage'},
                {data: 'action', name:'action'}
            ],'search':{'regex':true},order:[1,'asc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                $('td:eq(7)',nRow).addClass('text-center');
                $('td:eq(7)',nRow).html(formatDollar(aData['cost_usage']));
            }
        });        
        $('#my-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'main-' + row.data().id;
            if(row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                objName = [];
            }else{
                row.child(format_main(row.data())).show();
                initTableMain(tableId,row.data());
                $('#' + tableId+'_wrapper').attr('style','width: 99%;');
                tr.addClass('shown');
            }
        });
    }
    format_main = function(d) {
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="main-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
                    str += '<th style="width: 3%;"></th>';
                    str += '<th style="width: 10%;">{{trans("lang.item_code")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.item_name")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.units")}}</th>';
                    // str += '<th style="width: 10%;">{{trans("lang.cost")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.total")}}</th>';
                    str += '<th style="width: 5%;">{{trans("lang.action")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }
    
	initTableMain = function(tableId, data) {
		var table = $('#' + tableId).DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url + "<?= $param ?>&version=datatables",
			columns: [
                {className: 'tdetails-control',orderable: false,searchable: false,data: null,defaultContent: ''},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'total_qty', name:'total_qty'},
				{data: 'unit', name:'unit'},
				// {data: 'cost_usage', name:'cost_usage'},
				{data: 'total_cost_usage', name:'total_cost_usage'},
				{data: 'action', name:'action'},
			],'search':{'regex':true},order:[1,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                // $('td:eq(5)',nRow).html(formatDollar(aData['cost_usage']));
                $('td:eq(5)',nRow).html(formatDollar(aData['total_cost_usage']));
            }
		});
        
        $('#' + tableId+' tbody').on('click', 'td.tdetails-control', function () {
            
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableSubId = 'sub-' + plushs++;
            console.log(tableSubId);
            if(row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                objName = [];
            }else{
                row.child(format(row.data(),plushs)).show();
                initTable(tableSubId,row.data());
                $('#' + tableSubId+'_wrapper').attr('style','width: 99%;');
                tr.addClass('shown');
            }
        });
	}
    format = function(d,p) {
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="sub-'+(p-1)+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 15%;">{{trans("lang.trans_date")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.reference_no")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.reference")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.engineer")}}</th>';
                    str += '<th style="width: 5%;">{{trans("lang.constructor")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.warehouse")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.street")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.item_code")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.item_name")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.units")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.cost")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.total")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }
	initTable = function(tableId, data) {
		$('#' + tableId).DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url + "<?= $param ?>&version=datatables",
			columns: [
				{data: 'trans_date', name:'trans_date'},
				{data: 'ref_no', name:'ref_no'},
				{data: 'reference', name:'reference'},
                {data: 'engineer_name', name:'engineer_name'},
                {data: 'subconstructor_name', name:'subconstructor_name'},
				{data: 'warehouse', name:'warehouse'},
				{data: 'street', name:'street'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'qty', name:'qty'},
				{data: 'unit', name:'unit'},
				{data: 'cost_usage', name:'cost_usage'},
				{data: 'total_cost_usage', name:'total_cost_usage'},
			],'search':{'regex':true},order:[0,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                $('td:eq(0)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
                $('td:eq(3)',nRow).html(aData['engineer_code']+" - "+aData['engineer_name']);
                $('td:eq(4)',nRow).html(aData['subconstructor_code']+" - "+aData['subconstructor_name']);
                $('td:eq(11)',nRow).html(formatDollar(aData['cost_usage']));
                $('td:eq(12)',nRow).html(formatDollar(aData['total_cost_usage']));
                // $('td:eq(7)',nRow).html(aData['item_name']+" - "+aData['item_code']);
            }
		});
	}
	$(document).ready(function(){
        initDateRange();
        nitDatatable();
	});
</script>
@endsection()
