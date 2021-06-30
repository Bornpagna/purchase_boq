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
				<div class="actions">
					<!-- Download -->
					<a href="{{url('stock/deliv/download_excel')}}" title="{{trans('lang.download_example')}}" class="btn btn-circle btn-icon-only btn-default">
						<i class="fa fa-file-excel-o"></i>
					</a>
					<!-- Import -->
					<a title="{{trans('lang.upload')}}" class="btn btn-circle btn-icon-only btn-default" id="btnUpload">
						<i class="icon-cloud-upload"></i>
					</a>
					@if(isset($rounteAdd))
						<a rounte="{{$rounteAdd}}" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default" id="btnAdd">
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
				<?php elseif(Session::has('error')):?>
					<div class="alert alert-danger display-show">
						<button class="close" data-close="alert"></button><strong>{{trans('lang.error')}}!</strong> {{Session::get('error')}} 
					</div>
				<?php endif; ?>
				<table class="table table-striped table-bordered table-hover" id="my-table">
					<thead>
						<tr>
							<th width="3%" class="all"></th>
							<th width="5%" class="all">{{ trans('lang.photo') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.reference_no') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.po_no') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.trans_date') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.supplier') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.desc') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal Varian -->
@include('modal.upload')
@endsection()

@section('javascript')
<script type="text/javascript">	
	function format (d) {
        var str = '';
        	str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 5%;">{{trans("lang.line_no")}}</th>';
                    str += '<th style="width: 25%;">{{trans("lang.items")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.units")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
					str += '<th style="width: 10%;">{{trans("lang.price")}}</th>';
                    str += '<th style="width: 15%;">{{trans("lang.to_warehouse")}}</th>';
                    str += '<th style="width: 20%;">{{trans("lang.note")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

	onPrint = function(parent){
		var mywindow = window.open($(parent).attr('route'), "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
		setInterval(function(){ 
			mywindow.print();
			mywindow.close();
		}, 3000);
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
			{data: 'po_ref', class:'text-center', name:'po_ref'},
			{data: 'trans_date', class:'text-center', name:'trans_date'},
			{data: 'supplier', name:'supplier'},
			{data: 'note', name:'note'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],order: [[2, 'desc']],fnCreatedRow:function(nRow, aData, iDataIndex){
			$('td:eq(4)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			
			var pic='<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/items/no-image.jpg")}}" onclick="onZoom(this.id);" />';
			if(aData['photo']!=null && aData['photo']!='' && aData['photo']!=0){
				pic = '<img id="'+aData['id']+'" class="small-pic" src="{{ asset("assets/upload/picture/delivery")}}/'+aData['photo']+'" onclick="onZoom(this.id);" />';
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
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
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
				{ data: 'warehouse', name: 'warehouse' },
				{ data: 'desc', name: 'desc' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
				$('td:eq(3)',nRow).html(formatNumber(aData['qty']));
			}
		});
	}
	
	$(function(){
		$("#btnAdd").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
	});	

	$(function(){
		$('#btnUpload').on('click',function(){
			$('.upload-excel-form').attr('action',"{{url('stock/deliv/import_excel')}}");
			$('.upload-excel-form').modal('show');
			$('#btn_upload_excel').on('click',function(){
				if(onUploadExcel()){}else{return false}
			}); 
		});
	});	
	
	function onEdit(field){
		var rounte = $(field).attr('row_rounte');
		window.location.href=rounte;
	}
	
	function onDelete(field){
		var rounte = $(field).attr('row_rounte');
		$.confirm({
            title:'{{trans("lang.confirmation")}}',
            content:'{{trans("lang.content_delete")}}',
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