@extends('layouts.app')

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
					@if(isset($rounteAdd))
						<a href="{{$rounteAdd}}" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default" id="btnAdd">
							<i class="fa fa-plus"></i>
						</a>
					@endif
				</div>
			</div>
			
			<div class="portlet-body">
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('fail')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.fail')}}!</strong> {{Session::get('fail')}} 
					</div>
				<?php endif; ?>
				<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="users-table">
					<thead>
						<tr>
							<th class="text-center all">{{ trans('lang.code') }}</th>
							<th class="text-center desktop">{{ trans('lang.name') }}</th>
							<th class="text-center tablet">{{ trans('lang.length') }}</th>
							<th class="text-center desktop">{{ trans('lang.prefix') }}</th>
							<th class="text-center desktop">{{ trans('lang.subfix') }}</th>
							<th class="text-center tablet">{{ trans('lang.start_from') }}</th>
							<th class="text-center tablet">{{ trans('lang.interval') }}</th>
							<th class="text-center mobile">{{ trans('lang.round') }}</th>
							<th class="text-center mobile">{{ trans('lang.invoice_type') }}</th>
							<th class="text-center desktop">{{ trans('lang.example') }}</th>
							<th class="text-center all">{{ trans('lang.status') }}</th>
							<th class="text-center none">{{ trans('lang.user_create') }}</th>
							<th class="text-center none">{{ trans('lang.date_create') }}</th>
							<th class="text-center none">{{ trans('lang.user_update') }}</th>
							<th class="text-center none">{{ trans('lang.date_update') }}</th>
							<th class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection()
@section('javascript')
<script type="text/javascript">
	$('#users-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		ajax: '{{url("format/jsonFormatInvoice")}}',
		columns: [
			{data: 'format_code'},
			{data: 'format_name'},
			{data: 'length'},
			{data: 'prefix'},
			{data: 'subfix'},
			{data: 'start_from'},
			{data: 'interval'},
			{data: 'duration_round'},
			{data: 'type_invoice'},
			{data: 'example'},
			{data: 'status'},
			{data: 'user_create'},
			{data: 'created_at'},
			{data: 'user_update'},
			{data: 'updated_at'},
			{data: 'action', orderable: false, searchable: false},
		],'fnCreatedRow':function(nRow,aData,iDataIndex){
			var str="";
			if(aData['status'] == 'Active'){
				str ='<button class="btn btn-primary btn-xs">{{trans("lang.active")}}</button>';
			}else{
				str ='<button class="btn btn-danger btn-xs">{{trans("lang.disable")}}</button>';
			}
			$('td:eq(10)',nRow).html(str).addClass("text-center");
		}
	});
	
	function onDelete(id){
		var _token = $("input[name=_token]").val();
		App.doDelete("{{ trans('lang.delete').' '.trans('lang.format_info') }}","{{trans('lang.message_delete').' '.trans('lang.format_info').' ?'}}",'/format/delete',id,'post',_token);
	}
</script>
@endsection()