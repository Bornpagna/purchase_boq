@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col-xs-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-microphone font-dark hide"></i>
						<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
						<span class="caption-helper">{{$small_title}}...</span>
					</div>
					@if(hasRole('admin'))
					<div class="actions">
						<a rounte="{{$rounteSave}}" id="btnAdd" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default">
							<i class="fa fa-plus"></i>
						</a>
						<a href="{{$rounteDownload}}" id="btnDownload" title="{{trans('lang.download')}}" class="btn btn-circle btn-icon-only btn-default">
							<i class="fa fa-download"></i>
						</a>
						<a title="{{trans('lang.download')}}" class="btn btn-circle btn-icon-only btn-default" href="{{$rounteExcel}}">
							<i class="fa fa-file-excel-o"></i>
						</a>
						<a rounte="{{$rounteUploade}}" title="{{trans('lang.upload')}}" class="btn btn-circle btn-icon-only btn-default" id="btnUpload">
							<i class="icon-cloud-upload"></i>
						</a>
					</div>
					@endif
				</div>
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<div class="portlet-body">					
					<div class="row">
					@foreach($data as $row)
						<div class="col-md-4">
							<div class="mt-widget-2">
								<div class="mt-head" style="background-image: url({{ url($row->cover)}});">
									<div class="mt-head-label">
										<button type="button" class="btn btn-xs <?php if($row->status==1){echo "btn-info";}else if($row->status==2){echo "btn-success";}else{echo "btn-danger";}?>"><i class="<?php if($row->status==1 || $row->status==2){echo "fa fa-check";}else{echo "fa fa-ban";} ?>"></i> {{$row->stat}}</button>
									</div>
									<div class="mt-head-user">
										<div class="mt-head-user-img">
											<img src="{{url($row->profile)}}"> </div>
										<div class="mt-head-user-info">
											<span class="mt-user-name">
												<i class="icon-user"></i> {{$row->created_by}}</span>
											<span class="mt-user-time">
												<i class="icon-calendar"></i> {{$row->created_at}} </span>
										</div>
									</div>
								</div>
								<div class="mt-body">
									<h3 class="mt-body-title" style="margin-top: 110px!important;"> {{$row->name}} </h3>
									<p class="mt-body-description" style="margin-top: 5px!important;"> {{$row->address}} </p>
									<ul class="mt-body-stats">
										<li class="font-green" style="margin: 2px!important;">
											<i class="fa fa-phone"></i>{{$row->tel}}</li>
										<li class="font-yellow" style="margin: 2px!important;">
											<i class="fa fa-home"></i>{{$row->email}}</li>
										<li class="font-red" style="margin: 5px!important;">
											<i class="fa fa-globe"></i>{{$row->url}}</li>
									</ul>
									<div class="mt-body-actions">
										<div class="btn-group btn-group btn-group-justified">
											@if(hasRole('admin'))
											<a onclick="onDelete(this)" row_id="{{$row->id}}" row_rounte="{{url('project/delete/'.$row->id)}}" class="btn text-danger">
												<i class="fa fa-remove"></i> {{trans('lang.delete')}}
											</a>
											<a onclick="onEdit(this)" row_id="{{$row->id}}" row_rounte="{{url('project/edit/'.$row->id)}}" class="btn text-warning">
												<i class="fa fa-edit"></i> {{trans('lang.edit')}}
											</a>
											@endif
											<a href="{{url('project/choose/'.$row->id)}}" class="btn text-info">
												<i class="fa fa-sign-in"></i> {{trans('lang.login')}}
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	
	@include('modal.project')
	@include('modal.upload')
@endsection

