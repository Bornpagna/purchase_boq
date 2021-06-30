@extends('layouts.app')

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
				<form action="{{url('/user/profile/update/password')}}" method="post"  enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group">
						<label class="control-label bold">{{trans('lang.current_password')}}
							<span class="required">*</span>
						</label>
						<input type="password" id="current_password" name="current_password" class="form-control" /> 
						<span class="help-block error-current_password font-red bold"></span>
					</div>
					<div class="form-group">
						<label class="control-label bold">{{trans('lang.new_password')}}
							<span class="required">*</span>
						</label>
						<input type="password" id="new_password" name="new_password" class="form-control" /> 
						<span class="help-block error-new_password font-red bold"></span>
					</div>
					<div class="form-group">
						<label class="control-label bold">{{trans('lang.confirm_password')}}
							<span class="required">*</span>
						</label>
						<input type="password" id="re_new_password" name="re_new_password" class="form-control" /> 
						<span class="help-block error-re_new_password font-red bold"></span>
					</div>
					<div class="margin-top-10">
						<button type="submit" class="btn green" id="btnChangePassword" name="btnChangePassword" value="password"> {{trans('lang.change_password')}} </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

    function bcrypt(password) {
        return $.ajax({url:'{{url("/user/bcrypt")}}/'+password,type:'get',async:false}).responseText;
    }

    function savePassword() {
        var isValid = true;
        var current_password = $('#current_password').val();
        var new_password     = $('#new_password').val();
        var re_new_password  = $('#re_new_password').val();

        if (current_password=='' || current_password==null || current_password==undefined) {
            isValid = false;
            $('#current_password').css('border','1px solid #e43a45');
            $('.error-current_password').html("{{trans('lang.field_required')}}");
		}else if(current_password.length < 6 || current_password.length > 20){
            isValid = false;
            $('#current_password').css('border','1px solid #e43a45');
            $('.error-current_password').html("{{trans('lang.password_min_max')}}");
        }else if(bcrypt(current_password)==false){
            isValid = false;
            $('#current_password').css('border','1px solid #e43a45');
            $('.error-current_password').html("{{trans('lang.password_not_match')}}");
		}else{
            $('#current_password').css('border','1px solid #c2cad8');
            $('.error-current_password').html('');
		}

		if (new_password=='' || new_password==null || new_password==undefined) {
            isValid = false;
            $('#new_password').css('border','1px solid #e43a45');
            $('.error-new_password').html("{{trans('lang.field_required')}}");
		}else if(new_password.length < 6 || new_password.length > 20){
            isValid = false;
            $('#new_password').css('border','1px solid #e43a45');
            $('.error-new_password').html("{{trans('lang.password_min_max')}}");
        }else{
            $('#new_password').css('border','1px solid #c2cad8');
            $('.error-new_password').html('');
		}

        if (re_new_password=='' || re_new_password==null || re_new_password==undefined) {
            isValid = false;
            $('#re_new_password').css('border','1px solid #e43a45');
            $('.error-re_new_password').html("{{trans('lang.field_required')}}");
		}else if(new_password!=re_new_password){
            isValid = false;
            $('#re_new_password').css('border','1px solid #e43a45');
            $('.error-re_new_password').html("{{trans('lang.con_password_not_match')}}");
		}else{
            $('#re_new_password').css('border','1px solid #c2cad8');
            $('.error-re_new_password').html('');
		}
		

        return isValid;
    }
    $('#current_password,#new_password,#re_new_password').on('keyup',function(){
        if (savePassword()) {}else{return false;}
    });

    $('#btnChangePassword').on('click',function(){
        if (savePassword()) {}else{return false;}
    });
</script>
@endsection