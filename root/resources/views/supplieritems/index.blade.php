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
				<div class="form-group">
					<div class="col-md-12 ">
						<span class="show-message-error center font-red bold"></span>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover dt-responsive" id="my-table">
					<thead>
						<tr>
							<th width="15%" class="text-center all">{{ trans('lang.supplier') }}</th>
							<th width="30%" class="text-center all">{{ trans('lang.items') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.units') }}</th>
							<th width="15%" class="text-center">{{ trans('lang.price') }}</th>
							<th width="10%" class="text-center all">{{ trans('lang.status') }}</th>
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

@include('modal.supplier_items')
@include('modal.edit_supplier_items')

@endsection()

@section('javascript')
<script type="text/javascript">
	var objName = [];
	var jsonUnits = JSON.parse(convertQuot("{{\App\Model\Unit::get(['id','from_code','from_desc','to_code','to_desc','factor','status'])}}"));
	var jsonSuppliers = JSON.parse(convertQuot("{{\App\Model\Supplier::where('status',1)->get(['id','name'])}}"));
	var jsonItems = JSON.parse(convertQuot("{{\App\Model\Item::where('status',1)->get(['id','code','name','unit_purch','unit_stock'])}}"));
	
	var optionItem = '';
	var optionSupplier  = '';

	if (jsonItems) {
		$.each(jsonItems, function(key, value){
			optionItem += '<option value="'+value.id+'">'+value.code+' ('+value.name+')</option>';
		});
	}

	if (jsonSuppliers) {
		$.each(jsonSuppliers, function(key, value){
			optionSupplier +='<option value="'+value.id+'">'+value.name+'</option>';
		});
	}

	var index = 0;
	$('#table_purchase').DataTable({
		"filter":   false,
		"paging":   false,
		"ordering": false,
		"info":     false
	});
	
	function onChangeItem(field, row){
		var val = $(field).val();
		if(val!=null && val!='' && jsonUnits && jsonItems){
			$.each(jsonItems.filter(c=>c.id==val), function(key, val){
				$('.line_unit_'+row).empty();
				$('.line_unit_'+row).append($('<option></option>').val('').text(''));
				$.each(jsonUnits.filter(d=>d.to_code==val.unit_stock), function(k, v){
					$('.line_unit_'+row).append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
				});
				$('.line_unit_'+row).select2('val', val.unit_purch);
			});
		}
	}
	
	function DeleteDataRow(id){
		var table_purchase = $('#table_purchase').DataTable();
		table_purchase.row($('.row_'+id).parents('tr')).remove().draw( false );
		
		table_purchase.rows().eq(0).each(function(index){
			var cell = table_purchase.cell(index,0);
			$(cell.node()).find(".line").text(lineNo(parseFloat(index)+1,3));
			$(cell.node()).find(".line_no").val(lineNo(parseFloat(index)+1,3));
		});
	}
	
	$('.pointer').on('click', function(){
		var table_purchase = $('#table_purchase').DataTable();
		var line_no = table_purchase.rows().count();
		if(index < 100){
			$(".show-message-error").empty();
			table_purchase.row.add([
				'<span class="line" style="font-size: larger;font-weight: bold;">'+lineNo((line_no+1),3)+'</span>'
				+'<input type="hidden" value="'+lineNo((line_no+1),3)+'" name="line_no[]" class="line_no line_no_'+index+'" />',
				'<select name="line_supplier[]" class="form-control select2_'+index+' line_supplier line_supplier_'+index+'">'
					+'<option value=""></option>'
				+'</select>',
				'<select name="line_item[]" onchange="onChangeItem(this, '+index+')" class="form-control select2_'+index+' line_item line_item_'+index+'">'
					+'<option value=""></option>'
				+'</select>',
				'<select name="line_unit[]" class="form-control select2_'+index+' line_unit line_unit_'+index+'" >'
					+'<option value=""></option>'
				+'</select>',
				'<input type="number" step="any" class="form-control line_price line_price_'+index+'" name="line_price[]" placeholder="{{trans("lang.enter_number")}}" />',
				'<a class="row_'+index+' btn btn-sm red" onclick="DeleteDataRow('+index+')"><i class="fa fa-times"></i></a>',
			]).draw();
			$.fn.select2.defaults.set('theme','classic');
			$(".select2_"+index).select2({placeholder:'{{trans("lang.please_choose")}}',width:'100%',allowClear:true});
			$('.line_item_'+index).append(optionItem);
			$('.line_supplier_'+index).append(optionSupplier);

			/*if(jsonItems){
				$.each(jsonItems, function(key ,val){
					$('.line_item_'+index).append($('<option></option>').val(val.id).text(val.code+' ('+val.name+')'));
				});
			}*/
			/*if(jsonSuppliers){
				$.each(jsonSuppliers, function(key ,val){
					$('.line_supplier_'+index).append($('<option></option>').val(val.id).text(val.name));
				});
			}*/
			index++;
		}else{
			$(".show-message-error").html('{{trans("lang.not_more_than_100")}}!');
		}
	});
	
	$('#my-table').DataTable({
		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
		processing: true,
		serverSide: true,
		language: {"url": "{{url('assets/lang').'/'.config('app.locale').'.json'}}"},
		ajax: '{{$rounte}}',
		columns: [
			{data: 'sup_name', name:'sup_name'},
			{data: 'item_desc', name:'item_desc'},
			{data: 'unit', name:'unit'},
			{data: 'price', name:'price'},
			{data: 'status', name:'status'},
			{data: 'action', class :'text-center', orderable: false, searchable: false},
		],'fnCreatedRow':function(nRow,aData,iDataIndex){
			if(aData['status']==1){
				var str='<span class="label label-info" style="font-size: smaller;">{{trans("lang.active")}}</span>';
			}else{
				var str='<span class="label label-danger" style="font-size: smaller;">{{trans("lang.disable")}}</span>';
			}
			$('td:eq(3)',nRow).html(formatDollar(aData['price']));
			$('td:eq(4)',nRow).html(str).addClass("text-center");
			
			if (objName) {
				var obj = {
					'id':aData['id'],
					'sup_id':aData['sup_id'],
					'item_id':aData['item_id'],
					'unit':aData['unit'],
					'price':aData['price'],
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
			index = 0;
			var table_purchase = $('#table_purchase').DataTable();
			table_purchase.row().clear();
			$('.pointer').trigger('click');
			
			$('.button-submit').attr('id','btnSave').attr('name','btnSave');
			$('.button-submit').html('{{trans("lang.save")}}');
			$('.system-modal').modal('show');
			
			$("#btnSave").on('click',function(){
				var table_purchase = $('#table_purchase').DataTable();
				if (!table_purchase.data().count()) {
					$('.system-modal').modal('hide');
					return false;
				}else{
					if(chkValid([".line_supplier",".line_item",".line_unit",".line_price"])){
						$('.system-form').submit();
					}else{
						return false;
					}
				}
			});
		});
		/* end button click save */
	});	
	
	function onEdit(field){
		var id = $(field).attr('row_id');
		var rounte = $(field).attr('row_rounte');
		var _token = $("input[name=_token]").val();
		var unit = 0;
		$('.system-form-edit').attr('action',rounte);
		$('.system-modal-edit').children().find('div').children().find('h4').html('{{trans("lang.edit")}}');
		if(objName){
			$.each(objName.filter(c=>c.id==id),function(key,val){
				if(jsonItems){
					$('#item').empty();
					$('#item').append($('<option></option>').val('').text(''));
					$.each(jsonItems, function(key ,val){
						$('#item').append($('<option></option>').val(val.id).text(val.code+' ('+val.name+')'));
					});
				}
				if(jsonSuppliers){
					$('#supplier').empty();
					$('#supplier').append($('<option></option>').val('').text(''));
					$.each(jsonSuppliers, function(key ,val){
						$('#supplier').append($('<option></option>').val(val.id).text(val.name));
					});
				}
				if(jsonItems && jsonSuppliers){
					$('#supplier').select2('val', val.sup_id);
					$('#item').select2('val', val.item_id);
					$.each(jsonItems.filter(c=>c.id==val.item_id), function(key, uval){
						$('#unit').empty();
						$('#unit').append($('<option></option>').val('').text(''));
						$('#unit').select2('val', null);
						$.each(jsonUnits.filter(d=>d.to_code==uval.unit_stock), function(k, v){
							$('#unit').append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
						});
					});
					$('#unit').select2('val', val.unit);
				}
				$('#price').val(val.price);
			});
		}
		$('.button-submit-edit').attr('id','btnUpdate').attr('name','btnUpdate');
		$('.button-submit-edit').html('{{trans("lang.save_change")}}');
		$('.system-modal-edit').modal('show');
		
		$('#item').on('change', function(){
			var val = $(this).val();
			if(val!=null && val!='' && jsonUnits && jsonItems){
				$.each(jsonItems.filter(c=>c.id==val), function(key, val){
					$('#unit').empty();
					$('#unit').append($('<option></option>').val('').text(''));
					$('#unit').select2('val', null);
					$.each(jsonUnits.filter(d=>d.to_code==val.unit_stock), function(k, v){
						$('#unit').append($('<option></option>').val(v.from_code).text(v.from_code+' ('+v.from_desc+')'));
					});
				});
			}
		});
		
		$("#btnUpdate").on('click',function(){
			if(chkValid([".supplier",".item",".unit",".price"])){
				$('.system-form-edit').submit();
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