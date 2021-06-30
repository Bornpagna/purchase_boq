<form class="constructor-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="old_id_card" name="old_id_card">
	<div class="constructor-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.id_card')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="20" id="id_card" name="id_card" class="id_card form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.name')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="50" id="con-name" name="name" class="con-name form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.tel')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="20" id="con-tel" name="tel" class="con-tel form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.type')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select id="con-type" name="type" class="con-type my-select2 form-control">
									<option></option>
									<option value="1">{{trans('lang.engineer')}}</option>
									<option value="2">{{trans('lang.sub_const')}}</option>
									<option value="3">{{trans('lang.worker')}}</option>
									<option value="4">{{trans('lang.security')}}</option>
									<option value="5">{{trans('lang.driver')}}</option>
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.status')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select id="con-status" name="status" class="con-status my-select2 form-control">
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
								<textarea length="200" id="con-address" name="address" rows="10" data-height="80" class="con-address form-control" placeholder="{{trans('lang.enter_text')}}"></textarea>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success button-submit-constructor" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>