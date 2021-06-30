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
					@if(isset($rounteSave))
						<a rounte="{{$rounteSave}}" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default" id="btnAdd">
							<i class="fa fa-plus"></i>
						</a>
					@endif
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
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
							<th style="width: 3%;" class="all"></th>
							<th width="10%" class="text-center all">{{ trans('lang.name') }}</th>
							<th width="10%" class="text-center">{{ trans('lang.zone') }}</th>
							<th width="32%" class="text-center all">{{ trans('lang.department') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.min_amount') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.max_amount') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@include('modal.role')
@include('modal.assign_user')

@endsection()

@section('javascript')
<script type="text/javascript">
	var objName = JSON.parse(convertQuot("{{\App\Model\Role::get(['id','name','min_amount','max_amount','zone','level','dep_id'])}}"));

	getAssignedUserByRoleID = function(roleID,success,complete){
		$.ajax({
            url:"{{url('repository/getAssignedUserByRoleID')}}/" + roleID,
            type:'GET',
            success: success,
            complete: complete
        });
	}

	getUsersByDepartmentID = function(departmentID,success,complete){
		$.ajax({
            url:"{{url('repository/getApprovalUsers')}}",
            type:'GET',
            success: success,
            complete: complete
        });
	}

	getUsersByDepartmentID_success = function(res){
		$("#assign-user").empty();
		$("#assign-user").select2('val', null);
        $("#assign-user").append($('<option></option>').val('').text(''));
        $.each(res,function(i,val){
            $("#assign-user").append($('<option></option>').val(val.id).text(val.name));
        });
	}

	function format (d) {
        var str = '';
        str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 5%;">{{trans("lang.line_no")}}</th>';
                    str += '<th style="width: 30%;">{{trans("lang.name")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.zone")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.min_amount")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.max_amount")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.action")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }
	
	var my_table = $('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{
				className: 'details-control',
				orderable: false,
				searchable: false,
				data: null,
				defaultContent: ''
			},
			{data: 'name', name:'name'},
			{data: 'zone_desc', name:'zone_desc'},
			{data: 'department', name:'department'},
			{data: 'min_amount', name:'min_amount'},
			{data: 'max_amount', name:'max_amount'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],order: [[4, 'asc']],'fnCreatedRow':function(nRow,aData,iDataIndex){
			$('td:eq(4)',nRow).html(formatDollar(aData['min_amount']));
			$('td:eq(5)',nRow).html(formatDollar(aData['max_amount']));
		}
	});
	
	$('#my-table tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = my_table.row(tr);
		var tableId = 'sub-' + row.data().id;
		if(row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
		}else{
			row.child(format(row.data())).show();
			initTable(tableId,row.data());
			$('#' + tableId+'_wrapper').attr('style','width: 99%;');
			tr.addClass('shown');
		}
	});
	
	function initTable(tableId, data) {
		$('#' + tableId).DataTable({
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url,
			columns: [
				{ data: 'id', name: 'id' },
				{ data: 'name', name: 'name' },
				{ data: 'zone_desc', name: 'zone_desc' },
				{ data: 'min_amount', name: 'min_amount' },
				{ data: 'max_amount', name: 'max_amount' },
				{data: 'action', class :'text-center', orderable: false, searchable: false},
			],fnCreatedRow:function(nRow, aData, iDataIndex){
				$('td:eq(0)',nRow).html(lineNo((iDataIndex + 1), 3));
				$('td:eq(3)',nRow).html(formatDollar(aData['min_amount']));
				$('td:eq(4)',nRow).html(formatDollar(aData['max_amount']));
			}
		});
	}
	
	document.addEventListener("mousewheel", function(event){
		if(document.activeElement.type === "number" &&
		   document.activeElement.classList.contains("noscroll"))
		{
			document.activeElement.blur();
		}
	});
	
	$(function(){
		$("#btnAdd").on("click",function(){
			var rounte = $(this).attr('rounte');
			$('.role-form').attr('action',rounte);
			$('.role-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#role-old-name').val('');
			$('#div-parent-role').empty();
			$("#div-zone-role").empty();
			var str = '<input type="hidden" name="level" value="1" />'+
					'<div class="form-group">'+
					'	<label for="role-zone" class="col-md-3 control-label bold">{{trans('lang.zone')}}'+
					'		<span class="required">*</span>'+
					'	</label>'+
					'	<div class="col-md-8">'+
					'		<select name="zone" id="role-zone" class="form-control role-zone my-select2">'+
					'			<option value=""></option>'+
					'			<option value="1">PR</option>'+
					'			<option value="2">PO</option>'+
					'		</select>'+
					'		<span class="help-block font-red bold"></span>'+
					'	</div>'+
					'</div>'+
					'<div class="form-group">'+
					'	<label for="role-department" class="col-md-3 control-label bold">{{trans('lang.department')}} '+
					'		<span class="required">*</span>'+
					'	</label>'+
					'	<div class="col-md-8">'+
					'		<select name="department" id="role-department" class="form-control role-department my-select2">'+
					'			<option value=""></option>'+
					'			<option value="0">Top Lavel</option>'+
					'			{{getSystemData('DP')}}'+
					'		</select>'+
					'		<span class="help-block font-red bold"></span>'+
					'	</div>'+
					'</div>';
			$("#div-zone-role").append(str);
			$('#role-name').val('');
			$(".my-select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:true});
			$('#role-zone').select2('val', null);
			$('#role-department').select2('val', null);
			$('#role-amount').prop('readonly', false);
			$('#role-amount').val('');
			$('#role-amount2').prop('readonly', false);
			$('#role-amount2').val('');
			$('.button-submit').attr('id','btnSave').attr('name','btnSave');
			$('.button-submit').html('{{trans("lang.save")}}');
			$('.role-modal').modal('show');
			
			$("#btnSave").on('click',function(){
				if(chkValid([".role-name", ".role-zone", ".role-department", ".role-amount", ".role-amount2"])){
					if(chkDublicateName(objName, '#role-name')){
						$('.role-form').submit();
					}else{
						return false;
					}
				}else{
					return false;
				}
			});
			
			$("#role-department").on('change', function(){
				var val = $(this).val();
				if(val!=null && val!=''){
					if(val==0){
						$("#role-amount").val('');
						$("#role-amount").prop('readonly', false);
						$("#role-amount2").val('');
						$("#role-amount2").prop('readonly', false);
					}else{						
						$("#role-amount").val(0);
						$("#role-amount").prop('readonly', true);
						$("#role-amount2").val(0);
						$("#role-amount2").prop('readonly', true);
					}
				}
			});
		});
	});
	
	function onEdit(field){
		$('#div-parent-role').empty();
		$("#div-zone-role").empty();
		var str = '<input type="hidden" name="level" value="1" />'+
				'<div class="form-group">'+
				'	<label for="role-zone" class="col-md-3 control-label bold">{{trans('lang.zone')}}'+
				'		<span class="required">*</span>'+
				'	</label>'+
				'	<div class="col-md-8">'+
				'		<select name="zone" id="role-zone" class="form-control role-zone my-select2">'+
				'			<option value=""></option>'+
				'			<option value="1">PR</option>'+
				'			<option value="2">PO</option>'+
				'		</select>'+
				'		<span class="help-block font-red bold"></span>'+
				'	</div>'+
				'</div>'+
				'<div class="form-group">'+
				'	<label for="role-department" class="col-md-3 control-label bold">{{trans('lang.department')}} '+
				'		<span class="required">*</span>'+
				'	</label>'+
				'	<div class="col-md-8">'+
				'		<select name="department" id="role-department" class="form-control role-department my-select2">'+
				'			<option value=""></option>'+
				'			<option value="0">Top Lavel</option>'+
				'			{{getSystemData('DP')}}'+
				'		</select>'+
				'		<span class="help-block font-red bold"></span>'+
				'	</div>'+
				'</div>';
		$("#div-zone-role").append(str);
		$(".my-select2").select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:true});
		var id = $(field).attr('row_id');
		var rounte = $(field).attr('row_rounte');
		$('.role-form').attr('action', rounte);
		$('.role-modal').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
		if(objName){
			$.each(objName.filter(c=>c.id == id), function(key, val){
				$('#role-old-name').val(val.name);
				$('#role-name').val(val.name);
				$('#role-zone').select2('val', val.zone);
				$('#role-department').select2('val', val.dep_id);
				if(val.dep_id==0){
					$('#role-amount').prop('readonly', false);
					$('#role-amount2').prop('readonly', false);
				}else{
					$('#role-amount').prop('readonly', true);
					$('#role-amount2').prop('readonly', true);
				}
				$('#role-amount').val(val.min_amount);
				$('#role-amount2').val(val.max_amount);
				$('.button-submit').attr('id','btnUpdated').attr('name','btnUpdated');
				$('.button-submit').html('{{trans("lang.save_change")}}');
				$('.role-modal').modal('show');
			});
		}
		
		$("#role-department").on('change', function(){
			var val = $(this).val();
			if(val!=null && val!=''){
				if(val==0){
					$("#role-amount").val('');
					$("#role-amount").prop('readonly', false);
					$("#role-amount2").val('');
					$("#role-amount2").prop('readonly', false);
				}else{						
					$("#role-amount").val(0);
					$("#role-amount").prop('readonly', true);
					$("#role-amount2").val(0);
					$("#role-amount2").prop('readonly', true);
				}
			}
		});
		
		$("#btnUpdated").on('click',function(){
			if(chkValid([".role-name", ".role-zone", ".role-department", ".role-amount", ".role-amount2"])){
				if(chkDublicateName(objName, '#role-name', '#role-old-name')){
					$('.role-form').submit();
				}else{
					return false;
				}
			}else{
				return false;
			}
		});
	}
	
	function onAssign(field, dep_id){
		var id = $(field).attr('row_id');
		var rounte = $(field).attr('row_rounte');
		var selectedValues = new Array();
		$('.assign-form').attr('action', rounte);
		$('.assign-modal').children().find('div').children().find('h4').html('{{trans("lang.assign_user")}}');
		
		getAssignedUserByRoleID(id,function(res){
			$.each(res, function(key, val){
				selectedValues[key] = val.user_id;
			});
		},function(res){
			// do somethings
		});

		getUsersByDepartmentID(dep_id,getUsersByDepartmentID_success,function(res){
			$('#assign-user').select2('val',selectedValues);
		});

		
		$('.button-submit-assign').attr('id','btnAssign').attr('name','btnAssign');
		$('.button-submit-assign').html('{{trans("lang.assign")}}');
		$('.assign-modal').modal('show');
		
		$("#btnAssign").on('click',function(){
			if(chkValid([".assign-user"])){
				$('.assign-form').submit();
			}else{
				return false;
			}
		});
	}
	
	function onRole(field){
		var id = $(field).attr('row_id');
		if(objName){
			$.each(objName.filter(c=>c.id == id), function(key, val){
				var rounte = $(field).attr('row_rounte');
				$('.role-form').attr('action', rounte);
				$('.role-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
				$('#role-old-name').val('');
				$("#div-zone-role").empty();
				$('#div-parent-role').empty();
				var str = '<input type="hidden" name="level" value="2" />'+
							'<div class="form-group">'+
							'	<label for="role-name" class="col-md-3 control-label bold">{{trans('lang.parent_role')}} '+
							'		<span class="required">*</span>'+
							'	</label>'+
							'	<div class="col-md-8">'+
							'		<input type="hidden" name="parent_id" class="form-control" value="'+val.id+'">'+
							'		<input type="hidden" name="zone" class="form-control" value="'+val.zone+'">'+
							'		<input type="text" length="50" readonly class="form-control" value="'+val.name+'">'+
							'		<span class="help-block font-red bold"></span>'+
							'	</div>'+
							'</div>';
				$('#div-parent-role').append(str);
				$('#role-name').val('');
				$('#role-amount').prop('readonly', false);
				$('#role-amount').val('');
				$('#role-amount2').prop('readonly', false);
				$('#role-amount2').val('');
				$('.button-submit').attr('id','btnSave').attr('name','btnSave');
				$('.button-submit').html('{{trans("lang.save")}}');
				$('.role-modal').modal('show');
			});
		}
		
		
		$("#btnSave").on('click',function(){
			if(chkValid([".role-name", ".role-amount", ".role-amount2"])){
				if(chkDublicateName(objName, '#role-name')){
					$('.role-form').submit();
				}else{
					return false;
				}
			}else{
				return false;
			}
		});
	}
	
	function onSubEdit(field){
		var id = $(field).attr('row_id');
		if(objName){
			$.each(objName.filter(c=>c.id == id), function(key, val){
				var rounte = $(field).attr('row_rounte');
				$('.role-form').attr('action', rounte);
				$('.role-modal').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
				$('#role-old-name').val(val.name);
				$("#div-zone-role").empty();
				$('#div-parent-role').empty();
				var str = '<input type="hidden" name="level" value="2" />'+
							'<div class="form-group">'+
							'	<label for="role-name" class="col-md-3 control-label bold">{{trans('lang.parent_role')}} '+
							'		<span class="required">*</span>'+
							'	</label>'+
							'	<div class="col-md-8">'+
							'		<input type="hidden" name="parent_id" class="form-control" value="'+val.dep_id+'">'+
							'		<input type="hidden" name="zone" class="form-control" value="'+val.zone+'">'+
							'		<input type="text" length="50" readonly class="form-control" id="parent_role_'+val.dep_id+'">'+
							'		<span class="help-block font-red bold"></span>'+
							'	</div>'+
							'</div>';
				$('#div-parent-role').append(str);
				$.each(objName.filter(d=>d.id == val.dep_id), function(k, v){
					$("#parent_role_"+val.dep_id).val(v.name);
				});
				$('#role-name').val(val.name);
				$('#role-amount').prop('readonly', false);
				$('#role-amount').val(val.min_amount);
				$('#role-amount2').prop('readonly', false);
				$('#role-amount2').val(val.max_amount);
				$('.button-submit').attr('id','btnUpdated').attr('name','btnUpdated');
				$('.button-submit').html('{{trans("lang.save_change")}}');
				$('.role-modal').modal('show');
			});
		}
		
		
		$("#btnUpdated").on('click',function(){
			if(chkValid([".role-name", ".role-zone", ".role-department", ".role-amount", ".role-amount2"])){
				if(chkDublicateName(objName, '#role-name', '#role-old-name')){
					$('.role-form').submit();
				}else{
					return false;
				}
			}else{
				return false;
			}
		});
	}
	
	function onDelete(field){
		var rounte = $(field).attr('row_rounte');
		$.confirm({
            title:'{{trans("lang.confirmation")}}',
            content:'{{trans("lang.content_delete")}}',
            autoClose: 'no|10000',
            buttons:{
                yes:{
                    text:'{{trans("lang.yes")}}',
                    btnClass: 'btn-success',
                    action:function(){
                        window.location.href=rounte;
                    }
                },
                no:{
                    text:'{{trans("lang.no")}}',
                    btnClass: 'btn-danger',
                    action:function(){}
                }
            }
        });
	}
	
</script>
@endsection()