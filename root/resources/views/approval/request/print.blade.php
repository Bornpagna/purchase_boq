<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>{{$title}}</title>
        <!-- CUSTOMIZE STYLE -->
        <style type="text/css">
            @media print{@page {size: portrait}}
            .paper {
                display: block;
                border: 0px solid #CCC;
                margin: 10px auto;
                padding: 0.1in 0 0 0.1in;
                page-break-after: always;
            }
            .portrait {
                size: portrait;
                width: 8.25in !important;
                height: 11.6in !important;
            }
            .landscape {
                size: landscape;
                width: 11.6in !important;
                height: 8.25in !important;
            }
            table {width: 100%;}
            th,td {font-size: 9px;}
            table td {border: #9e9e9e 1px solid;}
            table th {border: <?= getSetting()->report_header_color; ?>  1px solid;}
            table td,th {padding: 2px;}
            table thead th {
                background-color: <?= getSetting()->report_header_color; ?> !important;
                color: white !important;
            }
            .signature{
                height: 50px !important;
                background-color: white;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
            }
            .clear-LB {
                border-left: white 1px solid !important;
                border-bottom: white 1px solid !important;
            }
            .clear {display: block;padding-bottom: 10px !important;}
            .default-color {color: <?= getSetting()->report_header_color; ?> !important;}
            .default-background-color {background-color: <?= getSetting()->report_header_color; ?> !important;color: white !important;}
            .upper-text {text-transform: uppercase;}
            table {border-collapse: collapse;}
            .empty-box {background-color: #03a9f473 !important;}
            .white-space {
                padding: 3px !important;
                background-color: white !important;
                color: black !important;
                border-left: white 1px solid !important;
                border-right: white 1px solid !important;
                border-bottom: white 1px solid !important;
            }
            .center {text-align: center !important;}
            .left {text-align: left !important;}
            .right {text-align: right !important;}
            .col-3,.col-4,.col-6 {
                position: relative;
                min-height: 1px;
                float: left;
            }
            .col-12 {width: 100% !important;}
            .col-11 {width: 91.666666% !important;}
            .col-10 {width: 83.333333% !important;}
            .col-9 {width: 75% !important;}
            .col-8 {width: 66.666666% !important;}
            .col-7 {width: 58.333333% !important;}
            .col-6 {width: 50% !important;}
            .col-5 {width: 41.666666% !important;}
            .col-4 {width: 33.333333% !important;}
            .col-3 {width: 25% !important;}
            .col-2 {width: 16.666666% !important;}
            .col-1 {width: 8.333333% !important;}
            
            .row:after, .row:before {
                display: table;
                content: " ";
            }
            h3{text-align: center;line-height: 10px;}
            h4{text-align: center;line-height: 2px;}
            h5{text-align: center;line-height: 1px;font-weight: bold;}
            h6{text-align: left;line-height: 2px;}
            .row{display: flex;}
            .horizontal-line{
                margin-top: 2px;
                margin-bottom: 2px;
                border-top: 2px solid <?= getSetting()->report_header_color; ?>;
            }
            .report-header {}
            .report-info {}
            .report-body {margin-bottom: 5px;}
            .title {font-weight: bold;display: block;}
            .center {text-align: center;}
            .info-box{
                display: flex;
                padding: 1px;
                font-size: 12px;
                font-weight: bold;
            }
            .box {
                border: 1px solid #cecece;
                margin: 5px;
                border-radius: 5px;
                font-size: 10px;
            }
            .print-footer {
                position: fixed;
                bottom: 0;
                font-size: 8px !important;
                right: 0;
                color: grey !important;
                page-break-before: always;
            }
        </style>
    </head>
    <!-- CUSTOMIZE STYLE -->
    <body onload="onload();" class="paper portrait">
        <!-- Header -->
        <div class="report-header">
            <div class="col-12">
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-6">
                        <div class="left">
                            <img src="{{asset('assets/upload/temps/app_icon.png')}}" width="100" />
                        </div>
                    </div>
                    <!-- NAME -->
                    <div class="col-6">
                        <h3 class="default-color right">{{getSetting()->report_header}}</h3>
                        <h5 class="right">{{getSetting()->company_name}}</h5>
                        <h5 class="right">{{getSetting()->company_address}}</h5>
                        <h5 class="right">{{getSetting()->company_tel}}</h5>
                    </div>
                    
                </div>
            </div>
            <div class="col-12">
                <div class="horizontal-line"></div>
            </div>
        </div>
        <!-- Info -->
        <div class="report-info">
            <div class="col-12">
                <span class="title default-color upper-text center">{{$title}}</span>
            </div>
        </div>
        <div class="clear"></div>
        <div class="report-body">
            <!-- Order info -->
            <div class="row">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.date')}}</th>
                            <th style="width: 20%;" class="upper-text center">{{trans('lang.pr_number')}}</th>
                            <th style="width: 20%;" class="upper-text center">{{trans('lang.request_by')}}</th>
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.department')}}</th>
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.ship_date')}}</th>
                            <th style="width: 30%;" class="upper-text">{{trans('lang.note')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($request_obj)
                        <tr>
                            <td class="center">{{date('d/m/Y',strtotime($request_obj->trans_date))}}</td>
                            <td class="center">{{$request_obj->ref_no}}</td>
                            <td class="center">{{$request_obj->request_by_people}}</td>
                            <td class="center">{{$request_obj->department}}</td>
                            <td class="center">{{date('d/m/Y',strtotime($request_obj->delivery_date))}}</td>
                            <td>{{$request_obj->note}}</td>
                        </tr>
                        @else
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <span class="clear"></span>
            <!-- List items -->
            <div class="row">
                @if($requestItems_obj)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 2%;">{{trans('lang.no')}}</th>
                            <th style="width: 50%;">{{trans('lang.product_code_name')}}</th>
                            <th style="width: 8%;">{{trans('lang.size')}}</th>
                            <th style="width: 10%;">{{trans('lang.qty')}}</th>
                            <th style="width: 5%;">{{trans('lang.unit')}}</th>
                            <th style="width: 15%;">{{trans('lang.reason')}}</th>
                            <th style="width: 10%;">{{trans('lang.remark')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; ?>
                    @foreach($requestItems_obj as $row)
                        <?php $index++; ?>
                        <tr>
                            <td class="center">{{$index}}</td>
                            <!-- Item Code -->
                            <td>{{$row->item_name}} <strong>({{$row->item_code}})</strong></td>
                            <!-- Size -->
                            <td>{{$row->size}}</td>
                            <!-- Qty -->
                            <td class="right">{{$row->qty}}</td>
                            <!-- Unit -->
                            <td class="center">{{$row->unit_stock}}</td>
                            <!-- Reason -->
                            <td>{{$row->desc}}</td>
                            <!-- Remark -->
                            <td>{{$row->remark}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <!-- Signature -->
            <div class="clear"></div>
            <div class="col-12">
                <div class="row">
                    <!-- Request By -->
                    @if($request_obj)
                    <div class="col-3">
                        <div style="display: grid;font-size: 10px;">
                            <span class="center">{{trans('lang.prepared_by')}}</span>
                            <div class="clear"></div>
                            @if(isset($request_obj->signature))
                            <div class="center">
                            <div class="signature" style="background-image:url({{asset('assets/upload/picture/signature')}}/{{$request_obj->signature}});"></div>
                            </div>
                            @else
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            @endif
                            <span class="center">{{$request_obj->position}}  <strong>{{$request_obj->user_request}}</strong></span>
                            <span class="center">{{trans('lang.date')}} : {{date('d/m/Y',strtotime($request_obj->trans_date))}}</span>
                        </div>
                    </div>
                    @endif
                    @if($request_approve)
                        @foreach($request_approve as $approveMan)
                        <!-- Engineer -->
                        <div class="col-3">
                            <div style="display: grid;font-size: 10px;">
                                <span class="center">{{trans('lang.approved_by')}}</span>
                                <div class="clear"></div>
                                @if(isset($approveMan->signature))
                                <div class="center">
                                    <div class="signature" style="background-image:url({{asset('assets/upload/picture/signature')}}/{{$approveMan->signature}});"></div>
                                </div>
                                @else
                                <div class="clear"></div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                                @endif
                                <span class="center">{{$approveMan->position}}  <strong>{{$approveMan->approved_people}}</strong></span>
                                <span class="center">{{trans('lang.date')}} : {{date('d/m/Y',strtotime($approveMan->approved_date))}}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="print-footer">
            <label>{{trans('lang.document_num')}} : {{$request_obj->ref_no}} | {{trans('lang.page')}} : 1</label>
        </div>
    </body>
    <script>
        onload = function(){
            window.print();
        }
    </script>
</html>