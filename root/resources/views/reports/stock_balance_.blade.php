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
	</style>
@endsection

@section('content')
<?php 
    $start_date     = '';
    $end_date       = '';
    $warehouseArray = [];
    $warehouse_id   = '';
    $param          = '?v=1';
    $start          = 0;
    $hideZero       = 0;
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

    if (Request::input('warehouse_id')) {
        $warehouse_id = '';
        foreach (Request::input('warehouse_id') as $jkey => $jv) {
            $warehouse_id.=','.$_POST['warehouse_id'][$jkey];
            $warehouseArray[$jkey] = $_POST['warehouse_id'][$jkey];
        }
        $param.='&warehouse_id='.$warehouse_id;
    }else{
        $param.='&warehouse_id='.$warehouse_id;
    }

    if (Request::input('hideZero')) {
        $hideZero = Request::input('hideZero');
        $param.='&hideZero='.$hideZero;
    }else{
        $param.='&hideZero='.$hideZero;
    }
?>
<link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/icheck/skins/all.css')}}">
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
                                        <label for="warehouse_id" class="control-label bold">{{trans('lang.warehouse')}}</label>
                                        <select class="form-control" id="warehouse_id" name="warehouse_id[]">
                                            <option></option>
                                            {{getWarehouse()}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label bold">{{trans('rep.other')}} </label>
                                        <div class="input-group">
                                            <div class="icheck-list">
                                                <label>
                                                    <input type="radio" name="hideZero" value="0" checked id="hideZero1" class="hideZero">{{trans('rep.show_zero')}}
                                                </label>
                                                <label>
                                                    <input type="radio" name="hideZero" value="1" checked id="hideZero2" class="hideZero">{{trans('rep.hide_zero')}}
                                                </label>
                                            </div>
                                        </div>
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
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
                            <th width="3%" class="all"></th>
                            <th width="10%" class="all">{{ trans('lang.warehouse') }}</th>
							<th width="10%" class="all">{{ trans('lang.item_type') }}</th>
                            <th width="10%" class="all">{{ trans('lang.item_code') }}</th>
                            <th width="42%" class="all">{{ trans('lang.item_name') }}</th>
                            <th width="10%" class="all">{{ trans('lang.qty') }}</th>
                            <th width="10%" class="all">{{ trans('lang.units') }}</th>
                            <th width="5%" class="all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="detail_" style="display: none;">
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
                        <th colspan="2" width="20%" class="all">{{ trans('lang.warehouse') }}</th>
                        <th width="20%" class="all">{{ trans('lang.item_type') }}</th>
                        <th width="10%" class="all">{{ trans('lang.item_code') }}</th>
                        <th colspan="2" width="20%" class="all">{{ trans('lang.item_name') }}</th>
                        <th width="10%" class="all">{{ trans('lang.qty') }}</th>
                        <th width="10%" class="all">{{ trans('lang.units') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-tbody-detail"></tbody>
            </table>
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
                        <th width="5%" class="all">{{ trans('lang.line_no') }}</th>
                        <th width="10%" class="all">{{ trans('lang.warehouse') }}</th>
                        <th width="10%" class="all">{{ trans('lang.item_type') }}</th>
                        <th width="10%" class="all">{{ trans('lang.item_code') }}</th>
                        <th width="45%" class="all">{{ trans('lang.item_name') }}</th>
                        <th width="10%" class="all">{{ trans('lang.qty') }}</th>
                        <th width="10%" class="all">{{ trans('lang.units') }}</th>
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
<script type="text/javascript" src="{{url('assets/global/plugins/icheck/icheck.min.js')}}"></script>
<script type="text/javascript">

    var actions_data = [];

    function initHouse(argument,street_id) {
        $(argument).empty();
        $.ajax({
            url:'{{url("/report/getHouse")}}',
            type:'get',
            data:{'house_type':street_id},
            success:function(response){
                if (response.length > 0) {
                    $.each(response,function(key,val){
                        $(argument).append($('<option></option>').val(val.id).text(val.house_no+' - '+val.house_desc));
                    });
                }
            },complete:function(){
            }
        });
    }

    function isSubmit() {
        var isValid    = true;
        var house_type = $("#house_type").val(); 
        if (house_type==null || house_type=='' || house_type==undefined) {
            isValid = false;
            $('#house_type').children().find('.select2-selection .select2-selection--single').css('border','1px solid #f00');
        }else{
            $('#house_type').children().find('.select2-selection .select2-selection--single').css('border','1px solid #ccc');
        }

        return isValid;
    }

    $('.hideZero').on('ifChanged',function(){
        if (this.value==0) {
            $('.hideZero[value=0]').attr('checked','checked');
            $('.hideZero[value=1]').removeAttr('checked');
        }else{
            $('.hideZero[value=1]').attr('checked','checked');
            $('.hideZero[value=0]').removeAttr('checked');
        }
    });

	function generatePrint(response) {
        if (response) {
            var div = $('.invoice-table-tbody');
            div.empty();
            var divString   = '';
            var project     = [];
            var request_obj = [];
            var big_total   = [];
            var house_no    = [];

            $.each(response,function(key,val){
                var total = (parseFloat(val.qty_std) + parseFloat(val.qty_add)) * parseFloat(val.item_price);
                if (big_total[val.item_type_id] > 0) {
                    big_total[val.item_type_id] = parseFloat(big_total[val.item_type_id]) + parseFloat(total);
                }else{
                    big_total[val.item_type_id] = parseFloat(total);
                }
                house_no[val.house_id] = val.house_no;
            	project[val.item_type_id] = {'item_type_id':val.item_type_id,'item_type':val.item_type,'item_type_desc':val.item_type_desc,'big_total':parseFloat(big_total[val.item_type_id])};
            });

            $.each(response,function(key,val){
            	request_obj[val.id] = val;
            });

    		$.each(response,function(key,val){
                divString += '<tr style="background: #fff !important;">';
                divString += '<td style="text-align:center !important;" class="black-all">'+(key+1)+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+val.warehouse+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+val.category+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+val.item_code+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+val.item_name+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.qty)+'</td>';
                divString += '<td style="text-align:center !important;" class="black-all">'+val.unit_stock+'</td>';
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

    function printDetail(obj) {
        var div       = $('.invoice-table-tbody-detail');
        div.empty();
        var divString = '';
        divString += '<tr>';
        divString += '<td colspan="2" style="text-align:center !important;" class="black-all">'+obj.warehouse+'</td>';
        divString += '<td style="text-align:center !important;" class="black-all">'+obj.category+'</td>';
        divString += '<td style="text-align:center !important;" class="black-all">'+obj.item_code+'</td>';
        divString += '<td colspan="2" style="text-align:center !important;" class="black-all">'+obj.item_name+'</td>';
        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(obj.qty)+'</td>';
        divString += '<td style="text-align:center !important;" class="black-all">'+obj.unit_stock+'</td>';
        divString += '</tr>';
        divString += '<tr>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.line_no")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.trans_date")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.reference_no")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.type")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.type")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.created_by")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.qty")}}</td>';
        divString += '<td style="text-align:center;border:1px solid #000 !important;color:#000 !important;">{{trans("lang.units")}}</td>';
        divString += '</tr>';
        $.ajax({
            url:obj.detail_+'<?php echo $param;?>',
            type:'GET',
            dataType:'json',
            async:false,
            success:function(response){
                if (response.data.length > 0) {
                    $.each(response.data,function(key,val){
                        divString += '<tr style="background: #fff !important;">';
                        divString += '<td style="text-align:center !important;" class="black-all">'+(key+1)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+formatDate(val.date_compare)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.ref_no+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.ref_type+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.trans_ref+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.created_by+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.qty)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.unit_stock+'</td>';
                        divString += '</tr>';
                    });
                }
            }
        });
        div.html(divString);
        var strInvioce=$('.detail_').html();
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
				url:'<?php echo url("/report/generate_stock_balance").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/generate_stock_balance").$param;?>&version="+version;
		}
	}

	function format (d) {
        var str = '';
        str += '<table class="table table-striped details-table table-responsive"  id="posts-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
                    str += '<th class="text-center" style="width: 3%;">{{trans("lang.line_no")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.trans_date")}}</th>';
                    str += '<th class="text-center" style="width: 40%;">{{trans("lang.reference_no")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.type")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.type")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.created_by")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th class="text-center" style="width: 7%;">{{trans("lang.units")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

    function isSubmit() {
        var isValid      = true;
        var warehouse_id = $("#warehouse_id").val(); 
        if (warehouse_id==null || warehouse_id=='' || warehouse_id==undefined) {
            isValid = false;
            $('#warehouse_id').children().find('.select2-selection .select2-selection--single').css('border','1px solid #f00');
        }else{
            $('#warehouse_id').children().find('.select2-selection .select2-selection--single').css('border','1px solid #ccc');
        }

        return isValid;
    }

    $("#warehouse_id,#hideZero").on('change',function(){
        if (isSubmit()) {}else{return false;}
    });

    $("#btnSearch").on('click',function(){
        if (isSubmit()) {}else{return false;}
    });


	$(document).ready(function(){

		// $.fn.select2.defaults.set('theme','classic');
        $('#warehouse_id').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

        $('.hideZero').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' 
        });

        if ('{{$hideZero}}'=='0') {
            $('.hideZero[value=0]').attr('checked','checked');
            $('.hideZero[value=1]').removeAttr('checked');
            $('#hideZero1').iCheck('check');
            $('#hideZero2').iCheck('uncheck');
        }else{
            $('.hideZero[value=1]').attr('checked','checked');
            $('.hideZero[value=0]').removeAttr('checked');
            $('#hideZero1').iCheck('uncheck');
            $('#hideZero2').iCheck('check');
        }

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

        $('#warehouse_id').select2('val',<?php echo json_encode($warehouseArray);?>);

		var table = $('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/generate_stock_balance").$param;?>&version=datatables&group_by=1',
			columns: [
                {className:'details-control', orderable:false,searchable:false,data:null,defaultContent:''},
                {data: 'warehouse', name:'warehouse'},
                {data: 'category', name:'category'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'qty', name:'qty'},
                {data: 'unit_stock', name:'unit_stock'},
                {data: 'id', name:'id',className:'actions'}
			],order:[2,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                var button = '<a class="btn btn-success btn-xs"><i class="fa fa-print"></i> {{trans("lang.print")}}</a>';
                $('td:eq(7)',nRow).html(button).addClass("text-center");
			}
		});

		$('#my-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'posts-' + row.data().id;
            if(row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            }else{
                row.child(format(row.data())).show();
                initTable(tableId,row.data());
                tr.addClass('shown');
            }
        });

        $('#my-table tbody').on('click', 'td.actions a', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            actions_data = row.data();
            printDetail(row.data());
        });

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                info:false,
                filter:false,
                paging:false,
                ajax: data.detail_+'<?php echo $param;?>',
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'date_compare', name: 'date_compare' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'ref_type', name: 'ref_type' },
                    { data: 'trans_ref', name: 'trans_ref' },
                    { data: 'created_by', name: 'created_by' },
                    { data: 'qty', name: 'qty' },
                    { data: 'unit_stock', name: 'unit_stock' }
                ],order:[0,'asc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                    $('td:eq(6)',nRow).html(parseFloat(aData['qty'])).addClass('text-center');
                    $('td:eq(1)',nRow).html(formatDate(aData['date_compare'])).addClass('text-center');
                    $('td:eq(0)',nRow).html(iDataIndex+1).addClass('text-center');
                }
            });
        }
	});
</script>
@endsection()