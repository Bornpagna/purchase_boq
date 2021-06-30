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
</style>
<!-- Param request combine string -->
<?php
    $from_date = '';
    $to_date = '';
    $engineer = '';
    $subcontractor = '';
    $house = '';
    $house_type = '';
    $product = '';
    $product_type = '';
    $warehouse = '';
    $param = '?v=1';
    $start = 0;
    if (Request::input('from_date')) {
        $from_date = Request::input('from_date');
        $param.='&from_date='.$from_date;
    }else{
        $from_date = date('Y-m-d');
        $param.='&from_date='.$from_date;
    }

    if (Request::input('to_date')) {
        $to_date = Request::input('to_date');
        $param.='&to_date='.$to_date;
    }else{
        $to_date = date('Y-m-d');
        $param.='&to_date='.$to_date;
    }

    if (Request::input('engineer')) {
        $engineer = Request::input('engineer');
        $param.='&engineer='.$engineer;
    }

    if (Request::input('subcontractor')) {
        $subcontractor = Request::input('subcontractor');
        $param.='&subcontractor='.$subcontractor;
    }

    if (Request::input('house')) {
        $house = Request::input('house');
        $param.='&house='.$house;
    }

    if (Request::input('house_type')) {
        $house_type = Request::input('house_type');
        $param.='&house_type='.$house_type;
    }

    if (Request::input('product')) {
        $product = Request::input('product');
        $param.='&product='.$product;
    }

    if (Request::input('product_type')) {
        $product_type = Request::input('product_type');
        $param.='&product_type='.$product_type;
    }

    if (Request::input('warehouse')) {
        $warehouse = Request::input('warehouse');
        $param.='&warehouse='.$warehouse;
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
				<form method="POST" class="form-horizontal">
					{{csrf_field()}}
                    <input type="hidden" value="{{$from_date}}" name="from_date" id="from_date">
	                <input type="hidden" value="{{$to_date}}" name="to_date" id="to_date">
					<!-- From Date, To Date, From Warehouse -->
                    <div class="row">
                        <!-- From Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label bold">{{trans('lang.date')}}</label>
                                <div id="report_date" class="btn btn-info" style="width: 100%;">
                                    <i class="fa fa-calendar"></i> &nbsp;
                                    <span> </span>
                                    <b class="fa fa-angle-down"></b>
                                </div>
                            </div>
                        </div>
                        <!-- From Warehouse -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="warehouse" class="control-label" style="text-align: left;"><strong>{{trans('lang.warehouse')}}</strong></label>
                                <select class="form-control select2 warehouse" name="warehouse" id="warehouse">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- Engineer -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="engineer" class="control-label" style="text-align: left;"><strong>{{trans('lang.engineer')}}</strong></label>
                                <select class="form-control select2 engineer" name="engineer" id="engineer">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
					</div>
                    <!-- Engineer, Subcontractor, House Type -->
                    <div class="row">
                        <!-- Subcontractor -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subcontractor" class="control-label" style="text-align: left;"><strong>{{trans('lang.subcontractor')}}</strong></label>
                                <select class="form-control select2 subcontractor" name="subcontractor" id="subcontractor">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- House Type -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="house_type" class="control-label" style="text-align: left;"><strong>{{trans('lang.house_type')}}</strong></label>
                                <select class="form-control select2 house_type" name="house_type" id="house_type">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- House -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="house" class="control-label" style="text-align: left;"><strong>{{trans('lang.house')}}</strong></label>
                                <select class="form-control select2 house" name="house" id="house">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- House, Product Type, Product -->
                    <div class="row">
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
                                <table class="table table-striped table-bordered table-hover dt-responsive" id="data-table">
                                    <thead>
                                        <tr style="font-size:12px;">
                                            <th width="10%" class="text-center all">{{ trans('lang.trans_date') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.warehouse') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.engineer') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.subcontractor') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.house_type') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.house_no') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.item_type') }}</th>
                                            <th width="30%" class="text-center all">{{ trans('lang.item_code') }}</th>
                                            <th width="30%" class="text-center all">{{ trans('lang.item_name') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.boq_std') }}</th>
                                            <th width="10%" class="text-center mobile">{{ trans('lang.boq_add') }}</th>
                                            <th width="5%" class="text-center all">{{ trans('lang.boq_unit') }}</th>
                                            <th width="10%" class="text-center all">{{ trans('lang.usage_qty') }}</th>
                                            <th width="5%" class="text-center all">{{ trans('lang.usage_unit') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center" colspan="14">{{ trans('lang.no_data_available_in_table') }}</th>
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

    getWarehouses = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getWarehouses')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getEngineers = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getEngineers')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getSubcontractors = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getSubcontractors')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getHouseTypes = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getHouseTypes')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getHousesByHouseType = function(houseType,success,error,complete){
        $.ajax({
            url:"{{url('repository/getHousesByHouseType')}}" + '/' + houseType,
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getProductTypes = function(success,error,complete){
        $.ajax({
            url:"{{url('repository/getProductTypes')}}",
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    getProductsByProductType = function(productType,success,error,complete){
        $.ajax({
            url:"{{url('repository/getProductsByProductType')}}" + '/' + productType,
            type:'GET',
            success: success,
            error: error,
            complete: complete
        });
    }

    // Warehouse Response
    warehouseSuccess = function(response){
        $.each(response,function(i,val){
            $(".warehouse").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    warehouseError = function(error){
        $(".warehouse").empty();
		$(".warehouse").select2('val', null);
        $(".warehouse").append($('<option></option>').val('').text(''));
    }
    warehouseComplete = function(response){
        $('.warehouse').select2('val','{{$warehouse}}');
    }
    // Engineer Response
    engineerSuccess = function(response){
        $.each(response,function(i,val){
            $(".engineer").append($('<option></option>').val(val.id).text(val.id_card + ' | ' + val.name));
        });
    }
    engineerError = function(error){}
    engineerComplete = function(response){
        $('.engineer').select2('val','{{$engineer}}');
    }
    // Subcontractor Response
    subcontractorSuccess = function(response){
        $.each(response,function(i,val){
            $(".subcontractor").append($('<option></option>').val(val.id).text(val.id_card + ' | ' + val.name));
        });
    }
    subcontractorError = function(error){}
    subcontractorComplete = function(response){
        $('.subcontractor').select2('val','{{$subcontractor}}');
    }
    // HouseType Response
    houseTypeSuccess = function(response){
        $.each(response,function(i,val){
            $(".house_type").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    houseTypeError = function(error){}
    houseTypeComplete = function(response){
        $('.house_type').select2('val','{{$house_type}}');
    }
    // House Response
    houseSuccess = function(response){
        $(".house").empty();
		$(".house").select2('val', null);
        $(".house").append($('<option></option>').val('').text(''));
        $.each(response,function(i,val){
            $(".house").append($('<option></option>').val(val.id).text(val.house_no));
        });
    }
    houseError = function(error){
        $(".house").empty();
		$(".house").select2('val', null);
        $(".house").append($('<option></option>').val('').text(''));
    }
    houseComplete = function(response){
        $('.house').select2('val','{{$house}}');
    }
    // Category Response
    categorySuccess = function(response){
        $.each(response,function(i,val){
            $(".product_type").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    categoryError = function(error){}
    categoryComplete = function(response){
        $('.product_type').select2('val','{{$product_type}}');
    }
    // Product Response
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

    onPrint = function(args){
        var version = $(args).attr('version');
		if (version=='print') {
            var mywindow = window.open("<?php echo url("/report/usage/print/compareBOQWithUsage").$param;?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
            setInterval(function(){ 
                mywindow.print();
                mywindow.close();
            }, 10000);
        }else if(version=='excel'){
			window.location.href="<?php echo url("/report/usage/generate/compareBOQWithUsage").$param;?>&version="+version;
		}
    }
    
	$(document).ready(function(){
        $(".select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
        
        getWarehouses(warehouseSuccess,warehouseError,warehouseComplete);
        getEngineers(engineerSuccess,engineerError,engineerComplete);
        getSubcontractors(subcontractorSuccess,subcontractorError,subcontractorComplete);
        getHouseTypes(houseTypeSuccess,houseTypeError,houseTypeComplete);
        getProductTypes(categorySuccess,categoryError,categoryComplete);

        $('.house_type').on('change',function(){
            getHousesByHouseType($(this).val(),houseSuccess,houseError,houseComplete);
        });

        $('.product_type').on('change',function(){
            getProductsByProductType($(this).val(),productSuccess,productError,productComplete);
        });

        var from_date = '{{$from_date}}';
        var to_date = '{{$to_date}}';

        if(from_date=='' || from_date==null){
            var date  = Date.parse(jsonStartDate[0].start_date);
            from_date = date.toString('MMMM d, yyyy');
        }else{
            var date =  Date.parse(from_date);
            from_date = date.toString('MMMM d, yyyy');
        }

        if(to_date=='' || to_date==null){
            var date  = Date.parse(jsonEndDate[0].end_date);
            to_date = date.toString('MMMM d, yyyy');
        }else{
            var date  = Date.parse(to_date);
            to_date = date.toString('MMMM d, yyyy');
        }
        $('#report_date span').html(from_date + ' - ' + to_date);
        $('#report_date').show();

        // Initialized datatable
        var table = $('#data-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			ajax: '<?php echo url("/report/usage/generate/compareBOQWithUsage").$param;?>&version=datatables',
			columns: [
				{data: 'trans_date', name:'trans_date'},
				{data: 'warehouse', name:'warehouse'},
				{data: 'engineer', name:'engineer'},
                {data: 'subcontractor', name:'subcontractor'},
                {data: 'house_type', name:'house_type'},
				{data: 'house_no', name:'house_no'},
				{data: 'item_type', name:'item_type'},
				{data: 'item_code', name:'item_code'},
				{data: 'item_name', name:'item_name'},
				{data: 'boq_std', name:'boq_std'},
                {data: 'boq_add', name:'boq_add'},
				{data: 'boq_unit', name:'boq_unit'},
				{data: 'qty', name:'qty'},
				{data: 'unit', name:'unit'}
			],'search':{'regex':true},order:[0,'desc'],
            fnCreatedRow:function(nRow,aData,iDataIndex){
                $('td:eq(0)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			}
		});
    
    });

</script>
@endsection()
<!-- End Script  -->