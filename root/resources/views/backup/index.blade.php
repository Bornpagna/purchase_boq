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
				@if(hasRole('backup_add'))
					<form action="{{url('backup/save')}}" method="POST" enctype="multipart/form-data">
						{{csrf_field()}}
						<button type="submit" class="btn btn-circle btn-icon-only btn-default" data-toggle="tooltip" title="{{trans('lang.backup')}}">
							<i class="fa fa-database"></i>
						</button>
					</form>
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
							<th style="width: 3%;" class="all">{{trans('lang.line_no')}}</th>
							<th style="width: 67%;" class="all">{{trans('lang.document')}}</th>
							<th style="width: 15%;" class="all">{{trans('lang.created_at')}}</th>
							<th style="width: 5%;" class="all">{{trans('lang.action')}}</th>
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
	
	function onDelete(id){
        $.confirm({
            title:'{{trans("lang.title_delete")}}',
            content:'{{trans("lang.content_delete")}}',
            autoClose: 'no|10000',
            buttons:{
                yes:{
                    text:'{{trans("lang.yes")}}',
                    btnClass: 'btn-success',
                    action:function(){
                        window.location.href='{{url("backup/destroy")}}'+'/'+id;
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

    function onDownload(id){
        window.location.href='{{url("backup/download")}}/'+id;
    }

	$(document).ready(function(){
		$('#my-table').DataTable({
            processing: true,
            serverSide: true,
            language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
            ajax: "{{url('backup/dt')}}",
            columns: [
				{ data: 'id', name: 'id' },
				{ data: 'path', name: 'path' },
                { data: 'created_at', name: 'created_at' },
                { data: 'id', name: 'id', orderable: false, searchable: false,class:'btn-action' }
            ],fnCreatedRow:function(nRow,aData,iDataIndex){
            	$('td:eq(0)',nRow).html(iDataIndex+1).addClass("text-center");
				var str='<div class="actions">';
					@if(hasRole('backup_download'))
						str+='<a title="{{trans('lang.download')}}" class="btn btn-circle btn-xs btn-primary" onclick="onDownload('+aData['id']+');">';
						str+='<i class="fa fa-download"></i>';
						str+='</a>';
					@else
						str+='<a title="{{trans('lang.download')}}" class="btn btn-circle btn-xs btn-primary" disabled>';
						str+='<i class="fa fa-download"></i>';
						str+='</a>';
					@endif
					@if(hasRole('backup_delete'))
						str+='<a title="{{trans('lang.delete')}}" class="btn btn-circle btn-xs btn-danger" onclick="onDelete('+aData['id']+');">';
						str+='<i class="fa fa-remove"></i>';
						str+='</a>';
					@else
						str+='<a title="{{trans('lang.delete')}}" class="btn btn-circle btn-xs btn-danger" disabled>';
						str+='<i class="fa fa-remove"></i>';
						str+='</a>';
					@endif
					str+='</div>';
				$('td:eq(3)',nRow).html(str).addClass("text-center");
            }
        });

	});
</script>
@endsection()