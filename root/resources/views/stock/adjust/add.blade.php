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
													<input class="form-control reference_no" length="20" type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
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
											<textarea class="form-control trans_desc" id="desc" name="desc" length="100" placeholder="{{ trans('lang.enter_text') }}"> </textarea>
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
										<th width="15%" class="text-center all">{{ trans('lang.warehouse') }}</th>
										<th width="20%" class="text-center all">{{ trans('lang.items') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.units') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.qty_stock') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.qty_exactly') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.qty_adjust') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.note') }}</th>
										<th width="5%" class="text-center all"><i class='fa fa-plus btnAdd' id="btnAdd"></i></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"></div><br/>
					<div class="form-actions text-right">
						<button type="submit" id="save_close" name="save_close" value="1" class="btn green bold">{{trans('lang.save')}}</button>
						<button type="submit" id="save_new" name="save_new" value="2"  class="btn blue bold">{{trans('lang.save_new')}}</button>
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

	var jsonUnits = [];
	var jsonItems = [];
	
	function GetUnit(unit_stock) {
		return $.ajax({url:'{{url("/stock/deliv/GetUnit")}}',type:'GET',dataType:'json',data:{unit_stock:unit_stock},async:false}).responseJSON;
	}

	function GetItem(query) {
		return $.ajax({url:'{{url("/stock/use/GetItem")}}',type:'GET',dataType:'json',data:{q:query},async:false}).responseJSON;
	}

	var i = 1;
	function onRemove(field){
		$(field).parents('tr').remove();
		$("#table-income tbody tr").each(function(k){
			$(this).children("td").children(".line_index").val(lineNo((k+1),3));
			$(this).children("td").children("strong").text(lineNo((k+1),3));
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
		}
		return isValid;
	}

	$('#save_close,#save_new').on('click',function(){
		$(this).prop('disabled', true);
		if(chkValid([".reference_no",".trans_date",".reference",".trans_desc",".line_warehouse",".line_item",".line_unit",".line_qty_stock",".line_qty_exactly",".line_qty_adjust"])){
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
		var trans_date = $('#trans_date').val();
		if(val!=null && val!='' && trans_date!=null && trans_date!='' && jsonItems){

			$('.line_unit_'+row).empty();
			$('.line_unit_'+row).append($('<option></option>').val('').text(''));
			$('.line_unit_'+row).select2('val', null);
		}
	}
	
	function onChangeItem(field, row){
		var val = $(field).val();
		if(val!=null && val!='' && jsonItems){
			$.each(jsonItems.filter(c=>c.id==val), function(key, val){
				$('.line_unit_'+row).empty();
				$('.line_unit_'+row).append($('<option></option>').val('').text(''));
				jsonUnits = GetUnit(val.unit_stock);
				$.each(jsonUnits, function(k, v){
					$('.line_unit_'+row).append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
				});
				$('.line_unit_'+row).select2('val', val.unit_purch);
			});
		}
	}
	
	function onChangeUnit(field, row){
		var warehouse_id = $(".line_warehouse_"+row).val();
		var item_id = $(".line_item_"+row).val();
		var unit = $(field).val();
		var trans_date = $('#trans_date').val();
		if(warehouse_id!=null && warehouse_id!='' && item_id!=null && item_id!='' && unit!=null && unit!='' && trans_date!=null && trans_date!=''){
			var _token = $("input[name=_token]").val();
			$.ajax({
				url :'{{url("stock/adjust/remoteItem")}}',
				type:'POST',
				data:{
					'_token': _token,
					'warehouse_id':warehouse_id,
					'item_id':item_id,
					'unit':unit,
					'trans_date':trans_date,
				},
				success:function(qty){
					$('.line_qty_stock_'+row).val(qty);
				},error:function(){
					$('.line_qty_stock_'+row).val(0);
					console.log('error get qty stock.');
				}
			});
		}
		$(".line_qty_exactly_"+row).val('');
		$(".check_row_"+row).val(warehouse_id+"_"+item_id);
	}
	
	function enterExactlyQty(field, row){
		var warehouse_id = $(".line_warehouse_"+row).val();
		var item_id = $(".line_item_"+row).val();
		var unit = $(field).val();
		var exactly_qty = $(field).val();
		var stock_qty = $(".line_qty_stock_"+row).val();
		if(warehouse_id!=null && warehouse_id!='' && item_id!=null && item_id!='' && unit!=null && unit!='' && exactly_qty!=null && exactly_qty!='' && stock_qty!=null && stock_qty!=''){
			$(".line_qty_adjust_"+row).val((parseFloat(exactly_qty)-parseFloat(stock_qty)).toFixed('{{getSetting()->round_number}}'));
		}
	}

	$("#btnAdd").on('click',function(){
		var line_row = $("#table-income tbody tr").length;
		if(line_row<=99){
			$(".show-message-error").empty();
			$("#table-income tbody").append('<tr>'+
					'<td class="text-center all" style="vertical-align: middle !important;">'+
					'	<input type="hidden" class="line_index line_index_'+i+'" name="line_index[]" value="'+lineNo((line_row+1),3)+'" />'+
					'	<input type="hidden" class="check_row check_row_'+i+'" value="" />'+
					'	<strong>'+lineNo((line_row+1),3)+'</strong>'+
					'</td>'+
					'<td>'+
					'	<select class="form-control line_warehouse line_warehouse_'+i+'" onchange="onChangeWarehouse(this, '+i+')" name="line_warehouse[]">'+
					'		<option value=""></option>'+
					'		{{getWarehouse()}}'+
					'	</select>'+
					'</td>'+
					'<td>'+
					'	<select class="form-control line_item line_item_'+i+'" onchange="onChangeItem(this, '+i+')" name="line_item[]">'+
					'		<option value=""></option>'+
					'	</select>'+
					'</td>'+
					'<td>'+
					'	<select class="form-control line_unit line_unit_'+i+'" name="line_unit[]" onchange="onChangeUnit(this, '+i+')">'+
					'		<option value=""></option>'+
					'	</select>'+
					'</td>'+
					'<td>'+
					'	<input type="number" length="50" step="any" class="form-control line_qty_stock line_qty_stock_'+i+'" readonly name="line_qty_stock[]"/>'+
					'</td>'+
					'<td>'+
					'	<input type="number" length="50" step="any" class="form-control noscroll line_qty_exactly line_qty_exactly_'+i+'" onkeyup="enterExactlyQty(this, '+i+')" name="line_qty_exactly[]"/>'+
					'</td>'+
					'<td>'+
					'	<input type="number" length="50" step="any" class="form-control line_qty_adjust line_qty_adjust_'+i+'" readonly name="line_qty_adjust[]"/>'+
					'</td>'+
					'<td>'+
					'	<input type="text" length="100" class="form-control line_note line_note_'+i+'" name="line_note[]"/>'+
					'</td>'+
					'<td class="text-center all">'+
					'	<button type="button" class="btn btn-danger" onclick="onRemove(this)" title="{{trans("lang.delete")}}"><i class="fa fa-remove"></i></button>'+
					'</td>'+
				'</tr>');
			$.fn.select2.defaults.set("theme", "classic");
			$(".line_warehouse_"+i+",.line_unit_"+i).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
			$(".line_qty_stock_"+i+",.line_qty_exactly_"+i,".line_qty_adjust_"+i).ForceNumericOnly();

			var itemSelect = $('.line_item_'+i);
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
			        results: data.data,
			        more: (data.to < data.total),
			        page: (data.current_page + 1),
			        limit: data.per_page
			      };
			    }
			  }
			});

			i++;
		}else{
			$(".show-message-error").html('{{trans("lang.not_more_than_100")}}!');
		}
	});
	
	document.addEventListener("mousewheel", function(event){
		if(document.activeElement.type === "number" &&
		   document.activeElement.classList.contains("noscroll"))
		{
			document.activeElement.blur();
		}
	});
	
	$(document).ready(function(){
		$('#trans_date').val(formatDate('{{date('Y-m-d')}}'));
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
		
		$('#btnAdd').trigger('click');

		$('#trans_date').on('change', function(){
			$('.line_note, .line_qty_adjust, .line_qty_exactly').val('');
			$('.line_qty_stock').val(0);

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
			$('.line_warehouse').each(function(){
				$(this).select2('val', null);
			});
		});
		
		setInterval(function() {
			$.ajax({
				url :'{{url("prefix/gen/ADJ/StockAdjust/ref_no")}}',
				type:'get',
				success:function(data){
					if(data!=null && data!=''){
						$('#reference_no').attr("readonly", true);
						$('#reference_no').val(data);
					}else{
						$('#reference_no').attr("readonly", false);
						$('#reference_no').val('');
					}
				},error:function(){}
			});
		}, 3000);
	});
</script>
@endsection()