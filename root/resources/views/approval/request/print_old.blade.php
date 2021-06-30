<!DOCTYPE html>
<html>
<head>
	<title>{{$title}}</title>
	<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
	<style type="text/css">
			/* khmer */
		@font-face {
		  font-family: 'Moul';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Moul'), url('{{asset('assets/kh-font/RKD1EVIln4NHt2RKYAXSnA.woff2')}}') format('woff2');
		  unicode-range: U+1780-17FF, U+200B-200C, U+25CC;
		}
		/* khmer */
		@font-face {
		  font-family: 'Siemreap';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Siemreap'), url('{{asset('assets/kh-font/nL27iPsuQEbeRiXh3DIukxTbgVql8nDJpwnrE27mub0.woff2')}}') format('woff2');
		  unicode-range: U+1780-17FF, U+200B-200C, U+25CC;
		}
		/* khmer */
		@font-face {
		  font-family: 'Suwannaphum';
		  font-style: normal;
		  font-weight: 400;
		  src: local('Suwannaphum Regular'), local('Suwannaphum-Regular'), url('{{asset('assets/kh-font/uAaVNZcr8xz6YTjJpK0ZzzXm5srZsLDS8o1sUzf6_yA.woff2')}}') format('woff2');
		  unicode-range: U+1780-17FF, U+200B-200C, U+25CC;
		}

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

		.img-report{
			position: absolute !important;
		    width: 136px !important;
		    height: 136px !important;
		}

		table {
		    border-collapse: collapse;
		    width: 100%;
		    font-size: 12px;
		}

		th {
		    text-align: center;
		    padding: 2px;
		    font-size: 12px;
		}

		td {
		    text-align: left;
		    padding: 2px;
		    font-size: 12px !important;
		}

		th {
		    background-color: #003366;
		    color: white;
		}

		@page { size: landscape; }

		.main-table-signature{
			width: 100%;
			position: fixed;
			bottom: 20px;
		}

		.main-table-signature > td{
			position: relative;
    		line-height: 10px;
		}

	</style>
