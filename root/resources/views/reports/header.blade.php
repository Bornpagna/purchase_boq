<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<div class="style-invoice">
    <style type="text/css">

        @font-face {
           font-family: myKhHanuman;
           src: url('{{ asset('assets/kh-font/Hanuman.woff') }}');
        }
        @font-face {
           font-family: myKhFreehand;
           src: url('{{ asset('assets/kh-font/Kh-Freehand.woff') }}');
        }
        @font-face {
           font-family: myKhBattambang;
           src: url('{{ asset('assets/kh-font/KhmerOSbattambang.woff') }}');
        }
        @font-face {
           font-family: myKhMetal;
           src: url('{{ asset('assets/kh-font/Kh-Metal-Chrieng.woff') }}');
        }

        @font-face {
           font-family: myKhMoul;
           src: url('{{ asset('assets/kh-font/KhmerOS_muollight.ttf') }}');
        }

        .invoice-header{
            text-align: center !important;
        }

        .invoice-company-logo{
            position: absolute !important;
            padding: 1px 1px 1px 1px !important;
            margin: -110px 1px 1px -1px !important;
            width: 118px !important;
            height: 118px !important;
            border-radius: 14px !important;
            background-color: #fff !important;
        }

        .invoice-header span{
            font-family: myKhBattambang !important;
            font-weight: bold !important;
            padding-top: 14px;
            color: {{getSetting()->report_header_color}} !important;
        }

        .invoice-company-info{
            position: relative;
            float: right;
            text-align: left;
            font-family: myKhBattambang;
            font-size: 15px;
            font-weight: bold;
            top: -50px;
        }

        .invoice-customer-info{
            position: relative;
            font-family: myKhBattambang;
            font-size: 15px;
            font-weight: bold;
            top: 15px;
        }

        .invoice-barcode{
            position: relative !important;
            padding: 14px 1px 11px 1px !important;
            margin: 3px 3px 2px 60px;
            top: -150px !important;
        }

        .invoice-table{
            /* position: absolute; */
            width: 99% !important;
            border-collapse: collapse !important;
            border-spacing: 0 !important;
            margin-top: 174px;
        }

        .invoice-table th{
            font-family: myKhBattambang !important;
            background-color: {{getSetting()->report_header_color}} !important;
            color: white !important;
            border: 1px solid #000 !important;
            padding: 1px !important;
            font-size: 10px !important;
            text-align: center !important;
        }

        .invoice-table td {
            font-size: 10px !important;
            font-family: myKhBattambang !important;
            /* font-weight: bold !important; */
            padding: 1px 1px 1px 1px !important;
        }

        .invoice-symbol{
            position: absolute;
            width: 7%;
            right: 779px;
            text-align: center;
        }

        .black-all{
            border: 1px solid #000 !important; 
        }

        .tl{
            border-top: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
        }

        .bl{
            border-bottom: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
        }

        .t{
            border-top: 1px solid #000 !important;
        }

        .l{
            border-left: 1px solid #000 !important;
        }

        .r{
            border-right: 1px solid #000 !important; 
        }

        .b{
            border-bottom: 1px solid #000 !important;
        }

        .tr{
            border-top: 1px solid #000 !important;
            border-right: 1px solid #000 !important;
        }

        .br{
            border-right: 1px solid #000 !important;
            border-bottom: 1px solid #000 !important;
        }

        .lr{
            border-right: 1px solid #000 !important;
            border-left: 1px solid #000 !important;
        }

        .white-all{
            border: 1px solid #fff !important;
        }

        .hi-li{
            background-color: #036 !important;
            color: #fff !important;
            font-family: myKhBattambang !important;
            font-weight: bold !important; 
            padding: 1px 6px 1px 6px !important;
        }

        .invoice-jewelry-image{
            position: absolute !important;
            width: 206px !important;
            padding: 104px 1px 1px 2px !important;
            text-align : center !important;
        }

        .invoice-note{
            position: absolute !important;
            padding: 1px 1px 1px 10px !important;
            bottom: 15px !important;
        }

        .print-info{
            position: absolute !important;
            padding: 1px 1px 1px 10px !important;
            bottom: -2px !important;
            color: #8c8a8a !important;
            font-size: 8px !important;
            font-family: myKhBattambang !important;
        }

        .customer-info {
            border: 2px solid #337ab7 !important;
            padding: 109px 10px 63px 10px !important;
            margin: 32px 1px 16px 1px !important;
            width: 45% !important;
            position: relative !important;
            border-radius: 7px !important;
        }

        .company-info-detail {
            padding: 1px 1px 1px 1px;
            margin: -134px 1px 1px 1px;
            position: absolute;
            font-size: 14px !important;
            font-family: myKhBattambang !important;
            font-weight: bold;
        }

        .company-info-detail-value {
            padding: 1px 1px 1px 1px;
            margin: -138px 1px 1px 94px;
            position: absolute;
            font-weight: bold !important;
            font-size: 12px;
            font-family: myKhMetal !important;
            color: #003366 !important;
        }

        .customer-info-detail {
            padding: 1px 1px 1px 1px;
            margin: -92px 1px 1px 1px;
            position: absolute;
            font-size: 14px !important;
            font-family: myKhBattambang !important;
            font-weight: bold;
        }

        .customer-info-detail-value {
            padding: 1px 1px 1px 1px;
            margin: -96px 1px 1px 94px;
            position: absolute;
            font-weight: bold !important;
            font-size: 12px;
            font-family: myKhMetal !important;
            color: #003366 !important;
        }

        .company-info{
            border: 2px solid #337ab7 !important;
            padding: 155px 10px 1px 19px !important;
            margin: -209px 1px 27px 365px !important;
            width: 43% !important;
            border-radius: 7px !important;
        }

        .cust-title{
            font-size: 20px !important;
            font-family: myKhMetal !important;
            font-weight: bold !important;
            position: absolute !important;
            margin: -108px 1px 1px -1px !important;
        }

        .span-date{
            position: absolute !important;
            padding: 0px 2px 3px 375px !important;
            margin: -41px 0px 0px 402px !important;
            color: #036 !important;
            right: 237px !important;
            font-weight: bold !important;
            font-family: myKhMetal !important;
        }

        .div-panel{
            position: relative !important;
            border: 2px solid !important;
            width: 100% !important;
        }

        .order-barcode {
            position: relative !important;
            margin: 1px 2px 1px 3px !important;
            top: 4px !important;
        }

        .order-image{
            position: absolute !important;
            padding: 3px 4px 4px 4px !important;
            top: 86px !important;
            left: 2px !important;
            border: 3px solid #036 !important;
            border-radius: 7px !important;
        }

        .order-jewelry-type{
            position: absolute !important;
            font-size: 17px !important;
            font-family: myKhMetal !important;
            font-weight: bold !important;
            top: 51px !important;
            left: 0px !important;
        }

        .order-code {
            position: absolute !important;
            font-family: myKhBattambang !important;
            font-size: 14px !important;
            font-weight: bold !important;
            color: #036 !important;
            left: 32px !important;
            top: 33px !important;
        }

        .order-table-info{
            position: absolute !important;
            top: 3px !important;
            left: 133px !important;
        }

        .img-design{
            position: absolute !important;
		    margin: -8px -2px 1px -76px !important;
		    width: 152px !important;
        }

        .com-design{
            position: absolute !important;
            font-family: myKhMetal !important;
            font-size: 21px !important;
            color: #F44336 !important;
            margin: -55px 4px 4px 316px !important;
        }

        .md-12{
            width: 100% !important;
        }

        .md-6{
            width: 50% !important;
        }

        img.logo {
			position: absolute;
			width: 116px !important;
			margin: 10px;
			text-align: center;
		}

        div.div-relative {
            position: relative;
			width: 100%;
        }

        div.header-report {
            position: relative;
			width: 100%;
        }

        div.header-report-info {
            position: absolute;
            width: 100%;
        }
        span.header-report-title {
            position: absolute;
            width: 100%;
            font-family: myKhMoul;
            color: {{getSetting()->report_header_color}};
            font-size: 26px;
            font-weight: bold;
            text-align: center;
        }
        span.header-report-sub-title {
            position: absolute;
            width: 100%;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            line-height: 62px;
            text-transform: uppercase;
            color: {{getSetting()->report_header_color}};
        }
        .header-report-contact {
            position: absolute;
            text-align: center;
            width: 100%;
            font-size: 14px;
            margin: 0;
            line-height: 0px;
            line-height: 40px;
        }
        span.header-report-tel{}
        span.header-report-email{}
        h1.report-title{
            position: absolute;
            width: 100%;
            text-align: center;
            line-height: 241px;
            font-family: myKhMoul;
            font-size: 20px;
            text-decoration: underline;
            color: {{getSetting()->report_header_color}};
        }
        span.header-report-address {
            position: absolute;
            width: 100%;
            text-align: center;
            font-size: 14px;
            line-height: 20px;
            line-height: 62px;
        }
        .header-border{
            position: absolute;
            border: 1px solid #0975ec;
            width: 100%;
            text-align: center;
            top: 143px;
        }

        body > div.div-footer-report {
            width: 100%;
            font-family: myKhBattambang;
            position: absolute;
        }

        body > div > span.footer-report{
            position: fixed;
            font-size: 9px;
            text-align: center;
            bottom: 0px;
            border-top: 1px solid;
            line-height: 14px;
            width: 100%;
            color: {{getSetting()->report_header_color}};
        }
        
        .watermark {
			background: url("{{asset('assets/upload/temps/app_icon.png')}}") no-repeat;
			width: 100%;
			opacity: 0.05;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: -1;
			position: fixed;
		}

    </style>
</div>
<div class="div-relative">
	<div class="header-report">
		<img class="logo" src="{{asset('assets/upload/temps/app_icon.png')}}">
        <div class="header-report-info">
            <!-- Title as khmer -->
            <span class="header-report-title">{{getSetting()->report_header}}</span><br/>
            <br/>
            <!-- Title as english -->
            <span class="header-report-sub-title">{{getSetting()->company_name}}</span><br/>
            <br/>
            <!-- Address -->
            <span class="header-report-address">{{getSetting()->company_address}}</span><br/>
            <br/>
            <!-- Contact -->
            <span class="header-report-contact">
                <!-- Phone -->
                <span class="header-report-tel">Tel: {{getSetting()->company_phone}} </span>
                <!-- Email -->
                <span class="header-report-email">Email: {{getSetting()->company_email}}</span>
                </br>
            </span>
            
        </div>
        <!-- border -->
        </br>
	    <span class="header-border"></span></br>
        <!-- report title -->
        <h1 class="report-title">{{$title}}</h1>
	</div>
</div>