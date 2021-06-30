@extends('layouts.app')

@section('stylesheet')
	<style>
		.small-pic{
			display: inline-block;
			vertical-align: middle;
			height: 30px;
		}
	</style>
@endsection

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title_pr}}</span>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table-pr">
					<thead>
						<tr>
							<th width="3%" class="text-center all">{{ trans('lang.photo') }}</th>
							<th width="27%" class="text-center all">{{ trans('lang.pr_no') }}</th>
							@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
								<th width="20%" class="text-center">{{ trans('lang.approved_by') }}</th>
							@endif
							<th width="10%" class="text-center">{{ trans('lang.status') }}</th>
							<th width="25%" class="text-center">{{ trans('lang.created_at') }}</th>
							<th width="5%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title_po}}</span>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table-po">
					<thead>
						<tr>
							<th width="3%" class="text-center all">{{ trans('lang.photo') }}</th>
							<th width="27%" class="text-center all">{{ trans('lang.po_no') }}</th>
							@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
								<th width="20%" class="text-center">{{ trans('lang.approved_by') }}</th>
							@endif
							<th width="10%" class="text-center">{{ trans('lang.status') }}</th>
							<th width="25%" class="text-center">{{ trans('lang.created_at') }}</th>
							<th width="5%" class="text-center all">{{ trans('lang.action') }}</th>													
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
		$('#my-table-pr').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			ajax: '{{$rountePR}}',
			columns: [
				{data: 'signature', name:'signature'},
				{data: 'pr_ref', name:'pr_ref'},
				@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
					{data: 'approved_by', name:'approved_by'},
				@endif
				{data: 'reject', name:'reject'},
				{data: 'approved_date', name:'approved_date'},
				{data: 'action', class :'text-center', orderable: false, searchable: false},
			],'fnCreatedRow':function(nRow,aData,iDataIndex){
				if(aData['reject']!=2){
					var str='<span class="label label-success" style="font-size: smaller;">{{trans("lang.approved")}}</span>';
				}else{
					var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.rejected")}}</span>';
				}
				@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
					$('td:eq(3)',nRow).html(str).addClass("text-center");
				@else
					$('td:eq(2)',nRow).html(str).addClass("text-center");
				@endif
				var pic='<img id="'+aData['id']+'_pr" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
				if(aData['signature']!=null && aData['signature']!='' && aData['signature']!=0){
					pic = '<img id="'+aData['id']+'_pr" class="small-pic" src="{{ asset("assets/upload/picture/signature")}}/'+aData['signature']+'" onclick="onZoom(this.id);" />';
				}
				$('td:eq(0)',nRow).html(pic).addClass("text-center");
			}
		});
		
		$('#my-table-po').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			ajax: '{{$rountePO}}',
			columns: [
				{data: 'signature', name:'signature'},
				{data: 'po_ref', name:'po_ref'},
				@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
					{data: 'approved_by', name:'approved_by'},
				@endif
				{data: 'reject', name:'reject'},
				{data: 'approved_date', name:'approved_date'},
				{data: 'action', class :'text-center', orderable: false, searchable: false},
			],'fnCreatedRow':function(nRow,aData,iDataIndex){
				if(aData['reject']!=2){
					var str='<span class="label label-success" style="font-size: smaller;">{{trans("lang.approved")}}</span>';
				}else{
					var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.rejected")}}</span>';
				}
				@if((Auth::user()->id==config('app.owner')) || (Auth::user()->id==config('app.admin')))
					$('td:eq(3)',nRow).html(str).addClass("text-center");
				@else
					$('td:eq(2)',nRow).html(str).addClass("text-center");
				@endif
				var pic='<img id="'+aData['id']+'_po" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
				if(aData['signature']!=null && aData['signature']!='' && aData['signature']!=0){
					pic = '<img id="'+aData['id']+'_po" class="small-pic" src="{{ asset("assets/upload/picture/signature")}}/'+aData['signature']+'" onclick="onZoom(this.id);" />';
				}
				$('td:eq(0)',nRow).html(pic).addClass("text-center");
			}
		});

		function onZoom(id){
			var image=$('#'+id).attr('src');
			$.fancybox.open(image);
		}
		
		function onPrint(field){
			var rounte = $(field).attr('row_rounte');
			window.open(rounte, '_blank', 'width=735, height=891');
		}
	</script>
@endsection()