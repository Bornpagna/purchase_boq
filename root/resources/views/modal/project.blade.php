<form class="project-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" id="old_name" name="old_name">
	<div class="project-model draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label bold">{{trans('lang.name')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<input type="text" length="50" id="pro-name" name="name" class="pro-name form-control" placeholder="{{trans('lang.enter_text')}}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label class="col-md-4 control-label bold">{{trans('lang.tel')}}</label>
									<div class="col-md-8">
										<input type="text" length="15" id="pro-tel" name="tel" class="pro-tel form-control" placeholder="{{trans('lang.enter_text')}}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label bold">{{trans('lang.email')}} 
										<span class="required">*</span>
									</label>
									<div class="col-md-8">
										<input type="text" length="100" id="pro-email" name="email" class="pro-email form-control" placeholder="{{trans('lang.enter_text')}}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label class="col-md-4 control-label bold">{{trans('lang.url')}}</label>
									<div class="col-md-8">
										<input type="text" length="50" id="pro-url" name="url" class="pro-url form-control" placeholder="{{trans('lang.enter_text')}}">
										<span class="help-block font-red bold"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-4 control-label bold">{{trans('lang.profile_pic')}}</label>
									<div class="col-md-8">
										<div class="fileupload fileupload-profile" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
											<img id="profile-picture" alt="no image" /></div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
											<div>
												<span class="btn btn-file btn-primary">
													<span class="fileupload-new">{{trans('lang.select_image')}}</span>
													<span class="fileupload-exists">{{trans('lang.change')}}</span>
													<input type="file" accept="image/*" name="profile_photo" id="profile-photo" />
												</span>
												<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">{{trans('lang.remove')}}</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6">
									<label class="col-md-4 control-label bold">{{trans('lang.cover_picture')}}</label>
									<div class="col-md-8">
										<div class="fileupload fileupload-cover" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
											<img id="cover-picture" alt="no image" /></div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
											<div>
												<span class="btn btn-file btn-primary">
													<span class="fileupload-new">{{trans('lang.select_image')}}</span>
													<span class="fileupload-exists">{{trans('lang.change')}}</span>
													<input type="file" accept="image/*" name="cover_photo" id="cover-photo" />
												</span>
												<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">{{trans('lang.remove')}}</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					
						<div class="form-group">
							<label class="col-md-2 control-label bold">{{trans('lang.address')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-10">
								<textarea id="pro-address" length="200" name="address" rows="10" data-height="100" class="pro-address form-control" placeholder="{{trans('lang.enter_text')}}"></textarea>
								<span class="help-block font-red bold"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label bold">{{trans('lang.status')}} 
								<span class="required">*</span>
							</label>
							<div class="col-md-10">
								<select id="pro-status" name="status" class="pro-status my-select2 form-control">
									<option value="1">{{trans('lang.started')}}</option>
									<option value="2">{{trans('lang.finished')}}</option>
									<option value="3">{{trans('lang.stopped')}}</option>
								</select>
								<span class="help-block font-red bold"></span>
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