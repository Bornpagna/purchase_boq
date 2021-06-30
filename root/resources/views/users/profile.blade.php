@extends('layouts.app')

@section('stylesheet')
	<link href="{{asset('/assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/signature_pad/example/css/signature-pad.css') }}" rel="stylesheet" />
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
				<div class="profile-sidebar">
					<div class="portlet light profile-sidebar-portlet ">
						<div class="profile-userpic">
							@if(Auth::user()->photo=='' || Auth::user()->photo==null)
								<img src='{{asset("assets/upload/picture/items/no-image.jpg")}}' alt="" />
							@else
								<img src="{{ asset('assets/upload/picture/users/'.Auth::user()->photo) }}" class="img-responsive" alt=""> 
							@endif
						</div>
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">{{Auth::user()->name}}</div>
							<div class="profile-usertitle-job"> {{Session::get('name')}} </div>
						</div>
						<div class="profile-usermenu">
							<ul class="nav">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="profile-content">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet light ">
								<div class="portlet-title tabbable-line">
									<div class="caption caption-md">
										<i class="icon-globe theme-font hide"></i>
										<span class="caption-subject font-blue-madison bold uppercase">{{$title}}</span>
									</div>
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#tab_1_1" data-toggle="tab" class="bold">{{trans('lang.personal_info')}}</a>
										</li>
										<li>
											<a href="#tab_1_2" data-toggle="tab" class="bold">{{trans('lang.change_image')}}</a>
										</li>
										<li>
											<a href="#tab_1_3" data-toggle="tab" class="bold">{{trans('lang.change_password')}}</a>
										</li>
									</ul>
								</div>
								<div class="portlet-body">
									<div class="tab-content">
										<!-- PERSONAL INFO TAB -->
										<div class="tab-pane active" id="tab_1_1">
											<form role="form" action="{{url('user/profile/update/info')}}" method="post"  enctype="multipart/form-data">
												{{csrf_field()}}
												<div class="form-group">
													<label class="control-label bold">{{trans('lang.name')}}
														<span class="required">*</span>
													</label>
													<input type="text" id="name" name="name" placeholder="{{trans('lang.name')}}" class="form-control" value="{{Auth::user()->name}}" /> 
													<span class="help-block error-name font-red bold"></span>
												</div>
												<div class="form-group">
													<label class="control-label bold">{{trans('lang.email')}}
														<span class="required">*</span>
													</label>
													<input type="email" id="email" name="email" placeholder="{{trans('lang.email')}}" class="form-control" value="{{Auth::user()->email}}" /> 
													<span class="help-block error-email font-red bold"></span>
												</div>
												<div class="form-group">
													<label class="control-label bold">{{trans('lang.tel')}}
														<span class="required">*</span>
													</label>
													<input type="text" id="tel" name="tel" placeholder="{{trans('lang.tel')}}" class="form-control" value="{{Auth::user()->tel}}" /> 
													<span class="help-block error-tel font-red bold"></span>
												</div>
												<div class="form-group">
													<label class="control-label bold">{{trans('lang.position')}}
														<span class="required">*</span>
													</label>
													<input type="text" id="position" name="position" placeholder="{{trans('lang.position')}}" class="form-control" value="{{Auth::user()->position}}" /> 
													<span class="help-block error-position font-red bold"></span>
												</div>
												<hr/>
												<div class="margiv-top-10">
													<button type="submit" class="btn green" id="btnChangeInfo" name="btnChangeInfo" value="info"> {{trans('lang.save_change')}} </button>
												</div>
											</form>
										</div>
										<!-- END PERSONAL INFO TAB -->
										<!-- CHANGE AVATAR TAB -->
										<div class="tab-pane" id="tab_1_2">
											<form action="{{url('/user/profile/update/image')}}" role="form" method="post"  enctype="multipart/form-data">
												{{csrf_field()}}
												<div class="row">
													<div class="col-md-4">
														<label class="control-label bold">{{trans('lang.profile_pic')}}
															<span class="required">*</span>
														</label>
														<div class="form-group">
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																	@if(Auth::user()->photo=='' || Auth::user()->photo==null)
																		<img src='{{asset("assets/upload/picture/items/no-image.jpg")}}' alt="" />
																	@else
																		<img src='{{ asset("assets/upload/picture/users/".Auth::user()->photo)}}' alt="" />
																	@endif
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																<div>
																	<span class="btn blue btn-file">
																		<span class="fileinput-new"> {{trans('lang.select_image')}} </span>
																		<span class="fileinput-exists"> {{trans('lang.change')}} </span>
																		<input type="file" name="image" id="image" accept="image/*" /> 
																	</span>
																	<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('lang.remove')}} </a>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<label class="control-label bold">{{trans('lang.user_signature')}}
															<span class="required">*</span>
														</label>
														<div class="form-group">															
															<div class="fileinput fileinput-new" data-provides="fileinput">
																<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																	@if(Auth::user()->signature=='' || Auth::user()->signature==null)
																		<img src='{{asset("assets/upload/picture/items/no-image.jpg")}}' alt="" />
																	@else
																		<img src='{{ asset("assets/upload/picture/signature/".Auth::user()->signature)}}' alt="" />
																	@endif
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
																<div>
																	<span class="btn blue btn-file">
																		<span class="fileinput-new"> {{trans('lang.select_image')}} </span>
																		<span class="fileinput-exists"> {{trans('lang.change')}} </span>
																		<input type="file" name="signature" id="signature" accept="image/*" /> 
																	</span>
																	<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('lang.remove')}} </a>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<label class="control-label bold">{{trans('lang.signature')}}
															<span class="required">*</span>
														</label>
														<div class="form-group">
															<input type="hidden" name="signature_pad" id="signature_pad" />
															<div id="signature-pad" class="my-signature-pad m-signature-pad" style="width:345px !important;">
																<div class="m-signature-pad--body">
																  <canvas id="canvas_sign"></canvas>
																</div>
																<div class="m-signature-pad--footer">
																  <div class="description">Sign above</div>
																  <button type="button" id="clear" class="button clear" data-action="clear">Clear</button>
																  <button type="button" id="saveSignature" class="button save" data-action="save">Save</button>
																</div>
															</div>
														</div>
													</div>
												</div>
												<hr/>
												<div class="margin-top-10">
													<button type="submit" class="btn green" id="btnChangeImage" name="btnChangeImage" value="image"> {{trans('lang.save_change')}} </button>
												</div>
											</form>
										</div>
										<!-- END CHANGE AVATAR TAB -->
										<!-- CHANGE PASSWORD TAB -->
										<div class="tab-pane" id="tab_1_3">
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
												<hr/>
												<div class="margin-top-10">
													<button type="submit" class="btn green" id="btnChangePassword" name="btnChangePassword" value="password"> {{trans('lang.change_password')}} </button>
												</div>
											</form>
										</div>
										<!-- END CHANGE PASSWORD TAB -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('assets/signature_pad/example/js/signature_pad.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    function duplicateEmail(email) {
        var isDuplicate = false;
        var users = JSON.parse(convertQuot('{{$users}}'));
        if (users) {
            $.each(users.filter(a=>a.email==email && a.email!='{{Auth::user()->email}}'),function(key,val){
                if (val) {isDuplicate=true;}else{isDuplicate=false;}
            });
        }else{
            isDuplicate = false;
        }
        return isDuplicate;
    }

    function saveInfo() {
        var isValid = true;
        var name = $('#name').val();
        var email = $('#email').val();
        var tel = $('#tel').val();
        var position = $('#position').val();

        if (tel=='' || tel==null || tel==undefined) {
            isValid = false;
            $('#tel').css('border','1px solid #e43a45');
            $('.error-tel').html("{{trans('lang.field_required')}}");
		}else if(tel.length < 1 || tel.length > 20){
            isValid = false;
            $('#tel').css('border','1px solid #e43a45');
            $('.error-tel').html("{{trans('lang.tel_min_max')}}");
		}else{
            $('#tel').css('border','1px solid #c2cad8');
            $('.error-tel').html('');
		}
		
		if (position=='' || position==null || position==undefined) {
            isValid = false;
            $('#position').css('border','1px solid #e43a45');
            $('.error-position').html("{{trans('lang.field_required')}}");
		}else{
            $('#position').css('border','1px solid #c2cad8');
            $('.error-position').html('');
		}

       if (name=='' || name==null || name==undefined) {
            isValid = false;
            $('#name').css('border','1px solid #e43a45');
            $('.error-name').html("{{trans('lang.field_required')}}");
       }else if(name.length < 1 || name.length > 20){
            isValid = false;
            $('#name').css('border','1px solid #e43a45');
            $('.error-name').html("{{trans('lang.name_min_max')}}");
       }else{
            $('#name').css('border','1px solid #c2cad8');
            $('.error-name').html('');
       }

       if (validateEmail(email)==false) {
            isValid = false;
            $('#email').css('border','1px solid #e43a45');
            $('.error-email').html("{{trans('lang.email_invalid')}}");
        }else if(duplicateEmail(email)){
            isValid = false;
            $('#email').css('border','1px solid #e43a45');
            $('.error-email').html("{{trans('lang.field_unique')}}");
		}else if(email=='' || email==null || email==undefined){
            isValid = false;
            $('#email').css('border','1px solid #e43a45');
            $('.error-email').html("{{trans('lang.field_required')}}");
		}else if(email.length > 50){
            isValid = false;
            $('#email').css('border','1px solid #e43a45');
            $('.error-email').html("{{trans('lang.email_invalid')}}");
		}else{
            $('#email').css('border','1px solid #c2cad8');
            $('.error-email').html('');
		}

       return isValid;
    }

    function bcrypt(password) {
        return $.ajax({url:'{{url("/user/bcrypt")}}/'+password,type:'get',async:false}).responseText;
    }

    function saveImage() {
		var image = $('#image').val();
		var signature = $('#signature').val();
		var signature_pad = $('#signature_pad').val();
		if ((image!='' && image!=null) ||  (signature!='' && signature!=null) ||  (signature_pad!='' && signature_pad!=null)) {
            return true;
		}else{
			return false;
		}
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
	
	$('#name,#email,#tel').on('keyup',function(){
        if (saveInfo()) {}else{return false;}
    });

    $('#btnChangeInfo').on('click',function(){
        if (saveInfo()) {}else{return false;}
    });

    /* $('#btnChangeImage').on('click',function(){
        if (saveImage()) {}else{return false;}
    }); */

    $('#current_password,#new_password,#re_new_password').on('keyup',function(){
        if (savePassword()) {}else{return false;}
    });

    $('#btnChangePassword').on('click',function(){
        if (savePassword()) {}else{return false;}
    });
	
	$(function(){		
		var canvas = document.querySelector("canvas");
		var signaturePad = new SignaturePad(canvas);
		signaturePad.penColor = "rgb(51, 122, 183)";
		var saveButton = document.getElementById('saveSignature');
		var cancelButton = document.getElementById('clear');		

		$('#btnChangeImage').click(function(){
			var data = signaturePad.toDataURL('image/png');
			if(!signaturePad.isEmpty()){
				$('#signature_pad').val(data);
			}
			if (saveImage()) {}else{return false;}
		});

		cancelButton.addEventListener('click', function (event) {
		  signaturePad.clear();
		});

		saveButton.addEventListener("click", function (event) {
			if (signaturePad.isEmpty()) {
				alert("Please provide signature first.");
			} else {
				var win=window.open();
				win.document.write("<img src='"+signaturePad.toDataURL()+"'/>");
				/* window.open(signaturePad.toDataURL()); */
			}
		});
	});
</script>
@endsection