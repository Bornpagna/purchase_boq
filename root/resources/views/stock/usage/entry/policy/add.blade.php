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
    .form-message{
        background-color: antiquewhite !important;
        color: red !important;
    }
    .out-stock{background-color: #03a9f4 !important;}
    .out-boq{background-color: #ffeb3b !important;}
    .not-set-boq{background-color: #9c74e4 !important;}
    .invalid{background-color: #ff7065 !important;}
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
                            <!-- REFERENCE NO -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reference_no" class="control-label"><strong>{{ trans('lang.reference_no') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    <input class="form-control reference_no" length="20" type="text" id="reference_no" name="reference_no" placeholder="{{ trans('lang.enter_text') }}">
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- TRANS DATE -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="trans_date" class="control-label"><strong>{{ trans('lang.trans_date') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    <input class="form-control trans_date" length="10" type="text" id="trans_date" name="trans_date" placeholder="{{ trans('lang.enter_text') }}">
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- REFERENCE -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reference" class="control-label"><strong>{{ trans('lang.reference') }}</strong></label>
                                    <input class="form-control reference"​​ length="100" type="text" id="reference" name="reference" placeholder="{{ trans('lang.enter_text') }}">
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- Engineer -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="engineer" class="control-label" style="text-align: left;"><strong>{{ trans('lang.engineer') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    @if(hasRole('constructor_add'))
                                    <div class="input-group">
                                        <select class="form-control select2 engineer" name="engineer" id="engineer">
                                            
                                        </select>
                                        <span class="input-group-addon btn blue" id="btnAddEngineer">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    @else
                                    <select class="form-control select2 engineer" name="engineer" id="engineer">
                                    </select>
                                    @endif
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- Subcontractor -->
                            @if(getSetting()->usage_constructor==1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sub_const" class="control-label" style="text-align: left;"><strong>{{ trans('lang.sub_const') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    @if(hasRole('constructor_add'))
                                    <div class="input-group">
                                        <select class="form-control select2 sub_const" name="sub_const" id="sub_const">
                                        </select>
                                        <span class="input-group-addon btn blue" id="btnAddSubConstructor">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    @else
                                    <select class="form-control select2 sub_const" name="sub_const" id="sub_const">
                                    </select>
                                    @endif
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            @endif
                            <!-- Warehouse -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label" style="text-align: left;"><strong>{{ trans('lang.warehouse') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    @if(hasRole('warehouse_add'))
                                    <div class="input-group">
                                        <select class="form-control select2 warehouse_id" id="warehouse_id" name="warehouse_id">
                                           
                                        </select>
                                        <span class="input-group-addon btn blue" id="btnAddWarehouse">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    @else
                                    <select class="form-control select2 warehouse_id" id="warehouse_id" name="warehouse_id">
                                    </select>
                                    @endif
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- Zone -->
                            @if(getSetting()->allow_zone == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="zone_id" class="control-label" style="text-align: left;"><strong>{{ trans('lang.zone') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    <select class="form-control select2 zone_id" id="zone_id" name="zone_id">
                                    </select>
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            @endif
                            <!-- Block -->
                            @if(getSetting()->allow_block == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="block_id" class="control-label" style="text-align: left;"><strong>{{ trans('lang.block') }}</strong>
                                        <span class="required"> * </span>
                                    </label>
                                    <select class="form-control select2 block_id" id="block_id" name="block_id">
                                    </select>
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            @endif
                            <!-- Street -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street_id" class="control-label"><strong>{{ trans('lang.street') }}</strong></label>
                                    <select class="form-control select2 street_id" name="street_id">
                                        
                                    </select>
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- House -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="house_id" class="control-label"><strong>{{ trans('lang.house') }}</strong></label>
                                    <select class="form-control select2 house_id" name="house_id">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block font-red bold"></span>
                                </div>
                            </div>
                            <!-- Note -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="trans_desc" class="control-label"><strong>{{ trans('lang.note') }}</strong></label>
                                    <textarea class="form-control trans_desc" id="trans_desc" name="desc" rows="7" length="100" placeholder="{{ trans('lang.enter_text') }}"> </textarea>
                                </div>
                            </div>
                            <!-- Note Row color -->
                            <div class="col-md-12">
                                <label for="trans_desc" class="control-label"><strong>{{ trans('lang.status') }}</strong></label>
                                <table style="height: 40px !important;" class="table table-striped table-bordered" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="4%" class="out-stock"></td>
                                            <td width="21%">{{trans("lang.out_of_stock")}}</td>
                                            <td width="4%" class="out-boq"></td>
                                            <td width="21%">{{trans("lang.out_of_boq")}}</td>
                                            <td width="4%" class="not-set-boq"></td>
                                            <td width="21%">{{trans("lang.not_set_boq")}}</td>
                                            <td width="4%" style="background-color: white !important;"></td>
                                            <td width="21%">{{trans("lang.normal")}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Error Message -->
                            <div class="col-md-12">
                                <ul class="form-message"></ul>
                            </div>
                        </div>
					</div>
                    <!-- Table Submit Item -->
					<div class="portlet-body">
                        <table class="table table-striped table-responsive table-bordered table-hover" width="100%" id="table-income">
                            <thead>
                                <tr style="font-size:12px;">
                                    <th width="5%" class="text-center all">{{ trans('lang.line_no') }}</th>
                                    <th width="30%" class="text-center all">{{ trans('lang.items') }}</th>
                                    <th width="15%" class="text-center all">{{ trans('lang.boq') }}</th>
                                    <th width="15%" class="text-center all">{{ trans('lang.stock') }}</th>
                                    <th width="15%" class="text-center all">{{ trans('lang.qty') }}</th>
                                    <th width="15%" class="text-center all">{{ trans('lang.units') }}</th>
                                    <th width="5%" class="text-center all"><i class='fa fa-plus btnAdd' id="btnAdd"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
					</div>
                    <!-- End Table Submit Item -->
                    
                    <!-- Submit Action Button -->
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
@include('modal.warehouse')
@include('modal.constructor')
@endsection()

@section('javascript')
<script type="text/javascript">	
    var objRef = [];
	isDuplicateArray = function(err) {
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

    function GetRef(){
		return $.ajax({url:'{{url("/stock/use/GetRef")}}',type:'GET',dataType:'json',async:false}).responseJSON;
	}

	$('#save_close,#save_new').on('click',function(){
        $('.form-message').empty();
		$(this).prop('disabled', true);
		if(chkValid([".reference_no",".trans_date",".warehouse_id",".reference",<?php if(getSetting()->allow_zone==1){echo '".zone_id",';} ?>,<?php if(getSetting()->allow_block==1){echo '".block_id",';} ?>,<?php if(getSetting()->usage_constructor==1){echo '".sub_const",';} ?>".engineer"])){ 
            if(onSubmitFormCallback((self,msg) => {
                $(self).addClass('invalid');
                $('.form-message').append($('<li></li>').html(msg));
            })){
				objRef = GetRef();
				if (chkReference(objRef, '#reference')) {
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

    getEngineers = function(success,complete){
        $.ajax({
            url:"{{url('repository/getEngineers')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getSubcontractors = function(success,complete){
        $.ajax({
            url:"{{url('repository/getSubcontractors')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getWarehouses = function(success,complete){
        $.ajax({
            url:"{{url('repository/getWarehouses')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getZones = function(success,complete){
        $.ajax({
            url:"{{url('repository/getZones')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getStreets = function(success,complete){
        $.ajax({
            url:"{{url('repository/getStreets')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }
    getHouses = function(success,complete){
        $.ajax({
            url:"{{url('repository/getHouses')}}",
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getBlocksByZoneID = function(zoneID,success,complete){
        $.ajax({
            url:"{{url('repository/getBlocksByZoneID')}}/" + zoneID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getStreetsByZoneID = function(zoneID,success,complete){
        $.ajax({
            url:"{{url('repository/getStreetsByZoneID')}}/" + zoneID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getStreetsByBlockID = function(blockID,success,complete){
        $.ajax({
            url:"{{url('repository/getStreetsByBlockID')}}/" + blockID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getHousesByZoneID = function(zoneID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByZoneID')}}/" + zoneID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getHousesByBlockID = function(blockID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByBlockID')}}/" + blockID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getHousesByStreetID = function(streetID,success,complete){
        $.ajax({
            url:"{{url('repository/getHousesByStreetID')}}/" + streetID,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    getSubcontractors_success = function(res){
        $(".sub_const").empty();
		$(".sub_const").select2('val', null);
        $(".sub_const").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".sub_const").append($('<option></option>').val(val.id).text(val.id_card + ' (' + val.name + ')'));
        });
    }

    getWarehouses_success = function(res){
        $(".warehouse_id").empty();
		$(".warehouse_id").select2('val', null);
        $(".warehouse_id").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".warehouse_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }

    getZones_success = function(res){
        $(".zone_id").empty();
		$(".zone_id").select2('val', null);
        $(".zone_id").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".zone_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }

    getBlocks_success = function(res){
        $(".block_id").empty();
		$(".block_id").select2('val', null);
        $(".block_id").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".block_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    
    getStreets_success = function(res){
        $(".street_id").empty();
		$(".street_id").select2('val', null);
        $(".street_id").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".street_id").append($('<option></option>').val(val.id).text(val.name));
        });
    }
    getHouses_success = function(res){
        $(".house_id").empty();
		$(".house_id").select2('val', null);
        $(".house_id").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".house_id").append($('<option></option>').val(val.id).text(val.house_no));
        });
    }
    getEngineers_success = function(res){
        $(".engineer").empty();
		$(".engineer").select2('val', null);
        $(".engineer").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $(".engineer").append($('<option></option>').val(val.id).text(val.id_card + ' (' + val.name + ')'));
        });
    }

    getEngineers_complete = function(res){}
    getSubcontractors_complete = function(res){}
    getWarehouses_complete = function(res){}
    getZones_complete = function(res){}
    getStreets_complete = function(res){}
    getBlocks_complete = function(res){}
    getHouses_complete = function(res){}

    fetchUsageBOQ = function(params,success,error){}
    fetchUsageBOQ_success = function(res){}
    fetchUsageBOQ_error = function(res){}

    btnAddButtonClicked = function(e){
        var table = $('#table-income');
        table.append(buildRow(e));
        setupSelect2();
        setupSelect2Autocompleted();
        $(".qty").ForceNumericOnly();
    }

    onRemove = function(self){
        $(self).parents('tr').remove();
    }

    onItemSelectChanged = function(self){
        const index  = $(self).attr('index');
        const itemId = $(self).val();
        const selectUnitID = '#unit_id_' + index;
        const mainTR = ".tr-" + index;

        $(mainTR).removeClass('invalid');
        $(mainTR).removeClass('out-stock');
        $(mainTR).removeClass('out-boq');
        $(mainTR).removeClass('not-set-boq');

        buildUnit(itemId,(res) => buildUnitWhenSuccess(selectUnitID,res),function(res) {
            // Noting selected
        });
        fetchCurrentBOQ(itemId,function(res){
            // Success

            $("#boq_qty_" + index).val(0);
            $("#boq_unit_" + index).val(null);
            $("#unit_factor_" + index).val(1);
            $("#stock_qty_" + index).val(0);

            $(".label-boq-qty-" + index).html(0);
            $(".label-stock-qty-" + index).html(0);
            

            if(res){
                $.each(res,function(key,val){

                    const boq           = (val.qty_std_x + val.qty_add_x) - val.usage_qty_x;
                    const boqWithUnit   = boq + ' | ' + val.unit;
                    const stockWithUnit = val.stock_qty_x + ' | ' + val.unit;

                    buildUnitWhenComplete(selectUnitID,val.unit_usage);

                    // stock out
                    if(val.stock_qty_x == 0 || boq == 0){
                        $(mainTR).addClass('out-stock');
                    }
                    // out of boq
                    else if(val.qty_std_x > 0 && boq == 0){
                        $(mainTR).addClass('out-boq');
                    }
                    // boq not set
                    else if(val.qty_std_x == 0){
                        $("#boq_set_" + index).val(-1);
                        $(mainTR).addClass('not-set-boq');
                    }
                    // normal & remove all highlight class
                    else{
                        $(mainTR).removeClass('out-stock');
                        $(mainTR).removeClass('out-boq');
                        $(mainTR).removeClass('not-set-boq');
                        $(mainTR).removeClass('invalid');
                    }
                    
                    $("#boq_qty_" + index).val(boq);
                    $("#boq_unit_" + index).val(val.unit);
                    $("#unit_factor_" + index).val(val.factor);
                    $("#stock_qty_" + index).val(val.stock_qty_x);

                    $(".label-boq-qty-" + index).html(boqWithUnit);
                    $(".label-stock-qty-" + index).html(stockWithUnit);
                });
            }
        },function(err){
            // Error
            alert(err);
        });
    }

    onSubmitFormCallback = function(result){

        var okSubmit = true;

        $('tr.out-stock').each(function(){
            result(this,"Product out of stock");
            okSubmit = false;
            return;
        });

        $('tr.out-boq').each(function(){
            result(this,"Product out of BOQ");
            okSubmit = false;
            return;
        });

        var dupArray = [];

        $('.qty').each(function(i){
            const qty = this.value;
            const parent = $(this).parent().parent();

            // if(qty!=null && qty!='' && typeof qty!=undefined){
			// 	dupArray[i] = qty;
			// }

            if(qty == 0){
                result(parent,"Quantity equal zero");
                okSubmit = false;
                return;
            }

            if(qty == undefined){
                result(parent,"Quantity is undefined");
                okSubmit = false;
                return;
            }

            if(qty == ''){
                result(parent,"Quantity is empty");
                okSubmit = false;
                return;
            }            
        });
        $('.item_id').each(function(i){
            const id = this.value;
            if(id!=null && id!='' && typeof id!=undefined){
				dupArray[i] = id;
			}
        })
        console.log(dupArray);

        if (isDuplicateArray(dupArray)==true) {
            result(this,'{{trans("lang.some_record_is_dublicate")}}');
            okSubmit = false;
            return;
		}

        $('.unit_id').each(function(){
            const unitId = this.value;
            const parent = $(this).parent().parent();
            if(unitId == undefined){
                result(parent,"Unit is undefined");
                okSubmit = false;
                return;
            }

            if(unitId == ''){
                result(parent,"Unit is empty");
                okSubmit = false;
                return;
            } 
        });

        $('.item_id').each(function(){
            const itemId = this.value;
            const parent = $(this).parent().parent();
            if(itemId == undefined){
                result(parent,"Item is undefined");
                okSubmit = false;
                return;
            }

            if(itemId == ''){
                result(parent,"Item is empty");
                okSubmit = false;
                return;
            } 
        });

        $('tr.tr-form').each(function(){
            const itemId = $(this).children().find('.item_id').val();
            const unitId = $(this).children().find('.unit_id').val();
            const unitSelectId = $(this).children().find('.unit_id').attr('id');
            const factor = $('.' + unitSelectId + '-' + unitId).attr('factor');
            const qty = $(this).children().find('.qty').val();
            const boqQty = $(this).children().find('.boq_qty').val();
            const stockQty = $(this).children().find('.stock_qty').val();

            if(itemId && unitId){

                console.log("========= CHECKING =======");
                console.log("factor = ",factor);
                console.log("stockQty = ",stockQty);
                console.log("qty = ",qty);
                console.log("==========================");

                if(factor < 1){
                    
                    var checkStockQty = stockQty / factor;
                    if(checkStockQty < qty){
                        result(this,"Quantity bigger than stock value");
                        okSubmit = false;
                        return;
                    }

                    var checkBoqQty = boqQty / factor;
                    if(checkBoqQty < qty){
                        result(this,"Quantity bigger than BOQ value");
                        okSubmit = false;
                        return;
                    }

                }else{

                    var checkStockQty = stockQty * factor;
                    if(checkStockQty < qty){
                        result(this,"Quantity bigger than stock value");
                        okSubmit = false;
                        return;
                    }
                    
                    var checkBoqQty = boqQty * factor;
                    if(checkBoqQty < qty){
                        result(this,"Quantity bigger than BOQ value");
                        okSubmit = false;
                        return;
                    }
                }
            }else{
                result(this,"Invalid value");
                okSubmit = false;
                return;
            }
        });
 
        return okSubmit;
    }

    onUnitSelectChanged = function(self){
        const index = $(self).attr('index');
    }

    buildRow = function(e){
        var lineNum = $("#table-income tbody tr").length;
        if(lineNum == 20){
            alert("Limit row of table less than 20");
            return;
        }

        const index  = parseInt(e.timeStamp * 1000);
        const lineIndex = lineNo((lineNum+1),3);
        var row  = '<tr index='+ index +' class="tr-form tr-'+ index +'">';
            // No
            row += '<td width="5%">';
            row += '<strong>'+ lineIndex +'</strong>';
            row += '<input type="hidden" value='+lineIndex+' id="line_index'+ index +'" name="line_index[]" class="form-control line_index" />';
            row += '</td>';
            // Item
            row += '<td width="30%">';
            row += '<select onchange="onItemSelectChanged(this);" index="'+ index +'" id="item_id_'+ index +'" name="item_id[]" class="form-control select2 item_id"><option></option></select>';
            row += '</td>';
            // BOQ Qty
            row += '<td width="15%" class="text-center">';
            row += '<label class="label-boq-qty-'+ index +'">0</label>';
            row += '<input type="hidden" id="boq_qty_'+ index +'" name="boq_qty[]" class="form-control boq_qty" />';
            row += '<input type="hidden" id="boq_unit_'+ index +'" name="boq_unit[]" class="form-control boq_unit" />';
            row += '<input type="hidden" id="boq_set_'+ index +'" name="boq_set[]" class="form-control boq_set" />';
            row += '</td>';
            // BOQ Unit
            row += '<td width="15%" class="text-center">';
            row += '<label class="label-stock-qty-'+ index +'">0</label>';
            row += '<input type="hidden" id="stock_qty_'+ index +'" name="stock_qty[]" class="form-control stock_qty" />';
            row += '</td>';
            // Qty
            row += '<td width="15%">';
            row += '<input index="'+ index +'" type="text" id="qty_'+ index +'" name="qty[]" class="form-control qty" />';
            row += '</td>';
            // Unit
            row += '<td width="15%">';
            row += '<input type="hidden" id="unit_factor_'+ index +'" name="unit_factor[]" class="form-control unit_factor" />';
            row += '<select index="'+ index +'" id="unit_id_'+ index +'" name="unit_id[]" class="form-control select2 unit_id"><option></option></select>';
            row += '</td>';
            // Remove
            row += '<td width="5%" class="text-center">';
            row += '<button type="button" index="'+ index +'" onclick="onRemove(this);" class="btn btn-sm red"><i class="fa fa-trash"></i></button>';
            row += '</td>';
            row += '</tr>';
        return row;
    }
	
    setupDate = function(){
        $('#trans_date').val(formatDate("{{date('Y-m-d')}}"));
		$("#trans_date").datepicker({
			format: "{{getSetting()->format_date}}",
            autoclose: true,
            pickerPosition: "bottom-right"
		});
    }

    setupSelect2 = function(){
        $(".select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:'true'});
    }

    setupSelect2Autocompleted = function(){
        $(".item_id").select2({
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
    }

    checkStockQuantity = function(params,success,complete){
        $.ajax({
            url:'{{url("repository/checkStockQuantity")}}',
            type:'GET',
            data: params,
            success: success,
            complete: complete
        });
    }

    buildUnit = function(itemId,success,complete){
        $.ajax({
            url:'{{url("stock/use/policy/buildUnit")}}/' + itemId,
            type:'GET',
            success: success,
            complete: complete
        });
    }

    buildUnitWhenSuccess  = function(self,res){
        const index = $(self).attr('id');
        $(self).empty();
		$(self).select2('val', null);
        $(self).append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            const className = index + '-' + val.from_code;
            $(self).append($('<option class='+ className +' factor='+ val.factor +' to_code='+ val.to_code +'></option>').val(val.from_code).text(val.from_desc));
        });
    }

    buildUnitWhenComplete = function(self,selectedValue){
        $(self).select2('val', selectedValue);
    }

    /// Current BOQ ///
    /// by zone,street,house
    /// Callback success
    /// Callback complete
    fetchCurrentBOQ = function(itemId,success,error){

        var params = {
            zone_id: null,
            block_id: null,
            street_id: null,
            house_id: null,
            trans_date: '{{date("Y-m-d")}}',
            item_id: itemId
        };

        @if(getSetting()->allow_zone == 1)
            if (zoneId = $("zone_id").val()) {
                params.zone_id = zoneId;
            }
        @endif

        @if(getSetting()->allow_block == 1)
            if (blockId = $("block_id").val()) {
                params.block_id = blockId;
            }
        @endif

        if (streetId = $("street_id").val()) {
            params.street_id = streetId;
        }

        if (houseId = $("house_id").val()) {
            params.house_id = houseId;
        }

        if (transDate = $("trans_date").val()) {
            params.trans_date = transDate;
        }

        $.ajax({
            url:'{{url("repository/fetchCurrentBOQ")}}',
            type:'GET',
            data: params,
            success:success,
            error:error
        });
    }

	$(document).ready(function(){
		setupSelect2();
		setupDate();
        getEngineers(getEngineers_success,getEngineers_complete);
        getSubcontractors(getSubcontractors_success,getSubcontractors_complete);
        getWarehouses(getWarehouses_success,getWarehouses_complete);
        getStreets(getStreets_success,getStreets_complete);
        getHouses(getHouses_success,getHouses_complete);
        @if(getSetting()->allow_zone == 1)
        getZones(getZones_success,getZones_complete);
        $('.zone_id').on('change',function(){
            const zoneID = $(this).val();
            if(zoneID){

                @if(getSetting()->allow_block == 1)
                    getBlocksByZoneID(zoneID,getBlocks_success,getBlocks_complete);
                @endif

                getStreetsByZoneID(zoneID,getStreets_success,getStreets_complete);
                getHousesByZoneID(zoneID,getHouses_success,getHouses_complete);
            }
        });
        @endif

        @if(getSetting()->allow_block == 1)
        $('.block_id').on('change',function(){
            const blockID = $(this).val();
            if(blockID){
                getStreetsByBlockID(blockID,getStreets_success,getStreets_complete);
                getHousesByBlockID(blockID,getHouses_success,getHouses_complete);
            }
        });
        @endif

        $('.street_id').on('change',function(){
            const streetID = $(this).val();
            if(streetID){
                getHousesByStreetID(streetID,getHouses_success,getHouses_complete);
            }
        });

		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
		
		$('#btnAdd').on('click',function(e){
            btnAddButtonClicked(e);
        });
		
		setInterval(function() {
			$.ajax({
				url :'{{url("prefix/gen/USE/Usage/ref_no")}}',
				type:'get',
				success:function(data){
					if(data!=null && data!=''){
						$('#reference_no').attr("readonly", true);
						$('#reference_no').val(data);
					}else{
						$('#reference_no').attr("readonly", false);
					}
				},error:function(){}
			});
		}, 3000);
	});
</script>
@endsection()