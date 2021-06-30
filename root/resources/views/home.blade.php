@extends('layouts.app')

@section('content')
    <div class="row">
		@if(($request) && (hasRole('dash-request')))
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<div class="number">
							<h3 class="font-green-sharp">
								<span data-counter="counterup" data-value="{{formatQty($request->request_item_qty)}}">0</span>
								<small class="font-green-sharp"></small>
							</h3>
							<small>TOTAL ITEMS REQUEST</small>
						</div>
						<div class="icon">
							<i class="fa fa-registered"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: {{$request->order_item_percentage}}%;" class="progress-bar progress-bar-success green-sharp">
								<span class="sr-only">{{$request->order_item_percentage}}% total items ordered</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title"> total items ordered </div>
							<div class="status-number"> {{$request->order_item_percentage}}% </div>
						</div>
					</div>
				</div>
			</div>
		@endif

		@if(($order) && (hasRole('dash-order')))
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<div class="number">
							<h3 class="font-red-haze">
								<span data-counter="counterup" data-value="{{formatQty($order->total_order)}}">0</span>
								<small class="font-red-sharp">$</small>
							</h3>
							<small>TOTAL ORDERS</small>
						</div>
						<div class="icon">
							<i class="icon-basket"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: {{$order->delivery_items_percentage}}%;" class="progress-bar progress-bar-success red-haze">
								<span class="sr-only">{{$order->delivery_items_percentage}}% total items delivery </span>
							</span>
						</div>
						<div class="status">
							<div class="status-title"> total items delivery </div>
							<div class="status-number"> {{$order->delivery_items_percentage}}% </div>
						</div>
					</div>
				</div>
			</div>
		@endif

		@if(($delivery) && (hasRole('dash-delivery')))
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<div class="number">
							<h3 class="font-blue-sharp">
								<span data-counter="counterup" data-value="{{formatQty($delivery->delivery_items_qty)}}"></span>
							</h3>
							<small>TOTAL ITEMS DELIVERY</small>
						</div>
						<div class="icon">
							<i class="fa fa-truck"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: {{$delivery->return_items_percentage}}%;" class="progress-bar progress-bar-success blue-sharp">
								<span class="sr-only">{{$delivery->return_items_percentage}}% total items return delivery</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title"> total items return delivery </div>
							<div class="status-number"> {{$delivery->return_items_percentage}}% </div>
						</div>
					</div>
				</div>
			</div>
		@endif

		@if(($usage) && (hasRole('dash-usage')))
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<div class="number">
							<h3 class="font-purple-soft">
								<span data-counter="counterup" data-value="{{formatQty($usage->usage_items_qty)}}"></span>
							</h3>
							<small>TOTAL ITEMS USAGE</small>
						</div>
						<div class="icon">
							<i class="fa fa-legal"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: {{$usage->return_usage_items_percentage}}%;" class="progress-bar progress-bar-success purple-soft">
								<span class="sr-only">56% total items return usage</span>
							</span>
						</div>
						<div class="status">
							<div class="status-title"> total items return usage </div>
							<div class="status-number"> {{$usage->return_usage_items_percentage}}% </div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	<div class="row">
        @if(hasRole('dash-chart-request-item'))
    		<div class="col-md-6 col-sm-6">
    			<div class="portlet light ">
    				<div class="portlet-title">
    					<div class="caption">
    						<span class="caption-subject bold uppercase font-dark">Purchase Requests</span>
    						<span class="caption-helper">Monthly request current year...</span>
    					</div>
    					<div class="actions"></div>
    				</div>
    				<div class="portlet-body">
    					<div id="my_dashboard_amchart_1" class="CSSAnimationChart"></div>
    				</div>
    			</div>
    		</div>
        @endif
        @if(hasRole('dash-chart-order-item'))
    		<div class="col-md-6 col-sm-6">
    			<div class="portlet light ">
    				<div class="portlet-title">
    					<div class="caption">
    						<span class="caption-subject bold uppercase font-dark">Purchase Orders</span>
    						<span class="caption-helper">Monthly request current year...</span>
    					</div>
    					<div class="actions"></div>
    				</div>
    				<div class="portlet-body">
    					<div id="my_dashboard_amchart_2" class="CSSAnimationChart"></div>
    				</div>
    			</div>
    		</div>
        @endif
	</div>
	<div class="row">
		@if(hasRole('dash-chart-order-price'))
            <div class="col-md-6 col-sm-6">
    			<div class="portlet light ">
    				<div class="portlet-title">
    					<div class="caption ">
    						<span class="caption-subject font-dark bold uppercase">Purchase Orders</span>
    						<span class="caption-helper">Monthly request current year...</span>
    					</div>
    					<div class="actions"></div>
    				</div>
    				<div class="portlet-body">
    					<div id="my_dashboard_amchart_3" class="CSSAnimationChart"></div>
    				</div>
    			</div>
    		</div>
        @endif
        @if(hasRole('dash-chart-house-type'))
    		<div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">House Type</span>
                            <span class="caption-helper">House Type Details...</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body">
                        <div id="dashboard_amchart_5" class="CSSAnimationChart"></div>
                    </div>
                </div>
            </div>
        @endif
	</div>
	<div class="clearfix"></div>
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{ asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
@endsection

@section('javascript')
	<script type="text/javascript">
    @if(hasRole('dash-chart-request-item'))
        var dataRequest = JSON.parse(convertQuot('{{$chart_request}}'));
        console.log(dataRequest);
    	if (dataRequest.length > 0) {
            AmCharts.makeChart("my_dashboard_amchart_1", {
                type: "serial",
                fontSize: 12,
                fontFamily: "Open Sans",
                dataDateFormat: "YYYY-MM-DD",
                dataProvider: dataRequest,

                addClassNames: true,
                startDuration: 1,
                color: "#6c7b88",
                marginLeft: 0,

                categoryField: "trans_date",
                categoryAxis: {
                    parseDates: true,
                    minPeriod: "MM",
                    autoGridCount: false,
                    gridCount: 50,
                    gridAlpha: 0.1,
                    gridColor: "#FFFFFF",
                    axisColor: "#555555",
                    dateFormats: [{
                        period: 'DD',
                        format: 'DD'
                    }, {
                        period: 'WW',
                        format: 'MMM DD'
                    }, {
                        period: 'MM',
                        format: 'MMM'
                    }, {
                        period: 'YYYY',
                        format: 'YYYY'
                    }]
                },

                valueAxes: [{
                    id: "a1",
                    title: "Total Requests",
                    gridAlpha: 0,
                    axisAlpha: 0
                }],
                graphs: [{
                    id: "g1",
                    valueField: "all_requested",
                    title: "Total Requests",
                    type: "column",
                    fillAlphas: 0.7,
                    valueAxis: "a1",
                    balloonText: "[[value]] time",
                    legendValueText: "[[value]] time",
                    legendPeriodValueText: "Total: [[value.sum]] PR",
                    lineColor: "#08a3cc",
                    alphaField: "alpha",
                }, {
                    id: "g2",
                    valueField: "all_completed",
                    classNameField: "bulletClass",
                    title: "Approved Requests",
                    type: "line",
                    valueAxis: "a2",
                    lineColor: "#786c56",
                    lineThickness: 1,
                    legendValueText: "[[value]] time",
                    bullet: "round",
                    bulletBorderColor: "#02617a",
                    bulletBorderAlpha: 1,
                    bulletBorderThickness: 2,
                    bulletColor: "#89c4f4",
                    labelPosition: "right",
                    balloonText: "Completed:[[value]] time",
                    showBalloon: true,
                    animationPlayed: true,
                }, {
                    id: "g3",
                    title: "Rejected Requests",
                    valueField: "all_rejected",
                    type: "line",
                    valueAxis: "a3",
                    lineAlpha: 0.8,
                    lineColor: "#e26a6a",
                    balloonText: "Rejected:[[value]] time",
                    lineThickness: 1,
                    legendValueText: "[[value]] time",
                    bullet: "square",
                    bulletBorderColor: "#e26a6a",
                    bulletBorderThickness: 1,
                    bulletBorderAlpha: 0.8,
                    dashLengthField: "dashLength",
                    animationPlayed: true
                }],

                chartCursor: {
                    zoomable: false,
                    categoryBalloonDateFormat: "MM",
                    cursorAlpha: 0,
                    categoryBalloonColor: "#e26a6a",
                    categoryBalloonAlpha: 0.8,
                    valueBalloonsEnabled: false
                },
                legend: {
                    bulletType: "round",
                    equalWidths: false,
                    valueWidth: 120,
                    useGraphSettings: true,
                    color: "#6c7b88"
                }
            });
        }
    @endif

    @if(hasRole('dash-chart-order-item'))
        var dataOrder = JSON.parse(convertQuot('{{$chart_order}}'));
        console.log(dataOrder);
    	if (dataOrder.length > 0) {
            AmCharts.makeChart("my_dashboard_amchart_2", {
                type: "serial",
                fontSize: 12,
                fontFamily: "Open Sans",
                dataDateFormat: "YYYY-MM-DD",
                dataProvider: dataOrder,

                addClassNames: true,
                startDuration: 1,
                color: "#6c7b88",
                marginLeft: 0,

                categoryField: "trans_date",
                categoryAxis: {
                    parseDates: true,
                    minPeriod: "MM",
                    autoGridCount: false,
                    gridCount: 50,
                    gridAlpha: 0.1,
                    gridColor: "#FFFFFF",
                    axisColor: "#555555",
                    dateFormats: [{
                        period: 'DD',
                        format: 'DD'
                    }, {
                        period: 'WW',
                        format: 'MMM DD'
                    }, {
                        period: 'MM',
                        format: 'MMM'
                    }, {
                        period: 'YYYY',
                        format: 'YYYY'
                    }]
                },

                valueAxes: [{
                    id: "a1",
                    title: "Total Orders",
                    gridAlpha: 0,
                    axisAlpha: 0
                }],
                graphs: [{
                    id: "g1",
                    valueField: "all_ordered",
                    title: "Total Orders",
                    type: "column",
                    fillAlphas: 0.7,
                    valueAxis: "a1",
                    balloonText: "[[value]] time",
                    legendValueText: "[[value]] time",
                    legendPeriodValueText: "Total: [[value.sum]] PR",
                    lineColor: "#08a3cc",
                    alphaField: "alpha",
                }, {
                    id: "g2",
                    valueField: "all_completed",
                    classNameField: "bulletClass",
                    title: "Approved Orders",
                    type: "line",
                    valueAxis: "a2",
                    lineColor: "#786c56",
                    lineThickness: 1,
                    legendValueText: "[[value]] time",
                    bullet: "round",
                    bulletBorderColor: "#02617a",
                    bulletBorderAlpha: 1,
                    bulletBorderThickness: 2,
                    bulletColor: "#89c4f4",
                    labelPosition: "right",
                    balloonText: "Completed:[[value]] time",
                    showBalloon: true,
                    animationPlayed: true,
                }, {
                    id: "g3",
                    title: "Rejected Orders",
                    valueField: "all_rejected",
                    type: "line",
                    valueAxis: "a3",
                    lineAlpha: 0.8,
                    lineColor: "#e26a6a",
                    balloonText: "Rejected:[[value]] time",
                    lineThickness: 1,
                    legendValueText: "[[value]] time",
                    bullet: "square",
                    bulletBorderColor: "#e26a6a",
                    bulletBorderThickness: 1,
                    bulletBorderAlpha: 0.8,
                    dashLengthField: "dashLength",
                    animationPlayed: true
                }],

                chartCursor: {
                    zoomable: false,
                    categoryBalloonDateFormat: "MM",
                    cursorAlpha: 0,
                    categoryBalloonColor: "#e26a6a",
                    categoryBalloonAlpha: 0.8,
                    valueBalloonsEnabled: false
                },
                legend: {
                    bulletType: "round",
                    equalWidths: false,
                    valueWidth: 120,
                    useGraphSettings: true,
                    color: "#6c7b88"
                }
            });
        }
    @endif	

    @if(hasRole('dash-chart-order-price'))
        var dataOrder_ = JSON.parse(convertQuot('{{$chart_order_}}'));
        if(dataOrder_.length > 0){
            AmCharts.makeChart("my_dashboard_amchart_3", {
                "type": "serial",
                "addClassNames": true,
                "theme": "light",
                "path": "{{asset('assets/global/plugins/amcharts/ammap/images/')}}",
                "autoMargins": false,
                "marginLeft": 80,
                "marginRight": 8,
                "marginTop": 10,
                "marginBottom": 26,
                "balloon": {
                    "adjustBorderColor": false,
                    "horizontalPadding": 10,
                    "verticalPadding": 8,
                    "color": "#ffffff"
                },

                "dataProvider": dataOrder_,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "startDuration": 1,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "fillAlphas": 1,
                    "title": "Total Orders",
                    "type": "column",
                    "valueField": "total_ordered",
                    "dashLengthField": "dashLengthColumn"
                }, {
                    "id": "graph2",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "bullet": "round",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "Orders Completed",
                    "valueField": "total_completed"
                }],
                "categoryField": "peroid",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                },
                "export": {
                    "enabled": true
                }
            });
        }
    @endif    
    @if(hasRole('dash-chart-house-type'))
    	var dataHouseType = JSON.parse(convertQuot('{{$house_type}}'));
        if (dataHouseType.length > 0) {
            AmCharts.makeChart("dashboard_amchart_5", {
                "type": "pie",
                "theme": "light",
                "path": "{{asset('assets/global/plugins/amcharts/ammap/images/')}}",
                "dataProvider": dataHouseType,
                "valueField": "num_house",
                "titleField": "house_type",
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                "angle": 30,
                "export": {
                    "enabled": true
                }
            });
        }
    @endif    
	</script>
@endsection