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
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
							<th style="width: 5%;" class="all">{{trans('lang.user')}}</th>
							<th style="width: 5%;" class="desktop tablet-l">ContentID</th>
							<th style="width: 5%;" class="desktop tablet-l">Table</th>
							<th style="width: 5%;" class="desktop tablet-l">Action</th>
							<th style="width: 15%;" class="desktop tablet-l">Description</th>
							<th style="width: 15%;" class="desktop tablet-l">Details</th>
							<th style="width: 10%;" class="desktop tablet-l">IP_Address</th>
							<th style="width: 30%;" class="desktop tablet-l">User_Agent</th>
							<th style="width: 10%;" class="desktop tablet-l">Created At</th>
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
	$(document).ready(function(){
        var table = $('#my-table').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
            ajax: "{{$rounte}}",
            columns: [
                { data: 'user_name', name: 'user_name' },
                { data: 'content_id', name: 'content_id',class:'text-center' },
                { data: 'content_type', name: 'content_type' },
                { data: 'action', name: 'action',class:'text-center' },
                { data: 'description', name: 'description' },
                { data: 'details', name: 'details' },
                { data: 'ip_address', name: 'ip_address' },
                { data: 'user_agent', name: 'user_agent' },
                { data: 'created_at', name: 'created_at' },
            ],fnCreatedRow:function(nRow,aData,iDataIndex){}
        });
	});
</script>
@endsection()