<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <?php 
        use App\Model\SystemData;
        use App\Model\Warehouse;
        use App\Model\Constructor;
        use App\Model\Item;
        use App\Model\House;
        use App\Model\Usage;
        use App\Model\Unit;
    ?>
    <head>
        <title>{{$title}}</title>
        <!-- CUSTOMIZE STYLE -->
        <style type="text/css">
            @media print{@page {size: landscape}}
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
    <body class="paper landscape">
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
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.trans_date')}}</th>
                            @if($zone)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.zone')}}</th>
                            @endif
                            @if($block)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.block')}}</th>
                            @endif
                            @if($street)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.street')}}</th>
                            @endif
                            @if($houseType)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.house_type')}}</th>
                            @endif
                            @if($house)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.house')}}</th>
                            @endif
                            @if($itemType)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.item_type')}}</th>
                            @endif
                            @if($item)
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.item_code')}}</th>
                            <th style="width: 10%;" class="upper-text center">{{trans('lang.item_name')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 10%;" class="upper-text center">{{date('d/m/Y',strtotime($startDate))}} - {{date('d/m/Y',strtotime($endDate))}}</td>
                            @if($zone)
                            <td style="width: 10%;" class="upper-text center">{{$zone->name}}</td>
                            @endif
                            @if($block)
                            <td style="width: 10%;" class="upper-text center">{{$block->name}}</td>
                            @endif
                            @if($street)
                            <td style="width: 10%;" class="upper-text center">{{$street->name}}</td>
                            @endif
                            @if($houseType)
                            <td style="width: 10%;" class="upper-text center">{{$houseType->name}}</td>
                            @endif
                            @if($house)
                            <td style="width: 10%;" class="upper-text center">{{$house->house_no}}</td>
                            @endif
                            @if($itemType)
                            <td style="width: 10%;" class="upper-text center">{{$itemType->name}}</td>
                            @endif
                            @if($item)
                            <td style="width: 10%;" class="upper-text center">{{$item->code}}</td>
                            <td style="width: 10%;" class="upper-text center">{{$item->name}}</td>
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
                            <th>{{trans('lang.no')}}</th>
                            <th>{{trans('lang.date')}}</th>
                            <th>{{trans('lang.warehouse')}}</th>
                            <th>{{trans('lang.engineer')}}</th>
                            <th>{{trans('lang.subcontractor')}}</th>
                            <th>{{trans('lang.name')}}</th>
                            <th>{{trans('lang.num')}}</th>
                            <th>{{trans('lang.qty')}}</th>
                            <th>{{trans('lang.unit')}}</th>
                            <th>{{trans('lang.cost')}}</th>
                            <th>{{trans('lang.asset_value')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0;?>
                    @foreach($report as $i => $row)
                        <?php $index++; ?>
                        <tr>
                            <td class="center">{{$index}}</td>
                            <td class="center">{{date('d/m/Y',strtotime($row->trans_date))}}</td>
                            <!-- WAREHOUSE -->
                            @if($ware = Warehouse::find($row->warehouse_id))
                            <td class="center">{{$ware->name}}</td>
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- ENGINEER -->
                            @if($USAGE = Usage::find($row->use_id))
                                @if($ENG = Constructor::find($USAGE->eng_usage))
                                <td class="center">{{$ENG->id_card}}</td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- SUBCONTRACTOR -->
                            @if($USAGE = Usage::find($row->use_id))
                                @if($SUB = Constructor::find($USAGE->sub_usage))
                                <td class="center">{{$SUB->id_card}}</td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- NAME -->
                            <td class="center">{{$row->ref_no}}</td>
                            <!-- NUM -->
                            <td class="center">{{$row->id}}</td>
                            <!-- QTY -->
                            <!-- UNIT -->
                            <!-- COST -->
                            @if($unit = Unit::where(['from_code' => $row->unit,'to_code' => $row->unit_usage])->first())
                                @if($unit->factor < 1)
                                <td class="right">{{formatQty($row->qty / $unit->factor)}}</td>
                                @else
                                <td class="right">{{formatQty($row->qty * $unit->factor)}}</td>
                                @endif
                            <td class="center">{{$unit->to_desc}}</td>
                            <td class="right">{{formatDollars($row->cost / $unit->factor)}}</td>
                            @else
                            <td class="right">{{formatQty($row->qty)}}</td>
                            <td class="center">{{$row->unit}}</td>
                            <td class="right">{{formatDollars($row->cost)}}</td>
                            @endif
                            <!-- ASSET VALUE -->
                            <td class="right">{{formatDollars($row->amount)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </body>
    <script>
        function onPrint() {
            window.print();
        }
    </script>
</html>