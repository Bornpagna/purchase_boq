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
													<input class="form-control reference_no" length="20" type="text" id="reference_no" readonly name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
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
													<input class="form-control reference"​​ length="100" type="text" id="reference" name="reference" placeholder="{{ trans('lang.enter_text') }}">
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
											<textarea class="form-control trans_desc" id="trans_desc" name="desc" length="100" placeholder="{{ trans('lang.enter_text') }}"> </textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-striped table-bordered table-hover" width="100%" id="table-income">
								<thead>
									<tr style="font-size:12px;">
										<th width="5%" class="text-center all">{{ trans('lang.line_no') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.from_warehouse') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.to_warehouse') }}</th>
										<th width="25%" class="text-center all">{{ trans('lang.items') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.units') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.qty') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.note') }}</th>
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
<!-- Modal Varian -->
@endsection()

@section('javascript')
<script type="text/javascript">	
	var jsonWarehouse = JSON.parse(convertQuot("{{\App\Model\Warehouse::where(['status'=>1,'pro_id'=>$pro_id])->get(['id','name'])}}"));
	var jsonUnits = JSON.parse(convertQuot("{{\App\Model\Unit::get(['id','from_code','from_desc','to_code','to_desc','factor','status'])}}"));
	var jsonItems = JSON.parse(convertQuot("{{\App\Model\Item::where('status',1)->get(['id','code','name','unit_purch','unit_stock'])}}"));
	var jsonRecord = JSON.parse(convertQuot("{{\App\Model\StockMoveDetails::where(['move_id'=>$obj->id,'delete'=>0])->get(['id','move_id','from_warehouse_id','to_warehouse_id','line_no','item_id','unit','qty','stock_qty','note'])}}"));

	var option = '';
	if(jsonItems){
		$.each(jsonItems, function(key ,val){
			option += '<option value="'+val.id+'">'+val.code+' ('+val.name+')</option>';
		});
	}

	var option2 = '';
	if(jsonWarehouse){
		$.each(jsonWarehouse, function(key ,val){
			option2 += '<option value="'+val.id+'">'+val.name+')</option>';
		});
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
			$(".line_move_qty").each(function(){
				var stock_qty = $(this).next().val();
				var move_qty = $(this).val();
				if(parseFloat(move_qty) > parseFloat(stock_qty)){
					isValid = false;
					$(this).css('border','1px solid #e43a45');
					$(".show-message-error").html('{{trans("lang.greater_than_stock_qty")}}!');
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
		if(chkValid([".reference_no",".trans_date",".reference",".trans_desc",".line_from_warehouse",".line_to_warehouse",".line_item",".line_unit",".line_move_qty"])){
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
	
	function onChangeWarehouse(field, row){
		var val = $(field).val();
		if(val!=null && val!='' && jsonItems && jsonWarehouse){
			$('.line_item_'+row).empty();
			$('.line_item_'+row).append($('<option></option>').val('').text(''));
			$('.line_item_'+row).select2('val', null);
			$('.line_item_'+row).append(option);

			$('.line_unit_'+row).empty();
			$('.line_unit_'+row).append($('<option></option>').val('').text(''));
			$('.line_unit_'+row).select2('val', null);
			
			$('.line_to_warehouse_'+row).empty();
			$('.line_to_warehouse_'+row).append($('<option></option>').val('').text(''));
			$('.line_to_warehouse_'+row).select2('val', null);
			$.each(jsonWarehouse.filter(c=>c.id!=val), function(key ,value){
				$('.line_to_warehouse_'+row).append($('<option></option>').val(value.id).text(value.name));
			});
		}
	}
	
	function onChangeItem(field, row){
		var val = $(field).val();
		if(val!=null && val!='' && jsonUnits && jsonItems){
			$.each(jsonItems.filter(c=>c.id==val), function(key, val){
				$('.line_unit_'+row).empty();
				$('.line_unit_'+row).append($('<option></option>').val('').text(''));
				$.each(jsonUnits.filter(d=>d.to_code==val.unit_stock), function(k, v){
					$('.line_unit_'+row).append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
				});
				$('.line_unit_'+row).select2('val', val.unit_purch);
			});
		}
	}
	
	function onChangeUnit(field, row, old_qty){
		var from_warehouse_id = $(".line_from_warehouse_"+row).val();
		var trans_date = $(".trans_date").val();
		var to_warehouse_id = $(".line_to_warehouse_"+row).val();
		var item_id = $(".line_item_"+row).val();
		var unit = $(field).val();
		if(from_warehouse_id!=null && from_warehouse_id!='' && item_id!=null && item_id!='' && unit!=null && unit!=''){
			var _token = $("input[name=_token]").val();
			$.ajax({
				url :'{{url("stock/adjust/remoteItem")}}',
				type:'POST',
				data:{
					'_token': _token,
					'warehouse_id':from_warehouse_id,
					'item_id':item_id,
					'unit':unit,
					'trans_date':trans_date,
				},
				success:function(qty){
					$('.line_stock_qty_'+row).val(parseFloat(qty) + parseFloat(old_qty));
				},error:function(){
					$('.line_stock_qty_'+row).val(0);
					console.log('error get qty stock.');
				}
			});
		}
		$(".line_move_qty_"+row).val('');
		$(".check_row_"+row).val(from_warehouse_id+"_"+to_warehouse_id+"_"+item_id);
	}
	
	function enterQtyMove(field, row){
		var stock_qty = $(".line_stock_qty_"+row).val();
		var move_qty = $(field).val();
		if(stock_qty!=null && stock_qty!='' && move_qty!=null && move_qty!='' && parseFloat(move_qty) > parseFloat(stock_qty)){
			$(field).css('border','1px solid #e43a45');
			$(".show-message-error").html('{{trans("lang.greater_than_stock_qty")}}!');
		}else{
			$(field).css('border','1px solid #c2cad8');
			$(".show-message-error").empty();
		}
	}
	
	function initTable(data){
		$("#table-income tbody").append('<tr>'+
				'<td class="text-center all" style="vertical-align: middle !important;">'+
				'	<input type="hidden" class="line_index line_index_'+data.id+'" name="line_index[]" value="'+data.line_no+'" />'+
				'	<input type="hidden" class="check_row check_row_'+data.id+'" value="'+data.from_warehouse_id+'_'+data.to_warehouse_id+'_'+data.item_id+'" />'+
				'	<strong>'+data.line_no+'</strong>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_from_warehouse line_from_warehouse_'+data.id+'" onchange="onChangeWarehouse(this, '+data.id+')" name="line_from_warehouse[]">'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_to_warehouse line_to_warehouse_'+data.id+'" name="line_to_warehouse[]">'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_item line_item_'+data.id+'" onchange="onChangeItem(this, '+data.id+')" name="line_item[]">'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<select class="form-control line_unit line_unit_'+data.id+'" name="line_unit[]">'+
				'		<option value=""></option>'+
				'	</select>'+
				'</td>'+
				'<td>'+
				'	<input type="number" length="50" step="any" class="form-control line_move_qty line_move_qty_'+data.id+'" name="line_move_qty[]" onkeyup="enterQtyMove(this, '+data.id+')" />'+
				'	<input type="hidden" class="form-control line_stock_qty line_stock_qty_'+data.id+'" name="line_stock_qty[]"/>'+
				'</td>'+
				'<td>'+
				'	<input type="text" length="100" class="form-control line_note line_note_'+data.id+'" name="line_note[]"/>'+
				'</td>'+
			'</tr>');

		$.fn.select2.defaults.set("theme", "classic");
		$(".line_to_warehouse_"+data.id+",.line_from_warehouse_"+data.id+",.line_unit_"+data.id+",.line_item_"+data.id).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		
		$(".line_move_qty_"+data.id).ForceNumericOnly();
		$(".line_from_warehouse_"+data.id).append(option2);
		$(".line_from_warehouse_"+data.id).select2('val', data.from_warehouse_id);

		$(".line_to_warehouse_"+data.id).select2('val', data.to_warehouse_id);
		$('.line_item_'+data.id).select2('val', data.item_id);
		$('.line_unit_'+data.id).select2('val', data.unit);
		
		$(".line_move_qty_"+data.id).val(data.qty);
		$(".line_stock_qty_"+data.id).val(data.stock_qty);
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
	
	$(document).ready(function(){
		$('#trans_date').val(formatDate('{{$obj->trans_date}}'));
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});

		$("#reference_no").val('{{$obj->ref_no}}');
		$("#reference").val('{{$obj->reference}}');
		$('#trans_desc').val(isNullToString('{{$obj->desc}}')+" ");

		$('#trans_date').on('change', function(){
			$('.line_move_qty, .line_stock_qty, .line_note').val('');

			$('.line_unit').each(function(){
				$(this).empty();
				$(this).append($('<option></option>').val('').text(''));
				$(this).select2('val', null);
			});
			$('.line_item').each(function(){
				$(this).empty();
				$(this).append($('<option></option>').val('').text(''));
				$(this).select2('val', null);
			});
			$('.line_to_warehouse').each(function(){
				$(this).empty();
				$(this).append($('<option></option>').val('').text(''));
				$(this).select2('val', null);
			});
			$('.line_from_warehouse').each(function(){
				$(this).select2('val', null);
			});
		});
		
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
		
		if(jsonRecord){
			$.each(jsonRecord, function(key, val){
				initTable(val);
			});
		}
	});
</script>
@endsection()