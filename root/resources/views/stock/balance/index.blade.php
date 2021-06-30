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
<?php 
    $start_date = "";
    $end_date = "";
    $param = "?v=1";
    if (Request::input('start_date')) {
        $start_date = Request::input('start_date');
        $param.="&sd=".$start_date;
    }else{
    	$date = strtotime("-".(date('d') - 1)." day", strtotime(date('Y-m-d')));
		$start_date = date("Y-m-d", $date);
        $param.="&sd=".$start_date;
    }

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.="&ed=".$end_date;
    }else{
        $end_date = date('Y-m-d');
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
					<a title="{{trans('lang.download')}}" class="btn btn-circle btn-icon-only btn-default" href="{{url('stock/balance/excel').$param}}">
						<i class="fa fa-file-excel-o"></i>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
							<th width="3%" class="text-center all">{{ trans('lang.photo') }}</th>
							<th width="24%" class="text-center all">{{ trans('lang.items') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.item_type') }}</th>
							<th width="8%" class="text-center all">{{ trans('lang.unit_stock') }}</th>
							<th width="8%" class="text-center">{{ trans('lang.begin_balance') }}</th>
							<th width="8%" class="text-center all">{{ trans('lang.stock_in') }}</th>
							<th width="8%" class="text-center">{{ trans('lang.stock_out') }}</th>
							<th width="8%" class="text-center">{{ trans('lang.ending_balance') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.warehouse') }}</th>
							<th width="8%" class="text-center all">{{ trans('lang.action') }}</th>
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
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: "<?php echo url('stock/balance/dt').$param ?>",
		columns: [
			{data: 'photo', name:'photo'},
			{data: 'item', name:'item'},
			{data: 'cat_name', name:'cat_name'},
			{data: 'unit_stock', name:'unit_stock'},
			{data: 'begin_balance', name:'begin_balance'},
			{data: 'stock_in', name:'stock_in'},
			{data: 'stock_out', name:'stock_out'},
			{data: 'ending_balance', name:'ending_balance'},
			{data: 'warehouse', name:'warehouse'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],order: [[1, 'desc']],fnCreatedRow:function(nRow, aData, iDataIndex){
			var pic='<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
			if(aData['photo']!=null && aData['photo']!='' && aData['photo']!=0){
				pic = '<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/items")}}/'+aData['photo']+'" onclick="onZoom(this.id);" />';
			}
			$('td:eq(0)',nRow).html(pic).addClass("text-center");
			$('td:eq(4)',nRow).html(formatNumber(aData['begin_balance']));
			$('td:eq(5)',nRow).html(formatNumber(aData['stock_in']));
			$('td:eq(6)',nRow).html(formatNumber(aData['stock_out']));			
			$('td:eq(7)',nRow).html(formatNumber(aData['ending_balance']));
		}
	});
	
	function onZoom(id){
		var image=$('#'+id).attr('src');
		$.fancybox.open(image);
	}
	
	function onView(field){
		var start_date = '<?php echo encrypt($start_date) ?>';
		var end_date = '<?php echo encrypt($end_date) ?>';
		var rounte = $(field).attr('row_rounte');
		window.location.href=rounte+'/'+start_date+'/'+end_date;
	}
	
	function onAlert(field){
		var rounte = $(field).attr('row_rounte');
		var title = $(field).attr('title');
		$.confirm({
            title:'{{trans("lang.confirmation")}}',
            content:'{{trans("lang.content_ask")}}'+title+'?',
            autoClose: 'no|10000',
            buttons:{
                yes:{
                    text:'{{trans("lang.yes")}}',
                    btnClass: 'btn-success',
                    action:function(){
                        window.location.href=rounte;
                    }
                },
                no:{
                    text:'{{trans("lang.no")}}',
                    btnClass: 'btn-danger',
                    action:function(){}
                }
            }
        });
	}
</script>
@endsection()