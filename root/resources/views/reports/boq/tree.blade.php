@extends('layouts.app')

@section('stylesheet')
	<style>
		td.details-control {
            background: url("{{url("assets/upload/temps/details_open.png")}}") no-repeat center center !important;
            cursor: pointer !important;
        }
        tr.shown td.details-control {
            background: url("{{url("assets/upload/temps/details_close.png")}}") no-repeat center center !important;
        }
	</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="{{$icon}} font-dark"></i>
					<span class="caption-subject bold font-dark uppercase"> {{$title}}</span>
					<span class="caption-helper">{{$small_title}}</span>
				</div>
				
			</div>
            <div class="portlet-body">
                <div class="row" style="margin:0px;">
                    <div class="portlet light bordered well col-md-2">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-social-dribbble font-purple-soft"></i>
                                    <span class="caption-subject font-purple-soft bold uppercase">Default Tabs</span>
                                </div>
                                
                            </div>
                            <div class="portlet-body">
                                <link class="cssdeck" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap.min.css">
                                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" class="cssdeck">

                                <divstyle="padding: 0px !important;">
                                    <div style="overflow-y: scroll; overflow-x: hidden; height: 600px;">
                                        <ul class="nav nav-list">
                                            <li><label class="tree-toggler nav-header"><i class="fa fa-sort-desc"></i> Header 1</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                    <li><label class="tree-toggler nav-header"><i class="fa fa-sort-desc"></i> Header 1.1</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><label class="tree-toggler nav-header">Header 1.1.1</label>
                                                                <ul class="nav nav-list tree">
                                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="divider"></li>
                                            <li><label class="tree-toggler nav-header">Header 2</label>
                                                <ul class="nav nav-list tree">
                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                    <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                    <li><label class="tree-toggler nav-header">Header 2.1</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><a href="#"><i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><label class="tree-toggler nav-header"><i class="fa fa-sort-desc"></i> Header 2.1.1</label>
                                                                <ul class="nav nav-list tree">
                                                                    <li><a href="#">Link</a></li>
                                                                    <li><a href="#">Link</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><label class="tree-toggler nav-header"><i class="fa fa-sort-desc"></i> Header 2.2</label>
                                                        <ul class="nav nav-list tree">
                                                            <li><a href="#"> <i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><a href="#"> <i class="fa fa-sort-desc"></i> Link</a></li>
                                                            <li><label class="tree-toggler nav-header"><i class="fa fa-sort-desc"></i> Header 2.2.1</label>
                                                                <ul class="nav nav-list tree">
                                                                    <li><a href="#"><i class="fa fa-sort-desc"></i><i class="fa fa-sort-desc"></i> Link</a></li>
                                                                    <li><a href="#"><i class="fa fa-sort-desc"></i><i class="fa fa-sort-desc"></i> Link</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>                    
                            <div class="col-md-10">
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-social-dribbble font-purple-soft"></i>
                                            <span class="caption-subject font-purple-soft bold uppercase">Default Tabs</span>
                                        </div>
                                        <div class="actions">
                                            <a title="{{trans('lang.print')}}" onclick="onPrint(this);" version="print" class="btn btn-circle btn-icon-only btn-default">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a title="{{trans('lang.download')}}" onclick="onPrint(this);" version="excel"  class="btn btn-circle btn-icon-only btn-default">
                                                <i class="fa fa-file-excel-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> Home </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> Profile </a> 
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="tab_1_1">
                                                <p> Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher
                                                    retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                                                    qui. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_2">
                                                <p> Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft
                                                    beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica
                                                    VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester
                                                    stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_3">
                                                <p> Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                                                    locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
                                                    etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_4">
                                                <p> Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore
                                                    wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh
                                                    craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan. </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- Modal Varian -->
@endsection()
@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $('label.tree-toggler').click(function () {
            $(this).parent().children('ul.tree').toggle(300);
        });
    });
</script>
@endsection()