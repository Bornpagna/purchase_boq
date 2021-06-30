@extends('layouts.app')

@section('content')
<style>
    td.details-control {
        background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
        cursor: pointer !important;
    }
    tr.shown td.details-control {
        background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
    }
	.btnAdd{
		cursor: pointer;
	}
	.form-horizontal .form-group {
		margin-left: 0px !important;
		margin-right: 0px !important;
	}
</style>
<!-- Param request combine string -->
<?php
    $end_date = date('Y-m-d');
    $product = 0;
    $warehouse = 0;
    $product_type = 0;
    $param = '?v=1';
    $start = 0;

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.='&end_date='.$end_date;
    }else{
        $end_date = date('Y-m-d');
        $param.='&end_date='.$end_date;
    }

    if (Request::input('product')) {
        $product = Request::input('product');
        $param.='&product='.$product;
    }

    if (Request::input('warehouse')) {
        $warehouse = Request::input('warehouse');
        $param.='&warehouse='.$warehouse;
    }

    if (Request::input('product_type')) {
        $product_type = Request::input('product_type');
        $param.='&product_type='.$product_type;
    }
?>
<!-- Param request combine string -->
<!--------------------------------------------------->
<!-- Content -->
<div class="row">
	<div class="col-ld-12">
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
			<div class="portlet-body form">
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<div class="form-group">
					<div class="col-md-12 ">
						<span class="show-message-error center font-red bold"></span>
					</div>
				</div>
                <input type="hidden" id="on_hand" value="0"/>
				<form method="POST" class="form-horizontal">
					{{csrf_field()}}
					<!-- To Date, Zone, Block, Street, House Type, House -->
                    <div class="row">
                        <!-- From Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label bold">{{trans('lang.date')}}</label>
                                <input type="text" class="form-control date-picker" value="{{$end_date}}" name="end_date" id="end_date">
                            </div>
                        </div>
                        <!-- Warehoue -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="warehouse" class="control-label" style="text-align: left;"><strong>{{trans('lang.warehouse')}}</strong></label>
                                <select class="form-control select2 warehouse" name="warehouse" id="warehouse">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- Product Type -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_type" class="control-label" style="text-align: left;"><strong>{{trans('lang.category')}}</strong></label>
                                <select class="form-control select2 product_type" name="product_type" id="product_type">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- Product -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product" class="control-label" style="text-align: left;"><strong>{{trans('lang.product')}}</strong></label>
                                <select class="form-control select2 product" name="product" id="product">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
					</div>
                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right">
                                <button type="submit" id="submit" name="submit" value="submit"  class="btn blue bold">{{trans('lang.submit')}}</button>
                            </div>
                        </div>
                    </div>
                    <!-- Result Table -->
                    <div class="row">
                        <!-- List of Product -->
                        <div class="col-md-12">
                            <div>
                                <table class="table table-striped table-bordered table-hover" id="data-table">
                                    <thead>
                                        <tr style="font-size:12px;">
                                            <th width="3%" class="all"></th>
                                            <th width="10%" class="text-center all">{{ trans('lang.item_type') }}</th>
                                            <th width="30%" class="text-center all">{{ trans('lang.item_code') }}</th>
                                            <th width="30%" class="text-center all">{{ trans('lang.item_name') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.on_hand') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.unit') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.avg_cost') }}</th>
                                            <th width="5%" class="text-center all">{{ trans('lang.asset_value') }}</th>
                                            <th width="8%" class="text-center all">{{ trans('lang.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center" colspan="9">{{ trans('lang.no_data_available_in_table') }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Content -->
<!--------------------------------------------------->
<!-- Modal Block -->

<!-- End Modal Block -->
<!--------------------------------------------------->
@endsection()
<!--------------------------------------------------->
<!-- Script  -->
@section('javascript')
<script type="text/javascript">
    // Warehouse
    getWarehouses = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getWarehouses')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }
    getWarehouses_onSuccess = function(response){
        $(".warehouse").empty();
		$(".warehouse").select2('val', null);
        $(".warehouse").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".warehouse").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getWarehouses_onError = function(error){
        $(".warehouse").empty();
		$(".warehouse").select2('val', null);
        $(".warehouse").append($('<option></option>').val('').text(''));
    }
    getWarehouses_onComplete = function(response){
        $('.warehouse').select2('val','{{$warehouse}}');
    }
    // Category Response
    getProductTypes = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getProductTypes')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }
    categorySuccess = function(response){
        $(".product_type").empty();
		$(".product_type").select2('val', null);
        $(".product_type").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".product_type").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    categoryError = function(error){
        $(".product_type").empty();
		$(".product_type").select2('val', null);
        $(".product_type").append($('<option></option>').val('').text(''));
    }
    categoryComplete = function(response){
        $('.product_type').select2('val','{{$product_type}}');
    }
    // Product Response
    getProductsByProductType = function(productType,success,error,complete){
        $.ajax({
            url:"{{url('repository/getProductsByProductType')}}" + '/' + productType,
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }
    productSuccess = function(response){
        $(".product").empty();
		$(".product").select2('val', null);
        $(".product").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".product").append($('<option></option>').val(val.id).text(val.name + '(' + val.code + ')'));
        });
    }
    productError = function(error){
        $(".product").empty();
		$(".product").select2('val', null);
        $(".product").append($('<option></option>').val('').text(''));
    }
    productComplete = function(response){
        $('.product').select2('val','{{$product}}');
    }

    initDataTable = function(){
        // Initialized datatable
        var columns = [];
        columns.push({
				className: 'details-control',
				orderable: false,
				searchable: false,
				data: null,
				defaultContent: ''
			});
        columns.push({data: 'item_type', name:'item_type'});
        columns.push({data: 'code', name:'code'});
        columns.push({data: 'name', name:'name'});
        columns.push({data: 'exact_qty', name:'exact_qty'});
        columns.push({data: 'to_desc', name:'to_desc'});
        columns.push({data: 'cost', name:'cost'});
        columns.push({data: 'asset_value', name:'asset_value'});
        columns.push({data: 'action', name:'action',orderable: false,});
        var table = $('#data-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
            language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			ajax: '<?php echo url("report/inventory/generateInventoryValuationDetail").$param;?>&version=datatables',
			columns: columns,
            'search':{'regex':true},
            order:[1,'desc'],
            fnCreatedRow:function(nRow,aData,iDataIndex){
                var avgCost = 0;
                var assetValue = parseFloat(aData['asset_value']);
                var exactQty = parseInt(aData['exact_qty']);

                if(assetValue > 0 && exactQty > 0){
                   avgCost = assetValue / exactQty;
                }
                
                $('td:eq(4)',nRow).html(formatNumber(exactQty)).addClass('text-right');
                $('td:eq(6)',nRow).html(formatDollar(avgCost)).addClass('text-right');
                $('td:eq(7)',nRow).html(formatDollar(assetValue)).addClass('text-right');
			}
		});

        $('#data-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var tableId = 'sub-' + row.data().item_id;
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
        console.log(d);
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.item_id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 15%;">{{trans("lang.type")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.date")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.name")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.num")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.cost")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.on_hand")}}</th>';
                    str += '<th style="width: 5%;">{{trans("lang.unit")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.avg_cost")}}</th>';
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
				{ data: 'trans_date', name: 'trans_date' },
				{ data: 'ref_no', name: 'ref_no' },
				{ data: 'id', name: 'id' },
				{ data: 'qty', name: 'qty' },
				{ data: 'cost', name: 'cost' },
                { data: 'qty', name: 'qty' },
                { data: 'to_desc', name: 'to_desc' },
                { data: 'cost', name: 'cost' },
                { data: 'amount', name: 'amount' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
                if(iDataIndex == 0){
                    $('#on_hand').val(0);

                    var factor = parseFloat(aData['factor']);
                    var amount = parseFloat(aData['amount']);
                    var qty    = parseFloat(aData['qty']);
                    var cost   = parseFloat(aData['cost']);

                    if(factor < 1){
                        qty = qty / factor;
                    }else{
                        qty = qty * factor;
                    }

                    cost = cost / factor;

                    var avgCost = cost;
                    var onHand = 0 + qty;
                    var assetValue = amount;

                    $('td:eq(4)',nRow).html(formatNumber(qty)).addClass("text-right");
                    $('td:eq(6)',nRow).html(formatNumber(onHand)).addClass("text-right");
                    $('td:eq(5)',nRow).html(formatDollar(avgCost)).addClass("text-right");
                    $('td:eq(8)',nRow).html(formatDollar(avgCost)).addClass("text-right");
                    $('td:eq(9)',nRow).html(formatDollar(assetValue)).addClass("text-right");
                    $('#on_hand').val(onHand);
                }else{
                    var exactQty = parseFloat($('#on_hand').val());
                    var factor = parseFloat(aData['factor']);
                    var amount = parseFloat(aData['amount']);
                    var qty    = parseFloat(aData['qty']);
                    var cost   = parseFloat(aData['cost']);

                    if(factor < 1){
                        qty = qty / factor;
                    }else{
                        qty = qty * factor;
                    }

                    cost = cost / factor;

                    var avgCost = cost;
                    var onHand = exactQty + qty;
                    var assetValue = amount;
                    $('td:eq(4)',nRow).html(formatNumber(qty)).addClass("text-right");
                    $('td:eq(6)',nRow).html(formatNumber(onHand)).addClass("text-right");
                    $('td:eq(5)',nRow).html(formatDollar(avgCost)).addClass("text-right");
                    $('td:eq(8)',nRow).html(formatDollar(avgCost)).addClass("text-right");
                    $('td:eq(9)',nRow).html(formatDollar(assetValue)).addClass("text-right");
                    $('#on_hand').val(onHand);
                }
                
                
			}
		});
	}

    onPrint = function(args){
        var version = $(args).attr('version');
		if (version=='print') {
            var mywindow = window.open("<?php echo url("report/inventory/printInventoryValuationDetail").$param;?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
            setInterval(function(){ 
                mywindow.print();
                mywindow.close();
            }, 20000);
        }else if(version=='excel'){
			window.location.href="<?php echo url("report/inventory/generateInventoryValuationDetail").$param;?>&version="+version;
		}
    }

    onPrintByItemID = function(itemID){
        var mywindow = window.open("<?php echo url("report/inventory/printInventoryValuationDetailSubDataTable");?>/" + itemID + "<?= $param ?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
        setInterval(function(){ 
            mywindow.print();
            mywindow.close();
        }, 20000);
    }
   
    $(document).ready(function(){
        $(".select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
        
        $('#end_date').val(formatDate('{{date("Y-m-d")}}'));
		$("#end_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
        
        initDataTable();
        getProductTypes(categorySuccess,categoryError,categoryComplete);
        getWarehouses(getWarehouses_onSuccess,getWarehouses_onError,getWarehouses_onComplete);
        $('.product_type').on('change',function(){
            var productType = $(this).val();
            if(productType){
                getProductsByProductType(productType,productSuccess,productError,productComplete);
            }
        });
    });
</script>
@endsection()
<!-- End Script  -->