@extends('layouts.app')

@section('content')
<?php 
    $start_date     = '';
    $end_date       = '';
    $param          = '?v=1';
    $start          = 0;
    if (Request::input('start_date')) {
        $start_date = Request::input('start_date');
        $param.='&start_date='.$start_date;
    }else{
        $date = strtotime("-".(date('d') - 1)." day", strtotime(date('Y-m-d')));
        $start_date = date("Y-m-d", $date);
        $param.='&start_date='.$start_date;
    }

    if (Request::input('end_date')) {
        $end_date = Request::input('end_date');
        $param.='&end_date='.$end_date;
    }else{
        $end_date = date('Y-m-d');
        $param.='&end_date='.$end_date;
    }
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title hidden-print">
                <div class="caption">
                    <i class="{{$icon}} font-dark"></i>
                    <span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
                    <span class="caption-helper">{{$small_title}}</span>
                </div>
                <div class="actions">
                    <a title="{{trans('lang.print')}}" id="btnPrint" class="btn btn-circle btn-icon-only btn-default">
                        <i class="fa fa-print"></i>
                    </a>
                    <a title="{{trans('lang.download')}}" id="btnExcel" class="btn btn-circle btn-icon-only btn-default">
                        <i class="fa fa-file-excel-o"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet-body" style="padding-bottom: 10px;">
                    <form class="hidden-print" id="form-filter">
                        <input type="hidden" value="{{$start_date}}" name="start_date" id="start_date">
                        <input type="hidden" value="{{$end_date}}" name="end_date" id="end_date">
                        <input type="hidden" value="excel" name="version" id="version">
                        <div class="portlet-body form-horizontal" style="border: 1px solid #72aee2;padding: 5px 0px;background: #f8f9fb;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label class="control-label bold">{{trans('lang.trans_date')}}
                                            <span class="required">*</span> 
                                        </label>
                                        <div id="report_date" class="btn btn-info" style="width: 100%;">
                                            <i class="fa fa-calendar"></i> &nbsp;
                                            <span> </span>
                                            <b class="fa fa-angle-down"></b>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ref_id" class="control-label bold">{{trans('lang.reference_no')}}</label>
                                        <select class="form-control ref_id" id="ref_id" name="ref_id[]" multiple>
                                            <option></option>
                                            {{getDeliveryRef()}}
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="item_id" class="control-label bold">{{trans('lang.items')}}</label>
                                        <select class="form-control item_id" id="item_id" name="item_id[]" multiple>
                                            {{getItems()}}
                                        </select>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <label for="item_id" class="control-label bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-primary" id="btnSearch"><i class="fa fa-filter"></i> {{trans('rep.search')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-bordered table-hover dt-responsive" id="my-table1">
                    <thead>
                        <tr>
                            <th width="3%" class="text-center all">{{ trans('lang.line_no') }}</th>
                            <th width="8%" class="text-center all">{{ trans('lang.trans_date') }}</th>
                            <th width="8%" class="text-center all">{{ trans('lang.reference_no') }}</th>
                            <th width="8%" class="text-center all">{{ trans('lang.po_no') }}</th>
                            <th width="10%" class="text-center all">{{ trans('lang.supplier') }}</th>
                            <th width="10%" class="text-center all">{{ trans('lang.warehouse') }}</th>
                            <th width="25%" class="text-center all">{{ trans('lang.items') }}</th>
                            <th width="8%" class="text-center all">{{ trans('lang.qty') }}</th>
                            <th width="8%" class="text-center all">{{ trans('rep.return_qty') }}</th>
                            <th width="8%" class="text-center all">{{ trans('lang.units') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-row">
                        <tr>
                            <td colspan="10" class="text-center">{{trans('lang.no_data_available_in_table')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="invoice" style="display: none;">
    @include('reports.header')
    <div style="width: -webkit-fill-available;">
        <span style="position: absolute;
        margin: 153px 0px 0px 0px;
        width: -webkit-fill-available;
        font-size: 12px;
        font-family: myKhBattambang;
        font-weight: bold;">*{{trans("lang.trans_date")}} :..............................................</span>
        <span style="position: absolute;
        margin: 149px 0px 0px 70px;
        width: -webkit-fill-available;
        font-size: 12px;
        font-family: myKhBattambang;
        font-weight: bold;
        color: {{getSetting()->report_header_color}};" id="trans_date_report"></span>
    </div>
    <style type="text/css">
        .invoice-table th {
            font-family: myKhBattambang !important;
            background-color: {{getSetting()->report_header_color}} !important;
            color: white !important;
            border-top: 1px solid {{getSetting()->report_header_color}} !important;
            border-bottom: 1px solid {{getSetting()->report_header_color}} !important;
            border-right: 1px solid {{getSetting()->report_header_color}} !important;
            border-left: 1px solid {{getSetting()->report_header_color}} !important;
            padding: 1px !important;
            font-size: 10px !important;
            text-align: center !important;
        }

        .invoice-table td {
            font-size: 9px !important;
            font-family: myKhBattambang !important;
            padding: 2px 2px 2px 2px !important;
            border-top: 1px solid #9E9E9E !important;
            border-bottom: 1px solid #9E9E9E !important;
            border-right: 1px solid #9E9E9E !important;
            border-left: 1px solid #9E9E9E !important;

        }

        .text-center {
            text-align: center !important;
        }

    </style>
    <div class="invoice-items">
        <div class="div-table">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th width="3%" class="text-center all">{{ trans('lang.line_no') }}</th>
                        <th width="8%" class="text-center all">{{ trans('lang.trans_date') }}</th>
                        <th width="8%" class="text-center all">{{ trans('lang.reference_no') }}</th>
                        <th width="8%" class="text-center all">{{ trans('lang.po_no') }}</th>
                        <th width="10%" class="text-center all">{{ trans('lang.supplier') }}</th>
                        <th width="10%" class="text-center all">{{ trans('lang.warehouse') }}</th>
                        <th width="25%" class="text-center all">{{ trans('lang.items') }}</th>
                        <th width="8%" class="text-center all">{{ trans('lang.qty') }}</th>
                        <th width="8%" class="text-center all">{{ trans('rep.return_qty') }}</th>
                        <th width="8%" class="text-center all">{{ trans('lang.units') }}</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-tbody">
                    <tr>
                        <td colspan="10" class="text-center">{{trans('lang.no_data_available_in_table')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection()

@section('javascript')
<script type="text/javascript">
    $("#btnSearch").on('click',function(){
        App.startPageLoading(); 
        var _token = $("input[name=_token]").val();
        $.ajax({
            url :'{{url("report/delivery_details/get_data")}}',
            type:'POST',
            data:{
                '_token': _token,
                'start_date': $('#start_date').val(),
                'end_date': $('#end_date').val(),
                'ref_id': $('#ref_id').val(),
                'item_id': $('#item_id').val(),
                'version': 'generate',
            },
            success:function(data){
                var str = '';
                $.each(data, function(key, val){
                    str += '<tr>';
                    str += '    <td style="text-center">'+lineNo(key + 1, 3) +'</td>';
                    str += '    <td class="text-center">'+formatDate(val.trans_date)+'</td>';
                    str += '    <td>'+val.ref_no+'</td>';
                    str += '    <td>'+val.po_no+'</td>';
                    str += '    <td>'+val.supplier+'</td>';
                    str += '    <td>'+val.warehouse+'</td>';
                    str += '    <td>'+val.item_desc+'</td>';
                    str += '    <td>'+formatNumber(val.qty)+'</td>';
                    str += '    <td>'+formatNumber(val.return_qty)+'</td>';
                    str += '    <td class="text-center">'+val.unit+'</td>';
                    str += '</tr>';
                });
                $('.table-row, .invoice-table-tbody').empty();
                $('.table-row, .invoice-table-tbody').append(str);
                App.stopPageLoading();
            },error:function(){
                clearTable();
                App.stopPageLoading();
            }
        });
    });

    $("#btnPrint").on('click',function(){
        $('#trans_date_report').empty();
        $('#trans_date_report').append($('#report_date span').text());
        generatePrint();
    });

    $("#btnExcel").on('click',function(){
        var data = $("#form-filter").serialize();
        window.location.href = "<?php echo url('report/delivery_details/get_data')?>?"+data;
    });

    function generatePrint() {
        var strInvioce=$('.invoice').html();
        var styleInvoice = $('.style-invoice').html();
        var popupWin = window.open('', '_blank', 'width=714,height=800');
        var printInvoice = '<html>';
            printInvoice += '<head>';
            printInvoice += '<title></title>';
            printInvoice += styleInvoice;
            printInvoice += '</head>';
            printInvoice += '<body>';
            printInvoice += strInvioce;
            printInvoice += '</body>';
            printInvoice += '</html>';
        popupWin.document.open();
        popupWin.document.write(printInvoice);
        popupWin.print();
    }

    function clearTable(){
        $(".table-row, .invoice-table-tbody").empty();
        $(".table-row, .invoice-table-tbody").append('<tr><td colspan="10" class="text-center">{{trans('lang.no_data_available_in_table')}}</td></tr>');
    }

    $(document).ready(function(){
        $('#ref_id, #item_id').select2({width:'100%',placeholder:'{{trans("lang.please_choose")}}',allowClear:true});

        var start_date = '{{$start_date}}';
        var end_date = '{{$end_date}}';

        if(start_date=='' || start_date==null){
            /*$('#start_date').val(moment().subtract('days', 29).format('YYYY-MM-DD'));*/
            start_date = moment().subtract('days', 29).format('MMMM D, YYYY');            
            /*var date  = Date.parse(jsonStartDate[0].start_date);
            start_date = date.toString('MMMM d, yyyy');*/
        }else{
            var date =  Date.parse(start_date);
            start_date = date.toString('MMMM d, yyyy');
        }

        if(end_date=='' || end_date==null){
            /*$('#end_date').val(moment().format('YYYY-MM-DD'));*/
            end_date = moment().format('MMMM D, YYYY');
            /*var date  = Date.parse(jsonEndDate[0].end_date);
            end_date = date.toString('MMMM d, yyyy');*/
        }else{
            var date  = Date.parse(end_date);
            end_date = date.toString('MMMM d, yyyy');
        }
        $('#report_date span').html(start_date + ' - ' + end_date);
        $('#report_date').show();
    });
</script>
@endsection()