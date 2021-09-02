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
        .boq-items{
            cursor: pointer;
        }
        .boq-items:hover{
            text-decoration: none;
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
                        <link class="cssdeck" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css">
                        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">

                        <div class="well" style="width:300px; padding: 8px 0;">
                            <div style="overflow-y: scroll; overflow-x: hidden; height: 500px;">
                                <ul class="nav nav-list">
                                    <li><label class="tree-toggler nav-header">Header 1</label>
                                        <ul class="nav nav-list tree">
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                            <li><label class="tree-toggler nav-header">Header 1.1</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">Link</a></li>
                                                    <li><a href="#">Link</a></li>
                                                    <li><label class="tree-toggler nav-header">Header 1.1.1</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#">Link</a></li>
                                                            <li><a href="#">Link</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="divider"></li>
                                    <li><label class="tree-toggler nav-header">Header 2</label>
                                        <ul class="nav nav-list tree">
                                            <li><a href="#">Link</a></li>
                                            <li><a href="#">Link</a></li>
                                            <li><label class="tree-toggler nav-header">Header 2.1</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">Link</a></li>
                                                    <li><a href="#">Link</a></li>
                                                    <li><label class="tree-toggler nav-header">Header 2.1.1</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#">Link</a></li>
                                                            <li><a href="#">Link</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><label class="tree-toggler nav-header">Header 2.2</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#">Link</a></li>
                                                    <li><a href="#">Link</a></li>
                                                    <li><label class="tree-toggler nav-header">Header 2.2.1</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#">Link</a></li>
                                                            <li><a href="#">Link</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                        <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
                        <div id="" class="">
                            <ol class="lists">
                                @foreach(getSystemDatas('ZN') as $rows)                                
                                <li class="items" id="{{$rows->id}}">                        
                                    <a class="boq-items zone_items" zone_id="{{$rows->id}}" >
                                        {{$rows->name}}
                                    </a>
                                    <ol class="list subb_{{$rows->id}}" style="">
                                        <li class=" item collapsed" data-id="zone" zone_id="{{$rows->id}}">
                                            <div class="content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;"></div>
                                            <ol class="list" style="display: none;">        
                                                <li class="item" data-id="" idbd="{{$rows->id}}">
                                                    <div class="content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
        
                                                    </div>
                                                    <ol class="list" style="display: none;">
                                                        <li class="item" data-id="" idst="{{$rows->id}}">
                                                            <div class="content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
                                                            </div>
                                                            <ol class="list" style="display: none;">
                                                                <li class="tem" data-id="" idh="{{$rows->id}}">
                                                                    <div class="content" style="font-weight: bold !important;padding-left:0px !important;border:0px !important;">
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
        $('label.tree-toggler').click(function () {
            $(this).parent().children('ul.tree').toggle(300);
        });
        $('#permission_tree').nestable();
        $('.dd').nestable('collapseAll');
		$("#btnBack, #btnCancel").on("click",function(){
			var rounte = $(this).attr('rounte');
			window.location.href=rounte;
		});
        var table = $('#my-table').DataTable();
	});
    $('.zone_items').click(function(){
        var zone_id = $(this).attr('zone_id');
        $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id,function(val){
            var str = '';
            $.each(val,function(index,DataRow){
                str+='<li class="item" data-id="" zone_id="'+zone_id+'">';
                    str+='<a onclick="blockItem('+zone_id+','+DataRow.block_id+')" class="boq-items block_items" zone_id="'+zone_id+'" block_id="'+DataRow.block_id+'" >';
                        str+=DataRow.block_name;
                    str+='</a>';
                str+='</li><ol class="list subbl_'+DataRow.block_id+'"></ol>';
            });
            $('.subb_'+zone_id).html("");
            $('.subb_'+zone_id).html(str);
        });
    });
    function blockItem(zone_id,block_id){
        $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id+'&block_id='+block_id,function(val){
            var str = '';
            $.each(val,function(index,DataRow){
                str+='<li class="item" data-id="" id="'+DataRow.block_id+'">';
                    str+='<a onclick="blockBuilding('+zone_id+','+DataRow.block_id+','+DataRow.building_id+')"  class="boq-items block_items" zone_id="'+zone_id+'"                                                                                                                                                                                                                           ="'+DataRow.block_id+'" >';
                        str+=DataRow.building_name;
                    str+='</a>';
                str+='</li><ol class="list subs_'+DataRow.building_id+'"></ol>';
            });
            $('.subbl_'+block_id).html("");
            $('.subbl_'+block_id).html(str);
        });
    }
    
    function blockBuilding(zone_id,block_id,building_id){
        console.log(building_id);
        $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id+'&block_id='+block_id,function(val){
            var str = '';
            $.each(val,function(index,DataRow){
                str+='<li class="item" data-id="" id="'+DataRow.block_id+'">';
                    str+='<a onclick="blockStreet('+zone_id+','+DataRow.block_id+','+DataRow.building_id+','+DataRow.street_id+')" class="boq-items street_items" zone_id="'+zone_id+'"                                                                                                                                                                                                                           ="'+DataRow.block_id+'" >';
                        str+=DataRow.street_name;
                    str+='</a>';
                str+='</li><ol class="list subs_'+DataRow.building_id+'"></ol>';
            });
            $('.subs_'+building_id).html("");
            $('.subs_'+building_id).html(str);
        });
    }
    function blockStreet(zone_id,block_id,building_id,street_id){
        $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id+'&block_id='+block_id,function(val){
            var str = '';
            $.each(val,function(index,DataRow){
                str+='<li class="item" data-id="" id="'+DataRow.block_id+'">';
                    str+='<a class="boq-items block_items" zone_id="'+zone_id+'"                                                                                                                                                                                                                           ="'+DataRow.block_id+'" >';
                        str+=DataRow.building_name;
                    str+='</a>';
                str+='</li><ol class="list subs_'+DataRow.building_id+'"></ol>';
            });
            console.log(str);
            $('.subbl_'+block_id).html("");
            $('.subbl_'+block_id).html(str);
        });
    }
    // $('.block_items').click(function(){
        // var zone_id = $(this).attr('zone_id');
        // var block_id = $(this).attr('block_id');
        // $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id+'&block_id='+block_id,function(val){
        //     var str = '';
        //     $.each(val,function(index,DataRow){
        //         str+='<li class="item" data-id="" id="'+DataRow.block_id+'">';
        //             str+='<a class="boq-items block_items" zone_id="'+zone_id+'"                                                                                                                                                                                                                           ="'+DataRow.block_id+'" >';
        //                 str+=DataRow.block_name;
        //             str+='</a>';
        //         str+='</li><ol class="list subbl_'+DataRow.block_id+'"></ol>';
        //     });
        //     console.log(str);
        //     $('.subbl_'+block_id).html("");
        //     $('.subbl_'+block_id).html(str);
        // });
    // });
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