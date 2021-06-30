<style>
	.boq-pointer{
		cursor: pointer;
	}
</style>
<form class="enter-boq-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<input type="hidden" name="house_id" id="boq-house-id" class="boq-house-id"/>
	<div class="enter-boq-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12 text-center	">
								<span class="show-message-error-boq center font-red bold"></span>
							</div>
						</div>
						<table class="table table-striped table-bordered table-hover" id="table_boq">
							<thead>
								<tr>
									<th class="text-center all">{{ trans('lang.no') }}</th>
									<th class="text-center all">{{ trans('lang.item_type') }}</th>
									<th class="text-center all">{{ trans('lang.items') }}</th>
									<th class="text-center all">{{ trans('lang.units') }}</th>
									<th class="text-center all">{{ trans('lang.qty_std') }}</th>
									<th class="text-center all">{{ trans('lang.qty_add') }}</th>
									<th class="text-center all"><i class='fa fa-plus boq-pointer'></i></th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success boq-button-submit" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>