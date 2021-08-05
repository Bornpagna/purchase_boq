<form class="form-revise-boq-house form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="modal-revise-boq-house draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">{{ trans('lang.revise_boq') }}</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<div class="col-md-12 text-center	">
							<span class="show-message-error-edit center font-red bold"></span>
						</div>
					</div>
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<span><b>{{ trans('lang.note') }} : </b>{{ trans('lang.note_revise_boq_house') }}</span>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="boq-street-edit" class="col-md-6 bold">{{trans('lang.select_working_type')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-12">
										<select name="working_type[]" id="working_type" class="form-control working_type my-select2" multiple>
											<option value=""></option>
											{{getSystemData('WK')}}
										</select>
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success button-submit-revise_boq_house" value="1">{{ trans('lang.revise') }}</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>