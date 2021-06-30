<form class="upload-excel-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="upload-excel-form draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{trans('lang.upload_document')}}</h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label bold">{{trans('lang.document')}}<span class="required">*</span></label>
							<div class="col-md-8">
								<div class="fileinput fileinput-new input-group excel" data-provides="fileinput">
									<div class="form-control" data-trigger="fileinput">
										<i class="glyphicon glyphicon-file fileinput-exists"></i> 
										<span class="fileinput-filename"></span>
									</div>
									<span class="input-group-addon btn btn-success btn-file">
										<span class="fileinput-new bold">{{trans('lang.select_doc')}}</span>
										<span class="fileinput-exists bold">{{trans('lang.change')}}</span>
										<input type="file" id="excel" name="excel" />
									</span>
										<a href="#" class="input-group-addon btn btn-danger fileinput-exists bold" data-dismiss="fileinput">{{trans('lang.delete')}}</a>
								</div>
								<span class="help-block error-excel font-red bold"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success button-save-excel" id="btn_upload_excel" name="btn_upload_excel" value="1">{{trans('lang.upload')}}</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>