<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <?php 
        use App\Model\SystemData;
        use App\Model\Warehouse;
        use App\Model\Unit;
        use App\Model\Item;
        use App\Model\House;
        use App\Model\Constructor;
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
            <!-- List items -->
            <div class="row">
                @if($report)
                <table>
                    <thead>
                        <tr>
                            <th>{{trans('lang.no')}}</th>
                            <th>{{trans('lang.date')}}</th>
                            <th>{{trans('lang.reference_no')}}</th>
                            <th>{{trans('lang.warehouse')}}</th>
                            <th>{{trans('lang.engineer_code')}}</th>
                            <th>{{trans('lang.engineer_name')}}</th>
                            <th>{{trans('lang.subcontractor_code')}}</th>
                            <th>{{trans('lang.subcontractor_name')}}</th>
                            @if(getSetting()->allow_zone == 1)
                            <th>{{trans('lang.zone')}}</th>
                            @endif
                            @if(getSetting()->allow_block == 1)
                            <th>{{trans('lang.block')}}</th>
                            @endif
                            <th>{{trans('lang.street')}}</th>
                            <th>{{trans('lang.house_type')}}</th>
                            <th>{{trans('lang.house')}}</th>
                            <th>{{trans('lang.item_type')}}</th>
                            <th>{{trans('lang.item_code')}}</th>
                            <th>{{trans('lang.item_name')}}</th>
                            <th>{{trans('lang.qty')}}</th>
                            <th>{{trans('lang.unit')}}</th>
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
                            <td class="center">{{$row->ref_no}}</td>
                            <!-- Warehouse -->
                            @if($warehouse = Warehouse::find($row->warehouse_id))
                            <td class="center">{{$warehouse->name}}</td>
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- Engineer -->
                            @if($engineer = Constructor::find($row->eng_usage))
                            <td class="center">{{$engineer->name}}</td>
                            <td class="center">{{$engineer->id_card}}</td>
                            @else
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            @endif
                            <!-- Subcontractor -->
                            @if($subcontractor = Constructor::find($row->sub_usage))
                            <td class="center">{{$subcontractor->name}}</td>
                            <td class="center">{{$subcontractor->id_card}}</td>
                            @else
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            @endif
                            
                            <!-- Street -->
                            @if($street = SystemData::find($row->street_id))
                            <td class="center">{{$street->name}}</td>
                            @else
                            <td class="empty-box"></td>
                            @endif
    
                            <!-- House -->
                            @if($house = House::find($row->house_id))
                                <!-- House -->
                                <td class="center">{{$house->house_no}}</td>
                                <!-- House Type -->
                                @if($houseType = SystemData::find($house->house_type))
                                <td class="center">{{$houseType->name}}</td>
                                @endif
                                <!-- Zone -->
                                @if(getSetting()->allow_zone == 1 && $zone = SystemData::find($house->zone_id))
                                <td class="center">{{$zone->name}}</td>
                                @endif
                                <!-- Block -->
                                @if(getSetting()->allow_block == 1 && $block = SystemData::find($house->block_id))
                                <td class="center">{{$block->name}}</td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            @endif
                            
                            @if($item = Item::find($row->item_id))
                                <!-- Item Type -->
                                @if($itemType = SystemData::find($item->cat_id))
                                <td class="center">{{$itemType->name}}</td>
                                @endif
                            <!-- Item Code -->
                            <td class="center">{{$item->code}}</td>
                            <!-- Item Name -->
                            <td class="center">{{$item->name}}</td>
                            @else
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            @endif
                            
                            @if($unit = Unit::where(['from_code' => $row->unit,'to_code' => $row->unit_usage])->first())
                                <!-- Qty -->
                                @if($unit->factor < 1)
                                <td class="center">{{$row->qty / $unit->factor}}</td>
                                @else
                                <td class="center">{{$row->qty * $unit->factor}}</td>
                                @endif

                            <!-- Unit -->
                            <td class="center">{{$unit->to_desc}}</td>
                            @else
                            <td class="center">{{$row->qty}}</td>
                            <td class="center">{{$row->unit}}</td>
                            @endif

                            <!-- Asset Value -->
                            <td class="center">{{formatDollars($row->amount)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </body>
</html>