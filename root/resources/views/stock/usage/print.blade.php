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
    <?php 
        use App\Model\Item;
        use App\Model\Warehouse;
        use App\Model\House;
        use App\Model\SystemData;
    ?>
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
                <span class="title default-color upper-text right">{{$title}}</span>
            </div>
            <div class="clear"></div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div style="display: grid;">
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color upper-text">{{trans('lang.date')}}:</span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left upper-text">{{date('d/m/Y',strtotime($usage->trans_date))}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color upper-text">{{trans('lang.reference_no')}}# </span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left upper-text">{{$usage->ref_no}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color">{{trans('lang.created_by')}}:</span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$createdBy->name}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color">{{trans('lang.print_date')}}:</span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{date('d/m/Y')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="display: grid;">
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color">{{trans('lang.engineer')}}:</span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$engineer->id_card}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color"></span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$engineer->name}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color"></span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$engineer->tel}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div style="display: grid;">
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color">{{trans('lang.subcontractor')}}:</span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$subcontractor->id_card}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color"></span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$subcontractor->name}}</span>
                            </div>
                            <div style="display: flex;width: 200px !important;">
                                <span style="width: 40% !important;font-size: 10px !important;font-weight: bold;" class="left default-color"></span>
                                <span style="width: 60% !important;font-size: 10px !important;font-weight: bold;" class="left">{{$subcontractor->tel}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="report-body">
            <span class="clear"></span>
            <!-- List items -->
            <div class="row">
                @if($usageItems)
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">{{trans('lang.no')}}</th>
                            <th style="width: 10%;">{{trans('lang.warehouse')}}</th>
                            <th style="width: 10%;">{{trans('lang.house_type')}}</th>
                            <th style="width: 10%;">{{trans('lang.house')}}</th>
                            <th style="width: 20%;">{{trans('lang.item_code')}}</th>
                            <th style="width: 29%;">{{trans('lang.item_name')}}</th>
                            <th style="width: 8%;">{{trans('lang.qty')}}</th>
                            <th style="width: 8%;">{{trans('lang.unit')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; ?>
                    @foreach($usageItems as $row)
                        <?php $index++; ?>
                        <tr>
                            <td class="center">{{$index}}</td>
                            <!-- Warehouse -->
                            @if($warehouse = Warehouse::find($row->warehouse_id))
                            <td>{{$warehouse->name}}</td>
                            @else
                            <td></td>
                            @endif
                            <!-- House Type & House -->
                            @if($house = House::find($row->house_id))
                                @if($houseType = SystemData::find($house->house_type))
                                <td>{{$houseType->name}}</td>
                                @else
                                <td></td>
                                @endif
                            <td>{{$house->house_no}}</td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            <!-- Item -->
                            @if($item = Item::find($row->item_id))
                            <td>{{$item->code}}</td>
                            <td>{{$item->name}}</td>
                            @else
                            <td></td>
                            <td></td>
                            @endif
                            <td class="right">{{$row->qty}}</td>
                            <td class="center">{{$row->unit}}</td>
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
                    <!-- Stock Control -->
                    <div class="col-4">
                        <div style="display: grid;font-size: 10px;">
                            <span class="left">{{trans('lang.warehouse_control')}}</span>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <span class="left">{{trans('lang.name')}}  <strong>{{$createdBy->name}}</strong></span>
                            <span class="left">{{trans('lang.date')}} : {{date('......../......../Y')}}</span>
                        </div>
                    </div>
                    <!-- Engineer -->
                    <div class="col-4">
                        <div style="display: grid;font-size: 10px;">
                            <span class="left">{{trans('lang.engineer')}}</span>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <span class="left">{{trans('lang.name')}}  <strong>{{$engineer->id_card}}</strong></span>
                            <span class="left">{{trans('lang.date')}} : {{date('......../......../Y')}}</span>
                        </div>
                    </div>
                    <!-- Subcontractor -->
                    <div class="col-4">
                        <div style="display: grid;font-size: 10px;">
                            <span class="left">{{trans('lang.subcontractor')}}</span>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                            <span class="left">{{trans('lang.name')}}  <strong>{{$subcontractor->id_card}}</strong></span>
                            <span class="left">{{trans('lang.date')}} : {{date('......../......../Y')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>