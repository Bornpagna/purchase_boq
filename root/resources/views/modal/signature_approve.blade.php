<form class="signature-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="signature-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">

						<div class="row">
							<div class="col-md-12">
								<div class="portlet light ">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">{{$title}}</span>
										</div>
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab" class="bold">{{trans('lang.signature')}}</a>
											</li>
											<li>
												<a href="#tab_1_2" data-toggle="tab" class="bold">{{trans('lang.upload')}}</a>
											</li>
										</ul>
									</div>
									<div class="portlet-body">
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1_1">
												<div class="form-group">
													<label class="col-md-3 control-label bold">{{trans('lang.signature')}} 
														<span class="required">*</span>
													</label>
													<div class="col-md-8">
														<input type="hidden" name="signature_pad" id="signature_pad" />
														<input type="hidden" name="is_finish" id="is_finish" />
														<div id="signature-pad" class="my-signature-pad m-signature-pad" style="width:345px !important;">
															<div class="m-signature-pad--body">
															  <canvas id="canvas_sign"></canvas>
															</div>
															<div class="m-signature-pad--footer">
															  <div class="description">Sign above</div>
															  <button type="button" id="clear" class="button clear" data-action="clear">Clear</button>
															  <button type="button" id="saveSignature" class="button save" data-action="save">Save</button>
															</div>
														</div>
														<span class="help-block font-red bold"></span>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab_1_2">
												<div class="form-group">
													<label class="col-md-3 control-label bold">{{trans('lang.upload')}} 
														<span class="required">*</span>
													</label>
													<div class="col-md-8">
														<div class="fileinput fileinput-new" data-provides="fileinput">
															<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
																<img src='{{asset("assets/upload/picture/items/no-image.jpg")}}' alt="" />
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
															<div>
																<span class="btn blue btn-file">
																	<span class="fileinput-new"> {{trans('lang.select_image')}} </span>
																	<span class="fileinput-exists"> {{trans('lang.change')}} </span>
																	<input type="file" name="image" id="image" accept="image/*" /> 
																</span>
																<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('lang.remove')}} </a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success button-submit-signature" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>