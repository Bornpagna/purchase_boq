@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit portlet-form bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title}}</span>
				</div>
			</div>
			<div class="portlet-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('format/insert') }}">
					{{ csrf_field() }}
					<input type="hidden" name="example" value="A-170628/001AB">
					<div class="form-body">
						<?php if(Session::has('success')):?>
							<div class="alert alert-success display-show">
								<button class="close" data-close="alert"></button><strong>{{ trans('lang.success') }}!</strong> {{Session::get('success')}}
							</div>
						<?php elseif(Session::has('error')):?>
							<div class="alert alert-danger display-show">
								<button class="close" data-close="alert"></button><strong>{{ trans('lang.fail') }}!</strong> {{Session::get('fail')}} 
							</div>
						<?php endif; ?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group{{ $errors->has('format_code') ? ' has-error' : '' }}">
									<label for="format_code" class="col-md-4 control-label"><strong>{{ trans('lang.code') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="format_code" type="text" class="form-control" placeholder="Enter code" name="format_code" value="{{ old('format_code') }}" autofocus>
										@if ($errors->has('format_code'))
											<span class="help-block">
												<strong>{{ $errors->first('format_code') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
									<label for="prefix" class="col-md-4 control-label"><strong>{{ trans('lang.prefix') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="prefix" type="text" class="form-control" placeholder="A-!YY!!MM!!DD!" name="prefix" value="{{ old('prefix') }}">
										@if ($errors->has('prefix'))
											<span class="help-block">
												<strong>{{ $errors->first('prefix') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('length') ? ' has-error' : '' }}">
									<label for="length" class="col-md-4 control-label"><strong>{{ trans('lang.length') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="length" type="number" class="form-control" placeholder="3" name="length" value="{{ old('length') }}">
										@if ($errors->has('length'))
											<span class="help-block">
												<strong>{{ $errors->first('length') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}">
									<label for="interval" class="col-md-4 control-label"><strong>{{ trans('lang.interval') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="interval" type="number" class="form-control" placeholder="1" name="interval" value="{{ old('interval') }}">
										@if ($errors->has('interval'))
											<span class="help-block">
												<strong>{{ $errors->first('interval') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
									<label for="type" class="col-md-4 control-label"><strong>{{ trans('lang.invoice_type') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$type=array(
											'PO'  => 'Purchase Order',
											'PR'  => 'Purchase Request',
											'DEL' => 'Delivery Note',
											'RED' => 'Delivery Return',
											'USE' => 'Usage Item',
											'REU' => 'Usage Return',
											'ENT' => 'Stock Entry',
											'MOV' => 'Stock Movemoment',
											'ADJ' => 'Stock Adjustment',
											'IMP' => 'Stock Import',
										);
										$type=array_merge([''=>'--- '.trans("lang.please_select").' ---'],$type);
									?>
									<div class="col-md-8">
										{{ Form::select('type', $type, old('type'), ['id' => 'type','class'=>'form-control select2']) }}
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
									<label for="format_name" class="col-md-4 control-label"><strong>{{ trans('lang.name') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="format_name" type="text" class="form-control" placeholder="Enter name" name="format_name" value="{{ old('format_name') }}">
										@if ($errors->has('format_name'))
											<span class="help-block">
												<strong>{{ $errors->first('format_name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('subfix') ? ' has-error' : '' }}">
									<label for="subfix" class="col-md-4 control-label"><strong>{{ trans('lang.subfix') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="subfix" type="text" class="form-control" placeholder="AB" name="subfix" value="{{ old('subfix') }}">
										@if ($errors->has('subfix'))
											<span class="help-block">
												<strong>{{ $errors->first('subfix') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('start_from') ? ' has-error' : '' }}">
									<label for="start_from" class="col-md-4 control-label"><strong>{{ trans('lang.start_from') }}</strong>
										<span class="required"> * </span>
									</label>
									<div class="col-md-8">
										<input id="start_from" type="number" class="form-control" placeholder="1" name="start_from" value="{{ old('start_from') }}">
										@if ($errors->has('start_from'))
											<span class="help-block">
												<strong>{{ $errors->first('start_from') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('duration_round') ? ' has-error' : '' }}">
									<label for="duration_round" class="col-md-4 control-label"><strong>{{ trans('lang.round') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$duration_round=array(
											'N' => 'Never',
											'D' => 'Round Day',
											'M' => 'Round Month',
											'Y' => 'Round Year',
										);
										$duration_round=array_merge([''=>'--- '.trans("lang.please_select").' ---'],$duration_round);
									?>
									<div class="col-md-8">
										{{ Form::select('duration_round', $duration_round, old('duration_round'), ['id' => 'duration_round','class'=>'form-control select2']) }}
										@if ($errors->has('duration_round'))
											<span class="help-block">
												<strong>{{ $errors->first('duration_round') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
									<label for="status" class="col-md-4 control-label"><strong>{{ trans('lang.status') }}</strong>
										<span class="required"> * </span>
									</label>
									<?php 
										$status=array(
											'0' => trans("lang.active"),
											'1' => trans("lang.disable"),
										);
										$status=array_merge([''=>'--- '.trans("lang.please_select").' ---'],$status);
									?>
									<div class="col-md-8">
										{{ Form::select('status', $status, old('status'), ['id' => 'status','class'=>'form-control select2']) }}
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
					
					<div class="form-actions right">
						<div class="row">
							<div class="col-md-12">
								<button type="submit" name="save" value="s" class="btn btn-primary"> <i class="fa fa-save"> </i> <strong>{{ trans('lang.save') }}</strong></button>
								<button type="submit" name="save_new" value="sn" class="btn btn-info"><strong>{{ trans('lang.save_new') }}</strong></button>
								<a href="{{ url('/format/index') }}" class="btn btn-danger btn-outline"> <i class="fa fa-close"> </i> <strong>{{ trans('lang.cancel') }}</strong></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">

</script>
@endsection
