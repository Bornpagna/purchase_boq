<form class="form-users form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="old_email" name="old_email">
	<div class="users-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<label for="name" class="col-md-3 control-label bold">{{trans('lang.name')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="50" id="name" name="name" class="name form-control" placeholder="{{trans('lang.enter_text')}}" autofocus>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-md-3 control-label bold">{{trans('lang.email')}}
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input id="email" type="email" length="100" class="form-control email" name="email" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div id="create-password">
							
						</div>
						<div class="form-group">
							<label for="tel" class="col-md-3 control-label bold">{{trans('lang.tel')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="25" id="tel" name="tel" class="tel form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<!-- Primary Department -->
						<div class="form-group">
							<label for="dep_id" class="col-md-3 control-label bold">{{trans('lang.department')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								@if(hasRole('department_add'))
									<div class="input-group">
										<select id="dep_id" name="dep_id" class="dep_id my-select2 form-control">
											<option value="0">Top Lavel</option>
											{{getSystemData('DP')}}
										</select>
										<span class="input-group-addon btn blue" id="btnAddDepartment">
											<i class="fa fa-plus"></i>
										</span>
									</div>
								@else
									<select id="dep_id" name="dep_id" class="dep_id my-select2 form-control">
										<option value="0">Top Lavel</option>
										{{getSystemData('DP')}}
									</select>
								@endif
							</div>
						</div>

						<!-- Department2 -->
						<div class="form-group" style="display: none;">
							<label for="department2" class="col-md-3 control-label bold">{{trans('lang.department2')}}</label>
							<div class="col-md-8">
								<select id="department2" name="department2" class="department2 my-select2 form-control">
									<option></option>
									{{getSystemData('DP')}}
								</select>
							</div>
						</div>

						<!-- Department3 -->
						<div class="form-group" style="display: none;">
							<label for="department3" class="col-md-3 control-label bold">{{trans('lang.department3')}}</label>
							<div class="col-md-8">
								<select id="department3" name="department3" class="department3 my-select2 form-control">
									<option></option>
									{{getSystemData('DP')}}
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>

						<div class="form-group">
							<label for="position" class="col-md-3 control-label bold">{{trans('lang.position')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<input type="text" length="100" id="position" name="position" class="position form-control" placeholder="{{trans('lang.enter_text')}}">
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div id="div-picture">
						
						</div>
						<!-- Approval User -->
						<div class="form-group">
							<label for="approval_user" class="col-md-3 control-label bold">{{trans('lang.approval_user')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-8">
								<select id="approval_user" name="approval_user" class="approval_user my-select2 form-control">
									<option value="0">{{trans('lang.no')}}</option>
									<option value="1">{{trans('lang.yes')}}</option>
								</select>
								<span class="help-block font-red bold"></span>
							</div>
						</div>

						<!-- Status -->
						<div class="form-group">
							<label for="status" class="col-md-3 control-label bold">{{trans('lang.status')}} 
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
					<button type="submit" class="btn btn-success button-submit-user" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>