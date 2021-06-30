@extends('layouts.app')

@section('content')
<style>
    td.details-control {
        background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
        cursor: pointer !important;
    }
    tr.shown td.details-control {
        background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
    }
	.btnAdd{
		cursor: pointer;
	}
	.form-horizontal .form-group {
		margin-left: 0px !important;
		margin-right: 0px !important;
	}
</style>
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
					@if(isset($routeAdd))
						<a rounte="{{$routeAdd}}" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default" id="btnAdd">
							<i class="fa fa-plus"></i>
						</a>
					@endif
					@if(isset($routeDownload))
						<a title="{{trans('lang.download')}}" class="btn btn-circle btn-icon-only btn-default" href="{{$routeDownload}}">
							<i class="fa fa-file-excel-o"></i>
						</a>
					@endif
					@if(isset($routeUpload))
						<a rounte="{{$routeUpload}}" title="{{trans('lang.upload')}}" class="btn btn-circle btn-icon-only btn-default" id="btnUpload">
							<i class="icon-cloud-upload"></i>
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
				<?php if(Session::has('bug') && count(Session::get('bug')>0)): ?>
					<?php
						echo '<div class="alert alert-danger display-show"><button class="close" data-close="alert"></button>';
						foreach(Session::get('bug') as $key=>$val){
								echo '<strong>'.trans('lang.error').'!</strong>'.trans('lang.dublicate_at_record').' '.$val['index'].'<br/>';
						}
						echo '</div>';
					?>
				<?php endif; ?>
				<table class="table table-striped table-bordered table-hover" id="data-table">
					<thead>
						<tr>
							<th width="3%" class="all"></th>
							<th width="10%" class="text-center">{{ trans('lang.code') }}</th>
							@if(getSetting()->allow_zone == 1)
							<th width="8%" class="text-center">{{ trans('lang.zone') }}</th>
							@endif
							@if(getSetting()->allow_block == 1)
							<th width="8%" class="text-center">{{ trans('lang.block') }}</th>
							@endif
							<th width="10%" class="text-center">{{ trans('lang.street') }}</th>
							<th width="10%" class="text-center">{{ trans('lang.updated_by') }}</th>
							<th width="10%" class="text-center">{{ trans('lang.updated_at') }}</th>
							<th width="8%" class="text-center all">{{ trans('lang.action') }}</th>
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
	initDataTable = function(){
        // Initialized datatable
        var columns = [];
        columns.push({
				className: 'details-control',
				orderable: false,
				searchable: false,
				data: null,
				defaultContent: ''
			});
		columns.push({data: 'code', name:'code'});
		if('{{getSetting()->allow_zone}}' == 1){columns.push({data: 'zone', name:'zone'});}
		if('{{getSetting()->allow_block}}' == 1){columns.push({data: 'block', name:'block'});}
        columns.push({data: 'street', name:'street'});
        columns.push({data: 'updated_by', name:'updated_by'});
		columns.push({data: 'updated_at', name:'updated_at'});
        columns.push({data: 'action', name:'action',orderable: false,});
        var table = $('#data-table').DataTable({
			"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
            language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			ajax: '<?php echo url("usageFormula/datatables");?>',
			columns: columns,
            'search':{'regex':true},
            order:[1,'desc'],
            fnCreatedRow:function(nRow,aData,iDataIndex){
                
			}
		});

        $('#data-table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
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
    }

    format = function(d) {
        var str = '';
        	str += '<table class="table table-striped details-table"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
                    str += '<th style="width: 10%;">{{trans("lang.house_type")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.house")}}</th>';
					// str += '<th style="width: 10%;">{{trans("lang.item_type")}}</th>';
					// str += '<th style="width: 35%;">{{trans("lang.items")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.usage_percent")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
    }

	initTable = function(tableId, data) {
		$('#' + tableId).DataTable({
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "{{trans("lang.all")}}"]],
			processing: true,
			serverSide: true,
			language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
			paging:true,
			filter:true,
			info:true,
			ajax: data.details_url,
			columns: [
                { data: 'house_type', name: 'house_type' },
                { data: 'house_no', name: 'house_no' },
				// { data: 'item_type', name: 'item_type' },
				// { data: 'item', name: 'item' },
                { data: 'percentage', name: 'percentage' }
			],fnCreatedRow:function(nRow, aData, iDataIndex){
                
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
			var rounte = $(this).attr('rounte');
			$('.upload-excel-form').attr('action',rounte);
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
                        $.ajax({
							url:rounte,
							type:'DELETE',
							data:{
								_token: $('input[name=_token]').val(),
							},
							success:function(data){
								location.reload();
							},error:function(err){
								location.reload();
							}
						});
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

	$(document).ready(function(){
        initDataTable();
    });
</script>
@endsection()