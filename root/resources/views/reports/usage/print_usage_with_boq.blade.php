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
            /* @media print{@page {size: portrait}} */
            .paper {
                display: block;
                border: 1px solid #CCC;
                margin: 10px auto;
                padding: 0.1in 0 0 0.1in;
                page-break-after: always;
            }
            .paper > .portrait {
                width: 8.25in !important;
                height: 11.6in !important;
            }
            .paper > .landscape {
                width: 11.6in !important;
                height: 8.25in !important;
            }
            table {width: 100%;}
            th,td {font-size: 9px;}
            table th,td {border: #9e9e9e 1px solid;}
            table td,th {margin: 5px;}
            table thead th {background-color: <?= $setting->report_header_color; ?> !important;color: white !important;}
            table {border-collapse: collapse;}
            .empty-box {background-color: #03a9f473 !important;}
            .white-space {padding: 3px !important;background-color: white !important;color: black !important;border-left: white 1px solid !important;border-right: white 1px solid !important;border-bottom: white 1px solid !important;}
            .center {text-align: center !important;}
            .left {text-align: left !important;}
            .right {text-align: right !important;}
            .col-3,.col-4,.col-6 {
                position: relative;
                min-height: 1px;
                padding-left: 15px;
                padding-right: 15px;
                float: left;
            }
            .col-12 {width: 100% !important;}
            .col-3 {width: 30% !important;}
            .col-6 {width: 35% !important;}
            .row:after, .row:before {
                display: table;
                content: " ";
            }
            h3{text-align: center;line-height: 10px;}
            h4{text-align: center;line-height: 2px;}
            h5{text-align: center;line-height: 1px;font-weight: bold;}
            h6{text-align: left;line-height: 2px;}
            .row{margin-left: -15px;margin-right: -15px;}
        </style>
    </head>
    <!-- CUSTOMIZE STYLE -->
    <body class="paper landscape">
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
        @if($report)
        <table>
            <thead>
                <tr>
                    <th>{{trans('lang.no')}}</th>
                    <th>{{trans('lang.date')}}</th>
                    <th>{{trans('lang.reference_no')}}</th>
                    <th colspan="2">{{trans('lang.engineer')}}</th>
                    <th colspan="2">{{trans('lang.subcontractor')}}</th>
                    <th>{{trans('lang.warehouse')}}</th>

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
                    <th>{{trans('lang.qty')}}</th>
                    <th>{{trans('lang.unit')}}</th>
                    <th>{{trans('lang.price')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($report as $index => $row)
            <?php $clospan = 18; ?>
            <tr>
                <td class="center">{{$index + 1}}</td>
                <td>{{date('d/m/Y',strtotime($row->trans_date))}}</td>
                <td>{{$row->ref_no}}</td>
                <!-- Engineer -->
                @if($engineer = Constructor::find($row->eng_usage))
                <td>{{$engineer->id_card}}</td>
                <td>{{$engineer->name}}</td>
                @else
                <td class="empty-box"></td>
                <td class="empty-box"></td>
                @endif
                <!-- Subcontractor -->
                @if($contractor = Constructor::find($row->sub_usage))
                <td>{{$contractor->id_card}}</td>
                <td>{{$contractor->name}}</td>
                @else
                <td class="empty-box"></td>
                <td class="empty-box"></td>
                @endif
                <!-- Warehouse -->
                @if($warehouse = Warehouse::find($row->warehouse_id))
                <td>{{$warehouse->name}}</td>
                @else
                <td class="empty-box"></td>
                @endif
                
                <!-- House -->
                @if($house = House::find($row->house_id))
                    <!-- Zone -->
                    @if($setting->allow_zone == 1)
                        <?php $clospan++;?>
                        @if($zone = SystemData::find($house->zone_id))
                        <td>{{$zone->name}}</td>
                        @else
                        <td class="empty-box"></td>
                        @endif
                    @endif
                    <!-- Block -->
                    @if($setting->allow_block == 1)
                        <?php $clospan++;?>
                        @if($block = SystemData::find($house->block_id))
                        <td>{{$block->name}}</td>
                        @else
                        <td class="empty-box"></td>
                        @endif
                    @endif

                    <!-- Street -->
                    @if($street = SystemData::find($house->street_id))
                    <td>{{$street->name}}</td>
                    @else
                    <td class="empty-box"></td>
                    @endif

                    <!-- House Type -->
                    @if($houseType = SystemData::find($house->house_type))
                    <td>{{$houseType->name}}</td>
                    @else
                    <td class="empty-box"></td>
                    @endif

                    <td>{{$house->house_no}}</td>
                @else
                <!-- Zone -->
                <td class="empty-box"></td>
                <!-- Block -->
                <td class="empty-box"></td>
                <!-- Street -->
                <td class="empty-box"></td>
                <!-- House Type -->
                <td class="empty-box"></td>
                @endif

                <!-- Item -->
                @if($item = Item::find($row->item_id))
                    <!-- Item Type -->
                    @if($itemType = SystemData::find($item->cat_id))
                    <td>{{$itemType->name}}</td>
                    @else
                    <td class="empty-box"></td>
                    @endif

                    <!-- Item Code -->
                    <td>{{$item->code}}</td>
                    <!-- Item Name -->
                    <td>{{$item->name}}</td>
                @else
                <!-- Item Type -->
                <td class="empty-box"></td>
                <!-- Item Code -->
                <td class="empty-box"></td>
                <!-- Item Name -->
                <td class="empty-box"></td>
                @endif

                <!-- Boq Item -->
                @if($boqItem = BoqItem::where(['house_id' => $row->house_id, 'item_id' => $row->item_id])->first())
                <td class="right">{{$boqItem->qty_std}}</td>
                <td class="right">{{$boqItem->qty_add}}</td>
                <td class="center">{{$boqItem->unit}}</td>
                @else
                <td class="empty-box"></td>
                <td class="empty-box"></td>
                <td class="empty-box"></td>
                @endif

                <td class="right">{{$row->qty}}</td>
                <td class="center">{{$row->unit}}</td>
                <td class="right">{{$item->cost_purch}}</td>
            </tr>
            @if(in_array(($index + 1), $perPages))
                <tr>
                    <?php $page++; ?>
                    <td colspan="{{($clospan / 2) + 2}}" class="white-space">{{$title}} | {{trans('lang.print_date')}} : {{date('Y/m/d H:i:s')}} | {{trans('lang.print_by')}} : {{Auth::user()->name}}</td>
                    <td colspan="{{($clospan / 2) + 2}}" class="white-space right">{{trans('lang.page')}} : {{$page}}</td>
                </tr>
            @endif
            @endforeach 
                <tr>
                    <?php $page++; ?>
                    <td colspan="{{($clospan / 2) + 2}}" class="white-space">{{$title}} | {{trans('lang.print_date')}} : {{date('Y/m/d H:i:s')}} | {{trans('lang.print_by')}} : {{Auth::user()->name}}</td>
                    <td colspan="{{($clospan / 2) + 2}}" class="white-space right">{{trans('lang.page')}} : {{$page}}</td>
                </tr>
            </tbody>
        </table>
            
        @endif
        
    </body>
    <!-- SCRIPT CONTENT -->
    <script type="text/javascript">
        $(document).ready(function(){
            window.print();
        });
    </script>
    <!-- SCRIPT CONTENT -->
</html>