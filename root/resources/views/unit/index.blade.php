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
							<th width="10%" class="text-center all">{{ trans('lang.from_code') }}</th>
							<th width="20%" class="text-center">{{ trans('lang.from_desc') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.to_code') }}</th>
							<th width="20%" class="text-center">{{ trans('lang.to_desc') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.factor') }}</th>
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

<!-- Modal Varian -->

@include('modal.unit')
@include('modal.upload')

@endsection()

@section('javascript')
<script type="text/javascript">
	var jsonUnit = JSON.parse(convertQuot("{{\App\Model\Unit::get(['id','from_code','from_desc','to_code','to_desc','factor','status'])}}"));
	var objName = [];
	$('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{data: 'from_code', name:'name'},
			{data: 'from_desc', name:'from_desc'},
			{data: 'to_code', name:'to_code'},
			{data: 'to_desc', name:'to_desc'},
			{data: 'factor', name:'factor'},
			{data: 'status', name:'status'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],'fnCreatedRow':function(nRow,aData,iDataIndex){
			if(aData['status']==1){
				var str='<span class="label label-info" style="font-size: smaller;">{{trans("lang.active")}}</span>';
			}else{
				var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.disable")}}</span>';
			}
			$('td:eq(5)',nRow).html(str).addClass("text-center");
			
			if (objName) {
				var obj = {
					'id':aData['id'],
					'name':aData['from_code'],
					'from_desc':aData['from_desc'],
					'to_code':aData['to_code'],
					'to_desc':aData['to_desc'],
					'factor':aData['factor'],
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
			$('.system-form').attr('action',rounte);
			$('.system-modal').children().find('div').children().find('h4').html('{{trans("lang.add_new")}}');
			$('#old_from_code').val('');
			$('#from_code').val('');
			$('#from_desc').val('');
			$('#old_to_code').val('');
			$('#to_code').val('');
			$('#to_desc').val('');
			$('#factor').val('');
			$('#status').select2('val',1);
			$('.button-submit').attr('id','btnSave').attr('name','btnSave');
			$('.button-submit').html('{{trans("lang.save")}}');
			$('.system-modal').modal('show');
			
			$("#btnSave").on('click',function(){
				if(chkValid([".from_code",".from_desc",".to_code",".to_desc",".status",".factor"])){
					var from_code = $("#from_code").val();
					var to_code =$("#to_code").val();
					if(from_code!=to_code){
						if(jsonUnit){
							var isValid = true;
							var unitFromTo = jsonUnit.filter(a=>a.to_code==to_code).filter(c=>c.from_code==from_code);
							var unitTo = jsonUnit.filter(a=>a.from_code==to_code).filter(c=>c.to_code==to_code);
							var unitFrom = jsonUnit.filter(a=>a.from_code==from_code).filter(c=>c.to_code==from_code);
							if(unitFromTo.length > 0){
								$(".show-message-error").html('Conversion '+from_code+' to '+to_code+' is already exist!');
								isValid = false;
							}else if(unitTo.length <= 0 && unitFrom.length <= 0){
								isValid =false;
								$(".show-message-error").html('You must create '+from_code+' to '+from_code+' qty = 1 first!');
							}else if(unitTo.length <= 0){
								isValid =false;
								$(".show-message-error").html('You must create '+to_code+' to '+to_code+' qty = 1 first!');
							}
							if(isValid==true){
								$(".show-message-error").empty();
							}
							return isValid;
						}else{
							$(".show-message-error").html('You must create '+from_code+' to '+from_code+' qty = 1 first!');
							return false;
						}
					}else{
						if(jsonUnit){
							var isValid = true;
							var unitFromTo = jsonUnit.filter(a=>a.to_code==to_code).filter(c=>c.from_code==from_code);
							if(unitFromTo.length > 0){
								$(".show-message-error").html('Conversion '+from_code+' to '+to_code+' is already exist!');
								isValid = false;
							}
							if(isValid==true){
								$(".show-message-error").empty();
							}
							return isValid;
						}else{
							$(".show-message-error").empty();
							return true;
						}
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
		$('.system-form').attr('action',rounte);
		$('.system-modal').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
		if(objName){
			$.each(objName.filter(c=>c.id==id),function(key,val){
				$('#from_code').val(val.name);
				$('#old_from_code').val(val.name);
				$('#from_desc').val(val.from_desc);
				$('#to_code').val(val.to_code);
				$('#old_to_code').val(val.to_code);
				$('#to_desc').val(val.to_desc);
				$('#status').select2('val',val.status);
				$('#factor').val(val.factor);
			});
		}
		$('.button-submit').attr('id','btnUpdate').attr('name','btnUpdate');
		$('.button-submit').html('{{trans("lang.save_change")}}');
		$('.system-modal').modal('show');
		
		$("#btnUpdate").on('click',function(){
			if(chkValid([".from_code",".from_desc",".to_code",".to_desc",".status",".factor"])){
				var from_code = $("#from_code").val();
				var to_code =$("#to_code").val();
				var old_from_code = $("#old_from_code").val();
				var old_to_code =$("#old_to_code").val();
				if(old_to_code==to_code && old_from_code==from_code){
					$('.show-message-error').empty();
					return true;
				}else{
					if(from_code!=to_code){
						if(jsonUnit){
							var isValid = true;
							var unitFromTo = jsonUnit.filter(a=>a.to_code==to_code).filter(c=>c.from_code==from_code);
							var unitTo = jsonUnit.filter(a=>a.from_code==to_code).filter(c=>c.to_code==to_code);
							var unitFrom = jsonUnit.filter(a=>a.from_code==from_code).filter(c=>c.to_code==from_code);
							if(unitFromTo.length > 0){
								$(".show-message-error").html('Conversion '+from_code+' to '+to_code+' is already exist!');
								isValid = false;
							}else if(unitTo.length <= 0 && unitFrom.length <= 0){
								isValid =false;
								$(".show-message-error").html('You must create '+from_code+' to '+from_code+' qty = 1 first!');
							}else if(unitTo.length <= 0){
								isValid =false;
								$(".show-message-error").html('You must create '+to_code+' to '+to_code+' qty = 1 first!');
							}
							if(isValid==true){
								$(".show-message-error").empty();
							}
							return isValid;
						}else{
							$(".show-message-error").html('You must create '+from_code+' to '+from_code+' qty = 1 first!');
							return false;
						}
					}else{
						if(jsonUnit){
							var isValid = true;
							var unitFromTo = jsonUnit.filter(a=>a.to_code==to_code).filter(c=>c.from_code==from_code);
							if(unitFromTo.length > 0){
								$(".show-message-error").html('Conversion '+from_code+' to '+to_code+' is already exist!');
								isValid = false;
							}
							if(isValid==true){
								$(".show-message-error").empty();
							}
							return isValid;
						}else{
							$(".show-message-error").empty();
							return true;
						}
					}
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