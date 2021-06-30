<div class="page-header navbar <?php if(getSetting()->page_header=="fixed"){echo "navbar-fixed-top";}else{echo "navbar-static-top";}?>">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner <?php if(getSetting()->theme_layout=="boxed"){ echo 'container';} ?>">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a>
                <img src="{{asset('assets/upload/temps/app_logo.png')}}" alt="logo" class="logo-default" style="height: 35px;"/> 
			</a>
            <div class="menu-toggler sidebar-toggler" onclick="setSidebar()">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
				@if(Session::get('project') != NULL)
					@if (hasRole('approve') || hasRole('inventory'))
					<li class="dropdown dropdown-extended dropdown-notification <?php if(getSetting()->top_menu_dropdown == "dark") echo "dropdown-dark"; ?>" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							<span class="badge badge-default header_notification_counter"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li class="external">
								<h3><span class="bold header_notification_counter_span"></span> {{trans('lang.notification')}}</h3>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller notification_lists" style="height: 250px;" data-handle-color="#637283"></ul>
							</li>
						</ul>
					</li>
					@endif
				@endif
				<!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user <?php if(getSetting()->top_menu_dropdown == "dark") echo "dropdown-dark"; ?>">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        @if(Auth::user()->photo=='' || Auth::user()->photo==null)
							<img src="{{ asset('assets/layouts/layout/img/avatar3_small.jpg') }}" class="img-circle img-responsive" alt=""/>
						@else
							<img src="{{ asset('assets/upload/picture/users/'.Auth::user()->photo) }}" class="img-circle img-responsive" alt=""/> 
						@endif
						<span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{url('user/profile')}}"><i class="icon-user"></i>{{trans('lang.my_profile')}}</a>
                        </li>
						<li>
                            <a href="{{url('user/profile/pass')}}"><i class="icon-key"></i>{{trans('lang.change_password')}}</a>
                        </li>
						@if(Session::get('project') != NULL)
							@if(hasRole('approve'))
								<li>
									<a href="{{url('user/task')}}"><i class="icon-rocket"></i>{{trans('lang.my_tasks')}}</a>
								</li>
							@endif
						<li>
                            <a href="{{url('project')}}"><i class="fa fa-exchange"></i>{{trans('lang.swetch_project')}}</a>
                        </li>
						@endif
                        <li class="divider"> </li>
                        <li>
                             <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-lock"></i>{{trans('lang.logout')}}</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
                        </li>
                    </ul>
                </li>
				<!-- END USER LOGIN DROPDOWN -->
				
				<!-- BEGIN LANGUAGE BAR -->
				<li class="dropdown dropdown-language <?php if(getSetting()->top_menu_dropdown == "dark") echo "dropdown-dark"; ?>">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						
						@if(App::getLocale() == 'en')
							<i class="flag flag-gb"></i><span class="langname"> EN </span>
						@else
							<i class="flag flag-kh"></i><span class="langname"> KH </span>
						@endif
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
                            <a onclick="getLanguage('kh')"><i class="flag flag-kh"></i> {{ trans('lang.khmer') }} </a>
                        </li>
                        <li>
							<a onclick="getLanguage('en')"><i class="flag flag-gb"></i> {{ trans('lang.english') }} </a>
                        </li> 
					</ul>
				</li>
				<!-- END LANGUAGE BAR -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
