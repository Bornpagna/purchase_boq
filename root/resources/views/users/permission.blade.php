@extends('layouts.app')

@section('stylesheet')
	<link href="{{ asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title}}</span>
				</div>
				<div class="actions">
					<a rounte="{{$rounteBack}}" title="{{trans('lang.back')}}" class="btn btn-circle btn-icon-only btn-default" id="btnBack">
						<i class="fa fa-reply"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<div class="form-group">
					<div class="col-md-12 ">
						<span class="show-message-error center font-red bold"></span>
					</div>
				</div>
				<form action="{{$rounteSave}}" method="POST" id="form-permission" class="form-horizontal" enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="portlet-body" >
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div id="permission_tree" class="dd">
									<ol class="dd-list">
										<li class="dd-item dd3-item" data-id="dashboard">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="dashboard" id="dashboard" name="dashboard" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.dashboard')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-request" id="dash-request" name="dash-request" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.request')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-order" id="dash-order" name="dash-order" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.order')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-delivery" id="dash-delivery" name="dash-delivery" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delivery')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-usage" id="dash-usage" name="dash-usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.usage')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-chart-request-item" id="dash-chart-request-item" name="dash-chart-request-item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.chart_request_item')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-chart-order-item" id="dash-chart-order-item" name="dash-chart-order-item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.chart_order_item')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-chart-order-price" id="dash-chart-order-price" name="dash-chart-order-price" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.chart_order_price')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="dash-chart-house-type" id="dash-chart-house-type" name="dash-chart-house-type" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.chart_house_type')}}
													</div>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="setup_option">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="setup_option" id="setup_option" name="setup_option" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.setup_option')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="zone">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="zone" id="zone" name="zone" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.zone')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="zone_add" id="zone_add" name="zone_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="zone_edit" id="zone_edit" name="zone_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="zone_delete" id="zone_delete" name="zone_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="zone_download" id="zone_download" name="zone_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="zone_upload" id="zone_upload" name="zone_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="block">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="block" id="block" name="block" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.block')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="block_add" id="block_add" name="block_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="block_edit" id="block_edit" name="block_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="block_delete" id="block_delete" name="block_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="block_download" id="block_download" name="block_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="block_upload" id="block_upload" name="block_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="street">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="street" id="street" name="street" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.street')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="street_add" id="street_add" name="street_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="street_edit" id="street_edit" name="street_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="street_delete" id="street_delete" name="street_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="street_download" id="street_download" name="street_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="street_upload" id="street_upload" name="street_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="constructor">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="constructor" id="constructor" name="constructor" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.constructor')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="constructor_add" id="constructor_add" name="constructor_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="constructor_edit" id="constructor_edit" name="constructor_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="constructor_delete" id="constructor_delete" name="constructor_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="constructor_download" id="constructor_download" name="constructor_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="constructor_upload" id="constructor_upload" name="constructor_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="warehouse">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="warehouse" id="warehouse" name="warehouse" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.warehouse')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="warehouse_add" id="warehouse_add" name="warehouse_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="warehouse_edit" id="warehouse_edit" name="warehouse_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="warehouse_delete" id="warehouse_delete" name="warehouse_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="warehouse_download" id="warehouse_download" name="warehouse_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="warehouse_upload" id="warehouse_upload" name="warehouse_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="item_info">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="item_info" id="item_info" name="item_info" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.item_info')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="item_type">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="item_type" id="item_type" name="item_type" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.item_type')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="item_type_add" id="item_type_add" name="item_type_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="item_type_edit" id="item_type_edit" name="item_type_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="item_type_delete" id="item_type_delete" name="order-delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="item_type_download" id="item_type_download" name="item_type_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="item_type_upload" id="item_type_upload" name="item_type_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="unit">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="unit" id="unit" name="unit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.unit_convert')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="unit_add" id="unit_add" name="unit_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="unit_edit" id="unit_edit" name="unit_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="unit_delete" id="unit_delete" name="dunit_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="unit_download" id="unit_download" name="unit_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="unit_upload" id="unit_upload" name="unit_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="item">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="item" id="item" name="item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.items')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="item_add" id="item_add" name="item_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="item_edit" id="item_edit" name="item_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="item_delete" id="item_delete" name="item_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="item_download" id="item_download" name="item_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="item_upload" id="item_upload" name="item_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="supplier">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="supplier" id="supplier" name="supplier" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.supplier')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="supplier_add" id="supplier_add" name="supplier_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="supplier_edit" id="supplier_edit" name="supplier_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="supplier_delete" id="supplier_delete" name="supplier_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="supplier_download" id="supplier_download" name="supplier_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="supplier_upload" id="supplier_upload" name="supplier_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="supplier_item">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="supplier_item" id="supplier_item" name="supplier_item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.supplier_items')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="supplier_item_add" id="supplier_item_add" name="supplier_item_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="supplier_item_edit" id="supplier_item_edit" name="supplier_item_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="supplier_item_delete" id="supplier_item_delete" name="supplier_item_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="supplier_item_download" id="supplier_item_download" name="supplier_item_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="house_info">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="house_info" id="house_info" name="house_info" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.house_info')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="house_type">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="house_type" id="house_type" name="house_type" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.house_type')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="house_type_add" id="house_type_add" name="house_type_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="house_type_edit" id="house_type_edit" name="house_type_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="house_type_delete" id="house_type_delete" name="house_type_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="house_type_download" id="house_type_download" name="house_type_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="house_type_upload" id="house_type_upload" name="house_type_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
																<input type="checkbox" value="house_type_enter_boq" id="house_type_enter_boq" name="house_type_enter_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.enter_boq')}}
																<input type="checkbox" value="house_type_upload_boq" id="house_type_upload_boq" name="house_type_upload_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload_boq')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="house">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="house" id="house" name="house" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.house')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="house_add" id="house_add" name="house_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="house_edit" id="house_edit" name="house_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="house_delete" id="house_delete" name="house_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="house_download" id="house_download" name="house_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="house_upload" id="house_upload" name="house_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
																<input type="checkbox" value="house_enter_boq" id="house_enter_boq" name="house_enter_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.enter_boq')}}
																<input type="checkbox" value="house_upload_boq" id="house_upload_boq" name="house_upload_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload_boq')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="boq">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="boq" id="boq" name="boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.boq')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="boq_add" id="boq_add" name="boq_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="boq_view" id="boq_view" name="boq_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view')}}
																<input type="checkbox" value="boq_delete" id="boq_delete" name="boq_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="boq_download_sample" id="boq_download_sample" name="boq_download_sample" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download_example')}}
																<input type="checkbox" value="boq_download" id="boq_download" name="boq_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="purchase">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="purchase" id="purchase" name="purchase" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.purchase')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="purchase_request">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="purchase_request" id="purchase_request" name="purchase_request" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.request')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="purchase_request_add" id="purchase_request_add" name="purchase_request_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="purchase_request_edit" id="purchase_request_edit" name="purchase_request_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="purchase_request_delete" id="purchase_request_delete" name="purchase_request_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="purchase_request_print" id="purchase_request_print" name="purchase_request_print" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.print')}}
																<input type="checkbox" value="purchase_request_view" id="purchase_request_view" name="purchase_request_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view')}}
																<input type="checkbox" value="purchase_request_clone" id="purchase_request_clone" name="purchase_request_clone" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.clone')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="purchase_order">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="purchase_order" id="purchase_order" name="purchase_order" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.order')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="purchase_order_add" id="purchase_order_add" name="purchase_order_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="purchase_order_edit" id="purchase_order_edit" name="purchase_order_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="purchase_order_delete" id="purchase_order_delete" name="purchase_order_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="purchase_order_print" id="purchase_order_print" name="purchase_order_print" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.print')}}
																<input type="checkbox" value="purchase_order_view" id="purchase_order_view" name="purchase_order_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view')}}
																<input type="checkbox" value="purchase_order_clone" id="purchase_order_clone" name="purchase_order_clone" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.clone')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="approve">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="approve" id="approve" name="approve" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.approval')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="approve_request">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="approve_request" id="approve_request" name="approve_request" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.request')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="approve_request_view" id="approve_request_view" name="approve_request_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view')}}
																<input type="checkbox" value="approve_request_signature" id="approve_request_signature" name="approve_request_signature" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.signature')}}
																<input type="checkbox" value="approve_request_reject" id="approve_request_reject" name="approve_request_reject" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.reject')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="approve_order">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="approve_order" id="approve_order" name="approve_order" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.order')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="approve_order_view" id="approve_order_view" name="approve_order_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view')}}
																<input type="checkbox" value="approve_order_signature" id="approve_order_signature" name="approve_order_signature" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.signature')}}
																<input type="checkbox" value="approve_order_reject" id="approve_order_reject" name="approve_order_reject" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.reject')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="inventory">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="inventory" id="inventory" name="inventory" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.inventory')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="stock_entry">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="stock_entry" id="stock_entry" name="stock_entry" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock_entry')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="stock_entry_add" id="stock_entry_add" name="stock_entry_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="stock_entry_edit" id="stock_entry_edit" name="stock_entry_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="stock_entry_delete" id="stock_entry_delete" name="stock_entry_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="stock_import">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="stock_import" id="stock_import" name="stock_import" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock_import')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="stock_import_download_sample" id="stock_import_download_sample" name="stock_import_download_sample" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download_example')}}
																<input type="checkbox" value="stock_import_upload" id="stock_import_upload" name="stock_import_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
																<input type="checkbox" value="stock_import_delete" id="stock_import_delete" name="stock_import_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="stock_balance">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="stock_balance" id="stock_balance" name="stock_balance" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock_balance')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="stock_balance_view" id="stock_balance_view" name="stock_balance_view" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.view_details')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="stock_adjust">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="stock_adjust" id="stock_adjust" name="stock_adjust" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.adjustment')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="stock_adjust_add" id="stock_adjust_add" name="stock_adjust_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="stock_adjust_edit" id="stock_adjust_edit" name="stock_adjust_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="stock_adjust_delete" id="stock_adjust_delete" name="stock_adjust_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="stock_move">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="stock_move" id="stock_move" name="stock_move" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.movement')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="stock_move_add" id="stock_move_add" name="stock_move_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="stock_move_edit" id="stock_move_edit" name="stock_move_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="stock_move_delete" id="stock_move_delete" name="stock_move_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="delivery">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="delivery" id="delivery" name="delivery" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delivery')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="delivery_entry">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="delivery_entry" id="delivery_entry" name="delivery_entry" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.entry')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="delivery_entry_add" id="delivery_entry_add" name="delivery_entry_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																		<input type="checkbox" value="delivery_entry_edit" id="delivery_entry_edit" name="delivery_entry_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																		<input type="checkbox" value="delivery_entry_delete" id="delivery_entry_delete" name="delivery_entry_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																	</div>
																</li>
															</ol>
														</li>
														<li class="dd-item dd3-item" data-id="delivery_return">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="delivery_return" id="delivery_return" name="delivery_return" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.return')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="delivery_return_add" id="delivery_return_add" name="delivery_return_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																		<input type="checkbox" value="delivery_return_edit" id="delivery_return_edit" name="delivery_return_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																		<input type="checkbox" value="delivery_return_delete" id="delivery_return_delete" name="delivery_return_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																	</div>
																</li>
															</ol>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="usage">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="usage" id="usage" name="usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.usage')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="usage_entry">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="usage_entry" id="usage_entry" name="usage_entry" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.entry')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="usage_entry_add" id="usage_entry_add" name="usage_entry_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																		<input type="checkbox" value="usage_entry_edit" id="usage_entry_edit" name="usage_entry_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																		<input type="checkbox" value="usage_entry_delete" id="usage_entry_delete" name="usage_entry_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																	</div>
																</li>
															</ol>
														</li>
														<li class="dd-item dd3-item" data-id="usage_return">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="usage_return" id="usage_return" name="usage_return" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.return')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="usage_return_add" id="usage_return_add" name="usage_return_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																		<input type="checkbox" value="usage_return_edit" id="usage_return_edit" name="usage_return_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																		<input type="checkbox" value="usage_return_delete" id="usage_return_delete" name="usage_return_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																	</div>
																</li>
															</ol>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="report">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="report" id="report" name="report" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.report')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="report_boq">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="report_boq" id="report_boq" name="report_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.boq')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_boq_detail" id="report_boq_detail" name="report_boq_detail" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.boq_detail')}}
																<input type="checkbox" value="report_sub_boq" id="report_sub_boq" name="report_sub_boq" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.sub_boq')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="report_usage">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="report_usage" id="report_usage" name="report_usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.usage')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_usage_entry" id="report_usage_entry" name="report_usage_entry" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.usage')}}
																<input type="checkbox" value="report_return_usage" id="report_return_usage" name="report_return_usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.return_usage')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="report_purchase">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="report_purchase" id="report_purchase" name="report_purchase" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.purchase')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="report_purchase_request">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_purchase_request" id="report_purchase_request" name="report_purchase_request" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.request')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="report_purchase_request_1" id="report_purchase_request_1" name="report_purchase_request_1" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.request')}}
																		<input type="checkbox" value="report_purchase_request_2" id="report_purchase_request_2" name="report_purchase_request_2" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.request_1')}}
																		<input type="checkbox" value="report_purchase_request_3" id="report_purchase_request_3" name="report_purchase_request_3" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.request_2')}}
																	</div>
																</li>
															</ol>
														</li>
														<li class="dd-item dd3-item" data-id="report_purchase_order">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_purchase_order" id="report_purchase_order" name="report_purchase_order" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.order')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="report_purchase_order_1" id="report_purchase_order_1" name="report_purchase_order_1" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.order')}}
																		<input type="checkbox" value="report_purchase_order_2" id="report_purchase_order_2" name="report_purchase_order_2" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.order_1')}}
																		<input type="checkbox" value="report_purchase_order_3" id="report_purchase_order_3" name="report_purchase_order_3" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.order_2')}}
																	</div>
																</li>
															</ol>
														</li>
														<li class="dd-item dd3-item" data-id="report_delivery">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_delivery" id="report_delivery" name="report_delivery" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.delivery')}}
															</div>
															<ol class="dd-list">
																<li class="dd-item dd3-item" data-id="">
																	<div class="dd-handle dd3-handle"> </div>
																	<div class="dd3-content" style="font-weight: bold !important;">
																		<input type="checkbox" value="report_delivery_item" id="report_delivery_item" name="report_delivery_item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{ trans('rep.delivery') }}
																		<input type="checkbox" value="report_return_delivery_item" id="report_return_delivery_item" name="report_return_delivery_item" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{ trans('rep.return') }}
																	</div>
																</li>
															</ol>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="report_stock">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="report_stock" id="report_stock" name="report_stock" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="report_stock_balance" id="report_stock_balance" name="report_stock_balance" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.stock_balance')}}
																<input type="checkbox" value="report_all_stock" id="report_all_stock" name="report_all_stock" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('rep.all_stock_transaction')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="user_control">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="user_control" id="user_control" name="user_control" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.user_control')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="department">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="department" id="department" name="department" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.department')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="department_add" id="department_add" name="department_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="department_edit" id="department_edit" name="department_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="department_delete" id="department_delete" name="department_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="department_download" id="department_download" name="department_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="department_upload" id="department_upload" name="department_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="user">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="user" id="user" name="user" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.user')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="user_add" id="user_add" name="user_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="user_edit" id="user_edit" name="user_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="user_delete" id="user_delete" name="user_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="user_reset" id="user_reset" name="user_reset" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.reset_password')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="user_group">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="user_group" id="user_group" name="user_group" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.user_group')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="user_group_add" id="user_group_add" name="user_group_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="user_group_edit" id="user_group_edit" name="user_group_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="user_group_delete" id="user_group_delete" name="user_group_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="user_group_download" id="user_group_download" name="user_group_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="user_group_upload" id="user_group_upload" name="user_group_upload" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.upload')}}
																<input type="checkbox" value="user_group_assign" id="user_group_assign" name="user_group_assign" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.assign')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="role">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="role" id="role" name="role" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.role')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="role_add" id="role_add" name="role_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="role_edit" id="role_edit" name="role_edit" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.edit')}}
																<input type="checkbox" value="role_delete" id="role_delete" name="role_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
																<input type="checkbox" value="role_assign" id="role_assign" name="role_assign" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.assign')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
										<li class="dd-item dd3-item" data-id="system">
											<div class="dd-handle dd3-handle"> </div>
											<div class="dd3-content" style="font-weight: bold !important;">
												<input type="checkbox" value="system" id="system" name="system" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.system')}}
											</div>
											<ol class="dd-list">
												<li class="dd-item dd3-item" data-id="setting">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="setting" id="setting" name="setting" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.setting')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="user_log">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="user_log" id="user_log" name="user_log" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.user_activity')}}
													</div>
												</li>
												<li class="dd-item dd3-item" data-id="backup">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="backup" id="backup" name="backup" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.backup')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="backup_add" id="backup_add" name="backup_add" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.add_new')}}
																<input type="checkbox" value="backup_download" id="backup_download" name="backup_download" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.download')}}
																<input type="checkbox" value="backup_delete" id="backup_delete" name="backup_delete" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delete')}}
															</div>
														</li>
													</ol>
												</li>
												<li class="dd-item dd3-item" data-id="trash">
													<div class="dd-handle dd3-handle"> </div>
													<div class="dd3-content" style="font-weight: bold !important;">
														<input type="checkbox" value="trash" id="trash" name="trash" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.trash')}}
													</div>
													<ol class="dd-list">
														<li class="dd-item dd3-item" data-id="">
															<div class="dd-handle dd3-handle"> </div>
															<div class="dd3-content" style="font-weight: bold !important;">
																<input type="checkbox" value="trash_stock_entry" id="trash_stock_entry" name="trash_stock_entry" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock_entry')}}
																<input type="checkbox" value="trash_stock_import" id="trash_stock_import" name="trash_stock_import" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.stock_import')}}
																<input type="checkbox" value="trash_stock_adjust" id="trash_stock_adjust" name="trash_stock_adjust" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.adjustment')}}
																<input type="checkbox" value="trash_stock_move" id="trash_stock_move" name="trash_stock_move" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.movement')}}
																<input type="checkbox" value="trash_stock_delivery" id="trash_stock_delivery" name="trash_stock_delivery" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.delivery')}}
																<input type="checkbox" value="trash_stock_return_delivery" id="trash_stock_return_delivery" name="trash_stock_return_delivery" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.return_delivery')}}
																<input type="checkbox" value="trash_stock_usage" id="trash_stock_usage" name="trash_stock_usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.usage')}}
																<input type="checkbox" value="trash_stock_return_usage" id="trash_stock_return_usage" name="trash_stock_return_usage" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.return_usage')}}
																<input type="checkbox" value="trash_request" id="trash_request" name="trash_request" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.request')}}
																<input type="checkbox" value="trash_order" id="trash_order" name="trash_order" class="icheck" data-checkbox="icheckbox_flat-green bold">&nbsp;{{trans('lang.order')}}
															</div>
														</li>
													</ol>
												</li>
											</ol>
										</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div><br/>
					<div class="form-actions text-right">
						<button type="submit" id="save_close" name="save_close" value="1" class="btn green bold">{{trans('lang.save_change')}}</button>
						<a class="btn red bold" rounte="{{$rounteBack}}" id="btnCancel">{{trans('lang.cancel')}}</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection()

@section('javascript')
<script src="{{asset('assets/global/plugins/jstree/dist/jstree.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script type="text/javascript">	
    var permission = JSON.parse(convertQuot('{{$permission}}'));
    $('#permission_tree').nestable();
    $('.dd').nestable('collapseAll');
	if(permission.length > 0){
		$.each(permission, function(key, val){
			$('#'+val.page).iCheck('check');
		});
	}
	
	$(function(){
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
	});
</script>
<script src="{{asset('assets/apps/scripts/permission.js')}}" type="text/javascript"></script>
@endsection()