<style>
	.pointer{
		cursor: pointer;
	}
</style>
<form class="system-form form-horizontal" method="POST"  enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="system-modal draggable-modal modal fade in" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="form-body">
						<table class="table table-striped table-bordered table-hover" id="table_purchase">
							<thead>
								<tr>
									<th class="text-center " >{{ trans('lang.no') }}</th>
									<th class="text-center ">{{ trans('lang.supplier') }}</th>
									<th class="text-center ">{{ trans('lang.items') }}</th>
									<th class="text-center ">{{ trans('lang.units') }}</th>
									<th class="text-center ">{{ trans('lang.price') }}</th>
									<th class="text-center "><i class='fa fa-plus pointer'></i></th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success button-submit" value="1"></button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('lang.cancel')}}</button>
				</div>
			</div>
		</div>
	</div>
</form>