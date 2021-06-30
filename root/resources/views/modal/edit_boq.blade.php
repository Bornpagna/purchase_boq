<form class="form-edit-boq form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="modal-edit-boq draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 text-center	">
							<span class="show-message-error-edit center font-red bold"></span>
						</div>
					</div>
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="boq-street-edit" class="col-md-3 control-label bold">{{trans('lang.street')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<select name="street_id" id="boq-street-edit" class="form-control boq-street-edit my-select2">
											<option value=""></option>
											{{getSystemData('ST')}}
										</select>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="boq-house-edit" class="col-md-3 control-label bold" id="label-house">{{trans('lang.house_no')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<select name="house_id" id="boq-house-edit" class="form-control boq-house-edit my-select2">
										
										</select>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="item" class="col-md-3 control-label bold">{{trans('lang.items')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<select name="item_id" id="item" class="form-control my-select2 item">
											<option value=""></option>
										</select>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="unit" class="col-md-3 control-label bold">{{trans('lang.units')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<select name="unit" id="unit" class="form-control my-select2 unit">
											<option value=""></option>
										</select>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="qty_std" class="col-md-3 control-label bold">{{trans('lang.qty_std')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<input type="number" length="11" id="qty_std" class="form-control qty_std" name="qty_std" placeholder="{{trans('lang.enter_number')}}" />
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="boq-house-edit" class="col-md-3 control-label bold" id="label-house">{{trans('lang.qty_add')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<input type="number" length="11" id="qty_add" class="form-control qty_add" name="qty_add" placeholder="{{trans('lang.enter_number')}}" />
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success button-submit-edit" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>