@if(hasRole('admin'))
	@section('javascript')
		<script type="text/javascript">
			var objName = JSON.parse(convertQuot("{{DB::table('projects')->get()}}"));
			$(function(){
				$("#btnAdd").on("click",function(){
					var rounte = $(this).attr('rounte');
					$('.project-form').attr('action',rounte);
					$('.project-model').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
					$('#old_name').val('');
					$('#pro-name').val('');
					$('#pro-tel').val('');
					$('#pro-email').val('');
					$('#pro-url').val('');
					$('#pro-address').val('');
					
					$('#cover-picture, #profile-picture').attr("src", "{{asset('assets/upload/picture/items/no-image.jpg')}}");
					$('.fileupload-cover,.fileupload-profile').removeClass('fileupload-exists');
					$('.fileupload-cover,.fileupload-profile').addClass('fileupload-new');
					$('.fileupload-cover,.fileupload-profile').children('.fileupload-preview').empty();
					$('#cover-photo, #profile-photo').val('');
					
					$('.button-submit').attr('id','btnSave').attr('name','btnSave');
					$('.button-submit').html('{{trans("lang.save")}}');
					$('.project-model').modal('show');
					
					$("#btnSave").on('click',function(){
						if(chkValid([".pro-name",".pro-tel",".pro-email",".pro-url",".pro-address",".pro-status"])){
							if(chkDublicateName(objName, '#pro-name')){
								$('.project-form').submit();
							}else{
								return false;
							}
						}else{
							return false;
						}
					});
				});

				/* upload file excel */
				$('#btnUpload').on('click',function(){
					var rounte = $(this).attr('rounte');
					$('.upload-excel-form').attr('action',rounte);
					$('.upload-excel-form').modal('show');
					$('#btn_upload_excel').on('click',function(){
						if(onUploadExcel()){}else{return false}
					}); 
				});
				/* end upload file excel */
			});
			
			function onEdit(field){
				var id = $(field).attr('row_id');
				var rounte = $(field).attr('row_rounte');
				var _token = $("input[name=_token]").val();
				$('.project-form').attr('action',rounte);
				$('.project-model').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
				if(objName){
					$.each(objName.filter(c=>c.id==id),function(key,val){
						$('#old_name').val(val.name);
						$('#pro-name').val(val.name);
						$('#pro-tel').val(val.tel);
						$('#pro-email').val(val.email);
						$('#pro-url').val(val.url);
						$('#pro-address').val(val.address);
						$('#pro-status').select2('val',val.status);
						
						if(val.cover=='' || val.cover==null){
							$('#cover-picture').attr("src", "{{asset('assets/upload/picture/items/no-image.jpg')}}");
							$('.fileupload-cover').removeClass('fileupload-exists');
							$('.fileupload-cover').addClass('fileupload-new');
							$('.fileupload-cover').children('.fileupload-preview').empty();
							$('#cover-photo').val('');
						}else{
							$('#cover-picture').attr("src", val.cover);
							$('.fileupload-cover').addClass('fileupload-new');
							$('.fileupload-cover').children('.fileupload-preview').empty();
							$('#cover-photo').val('');
						}
						
						if(val.profile=='' || val.profile==null){
							$('#profile-picture').attr("src", "{{asset('assets/upload/picture/items/no-image.jpg')}}");
							$('.fileupload-profile').removeClass('fileupload-exists');
							$('.fileupload-profile').addClass('fileupload-new');
							$('.fileupload-profile').children('.fileupload-preview').empty();
							$('#profile-photo').val('');
						}else{
							$('#profile-picture').attr("src", val.profile);
							$('.fileupload-profile').addClass('fileupload-new');
							$('.fileupload-profile').children('.fileupload-preview').empty();
							$('#profile-photo').val('');
						}
					});
				}
				$('.button-submit').attr('id','btnUpdate').attr('name','btnUpdate');
				$('.button-submit').html('{{trans("lang.save_change")}}');
				$('.project-model').modal('show');
				
				$("#btnUpdate").on('click',function(){
					if(chkValid([".pro-name",".pro-tel",".pro-email",".pro-url",".pro-address",".pro-status"])){
						if(chkDublicateName(objName, '#pro-name','#old_name')){
							$('.project-form').submit();
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
	@endsection
@endif