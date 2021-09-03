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
        .branch a{
            cursor: pointer;
            
        }
        .boq-items:hover{
            text-decoration: none;
        }
        .dd3-item > button{
            margin-left:0px !important;
        }

        .tree, .tree ul {
            margin:0;
            padding:0;
            list-style:none
        }
        .tree ul {
            margin-left:1em;
            position:relative
        }
        .tree ul ul {
            margin-left:.5em
        }
        .tree ul:before {
            content:"";
            display:block;
            width:0;
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            border-left:1px solid
        }
        .tree li {
            margin:0;
            padding:5px 1em;
            line-height:2em;
            color:#369;
            font-weight:700;
            position:relative
        }
        .tree ul li:before {
            content:"";
            display:block;
            width:10px;
            height:0;
            border-top:1px solid;
            margin-top:-1px;
            position:absolute;
            top:1em;
            left:0
        }
        .tree ul li:last-child:before {
            background:#fff;
            height:auto;
            top:1em;
            bottom:0
        }
        .indicator {
            margin-right:5px;
        }
        .tree li a {
            text-decoration: none;
            color:#369;
        }
        .tree li button, .tree li button:active, .tree li button:focus {
            text-decoration: none;
            color:#369;
            border:none;
            background:transparent;
            margin:0px 0px 0px 0px;
            padding:0px 0px 0px 0px;
            outline: 0;
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
                        <ul id="tree1">
                            @foreach(getSystemDatas('ZN') as $rows)
                            <li zone_id="{{$rows->id}}">
                                <a href="#">{{$rows->name}}</a>
                                <ul class="add_tree_{{$rows->id}}">
                                    @foreach(getSystemDatas('ZN') as $rows)
                                    <li zone_id="{{$rows->id}}">
                                        <a href="#">{{$rows->name}}</a>
                                        <ul class="add_tree_{{$rows->id}}">
                                            
                                        </ul>
                                    </li>
                                    @endforeach  
                                </ul>
                            </li>
                            @endforeach                                       
                        </ul>
                        <!-- <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
                        </div> -->
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
    $.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            var zone_id = $(this).attr('zone_id');
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                $.get('{{url("report/boqTreeView/getBoq")}}?zone_id='+zone_id,function(val){
                    var str = '';
                    $.each(val,function(index,DataRow){
                        str+='<li class="branch" zone_id="'+zone_id+'" block_id="'+DataRow.block_id+'">';
                            str+='<a href="#">';
                                str+=DataRow.block_name;
                            str+='</a>';
                            str+='<ul class="add_tree_block_{{$rows->id}}"></ul>';
                        str+='</li>';
                    });
                    // $('.add_tree_'+zone_id).html("");
                    // $('.add_tree_'+zone_id).html(str);
                });                
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

	$(function(){
        $('.tree-toggle').click(function () {	$(this).parent().children('ul.tree').toggle(200);
        });
        $(function(){
        $('.tree-toggle').parent().children('ul.tree').toggle(200);
        })
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