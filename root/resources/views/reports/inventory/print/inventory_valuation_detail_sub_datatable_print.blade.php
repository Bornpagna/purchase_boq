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
        </style>
    </head>
    <!-- CUSTOMIZE STYLE -->
    <body class="paper portrait">
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
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.warehouse')}}</th>
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.category')}}</th>
                            <th style="width: 25%;" class="upper-text center">{{trans('lang.item_code')}}</th>
                            <th style="width: 30%;" class="upper-text center">{{trans('lang.item_name')}}</th>
                            <th style="width: 15%;" class="upper-text">{{trans('lang.type')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- Date -->
                            @if($endDate)
                            <td class="center">{{date('d/m/Y',strtotime($endDate))}}</td>
                            @else
                            <td class="center"></td>
                            @endif
                            <!-- Warehouse -->
                            @if($warehouse)
                            <td class="center">{{$warehouse->name}}</td>
                            @else
                            <td class="center"></td>
                            @endif
                            <!-- Item Type -->
                            @if($itemType)
                            <td class="center">{{$itemType->name}}</td>
                            @else
                            <td class="center"></td>
                            @endif
                            <!-- Item -->
                            @if($item)
                            <td class="center">{{$item->code}}</td>
                            <td class="center">{{$item->name}}</td>
                            @else
                            <td class="center"></td>
                            <td class="center"></td>
                            @endif
                            <!-- Stock Type -->
                            @if($stockType)
                            <td class="center">{{$stockType}}</td>
                            @else
                            <td class="center"></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            <span class="clear"></span>
            <!-- List items -->
            <div class="row">
                @if($report)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 3%;">{{trans('lang.no')}}</th>
                            <th style="width: 9%;">{{trans('lang.type')}}</th>
                            <th style="width: 8%;">{{trans('lang.date')}}</th>
                            <th style="width: 14%;">{{trans('lang.name')}}</th>
                            <th style="width: 8%;">{{trans('lang.num')}}</th>
                            <th style="width: 8%;">{{trans('lang.qty')}}</th>
                            <th style="width: 10%;">{{trans('lang.cost')}}</th>
                            <th style="width: 10%;">{{trans('lang.on_hand')}}</th>
                            <th style="width: 10%;">{{trans('lang.unit')}}</th>
                            <th style="width: 10%;">{{trans('lang.avg_cost')}}</th>
                            <th style="width: 10%;">{{trans('lang.asset_value')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; $onHand = 0;?>
                    @foreach($report as $i => $row)
                        <?php $index++; ?>
                        <tr>
                            <td class="center">{{$index}}</td>
                            <!-- Type -->
                            <td>{{$row->ref_type}}</td>
                            <!-- Date -->
                            <td>{{date('d/m/Y',strtotime($row->trans_date))}}</td>
                            <!-- Name -->
                            <td>{{$row->ref_no}}</td>
                            <!-- Num -->
                            <td>{{$row->id}}</td>

                            <?php 
                                $factor = $row->factor;
                                $amount = $row->amount;
                                $qty    = $row->qty;
                                $cost   = $row->cost;
            
                                if($factor < 1){
                                    $qty = $qty / $factor;
                                }else{
                                    $qty = $qty * $factor;
                                }
            
                                $cost = $cost / $factor;
                            ?>

                            <!-- Qty -->
                            <td class="right">{{formatQty($qty)}}</td>
                            <!-- Cost -->
                            <td class="right">{{formatDollars($cost)}}</td>
                            <!-- On Hand -->
                            @if($i == 0)
                                <?php $onHand = 0 + (float)$qty;?>
                            @else
                                <?php $onHand = $onHand + (float)$qty;?>
                            @endif
                            <td class="right">{{formatQty($onHand)}}</td>
                            <!-- Unit -->
                            <td class="right">{{$row->to_desc}}</td>
                            <!-- Avg Cost -->
                            <td class="right">{{formatDollars($cost)}}</td>
                            <!-- Asset Value -->
                            <td class="right">{{formatDollars($amount)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </body>
</html>