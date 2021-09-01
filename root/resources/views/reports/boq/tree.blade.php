@extends('layouts.app')
@section('stylesheet')
	<link href="{{ asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/global/plugins/jquery-nestable/jquery.nestable.css') }}" rel="stylesheet" />
	<style>
		td.details-control {
            background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
            cursor: pointer !important;
        }
        tr.shown td.details-control {
            background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
        }
        .dd3-content{
            cursor: pointer;
        }
        .dd3-item > button{
            margin-left:0px !important;
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
                <div class="row" style="margin:0px;">
                    <div class="portlet light bordered well col-md-2">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-social-dribbble font-purple-soft"></i>
                                <span class="caption-subject font-purple-soft bold uppercase"> Tree Boq </span>
                            </div>                                
                        </div>
                        <div id="permission_tree" class="dd">
                            <ol class="dd-list">
                                @foreach(getSystemDatas('ZN') as $rows)                                
                                <li class="dd-item dd3-item" data-id="setup_option" id="{{$rows->id}}">                        
                                    <div class="dd3-content" data="{{$rows->id}}" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
                                        {{$rows->name}}
                                    </div>
                                    <ol class="dd-list subb_{{$rows->id}}" style="">
                                        <li class="dd-item dd3-item dd-collapsed" data-id="zone" idb="{{$rows->id}}">
                                            <div class="dd3-content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
    
                                            </div>
                                            <ol class="dd-list" style="display: none;">
        
                                                <li class="dd-item dd3-item" data-id="" idbd="{{$rows->id}}">
                                                    <div class="dd3-content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
        
                                                    </div>
                                                    <ol class="dd-list" style="display: none;">
                                                        <li class="dd-item dd3-item" data-id="" idst="{{$rows->id}}">
                                                            <div class="dd3-content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
                                                            </div>
                                                            <ol class="dd-list" style="display: none;">
                                                                <li class="dd-item dd3-item" data-id="" idh="{{$rows->id}}">
                                                                    <div class="dd3-content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
                                                                    </div>                                                                    
                                                                </li>
                                                            </ol>
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ol>
                                        </li>
                                    </ol>
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>                    
                    <div class="col-md-10">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-purple-soft"></i>
                                    <span class="caption-subject font-purple-soft bold uppercase"> BOQ & ITEM </span>
                                </div>
                                <div class="actions">
                                    <a title="{{trans('lang.print')}}" onclick="onPrint(this);" version="print" class="btn btn-circle btn-icon-only btn-default">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a title="{{trans('lang.download')}}" onclick="onPrint(this);" version="excel"  class="btn btn-circle btn-icon-only btn-default">
                                        <i class="fa fa-file-excel-o"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="div-table">
                                    <table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="all">{{ trans('lang.working_type') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.house_type') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.house_no') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.item_type') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.item_code') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.item_name') }}</th>
                                                <th width="10%" class="all">{{ trans('rep.boq_qty') }}</th>
                                                <th width="10%" class="all">{{ trans('rep.add_qty') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.units') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.price') }}</th>
                                                <th width="10%" class="all">{{ trans('lang.total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- Modal Varian -->
@endsection()
@section('javascript')
<script src="{{asset('assets/global/plugins/jstree/dist/jstree.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script type="text/javascript">		
	$(function(){
        $('#permission_tree').nestable();
        $('.dd').nestable('collapseAll');
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
        var table = $('#my-table').DataTable();
	});
    $('.dd-item').click(function(){
        // console.log($(this).attr('id'));
        var id = $(this).attr('id');
        $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+id,function(val){

        });
        // $(this).removeClass('dd-collapsed');
        // $(this).addClass('showcollapsed');
        // $('.subb_'+id).css('display','block');
    });
    // $('.showcollapsed').click(function(){
    //     var id = $(this).attr('id');
    //     console.log($(this).attr('id'));
    //     $(this).removeClass('showcollapsed');
    //     $(this).addClass('dd-collapsed');
    //     $('.subb_'+id).css('display','none');
    // });
</script>
<script src="{{asset('assets/apps/scripts/permission.js')}}" type="text/javascript"></script>
@endsection()