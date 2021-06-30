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
    $streetArray    = [];
    $houseArray     = [];
    $eng_usage      = '';
    $sub_usage      = '';
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
					<!-- <a title="{{trans('lang.download')}}" onclick="onPrint(this);" version="excel"  class="btn btn-circle btn-icon-only btn-default">
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
	                                    <label for="eng_usage" class="control-label bold">{{trans('lang.engineer')}}</label>
	                                    <select class="form-control" id="eng_usage" name="eng_usage">
                                         @if(getSetting()->usage_constructor==1)
                                            {{getConstructor([1])}} 
                                         @endif  
                                        </select>
	                                </div>
	                                <div class="col-md-4">
	                                    <label for="sub_usage" class="control-label bold">{{trans('rep.subconstructor')}}</label>
	                                    <select class="form-control" id="sub_usage" name="sub_usage">
	                                        {{getConstructor([2])}}
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
                            <div class="col-md-12">
                                <div class="form-group">
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
                                    <div class="col-md-4">
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
                            <th width="10%" class="all">{{ trans('rep.project') }}</th>
                            <th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
                            <th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
                            <th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
                            <th width="10%" class="all">{{ trans('lang.engineer') }}</th>
                            <th width="10%" class="all">{{ trans('lang.engineer') }}</th>
                            <th width="10%" class="all">{{ trans('rep.subconstructor') }}</th>
                            <th width="10%" class="all">{{ trans('rep.subconstructor') }}</th>
                            <th width="17%" class="all">{{ trans('lang.desc') }}</th>
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
                        <th width="10%" class="all">{{ trans('rep.project') }}</th>
						<th width="10%" class="all">{{ trans('lang.trans_date') }}</th>
                        <th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
						<th width="10%" class="all">{{ trans('lang.reference_no') }}</th>
						<th colspan="2" width="15%" class="all">{{ trans('lang.engineer') }}</th>
						<th colspan="2" width="15%" class="all">{{ trans('rep.subconstructor') }}</th>
						<th colspan="2" width="30%" class="all">{{ trans('lang.desc') }}</th>
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
                    var image = v.photo!=null ? v.photo : 'assets/upload/temps/not-available.jpg';
            		divString += '<tr style="background: #03A9F4 !important;">';
                    divString += '<td style="text-align:center !important;" class="black-all">'+v.project+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+formatDate(v.trans_date)+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.ref_no+'</td>';
	                divString += '<td style="text-align:center !important;" class="black-all">'+v.reference+'</td>';
	                divString += '<td colspan="2" style="text-align:center !important;" class="black-all">'+v.engineer_name+' - '+v.engineer_code+'</td>';
	                divString += '<td colspan="2" style="text-align:center !important;" class="black-all">'+v.subconstructor_name+' - '+v.subconstructor_code+'</td>';
	                divString += '<td colspan="2" style="text-align:center !important;" class="black-all">'+(v.desc!=null ? v.desc : '')+'</td>';
		            divString += '</tr>';
	                divString += '<tr style="background:#CDDC39;border:1px solid #CDDC39 !important;">';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.line_no")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.warehouse")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.street")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.house")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.item_code")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.item_name")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.usage_qty")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.qty")}}</td>';
                    divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.units")}}</td>';
	                divString += '<td style="text-align:center;border:1px solid #CDDC39 !important;color:#000 !important;">{{trans("lang.note")}}</td>';
	                divString += '</tr>';
            		$.each(response.filter(a=>a.id==v.id),function(key,val){
		                divString += '<tr style="background: #fff !important;">';
		                divString += '<td style="text-align:center !important;" class="black-all">'+(key+1)+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.warehouse+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.street+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.house_no+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+val.item_code+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.item_name+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.usage_qty)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+parseFloat(val.qty)+'</td>';
                        divString += '<td style="text-align:center !important;" class="black-all">'+val.unit+'</td>';
		                divString += '<td style="text-align:center !important;" class="black-all">'+(val.note!=null ? val.note : '')+'</td>';
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
				url:'<?php echo url("/report/generate_return_usage").$param;?>&version='+version,
				type:'GET',
				success:function(response){
					generatePrint(response);
				}
			});
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/generate_return_usage").$param;?>&version="+version;
		}
	}

	function format (d) {
        var str = '';
        str += '<table class="table table-striped details-table table-responsive"  id="posts-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
                    str += '<th class="text-center" style="width: 3%;">{{trans("lang.line_no")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.warehouse")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.street")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.house")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.item_code")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.item_name")}}</th>';
                    str += '<th class="text-center" style="width: 10%;">{{trans("lang.stock_qty")}}</th>';
                    str += '<th class="text-center" style="width: 7%;">{{trans("lang.qty")}}</th>';
                    str += '<th class="text-center" style="width: 5%;">{{trans("lang.units")}}</th>';
                    str += '<th class="text-center" style="width: 5%;">{{trans("lang.note")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

	$(document).ready(function(){

		// $.fn.select2.defaults.set('theme','classic');
        $('#eng_usage,#sub_usage,#street_id,#warehouse_id,#house_id').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

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

        $('#sub_usage').select2('val','{{$sub_usage}}');
        $('#warehouse_id').select2('val',<?php echo json_encode($warehouseArray);?>);
        $('#eng_usage').select2('val','{{$eng_usage}}');
        $('#street_id').select2('val','{{$street_id}}');
        $('#house_id').select2('val',<?php echo json_encode($houseArray);?>);

		var table = $('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/generate_return_usage").$param;?>&version=datatables&group_by=1',
			columns: [
				{className:'details-control', orderable:false,searchable:false,data:null,defaultContent:''},
                {data: 'project', name:'project'},
				{data: 'trans_date', name:'trans_date'},
				{data: 'ref_no', name:'ref_no'},
				{data: 'reference', name:'reference'},
                {data: 'engineer_name', name:'engineer_name'},
				{data: 'engineer_code', name:'engineer_code'},
                {data: 'subconstructor_name', name:'subconstructor_name'},
				{data: 'subconstructor_code', name:'subconstructor_code'},
				{data: 'desc', name:'desc'}
			],'search':{'regex':true},order:[2,'desc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                $('td:eq(2)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
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
                ajax: '<?php echo url("/report/generate_return_usage").$param;?>&version=datatables&del_id='+data.id,
                columns: [
                    { data: 'id', name: 'id'},
                    { data: 'warehouse', name: 'warehouse' },
                    { data: 'street', name: 'street' },
                    { data: 'house_no', name: 'house_no' },
                    { data: 'item_code', name: 'item_code' },
                    { data: 'item_name', name: 'item_name' },
                    { data: 'usage_qty', name: 'usage_qty' },
                    { data: 'qty', name: 'qty' },
                    { data: 'unit', name: 'unit' },
                    { data: 'note', name: 'note' }
                ],order:[0,'asc'],fnCreatedRow:function(nRow,aData,iDataIndex){
                    $('td:eq(6)',nRow).html(parseFloat(aData['usage_qty'])).addClass('text-center');
                    $('td:eq(7)',nRow).html(parseFloat(aData['qty'])).addClass('text-center');
                    $('td:eq(0)',nRow).html(iDataIndex+1).addClass('text-center');
                }
            });
        }
	});
</script>
@endsection()