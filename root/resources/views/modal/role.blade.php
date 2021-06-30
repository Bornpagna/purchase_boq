<form class="role-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="role-old-name" name="old_name">
	<div class="role-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div id="div-parent-role">
						
						</div>
						<div class="form-group">
							<label for="role-name" class="col-md-3 control-label bold">{{trans('lang.name')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="50" id="role-name" name="name" class="role-name form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						
						<div id="div-zone-role">
						
						</div>
						<div class="form-group">
							<label for="role-amount" class="col-md-3 control-label bold">{{trans('lang.min_amount')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" length="11" step="any" id="role-amount" name="min_amount" class="role-amount form-control noscroll" placeholder="{{trans('lang.enter_number')}}" />
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="role-amount" class="col-md-3 control-label bold">{{trans('lang.max_amount')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" length="11" step="any" id="role-amount2" name="max_amount" class="role-amount2 form-control noscroll" placeholder="{{trans('lang.enter_number')}}" />
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="role-amount" class="col-md-3 control-label bold">{{trans('lang.condition')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select name="condition" id="role-condition" class="form-control role-zone my-select2">
									<option value="and">AND</option>
									<option value="or">OR</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success button-submit" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>