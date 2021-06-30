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
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d');
    $warehouse_id = 0;
    $eng_usage = 0;
    $sub_usage = 0;
    $zone_id = 0;
    $block_id = 0;
    $street_id = 0;
    $house_type = 0;
    $house_id = 0;
    $item_type = 0;
    $item_id = 0;
    $param = '?v=1';
    $start = 0;

    if (Request::input('start_date')) {
        $start_date = Request::input('start_date');
        $param.='&start_date='.$start_date;
    }else{
        $param.='&start_date='.$start_date;
    }

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.='&end_date='.$end_date;
    }else{
        $param.='&end_date='.$end_date;
    }

    if (Request::input('warehouse_id')) {
        $warehouse_id = Request::input('warehouse_id');
        $param.='&warehouse_id='.$warehouse_id;
    }

    if (Request::input('eng_usage')) {
        $eng_usage = Request::input('eng_usage');
        $param.='&eng_usage='.$eng_usage;
    }

    if (Request::input('sub_usage')) {
        $sub_usage = Request::input('sub_usage');
        $param.='&sub_usage='.$sub_usage;
    }

    if (Request::input('zone_id')) {
        $zone_id = Request::input('zone_id');
        $param.='&zone_id='.$zone_id;
    }

    if (Request::input('block_id')) {
        $block_id = Request::input('block_id');
        $param.='&block_id='.$block_id;
    }

    if (Request::input('street_id')) {
        $street_id = Request::input('street_id');
        $param.='&street_id='.$street_id;
    }

    if (Request::input('house_type')) {
        $house_type = Request::input('house_type');
        $param.='&house_type='.$house_type;
    }

    if (Request::input('house_id')) {
        $house_id = Request::input('house_id');
        $param.='&house_id='.$house_id;
    }

    if (Request::input('item_type')) {
        $item_type = Request::input('item_type');
        $param.='&item_type='.$item_type;
    }

    if (Request::input('item_id')) {
        $item_id = Request::input('item_id');
        $param.='&item_id='.$item_id;
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
				<!-- Form -->
                <form method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <!-- Date Range -->
                        <div class="col-md-4">
                            <input type="hidden" value="{{$start_date}}" name="start_date" id="start_date">
                            <input type="hidden" value="{{$end_date}}" name="end_date" id="end_date">
                            <label class="control-label bold">{{trans('lang.date')}}</label>
                            <div id="report_date" class="btn btn-info" style="width: 100%;">
                                <i class="fa fa-calendar"></i> &nbsp;
                                <span> </span>
                                <b class="fa fa-angle-down"></b>
                            </div>
                        </div>
                        <!-- Warehouse -->
                        <div class="col-md-4">
                            <label for="warehouse_id" class="control-label bold">{{trans('lang.warehouse')}}</label>
                            <select class="form-control select2" id="warehouse_id" name="warehouse_id">
                                <option></option>
                            </select>
                        </div>
                        <!-- Engineer -->
                        <div class="col-md-4">
                            <label for="eng_usage" class="control-label bold">{{trans('lang.engineer')}}</label>
                            <select class="form-control select2" id="eng_usage" name="eng_usage">
                            <option></option>
                            </select>
                        </div>
                        <!-- Subcontractor -->
                        <div class="col-md-4">
                            <label for="sub_usage" class="control-label bold">{{trans('rep.subconstructor')}}</label>
                            <select class="form-control select2" id="sub_usage" name="sub_usage">
                            <option></option>
                            </select>
                        </div>
                        <!-- Zone -->
                        @if(getSetting()->allow_zone == 1)
                        <div class="col-md-4">
                            <label for="zone_id" class="control-label bold">{{trans('lang.zone')}}</label>
                            <select class="form-control select2" id="zone_id" name="zone_id">
                                <option></option>
                            </select>
                        </div>
                        @endif
                        <!-- Block -->
                        @if(getSetting()->allow_block == 1)
                        <div class="col-md-4">
                            <label for="block_id" class="control-label bold">{{trans('lang.block')}}</label>
                            <select class="form-control select2" id="block_id" name="block_id">
                                <option></option>
                            </select>
                        </div>
                        @endif
                        <!-- Street -->
                        <div class="col-md-4">
                            <label for="street_id" class="control-label bold">{{trans('lang.street')}}</label>
                            <select class="form-control select2" id="street_id" name="street_id">
                                <option></option>
                            </select>
                        </div>
                        <!-- House Type-->
                        <div class="col-md-4">
                            <label for="house_type" class="control-label bold">{{trans('lang.house_type')}}</label>
                            <select class="form-control select2" id="house_type" name="house_type">
                                <option></option>
                            </select>
                        </div>
                        <!-- House -->
                        <div class="col-md-4">
                            <label for="house_id" class="control-label bold">{{trans('lang.house')}}</label>
                            <select class="form-control select2" id="house_id" name="house_id">
                                <option></option>
                            </select>
                        </div>
                        <!-- Item Type -->
                        <div class="col-md-4">
                            <label for="item_type" class="control-label bold">{{trans('lang.category')}}</label>
                            <select class="form-control select2" id="item_type" name="item_type">
                                <option></option>
                            </select>
                        </div>
                        <!-- Item -->
                        <div class="col-md-4">
                            <label for="item_id" class="control-label bold">{{trans('lang.product')}}</label>
                            <select class="form-control select2" id="item_id" name="item_id">
                                <option></option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button type="submit" id="submit" name="submit" value="submit"  class="btn blue bold">{{trans('lang.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
                            <th width="3%" class="all"></th>
							<th width="5%" class="all">{{ trans('lang.trans_date') }}</th>
							<th width="5%" class="all">{{ trans('lang.street') }}</th>
							<th width="5%" class="all">{{ trans('lang.house') }}</th>
                            <th width="15%" class="all">{{ trans('lang.reference_no') }}</th>
							<th width="10%" class="all">{{ trans('lang.item_type') }}</th>
							<th width="15%" class="all">{{ trans('lang.item_code') }}</th>
							<th width="15%" class="all">{{ trans('lang.item_name') }}</th>
                            <!-- <th width="5%" class="all">{{ trans('lang.qty') }}</th> -->
                            <th width="5%" class="all">{{ trans('lang.units') }}</th>
                            <!-- <th width="7%" class="all">{{ trans('lang.asset_value') }}</th> -->
                            <th width="5%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Varian -->
@endsection()

@section('javascript')
<script type="text/javascript">
	onPrint = function(argument) {
		var version = $(argument).attr('version');
		if (version=='print') {
            var mywindow = window.open("<?php echo url("/report/usage-costing-data").$param;?>&version="+version, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
            setInterval(function(){ 
                mywindow.print();
                mywindow.close();
            }, 5000);
		}else if(version=='excel'){
			window.location.href="<?php echo url("/report/usage-costing-data").$param;?>&version="+version;
		}
	}

    onDetailPrint = function(argument) {
        var url = $(argument).attr('route');
		var mywindow = window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
        setInterval(function(){ 
            mywindow.print();
            mywindow.close();
        }, 3000);
	}

    initDateRange = function(){
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
    }

    initDatatable = function(){
        var table = $('#my-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/usage-costing-data").$param;?>&version=datatables&group_by=1',
			columns: [
                {className: 'details-control',orderable: false,searchable: false,data: null,defaultContent: ''},
				{data: 'trans_date', name:'trans_date'},
                {data: 'street', name:'street'},
				{data: 'house_no', name:'house_no'},
                {data: 'ref_no', name:'ref_no'},
				{data: 'item_type', name:'item_type'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
                // {data: 'qty', name:'qty'},
                {data: 'unit', name:'unit'},
                // {data: 'amount', name:'amount'},
                {data: 'action', name:'action',orderable: false,}
			],
            'search':{'regex':true},
            order:[1,'desc'],
            fnCreatedRow:function(nRow,aData,iDataIndex){
              $('td:eq(8)',nRow).addClass('text-center');
            //   $('td:eq(8)',nRow).html(formatNumber(aData['qty'])).addClass('text-right');
            //   $('td:eq(9)',nRow).html(aData['unit']).addClass('text-center');
            //   $('td:eq(10)',nRow).html(formatDollar(aData['amount'])).addClass('text-right');
              
			}
		});

        $('#my-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'sub-' + row.data().use_id;
            if(row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                objName = [];
            }else{
                row.child(format(row.data())).show();
                initTable(tableId,row.data());
                $('#' + tableId+'_wrapper').attr('style','width: 99%;');
                tr.addClass('shown');
            }
        });
    }

    format = function(d) {
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.use_id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 15%;">{{trans("lang.type")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.name")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.num")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 5%;">{{trans("lang.unit")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.cost")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.asset_value")}}</th>';
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
				{ data: 'ref_type', name: 'ref_type',orderable: false },
				{ data: 'ref_no', name: 'ref_no' },
				{ data: 'id', name: 'id' },
				{ data: 'qty', name: 'qty' },
                { data: 'unit', name: 'unit' },
                { data: 'cost', name: 'cost' },
                { data: 'amount', name: 'amount' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
                $('td:eq(3)',nRow).html(formatNumber(aData['qty']));
                $('td:eq(5)',nRow).html(formatDollar(aData['cost']));
                $('td:eq(6)',nRow).html(formatDollar(aData['amount']));
			}
		});
	}

    // Warehouse
    getWarehouses = function(success,complete){
        $.ajax({
            url:"{{url('repository/getWarehouses')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getWarehouses_success = function(response){
        $("#warehouse_id").empty();
		$("#warehouse_id").select2('val', null);
        $("#warehouse_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#warehouse_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getWarehouses_complete = function(response){
        $("#warehouse_id").select2('val', '{{$warehouse_id}}');
    }

    // Engineer
    getEngineers = function(success,complete){
        $.ajax({
            url:"{{url('repository/getEngineers')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getEngineers_success = function(response){
        $("#eng_usage").empty();
		$("#eng_usage").select2('val', null);
        $("#eng_usage").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#eng_usage").append($('<option></option>').val(val.id).text(val.id_card + ' | ' + val.name));
        });
    }
    getEngineers_complete = function(response){
        $("#eng_usage").select2('val', '{{$eng_usage}}');
    }
    // subcontractors
    getSubcontractors = function(success,complete){
        $.ajax({
            url:"{{url('repository/getSubcontractors')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getSubcontractors_success = function(response){
        $("#sub_usage").empty();
		$("#sub_usage").select2('val', null);
        $("#sub_usage").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#sub_usage").append($('<option></option>').val(val.id).text(val.id_card + ' | ' + val.name));
        });
    }
    getSubcontractors_complete = function(response){
        $("#sub_usage").select2('val', '{{$sub_usage}}');
    }
    // Zone
    getZones = function(success,complete){
        $.ajax({
            url:"{{url('repository/getZones')}}",
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getZones_success = function(response){
        $("#zone_id").empty();
		$("#zone_id").select2('val', null);
        $("#zone_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#zone_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getZones_complete = function(response){
        $("#zone_id").select2('val', '{{$zone_id}}');
    }
    // Block
    getBlocks = function(success,complete){
        $.ajax({
            url:"{{url('repository/getBlocks')}}",
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getBlocks_success = function(response){
        $("#block_id").empty();
		$("#block_id").select2('val', null);
        $("#block_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#block_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getBlocks_complete = function(response){
        $("#block_id").select2('val', '{{$block_id}}');
    }
    // Street
    getStreets = function(success,complete){
        $.ajax({
            url:"{{url('repository/getStreets')}}",
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getStreets_success = function(response){
        $("#street_id").empty();
		$("#street_id").select2('val', null);
        $("#street_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#street_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getStreets_complete = function(response){
        $("#street_id").select2('val', '{{$street_id}}');
    }
    // Housetype
    getHouseTypes = function(success,complete){
        $.ajax({
            url:"{{url('repository/getHouseTypes')}}",
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getHouseTypes_success = function(response){
        $("#house_type").empty();
		$("#house_type").select2('val', null);
        $("#house_type").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#house_type").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getHouseTypes_complete = function(response){
        $("#house_type").select2('val', '{{$house_type}}');
    }
    // House
    getHousesByZoneID = function(zoneID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByZoneID')}}" + '/' + zoneID,
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getHousesByBlockID = function(blockID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByBlockID')}}" + '/' + blockID,
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getHousesByStreetID = function(streetID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByStreetID')}}" + '/' + streetID,
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getHousesByHouseType = function(houseType,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByHouseType')}}" + '/' + houseType,
            type:'GET',
            success: success,
            complete: complete
        }); 
    }
    getHousesByHouseType_success = function(response){
        $("#house_id").empty();
		$("#house_id").select2('val', null);
        $("#house_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#house_id").append($('<option></option>').val(val.id).text(val.house_no));
        });
    }
    getHousesByHouseType_complete = function(response){
        $("#house_id").select2('val', '{{$house_id}}');
    }
    // Item Type
    getProductTypes = function(success,complete){
        $.ajax({
            url:"{{url('repository/getProductTypes')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getProductTypes_success = function(response){
        $("#item_type").empty();
		$("#item_type").select2('val', null);
        $("#item_type").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#item_type").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getProductTypes_complete = function(response){
        $("#item_type").select2('val', '{{$item_type}}');
    }
    // item
    getProductsByProductType = function(productType,success,complete){
        $.ajax({
            url:"{{url('repository/getProductsByProductType')}}" + '/' + productType,
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getProductsByProductType_success = function(response){
        $("#item_id").empty();
		$("#item_id").select2('val', null);
        $("#item_id").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $("#item_id").append($('<option></option>').val(val.id).text(val.name + '(' + val.code + ')'));
        });
    }
    getProductsByProductType_complete = function(response){
        $("#item_id").select2('val', '{{$item_id}}');
    }

	$(document).ready(function(){
        $('.select2').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});
        initDateRange();
        initDatatable();
        getWarehouses(getWarehouses_success,getWarehouses_complete);
        getEngineers(getEngineers_success,getEngineers_complete);
        getSubcontractors(getSubcontractors_success,getSubcontractors_complete);
        if('{{getSetting()->allow_zone}}' == 1){
            getZones(getZones_success,getZones_complete);
        }
        if('{{getSetting()->allow_block}}' == 1){
            getBlocks(getBlocks_success,getBlocks_complete);
        }
        getStreets(getStreets_success,getStreets_complete);
        getHouseTypes(getHouseTypes_success,getHouseTypes_complete);
        getProductTypes(getProductTypes_success,getProductTypes_complete);
        $('#zone_id').on('change',function(){
            var zoneID = $(this).val();
            if(zoneID){
                getHousesByZoneID(zoneID,getHousesByHouseType_success,getHousesByHouseType_complete);
            }
        });
        $('#block_id').on('change',function(){
            var blockID = $(this).val();
            if(blockID){
                getHousesByBlockID(blockID,getHousesByHouseType_success,getHousesByHouseType_complete);
            }
        });
        $('#street_id').on('change',function(){
            var streetID = $(this).val();
            if(streetID){
                getHousesByStreetID(streetID,getHousesByHouseType_success,getHousesByHouseType_complete);
            }
        });
        $('#house_type').on('change',function(){
            var houseType = $(this).val();
            if(houseType){
                getHousesByHouseType(houseType,getHousesByHouseType_success,getHousesByHouseType_complete);
            }
        });
        $('#item_type').on('change',function(){
            var itemType = $(this).val();
            if(itemType){
                getProductsByProductType(itemType,getProductsByProductType_success,getProductsByProductType_complete);
            }
        });
	});
</script>
@endsection()
