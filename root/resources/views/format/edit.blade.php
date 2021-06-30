@extends('layouts.app')

@section('content')
 <div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="{{url('/')}}">{{ trans('template.dashboard') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="{{ url('/format/index') }}">{{ trans('template.format_list') }}</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>{{ trans('template.edit') }}</span>
		</li>
	</ul>
</div>
<br/>
<div class="row">
	<div class="col-md-9">
		<div class="portlet light portlet-fit portlet-form bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-green"></i>
					<span class="caption-subject font-green sbold uppercase"><strong>{{ trans('template.enter_format_info') }}</strong></span>
				</div>
			</div>
			<div class="portlet-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('format/update') }}">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$data->id}}">
					<input type="hidden" name="old_format_code" value="{{$data->format_code}}">
					<input type="hidden" name="example" value="{{$data->example}}">
					<div class="form-body">
						<?php if(Session::has('success')):?>
							<div class="alert alert-success display-show">
								<button class="close" data-close="alert"></button><strong>{{ trans('template.success') }}!</strong> {{Session::get('success')}}
							</div>
						<?php elseif(Session::has('fail')):?>
							<div class="alert alert-danger display-show">
								<button class="close" data-close="alert"></button><strong>{{ trans('template.fail') }}!</strong> {{Session::get('fail')}} 
							</div>
						<?php endif; ?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('format_code') ? ' has-error' : '' }}">
									<label for="format_code" class="col-md-4 control-label"><strong>{{ trans('template.code') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="format_code" type="text" class="form-control" placeholder="Enter code" name="format_code" value="{{ $data->format_code }}" autofocus>
										@if ($errors->has('format_code'))
											<span class="help-block">
												<strong>{{ $errors->first('format_code') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
									<label for="prefix" class="col-md-4 control-label"><strong>{{ trans('template.prefix') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="prefix" type="text" class="form-control" placeholder="A-!YY!!MM!!DD!" name="prefix" value="{{ $data->prefix }}">
										@if ($errors->has('prefix'))
											<span class="help-block">
												<strong>{{ $errors->first('prefix') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
									<label for="length" class="col-md-4 control-label"><strong>{{ trans('template.length') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="length" type="number" class="form-control" placeholder="3" name="length" value="{{ $data->length }}">
										@if ($errors->has('length'))
											<span class="help-block">
												<strong>{{ $errors->first('length') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}">
									<label for="interval" class="col-md-4 control-label"><strong>{{ trans('template.interval') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="interval" type="number" class="form-control" placeholder="1" name="interval" value="{{ $data->interval }}">
										@if ($errors->has('interval'))
											<span class="help-block">
												<strong>{{ $errors->first('interval') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
									<label for="type" class="col-md-4 control-label"><strong>{{ trans('template.invoice_type') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$type=array(
											'PO' => 'Purchase Order',
											'PI' => 'Purchase Invoice',
											'SQ' => 'Sale Quote',
											'SI' => 'Sale Invoice',
											'POSI' => 'Sale POS Invoice',
										);
										$type=array_merge([''=>'--- '.trans("template.please_select").' ---'],$type);
									?>
									<div class="col-md-8">
										{{ Form::select('type', $type, $data->type, ['id' => 'type','class'=>'form-control select2']) }}
										@if ($errors->has('type'))
											<span class="help-block">
												<strong>{{ $errors->first('type') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('format_name') ? ' has-error' : '' }}">
									<label for="format_name" class="col-md-4 control-label"><strong>{{ trans('template.name') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="format_name" type="text" class="form-control" placeholder="Enter name" name="format_name" value="{{ $data->format_name }}">
										@if ($errors->has('format_name'))
											<span class="help-block">
												<strong>{{ $errors->first('format_name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('subfix') ? ' has-error' : '' }}">
									<label for="subfix" class="col-md-4 control-label"><strong>{{ trans('template.subfix') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="subfix" type="text" class="form-control" placeholder="AB" name="subfix" value="{{ $data->subfix }}">
										@if ($errors->has('subfix'))
											<span class="help-block">
												<strong>{{ $errors->first('subfix') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('start_from') ? ' has-error' : '' }}">
									<label for="start_from" class="col-md-4 control-label"><strong>{{ trans('template.start_from') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="start_from" type="number" class="form-control" placeholder="1" name="start_from" value="{{ $data->start_from }}">
										@if ($errors->has('start_from'))
											<span class="help-block">
												<strong>{{ $errors->first('start_from') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('duration_round') ? ' has-error' : '' }}">
									<label for="duration_round" class="col-md-4 control-label"><strong>{{ trans('template.round') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$duration_round=array(
											'N' => 'Round Never',
											'D' => 'Round Day',
											'M' => 'Round Month',
											'Y' => 'Round Year',
										);
										$duration_round=array_merge([''=>'--- '.trans("template.please_select").' ---'],$duration_round);
									?>
									<div class="col-md-8">
										{{ Form::select('duration_round', $duration_round, $data->duration_round, ['id' => 'duration_round','class'=>'form-control select2']) }}
										@if ($errors->has('duration_round'))
											<span class="help-block">
												<strong>{{ $errors->first('duration_round') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
									<label for="status" class="col-md-4 control-label"><strong>{{ trans('template.status') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$status=array(
											'0' => trans("template.active"),
											'1' => trans("template.disable"),
										);
										$status=array_merge([''=>'--- '.trans("template.please_select").' ---'],$status);
									?>
									<div class="col-md-8">
										{{ Form::select('status', $status, $data->status, ['id' => 'status','class'=>'form-control select2']) }}
										@if ($errors->has('status'))
											<span class="help-block">
												<strong>{{ $errors->first('status') }}</strong>
											</span>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-4 col-md-8">
								<button type="submit" class="btn btn-primary"> <i class="fa fa-edit"> </i> <strong>{{ trans('template.save_change') }}</strong></button>
								<a href="{{ url('/format/index') }}" class="btn btn-danger btn-outline"> <i class="fa fa-close"> </i> <strong>{{ trans('template.cancel') }}</strong></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-gift"></i>View Info</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"> </a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="tabbable-custom nav-justified">
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection
