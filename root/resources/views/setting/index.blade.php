@extends('layouts.app')

@section('stylesheet')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="{{ asset('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css') }}" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-red-sunglo"></i>
					<span class="caption-subject font-red-sunglo bold uppercase">{{$title}}</span>
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
				<?php if(Session::has('bug') && count(Session::get('bug')>0)): ?>
					<?php
						echo '<div class="alert alert-danger display-show"><button class="close" data-close="alert"></button>';
						foreach(Session::get('bug') as $key=>$val){
							echo '<strong>'.trans('lang.error').'!</strong>'.trans('lang.dublicate_at_record').' '.$val['index'].'<br/>';
						}
						echo '</div>';
					?>
				<?php endif; ?>
			
				<form class="form-horizontal" method="POST" action="{{$rounteSave}}" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-body">
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="app_name" class="control-label bold col-md-4">{{trans('lang.app_name')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->app_name}}" class="form-control app_name" id="app_name" name="app_name" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="report_header" class="col-md-4 control-label bold">{{trans('lang.report_header')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->report_header}}" class="form-control report_header" id="report_header" name="report_header" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="company_name" class="col-md-4 control-label bold">{{trans('lang.company_name')}} 
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->company_name}}" class="form-control company_name" id="company_name" name="company_name" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="company_phone" class="control-label bold col-md-4">{{trans('lang.company_phone')}} 
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->company_phone}}" class="form-control company_phone" id="company_phone" name="company_phone" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="company_email" class="col-md-4 control-label bold">{{trans('lang.company_email')}} 
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->company_email}}" class="form-control company_email" id="company_email" name="company_email" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="company_address" class="col-md-4 control-label bold">{{trans('lang.company_address')}} 
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->company_address}}" class="form-control company_address" id="company_address" name="company_address" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="round_number" class="col-md-4 control-label bold">{{trans('lang.round_number')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 round_number" id="round_number" name="round_number">
											<option value=""></option>
											<option value="2">2 - example(1,000.00)</option>
											<option value="3">3 - example(1,000.000)</option>
											<option value="4">4 - example(1,000.0000)</option>
											<option value="5">5 - example(1,000.00000)</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="round_dollar" class="col-md-4 control-label bold">{{trans('lang.round_dollar')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 round_dollar" id="round_dollar" name="round_dollar">
											<option value=""></option>
											<option value="2">2 - example($1,000.00)</option>
											<option value="3">3 - example($1,000.000)</option>
											<option value="4">4 - example($1,000.0000)</option>
											<option value="5">5 - example($1,000.00000)</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="format_date" class="col-md-4 control-label bold">{{trans('lang.format_date')}} </label>
									<div class="col-md-8">
										<select class="form-control select2 format_date" id="format_date" name="format_date">
											<option value=""></option>
											<option value="mm/dd/yyyy">mm/dd/yyyy</option>
											<option value="dd-mm-yyyy">dd-mm-yyyy</option>
											<option value="yyyy/mm/dd">yyyy/mm/dd</option>
											<option value="yyyy-mm-dd">yyyy-mm-dd</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="allow_zone" class="col-md-4 control-label bold">{{trans('lang.allow_zone')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 allow_zone" id="allow_zone" name="allow_zone">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="allow_block" class="col-md-4 control-label bold">{{trans('lang.allow_block')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 allow_block" id="allow_block" name="allow_block">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="image_size" class="col-md-4 control-label bold">{{trans('lang.image_size')}} </label>
									<div class="col-md-8">
										<select class="form-control select2 image_size" id="image_size" name="image_size">
											<option value=""></option>
											<option value="0,0">Original Size</option>
											<option value="50,50">50 x 50</option>
											<option value="100,100">100 x 100</option>
											<option value="150,150">150 x 150</option>
											<option value="200,200">200 x 200</option>
											<option value="300,300">300 x 300</option>
											<option value="400,400">400 x 400</option>
											<option value="500,500">500 x 500</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="usage_constructor" class="col-md-4 control-label bold">{{trans('lang.usage_constructor')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 usage_constructor" id="usage_constructor" name="usage_constructor">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="return_constructor" class="col-md-4 control-label bold">{{trans('lang.return_constructor')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 return_constructor" id="return_constructor" name="return_constructor">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="request_photo" class="col-md-4 control-label bold">{{trans('lang.request_photo')}} </label>
									<div class="col-md-8">
										<select class="form-control select2 request_photo" id="request_photo" name="request_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="order_photo" class="col-md-4 control-label bold">{{trans('lang.order_photo')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 order_photo" id="order_photo" name="order_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="delivery_photo" class="col-md-4 control-label bold">{{trans('lang.delivery_photo')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 delivery_photo" id="delivery_photo" name="delivery_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="return_delivery_photo" class="col-md-4 control-label bold">{{trans('lang.return_delivery_photo')}} </label>
									<div class="col-md-8">
										<select class="form-control select2 return_delivery_photo" id="return_delivery_photo" name="return_delivery_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class=" col-md-4">
								<div class="form-group">
									<label for="usage_photo" class="col-md-4 control-label bold">{{trans('lang.usage_photo')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 usage_photo" id="usage_photo" name="usage_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="return_usage_photo" class="col-md-4 control-label bold">{{trans('lang.return_usage_photo')}} 
									</label>
									<div class="col-md-8">
										<select class="form-control select2 return_usage_photo" id="return_usage_photo" name="return_usage_photo">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" col-md-4">
								<div class="form-group">
									<label for="modal_header_color" class="control-label bold col-md-4">{{trans('lang.modal_header_color')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->modal_header_color}}" data-control="saturation" class="form-control demo modal_header_color" id="modal_header_color" name="modal_header_color" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-4 control-label bold">{{trans('lang.app_logo')}} *</label>
									<div class="col-md-8">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail app_logo" style="width: 200px; height: 150px;">
												<img class="img-temp" src="{{asset('assets/upload/temps/app_logo.png')}}" alt="" /> 
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
											<div>
												<span class="btn blue btn-file">
													<span class="fileinput-new bold">{{trans('lang.select_image')}}</span>
													<span class="fileinput-exists bold">{{trans('lang.change')}}</span>
													<input type="file" id="app_logo" name="app_logo" /> 
												</span>
												<a href="javascript:;" class="btn red fileinput-exists bold" data-dismiss="fileinput">{{trans('lang.remove')}}</a>
											</div>
											<span class="help-block font-red bold"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="col-md-4 control-label bold">{{trans('lang.app_icon')}} *</label>
									<div class="col-md-8">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail app_icon" style="width: 200px; height: 150px;">
												<img class="img-temp" src="{{asset('assets/upload/temps/app_icon.png')}}" alt="" /> 
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
											<div>
												<span class="btn blue btn-file">
													<span class="fileinput-new bold ">{{trans('lang.select_image')}}</span>
													<span class="fileinput-exists bold">{{trans('lang.change')}}</span>
													<input type="file" id="app_icon" name="app_icon" /> 
												</span>
												<a href="javascript:;" class="btn red fileinput-exists bold" data-dismiss="fileinput">{{trans('lang.remove')}}</a>
											</div>
											<span class="help-block font-red bold"></span>
										</div>
									</div>
								</div>
							</div>
							
							<div class=" col-md-4">
								<div class="form-group">
									<label for="modal_title_color" class="control-label bold col-md-4">{{trans('lang.modal_title_color')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input type="text" value="{{$row->modal_title_color}}"  data-control="saturation" class="form-control demo modal_title_color" id="modal_title_color" name="modal_title_color" placeholder="{{trans('lang.enter_text')}}"/>
									</div>
								</div>
								<!-- is costing -->
								<div class="form-group">
									<label for="modal_title_color" class="control-label bold col-md-4">{{trans('lang.is_costing')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<select class="form-control select2 is_costing" id="is_costing" name="is_costing">
											<option value=""></option>
											<option value="1">{{trans('lang.yes')}}</option>
											<option value="0">{{trans('lang.no')}}</option>
										</select>
									</div>
								</div>
								<!-- account stock -->
								<div class="form-group">
									<label for="modal_title_color" class="control-label bold col-md-4">{{trans('lang.account_stock')}} 
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<select class="form-control select2 stock_account" id="stock_account" name="stock_account">
											<option value=""></option>
											<option value="FIFO">FIFO</option>
											<option value="LIFO">LIFO</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions text-right">
						<button type="submit" id="btnSave" name="btnSave" value="1" class="btn green bold">
							<i class="fa fa-save"></i> {{trans('lang.save_change')}}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection()

@section('javascript')
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{ asset('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js') }}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	
<script type="text/javascript">
	$(document).ready(function(){
		$.fn.select2.defaults.set('theme','classic');
        $('.select2').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});
		$('.demo').colorpicker();
		
		$("#round_number").select2('val','{{$row->round_number}}');
		$("#round_dollar").select2('val','{{$row->round_dollar}}');
		$("#format_date").select2('val','{{$row->format_date}}');
		$("#allow_zone").select2('val','{{$row->allow_zone}}');
		$("#allow_block").select2('val','{{$row->allow_block}}');
		$("#image_size").select2('val','{{$row->image_size}}');
		$("#usage_constructor").select2('val','{{$row->usage_constructor}}');
		$("#return_constructor").select2('val','{{$row->return_constructor}}');
		$("#request_photo").select2('val','{{$row->request_photo}}');
		$("#order_photo").select2('val','{{$row->order_photo}}');
		$("#delivery_photo").select2('val','{{$row->delivery_photo}}');
		$("#return_delivery_photo").select2('val','{{$row->return_delivery_photo}}');
		$("#usage_photo").select2('val','{{$row->usage_photo}}');
		$("#return_usage_photo").select2('val','{{$row->return_usage_photo}}');
		$("#stock_account").select2('val','{{$row->stock_account}}');
		$("#is_costing").select2('val','{{$row->is_costing}}');
	});
</script>
@endsection()