<form class="warehouse-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="old_name" name="old_name">
	<div class="warehouse-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.name')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="50" id="name" name="name" class="name form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.user_control')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select id="user_control" name="user_control" class="user_control my-select2 form-control">
									{{getUsers()}}
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.tel')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="20" id="tel" name="tel" class="tel form-control" placeholder="{{trans('lang.enter_text')}}">
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
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.address')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<textarea length="200" id="address" name="address" rows="10" data-height="80" class="address form-control" placeholder="{{trans('lang.enter_text')}}"></textarea>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success button-submit-warehouse" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>