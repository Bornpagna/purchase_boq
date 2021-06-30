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
					
					<div class="row">
						<!-- Reference No -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="reference_no" class="control-label"><strong>{{ trans('lang.reference_no') }}</strong>
									<span class="required"> * </span>
								</label>
								<!-- Input -->
								<input class="form-control reference_no" length="20" type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Date -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="trans_date" class="control-label"><strong>{{ trans('lang.date') }}</strong>
									<span class="required"> * </span>
								</label>
								<!-- Input -->
								<input class="form-control trans_date" length="10" type="text" id="trans_date" name="trans_date" placeholder="{{ trans('lang.enter_text') }}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Delivery Date -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="delivery_date" class="control-label"><strong>{{ trans('lang.delivery_date') }}</strong>
									<span class="required"> * </span>
								</label>
								<!-- Input -->
								<input class="form-control delivery_date" length="10" type="text" id="delivery_date" name="delivery_date" placeholder="{{ trans('lang.enter_text') }}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Department -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="department" class="control-label"><strong>{{ trans('lang.department') }}</strong>
									<span class="required"> * </span>
								</label>
								<!-- Select -->
								@if(hasRole('department_add'))
									<div class="input-group">
										<select class="form-control select2 department" name="department" id="department">
											<option value=""></option>
											{{getSystemData('DP')}}
										</select>
										<span class="input-group-addon btn blue" id="btnAddDepartment">
											<i class="fa fa-plus"></i>
										</span>
									</div>
								@else
									<select class="form-control select2 department" name="department" id="department">
										<option value=""></option>
										{{getSystemData('DP')}}
									</select>
								@endif
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Request By -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="request_by" class="control-label" style="text-align: left;"><strong>{{ trans('lang.request_by') }}</strong>
									<span class="required"> * </span>
								</label>
								<!-- Select -->
								@if(hasRole('constructor_add'))
									<div class="input-group">
										<select class="form-control select2 request_by" name="request_by" id="request_by">
											<option value=""></option>
											{{getConstructor([1,2,3,4,5])}}
										</select>
										<span class="input-group-addon btn blue" id="btnAddConstructor">
											<i class="fa fa-plus"></i>
										</span>
									</div>
								@else
									<select class="form-control select2 request_by" name="request_by" id="request_by">
										<option value=""></option>
										{{getConstructor([1,2,3,4,5])}}
									</select>
								@endif
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Status -->
						<div class="col-md-4">
							<div class="form-group">
								<!-- Label -->
								<label for="status" class="control-label" style="text-align: left;"><strong>{{ trans('lang.status') }}</strong></label>
								<!-- Select -->
								<select class="form-control select2 status" name="status" id="status">
									<option value="1" selected>{{trans('lang.pending')}}</option>
									<option value="5">{{trans('lang.draft')}}</option>
								</select>
							</div>
						</div>
						<!-- Note -->
						<div class="col-md-12">
							<div class="form-group">
								<!-- Label -->
								<label for="status" class="control-label" style="text-align: left;"><strong>{{ trans('lang.note') }}</strong></label>
								<!-- Textarea -->
								<textarea class="form-control trans_desc" id="trans_desc" name="desc" length="100" rows="8" placeholder="{{ trans('lang.enter_text') }}"></textarea>
							</div>
						</div>
					</div>

					<div class="portlet-body">
						<div class="table-scrollable">
							<table class="table table-striped table-bordered table-hover" width="100%" id="table-income">
								<thead>
									<tr style="font-size:12px;">
										<th width="5%" class="text-center all">{{ trans('lang.line_no') }}</th>
										<th width="20%" class="text-center all">{{ trans('lang.items') }}</th>
										<th width="10%" class="text-center all">{{ trans('lang.size') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.units') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.qty') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.note') }}</th>
										<th width="15%" class="text-center all">{{ trans('lang.remark') }}</th>
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
@include('modal.modal')
@include('modal.constructor')

@endsection()

@section('javascript')
<script type="text/javascript">	
	var jsonUnits = [];
	var jsonItems = [];
	var jsonRef   = JSON.parse(convertQuot("{{\App\Model\Request::where('pro_id','=',Session::get('project'))->where('trans_status','!=',0)->get(['ref_no'])}}"));
	
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
			$(".line_qty").each(function(){
				var boq_set = $(this).next().val();
				var qty = $(this).val();
				
				/* if(parseFloat(boq_set) < 0){
					isValid = false;
					$(this).css('border','1px solid #e43a45');
					$(".show-message-error").html('{{trans("lang.boq_is_not_set")}}!');
				}else  */
				
				if(parseFloat(boq_set) !=-1 && parseFloat(qty) > parseFloat(boq_set)){
					isValid = false;
					$(this).css('border','1px solid #e43a45');
					$(".show-message-error").html('{{trans("lang.greater_then_boq")}}!');
				}else{
					$(this).css('border','1px solid #c2cad8');
					$(".show-message-error").empty();
				}
			});
		}
		return isValid;
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

	$('#save_close,#save_new').on('click',function(){
		$(this).prop('disabled', true);
		if(chkValid([".reference_no",".trans_date",".department",".delivery_date",".request_by",".line_item",".line_unit",".line_qty"])){
			if(isSave()){
				if (chkDublicateRef(jsonRef, '#reference_no')) {
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
		}else{
			$(this).prop('disabled', false);
			return false;
		}
	});
	
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
				@if(!isset($head))
					$('.line_unit_'+row).select2('val', val.unit_purch);
				@endif
			});
		}
	}

	function onChangeUnit(field, row){
		var item_id = $(".line_item_"+row).val();
		var unit = $(field).val();
		if(item_id!=null && item_id!='' && unit!=null && unit!=''){
			var _token = $("input[name=_token]").val();
			$.ajax({
				url :'{{url("purch/request/remoteItem")}}',
				type:'POST',
				async:false,
				data:{
					'_token': _token,
					'item_id':item_id,
					'unit':unit,
				},
				success:function(data){
					$('.line_boq_set_'+row).val(data.boq_set);
					$('.line_price_'+row).val(data.price);
				},error:function(){
					$('.line_boq_set_'+row).val(0);
					$('.line_price_'+row).val(0);
					console.log('error get qty stock.');
				}
			});
		}
		$(".line_return_qty_"+row).val('');
		$(".check_row_"+row).val(item_id+"_"+unit);
	}	
	
	function enterQtyRequest(field, row){
		var boq_set = $(".line_boq_set_"+row).val();
		var request_qty = $(field).val();
		if(boq_set!=null && boq_set!='' && request_qty!=null && request_qty!=''){
			/* if(parseFloat(boq_set) < 0){
				$(this).css('border','1px solid #e43a45');
				$(".show-message-error").html('{{trans("lang.boq_is_not_set")}}!');
			}else */ 
			
			if(parseFloat(boq_set) !=-1 && parseFloat(request_qty) > parseFloat(boq_set)){
				$(this).css('border','1px solid #e43a45');
				$(".show-message-error").html('{{trans("lang.greater_then_boq")}}!');
			}else{
				$(field).css('border','1px solid #c2cad8');
				$(".show-message-error").empty();
			}
		}else{
			$(field).css('border','1px solid #c2cad8');
			$(".show-message-error").empty();
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
					'	<select class="form-control line_item line_item_'+i+'" onchange="onChangeItem(this, '+i+')" name="line_item[]">'+
					'		<option value=""></option>'+
					'	</select>'+
					'</td>'+
					'<td>'+
					'	<input type="text" length="100" class="form-control line_size line_size_'+i+'" name="line_size[]" placeholder="{{trans('lang.enter_text')}}"/>'+
					'</td>'+
					'<td>'+
					'	<select class="form-control line_unit line_unit_'+i+'" onchange="onChangeUnit(this, '+i+')" name="line_unit[]">'+
					'		<option value=""></option>'+
					'	</select>'+
					'</td>'+
					'<td>'+
					'	<input type="number" length="50" step="any" class="form-control noscroll line_qty line_qty_'+i+'" onkeyup="enterQtyRequest(this, '+i+')"  name="line_qty[]" placeholder="{{trans('lang.enter_text')}}"/>'+
					'	<input type="hidden" class="form-control line_boq_set line_boq_set_'+i+'" name="line_boq_set[]"/>'+
					'	<input type="hidden" class="form-control line_price line_price_'+i+'" name="line_price[]"/>'+
					'</td>'+
					'<td>'+
					'	<input type="text" length="100" class="form-control line_reference line_reference_'+i+'" name="line_reference[]" placeholder="{{trans('lang.enter_text')}}"/>'+
					'</td>'+
					'<td>'+
					'	<input type="text" length="100" class="form-control line_remark line_remark_'+i+'" name="line_remark[]" placeholder="{{trans('lang.enter_text')}}"/>'+
					'</td>'+
					'<td class="text-center all">'+
					'	<button type="button" class="btn btn-danger" onclick="onRemove(this)" title="{{trans("lang.delete")}}"><i class="fa fa-remove"></i></button>'+
					'</td>'+
				'</tr>');
			$(".line_unit_"+i).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
			$(".line_qty_"+i).ForceNumericOnly();
			
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

	@if(hasRole('department_add'))
		var objDepartment = JSON.parse(convertQuot('{{\App\Model\SystemData::where(["type"=>"DP","parent_id"=>Session::get('project')])->get(["name"])}}'));
		$("#btnAddDepartment").on('click', function(event){
			event.preventDefault();
			$('.system-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#sys-name').val('');
			$('#old_name').val('');
			$('#sys-desc').val('');
			$('.button-submit').attr('id','btnSaveDepartment').attr('name','btnSaveDepartment').attr('onclick','onSubmitDepartment(this)');
			$('.button-submit').html('{{trans("lang.save")}}');
			$('.system-modal').modal('show');
		});

		function onSubmitDepartment(field){
			$('.button-submit').prop('disabled', true);
			if(chkValid([".sys-name",".sys-desc"])){
				if(chkDublicateName(objDepartment, '#sys-name')){
					var _token = $("input[name=_token]").val();
					$.ajax({
						url :'{{url("depart/save")}}',
						type:'POST',
						data:{
							'_token': _token,
							'name': $('#sys-name').val(),
							'desc': $('#sys-desc').val(),
						},
						success:function(data){
							if(data){
								$("#department").append($('<option></option>').val(data.id).text(data.name));
								$("#department").select2('val', data.id);
							}
							$('.system-modal').modal('hide');
							$('.button-submit').prop('disabled', false);
						},error:function(){
							$('.system-modal').modal('hide');
							$('.button-submit').prop('disabled', false);
						}
					});
				}else{
					$('.button-submit').prop('disabled', false);
					return false;
				}
			}else{
				$('.button-submit').prop('disabled', false);
				return false;
			}
		}
	@endif

	@if(hasRole('constructor_add'))
		var objConstructor = JSON.parse(convertQuot('{{\App\Model\Constructor::get(["name","id_card"])}}'));
		$("#btnAddConstructor").on('click', function(event){
			event.preventDefault();
			$('.constructor-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#id_card').val('');
			$('#old_id_card').val('');
			$('#con-name').val('');
			$('#con-tel').val('');
			$('#con-type').select2('val',null);
			$('#con-status').select2('val',1);
			$('#con-address').val('');
			$('.button-submit-constructor').attr('id','btnSaveConstructor').attr('name','btnSaveConstructor').attr('onclick','onSubmitConstructor(this)');
			$('.button-submit-constructor').html('{{trans("lang.save")}}');
			$('.constructor-modal').modal('show');
		});

		function onSubmitConstructor(field){
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
								$("#request_by").append($('<option></option>').val(data.id).text(data.id_card+' ('+data.name+')'+' - '+data.tel));
								$("#request_by").select2('val', data.id);
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
		$('.select2').select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
		$('#trans_date,.delivery_date').val(formatDate('{{date('Y-m-d')}}'));
		
		$("#trans_date,.delivery_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
		$("#reference_no").on('change', function(){
	    	chkDublicateRef(jsonRef, '#reference_no');
	    });
		@if(isset($head) && count($body) > 0)
			$(".trans_desc").val('{{$head->note}}');
			$(".department").val('{{$head->dep_id}}');
			$(".trans_date").val(formatDate('{{$head->trans_date}}'));
			$(".delivery_date").val(formatDate('{{$head->delivery_date}}'));
			$(".request_by").select2('val','{{$head->request_by}}');
			@foreach($body as $row)
				$('#btnAdd').trigger('click');
				$(".line_item_"+(i-1)).select2('val', '{{$row->item_id}}');
				$(".line_qty_"+(i-1)).val('{{$row->qty}}');
				$(".line_reference_"+(i-1)).val('{{$row->desc}}');
				$(".line_size_"+(i-1)).val('{{$row->size}}');
				$(".line_remark_"+(i-1)).val('{{$row->remark}}');
				$(".line_unit_"+(i-1)).select2('val', '{{$row->unit}}');
			@endforeach
		@else
			$('#btnAdd').trigger('click');
		@endif
		
		/* setInterval(function() {
			$.ajax({
				url :'{{url("prefix/gen/PR/Request/ref_no")}}',
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
		}, 3000); */
	});
</script>
@endsection()