@extends('layouts.app')

@section('content')
<?php 
    $param = "?v=1";
    if (Request::input('start_date')) {
        $start_date = Request::input('start_date');
        $param.="&sd=".$start_date;
    }else{
        $param.="&sd=".$start_date;
    }

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.="&ed=".$end_date;
    }else{
       $param.="&ed=".$end_date;
    }
?>
<form method="post" id="form-filter-date">
	{{csrf_field()}}
	<input type="hidden" value="{{$start_date}}" name="start_date" id="start_date">
	<input type="hidden" value="{{$end_date}}" name="end_date" id="end_date">
</form>
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
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
							<th width="8%" class="text-center ">{{ trans('lang.trans_date') }}</th>
							<th width="14%" class="text-center ">{{ trans('lang.reference_no') }}</th>
							<th width="5%" class="text-center">{{ trans('lang.line_no') }}</th>
							<th width="25%" class="text-center all">{{ trans('lang.items') }}</th>
							<th width="8%" class="text-center all">{{ trans('lang.units') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.qty') }}</th>
							<th width="12%" class="text-center ">{{ trans('lang.warehouse') }}</th>
							<th width="8%" class="text-center ">{{ trans('lang.ref_type') }}</th>
							<th width="10%" class="text-center ">{{ trans('lang.reference') }}</th>
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
	var my_table = $('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		ajax: "<?php echo url('stock/balance/subdt/'.$item_id.'/'.$warehouse_id).$param ?>",
		columns: [
			{data: 'trans_date', name:'trans_date'},
			{data: 'ref_no', name:'ref_no'},
			{data: 'line_no', name:'line_no'},
			{data: 'item', name:'item'},
			{data: 'unit', name:'unit'},
			{data: 'qty', name:'qty'},
			{data: 'warehouse', name:'warehouse'},
			{data: 'ref_type', name:'ref_type'},
			{data: 'reference', name:'reference'},
		],order: [[1, 'desc']],fnCreatedRow:function(nRow, aData, iDataIndex){
			$('td:eq(5)',nRow).html(formatNumber(aData['qty']));
		}
	});
	
	$("#btnBack").on('click',function(){
		var rounte = $(this).attr('rounte');
		window.location.href=rounte;
	});
</script>
@endsection()