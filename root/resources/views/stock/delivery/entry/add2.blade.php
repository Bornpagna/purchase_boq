@extends('layouts.app')

@section('content')
<style>
	.btnAdd{
		cursor: pointer;
	}
	.form-horizontal .form-group {
		margin-left: 0px !important;
		margin-right: 0px !important;
	}
	.form-control .fileinput-filename {
		position: absolute;
		width: 88%;
	}
</style>
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
<!-- Last Form Input -->
<?php 
	
	$supplierID = 0;
	if(Request::input('supplier')){
		$supplierID = Request::input('supplier');
	}

	$orderID = 0;
	if(Request::input('po_no')){
		$orderID = Request::input('po_no');
	}

	$shipping = 0;
	if(Request::input('shipping')){
		$shipping = Request::input('shipping');
	}

	$warehouseID = 0;
	if(Request::input('to_warehouse')){
		$warehouseID = Request::input('to_warehouse');
	}

	$productID = 0;
	if(Request::input('product')){
		$productID = Request::input('product');
	}

	$transDate = date('Y-m-d');
	if(Request::input('trans_date')){
		$transDate = Request::input('trans_date');
	}

	$refNo = '';
	if(Request::input('reference_no')){
		$refNo = Request::input('reference_no');
	}
?>
<!-- Last Form Input -->
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
					<a rounte="{{$rounteBack}}" title="{{trans('lang.back')}}" class="btn btn-circle btn-icon-only btn-default" id="btnBack">
						<i class="fa fa-close"></i>
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
				<form action="{{$rounteSave}}" method="POST" id="form-stock-entry" class="form-horizontal" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="hidden" name="btnSubmit" id="btnSubmit"/>
					<div>
						<div class="row">
							<div class="col-lg-12">
								<!-- Date -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="trans_date" class="control-label"><strong>{{ trans('lang.date') }}</strong>
											<span class="required"> * </span>
										</label>
										<input class="form-control date-picker today trans_date" length="10" type="text" id="trans_date" name="trans_date" placeholder="{{ trans('lang.enter_text') }}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- Reference -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="reference_no" class="control-label"><strong>{{ trans('lang.reference_no') }}</strong>
											<span class="required"> * </span>
										</label>
										<input class="form-control reference_no" length="20" type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- Supplier -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="supplier" class="control-label"><strong>{{ trans('lang.supplier') }}</strong>
											<span class="required"> * </span>
										</label>
										@if(hasRole('supplier_add'))
											<div class="input-group">
												<select class="form-control select2 supplier" name="supplier" id="supplier">
													<option value=""></option>
												</select>
												<span class="input-group-addon btn blue" id="btnAddSupplier">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										@else
											<select class="form-control select2 supplier" name="supplier" id="supplier">
												<option value=""></option>
											</select>
										@endif
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- Purchase Order -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="po_no" class="control-label" style="text-align: left;"><strong>{{ trans('lang.order_no') }}</strong>
											<span class="required"> * </span>
										</label>
										<div class="input-group input-icon right">
											<span class="input-group-addon">
												<i class="fa fa-shopping-cart font-red"></i>
											</span>
											<select class="form-control select2 po_no" name="po_no" id="po_no">
												<option value=""></option>
											</select>
										</div>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- Shipping -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="shipping" class="control-label"><strong>{{ trans('lang.shipping') }}</strong></label>
										<input class="form-control shipping" type="number" id="shipping" name="shipping" placeholder="{{ trans('lang.shipping_placeholder') }}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- Attachment -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="photo" class="control-label" style="text-align: left;"><strong>{{trans('lang.attach_document')}}</strong></label>
										<div class="fileinput fileinput-new input-group picture" data-provides="fileinput">
											<div class="form-control" data-trigger="fileinput">
												<i class="glyphicon glyphicon-file fileinput-exists"></i> 
												<span class="fileinput-filename"></span>
											</div>
											<span class="input-group-addon btn blue btn-file">
												<span class="fileinput-new bold">{{trans('lang.browse')}}...</span>
												<span class="fileinput-exists bold">{{trans('lang.change')}}</span>
												<input type="file" id="photo" name="photo" accept="file/*">
											</span>
											<a href="#" class="input-group-addon btn red fileinput-exists bold" data-dismiss="fileinput">{{trans('lang.remove')}}</a>
										</div>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
								<!-- To Warehouse -->
								<div class="col-md-4">
									<div class="form-group">
										<label for="to_warehouse" class="control-label" style="text-align: left;"><strong>{{trans('lang.to_warehouse')}}</strong></label>
										<select class="form-control select2 to_warehouse" name="to_warehouse" id="to_warehouse">
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
								
								<!-- List of Product -->
								<div class="col-md-12">
									<div class="table-scrollable">
										<table class="table table-striped table-bordered table-hover" width="100%" id="table-income">
											<thead>
												<tr style="font-size:12px;">
													<th width="40%" class="text-center all">{{ trans('lang.product_code_name') }}</th>
													<th width="15%" class="text-center all">{{ trans('lang.units') }}</th>
													<th width="10%" class="text-center all">{{ trans('lang.qty') }}</th>
													<th width="10%" class="text-center all">{{ trans('lang.price') }}</th>
													<th width="10%" class="text-center all">{{ trans('lang.discount') }}</th>
													<th width="10%" class="text-center all">{{ trans('lang.subtotal') }}</th>
													<th width="5%" class="text-center all"><a><i class="fa fa-trash"></i></a></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th class="text-center all" colspan="7">{{ trans('lang.no_data_available_in_table') }}</th>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- Note -->
								<div class="col-md-12">
									<div class="form-group">
										<label for="desc" class="control-label" style="text-align: left;"><strong>{{trans('lang.note')}}</strong></label>
										<textarea class="form-control trans_desc" id="desc" name="desc" length="100" rows="6" placeholder="{{ trans('lang.enter_text') }}"> </textarea>
									</div>
								</div>
								<!-- Action Form -->
								<div class="col-md-12">
									<div class="form-group text-right">
										<button type="submit" id="save_close" name="save_close" value="1" class="btn green bold">{{trans('lang.save')}}</button>
										<button type="submit" id="save_new" name="save_new" value="2"  class="btn blue bold">{{trans('lang.save_new')}}</button>
										<a class="btn red bold" rounte="{{$rounteBack}}" id="btnCancel">{{trans('lang.cancel')}}</a>
									</div>
								</div>
								<!-- List of Origin Order -->
								<div class="col-md-12">
									<div class="form-group">
										<label for="product" class="control-label" style="text-align: left;"><strong>{{trans('lang.list_of_origin_order')}}</strong></label>
										<div>
											<table class="table table-striped table-bordered table-hover" width="100%" id="listOfOriginOrders">
												<thead>
													<tr style="font-size:12px;">
														<th width="25%" class="text-center all">{{ trans('lang.item_code') }}</th>
														<th width="20%" class="text-center all">{{ trans('lang.item_name') }}</th>
														<th width="15%" class="text-center all">{{ trans('lang.unit') }}</th>
														<th width="10%" class="text-center all">{{ trans('lang.order') }}</th>
														<th width="10%" class="text-center all">{{ trans('lang.delivery') }}</th>
														<th width="10%" class="text-center all">{{ trans('lang.on_hold') }}</th>
														<th width="10%" class="text-center all">{{ trans('lang.can_delivery') }}</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th class="text-center all" colspan="7">{{ trans('lang.no_data_available_in_table') }}</th>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- List of Delivery by Order -->
								<div class="col-md-12">
									<div class="form-group">
										<label for="product" class="control-label" style="text-align: left;"><strong>{{trans('lang.list_of_deliveries')}}</strong></label>
										<div>
											<table class="table table-striped table-bordered table-hover" width="100%" id="listOfDeliveries">
												<thead>
													<tr style="font-size:12px;">
														<th width="3%" class="all"></th>
														<th width="10%" class="text-center all">{{ trans('lang.date') }}</th>
														<th width="20%" class="text-center all">{{ trans('lang.reference_no') }}</th>
														<th width="20%" class="text-center all">{{ trans('lang.po_no') }}</th>
														<th width="20%" class="text-center all">{{ trans('lang.supplier') }}</th>
														<th width="27%" class="text-center all">{{ trans('lang.desc') }}</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th class="text-center all" colspan="6">{{ trans('lang.no_data_available_in_table') }}</th>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
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
@include('modal.supplier')
<!-- End Modal Block -->
<!--------------------------------------------------->
@endsection()
<!--------------------------------------------------->
<!-- Script  -->
@section('javascript')
<script type="text/javascript">
	const FORM_KEY = 'views.stock.delivery.entry.add2.items';
	removeAllFormStorage = function(uniqueKey){
		if(localStorage.getItem(uniqueKey))
		localStorage.removeItem(uniqueKey);
	}

	addToLocalStorage = function(key, data){
		localStorage.setItem(FORM_KEY + key, data);
	}

	cleanLocalStorage = function(){}

	appendPurchaseOrderItem = function(item,calledUnit){
		// Item
		var tdItem  = '<td>';
		tdItem += '<input type="hidden" class="item item_' + item.item_id + '" id="item_' + item.item_id + '" name="item[]" value="' + item.item_id + '" />';
		tdItem += item.code + ' | ' + item.name;
		tdItem += '</td>';
		// Unit
		var tdUnit  = '<td>';
		tdUnit += '<select class="form-control select2 unit unit_'+ item.item_id +'" id="unit_'+ item.item_id +'" name="unit[]"></select>';
		tdUnit += calledUnit(item,'.unit_'+ item.item_id);
		tdUnit += '</td>';
		// Qty
		var tdQty  = '<td>';
		tdQty += '<input type="text" class="form-control qty qty_'+ item.item_id +'" id="qty_'+ item.item_id +'" name="qty[]" value="' + item.qty + '" />';
		tdQty += '</td>';
		// Cost
		var tdCost  = '<td>';
		tdCost += '<input type="text" class="form-control cost cost_'+ item.item_id +'" id="cost_'+ item.item_id +'" name="cost[]" value="' + item.price + '" />';
		tdCost += '</td>';
		// Discount
		var tdDiscount  = '<td>';
		tdDiscount += '<input type="text" class="form-control discount discount_'+ item.item_id +'" id="discount_'+ item.item_id +'" name="discount[]" value="0" />';
		tdDiscount += '</td>';
		// Subtotal
		var tdSubtotal  = '<td>';
		tdSubtotal += '<input type="text" class="form-control subtotal subtotal_'+ item.item_id +'" id="subtotal_'+ item.item_id +'" name="subtotal[]" value="' + item.total + '" />';
		tdSubtotal += '</td>';
		// Remove
		var tdRemove  = '<td>';
		tdRemove += '<a class="btn btn-xs red remove remove_'+item.item_id+'"><i class="fa fa-trash"></i></a>';
		tdRemove += '</td>';
		
		return '<tr>' + tdItem + tdUnit + tdQty + tdCost + tdCost + tdDiscount + tdSubtotal + tdRemove + '</tr>';
	}

	calledUnit = function(item,unitNode) {}

	getUnitsByItemID = function(itemID,success,complete){
		$.ajax({
			url: "{{url('repository/getUnitsByItemID')}}/" + itemID,
			type: 'GET',
			success: function(response){success(response,itemID);},
			complete: function(response){complete(response,itemID);},
		});
	}
	getUnitsByItemID_success = function(response,itemID){
		$(".unit_"+itemID).empty();
		$(".unit_"+itemID).select2('val', null);
        $(".unit_"+itemID).append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".unit_"+itemID).append($('<option></option>').val(val.id).text(val.ref_no));
        });
	}
	getUnitsByItemID_complete = function(response,itemID){}

	// Get Purchase order
	getPurchaseOrderBySupplierID = function(supplierID,onSuccess,onError,onComplete){
		$.ajax({
			url: "{{url('repository/getPurchaseOrderBySupplierID')}}/" + supplierID,
			type: 'GET',
			success: onSuccess,
			error: onError,
			complete: onComplete
		});
	}
	getPurchaseOrderBySupplierID_onSuccess = function(response){
		$(".po_no").empty();
		$(".po_no").select2('val', null);
        $(".po_no").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".po_no").append($('<option></option>').val(val.id).text(val.ref_no));
        });
	}
	getPurchaseOrderBySupplierID_onError = function(error){
		$(".po_no").empty();
		$(".po_no").select2('val', null);
	}
	getPurchaseOrderBySupplierID_onComplete = function(response){
		$('.po_no').select2('val',"{{$orderID}}");
	}
	// Get Supplier
	getSuppliers = function(onSuccess,onError,onComplete){
		$.ajax({
			url: "{{url('repository/getSuppliers')}}",
			type: 'GET',
			success: onSuccess,
			error: onError,
			complete: onComplete
		});
	}
	getSuppliers_onSuccess = function(response){
		$(".supplier").empty();
		$(".supplier").select2('val', null);
        $(".supplier").append($('<option></option>').val('').text(''));
		addToLocalStorage("getSuppliers_",response);
        $.each(response,function(i,val){
            $(".supplier").append($('<option></option>').val(val.id).text(val.desc + ' (' + val.name + ')'));
        });
	}
	getSuppliers_onError = function(error){
		$(".supplier").empty();
		$(".supplier").select2('val', null);
	}
	getSuppliers_onComplete = function(response){
		$('.supplier').select2('val',"{{$supplierID}}");
	}
	// Get Warehouse
	getWarehouses = function(onSuccess,onError,onComplete){
		$.ajax({
			url: "{{url('repository/getWarehouses')}}",
			type: 'GET',
			success: onSuccess,
			error: onError,
			complete: onComplete
		});
	}
	getWarehouses_onSuccess = function(response){
		$(".to_warehouse").empty();
		$(".to_warehouse").select2('val', null);
        $(".to_warehouse").append($('<option></option>').val('').text(''));
		addToLocalStorage("getWarehouses_",response);
        $.each(response,function(i,val){
            $(".to_warehouse").append($('<option></option>').val(val.id).text(val.name));
        });
	}
	getWarehouses_onError = function(error){
		$(".to_warehouse").empty();
		$(".to_warehouse").select2('val', null);
	}
	getWarehouses_onComplete = function(response){
		$('.to_warehouse').select2('val',"{{$warehouseID}}");
	}
	// Get Product
	getOrderItemsByOrderID = function(orderID,onSuccess,onError){
		$.ajax({
			url: "{{url('repository/getOrderItemsByOrderID')}}/" + orderID,
			type: 'GET',
			success: onSuccess,
			error: onError
		});
	}
	getOrderItemsByOrderID_onSuccess = function(response){
		addToLocalStorage("getOrderItemsByOrderID_",response);
	}
	getOrderItemsByOrderID_onError = function(error){}

	format = function(d) {
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 5%;">{{trans("lang.line_no")}}</th>';
                    str += '<th style="width: 25%;">{{trans("lang.items")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.units")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 15%;">{{trans("lang.to_warehouse")}}</th>';
                    str += '<th style="width: 20%;">{{trans("lang.note")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

	// List Of Deliveries Datatable
	buildSubTableListOfDeliveries = function(tableId, data){
		$('#' + tableId).DataTable({
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url,
			columns: [
				{ data: 'line_no', name: 'line_no' },
				{ data: 'item', name: 'item' },
				{ data: 'unit', name: 'unit' },
				{ data: 'qty', name: 'qty' },
				{ data: 'warehouse', name: 'warehouse' },
				{ data: 'desc', name: 'desc' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
				$('td:eq(3)',nRow).html(formatNumber(aData['qty']));
			}
		});
	}

	var listOfOriginOrders = $('#listOfOriginOrders').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{url("stock/deliv/listOfOriginOrders")}}/0',
		columns: [
			{data: 'code', class:'text-center', name:'code'},
			{data: 'name', class:'text-center', name:'name'},
			{data: 'unit', class:'text-center', name:'unit'},
			{data: 'qty', class:'text-center', name:'qty'},
			{data: 'delivery_qty', class:'text-center', name:'delivery_qty'},
			{data: 'on_hold', name:'on_hold'},
			{data: 'can_delivery', name:'can_delivery'},
		],
		order: [[0, 'desc']],
		fnCreatedRow:function(nRow, aData, iDataIndex){
			var orderQty = parseFloat(aData['qty']);
			var deliveryQty = parseFloat(aData['delivery_qty']);
			var onHoldQty = orderQty - deliveryQty;
			var canDelivery = '<a class="btn btn-xs btn-danger">{{trans("lang.no")}}</a>';
			if(onHoldQty > 0){
				canDelivery = '<a class="btn btn-xs btn-success">{{trans("lang.yes")}}</a>';
			}
			$('td:eq(5)',nRow).html(onHoldQty).addClass("text-center");
			$('td:eq(6)',nRow).html(canDelivery).addClass("text-center");
		}
	});

	var listOfDeliveries = $('#listOfDeliveries').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{url("stock/deliv/listOfDeliveriesByOrderID")}}/0',
		columns: [
			{
				className: 'details-control',
				orderable: false,
				searchable: false,
				data: null,
				defaultContent: ''
			},
			{data: 'trans_date', class:'text-center', name:'trans_date'},
			{data: 'ref_no', class:'text-center', name:'ref_no'},
			{data: 'po_ref', class:'text-center', name:'po_ref'},
			{data: 'supplier', name:'supplier'},
			{data: 'note', name:'note'},
		],order: [[2, 'desc']],
		fnCreatedRow:function(nRow, aData, iDataIndex){
			$('td:eq(1)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
		}
	});

	$('#listOfDeliveries tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = listOfDeliveries.row(tr);
		var tableId = 'sub-' + row.data().id;
		if(row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
			objName = [];
		}else{
			row.child(format(row.data())).show();
			buildSubTableListOfDeliveries(tableId,row.data());
			$('#' + tableId+'_wrapper').attr('style','width: 99%;');
			tr.addClass('shown');
		}
	});

	bulidDatatableListOfDeliveries = function(orderID){
		listOfOriginOrders.context[0].ajax = '{{url("stock/deliv/listOfOriginOrders")}}/' + orderID;
		listOfOriginOrders.ajax.reload();

		listOfDeliveries.context[0].ajax = '{{url("stock/deliv/listOfDeliveriesByOrderID")}}/' + orderID;
		listOfDeliveries.ajax.reload();
	}

	$(document).ready(function(){
		// reset form local storage
		removeAllFormStorage(FORM_KEY);
		// init select2 select
		$(".select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		// init datepicker
		$('#trans_date').val(formatDate('{{$transDate}}'));
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
		// check onchange .select2
		getWarehouses(getWarehouses_onSuccess,getWarehouses_onError,getWarehouses_onComplete);
		getSuppliers(getSuppliers_onSuccess,getSuppliers_onError,getSuppliers_onComplete);
		$('.supplier').on('change',function(){
			getPurchaseOrderBySupplierID($(this).val(),getPurchaseOrderBySupplierID_onSuccess,getPurchaseOrderBySupplierID_onError,getPurchaseOrderBySupplierID_onComplete);
		});
		$('.po_no').on('change',function(){
			var orderID = $(this).val();
			if(orderID != null){
				bulidDatatableListOfDeliveries(orderID);
				getOrderItemsByOrderID(orderID,getOrderItemsByOrderID_onSuccess,getOrderItemsByOrderID_onError);
			}
		});
		// set search suggestion to select2
		$('.product').select2({
		  width:'100%',
		  allowClear:'true',
		  placeholder:'{{trans("lang.please_choose")}}',
		  ajax: {
		    url: '{{url("/items/getProducts")}}',
		    dataType:"json",
		    data: function (params) {
		      var query = {
		        q: params.term
		      }
		      return query;
		    },
		    async:true,
		    processResults: function (data) {
		      return {
		        results: data.data
		      };
		    }
		  }
		});
	});

</script>
@endsection()
<!-- End Script  -->