@extends('layouts.app')

@section('stylesheet')
	<style>
		.small-pic{
			display: inline-block;
			vertical-align: middle;
			height: 30px;
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
				<?php if(Session::has('bug') && count(Session::get('bug')>0)): ?>
					<?php
						echo '<div class="alert alert-danger display-show"><button class="close" data-close="alert"></button>';
						foreach(Session::get('bug') as $key=>$val){
								echo '<strong>'.trans('lang.error').'!</strong>'.trans('lang.dublicate_at_record').' '.$val['index'].'<br/>';
						}
						echo '</div>';
					?>
				<?php endif; ?>
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
							<th width="3%" class="text-center all">{{ trans('lang.photo') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.name') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.email') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.tel') }}</th>
							<th width="5%" class="text-center">{{ trans('lang.department') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.position') }}</th>
							<th width="10%" class="text-center">{{ trans('lang.approval_user') }}</th>
							<th width="5%" class="text-center">{{ trans('lang.status') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@include('modal.users')
@include('modal.reset')
@include('modal.modal')

@endsection()

@section('javascript')
<script type="text/javascript">
	var objName = JSON.parse(convertQuot('{{\App\User::get()}}'));
	
	$('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{data: 'photo', name:'photo'},
			{data: 'name', name:'name'},
			{data: 'email', name:'email'},
			{data: 'tel', name:'tel'},
			{data: 'department', name:'department'},
			{data: 'position', name:'position'},
			{data: 'approval_user', name:'approval_user'},
			{data: 'status', name:'status'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],'fnCreatedRow':function(nRow,aData,iDataIndex){
			
			var pic='<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
			if(aData['photo']!=null && aData['photo']!='' && aData['photo']!=0){
				pic = '<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/users")}}/'+aData['photo']+'" onclick="onZoom(this.id);" />';
			}
			$('td:eq(0)',nRow).html(pic).addClass("text-center");

			// Approval User
			var approvalUser = '<span class="label label-danger" style="font-size: smaller;">{{trans("lang.no")}}</span>';
			if(aData['approval_user']==1){
				approvalUser = '<span class="label label-info" style="font-size: smaller;">{{trans("lang.yes")}}</span>';
			}
			$('td:eq(6)',nRow).html(approvalUser).addClass("text-center");

			// Status
			var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.disable")}}</span>';
			if(aData['status']==1){
				str='<span class="label label-info" style="font-size: smaller;">{{trans("lang.active")}}</span>';
			}
			$('td:eq(7)',nRow).html(str).addClass("text-center");
		}
	});
	
	function onZoom(id){
		var image=$('#'+id).attr('src');
		$.fancybox.open(image);
	}
	
	function isDuplicateEmail(newEmail,oldEmail = null) {
		var isOk = true;
		if (oldEmail) {
			$.each(objName.filter(a => a.email==newEmail).filter(b=>b.email!=oldEmail),function(key,val){
				if (val) {
					isOk=false;
				}
			});
        }else{
			$.each(objName.filter(a => a.email==newEmail),function(key,val){
				if (val) {
					isOk=false;
				}
			});
        }
        return isOk;
    }
	
	function isReset() {
        var isValid = true;
        var new_password = $('#new_password').val();
        var confirm_password = $('#confirm_password').val();

        if(new_password.length < 6 || new_password.length > 15){
            isValid = false;
            $('#new_password').css('border','1px solid #e43a45');
            $('#new_password').next().html("{{trans('lang.password_min_max')}}");
        }else{
            $('#new_password').css('border','1px solid #c2cad8');
           $('#new_password').next().html('');
        }

        if(confirm_password.length < 6 || confirm_password.length > 15){
            isValid = false;
            $('#confirm_password').css('border','1px solid #e43a45');
			$('#confirm_password').next().html("{{trans('lang.con_password_min_max')}}");
        }else if(new_password!=confirm_password){
            isValid = false;
            $('#confirm_password').css('border','1px solid #e43a45');
           $('#confirm_password').next().html("{{trans('lang.con_password_not_match')}}");
        }else{
            $('#confirm_password').css('border','1px solid #c2cad8');
            $('#confirm_password').next().html('');
        }

        return isValid;
    }
	
	$(function(){
		/* button click save */
		$("#btnAdd").on("click",function(){
			var rounte = $(this).attr('rounte');
			$('.form-users').attr('action',rounte);
			$('.form-users').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#name').val('');
			$('#tel').val('');
			$('#position').val('');
			$('#dep_id').select2('val',null);
			$('#status').select2('val',1);
			$('#email').val('');
			$('#old_email').val('');
			var str =   '<div class="form-group">'+
						'	<label for="new_password" class="col-md-3 control-label bold">{{trans('lang.password')}}'+
						'		<span class="required">*</span>'+
						'	</label>'+
						'	<div class="col-md-8">'+
						'		<input id="new_password" length="15" type="password" class="form-control new_password" name="password" placeholder="{{trans('lang.enter_text')}}">'+
						'		<span class="help-block font-red bold"></span>'+
						'	</div>'+
						'</div>'+
						'<div class="form-group">'+
						'	<label for="confirm_password" class="col-md-3 control-label bold">{{trans('lang.confirm_password')}}'+
						'		<span class="required">*</span>'+
						'	</label>'+
						'	<div class="col-md-8">'+
						'		<input id="confirm_password" length="15" type="password" class="form-control confirm_password" name="password_confirmation"  placeholder="{{trans('lang.enter_text')}}">'+
						'		<span class="help-block font-red bold"></span>'+
						'	</div>'+
						'</div>';
			$('#create-password').append(str);
			
			var pic = '<div class="form-group">'+
						'	<label class="col-md-3 control-label bold">{{trans('lang.profile_pic')}}</label>'+
						'	<div class="col-md-8">'+
						'		<div class="fileinput fileinput-new input-group profile" data-provides="fileinput">'+
						'			<div class="form-control" data-trigger="fileinput">'+
						'				<i class="glyphicon glyphicon-file fileinput-exists"></i> '+
						'				<span class="fileinput-filename"></span>'+
						'			</div>'+
						'			<span class="input-group-addon btn btn-success btn-file blue">'+
						'				<span class="fileinput-new bold ">{{trans('lang.select_image')}}</span>'+
						'				<span class="fileinput-exists bold">{{trans('lang.change')}}</span>'+
						'				<input type="file" id="profile" name="profile" accept="image/*">'+
						'			</span>'+
						'				<a href="#" class="input-group-addon btn red btn-danger fileinput-exists bold" data-dismiss="fileinput">{{trans('lang.remove')}}</a>'+
						'		</div>'+
						'		<span class="help-block error-profile font-red bold"></span>'+
						'	</div>'+
						'</div>';
			$("#div-picture").append(pic);
			$('#reset-password').empty();
			$('.button-submit-user').attr('id','btnSaveUser').attr('name','btnSaveUser');
			$('.button-submit-user').html('{{trans("lang.save")}}');
			$('.users-modal').modal('show');
			
			$("#btnSaveUser").on('click',function(){
				$(this).prop('disabled', true);
				if(chkValid([".name",".tel",".position",".dep_id",".status",".email",".password",".confirm_password"])){
					var email = $('#email').val();
					if(validateEmail(email)){
						if(isDuplicateEmail(email)){
							if(isReset()){
								$('.form-users').submit();
							}else{
								$(this).prop('disabled', false);
								return false;
							}
						}else{
							$('#email').css('border','1px solid #e43a45');
							$('#email').next().html("{{trans('lang.field_unique')}}");
							$(this).prop('disabled', false);
							return false;
						}
					}else{
						$('#email').css('border','1px solid #e43a45');
						$('#email').next().html("{{trans('lang.email_invalid')}}");
						$(this).prop('disabled', false);
						return false;
					}
				}else{
					$(this).prop('disabled', false);
					return false;
				}
			});
		});
		/* end button click save */
	});	
	
	@if(hasRole('department_add'))
		var objDepartment = JSON.parse(convertQuot('{{\App\Model\SystemData::where(["type"=>"DP","parent_id"=>Session::get('project')])->get()}}'));
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
								$("#dep_id").append($('<option></option>').val(data.id).text(data.name));
								$("#dep_id").select2('val', data.id);
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
	
	function onReset(field){
		var rounte = $(field).attr('row_rounte');
		$('.reset-form').attr('action',rounte);
		$('.reset-form').children().find('div').children().find('h4').html('{{trans("lang.reset_password")}}');
		$('.button-submit-reset').attr('id','btnReset').attr('name','btnReset');
		$('.button-submit-reset').html('{{trans("lang.reset")}}');
		var str = '<div class="form-group">'+
					'	<label for="new_password" class="col-md-3 control-label bold">{{trans('lang.password')}}'+
					'		<span class="required">*</span>'+
					'	</label>'+
					'	<div class="col-md-8">'+
					'		<input id="new_password" length="15" type="password" class="form-control new_password" name="password" placeholder="{{trans('lang.enter_text')}}">'+
					'		<span class="help-block font-red bold"></span>'+
					'	</div>'+
					'</div>'+
					'<div class="form-group">'+
					'	<label for="confirm_password" class="col-md-3 control-label bold">{{trans('lang.confirm_password')}}'+
					'		<span class="required">*</span>'+
					'	</label>'+
					'	<div class="col-md-8">'+
					'		<input id="confirm_password" length="15" type="password" class="form-control confirm_password" name="password_confirmation"  placeholder="{{trans('lang.enter_text')}}">'+
					'		<span class="help-block font-red bold"></span>'+
					'	</div>'+
					'</div>';
		$('#reset-password').append(str);
		$("#create-password").empty();
		$('.reset-modal').modal('show');
		
		$("#btnReset").on('click',function(){
			if(chkValid([".new_password",".confirm_password"])){
				if(isReset()){
					$('.reset-form').submit();
				}else{
					$(this).prop('disabled', false);
					return false;
				}
			}else{
				return false;
			}
		});
	}
	
	function onEdit(field){
		$("#div-picture").empty();
		$('#create-password').empty();
		var id = $(field).attr('row_id');
		var rounte = $(field).attr('row_rounte');
		var _token = $("input[name=_token]").val();
		$('.form-users').attr('action',rounte);
		$('.form-users').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
		if(objName){
			$.each(objName.filter(c=>c.id==id),function(key,val){
				$('#name').val(val.name);
				$('#tel').val(val.tel);
				$('#position').val(val.position);
				$('#dep_id').select2('val',val.dep_id);
				$('#department2').select2('val',val.department2);
				$('#department3').select2('val',val.department3);
				$('#status').select2('val',val.status);
				$('#email').val(val.email);
				$('#old_email').val(val.email);
			});
		}
		$('.button-submit-user').attr('id','btnUpdate').attr('name','btnUpdate');
		$('.button-submit-user').html('{{trans("lang.save_change")}}');
		$('.users-modal').modal('show');
		
		$("#btnUpdate").on('click',function(){
			if(chkValid([".name",".position",".tel",".dep_id",".status",".email"])){
				var email = $('#email').val();
				var old_email = $('#old_email').val();
				if(validateEmail(email)){
					if(isDuplicateEmail(email, old_email)){
						$('.form-users').submit();
					}else{
						$('#email').css('border','1px solid #e43a45');
						$('#email').next().html("{{trans('lang.field_unique')}}");
						$(this).prop('disabled', false);
						return false;
					}
				}else{
					$('#email').css('border','1px solid #e43a45');
					$('#email').next().html("{{trans('lang.email_invalid')}}");
					$(this).prop('disabled', false);
					return false;
				}
			}else{
				return false;
			}
		});
	}
	
	function onPermission(field){
		var rounte = $(field).attr('row_rounte');
		window.location.href=rounte;
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