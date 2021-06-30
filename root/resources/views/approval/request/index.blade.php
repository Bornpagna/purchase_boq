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
	</style>
	<link href="{{ asset('assets/global/css/organization.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/signature_pad/example/css/signature-pad.css') }}" rel="stylesheet" />
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
							<th width="15%" class="text-center all">{{ trans('lang.reference_no') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.trans_date') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.delivery_date') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.request_by') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.department') }}</th>
							<th width="17%" class="text-center">{{ trans('lang.desc') }}</th>
							<th width="15%" class="text-center all">{{ trans('lang.action') }}</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@include('modal.organization')
@include('modal.signature_approve')

@endsection()

@section('javascript')
<script src="{{ asset('assets/signature_pad/example/js/signature_pad.js') }}" type="text/javascript"></script>
<script type="text/javascript">	
	var objRole = JSON.parse(convertQuot("{{\App\Model\Role::where(['zone'=>1])->get(['id','name','min_amount','max_amount','level','dep_id'])}}"));
	var objApproval = JSON.parse(convertQuot("{{\App\Model\ApproveRequest::select('pr_id','role_id','approved_date','approved_by',DB::raw('(SELECT pr_users.`name` FROM pr_users WHERE pr_users.`id`=approved_by)AS approve_name'))->where('reject',0)->get()}}"));
	
	function format (d) {
        var str = '';
        str += '<table class="table table-striped details-table table-responsive"  id="sub-'+d.id+'">';
            str += '<thead>';
                str += '<tr>';
					str += '<th style="width: 5%;">{{trans("lang.line_no")}}</th>';
                    str += '<th style="width: 30%;">{{trans("lang.items")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.size")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.units")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.qty")}}</th>';
                    str += '<th style="width: 20%;">{{trans("lang.desc")}}</th>';
                    str += '<th style="width: 10%;">{{trans("lang.remark")}}</th>';
                str += '</tr>';
            str += '</thead>';
        str +='</table>';
        return str;
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
			{data: 'ref_no', class:'text-center', name:'ref_no'},
			{data: 'trans_date', class:'text-center', name:'trans_date'},
			{data: 'delivery_date', name:'delivery_date'},
			{data: 'request_by', name:'request_by'},
			{data: 'department', name:'department'},
			{data: 'note', name:'desc'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],order: [[1, 'desc']],fnCreatedRow:function(nRow, aData, iDataIndex){
			$('td:eq(2)',nRow).html(formatDate(aData['trans_date'])).addClass("text-center");
			$('td:eq(3)',nRow).html(formatDate(aData['delivery_date'])).addClass("text-center");
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
				{ data: 'size', name: 'size' },
				{ data: 'unit', name: 'unit' },
				{ data: 'qty', name: 'qty' },
				{ data: 'desc', name: 'desc' },
				{ data: 'remark', name: 'remark' },
			],fnCreatedRow:function(nRow, aData, iDataIndex){
				$('td:eq(4)',nRow).html(formatNumber(aData['qty']));
			}
		});
	}
	
	function onView(field){
		var role_id = $(field).attr('role_id');
		var pr_id = $(field).attr('pr_id');
		var dep_id = $(field).attr('dep_id');
		var step = 0;
		
		$('.tree').empty();
		$.each(objRole.filter(c=>c.dep_id==0).filter(e=>e.level==1), function(key, val){
			var step_index = $(".li-step-"+step).html();
			if(typeof(step_index) == "undefined"){
				var str = '<ul class="ul-step-'+step+'">'+
						'	<li class="li-step-'+step+'">'+
						'		<a href="#" class="a-step-'+step+'">'+
						'			<div>'+val.name+'</div>'+
						'			<div class="step-name-'+val.id+'">Not Available</div>'+
						'			<div>'+formatDollar(val.min_amount)+' -> '+formatDollar(val.max_amount)+'</div>'+
						'			<div class="step-date-'+val.id+'"></div>'+
						'			<i class="fa fa-ban text-danger step-icon-'+val.id+'"></i>'+
						'		</a>'+
						'	</li>'+
						'</ul>';
				$('.tree').append(str);
			}else{
				step++;
				var str = '<ul class="ul-step-'+step+'">'+
						'	<li class="li-step-'+step+'">'+
						'		<a href="#" class="a-step-'+step+'">'+
						'			<div>'+val.name+'</div>'+
						'			<div class="step-name-'+val.id+'">Not Available</div>'+
						'			<div>'+formatDollar(val.min_amount)+' -> '+formatDollar(val.max_amount)+'</div>'+
						'			<div class="step-date-'+val.id+'"></div>'+
						'			<i class="fa fa-ban text-danger step-icon-'+val.id+'"></i>'+
						'		</a>'+
						'	</li>'+
						'</ul>';
				$('.li-step-'+(step-1)).append(str);
			}
		});
		var str = '';
		str += '<ul>';
		$.each(objRole.filter(c=>c.dep_id!=0).filter(e=>e.level==1).filter(f=>f.min_amount==0).filter(g=>g.max_amount==0), function(key, val){
			str += '<li>';
			str	+= '<a href="#">'+val.name+'</a>';
			str	+= '<ul>';
			$.each(objRole.filter(c=>c.dep_id==val.id).filter(e=>e.level==2), function(k, v){
				str += '<li><a href="#">';
				str += '<div>'+v.name+'</div>';
				str += '<div class="step-name-'+v.id+'">Not Available</div>';
				str += '<div>'+formatDollar(v.min_amount)+' -> '+formatDollar(v.max_amount)+'</div>';
				str += '<div class="step-date-'+v.id+'"></div>';
				str += '<i class="fa fa-ban text-danger step-icon-'+v.id+'"></i>';
				str += '</a></li>';
			});
			str	+= '</ul>';
			str	+= '</li>';
		});
		str += '</ul>';
		$('.li-step-'+step).append(str);
		
		if(objApproval){
			$.each(objApproval.filter(c=>c.pr_id==pr_id), function(key, val){
				$(".step-name-"+val.role_id).text(val.approve_name);
				$(".step-date-"+val.role_id).text(val.approved_date);
				$(".step-icon-"+val.role_id).removeClass('fa-ban text-danger').addClass('fa-check text-success');
			});
		}
		
		$('.org-modal').children().find('div').children().find('h4').html('{{trans("lang.view")}}');
		$('.org-modal').modal('show');
	}
	
	function saveImage() {
		var image = $('#image').val();
		var signature = $('#signature').val();
		var signature_pad = $('#signature_pad').val();
		if ((image!='' && image!=null) ||  (signature!='' && signature!=null) ||  (signature_pad!='' && signature_pad!=null)) {
            return true;
		}else{
			return false;
		}
    }
	
	function onApprove(field){
		var id = $(field).attr('row_id');
		var is_finish = $(field).attr('row_finish');
		var rounte = $(field).attr('row_rounte');
		$('.signature-form').attr('action', rounte);
		$('.signature-modal').children().find('div').children().find('h4').html('{{trans("lang.signature")}}');
		$('#signature_pad').val('');
		
		var canvas = document.querySelector("canvas");
		var signaturePad = new SignaturePad(canvas);
		signaturePad.penColor = "rgb(51, 122, 183)";
		var saveButton = document.getElementById('saveSignature');
		var cancelButton = document.getElementById('clear');	
		
		$('.button-submit-signature').attr('id','btnSignature').attr('name','btnSignature');
		$('.button-submit-signature').html('{{trans("lang.save")}}');
		$('.signature-modal').modal('show');
		
		$("#btnSignature").on('click',function(){
			$(this).prop('disabled', true);
			$('#signature-pad').css('border','1px solid #e8e8e8');
			$('.help-block').empty();
			var data = signaturePad.toDataURL('image/png');
			if(!signaturePad.isEmpty()){
				$('#signature_pad').val(data);
				$('#is_finish').val(is_finish);
			}
			if (saveImage()) {
				$('#is_finish').val(is_finish);
				$('.signature-form').submit();
			}else{
				$('.help-block').html("{{trans('lang.signature_required')}}");
				$('#signature-pad').css('border','1px solid #e43a45');
				$(this).prop('disabled', false);
				return false;
			}
		});
		
		cancelButton.addEventListener('click', function (event) {
		  signaturePad.clear();
		});

		saveButton.addEventListener("click", function (event) {
			if (signaturePad.isEmpty()) {
				alert("Please provide signature first.");
			} else {
				var win=window.open();
				win.document.write("<img src='"+signaturePad.toDataURL()+"'/>");
			}
		});
	}
	
	function onReject(field){
		var rounte = $(field).attr('row_rounte');
		$.confirm({
            title:'{{trans("lang.confirmation")}}',
            content:'{{trans("lang.content_reject")}}',
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