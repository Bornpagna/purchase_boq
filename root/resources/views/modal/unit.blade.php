<form class="system-form form-horizontal" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="old_from_code" name="old_from_code">
	<input type="hidden" id="old_to_code" name="old_to_code">
	<div class="system-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12 text-center	">
								<span class="show-message-error center font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.from_code')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="10" id="from_code" name="from_code" class="from_code form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.from_desc')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="15" id="from_desc" name="from_desc" class="from_desc form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.to_code')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="10" id="to_code" name="to_code" class="to_code form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.to_desc')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="15" id="to_desc" name="to_desc" class="to_desc form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.factor')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" length="100" step="any" id="factor" name="factor" class="factor form-control" placeholder="{{trans('lang.enter_number')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.status')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select id="status" name="status" class="status my-select2 form-control">
									<option value="1">{{trans('lang.active')}}</option>
									<option value="0">{{trans('lang.disable')}}</option>
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success button-submit" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>