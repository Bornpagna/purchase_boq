@extends('layouts.app')

@section('stylesheet')
	<style>
		td.details-control {
            background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
            cursor: pointer !important;
        }
        tr.shown td.details-control {
            background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
        }
		.small-pic{
			display: inline-block;
			vertical-align: middle;
			height: 30px;
		}
	</style>
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
			</div>
			<div class="portlet-body">
				<?php if(Session::has('success')):?>
					<div class="alert alert-success display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.success')}}!</strong> {{Session::get('success')}} 
					</div>
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
							<th style="width: 3%;" class="all"></th>
							<th width="5%" class="all">{{ trans('lang.photo') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.reference_no') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.deliv_no') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.trans_date') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.supplier') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.sub_total') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.refund') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.grand_total') }}</th>
							<th width="5%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Varian -->
@endsection()

@section('javascript')
<script type="text/javascript">	
	function format (d) {
        var str = '';
		str += '<table class="table table-striped" width="100%">';
		str += '<thead>';
		str += '<tr>';
			str += '<th width="20%">{{trans("lang.desc")}} : </th>';
			str += '<td width="80%">'+d.desc+'</td>';
		str += '</tr>';
		str += '<tr>';
			str += '<th width="20%">{{trans("lang.deleted_by")}} : </th>';
			str += '<td width="80%">'+d.updated_by+'</td>';
		str += '</tr>';
		str += '<tr>';
			str += '<th width="20%">{{trans("lang.deleted_at")}} : </th>';
			str += '<td width="80%">'+d.updated_at+'</td>';
		str += '</tr>';
		str += '</thead>';
		str += '</table>';
        str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 5%;">{{trans("lang.line_no")}}</th>';
                    str += '<th style="width: 15%;">{{trans("lang.items")}}</th>';
                    str += '<th style="width: 8%;">{{trans("lang.units")}}</th>';
                    str += '<th style="width: 8%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.price")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.amount")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.refund")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.total")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.from_warehouse")}}</th>';
                    str += '<th style="width: 15%;">{{trans("lang.note")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }
	
	function onZoom(id){
		var image=$('#'+id).attr('src');
		$.fancybox.open(image);
	}
	
	var my_table = $('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{
				className: 'details-control',
				orderable: false,
				searchable: false,
				data: null,
				defaultContent: ''
			},
			{data: 'photo', class:'text-center', name:'photo'},
			{data: 'ref_no', class:'text-center', name:'ref_no'},
			{data: 'deliv_no', class:'text-center', name:'deliv_no'},
			{data: 'trans_date', class:'text-center', name:'trans_date'},
			{data: 'supplier', name:'supplier'},
			{data: 'sub_total', name:'sub_total'},
			{data: 'refund', name:'refund'},
			{data: 'grand_total', name:'grand_total'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],order: [[1, 'desc']],fnCreatedRow:function(nRow, aData, iDataIndex){
			$('td:eq(4)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			$('td:eq(6)',nRow).html(formatDollar(aData['sub_total'])).addClass("text-center");
			$('td:eq(7)',nRow).html(formatDollar(aData['refund'])).addClass("text-center");
			$('td:eq(8)',nRow).html(formatDollar(aData['grand_total'])).addClass("text-center");
			
			var pic='<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
			if(aData['photo']!=null && aData['photo']!='' && aData['photo']!=0){
				pic = '<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/return_delivery")}}/'+aData['photo']+'" onclick="onZoom(this.id);" />';
			}
			$('td:eq(1)',nRow).html(pic).addClass("text-center");
		}
	});
	
	$('#my-table tbody').on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = my_table.row(tr);
		var tableId = 'sub-' + row.data().id;
		if(row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
			objName = [];
		}else{
			row.child(format(row.data())).show();
			initTable(tableId,row.data());
			$('#' + tableId+'_wrapper').attr('style','width: 99%;');
			tr.addClass('shown');
		}
	});
	
	function initTable(tableId, data) {
		$('#' + tableId).DataTable({
			processing: true,
			serverSide: true,
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url,
			columns: [
				{ data: 'line_no', name: 'line_no' },
				{ data: 'item', name: 'item' },
				{ data: 'unit', name: 'unit' },
				{ data: 'qty', name: 'qty' },
				{ data: 'price', name: 'price' },
				{ data: 'amount', name: 'amount' },
				{ data: 'refund', name: 'refund' },
				{ data: 'total', name: 'total' },
				{ data: 'from_warehouse', name: 'from_warehouse' },
				{ data: 'note', name: 'note' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
				$('td:eq(3)',nRow).html(formatNumber(aData['qty']));
				$('td:eq(4)',nRow).html(formatDollar(aData['price']));
				$('td:eq(5)',nRow).html(formatDollar(aData['amount']));
				$('td:eq(6)',nRow).html(formatDollar(aData['refund']));
				$('td:eq(7)',nRow).html(formatDollar(aData['total']));
			}
		});
	}
	
	function onRestore(field){
		var rounte = $(field).attr('row_rounte');
		$.confirm({
			title:'{{trans("lang.confirmation")}}',
            content:'{{trans("lang.content_restore")}}',
            autoClose: 'no|10000',
            buttons:{
                yes:{
                    text:'{{trans("lang.yes")}}',
                    btnClass: 'btn-success',
                    action:function(){
						alert('Under Contruction');
                        // window.location.href=rounte;
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