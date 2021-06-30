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
    $start_date       = '';
    $end_date         = '';
    $transaction_type = 0;
    $warehouse_id     = 0;
    $param            = '?v=1';
    $start            = 0;
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

    if (Request::input('transaction_type')) {
        $transaction_type = Request::input('transaction_type');
        $param.='&transaction_type='.$transaction_type;
    }

    if (Request::input('warehouse_id')) {
        $warehouse_id = Request::input('warehouse_id');
        $param.='&warehouse_id='.$warehouse_id;
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
					<!-- <a title="trans('lang.download')" onclick="onPrint(this);" version="excel"  class="btn btn-circle btn-icon-only btn-default">
						<i class="fa fa-file-excel-o"></i>
					</a> -->
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
                                        <select class="form-control" id="warehouse_id" name="warehouse_id">
                                            <option></option>
                                            {{getWarehouse()}}
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="transaction_type" class="control-label bold">{{trans('rep.transaction_type')}}</label>
                                        <select class="form-control" id="transaction_type" name="transaction_type">
                                            <option value="1">Stock Entry</option>
                                            <option value="2">Move In</option>
                                            <option value="3">Move Out</option>
                                            <option value="4">Adjustment</option>
                                            <option value="5">Usage</option>
                                            <option value="6">Return Usage</option>
                                            <option value="7">Delivery</option>
                                            <option value="8">Return Delivery</option>
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
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
                            <th style="width: 5%;" class="all">{{trans('rep.transaction_type')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.trans_date')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.reference_no')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.warehouse')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.item_code')}}</th>
                            <th style="width: 30%;" class="all">{{trans('lang.item_name')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.qty')}}</th>
                            <th style="width: 10%;" class="all">{{trans('lang.units')}}</th>
                            <th style="width: 10%;" class="all">{{trans('rep.created_by')}}</th>
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
            background-color: #0f92b1 !important;
            color: white !important;
            border-top: 1px solid #0f92b1 !important;
            border-bottom: 1px solid #0f92b1 !important;
            border-right: 1px solid #0f92b1 !important;
            border-left: 1px solid #0f92b1 !important;
            padding: 1px !important;
            font-size: 7px !important;
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

    </style>
    <div class="invoice-items">
        <div class="div-table">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th style="width: 10%;" class="all">{{trans('lang.trans_date')}}</th>
                        <th style="width: 10%;" class="all">{{trans('lang.reference_no')}}</th>
                        <th style="width: 10%;" class="all">{{trans('lang.warehouse')}}</th>
                        <th style="width: 10%;" class="all">{{trans('lang.item_code')}}</th>
                        <th style="width: 30%;" class="all">{{trans('lang.item_name')}}</th>
                        <th style="width: 10%;" class="all">{{trans('lang.qty')}}</th>
                        <th style="width: 10%;" class="all">{{trans('lang.units')}}</th>
                        <th style="width: 10%;" class="all">{{trans('rep.created_by')}}</th>
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

    var actions_data = [];

	function generatePrint(response) {
        if (response) {
            var div             = $('.invoice-table-tbody');
            var stock_entry     = [];
            var move_in         = [];
            var move_out        = [];
            var adjustment      = [];
            var usage           = [];
            var return_usage    = [];
            var delivery        = [];
            var return_delivery = [];
            var divString       = '';
            div.empty();
            $.each(response,function(key,val){
                if (val.type_=='Stock Entry') {
                    stock_entry.push(response[key]);
                }else if(val.type_=='Move In'){
                    move_in.push(response[key]);
                }else if(val.type_=='Move Out'){
                    move_out.push(response[key]);
                }else if(val.type_=='Adjustment'){
                    adjustment.push(response[key]);
                }else if(val.type_=='Usage'){
                    usage.push(response[key]);
                }else if(val.type_=='Return Usage'){
                    return_usage.push(response[key]);
                }else if(val.type_=='Delivery'){
                    delivery.push(response[key]);
                }else if(val.type_=='Return Delivery'){
                    return_delivery.push(response[key]);
                }
            });

            if (stock_entry.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Stock Entry</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(stock_entry,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Stock Entry</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (move_in.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Move In</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(move_in,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Move In</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (move_out.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Move Out</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(move_out,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty * -1)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Move Out</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (adjustment.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Adjustment</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(adjustment,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Adjustment</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (usage.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Usage</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(usage,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty * -1)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Usage</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (return_usage.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Return Usage</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(return_usage,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Return Usage</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (delivery.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Delivery</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(delivery,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Delivery</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            if (return_delivery.length > 0) {
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border:1px solid #fff !important;font-weight:bold;">Return Delivery</td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border:1px solid #fff !important;"></td>';
                divString += '</tr>';
                $.each(return_delivery,function(key,val){
                    divString += '<tr style="background:#fff;">';
                    divString += '<td style="text-align:center;">'+formatDate(val.trans_date)+'</td>';
                    divString += '<td style="text-align:center;">'+val.ref_no+'</td>';
                    divString += '<td style="text-align:center;">'+val.warehouse+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_code+'</td>';
                    divString += '<td style="text-align:center;">'+val.item_name+'</td>';
                    divString += '<td style="text-align:center;">'+parseFloat(val.qty * -1)+'</td>';
                    divString += '<td style="text-align:center;">'+val.unit+'</td>';
                    divString += '<td style="text-align:center;">'+val.created_name+'</td>';
                    divString += '</tr>';
                });
                divString += '<tr style="background:#fff;">';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #fff !important;"></td>';
                divString += '<td colspan="2" style="text-align:center;border-bottom:2px solid #fff !important;font-weight:bold;">សរុបសំរាប់ៈ Return Delivery</td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '<td style="text-align:center;border-bottom:2px solid #000 !important;"></td>';
                divString += '</tr>';
            }
            
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
				url:'<?php echo url("/report/generate_all_stock_transaction").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/generate_all_stock_transaction").$param;?>&version="+version;
		}
	}

	$(document).ready(function(){

        $('#warehouse_id,#transaction_type').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

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

        $('#warehouse_id').select2('val',{{$warehouse_id}});
        $('#transaction_type').select2('val',{{$transaction_type}});

		var table = $('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/generate_all_stock_transaction").$param;?>&version=datatables',
			columns: [
                {data: 'type_', name:'type_'},
                {data: 'trans_date', name:'trans_date'},
                {data: 'ref_no', name:'ref_no'},
                {data: 'warehouse', name:'warehouse'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'qty', name:'qty'},
                {data: 'unit', name:'unit'},
                {data: 'created_name', name:'created_name'}
			],order:[0,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                $('td:eq(1)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			}
		});
	});
</script>
@endsection()