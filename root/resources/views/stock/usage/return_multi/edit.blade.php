@extends('layouts.app')

@section('content')
<style>
	.btnAdd{
		cursor: pointer;
	}
</style>
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
					<a rounte="{{$rounteBack}}" title="{{trans('lang.back')}}" class="btn btn-circle btn-icon-only btn-default" id="btnBack">
						<i class="fa fa-reply"></i>
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
					<div class="portlet-body" >
						<div class="row">
							<div class="col-md-6">
								<div class="portlet-body" style="background: #f8f9fb;padding: 12px 12px 0 12px	;border: 1px solid #72aee2;">
									<h4>*** {{trans('lang.general_part')}}</h4>
									<hr style="margin-top:10px !important;">
									<div class="row" >
										<div class="col-md-12">
											<div class="form-group">
												<label for="reference_no" class="col-md-4 control-label"><strong>{{ trans('lang.reference_no') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-8">
													<input class="form-control reference_no" length="20" readonly type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											<div class="form-group">
												<label for="trans_date" class="col-md-4 control-label"><strong>{{ trans('lang.trans_date') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-8">
													<input class="form-control trans_date" length="10" type="text" id="trans_date" name="trans_date" placeholder="{{ trans('lang.enter_text') }}">
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											<div class="form-group">
												<label for="reference" class="col-md-4 control-label"><strong>{{ trans('lang.reference') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-8">
													<input class="form-control reference"?????? length="100" type="text" id="reference" name="reference" placeholder="{{ trans('lang.enter_text') }}">
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											<div class="form-group">
												<label for="street_id" class="col-md-4 control-label"><strong>{{ trans('lang.street') }}</strong></label>
												<div class="col-md-8">
													<select class="form-control street_id" onchange="onChangeStreet(this)" name="street_id">
														<option value=""></option>
														{{getSystemData("ST")}}
													</select>
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											<div class="form-group">
												<label for="house_id" class="col-md-4 control-label"><strong>{{ trans('lang.house_no') }}</strong></label>
												<div class="col-md-8">
													<select class="form-control house_id" onchange="onChangeHouse(this)" name="house_id">
														<option value=""></option>
													</select>
													<span class="help-block font-red bold"></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6" >
								<div class="portlet-body" style="background: #f8f9fb;padding: 12px;border: 1px solid #72aee2;">
									<h4>*** {{trans('lang.desc')}}</h4>
									<hr style="margin-top:10px !important;">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="engineer" class="col-md-3 control-label" style="text-align: left;"><strong>{{ trans('lang.engineer') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-9">
													@if(hasRole('constructor_add'))
														<div class="input-group">
															<select class="form-control engineer" name="engineer" id="engineer">
																<option value=""></option>
																{{getConstructor([1])}}
															</select>
															<span class="input-group-addon btn blue" id="btnAddEngineer">
																<i class="fa fa-plus"></i>
															</span>
														</div>
													@else
														<select class="form-control engineer" name="engineer" id="engineer">
															<option value=""></option>
															{{getConstructor([1])}}
														</select>
													@endif
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											@if(getSetting()->return_constructor==1)
											<div class="form-group">
												<label for="sub_const" class="col-md-3 control-label" style="text-align: left;"><strong>{{ trans('lang.sub_const') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-9">
													@if(hasRole('constructor_add'))
														<div class="input-group">
															<select class="form-control sub_const" name="sub_const" id="sub_const">
																<option value=""></option>
																{{getConstructor([2,3,4,5])}}
															</select>
															<span class="input-group-addon btn blue" id="btnAddSubConstructor">
																<i class="fa fa-plus"></i>
															</span>
														</div>
													@else
														<select class="form-control sub_const" name="sub_const" id="sub_const">
														<option value=""></option>
														{{getConstructor([2,3,4,5])}}
													</select>
													@endif
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											@endif
											<div class="form-group">
												<label for="warehouse_id" class="col-md-3 control-label" style="text-align: left;"><strong>{{ trans('lang.warehouse') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-9">
													@if(hasRole('warehouse_add'))
														<div class="input-group">
															<select class="form-control warehouse_id" id="warehouse_id" name="warehouse_id">
																<option value=""></option>
																{{getWarehouse()}}
															</select>
															<span class="input-group-addon btn blue" id="btnAddWarehouse">
																<i class="fa fa-plus"></i>
															</span>
														</div>
													@else
														<select class="form-control warehouse_id" id="warehouse_id" name="warehouse_id">
															<option value=""></option>
															{{getWarehouse()}}
														</select>
													@endif
													<span class="help-block font-red bold"></span>
												</div>
											</div>
											<textarea class="form-control trans_desc" id="trans_desc" name="desc" rows="<?php if(getSetting()->return_constructor==1){echo '5';}else{echo '8';} ?>" length="100" placeholder="{{ trans('lang.enter_text') }}"> </textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-striped table-responsive table-bordered table-hover" width="100%" id="table-income">
								<thead>
									<tr style="font-size:12px;">
										<th width="5%" class="text-center all">{{ trans('lang.line_no') }}</th>
										<th width="30%" class="text-center all">{{ trans('lang.items') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.units') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.qty') }}</th>
										<th width="30%" class="text-center all">{{ trans('lang.note') }}</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"></div><br/>
					<div class="form-actions text-right">
						<button type="submit" id="save_close" name="save_close" value="1" class="btn green bold">{{trans('lang.save_change')}}</button>
						<a class="btn red bold" rounte="{{$rounteBack}}" id="btnCancel">{{trans('lang.cancel')}}</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('modal.warehouse')
@include('modal.constructor')
@endsection()

@section('javascript')
<script type="text/javascript">	

	var jsonHouse  = [];
	var jsonUnits  = [];
	var jsonItems  = [];
	var jsonRecord = [];
	
	function GetUnit(unit_stock) {
		return $.ajax({url:'{{url("/stock/deliv/GetUnit")}}',type:'GET',dataType:'json',data:{unit_stock:unit_stock},async:false}).responseJSON;
	}

	function GetItem(query) {
		return $.ajax({url:'{{url("/stock/use/GetItem")}}',type:'GET',dataType:'json',data:{q:query},async:false}).responseJSON;
	}

	function GetHouse(street_id) {
		return $.ajax({url:'{{url("/stock/use/GetHouse")}}',type:'GET',dataType:'json',data:{id:street_id},async:false}).responseJSON;
	}

	function GetStreet(query) {
		return $.ajax({url:'{{url("/stock/use/GetStreet")}}',type:'GET',dataType:'json',data:{q:query},async:false}).responseJSON;
	}

	function GetDetail(id) {
		return $.ajax({url:'{{url("/stock/reuse/GetDetail")}}',type:'GET',dataType:'json',data:{id:id},async:false}).responseJSON;
	}

	function GenItem(field,data) {
		if (data) {
			$(field).empty();
			$(field).append($('<option></option>').val('').text(''));
			$.each(data,function(key,val){
				$(field).append($('<option></option>').val(val.item_id).text(val.code+' ('+val.name+')'));
			});
		}
	}
	
	function isDuplicateArray(err) {
        var duplicate = false;
        err.sort();
        var current = null;
        var cnt = 1;
        for (var i = 0; i < err.length; i++) {
            if (err[i] != current) {
                current = err[i];
            } else {
                cnt++;
            }
        }
        if (cnt > 1) {
            duplicate = true;
        }else{
            duplicate = false;
        }
        return duplicate;
    }
	
	jQuery.fn.ForceNumericOnly = function(){
        return this.each(function(){
            $(this).keydown(function(e){
                var key = e.charCode || e.keyCode || 0;
                return (
                    key == 8 || 
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
            });
        });
    };
	
	function isSave(){
		var isValid = true;
		var dupArray = [];
		$(".check_row").each(function(i){
			if($(this).val()!=null && $(this).val()!='' && typeof $(this).val()!=undefined){
				dupArray[i] = $(this).val();
			}
		});
		if (isDuplicateArray(dupArray)==true) {
			isValid = false;
			$(".show-message-error").html('{{trans("lang.some_record_is_dublicate")}}');
		}else{
			$(".line_return_qty").each(function(){
				var boq_set = $(this).next().next().val();
				var usage_qty = $(this).next().val();
				var return_qty = $(this).val();
				if(parseFloat(return_qty) > parseFloat(usage_qty)){
					isValid = false;
					$(this).css('border','1px solid #e43a45');
					$(".show-message-error").html('{{trans("lang.greater_than_usage_qty")}}!');
				}else{
					$(this).css('border','1px solid #c2cad8');
					$(".show-message-error").empty();
				}
			});
		}
		return isValid;
	}

	$('#save_close').on('click',function(){
		$(this).prop('disabled', true);
		if(chkValid([".reference_no",".trans_date",".reference",".trans_desc",".warehouse_id",".house_id",".street_id",".line_item",".line_unit",".line_return_qty",<?php if(getSetting()->return_constructor==1){echo '".sub_const",';} ?>".engineer"])){
			if(isSave()){
				$("#btnSubmit").val($(this).val());
				$('#form-stock-entry').submit();
			}else{
				$(this).prop('disabled', false);
				return false;
			}
		}else{
			$(this).prop('disabled', false);
			return false;
		}
	});
	
	function onChangeStreet(field){
		var val = $(field).val();
		jsonHouse = GetHouse(val);
		if(val!=null && val!='' && jsonHouse){
			$('.house_id').empty();
			$('.house_id').append($('<option></option>').val('').text(''));
			$('.house_id').select2('val', null);
			$.each(jsonHouse, function(key ,value){
				$('.house_id').append($('<option></option>').val(value.id).text(value.house_no));
			});
		}
	}
	
	function onChangeHouse(field){
		var val = $(field).val();
		if(val!=null && val!='' && jsonHouse){
			
		}
	}
	
	function onChangeItem(field, row){
		var val = $(field).val();
		if(val!=null && val!='' && jsonItems){
			$.each(jsonItems.filter(c=>c.item_id==val), function(key, val){
				$('.line_unit_'+row).empty();
				$('.line_unit_'+row).append($('<option></option>').val('').text(''));
				jsonUnits = GetUnit(val.unit_stock);
				$.each(jsonUnits, function(k, v){
					$('.line_unit_'+row).append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
				});
				$('.line_unit_'+row).select2('val', val.unit_usage);
			});
		}
	}
	
	function onChangeUnit(field, row, old_qty){
		var house_id = $(".house_id").val();
		var item_id = $(".line_item_"+row).val();
		var unit = $(field).val();
		if(house_id!=null && house_id!='' && item_id!=null && item_id!='' && unit!=null && unit!=''){
			var _token = $("input[name=_token]").val();
			$.ajax({
				url :'{{url("stock/reuse/remoteItem")}}',
				type:'POST',
				data:{
					'_token': _token,
					'house_id':house_id,
					'item_id':item_id,
					'unit':unit,
				},
				success:function(data){
					$('.line_usage_qty_'+row).val(parseFloat(data.usage_qty) + parseFloat(old_qty));
					$('.line_boq_set_'+row).val(data.boq_set);
				},error:function(){
					$('.line_usage_qty_'+row).val(0);
					$('.line_boq_set_'+row).val(0);
					console.log('error get qty stock.');
				}
			});
		}
		$(".line_return_qty_"+row).val('');
		$(".check_row_"+row).val(house_id+"_"+item_id);
	}
	
	function enterQtyUsage(field, row){
		var usage_qty = $(".line_usage_qty_"+row).val();
		var return_qty = $(field).val();
		if(usage_qty!=null && usage_qty!='' && return_qty!=null && return_qty!=''){
			if(parseFloat(return_qty) > parseFloat(usage_qty)){
				$(field).css('border','1px solid #e43a45');
				$(".show-message-error").html('{{trans("lang.greater_than_usage_qty")}}!');
			}else{
				$(field).css('border','1px solid #c2cad8');
				$(".show-message-error").empty();
			}
		}else{
			$(field).css('border','1px solid #c2cad8');
			$(".show-message-error").empty();
		}
	}
	
	function initTable(data){
		$("#table-income tbody").append('<tr>'+
				'<td class="text-center all" style="vertical-align: middle !important;">'+
				'	<input type="hidden" class="line_index line_index_'+data.id+'" name="line_index[]" value="'+data.line_no+'" />'+
				'	<input type="hidden" class="check_row check_row_'+data.id+'" value="'+data.house_id+'_'+data.item_id+'" />'+
				'	<strong>'+data.line_no+'</strong>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_item line_item_'+data.id+'" onchange="onChangeItem(this, '+data.id+')" name="line_item[]">'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_unit line_unit_'+data.id+'" name="line_unit[]" >'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<input type="number" length="50" step="any" class="form-control line_return_qty line_return_qty_'+data.id+'" name="line_return_qty[]" onkeyup="enterQtyUsage(this, '+data.id+')" />'+
				'	<input type="hidden" class="form-control line_usage_qty line_usage_qty_'+data.id+'" name="line_usage_qty[]"/>'+
				'	<input type="hidden" class="form-control line_boq_set line_boq_set_'+data.id+'" name="line_boq_set[]"/>'+
				'</td>'+
				'<td>'+
				'	<input type="text" length="100" class="form-control line_note line_note_'+data.id+'" name="line_note[]"/>'+
				'</td>'+
			'</tr>');
		$.fn.select2.defaults.set("theme", "classic");
		$(".house_id"+data.id+",.line_from_warehouse_"+data.id+",.line_street_"+data.id+",.line_unit_"+data.id+",.line_item_"+data.id).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		$(".line_return_qty_"+data.id).ForceNumericOnly();
		
		var itemSelect = $('.line_item_'+data.id);
		itemSelect.select2({
		  width:'100%',
		  allowClear:'true',
		  placeholder:'{{trans("lang.please_choose")}}',
		  ajax: {
		    url: '{{url("/stock/use/GetItem")}}',
		    dataType:"json",
		    data: function (params) {
		      var query = {
		        q: params.term
		      }
		      return query;
		    },
		    async:true,
		    success:function(data){
		    	jsonItems = data.data;
		    },
		    processResults: function (data) {
		      return {
		        results: data.data
		      };
		    }
		  }
		});

		GenItem('.line_item_'+data.id,jsonRecord);

		$(".warehouse_id").select2('val', data.warehouse_id);
		$(".street_id").select2('val', data.street_id);
		$(".house_id").select2('val', data.house_id);

		$('.line_item_'+data.id).select2('val', data.item_id);
		$('.line_unit_'+data.id).select2('val', data.unit);
		
		$(".line_return_qty_"+data.id).val(data.qty);
		$(".line_usage_qty_"+data.id).val(data.usage_qty);
		$(".line_boq_set_"+data.id).val(data.boq_set);
		$(".line_note_"+data.id).val(data.note);
		$('.line_unit_'+data.id).attr("onchange", "onChangeUnit(this, "+data.id+", "+(data.qty)+")");
	}
	
	document.addEventListener("mousewheel", function(event){
		if(document.activeElement.type === "number" &&
		   document.activeElement.classList.contains("noscroll"))
		{
			document.activeElement.blur();
		}
	});

	@if(hasRole('warehouse_add'))
		var objWarehouse = JSON.parse(convertQuot('{{\App\Model\Warehouse::where(["pro_id"=>Session::get('project')])->get(["name"])}}'));
		$("#btnAddWarehouse").on('click', function(event){
			event.preventDefault();
			$('.warehouse-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#old_name').val('');
			$('#name').val('');
			$('.tel').val('N/A');
			$('#user_control').select2('val',null);
			$('.status').select2('val',1);
			$('.address').val('N/A');
			$('.button-submit-warehouse').attr('id','btnSaveWarehouse').attr('name','btnSaveWarehouse').attr('onclick','onSubmitWarehouse(this)');
			$('.button-submit-warehouse').html('{{trans("lang.save")}}');
			$('.warehouse-modal').modal('show');
		});

		function onSubmitWarehouse(field){
			$('.button-submit-warehouse').prop('disabled', true);
			if(chkValid([".name",".user_control"])){
				if(chkDublicateName(objWarehouse, '#name')){
					$.ajax({
						url :'{{url("warehouse/save")}}',
						type:'POST',
						data:$('.warehouse-form').serialize(),
						success:function(data){
							if(data){
								$("#warehouse_id").append($('<option></option>').val(data.id).text(data.name));
								$("#warehouse_id").select2('val', data.id);
							}
							$('.warehouse-modal').modal('hide');
							$('.button-submit-warehouse').prop('disabled', false);
						},error:function(){
							$('.warehouse-modal').modal('hide');
							$('.button-submit-warehouse').prop('disabled', false);
						}
					});
				}else{
					$('.button-submit-warehouse').prop('disabled', false);
					return false;					
				}
			}else{
				$('.button-submit-warehouse').prop('disabled', false);
				return false;
			}
		}
	@endif
	
	@if(hasRole('constructor_add'))
		var objConstructor = JSON.parse(convertQuot('{{\App\Model\Constructor::get(["name","id_card"])}}'));
		$("#btnAddEngineer").on('click', function(event){
			$('.constructor-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#id_card').val('');
			$('#old_id_card').val('');
			$('#con-name').val('');
			$('#con-tel').val('');
			$('#con-type option[value=1]').prop('disabled', false);
			$('#con-type option[value!=1]').prop('disabled', true);
			$.fn.select2.defaults.set("theme", "classic");
			$('#con-type').select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
			$('#con-type').select2('val', null);
			$('#con-status').select2('val',1);
			$('#con-address').val('');
			$('.button-submit-constructor').attr('id','btnSaveEngineer').attr('name','btnSaveEngineer').attr('onclick','onSubmitEngineer(this)');
			$('.button-submit-constructor').html('{{trans("lang.save")}}');
			$('.constructor-modal').modal('show');
		});

		function onSubmitEngineer(field){
			$('.button-submit-constructor').prop('disabled', true);
			if(chkValid([".id_card",".con-name",".con-tel",".con-type",".con-status",".con-address"])){
				if(chkDublicateName(objConstructor, '#id_card')){
					var _token = $("input[name=_token]").val();
					$.ajax({
						url :'{{url("constr/save")}}',
						type:'POST',
						data:$('.constructor-form').serialize(),
						success:function(data){
							if(data){
								$("#engineer").append($('<option></option>').val(data.id).text(data.id_card+' ('+data.name+')'+' - '+data.tel));
								$("#engineer").select2('val', data.id);
							}
							$('.constructor-modal').modal('hide');
							$('.button-submit-constructor').prop('disabled', false);
						},error:function(){
							$('.constructor-modal').modal('hide');
							$('.button-submit-constructor').prop('disabled', false);
						}
					});
				}else{
					$('.button-submit-constructor').prop('disabled', false);
					return false;
				}
			}else{
				$('.button-submit-constructor').prop('disabled', false);
				return false;
			}
		}

		$("#btnAddSubConstructor").on('click', function(event){
			$('.constructor-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#id_card').val('');
			$('#old_id_card').val('');
			$('#con-name').val('');
			$('#con-tel').val('');
			$('#con-type option[value!=1]').prop('disabled', false);
			$('#con-type option[value=1]').prop('disabled', true);
			$.fn.select2.defaults.set("theme", "classic");
			$('#con-type').select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
			$('#con-type').select2('val', null);
			$('#con-status').select2('val',1);
			$('#con-address').val('');
			$('.button-submit-constructor').attr('id','btnSaveSubConstructor').attr('name','btnSaveSubConstructor').attr('onclick','onSubmitSubConstructor(this)');
			$('.button-submit-constructor').html('{{trans("lang.save")}}');
			$('.constructor-modal').modal('show');
		});

		function onSubmitSubConstructor(field){
			$('.button-submit-constructor').prop('disabled', true);
			if(chkValid([".id_card",".con-name",".con-tel",".con-type",".con-status",".con-address"])){
				if(chkDublicateName(objConstructor, '#id_card')){
					var _token = $("input[name=_token]").val();
					$.ajax({
						url :'{{url("constr/save")}}',
						type:'POST',
						data:$('.constructor-form').serialize(),
						success:function(data){
							if(data){
								$("#sub_const").append($('<option></option>').val(data.id).text(data.id_card+' ('+data.name+')'+' - '+data.tel));
								$("#sub_const").select2('val', data.id);
							}
							$('.constructor-modal').modal('hide');
							$('.button-submit-constructor').prop('disabled', false);
						},error:function(){
							$('.constructor-modal').modal('hide');
							$('.button-submit-constructor').prop('disabled', false);
						}
					});
				}else{
					$('.button-submit-constructor').prop('disabled', false);
					return false;
				}
			}else{
				$('.button-submit-constructor').prop('disabled', false);
				return false;
			}
		}
	@endif

	$(document).ready(function(){
		$.fn.select2.defaults.set("theme", "classic");
		$(".engineer, .sub_const, .warehouse_id, .street_id, .house_id").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		
		$('#trans_date').val(formatDate('{{$obj->trans_date}}'));
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
		$("#reference_no").val('{{$obj->ref_no}}');
		$("#sub_const").select2('val','{{$obj->sub_return}}');
		$("#engineer").select2('val','{{$obj->eng_return}}');
		$("#reference").val('{{$obj->reference}}');
		$('#trans_desc').val(isNullToString('{{$obj->desc}}')+" ");
		
		if(jsonRecord = GetDetail('{{$obj->id}}')){
			jsonItems = jsonRecord;
			$.each(jsonRecord, function(key, val){
				initTable(val);
			});
		}
		
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
	});
</script>
@endsection()