</head>
<body style="font-family: myKhMetal !important;">
	@include('reports.header')
	<div style="width: 100%;">
		<span style="position: absolute;
	    text-align: right !important;
	    font-family: myKhBattambang;
	    font-size: 12px;
	    font-weight: bold;
	    color: #000000;
	    width: -webkit-fill-available;
	    padding-top: 30px;
	    right: 4px;">PR No : <label style="font-weight: bold !important;">{{$request_obj->ref_no}}</label></span>
		<span style="position: absolute;
	    text-align: right !important;
	    font-family: myKhBattambang;
	    font-size: 12px;
	    font-weight: bold;
	    color: #000000;
	    width: -webkit-fill-available;
	    padding-top: 51px;
	    right: 4px;">Date : <label style="font-weight: bold !important;">{{date('d/m/Y',strtotime($request_obj->trans_date))}}</label></span>
		<span style="position: absolute;
	    text-align: right !important;
	    font-family: myKhBattambang;
	    font-size: 12px;
	    font-weight: bold;
	    color: #000000;
	    width: -webkit-fill-available;
	    padding-top: 72px;
	    right: 4px;">{{trans("lang.delivery_date")}} : <label style="font-weight: bold !important;">{{date('d/m/Y',strtotime($request_obj->delivery_date))}}</label></span>
	</div>
	<span style="position: absolute;
    text-align: center !important;
    font-family: myKhBattambang;
    font-size: 16px;
    font-weight: bold;
    line-height: 64px;
    color: #000000;
    width: -webkit-fill-available;
    padding-top: 121px;
    left: 0;">Purchase Request</span>
    <span style="position: absolute;
    text-align: left !important;
    font-family: myKhBattambang;
    font-size: 12px;
    font-weight: bold;
    line-height: 64px;
    color: #000000;
    width: -webkit-fill-available;
    padding-top: 141px;
    left: 4;">សំណើរដោយផ្នែក : <label style="font-weight: bold !important;" class="lblRequestBy">{{($request_obj->request_by_people!=NULL ? $request_obj->request_by_people : '')}}</label></span>
    <span style="position: absolute;
    text-align: right !important;
    font-family: myKhBattambang;
    font-size: 12px;
    font-weight: bold;
    line-height: 64px;
    color: #000000;
    width: -webkit-fill-available;
    padding-top: 141px;
    right: 4px;">{{trans("lang.department")}} : <label style="font-weight: bold !important;" class="lblDepartment">{{($request_obj->department!=NULL ? $request_obj->department : '')}}</label></span>
	<div style="width: auto;">
		<table class="invoice-table" style="margin-top: 189px !important;">
            <thead>
				<tr>
                    <th width="1%" class="all">ល.រ</th>
					<th width="41%" class="all">ឈ្មោះទំនិញ / Product Name</th>
					<th width="5%" class="all">ខ្នាត / Size</th>
					<th width="8%" class="all">បរិមាណ / Qty</th>
					<th width="5%" class="all">ឯកតា / Unit</th>
					<th width="15%" class="all">មូលហេតុនៃការជ្រើសរើសទិញ / Reason</th>
					<th width="10%" class="all">កំណត់សំគាល់ / Remark</th>
                </tr>
            </thead>
            <tbody class="invoice-table-tbody" style="font-size:14px !important;"></tbody>
        </table>
	</div>
	<table class="main-table-signature">
		<tbody class="table-signature">
			<tr>
				<td style="text-align: center;">Requested By</td>
				<td style="text-align: center;">Approved By</td>
				<td style="text-align: center;">Approved By</td>
				<td style="text-align: center;">Approved By</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<img style="width: 100px;" src="{{asset('/assets/upload/picture/signature/129745a97c8ea080fc.png')}}">
				</td>
				<td style="text-align: center;">
					<img style="width: 100px;" src="{{asset('/assets/upload/picture/signature/129745a97c8ea080fc.png')}}">
				</td>
				<td style="text-align: center;">
					<img style="width: 100px;" src="{{asset('/assets/upload/picture/signature/129745a97c8ea080fc.png')}}">
				</td>
				<td style="text-align: center;">
					<img style="width: 100px;" src="{{asset('/assets/upload/picture/signature/129745a97c8ea080fc.png')}}">
				</td>
			</tr>
			<tr>
				<td style="text-align: center;">Name : Treng Mengsrun</td>
				<td style="text-align: center;">Name : Treng Mengsrun</td>
				<td style="text-align: center;">Name : Treng Mengsrun</td>
				<td style="text-align: center;">Name : Treng Mengsrun</td>
			</tr>
			<tr>
				<td style="text-align: center;">Date : 23/03/2018</td>
				<td style="text-align: center;">Date : 23/03/2018</td>
				<td style="text-align: center;">Date : 23/03/2018</td>
				<td style="text-align: center;">Date : 23/03/2018</td>
			</tr>
		</tbody>
	</table>
	@include('reports.footer')
