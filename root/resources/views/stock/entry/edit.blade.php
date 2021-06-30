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
						<span class="show-message-error-boq center font-red bold"></span>
					</div>
				</div>
				<form action="{{$rounteSave}}" method="POST" id="form-stock-entry" class="form-horizontal" enctype="multipart/form-data">
					{{csrf_field()}}
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
													<input class="form-control reference_no" readonly length="20" type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
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
												<label for="supplier" class="col-md-4 control-label"><strong>{{ trans('lang.supplier') }}</strong>
													<span class="required"> * </span>
												</label>
												<div class="col-md-8">
													@if(hasRole('supplier_add'))
														<div class="input-group">
															<select class="form-control supplier" name="supplier" id="supplier">
																<option value=""></option>
																{{getSuppliers()}}
															</select>
															<span class="input-group-addon btn blue" id="btnAddSupplier">
																<i class="fa fa-plus"></i>
															</span>
														</div>
													@else
														<select class="form-control supplier" name="supplier" id="supplier">
															<option value=""></option>
															{{getSuppliers()}}
														</select>
													@endif
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
<<<<<<< HEAD
									<tr class="bg-primary" style="font-size:12px;">
										<th width="7%" class="text-center all">{{ trans('lang.line_no') }}</th>
										<th width="13%" class="text-center all">{{ trans('lang.warehouse') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.items') }}</th>
=======
									<tr style="font-size:12px;">
										<th width="5%" class="text-center all">{{ trans('lang.line_no') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.warehouse') }}</th>
										<th width="25%" class="text-center all">{{ trans('lang.items') }}</th>
>>>>>>> update ui
										<th width="15%" class="text-center all">{{ trans('lang.units') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.qty') }}</th>
										@if(getSetting()->is_costing==1)
										<th width="15%" class="text-center all">{{ trans('lang.cost') }}</th>
										@endif
										<th width="15%" class="text-center all">{{ trans('lang.reference') }}</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"></div><br/>
					<div class="form-actions text-right">
						<button type="submit" id="save_close" value="1" class="btn green bold">{{trans('lang.save_change')}}</button>
						<a class="btn red bold" rounte="{{$rounteBack}}" id="btnCancel">{{trans('lang.cancel')}}</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('modal.supplier')
@endsection()

@section('javascript')
<script type="text/javascript">	

	var jsonUnits  = [];
	var jsonItems  = [];
	var jsonRecord = [];

	function GetUnit(unit_stock) {
		return $.ajax({url:'{{url("/stock/deliv/GetUnit")}}',type:'GET',dataType:'json',data:{unit_stock:unit_stock},async:false}).responseJSON;
	}

	function GetItem(query) {
		return $.ajax({url:'{{url("/stock/use/GetItem")}}',type:'GET',dataType:'json',data:{q:query},async:false}).responseJSON;
	}

	function GetDetail(id,code) {
		return $.ajax({url:'{{url("/stock/entry/GetDetail")}}',type:'GET',dataType:'json',data:{id:id,code:code},async:false}).responseJSON;
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

	$('#save_close').on('click',function(){
		$(this).prop('disabled', true);
		if(chkValid([".reference_no",".trans_date",".supplier",".trans_desc",".line_warehouse",".line_item",".line_unit",".line_qty",".line_cost"])){
			$('#form-stock-entry').submit();
		}else{
			$(this).prop('disabled', false);
			return false;
		}
	});
	
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
				$('.line_unit_'+row).select2('val', val.unit_purch);
			});
		}
	}
	
	function initTable(data){

		var str = "";

		str += '<tr>';
		str += '<td class="text-center all" style="vertical-align: middle !important;">';
		str += '<input type="hidden" class="line_index line_index_'+data.id+'" name="line_index[]" value="'+data.line_no+'" />';
		str += '<strong>'+data.line_no+'</strong>';
		str += '</td>';
		str += '<td>';
		str += '<select class="form-control line_warehouse line_warehouse_'+data.id+'" name="line_warehouse[]">';
		str += '<option value=""></option>';
		str += '{{getWarehouse()}}';
		str += '</select>';
		str += '</td>';
		str += '<td>';
		str += '<select class="form-control line_item line_item_'+data.id+'" onchange="onChangeItem(this, '+data.id+')" name="line_item[]">';
		str += '<<option value=""></option>';
		str += '</select>';
		str += '</td>';
		str += '<td>';
		str += '<select class="form-control line_unit line_unit_'+data.id+'" name="line_unit[]">';
		str += '<option value=""></option>';
		str += '</select>';
		str += '</td>';
		str += '<td>';
		str += '<input type="number" length="50" step="any" class="form-control noscroll line_qty line_qty_'+data.id+'" value="'+data.qty+'" name="line_qty[]"/>';
		str += '</td>';
		if (parseInt("{{getSetting()->is_costing}}")==1) {
			str += '<td>';
			str += '<input type="number" length="50" step="any" class="form-control noscroll line_cost line_cost_'+data.id+'" name="line_cost[]" value="'+data.cost+'"/>';
			str += '</td>';
		}
		str += '<td>';
		str += '<input type="text" length="100" class="form-control line_reference line_reference_'+data.id+'" name="line_reference[]" value="'+isNullToString(data.reference)+'"/>';
		str += '</td>';
		str += '</tr>';

		$("#table-income tbody").append(str);
		$.fn.select2.defaults.set("theme", "classic");
		$(".line_warehouse_"+data.id+",.line_unit_"+data.id).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		$(".line_qty_"+data.id).ForceNumericOnly();

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
		
		$(".line_warehouse_"+data.id).select2('val', data.warehouse_id);
		if(jsonItems){
			$.each(jsonItems, function(key ,val){
				$('.line_item_'+data.id).append($('<option></option>').val(val.id).text(val.code+' ('+val.name+')'));
			});
		}
		$('.line_item_'+data.id).select2('val', data.item_id);
		$('.line_unit_'+data.id).select2('val', data.unit);
	}
	
	document.addEventListener("mousewheel", function(event){
		if(document.activeElement.type === "number" &&
		   document.activeElement.classList.contains("noscroll"))
		{
			document.activeElement.blur();
		}
	});

	@if(hasRole('supplier_add'))
		var objSupplier = JSON.parse(convertQuot('{{\App\Model\Supplier::get(["name","desc"])}}'));
		$("#btnAddSupplier").on('click', function(event){
			event.preventDefault();
			$('.supplier-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#old_name').val('');
			$('#sup-name').val('');
			$('.tel').val('N/A');
			$('.status').select2('val',1);
			$('#sup-desc').val(' ');
			$('.address').val('N/A');
			$('.button-submit-supplier').attr('id','btnSave').attr('name','btnSave').attr('onclick','onSubmitSupplier(this)');
			$('.button-submit-supplier').html('{{trans("lang.save")}}');
			$('.supplier-modal').modal('show');
		});

		function onSubmitSupplier(field){
			$('.button-submit-supplier').prop('disabled', true);
			if(chkValid([".sup-name",".sup-desc"])){
				if(chkDublicateName(objSupplier, '#sup-name')){
					$.ajax({
						url :'{{url("supplier/save")}}',
						type:'POST',
						data:$('.supplier-form').serialize(),
						success:function(data){
							if(data){
								$("#supplier").append($('<option></option>').val(data.id).text(data.name+' ('+data.desc+')'));
								$("#supplier").select2('val', data.id);
							}
							$('.supplier-modal').modal('hide');
							$('.button-submit-supplier').prop('disabled', false);
						},error:function(){
							$('.supplier-modal').modal('hide');
							$('.button-submit-supplier').prop('disabled', false);
						}
					});
				}else{
					$('.button-submit-supplier').prop('disabled', false);
					return false;
				}
			}else{
				$('.button-submit-supplier').prop('disabled', false);
				return false;
			}
		}
	@endif
	
	$(document).ready(function(){
		$.fn.select2.defaults.set("theme", "classic");
		$('.supplier').select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		
		$('#reference_no').val('{{$obj->ref_no}}');
		$('#trans_date').val(formatDate('{{$obj->trans_date}}'));
		$('#supplier').select2('val','{{$obj->sup_id}}');
		$('#trans_desc').val(isNullToString(('{{$obj->desc}}'))+" ");
		if(jsonRecord = GetDetail('{{$obj->id}}','{{$obj->ref_no}}')){
			jsonItems = jsonRecord;
			$.each(jsonRecord, function(key, val){
				initTable(val);
			});
		}
		
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
		
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
	});
</script>
@endsection()