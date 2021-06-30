<form class="system-form-edit form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="system-modal-edit draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.supplier')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select name="supplier" id="supplier" class="form-control my-select2 supplier">
									<option value=""></option>
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="item" class="col-md-3 control-label bold">{{trans('lang.items')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select name="item" id="item" class="form-control my-select2 item">
									<option value=""></option>
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
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
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.price')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="number" step="any" length="20" id="price" name="price" class="price form-control" placeholder="{{trans('lang.enter_number')}}">
								<span class="help-block font-red bold"></span>
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