</body>
<script type="text/javascript">

	function convertQuot(argument) {
		return argument.replace(/&quot;/g, '\"');
	}

	function lineNo(str, max) {
		str = str.toString();
		return str.length < max ? lineNo("0" + str, max) : str;
	}

	function formatDate(str){
		var date = new Date(str)
		var form = '{{getSetting()->format_date}}';
		
		/* format for day */
		if(form.indexOf("dd") >= 0){
			form = form.replace('dd', lineNo(date.getDate(), 2));
		}
		/* format for month */
		if(form.indexOf("mm") >= 0){
			form = form.replace('mm', lineNo((date.getMonth() + 1), 2));
		}
		/* format for year */
		if(form.indexOf("yyyy") >= 0){
			form = form.replace('yyyy', date.getFullYear());
		}
		return form;
	}

	function formatNumber(total) {
		var neg = false;
		if(total < 0) {
			neg = true;
			total = Math.abs(total);
		}
		return (neg ? "-" : '') + parseFloat(total, 10).toFixed('{{getSetting()->round_number}}').replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
	}
	

	var request_obj     = JSON.parse(convertQuot('{{$request_obj}}'));
	var request_items   = JSON.parse(convertQuot('{{$requestItems_obj}}'));
	var request_approve = JSON.parse(convertQuot('{{$request_approve}}'));

	function initRequestItems(){
		var table = $('.invoice-table-tbody');
		var str   = '';
		table.empty();
		if (request_items.length > 0) {
			$.each(request_items,function(key,val){
				str += '<tr>';
				str += '<td style="text-align:center !important;" class="black-all">'+(key+1)+'</td>';
				str += '<td style="text-align:left !important;" class="black-all">'+val.item_code+' ('+val.item_name+')</td>';
				str += '<td style="text-align:left !important;" class="black-all">'+(val.size!=null ? val.size : '')+'</td>';
				str += '<td style="text-align:center !important;" class="black-all">'+formatNumber(val.qty)+'</td>';
				str += '<td style="text-align:center !important;" class="black-all">'+val.unit_stock+'</td>';
				str += '<td style="text-align:left !important;" class="black-all">'+(val.desc!=null ? val.desc : '')+'</td>';
				str += '<td style="text-align:left !important;" class="black-all">'+(val.remark!=null ? val.remark : '')+'</td>';
				str += '</tr>';
			});

			for(var i=1;i <= 14 - request_items.length;i++){
				str += '<tr>';
				str += '<td style="text-align:center !important;" class="black-all">'+(i+request_items.length)+'</td>';
				str += '<td style="text-align:left !important;" class="black-all"></td>';
				str += '<td style="text-align:left !important;" class="black-all"></td>';
				str += '<td style="text-align:center !important;" class="black-all"></td>';
				str += '<td style="text-align:center !important;" class="black-all"></td>';
				str += '<td style="text-align:left !important;" class="black-all"></td>';
				str += '<td style="text-align:left !important;" class="black-all"></td>';
				str += '</tr>';
			}
		}
		table.html(str);
	}

	function initSignature() {
		var table = $(".table-signature");
		var str   = '';
		table.empty();

		if (request_approve.length > 0) {
			str += '<tr>';
			str += '<td style="text-align: center;">Requested By</td>';
			$.each(request_approve,function(key,val){
				str += '<td style="text-align: center;">Approved By</td>';
			});
			str += '</tr>';
			str += '<tr>';
			str += '<td style="text-align: center;">';
			str += '<img ' + (request_obj.signature != null ? 'style="width: 100px;"' : 'style="display:none;"') + ' src="{{asset("/assets/upload/picture/signature/")}}/'+request_obj.signature+'">';
			str += '</td>';
			$.each(request_approve,function(key,val){
				str += '<td style="text-align: center;">';
				str += '<img ' + (val.signature != null ? 'style="width: 100px;"' : 'style="display:none;"') + ' src="{{asset("/assets/upload/picture/signature/")}}/'+val.signature+'">';
				str += '</td>';
			});
			str += '</tr>';
			str += '<tr>';
			str += '<td style="text-align: center;">'+request_obj.position+' '+request_obj.user_request+'</td>';
			$.each(request_approve,function(key,val){
				str += '<td style="text-align: center;">'+val.position+' '+val.approved_people+'</td>';
			});
			str += '</tr>';
			str += '<tr>';
			str += '<td style="text-align: center;">Date : '+formatDate(request_obj.created_at)+'</td>';
			$.each(request_approve,function(key,val){
				str += '<td style="text-align: center;">Date : '+formatDate(val.approved_date)+'</td>';
			});
			str += '</tr>';
		}

		table.html(str);
	}

	$(document).ready(function(){
		initRequestItems();
		initSignature();
		window.print();
	});

</script>
</html>