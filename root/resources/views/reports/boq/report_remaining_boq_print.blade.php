<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <?php 
        use App\Model\Constructor;
        use App\Model\House;
        use App\Model\Item;
        use App\Model\BoqItem;
        use App\Model\SystemData;
        use App\Model\Warehouse;
        use App\Model\Project;
        use App\Model\UsageDetails;
        $page = 0;
        $perPages = [30,65,100];
        for ($i=3; $i < 100; $i++) { 
            array_push($perPages,$perPages[count($perPages) - 1] + 35);
        }
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
            table th {border: <?= $setting->report_header_color; ?>  1px solid;}
            table td,th {margin: 5px;}
            table thead th {
                background-color: <?= $setting->report_header_color; ?> !important;
                color: white !important;
            }
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
                border-top: 2px solid <?= $setting->report_header_color; ?>;
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
                <span class="title center">{{$title}}</span>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="box">
                            <ul>
                                <li>{{trans('lang.date')}} : {{date('d/m/Y',strtotime($request['end_date']))}}</li>
                                <?php 

                                    if(isset($request['zone'])){
                                        $zone = SystemData::find($request['zone']);
                                    }

                                    if(isset($request['block'])){
                                        $block = SystemData::find($request['block']);
                                    }

                                    if(isset($request['street'])){
                                        $street = SystemData::find($request['street']);
                                    }

                                    if(isset($request['house_type'])){
                                        $houseType = SystemData::find($request['house_type']);
                                    }

                                    if(isset($request['house'])){
                                        $house = House::find($request['house']);
                                    }

                                    if(isset($request['product_type'])){
                                        $category = SystemData::find($request['product_type']);
                                    }

                                    if(isset($request['product'])){
                                        $product = Item::find($request['product']);
                                    }
                                ?>
                                <li>{{trans('lang.zone')}} : {{!empty($zone) ? $zone->name : '......................'}}</li>
                                <li>{{trans('lang.block')}} : {{!empty($block) ? $block->name : '......................'}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <ul>
                                <li>{{trans('lang.street')}} : {{!empty($street) ? $street->name : '......................'}}</li>
                                <li>{{trans('lang.house_type')}} : {{!empty($houseType) ? $houseType->name : '......................'}}</li>
                                <li>{{trans('lang.house')}} : {{!empty($house) ? $house->house_no : '......................'}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            <ul>
                                <li>{{trans('lang.category')}} : {{!empty($category) ? $category->name : '......................'}}</li>
                                <li>{{trans('lang.product')}} : {{!empty($product) ? $product->code . ' (' . $product->name . ')' : '......................'}}</li>
                                <li>{{trans('lang.other')}} : ......................</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="report-body">
            <div class="row">
                @if($report)
                <table>
                    <thead>
                        <tr>
                            <th>{{trans('lang.no')}}</th>
                            @if($setting->allow_zone == 1)
                            <th>{{trans('lang.zone')}}</th>
                            @endif

                            @if($setting->allow_block == 1)
                            <th>{{trans('lang.block')}}</th>
                            @endif
                            <th>{{trans('lang.street')}}</th>
                            <th>{{trans('lang.house_type')}}</th>
                            <th>{{trans('lang.house')}}</th>
                            <th>{{trans('lang.item_type')}}</th>
                            <th>{{trans('lang.item_code')}}</th>
                            <th>{{trans('lang.item_name')}}</th>
                            <th>{{trans('lang.boq_std')}}</th>
                            <th>{{trans('lang.boq_add')}}</th>
                            <th>{{trans('lang.boq_unit')}}</th>
                            <th>{{trans('lang.usage_qty')}}</th>
                            <th>{{trans('lang.usage_unit')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0; ?>
                    @foreach($report as $row)
                        <?php $index++; ?>
                        <tr>
                            <td class="center">{{$index}}</td>
                            <!-- Zone -->
                            @if($setting->allow_zone == 1)
                                @if($house = House::find($row->house_id))
                                    @if($zone = SystemData::find($house->zone_id))
                                    <td>{{$zone->name}}</td>
                                    @else
                                    <td class="empty-box"></td>
                                    @endif
                                @else
                                <td class="empty-box"></td>
                                @endif
                            @endif
                            <!-- Block -->
                            @if($setting->allow_block == 1)
                                @if($house = House::find($row->house_id))
                                    @if($block = SystemData::find($house->block_id))
                                    <td>{{$block->name}}</td>
                                    @else
                                    <td class="empty-box"></td>
                                    @endif
                                @else
                                <td class="empty-box"></td>
                                @endif
                            @endif
                            <!-- Street -->
                            @if($house = House::find($row->house_id))
                                @if($street = SystemData::find($house->street_id))
                                <td>{{$street->name}}</td>
                                @else
                                <td class="empty-box"></td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- House Type -->
                            @if($house = House::find($row->house_id))
                                @if($houseType = SystemData::find($house->house_type))
                                <td>{{$houseType->name}}</td>
                                @else
                                <td class="empty-box"></td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- House -->
                            @if($house = House::find($row->house_id))
                            <td>{{$house->house_no}}</td>
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- Item Type -->
                            @if($item = Item::find($row->item_id))
                                @if($itemType = SystemData::find($item->cat_id))
                                <td>{{$itemType->name}}</td>
                                @else
                                <td class="empty-box"></td>
                                @endif
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <!-- Item -->
                            @if($item = Item::find($row->item_id))
                            <td>{{$item->code}}</td>
                            <td>{{$item->name}}</td>
                            @else
                            <td class="empty-box"></td>
                            <td class="empty-box"></td>
                            @endif
                            <td class="right">{{$row->qty_std}}</td>
                            <td class="right">{{$row->qty_add}}</td>
                            <td class="center">{{$row->unit}}</td>
                            <!-- Usage Details -->
                            <?php
                                $usageDetail = UsageDetails::select([DB::raw("SUM(qty) as qty")]);
                                $endDate = $request['end_date'];
                                if($endDate){
                                    $usageDetail = $usageDetail->leftJoin('usages','usages.id','usage_details.use_id')->where('usages.trans_date','<=',$endDate);
                                }
            
                                $usageDetail = $usageDetail->where([
                                    'usage_details.house_id' => $row->house_id,
                                    'usage_details.item_id'  => $row->item_id,
                                    'usage_details.delete'	 => 0
                                    ])->groupBy(['usage_details.house_id','usage_details.item_id'])->get();
                                $qty = 0;
                                if($usageDetail){
                                    foreach($usageDetail as $detail){
                                        $qty += (float)$detail->qty;
                                    }
                                }
                            ?>
                            @if($qty > 0)
                            <td class="right">{{$qty}}</td>
                            @else
                            <td class="empty-box"></td>
                            @endif
                            <?php 
                                $usageDetail = UsageDetails::select(['*']);
                                $endDate = $request['end_date'];
                                if($endDate){
                                    $usageDetail = $usageDetail->leftJoin('usages','usages.id','usage_details.use_id')->where('usages.trans_date','<=',$endDate);
                                }
            
                                $usageDetail = $usageDetail->where([
                                    'usage_details.house_id' => $row->house_id,
                                    'usage_details.item_id'  => $row->item_id,
                                    'usage_details.delete'	 => 0
                                    ])->first();
                            ?>
                            @if($usageDetail)
                            <td class="center">{{$usageDetail->unit}}</td> 
                            @else
                            <td class="empty-box"></td>
                            @endif
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        
    </body>
    <!-- SCRIPT CONTENT -->
    <script type="text/javascript">
        $(document).ready(function(){
            // window.print();
        });
    </script>
    <!-- SCRIPT CONTENT -->
</html>