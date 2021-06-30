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
	$orderArray     = [];
	$supArray       = [];
	$order_id       = '';
	$sup_id         = '';
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

    if (Request::input('order_id')) {
        $order_id = '';
        foreach (Request::input('order_id') as $jkey => $jv) {
            $order_id.=','.$_POST['order_id'][$jkey];
            $orderArray[$jkey] = $_POST['order_id'][$jkey];
        }
        $param.='&order_id='.$order_id;
    }else{
        $param.='&order_id='.$order_id;
    }

    if (Request::input('sup_id')) {
        $sup_id = '';
        foreach (Request::input('sup_id') as $jkey => $jv) {
            $sup_id.=','.$_POST['sup_id'][$jkey];
            $supArray[$jkey] = $_POST['sup_id'][$jkey];
        }
        $param.='&sup_id='.$sup_id;
    }else{
        $param.='&sup_id='.$sup_id;
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
	                                <div class="col-md-3">
	                                    <label class="control-label bold">{{trans('lang.created_at')}}</label>
	                                    <div id="report_date" class="btn btn-info" style="width: 100%;">
	                                        <i class="fa fa-calendar"></i> &nbsp;
	                                        <span> </span>
	                                        <b class="fa fa-angle-down"></b>
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <label for="order_id" class="control-label bold">{{trans('rep.order_code')}}</label>
	                                    <select class="form-control" id="order_id" name="order_id[]" multiple></select>
	                                </div>
	                                <div class="col-md-3">
	                                    <label for="sup_id" class="control-label bold">{{trans('lang.supplier')}}</label>
	                                    <select class="form-control" id="sup_id" name="sup_id[]" multiple>
	                                        {{getSuppliers()}}
	                                    </select>
	                                </div>
	                                <div class="col-md-3">
	                                    <label for="warehouse_id" class="control-label bold">{{trans('lang.warehouse')}}</label>
	                                    <select class="form-control" id="warehouse_id" name="warehouse_id[]" multiple>
	                                        {{getWarehouse()}}
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
							<th width="3%" class="all"></th>
							<th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
							<th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
							<th width="10%" class="all">{{ trans('rep.request_code') }}</th>
							<th width="10%" class="all">{{ trans('lang.supplier') }}</th>
							<th width="10%" class="all">{{ trans('lang.warehouse') }}</th>
							<th width="10%" class="all">{{ trans('lang.note') }}</th>
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
						<th width="10%" class="all">{{ trans('rep.order_code') }}</th>
						<th width="10%" class="all">{{ trans('lang.supplier') }}</th>
						<th width="10%" class="all">{{ trans('lang.warehouse') }}</th>
						<th width="10%" class="all">{{ trans('lang.note') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-tbody"></tbody>
            </table>
        </div>
    </div>
    @include('reports.footer')
</div>
<!-- Modal Varian -->
@endsection()

@section('javascript')
<script type="text/javascript">

	var order_obj = JSON.parse(convertQuot('{{\App\Model\Order::select(['id','ref_no','trans_status'])->where('trans_status','!=',0)->get()}}'));

	function generatePrint(response) {
        if (response) {
            var div = $('.invoice-table-tbody');
            div.empty();
			var divString   = '';
			var project     = [];
			var request_obj = [];

            $.each(response,function(key,val){
            	project[val.pro_id] = new Array({'pro_id':val.pro_id});
            });

            $.each(response,function(key,val){
            	request_obj[val.id] = val;
            });

            $.each(request_obj,function(k,v){
            	if (v) {
            		divString += '<tr style="background: #03A9F4 !important;">';
	                divString += '<td style="text-align:center !important;" class="black-all">'+formatDate(v.trans_date)+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.ref_no+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.po_no+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.supplier+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.warehouse+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+(v.note!=null ? v.note : '')+'</td>';
		            divString += '</tr>';
	                divString += '<tr style="background:#CDDC39;border:1px solid #CDDC39 !important;">';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.line_no")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.item_code")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.item_name")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.qty")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("rep.return_qty")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.units")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.price")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.amount")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.discount")}}(%)</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.discount")}}($)</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.total")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.desc")}}</td>';
	                divString += '</tr>';
            		$.each(response.filter(a=>a.id==v.id),function(key,val){
		                divString += '<tr style="background: #fff !important;">';
		                divString += '<td style="text-align:center !important;" class="black-all">'+(key+1)+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.item_code+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.item_name+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.qty)+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.return_qty)+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.unit+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.price)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.amount)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.disc_perc)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.disc_usd)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.total)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.desc+'</td>';
		                divString += '</tr>';
		            });
            	}
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
				url:'<?php echo url("/report/generate_delivery").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/generate_delivery").$param;?>&version="+version;
		}
	}

	function format (d) {
        var str = '';
        str += '<table class="table table-striped details-table table-responsive"  id="posts-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
                    str += '<th class="text-center" style="width: 3%;">{{trans("lang.line_no")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.item_code")}}</th>';
                    str += '<th class="text-center" style="width: 17%;">{{trans("lang.item_name")}}</th>';
                    str += '<th class="text-center">{{trans("lang.qty")}}</th>';
                    str += '<th class="text-center">{{trans("rep.return_qty")}}</th>';
                    str += '<th class="text-center">{{trans("lang.units")}}</th>';
                    str += '<th class="text-center">{{trans("lang.price")}}</th>';
                    str += '<th class="text-center">{{trans("lang.amount")}}</th>';
                    str += '<th class="text-center">{{trans("lang.discount")}}(%)</th>';
                    str += '<th class="text-center">{{trans("lang.discount")}}($)</th>';
                    str += '<th class="text-center">{{trans("lang.total")}}</th>';
                    str += '<th class="text-center">{{trans("lang.desc")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

	$(document).ready(function(){

		// $.fn.select2.defaults.set('theme','classic');
        $('#order_id,#warehouse_id,#sup_id').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

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

        $('#order_id').select2('val',<?php echo json_encode($orderArray);?>);
        $('#warehouse_id').select2('val',<?php echo json_encode($warehouseArray);?>);
        $('#sup_id').select2('val',<?php echo json_encode($supArray);?>);

		var table = $('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/generate_delivery").$param;?>&version=datatables&group_by=1',
			columns: [
				{className:'details-control', orderable:false,searchable:false,data:null,defaultContent:''},
				{data: 'trans_date', name:'trans_date'},
				{data: 'ref_no', name:'ref_no'},
				{data: 'po_no', name:'po_no'},
				{data: 'supplier', name:'supplier'},
				{data: 'warehouse', name:'warehouse'},
				{data: 'note', name:'note'}
			],order:[2,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
				var trans_status = '';
				$('td:eq(1)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
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

        function initTable(tableId, data) {
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                info:false,
                filter:false,
                paging:false,
                ajax: '<?php echo url("/report/generate_delivery").$param;?>&version=datatables&del_id='+data.id,
                columns: [
                    { data: 'id', name: 'id'}, // 0
                    { data: 'item_code', name: 'item_code' },// 1
                    { data: 'item_name', name: 'item_name' },// 2
                    { data: 'qty', name: 'qty' },// 3
                    { data: 'return_qty', name: 'return_qty' },// 4
                    { data: 'unit', name: 'unit' },// 5
                    { data: 'price', name: 'price' },// 6
                    { data: 'amount', name: 'amount' },// 7
                    { data: 'disc_perc', name: 'disc_perc' },// 8
                    { data: 'disc_usd', name: 'disc_usd' },// 9
                    { data: 'total', name: 'total' },// 10
                    { data: 'desc', name: 'desc' }// 11
                ],order:[0,'asc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                    $('td:eq(3)',nRow).html(parseFloat(aData['qty'])).addClass('text-right');
                    $('td:eq(4)',nRow).html(parseFloat(aData['return_qty'])).addClass('text-right');
                    $('td:eq(5)',nRow).html(aData['unit']).addClass('text-center');
                    $('td:eq(6)',nRow).html(parseFloat(aData['price'])).addClass('text-right');
                    $('td:eq(7)',nRow).html(parseFloat(aData['amount'])).addClass('text-right');
                    $('td:eq(8)',nRow).html(parseFloat(aData['disc_perc'])).addClass('text-right');
                    $('td:eq(9)',nRow).html(parseFloat(aData['disc_usd'])).addClass('text-right');
                    $('td:eq(10)',nRow).html(parseFloat(aData['total'])).addClass('text-right');
                    $('td:eq(0)',nRow).html(iDataIndex+1).addClass('text-center');
                }
            });
        }
	});
</script>
@endsection()