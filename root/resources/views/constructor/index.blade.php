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
					@if(isset($rounteSave))
						<a rounte="{{$rounteSave}}" title="{{trans('lang.add_new')}}" class="btn btn-circle btn-icon-only btn-default" id="btnAdd">
							<i class="fa fa-plus"></i>
						</a>
					@endif
					@if(isset($rounteDownload))
						<a title="{{trans('lang.download')}}" class="btn btn-circle btn-icon-only btn-default" href="{{$rounteDownload}}">
							<i class="fa fa-file-excel-o"></i>
						</a>
					@endif
					@if(isset($rounteUploade))
						<a rounte="{{$rounteUploade}}" title="{{trans('lang.upload')}}" class="btn btn-circle btn-icon-only btn-default" id="btnUpload">
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
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
							<th width="15%" class="text-center all">{{ trans('lang.id_card') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.name') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.tel') }}</th>
							<th width="20%" class="text-center">{{ trans('lang.address') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.type') }}</th>
							<th width="10%" class="text-center">{{ trans('lang.status') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('modal.constructor')
@include('modal.upload')

@endsection()

@section('javascript')
<script type="text/javascript">
	var objName = [];
	$('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{data: 'name', name:'name'},
			{data: 'id_card', name:'id_card'},
			{data: 'tel', name:'tel'},
			{data: 'address', name:'address'},
			{data: 'type_desc', name:'type_desc'},
			{data: 'status', name:'status'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],'fnCreatedRow':function(nRow,aData,iDataIndex){
			if(aData['status']==1){
				var str='<span class="label label-info" style="font-size: smaller;">{{trans("lang.active")}}</span>';
				$('td:eq(5)',nRow).html(str).addClass("text-center");
			}else{
				var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.disable")}}</span>';
				$('td:eq(5)',nRow).html(str).addClass("text-center");
			}
			
			if (objName) {
				var obj = {
					'id':aData['id'],
					'id_card':aData['id_card'],
					'name':aData['name'],
					'tel':aData['tel'],
					'address':aData['address'],
					'type':aData['type'],
					'status':aData['status'],
				};
				objName.push(obj);
			}
		}
	});
	
	$(function(){
		/* button click save */
		$("#btnAdd").on("click",function(){
			var rounte = $(this).attr('rounte');
			$('.constructor-form').attr('action',rounte);
			$('.constructor-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#id_card').val('');
			$('#old_id_card').val('');
			$('#con-name').val('');
			$('#con-tel').val('');
			$('#con-type').select2('val',null);
			$('#con-status').select2('val',1);
			$('#con-address').val('');
			$('.button-submit-constructor').attr('id','btnSave').attr('name','btnSave');
			$('.button-submit-constructor').html('{{trans("lang.save")}}');
			$('.constructor-modal').modal('show');
			
			$("#btnSave").on('click',function(){
				if(chkValid([".id_card",".con-name",".con-tel",".con-type",".con-status",".con-address"])){
					if(chkDublicateName(objName, '#id_card')){
						$('.constructor-form').submit();
					}else{
						return false;
					}
				}else{
					return false;
				}
			});
		});
		/* end button click save */
		
		/* upload file excel */
		$('#btnUpload').on('click',function(){
			$('.upload-excel-form').modal('show');
			var rounte = $(this).attr('rounte');
			$('.upload-excel-form').attr('action',rounte);
			$('#btn_upload_excel').on('click',function(){
				if(onUploadExcel()){}else{return false}
			}); 
		});
		/* end upload file excel */
	});	
	
	function onEdit(field){
		var id = $(field).attr('row_id');
		var rounte = $(field).attr('row_rounte');
		var _token = $("input[name=_token]").val();
		$('.constructor-form').attr('action',rounte);
		$('.constructor-modal').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
		if(objName){
			$.each(objName.filter(c=>c.id==id),function(key,val){
				$('#id_card').val(val.name);
				$('#old_id_card').val(val.name);
				$('#con-name').val(val.id_card);
				$('#con-tel').val(val.tel);
				$('#con-type').select2('val',val.type);
				$('#con-status').select2('val',val.status);
				$('#con-address').val(val.address);
			});
		}
		$('.button-submit-constructor').attr('id','btnUpdate').attr('name','btnUpdate');
		$('.button-submit-constructor').html('{{trans("lang.save_change")}}');
		$('.constructor-modal').modal('show');
		
		$("#btnUpdate").on('click',function(){
			if(chkValid([".id_card",".con-name",".con-tel",".con-type",".con-status",".con-address"])){
				if(chkDublicateName(objName, '#id_card','#old_id_card')){
					$('.constructor-form').submit();
				}else{
					return false;
				}
			}else{
				return false;
			}
		});
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